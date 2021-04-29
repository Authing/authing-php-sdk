<?php

namespace Authing;

require_once __DIR__ . '/../vendor/autoload.php';

use DateTime;
use stdClass;
use Exception;
use GuzzleHttp\Client;
use Authing\Mgmt\Utils;
use GuzzleHttp\Psr7\Message;
use Authing\Types\AccessTokenParam;
use Error;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\RequestException;

abstract class BaseClient
{
    /**
     * @var Client
     */
    protected $naiveHttpClient;
    protected $options;

    protected $userPoolId;
    protected $appId;

    private $host = 'https://core.authing.cn';

    private $_type = "SDK";

    private $_version = "php:4.1.12";

    private $_accessTokenExpriredAt;

    private $publicKey
    = <<<PUBLICKKEY
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC4xKeUgQ+Aoz7TLfAfs9+paePb
5KIofVthEopwrXFkp8OCeocaTHt9ICjTT2QeJh6cZaDaArfZ873GPUn00eOIZ7Ae
+TiA2BKHbCvloW3w5Lnqm70iSsUi5Fmu9/2+68GZRH9L7Mlh8cFksCicW2Y2W2uM
GKl64GDcIq3au+aqJQIDAQAB
-----END PUBLIC KEY-----
PUBLICKKEY;

    protected $accessToken = '';
    protected $mfaToken = '';

    /**
     * Client constructor.
     * @param $userPoolId string
     * @throws InvalidArgumentException
     */
    public function __construct($userPoolIdOrFunc)
    {

        if (!isset($userPoolIdOrFunc)) {
            throw new InvalidArgumentException("Invalid userPoolIdOrFunc");
        }
        if (is_string($userPoolIdOrFunc)) {
            // $this->options = $userPoolIdOrFunc;
            // 传入的是 userPoolId
            // $this->appId =
            //     $userPoolIdOrFunc;
            $this->userPoolId =
                $userPoolIdOrFunc;
        }
        if (is_callable($userPoolIdOrFunc)) {
            $this->options = new stdClass;
            $userPoolIdOrFunc($this->options);
            // 传入的是一个函数
            // $empty_object =
            //     new \stdClass;
            // $userPoolIdOrFunc($empty_object);
            if (isset($this->options->userPoolId)) {
                $this->userPoolId = $this->options->userPoolId;
            }

            if (isset($this->options->appId)) {
                $this->appId = $this->options->appId;
            }
        }
        if (is_null($this->userPoolId) && is_null($this->appId)) {
            throw new InvalidArgumentException("Invalid userPoolIdOrFunc");
        }
        $this->naiveHttpClient = new Client(['base_uri' => $this->options->host ?? $this->host]);
    }

    /**
     * @param $host string 用户池 ID
     */
    public function setHost($host)
    {
        $this->host = $host;
        $this->naiveHttpClient = new Client(['base_uri' => $host]);
    }

    /**
     * @param $publicKey string 加密公钥
     */
    public function setPublicKey($publicKey)
    {
        $this->publicKey = $publicKey;
    }

    /**
     * @param $accessToken string
     */
    public function setAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * 获取 access token
     *
     * @return AccessTokenRes
     * @throws Exception
     */
    public function requestToken()
    {
        $param = new AccessTokenParam($this->userPoolId, $this->options->secret);
        $res = $this->request($param->createRequest());
        $this->accessToken = $res->accessToken;
        $tokenInfo = Utils::getTokenPlayloadData($this->accessToken);
        $exp = $tokenInfo->exp;
        $this->_accessTokenExpriredAt = $exp;
        echo $this->_accessTokenExpriredAt;
        return $res;
    }

    // /**
    //  * @param $token string
    //  */
    // public function setToken($token)
    // {
    //     $this->accessToken = $token;
    // }

    /**
     * password Encrypt
     * @param string $password
     * @return string
     */
    public function encrypt($password)
    {
        if (!$password) {
            return null;
        }
        $newPassword = '';
        openssl_public_encrypt($password, $newPassword, $this->publicKey);
        return base64_encode($newPassword);
    }

    public function httpSend($req)
    {

        $res = $this->naiveHttpClient->send($req, ['http_errors' => false]);

        if ($res->getStatusCode() != 200)
        $code = $res->getStatusCode();
        $body = $res->getBody();
        if ($code != 200) {
            throw new Exception($body, $code);
        }
        return $body;
    }

    public function httpRequest()
    {
        $params = func_get_args();
        if ($params[2]) {
            $params[2]['http_errors'] = false;
        }
        $res = $this->naiveHttpClient->request(...$params);
        $code = $res->getStatusCode();
        $body = $res->getBody();
        if ($code != 200) {
            throw new Exception($body, $code);
        }
        return $body;
    }


    /**
     * Make a http request and return response data.
     * @param $data        array request data
     * @return mixed
     * @throws Exception
     */
    public function request($data)
    {
        $result = $this->send($this->host . '/graphql/v2', $this->objectToArray($data));
        $this->checkResult($result);
        // return json_decode(json_encode($result));
        if (!$this->firstElement($result['data'])) {
            return null;
        } else {
            return $this->arrayToObject($this->firstElement((object)$result['data']));
        }
    }

    /**
     * @param $path string
     * @return object
     * @throws Exception
     */
    public function httpGet($path)
    {
        $result = $this->send($this->host . $path, null, 'GET');
        $res = json_decode(json_encode($result));
        return $res->data ?? $res;
        // return $this->arrayToObject($result);
    }

