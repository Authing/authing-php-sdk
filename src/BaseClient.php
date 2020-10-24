<?php


namespace Authing;

use Exception;

abstract class BaseClient
{
    protected $userPoolId;

    private $host = 'https://core.authing.cn';

    private $_type = "SDK";

    private $_version = "php:2.0.0";

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

    /**
     * Client constructor.
     * @param $userPoolId string
     * @throws InvalidArgumentException
     */
    public function __construct($userPoolId)
    {
        if (!isset($userPoolId)) {
            throw new InvalidArgumentException("Invalid userPoolId");
        }

        $this->userPoolId = $userPoolId;
    }

    /**
     * @param $host string 用户池 ID
     */
    public function setHost($host) {
        $this->host = $host;
    }

    /**
     * @param $publicKey string 加密公钥
     */
    public function setPublicKey($publicKey) {
        $this->publicKey = $publicKey;
    }

    /**
     * @param $accessToken string
     */
    public function setAccessToken($accessToken) {
        $this->accessToken = $accessToken;
    }

    /**
     * password Encrypt
     * @param string $password
     * @return string
     */
    public function encrypt($password)
    {
        if (!$password) return null;

        $newPassword = '';
        openssl_public_encrypt($password, $newPassword, $this->publicKey);
        return base64_encode($newPassword);
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
        return $this->arrayToObject($this->firstElement($result['data']));
    }

    /**
     * @param $path string
     * @return object
     * @throws Exception
     */
    public function httpGet($path) {
        $result = $this->send($this->host . $path, null, 'GET');
        return $this->arrayToObject($result);
    }

    /**
     * @param $path string
     * @param $data object | array
     * @return object
     * @throws Exception
     */
    public function httpPost($path, $data) {
        $result = $this->send($this->host . $path, $this->objectToArray($data));
        return $this->arrayToObject($result);
    }

    /**
     * @param $path string
     * @return object
     * @throws Exception
     */
    public function httpDelete($path) {
        $result = $this->send($this->host . $path, null, 'DELETE');
        return $this->arrayToObject($result);
    }

    /**
     * @param $result
     * @throws Exception
     */
    private function checkResult($result)
    {
        $errors = $result['errors'];
        if (!empty($errors) && count($errors) > 0) {
            throw new Exception("Graphql request failed:\n" . var_export($errors));
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
                $arr[$k] = $this->arrayToObject($v);
            }
        }

        return (object)$arr;
    }

    /**
     * @param $arr array
     * @return mixed|null
     */
    private function firstElement($arr) {
        foreach ($arr as $k => $v) {
            return $v;
        }
        return null;
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
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_AUTOREFERER, true);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);

        curl_setopt($ch, CURLOPT_NOSIGNAL, true); //支持毫秒级别超时设置

        // set header
        $h = [
            "Content-type: application/json",
            "Authorization: Bearer $this->accessToken",
            "x-authing-userpool-id: $this->userPoolId",
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
}