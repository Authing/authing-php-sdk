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
    private $options = [];

    private $_accessToken = '';

    private $_oauthUrl = 'https://oauth.authing.cn/graphql';

    private $_usersUrl = 'https://users.authing.cn/graphql';

    const PUBLIC_KEY
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
        // obtain accessToken
        $this->getAccessToken();
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
    private static function passwordEncrypt($password)
    {
        $newPassword = '';
        openssl_public_encrypt($password, $newPassword, self::PUBLIC_KEY);
        return base64_encode($newPassword);
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
     * Make a http request and return response data.
     * @param $data        array request data
     * @param $isUserHost  bool   userHost or oAuthHost
     * @return mixed
     * @throws Exception
     */
    private function request($data, $isUserHost = true)
    {
        $url = $isUserHost ? $this->_usersUrl : $this->_oauthUrl;
        $result = $this->send($url, $data);
        $this->checkResult($result);
        return $this->arrayToObject($result['data']);
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

        return (object)$arr;
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
            "Authorization: Bearer {$this->_accessToken}",
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
    private function checkParams($param)
    {
        $arr = (array)$param;
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
     * Check the right of the options
     * @return string
     * @throws Exception
     */
    public function getAccessToken()
    {
        $param = new GetAccessTokenByAppSecretParam();

        $param->clientId = $this->options["clientId"];
        $param->secret = $this->options["secret"];

        $this->_accessToken = $this->request($param->createRequest())->getAccessTokenByAppSecret;
        return $this->_accessToken;
    }

    /**
     * Login use email
     * @param LoginParam
     * @return LoginResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function loginByEmail(LoginParam $param)
    {
        // check params is contain Specified key
        $this->checkParams($param, 'email', 'password');

        // set client id and encrypt password
        $param->registerInClient = $this->options['clientId'];
        $param->password = self::passwordEncrypt($param->password);

        return $this->request($param->createRequest());
    }

    /**
     * Login use phone
     * @param LoginParam
     * @return LoginResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function loginByPhone(LoginParam $param)
    {
        // check params is contain Specified key
        $this->checkParams($param, 'phone', 'phoneCode');

        // set client id
        $param->registerInClient = $this->options['clientId'];

        return $this->request($param->createRequest());
    }

    /**
     * Login use username
     * @param LoginParam
     * @return LoginResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function loginByUsername(LoginParam $param)
    {
        // check params is contain Specified key
        $this->checkParams($param, 'username', 'password');

        // set client id and encrypt password
        $param->registerInClient = $this->options['clientId'];
        $param->password = self::passwordEncrypt($param->password);

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
        $param->password = self::passwordEncrypt($param->password);

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
        $param->password = self::passwordEncrypt($param->password);

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
        $param->userInfo->password = self::passwordEncrypt($param->userInfo->password);

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
        $url = "https://users.authing.cn/send_smscode/$phone/{$this->options['clientId']})";
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
        $url = "https://users.authing.cn/notification/send_register_smscode/$phone/{$this->options['clientId']})";
        return $this->arrayToObject($this->send($url));
    }

    /**
     * @param SignInParam $param
     * @return SignInResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function signIn(SignInParam $param)
    {
        $this->checkParams($param, 'oidcAppId');

        $param->userPoolId = $this->options["clientId"];
        if ($param->password != null) {
            $param->password = self::passwordEncrypt($param->password);
        }

        return $this->request($param->createRequest());
    }


    /**
     * @param RefreshSignInTokenParam $param
     * @return RefreshSignInTokenResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function refreshSignInToken(RefreshSignInTokenParam $param)
    {
        $this->checkParams($param, 'refreshToken', 'oidcAppId');

        $param->userPoolId = $this->options["clientId"];

        return $this->request($param->createRequest());
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
        $param->password = self::passwordEncrypt($param->password);

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
     * @param NotBindOAuthListParam $param
     * @return NotBindOAuthListResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function userOAuthList(NotBindOAuthListParam $param)
    {
        $this->checkParams($param, 'user');

        $param->client = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param BindOtherOAuthParam $param
     * @return BindOtherOAuthResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function bindOtherOAuth(BindOtherOAuthParam $param)
    {
        $this->checkParams($param, 'user');

        $param->client = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param UnbindOtherOAuthParam $param
     * @return UnbindOtherOAuthResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function unBindOtherOAuth(UnbindOtherOAuthParam $param)
    {
        $this->checkParams($param, 'user');

        $param->client = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param SetInvitationStateParam $param
     * @return SetInvitationStateResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function setInvitationState(SetInvitationStateParam $param)
    {
        $this->checkParams($param, 'enablePhone');

        $param->client = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param QueryInvitationStateParam $param
     * @return QueryInvitationStateResponse
     * @throws Exception
     */
    public function queryInvitationState(QueryInvitationStateParam $param)
    {
        $param->client = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param AddToInvitationParam $param
     * @return AddToInvitationResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function addToInvitation(AddToInvitationParam $param)
    {
        $this->checkParams($param, 'phone');

        $param->client = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param RemoveFromInvitationParam $param
     * @return RemoveFromInvitationResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function removeFromInvitation(RemoveFromInvitationParam $param)
    {
        $this->checkParams($param, 'phone');

        $param->client = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param QueryInvitationParam $param
     * @return QueryInvitationResponse
     * @throws Exception
     */
    public function queryInvitation(QueryInvitationParam $param)
    {
        $param->client = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * 通过 _id(MFA ID) 或者 userId & UserPoolId 来查询 MFA 信息
     * @param QueryMfaParam $param
     * @return QueryMfaResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function queryMfa(QueryMfaParam $param)
    {
        $this->checkParams($param);

        $param->userPoolId = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * 通过 _id(MFA ID) 或者 userId & UserPoolId 来修改 MFA 信息
     * @param ChangeMfaParam $param
     * @return ChangeMfaResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function changeMfa(ChangeMfaParam $param)
    {
        $this->checkParams($param);

        $param->userPoolId = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param GetUserAuthorizedAppsParam $param
     * @return GetUserAuthorizedAppsResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function getUserAuthorizedApps(GetUserAuthorizedAppsParam $param)
    {
        $this->checkParams($param, 'userId');

        $param->clientId = $this->options["clientId"];

        return $this->request($param->createRequest());
    }

    /**
     * @param RevokeUserAuthorizedAppParam $param
     * @return RevokeUserAuthorizedAppResponse
     * @throws InvalidArgumentException
     * @throws Exception
     */
    public function revokeUserAuthorizedApp(RevokeUserAuthorizedAppParam $param)
    {
        $this->checkParams($param, 'userId');

        $param->userPoolId = $this->options["clientId"];

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

    /**
     *  readOAuthList
     * @param ReadOauthListParam $param
     * @return ReadOauthListResponse
     * @throws Exception
     */
    public function readOAuthList(ReadOauthListParam $param)
    {
        $param->clientId = $this->options['clientId'];

        return $this->request($param->createRequest());
    }
}