    /**
     * @param $path string
     * @param $data object | array
     * @return object
     * @throws Exception
     */
    public function httpPost($path, $data, $flag = '')
    {
        if (isset($flag) && $flag) {
            $path = $path;
        } else {
            $path = $this->host . $path;
        }
        $result = $this->send($path, $this->objectToArray($data));
        $res = json_decode(json_encode($result));
        return $res->data ?? $res;
        // return json_decode(json_encode($result));
        // return $this->arrayToObject($result);
    }

    public function httpPatch($path, $data = [])
    {
        $result = $this->send($this->host . $path, $data, 'PATCH');
        $res = json_decode(json_encode($result));
        return $res->data ?? $res;
        // return $this->arrayToObject($result);
    }

    public function httpPut($path, $data = [])
    {
        $result = $this->send($this->host . $path, $data, 'PUT');
        $res = json_decode(json_encode($result));
        return $res->data ?? $res;
        // return $this->arrayToObject($result);
    }

    /**
     * @param $path string
     * @return object
     * @throws Exception
     */
    public function httpDelete($path)
    {
        $result = $this->send($this->host . $path, null, 'DELETE');
        $res = json_decode(json_encode($result));
        return $res->data ?? $res;
        // return $this->arrayToObject($result);
    }

    /**
     * @param $result
     * @throws Exception
     */
    private function checkResult($result)
    {
        if (isset($result['errors'])) {
            $errors = $result['errors'];
        }

        if (!empty($errors) && count($errors) > 0) {
            foreach($errors as $error) {
                $error = (object)$error;
                $data = (object)($error->message);
                throw new Exception($data->message, $data->code);    
            }
        }
    }

    /**
     * 对象 转 数组
     * @param $data object | array
     * @return array
     */
    private function objectToArray($data)
    {
        $arr = array_filter((array) $data);
        foreach ($arr as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object') {
                $arr[$k] = $this->objectToArray($v);
            }
        }
        return $arr;
    }

    /**
     * 数组 转 对象
     *
     * @param $arr array 数组
     * @return object
     */
    private function arrayToObject($arr)
    {
        foreach ($arr as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object') {
                if ($k !== 'data') {
                    $arr[$k] = $this->arrayToObject($v);
                }
            }
            // 如果是关联数组
            if (gettype($v) == 'array' && (count(array_filter(array_keys($v), 'is_string')) > 0)) {
                $arr[$k] = (object) $v;
            }
        }
        if (gettype($arr) == 'array' && (count(array_filter(array_keys($arr), 'is_string')) > 0)) {
            $arr = (object) $arr;
        }
        return $arr;
    }

    /**
     * @param $arr array
     * @return mixed|null
     */
    private function firstElement($arr)
    {
        foreach ($arr as $k => $v) {
            return $v;
        }
        return null;
    }

    private function getToken()
    {
        if (!empty($this->options->accessToken)) {
            return $this->options->accessToken;
        }
        // 缓存到 accessToken 过期前 3600 s
        if (
            $this->accessToken && ($this->_accessTokenExpriredAt > (time() + 3600))
        ) {
            return $this->accessToken;
        } else if (isset($this->_accessTokenExpriredAt) && ($this->_accessTokenExpriredAt < (time() + 3600))) {
            echo $this->_accessTokenExpriredAt;
            return $this->requestToken();
        }
    }

    /**
     * @param string $url request url
     * @param string|array $data post body
     * @param string $method http method
     * @param int $time timeout time
     * @return mixed
     * @throws Exception
     */
    private function send($url, $data = '', $method = 'POST', $time = 30000)
    {
        // 如果是通过密钥刷新
        $this->accessToken = $this->getToken() ?? $this->accessToken;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        curl_setopt($ch, CURLOPT_NOSIGNAL, true); //支持毫秒级别超时设置

        // set header
        $h = [
            "Authorization: Bearer " . ($this->mfaToken ? $this->mfaToken :
                $this->options->accessToken ?? $this->accessToken ??  null),
            "Content-type: application/json",
            "x-authing-userpool-id: $this->userPoolId",
            "x-authing-app-id: $this->appId",
            "x-authing-request-from: $this->_type",
            "x-authing-sdk-version: $this->_version",
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $h);

        switch ($method) {
            case "POST":
                curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($data) ? json_encode($data) : $data);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                break;
            case "PUT":
                curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($data) ? json_encode($data) : $data);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                break;
            case "PATCH":
                curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($data) ? json_encode($data) : $data);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
                break;
            case "PUT":
                curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($data) ? json_encode($data) : $data);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
                break;
            case "DELETE":
                curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($data) ? json_encode($data) : $data);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
                break;
        }

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 3000);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $time);

        $response = curl_exec($ch);

        if (curl_errno($ch) === 0) {
            $info = curl_getinfo($ch);
            if (!empty($info['http_code']) && ($info['http_code'] == 200 || $info['http_code'] == 201)) {
                $res = json_decode($response, true);
                if (json_last_error() == JSON_ERROR_NONE) {
                    $return = $res;
                } else {
                    $return = $response;
                }
            } else {
                throw new Exception(
                    "http response code not equal 200 return {$info['http_code']}, and the response body: {$response}"
                );
            }
            curl_close($ch);
            return $return;
        } else {
            $code = curl_errno($ch);
            $error = curl_error($ch);
            curl_close($ch);
            throw new Exception(
                "curl internal error, curlErrorCode is {$code},errorMsg: {$error}"
            );
        }
    }

    public function formatAuthorizedResources($obj)
    {
        $authorizedResources = $obj->authorizedResources;
        $list = $authorizedResources->list;
        $total = $authorizedResources->tatalCount;
        array_map(function ($_) {
            foreach ($_ as $key => $value) {
                if ($_->$key) {
                    unset($_->$key);
                }
            }
            return $_;
        }, $list);
        $res = new stdClass;
        $res->list = $list;
        $res->totalCount = $total;
        return $res;
    }
}
