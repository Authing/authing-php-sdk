<?php
/**
 * Created by PhpStorm.
 * User: haoweilai
 * Date: 2018/4/30
 * Time: 下午10:35
 */

namespace Authing;

use Exception;

require_once __DIR__ . '/CodeGen.php';

class AuthingApiClient
{
    /**
     * @var int[]
     */
    protected $options = [];

    private $accessToken = '';

    private $host = 'https://core.authing.cn';

    private $_endpoint = 'https://core.authing.cn/graphql';

    private $_type = "SDK";

    private $_version = "php:1.1.0";

    private $publicKey
    = <<<PUBLICKKEY
-----BEGIN PUBLIC KEY-----
MIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQC4xKeUgQ+Aoz7TLfAfs9+paePb
5KIofVthEopwrXFkp8OCeocaTHt9ICjTT2QeJh6cZaDaArfZ873GPUn00eOIZ7Ae
+TiA2BKHbCvloW3w5Lnqm70iSsUi5Fmu9/2+68GZRH9L7Mlh8cFksCicW2Y2W2uM
GKl64GDcIq3au+aqJQIDAQAB
-----END PUBLIC KEY-----
PUBLICKKEY;

    /**
     * Client constructor.
     * @param $options
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function __construct($options)
    {
        $this->options = $this->createOptions($options);
    }


    /**
     * @param $options
     * @return mixed
     * @throws InvalidArgumentException
     */
    private function createOptions($options)
    {
        if (is_array($options)) {
            if (isset($options['clientId']) && isset($options['secret'])) {
                return $options;
            }
        }
        throw new InvalidArgumentException("Invalid type for client options.");
    }

    /**
     * password Encrypt
     * @param string $password
     * @return string
     */
    protected function passwordEncrypt($password)
    {
        $newPassword = '';
        openssl_public_encrypt($password, $newPassword, $this->publicKey);
        return base64_encode($newPassword);
    }

    /**
     * @param $result
     * @throws Exception
     */
    protected function checkResult($result)
    {
        $errors = $result['errors'];
        if (!empty($errors) && count($errors) > 0) {
            throw new Exception("Graphql request failed:\n" . var_export($errors));
        }
    }

    /**
     * Make a http request and return response data.
     * @param $data        array request data
     * @return mixed
     * @throws Exception
     */
    protected function request($data)
    {
        $result = $this->send($this->host . '/graphql', $this->objectToArray($data));
        $this->checkResult($result);
        return $this->arrayToObject($result['data']);
    }

    /**
     * 对象 转 数组
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
     * @param array $arr 数组
     * @return object
     */
    private function arrayToObject(array $arr)
    {
        foreach ($arr as $k => $v) {
            if (gettype($v) == 'array' || getType($v) == 'object') {
                $arr[$k] = $this->arrayToObject($v);
            }
        }

        return (object) $arr;
    }

    /**
     * @param string $url request url
     * @param string|array $data post body
     * @param int $time timeout time
     * @return mixed
     * @throws Exception
     */
    private function send($url, $data = '', $time = 30000)
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
            "content-type: application/json",
            "Authorization: Bearer {$this->accessToken}",
            "x-authing-userpool-id： {$this->options['clientId']}",
            "x-authing-request-from: {$this->_type}",
            "x-authing-sdk-version: {$this->_version}",
        ];
        curl_setopt($ch, CURLOPT_HTTPHEADER, $h);

        if ($data != '') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, is_array($data) ? json_encode($data) : $data);
        }

        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS, 3000);
        curl_setopt($ch, CURLOPT_TIMEOUT_MS, $time);

        $response = curl_exec($ch);

        if (curl_errno($ch) === 0) {
            $info = curl_getinfo($ch);
            if (!empty($info['http_code']) && $info['http_code'] == 200) {
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

    /**
     * @param $param
     * @throws InvalidArgumentException
     */
    protected function checkParams($param)
    {
        $arr = (array) $param;
        foreach (func_get_args() as $k => $v) {
            if ($k != 0) {
                if (!isset($arr[$v])) {
                    throw new InvalidArgumentException(
                        "function args do not contain params {$v} and can not be null"
                    );
                }
            }
        }
    }

    /**
     * 设置 AccessToken
     * @param $token string
     */
    public function setAccessToken($token) {
        $this->accessToken = $token;
    }

    /**
     * 设置加密公钥
     * @param $publicKey string
     */
    public function setPublicKey($publicKey) {
        $this->publicKey = $publicKey;
    }

    /**
     * 设置后端通信地址
     * @param $host string
     */
    public function setHost($host) {
        $this->host = $host;
    }

    /**
     * Login with admin's secret
     * @return string      admin's accessToken
     * @throws Exception
     */
    public function loginBySecret()
    {
        $param = new LoginBySecretParam();

        $param->clientId = $this->options["clientId"];
        $param->secret = $this->options["secret"];

        return $this->accessToken = $this->request($param->createRequest())->getAccessTokenByAppSecret;
    }

    /**
     * Login use email
     * @param LoginByEmailParam
     * @return LoginByEmailResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function loginByEmail(LoginByEmailParam $param)
    {
        // check params is contain Specified key
        $this->checkParams($param, 'email', 'password');

        // set client id and encrypt password
        $param->clientId = $this->options['clientId'];
        $param->password = $this->passwordEncrypt($param->password);

        return $this->request($param->createRequest());
    }

    /**
     * Login use phone and password
     * @param LoginByPhonePasswordParam
     * @return LoginByPhonePasswordResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function loginByPhonePassword(LoginByPhonePasswordParam $param)
    {
        // check params is contain Specified key
        $this->checkParams($param, 'phone', 'password');

        // set client id
        $param->clientId = $this->options['clientId'];

        return $this->request($param->createRequest());
    }

    /**
     * Login use phone code
     * @param LoginByPhoneCodeParam
     * @return LoginByPhoneCodeResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function loginByPhoneCode(LoginByPhoneCodeParam $param)
    {
        // check params is contain Specified key
        $this->checkParams($param, 'phone', 'phoneCode');

        // set client id
        $param->clientId = $this->options['clientId'];

        return $this->request($param->createRequest());
    }

    /**
     * Login use username
     * @param LoginByUsernameParam
     * @return LoginByUsernameResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function loginByUsername(LoginByUsernameParam $param)
    {
        // check params is contain Specified key
        $this->checkParams($param, 'username', 'password');

        // set client id and encrypt password
        $param->clientId = $this->options['clientId'];
        $param->password = $this->passwordEncrypt($param->password);

        return $this->request($param->createRequest());
    }

    /**
     * Login use AD
     * @param LoginByAdParam
     * @return LoginByAdResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function loginByAd(LoginByAdParam $param)
    {
        // check params is contain Specified key
        $this->checkParams($param, 'adConnectorId', 'username', 'password');

        // encrypt password
        $param->password = $this->passwordEncrypt($param->password);

        return $this->request($param->createRequest());
    }

    /**
     * Login use LDAP
     * @param LoginByLdapParam
     * @return LoginByLdapResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function loginByLdap(LoginByLdapParam $param)
    {
        // check params is contain Specified key
        $this->checkParams($param, 'username', 'password');

        // set client id and encrypt password
        $param->clientId = $this->options['clientId'];
        $param->password = $this->passwordEncrypt($param->password);

        return $this->request($param->createRequest());
    }

    /**
     * Register
     * @param RegisterParam $param
     * @return RegisterResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function register(RegisterParam $param)
    {
        // check params is contain Specified key
        $this->checkParams($param, 'userInfo');

        // set client id and encrypt password
        $param->userInfo->registerInClient = $this->options['clientId'];
        $param->userInfo->password = $this->passwordEncrypt($param->userInfo->password);

        return $this->request($param->createRequest());
    }

    /**
     * Send phone code
     * @param $phone        string
     * @return object        { "message" => string, "code" => int }
     * @throws Exception
     */
    public function sendPhoneCode($phone)
    {
        $url = "$this->host/send_smscode/$phone/{$this->options['clientId']})";
        return $this->arrayToObject($this->send($url));
    }

    /**
     * Send register phone code, only use with new user
     * @param $phone        string
     * @return object        { "message" => string, "code" => int }
     * @throws Exception
     */
    public function sendRegisterPhoneCode($phone)
    {
        $url = "$this->host/notification/send_register_smscode/$phone/{$this->options['clientId']})";
        return $this->arrayToObject($this->send($url));
    }

    /**
     * @param DecodeJwtTokenParam $param
     * @return DecodeJwtTokenResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function decodeJwtToken(DecodeJwtTokenParam $param)
    {
        $this->checkParams($param, 'token');

        return $this->request($param->createRequest());
    }

    /**
     * @param SendResetPasswordEmailParam $param
     * @return SendResetPasswordEmailResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function sendResetPasswordEmail(SendResetPasswordEmailParam $param)
    {
        $this->checkParams($param, 'email');

        $param->client = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param VerifyResetPasswordVerifyCodeParam $param
     * @return VerifyResetPasswordVerifyCodeResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function verifyResetPasswordVerifyCode(VerifyResetPasswordVerifyCodeParam $param)
    {
        $this->checkParams($param, 'email', 'verifyCode');

        $param->client = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param ChangePasswordParam $param
     * @return ChangePasswordResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function changePassword(ChangePasswordParam $param)
    {
        $this->checkParams($param, 'email', 'password', 'verifyCode');

        $param->client = $this->options["clientId"];
        $param->password = $this->passwordEncrypt($param->password);

        return $this->request($param->createRequest());
    }

    /**
     * @param SendVerifyEmailParam $param
     * @return SendVerifyEmailResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function sendVerifyEmail(SendVerifyEmailParam $param)
    {
        $this->checkParams($param, 'email', 'token');

        $param->client = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param UserExistParam $param
     * @return UserExistResponse
     * @throws Exception
     */
    public function userExist(UserExistParam $param)
    {
        $param->userPoolId = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param UserParam $param
     * @return UserResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function user(UserParam $param)
    {
        $this->checkParams($param, 'id');

        $param->registerInClient = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param RefreshTokenParam $param
     * @return RefreshTokenResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function refreshToken(RefreshTokenParam $param)
    {
        $this->checkParams($param, 'user');

        $param->client = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param UpdateUserParam $param
     * @return UpdateUserResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function updateUser(UpdateUserParam $param)
    {
        $this->checkParams($param, 'options');

        $param->options->registerInClient = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param CheckLoginStatusParam $param
     * @return CheckLoginStatusResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function checkLoginStatus(CheckLoginStatusParam $param)
    {
        $this->checkParams($param, 'token');

        return $this->request($param->createRequest());
    }

    /**
     * @param UserPatchParam $param
     * @return UserPatchResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function userPatch(UserPatchParam $param)
    {
        $this->checkParams($param, 'ids');

        return $this->request($param->createRequest());
    }

    /**
     * @param UsersParam $param
     * @return UsersResponse
     * @throws Exception
     */
    public function users(UsersParam $param)
    {
        $param->registerInClient = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param RemoveUsersParam $param
     * @return RemoveUsersResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function removeUsers(RemoveUsersParam $param)
    {
        $this->checkParams($param, 'ids');

        $param->registerInClient = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param UnbindEmailParam $param
     * @return UnbindEmailResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function unbindEmail(UnbindEmailParam $param)
    {
        $this->checkParams($param, 'user');

        $param->client = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * assignUserToRole
     * @param AssignUserToRoleParam
     * @return AssignUserToRoleResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function assignUserToRole(AssignUserToRoleParam $param)
    {
        $this->checkParams($param, 'user');

        $param->client = $this->options['clientId'];

        return $this->request($param->createRequest());
    }
}
