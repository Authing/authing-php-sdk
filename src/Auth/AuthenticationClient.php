<?php

namespace Authing\Auth;

use Authing\Auth\Types;
use Authing\BaseClient;
use Authing\Mgmt\Utils;
use Authing\Types\BindEmailParam;
use Authing\Types\BindPhoneParam;
use Authing\Types\CheckLoginStatusParam;
use Authing\Types\CheckPasswordStrengthParam;
use Authing\Types\CommonMessage;
use Authing\Types\RegisterProfile;
use Authing\Types\EmailScene;
use Authing\Types\GetUserRolesParam;
use Authing\Types\JWTTokenStatus;
use Authing\Types\ListUserAuthorizedResourcesParam;
use Authing\Types\LoginByEmailInput;
use Authing\Types\LoginByEmailParam;
use Authing\Types\LoginByPhoneCodeInput;
use Authing\Types\LoginByPhoneCodeParam;
use Authing\Types\LoginByPhonePasswordInput;
use Authing\Types\LoginByPhonePasswordParam;
use Authing\Types\LoginBySubAccountParam;
use Authing\Types\LoginByUsernameInput;
use Authing\Types\LoginByUsernameParam;
use Authing\Types\RefreshToken;
use Authing\Types\RefreshTokenParam;
use Authing\Types\RegisterByEmailInput;
use Authing\Types\RegisterByEmailParam;
use Authing\Types\RegisterByPhoneCodeInput;
use Authing\Types\RegisterByPhoneCodeParam;
use Authing\Types\RegisterByUsernameInput;
use Authing\Types\RegisterByUsernameParam;
use Authing\Types\RemoveUdvParam;
use Authing\Types\ResetPasswordParam;
use Authing\Types\SendEmailParam;
use Authing\Types\SetUdvBatchParam;
use Authing\Types\SetUdvParam;
use Authing\Types\UDFTargetType;
use Authing\Types\UdvParam;
use Authing\Types\UnbindEmailParam;
use Authing\Types\UnbindPhoneParam;
use Authing\Types\UpdateEmailParam;
use Authing\Types\UpdatePasswordParam;
use Authing\Types\UpdatePhoneParam;
use Authing\Types\UpdateUserInput;
use Authing\Types\UpdateUserParam;
use Authing\Types\User;
use Authing\Types\UserDefinedData;
use Authing\Types\UserParam;


use Error;
use Exception;
use Firebase\JWT\JWT;
use GuzzleHttp\Psr7\Request;
use InvalidArgumentException;
use PhpParser\Node\Stmt\TryCatch;
use stdClass;

function formatAuthorizedResources($obj)
{
    $authorizedResources = $obj->authorizedResources;
    $list = $authorizedResources->list;
    $total = $authorizedResources->totalCount;
    array_map(function ($_) {
        foreach ($_ as $key => $value) {
            if (!$_->$key) {
                unset($_->$key);
            }
        }
        return $_;
    }, (array) $list);
    $res = new stdClass;
    $res->list = $list;
    $res->totalCount = $total;
    return $res;
}

class AuthenticationClient extends BaseClient
{
    protected $user;

    public $PasswordSecurityLevel = array("LOW" => 1, "MIDDLE" => 2, "HIGH" => 3);
    /**
     * AuthenticationClient constructor.
     * @param $userPoolId string
     * @throws InvalidArgumentException
     */
    public function __construct($userPoolIdOrFunc)
    {
        parent::__construct($userPoolIdOrFunc);
    }

    /**
     * 检测当前是否登录
     *
     * @return string userId
     * @Description
     * @example
     * @author Xintao Li
     * @since 4.2
     */
    public function checkLoggedIn()
    {
        $user = $this->getCurrentUser();
        if ($user) {
            return $user->id;
        }

        if ($this->accessToken) {
            throw new Error('请先登录！');
        }
        $tokenInfo = Utils::getTokenPlayloadData($this->accessToken);
        $userId = isset($tokenInfo->sub) ? $tokenInfo->sub : ($tokenInfo->data ? $tokenInfo->data->id : '');
        if ($userId) {
            throw new Error('不合法的 accessToken');
        }
        return $userId;
    }

    /**
     * 设置 Token
     *
     * @param string $accessToken JWT Token
     * @return void
     * @Description
     * 使用自己的 token 作为请求的 token，该 token 的相关管理由用户自己处理
     * @example
     * @author Xintao Li
     * @since 4.2
     */
    public function setToken($accessToken)
    {
        parent::setAccessToken($accessToken);
    }

    /**
     * 设置 Mfa token
     *
     * @param string $token MfaToken
     * @return void
     * @Description
     * @example
     * @author Xintao Li
     * @since 4.2
     */
    public function setMfaAuthorizationHeader($token)
    {
        $this->mfaToken = $token;
    }

    /**
     * 获取当前设置的 mfaToken
     *
     * @return string mfaToken MfaToken
     * @Description
     * @example
     * @author Xintao Li
     * @since 4.2
     */
    public function getMfaAuthorizationHeader()
    {
        return $this->mfaToken;
    }

    /**
     * 清空当前 mfaToken
     *
     * @return void
     * @Description
     * @example
     * @author Xintao Li
     * @since 4.2
     */
    public function clearMfaAuthorizationHeader()
    {
        $this->mfaToken = "";
    }

    /**
     * 获取当前用户
     *
     * @return User user 当前用户
     * @Description
     * @example
     * @author Xintao Li
     * @since 4.2
     */
    public function getCurrentUser()
    {
        $hasError = false;
        $param = new UserParam();
        try {
            $user = $this->request($param->createRequest());
        } catch (\Throwable $th) {
            $hasError = true;
        }
        if ($hasError) {
            return null;
        }
        $this->accessToken = $user->token ?: $this->accessToken;
        $this->user = $user;
        return $user;
    }

    /**
     * 设置当前用户
     *
     * @return User
     * @throws Exception
     * @param object $user
     */
    public function setCurrentUser($user)
    {
        $this->user = $user;
        $this->accessToken = $user->token;
    }

    /**
     * 通过邮箱密码注册
     *
     * @param $input RegisterByEmailInput
     * @return User
     * @throws Exception
     */
    public function registerByEmail($email, $password, $profile = null, array $options = [])
    {
        extract($options);
        $password = $this->encrypt($password);
        $input = (new RegisterByEmailInput($email, $password))
            ->withProfile(isset($profile) ? $profile : null)
            ->withClientIp(isset($clientIp) ? $clientIp : null)
            ->withContext(isset($context) ? $context : null)
            ->withGenerateToken(isset($generateToken) ? $generateToken : null)
            ->withParams(isset($params) ? $params : null)
            ->withForceLogin(isset($forceLogin) ? $forceLogin : null);
        $param = new RegisterByEmailParam($input);
        $user = $this->request($param->createRequest());
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * 通过用户名密码注册
     *
     * @param $input RegisterByUsernameInput
     * @return User
     * @throws Exception
     */
    public function registerByUsername($username, $password, $profile = null, array $options = [])
    {
        extract($options);
        $password = $this->encrypt($password);
        $input = (new RegisterByUsernameInput($username, $password))
            ->withProfile(isset($profile) ? $profile : null)
            ->withClientIp(isset($clientIp) ? $clientIp : null)
            ->withContext(isset($context) ? $context : null)
            ->withGenerateToken(isset($generateToken) ? $generateToken : null)
            ->withParams(isset($params) ? $params : null)
            ->withForceLogin(isset($forceLogin) ? $forceLogin : null);
        $param = new RegisterByUsernameParam($input);
        $user = $this->request($param->createRequest());
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * 通过手机号验证码注册
     *
     * @param $input RegisterByPhoneCodeInput
     * @return User
     * @throws Exception
     */
    public function registerByPhoneCode(
        $username,
        $code,
        $password = '',
        $profile = null,
        array $options = []
    ) {
        extract($options);
        $password = $this->encrypt($password);
        $input = (new RegisterByPhoneCodeInput($username, $code))
            ->withPassword(isset($password) ? $password : null)
            ->withProfile(isset($profile) ? $profile : null)
            ->withClientIp(isset($clientIp) ? $clientIp : null)
            ->withContext(isset($context) ? $context : null)
            ->withGenerateToken(isset($generateToken) ? $generateToken : null)
            ->withParams(isset($params) ? $params : null)
            ->withForceLogin(isset($forceLogin) ? $forceLogin : null);

        $param = new RegisterByPhoneCodeParam($input);
        $user = $this->request($param->createRequest());
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * 发送手机验证码
     *
     * @param $phone
     * @return object
     * @throws Exception
     */
    /**
     * 发送手机验证码
     *
     * @param [type] $phone
     * @return \Authing\Auth\SimpleMessage
     * @Description
     * @example
     * @throws
     * @version ${4.2.0}
     * @author Xintao Li -- lixintao2@authing.cn
     * @since 4.2.0
     */
    public function sendSmsCode($phone)
    {
        $res = $this->httpPost("/api/v2/sms/send", [
            "phone" => $phone,
        ]);
        $simpleMessage = new SimpleMessage();
        $simpleMessage->code = $res->code;
        $simpleMessage->message = $res->message;
        return $simpleMessage;
    }

    /**
     * 通过邮箱登录
     *
     * @param $input LoginByEmailInput
     * @return User
     * @throws Exception
     */
    public function loginByEmail($email, $password, array $options = [])
    {
        extract($options);
        $password = $this->encrypt($password);
        $input = (new LoginByEmailInput($email, $password))
            ->withClientIp(isset($clientIp) ? $clientIp : null)
            ->withContext(isset($context) ? $context : null)
            ->withParams(isset($params) ? $params : null)
            ->withAutoRegister(isset($autoRegister) ? $autoRegister : null)
            ->withCaptchaCode(isset($captchaCode) ? $captchaCode : null);
        $param = new LoginByEmailParam($input);
        $user = $this->request($param->createRequest());
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * 通过用户名密码登录
     *
     * @param $input LoginByUsernameInput
     * @return User
     * @throws Exception
     */
    public function loginByUsername($username, $password, array $options = [])
    {
        extract($options);
        $password = $this->encrypt($password);
        $input = (new LoginByUsernameInput($username, $password))
            ->withClientIp(isset($clientIp) ? $clientIp : null)
            ->withContext(isset($context) ? $context : null)
            ->withParams(isset($params) ? $params : null)
            ->withAutoRegister(isset($autoRegister) ? $autoRegister : null)
            ->withCaptchaCode(isset($captchaCode) ? $captchaCode : null);

        $param = new LoginByUsernameParam($input);
        $user = $this->request($param->createRequest());
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * 通过手机号验证码登录
     *
     * @param $input LoginByPhoneCodeInput
     * @return User
     * @throws Exception
     */
    public function loginByPhoneCode($phone, $code, array $options = [])
    {
        extract($options);
        $input = (new LoginByPhoneCodeInput($phone, $code))
            ->withClientIp(isset($clientIp) ? $clientIp : null)
            ->withContext(isset($context) ? $context : null)
            ->withParams(isset($params) ? $params : null)
            ->withAutoRegister(isset($autoRegister) ? $autoRegister : null);
        $param = new LoginByPhoneCodeParam($input);
        $user = $this->request($param->createRequest());
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * 通过手机号密码登录
     *
     * @param $input LoginByPhonePasswordInput
     * @return User
     * @throws Exception
     */
    public function loginByPhonePassword($phone, $password, array $options = [])
    {
        extract($options);
        $password = $this->encrypt($password);
        $input = (new LoginByPhonePasswordInput($phone, $password))
            ->withClientIp(isset($clientIp) ? $clientIp : null)
            ->withContext(isset($context) ? $context : null)
            ->withParams(isset($params) ? $params : null)
            ->withAutoRegister(isset($autoRegister) ? $autoRegister : false)
            ->withCaptchaCode(isset($captchaCode) ? $captchaCode : null);

        $param = new LoginByPhonePasswordParam($input);
        $user = $this->request($param->createRequest());
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * @param string $account
     * @param string $password
     */
    public function loginBySubAccount($account, $password, array $options = [])
    {
        list($captchaCode, $clientIp) = $options;
        // build getPublicKey
        // $password = $this->options->encryptFunction($password, getPublicKey());
        $params = (new LoginBySubAccountParam($account, $password))->withCaptchaCode($captchaCode)->withClientIp($clientIp);
        $user = $this->request($params->createRequest());
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * 检查登录状态
     *
     * @param string $token
     * @return JWTTokenStatus
     * @throws Exception
     */
    public function checkLoginStatus($token = null)
    {
        $param = (new CheckLoginStatusParam())->withToken($token);
        return $this->request($param->createRequest());
    }

    /**
     * 发送邮件
     *
     * @param $email string 邮箱
     * @param $scene EmailScene 邮件类型
     * @return CommonMessage
     * @throws Exception
     */
    public function sendEmail($email, $scene)
    {
        $param = new SendEmailParam($email, $scene);
        return $this->request($param->createRequest());
    }

    /**
     * 通过手机号验证码重置密码
     *
     * @param $phone string 手机号
     * @param $code string 手机号验证码
     * @param $newPassword string 新密码
     * @return CommonMessage
     * @throws Exception
     */
    public function resetPasswordByPhoneCode($phone, $code, $newPassword)
    {
        $newPassword = $this->encrypt($newPassword);
        $param = (new ResetPasswordParam($code, $newPassword))->withPhone($phone);
        return $this->request($param->createRequest());
    }

    /**
     * 通过邮箱验证码重置密码
     *
     * @param $email string 邮箱
     * @param $code string 邮箱验证码
     * @param $newPassword string 新密码
     * @return CommonMessage
     * @throws Exception
     */
    public function resetPasswordByEmailCode($email, $code, $newPassword)
    {
        $newPassword = $this->encrypt($newPassword);
        $param = (new ResetPasswordParam($code, $newPassword))->withEmail($email);
        return $this->request($param->createRequest());
    }

    /**
     * 更新用户资料
     *
     * @param $input UpdateUserInput
     * @return User
     * @throws Exception
     */
    public function updateProfile($input)
    {
        $user = $this->getCurrentUser();
        if ($input->password) {
            unset($input->password);
        }
        $param = (new UpdateUserParam($input))->withId($user->id);
        $user = $this->request($param->createRequest());
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * 更新密码
     *
     * @param $newPassword string 新密码
     * @param $oldPassword string 旧密码
     * @return User
     * @throws Exception
     */
    public function updatePassword($newPassword, $oldPassword)
    {
        $newPassword = $this->encrypt($newPassword);
        $oldPassword = $this->encrypt($oldPassword);
        $param = (new UpdatePasswordParam($newPassword))->withOldPassword($oldPassword);
        $user = $this->request($param->createRequest());
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * 更新手机号
     *
     * @param $phone string 手机号
     * @param $phoneCode string 手机号验证码
     * @param $oldPhone string 旧手机号
     * @param $oldPhoneCode string 旧手机号验证码
     * @return User
     * @throws Exception
     */
    public function updatePhone($phone, $phoneCode, $oldPhone = null, $oldPhoneCode = null)
    {
        $param = (new UpdatePhoneParam($phone, $phoneCode))->withOldPhone($oldPhone)->withOldPhoneCode($oldPhoneCode);
        $user = $this->request($param->createRequest());
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * 更新邮箱
     *
     * @param $email string 邮箱
     * @param $emailCode string 邮箱验证码
     * @param $oldEmail string 旧邮箱
     * @param $oldEmailCode string 旧邮箱验证码
     * @return User
     * @throws Exception
     */
    public function updateEmail($email, $emailCode, $oldEmail = null, $oldEmailCode = null)
    {
        $param = (new UpdateEmailParam($email, $emailCode))->withOldEmail($oldEmail)->withOldEmailCode($oldEmailCode);
        $user = $this->request($param->createRequest());
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * 刷新 access token
     *
     * @return RefreshToken
     * @throws Exception
     */
    public function refreshToken()
    {
        $param = new RefreshTokenParam();
        return $this->request($param->createRequest());
    }

    /**
     * 绑定手机号
     *
     * @param $phone string 手机号
     * @param $phoneCode string 手机号验证码
     * @return User
     * @throws Exception
     */
    public function bindPhone($phone, $phoneCode)
    {
        $param = new BindPhoneParam($phone, $phoneCode);
        $user = $this->request($param->createRequest());
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * 解绑定手机号
     *
     * @return User
     * @throws Exception
     */
    public function unBindPhone()
    {
        $param = new UnbindPhoneParam();
        $user = $this->request($param->createRequest());
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * 注销
     *
     * @throws Exception
     */
    public function logout()
    {
        $appId = $this->options->appId;
        $this->httpGet("/api/v2/logout?app_id=$appId");
        $this->accessToken = '';
    }

    /**
     * 获取当前用户的自定义数据列表
     *
     * @return UserDefinedData[]
     * @throws Exception
     */
    public function listUdv()
    {
        $user = $this->getCurrentUser();
        $param = new UdvParam(UdfTargetType::USER, $user->id);
        $res = $this->request($param->createRequest());
        return Utils::convertUdv((array)$res);
    }

    /**
     * 添加自定义数据
     *
     * @param $key string 自定义字段 key
     * @param $value string 自定义字段值
     * @return CommonMessage
     * @throws Exception
     */
    public function setUdv($key, $value)
    {
        $user = $this->getCurrentUser();
        $param = new SetUdvParam(UdfTargetType::USER, $user->id, $key, json_encode($value));
        return $this->request($param->createRequest());
    }

    /**
     * 删除自定义数据
     * -
     *
     * @param $key string 自定义字段 key
     * @return CommonMessage
     * @throws Exception
     */
    public function removeUdv($key)
    {
        $user = $this->getCurrentUser();
        $param = new RemoveUdvParam(UdfTargetType::USER, $user->id, $key);
        return $this->request($param->createRequest());
    }

    /**
     * 检查密码强度
     *
     * @param  $password string 需要检测的字符串
     * @return void
     */
    public function checkPasswordStrength($password)
    {
        if (!isset($password)) {
            throw new Exception("不允许为空");
        }
        $param = new CheckPasswordStrengthParam($password);
        return $this->request($param->createRequest());
    }

    // 不实现
    public function updateAvatar($src)
    {
        if (!isset($set)) {
            throw new Exception("请输入需要修改的数据");
        } else {
            $id = $this->user->id;
            if ($id) {
            } else {
                throw new Exception("未登录，请登录");
            }
        }
    }

    public function linkAccount($options)
    {
        if (!isset($options)) {
            throw new Exception("请输入需要修改的数据");
        }
        $data = new \stdClass;
        $data->primaryUserToken = $options->primaryUserToken;
        $data->secondaryUserToken = $options->secondaryUserToken;
        $res = $this->httpPost("/api/v2/users/link", $data);
        return $res;
    }

    public function unLinkAccount(array $options)
    {
        $api = '/api/v2/users/unlink';
        $req = new Request('POST', $api, [
            'body' => [
                'primaryUserToken' => $options['primaryUserToken'],
                'provider' => $options['provider'],
            ],
        ]);
        $tokenSet = $this->httpSend($req);
        return (object) [
            'code' => 200,
            'message' => '解绑成功',
        ];
    }

    public function listOrgs()
    {
        return $this->httpGet('/api/v2/users/me/orgs');
    }

    public function loginByLdap($username, $password)
    {
        if (!isset($username, $password)) {
            throw new Exception("请输入必要的参数");
        } else {
            if (!isset($options)) {
                $options = new stdClass;
            }
            $_ = new stdClass();
            $_->username = $username;
            $_->password = $password;
            $user = $this->httpPost('/api/v2/ldap/verify-user', $_);
            $this->setAccessToken($user->$user->token ?: $this->accessToken);
            return $user;
        }
    }

    public function loginByAd($username, $password)
    {
        $hostName = parse_url($this->options['host']);
        if (!$hostName) {
            throw new Exception("非法 域名");
        } else {
            $hostName = $hostName['host'];
        }
        $firstLevelDomain = array_slice(explode(".", $hostName), 1);
        $websocketHost = $this->options["websocketHost"] || `https://ws.$firstLevelDomain`;
        $api = $websocketHost . "/api/v2/ad/verify-user";
        $_ = new stdClass;
        $_->username = $username;
        $_->password = $password;
        $user = $this->httpPost($api, $_, true);
        $this->setAccessToken($user->$user->token ?: $this->accessToken);
        return $user;
    }

    public function uploadPhoto()
    {
    }

    public function uploadAvatar()
    {
    }

    public function getUdfValue()
    {
        $userId = $this->checkLoggedIn();
        $params = new UdvParam(UDFTargetType::USER, $userId);
        $res = $this->request($params->createRequest());
        return Utils::convertUdvToKeyValuePair((array)$res);
    }

    public function computedPasswordSecurityLevel($password)
    {
        if (!isset($password) && !is_string($password)) {
            throw new Exception("请输入字符串");
        }
        $highLevel = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[^]{12,}$/g";
        $middleLevel = "/^(?=.*[a-zA-Z])(?=.*\d)[^]{8,}$/g";
        if (preg_match_all($middleLevel, $password)) {
            return $this->PasswordSecurityLevel['HIGH'];
        }
        if (preg_match_all($highLevel, $password)) {
            return $this->PasswordSecurityLevel['MIDDLE'];
        }
        return $this->PasswordSecurityLevel['LOW'];
    }

    public function getSecurityLevel()
    {
        $res = $this->httpGet('/api/v2/users/me/security-level');
        return $res;
    }

    public function listAuthorizedResources($namespace, $opts = [])
    {
        $resourceType = null;
        if (count($opts) > 0) {
            $resourceType = $opts['resourceType'];
        }
        $user = $this->getCurrentUser();
        if (!$user) {
            throw new Exception("未登录，请登录");
        }
        if (!isset($namespace) && !is_string($namespace)) {
            throw new Exception("namespace 为必填");
        }
        $param = (new ListUserAuthorizedResourcesParam($user->id))->withNamespace($namespace)->withResourceType($resourceType);
        return formatAuthorizedResources($this->request($param->createRequest()));
    }

    public function _generateTokenRequest($params)
    {
        $p = http_build_query($params);
        return $p;
    }

    /**
     * @param string $code
     * @param string $codeVerifier
     */
    public function _getAccessTokenByCodeWithClientSecretPost($code, $codeVerifier = '')
    {
        $data = $this->_generateTokenRequest([
            'client_id' => $this->options->appId,
            'client_secret' => $this->options->secret,
            'grant_type' => 'authorization_code',
            'code' => $code,
            'redirect_uri' => $this->options->redirectUri,
            'code_verifier' => $codeVerifier
        ]);
        $api = '';
        if ($this->options->protocol === 'oidc') {
            $api = '/oidc/token';
        } elseif ($this->options->protocol === 'oauth') {
            $api = '/oauth/token';
        }
        $res = $this->httpRequest('POST', $api, [
            'body' => $data,
            'headers' => array_merge(
                $this->getOidcHeaders(),
                [
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ]
            ),
        ]);
        // $body =
        //     $res->getBody();
        $stringBody = (string) $res;
        return json_decode($stringBody);
    }

    /**
     * @param string $appId
     * @param string $secret
     */
    public function _generateBasicAuthToken($appId = "", $secret = "")
    {
        if ($appId) {
            $id = $appId;
        } else {
            $id = $this->options->appId;
        }
        if ($secret) {
            $secret = $secret;
        } else {
            $secret = $this->options->secret;
        }
        $token = 'Basic ' . base64_encode($id . ":" . $secret);
        return $token;
    }

    /**
     * @param string $code
     * @param string $codeVerifier
     */
    public function _getAccessTokenByCodeWithClientSecretBasic($code, $codeVerifier = null)
    {
        $api = '';
        if ($this->options->protocol === 'oidc') {
            $api = '/oidc/token';
        } elseif ($this->options->protocol === 'oauth') {
            $api = '/oauth/token';
        }
        $qstr = $this->_generateTokenRequest(
            [
                'client_id' => $this->options->appId,
                'grant_type' => 'authorization_code',
                'code' => $code,
                'redirect_uri' => $this->options->redirectUri,
                'code_verifier' => $codeVerifier
            ]
        );
        // $qstr =
        //     [
        //         // 'client_id' => $this->options->appId,
        //         'grant_type' => 'authorization_code',
        //         'code' => $code,
        //         'redirect_uri' => $this->options->redirectUri,
        //         'code_verifier' => $codeVerifier
        //     ];
        $response = $this->httpRequest('POST', $api, [
            "headers" =>
            array_merge($this->getOidcHeaders(), [
                "Authorization" => $this->_generateBasicAuthToken(),
                'Content-Type' => 'application/x-www-form-urlencoded',
            ]),
            "body" => $qstr,
        ]);
        // $body =
        //     $response->getBody();
        $stringBody = (string) $response;
        return json_decode($stringBody);
    }

    /**
     * @param string $code
     * @param string $codeVerifier
     */
    public function _getAccessTokenByCodeWithNone($code, $codeVerifier = '')
    {
        $api = '';
        if ($this->options->protocol === 'oidc') {
            $api = '/oidc/token';
        } elseif ($this->options->protocol === 'oauth') {
            $api = '/oauth/token';
        }
        $qstr = $this->_generateTokenRequest(
            [
                "client_id" => $this->options->appId,
                "grant_type" =>
                'authorization_code',
                "code" => $code,
                "client_secret" => $this->options->secret,
                "redirect_uri" => $this->options->redirectUri,
                'code_verifier' => $codeVerifier
            ]
        );
        $response = $this->httpRequest("POST", $api, [
            "body" => $qstr,
            "headers" =>
            array_merge($this->getOidcHeaders(), [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ]),
        ]);
        // $body =
        //     $response->getBody();
        $stringBody = (string) $response;
        return json_decode($stringBody);
    }

    /**
     * @param string $code
     */
    public function getAccessTokenByCode($code, array $options = [])
    {
        if (
            (!isset($this->options->secret) ||
                !isset($this->options->tokenEndPointAuthMethod)) ||
            (!$this->options->secret &&
                $this->options->tokenEndPointAuthMethod !== 'none')
        ) {
            throw new Error('请在初始化 AuthenticationClient 时传入 appId 和 secret 参数');
        }
        if (isset($this->options->tokenEndPointAuthMethod) && $this->options->tokenEndPointAuthMethod === 'client_secret_post') {
            return $this->_getAccessTokenByCodeWithClientSecretPost($code, isset($options['codeVerifier']) ? $options['codeVerifier'] : '');
        }
        if (isset($this->options->tokenEndPointAuthMethod) && $this->options->tokenEndPointAuthMethod === 'client_secret_basic') {
            return $this->_getAccessTokenByCodeWithClientSecretBasic($code, isset($options['codeVerifier']) ? $options['codeVerifier'] : '');
        }
        if (isset($this->options->tokenEndPointAuthMethod) && $this->options->tokenEndPointAuthMethod === 'none') {
            return $this->_getAccessTokenByCodeWithNone($code, isset($options['codeVerifier']) ? $options['codeVerifier'] : '');
        }
    }

    public function generateCodeChallenge()
    {
        return Utils::randomString(43);
    }

    public function getCodeChallengeDigest(array $options)
    {
        if (empty($options)) {
            throw new Error(
                '请提供 options 参数，options.codeChallenge 为一个长度大于等于 43 的字符串，options.method 可选值为 S256、plain'
            );
        }
        if (empty($options['codeChallenge'])) {
            throw new Error(
                '请提供 options.codeChallenge，值为一个长度大于等于 43 的字符串'
            );
        }
        $method = isset($options['method']) ? $options['method'] : 'S256';
        if ($method === 'S256') {
            // url safe base64
            // + -> -
            // / -> _
            // = -> ''
            $str = base64_encode(hash("sha256", $options['codeChallenge']));
            str_replace('+', '-', $str);
            str_replace('/', '_', $str);
            str_replace('=', '', $str);
            return $str;
            // return sha256(options.codeChallenge).toString(CryptoJS.enc.Base64).replace(/\+/g, '-').replace(/\//g, '_').replace(/=/g, '');
        }
        if ($method === 'plain') {
            return $options['codeChallenge'];
        }
        throw new Error('不支持的 options.method，可选值为 S256、plain');
    }

    /**
     * @param string $scope
     */
    public function getAccessTokenByClientCredentials($scope, array $options)
    {
        if (!isset($scope) || $scope) {
            throw new Error(
                '请传入 scope 参数，请看文档：https://docs.authing.cn/v2/guides/authorization/m2m-authz.html'
            );
        }
        if (count($options) === 0) {
            throw new Error(
                '请在调用本方法时传入 { accessKey: string, accessSecret: string }，请看文档：https://docs.authing.cn/v2/guides/authorization/m2m-authz.html'
                // '请在初始化 AuthenticationClient 时传入 appId 和 secret 参数或者在调用本方法时传入 { accessKey: string, accessSecret: string }，请看文档：https://docs.authing.cn/v2/guides/authorization/m2m-authz.html'
            );
        }
        $this->options->accessKey
            ? $accessKey = $this->options->accessKey : $accessKey = $this->options->appId;
        $this->options->accessSecret
            ? $accessSecret = $this->options->accessSecret : $accessSecret = $this->options->secret;
        $qstr = $this->_generateTokenRequest([
            "client_id" => $accessKey,
            "client_secret" => $accessSecret,
            "grant_type" => 'client_credentials',
            "scope" => $scope,
        ]);
        $api = '';
        if ($this->options->protocol === 'oidc') {
            $api = '/oidc/token';
        } elseif ($this->options->protocol === 'oauth') {
            $api = '/oauth/token';
        }
        $response = $this->httpRequest('POST', $api, [
            "body" => $qstr,
            "headers" => array_merge(
                $this->getOidcHeaders(),
                [
                    "Content-Type" => 'application/x-www-form-urlencoded',
                ]
            ),
        ]);
        // $body =
        //     $response->getBody();
        $stringBody = (string) $response;
        return json_decode($stringBody);
    }

    public function buildAuthorizeUrl(array $options)
    {
        if (!isset($this->options->appHost)) {
            throw new Error(
                '请在初始化 AuthenticationClient 时传入应用域名 appHost 参数，形如：https://app1.authing.cn'
            );
        }
        if ($this->options->protocol === 'oidc') {
            return $this->_buildOidcAuthorizeUrl($options);
        }
        if ($this->options->protocol === 'oauth') {
            return $this->_buildOauthAuthorizeUrl($options);
        }
        if ($this->options->protocol === 'saml') {
            return $this->_buildSamlAuthorizeUrl();
        }
        if ($this->options->protocol === 'cas') {
            return $this->_buildCasAuthorizeUrl($options);
        }
        throw new Error(
            '不支持的协议类型，请在初始化 AuthenticationClient 时传入 protocol 参数，可选值为 oidc、oauth、saml、cas'
        );
    }

    public function _buildOidcAuthorizeUrl(array $options)
    {
        $map = [
            'appId' => 'client_id',
            'scope' => 'scope',
            'state' => 'state',
            'nonce' => 'nonce',
            'responseMode' => 'response_mode',
            'responseType' => 'response_type',
            'redirectUri' => 'redirect_uri',
            'codeChallenge' => 'code_challenge',
            'codeChallengeMethod' => 'code_challenge_method'
        ];
        $res = [
            'nonce' => substr(rand(0, 1) . '', 0, 2),
            'state' => substr(rand(0, 1) . '', 0, 2),
            'scope' => 'openid profile email phone address',
            'client_id' => $this->options->appId,
            'response_mode' => 'query',
            'redirect_uri' => $this->options->redirectUri,
            'response_type' => 'code',
        ];
        foreach ($map as $key => $value) {
            if (isset($options) && isset($options[$key]) && $options[$key]) {
                if ($key === 'scope' && strpos($options['scope'], 'offline_access')) {
                    $res['prompt'] = 'consent';
                }
                $res[$value] = $options[$key];
            }
        }
        $params = http_build_query($res);
        $authorizeUrl = $this->options->appHost . '/oidc/auth?' . $params;
        return $authorizeUrl;
    }

    public function _buildOauthAuthorizeUrl(array $options)
    {
        $map = [
            'appId' => 'client_id',
            'scope' => 'scope',
            'state' => 'state',
            'responseType' => 'response_type',
            'redirectUri' => 'redirect_uri'
        ];
        $res = [
            'state' => substr(rand(0, 1) . '', 0, 2),
            'scope' => 'user',
            'client_id' => $this->options->appId,
            'redirect_uri' => $this->options->redirectUri,
            'response_type' => 'code'
        ];
        foreach ($map as $key => $value) {
            if (isset($options) && $options[$key]) {
                $res[$value] = $options[$key];
            }
        }
        $params = http_build_query($res);
        $authorizeUrl = $this->options->appHost . '/oauth/auth?' . $params;
        return $authorizeUrl;
    }

    public function _buildSamlAuthorizeUrl()
    {
        return $this->options->appHost . '/saml-idp/' . $this->options->appId;
    }

    public function _buildCasAuthorizeUrl(array $options)
    {
        if (isset($options['service'])) {
            return $this->options->appHost . '/cas-idp/' . $this->options->appId . '?service=' . $options['service'];
        }
        return $this->options->appHost . '/cas-idp' . $this->options->appId;
    }

    public function _buildCasLogoutUrl(array $options)
    {
        if (isset($options['redirectUri'])) {
            return $this->options->appHost . '/cas-idp/logout?url=' . $options['redirectUri'];
        }
        return $this->options->appHost . '/cas-idp/logout';
    }

    public function _buildOidcLogoutUrl(array $options)
    {
        if (isset($options) && !($options['inToken'] && $options['redirectUri'])) {
            throw new Error(
                '必须同时传入 idToken 和 redirectUri 参数，或者同时都不传入'
            );
        }
        if ($options['redirectUri']) {
            return $this->options->appHost . '/oidc/session/end?id_token_hint=' . $options['idToken'] . '&post_logout_redirect_uri=' . $options['redirectUri'];
        }
        return $this->options->appHost . '/oidc/session/end';
    }

    public function _buildEasyLogoutUrl(array $options)
    {
        if ($options['redirectUri']) {
            return $this->options->appHost . '/login/profile/logout?redirect_uri=' . $options['redirectUri'];
        }
        return $this->options->appHost . '/login/profile/logout';
    }

    public function buildLogoutUrl(array $options)
    {
        if ($this->options->protocol === 'cas') {
            return $this->_buildCasLogoutUrl($options);
        }
        if ($this->options->protocol === 'oidc' && isset($options['expert'])) {
            return $this->_buildOidcLogoutUrl($options);
        }
        return $this->_buildEasyLogoutUrl($options);
    }

    /**
     * @param string $accessToken
     */
    public function getUserInfoByAccessToken($accessToken)
    {
        $api = '';
        if ($this->options->protocol === 'oidc') {
            $api = '/oidc/me';
        } elseif ($this->options->protocol === 'oauth') {
            $api = '/oauth/me';
        }
        $response = $this->httpRequest("POST", $api, [
            'headers' => array_merge(
                $this->getOidcHeaders(),
                [
                    'Authorization' => 'Bearer ' . $accessToken,
                ]
            ),
        ]);
        // $body =
        //     $response->getBody();
        $stringBody = (string) $response;
        return json_decode($stringBody);
    }

    public function getOidcHeaders()
    {
        $SDK_VERSION = "4.1.12";
        return [
            'x-authing-sdk-version' => 'php:' . $SDK_VERSION,
            'x-authing-userpool-id' => (isset($this->options->userPoolId) ? $this->options->userPoolId : ""),
            'x-authing-request-from' => (isset($this->options->requestFrom) ? $this->options->requestFrom : 'sdk'),
            'x-authing-app-id' => (isset($this->options->appId) ? $this->options->appId : ''),
        ];
    }

    /**
     * @param string $refreshToken
     */
    public function _getNewAccessTokenByRefreshTokenWithClientSecretPost($refreshToken)
    {
        $api = '';
        if ($this->options->protocol === 'oidc') {
            $api = '/oidc/token';
        } elseif ($this->options->protocol === 'oauth') {
            $api = '/oauth/token';
        }
        $qstr = $this->_generateTokenRequest([
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        ]);
        $req = new Request('POST', $api, [
            'body' => $qstr,
            'headers' =>
            [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);

        $tokenSet = $this->httpSend($req);
        return $tokenSet;
    }

    /**
     * @param string $refreshToken
     */
    function _getNewAccessTokenByRefreshTokenWithClientSecretBasic($refreshToken)
    {
        $api = '';
        if ($this->options->protocol === 'oidc') {
            $api = '/oidc/token';
        } elseif ($this->options->protocol === 'oauth') {
            $api = '/oauth/token';
        }
        $qstr = $this->_generateTokenRequest([
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        ]);
        $req = new Request('POST', $api, [
            'body' => $qstr,
            'headers' =>
            [
                'Authorization' => $this->_generateBasicAuthToken(),
            ],
        ]);

        $tokenSet = $this->httpSend($req);
        return $tokenSet;
    }

    /**
     * @param string $refreshToken
     */
    function _getNewAccessTokenByRefreshTokenWithNone($refreshToken)
    {
        $api = '';
        if ($this->options->protocol === 'oidc') {
            $api = '/oidc/token';
        } elseif ($this->options->protocol === 'oauth') {
            $api = '/oauth/token';
        }
        $qstr = $this->_generateTokenRequest([
            'client_id' => $this->options->appId,
            'grant_type' => 'refresh_token',
            'refresh_token' => $refreshToken,
        ]);
        echo $qstr;
        $req = new Request('POST', $api, [
            'body' => $qstr,
        ]);

        $tokenSet = $this->httpSend($req);
        return $tokenSet;
    }

    /**
     * @param string $refreshToken
     */
    public function getNewAccessTokenByRefreshToken($refreshToken)
    {
        if (!in_array($this->options->protocol, ['oauth', 'oidc'])) {
            throw new Error(
                '初始化 AuthenticationClient 时传入的 protocol 参数必须为 oauth 或 oidc，请检查参数'
            );
        }
        if (!isset($this->options->secret) && $this->options->introspectionEndPointAuthMethod !== 'none') {
            throw new Error(
                '请在初始化 AuthenticationClient 时传入 appId 和 secret 参数'
            );
        }
        if ($this->options->tokenEndPointAuthMethod === 'client_secret_post') {
            $res = $this->_getNewAccessTokenByRefreshTokenWithClientSecretPost($refreshToken);
            return $res;
        }
        if ($this->options->tokenEndPointAuthMethod === 'none') {
            echo '+++++' . $refreshToken;
            $res = $this->_getNewAccessTokenByRefreshTokenWithNone($refreshToken);
            return $res;
        }
        if ($this->options->tokenEndPointAuthMethod === 'client_secret_basic') {
            $res = $this->_getNewAccessTokenByRefreshTokenWithClientSecretBasic($refreshToken);
            return $res;
        }
    }

    /**
     * @param string $token
     */
    public function _introspectTokenWithClientSecretPost($token)
    {
        $qstr = $this->_generateTokenRequest([
            'client_id' => $this->options->appId,
            'client_secret' => $this->options->secret,
            'token' => $token,
        ]);
        $api = '';
        if ($this->options->protocol === 'oidc') {
            $api = '/oidc/token/introspection';
        } elseif ($this->options->protocol === 'oauth') {
            $api = '/oauth/token/introspection';
        }
        $req = new Request('POST', $api, [
            'body' => $qstr,
            'headers' =>
            [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);
        $tokenSet = $this->httpSend($req);
        return $tokenSet;
    }

    /**
     * @param string $token
     */
    public function _introspectTokenWithClientSecretBasic($token)
    {
        $qstr = $this->_generateTokenRequest([
            'token' => $token,
        ]);
        $api = '';
        if ($this->options->protocol === 'oidc') {
            $api = '/oidc/token/introspection';
        } elseif ($this->options->protocol === 'oauth') {
            $api = '/oauth/token/introspection';
        }
        $req = new Request('POST', $api, [
            'body' => $qstr,
            'headers' =>
            [
                'Authorization' => $this->_generateBasicAuthToken(),
            ],
        ]);
        $tokenSet = $this->httpSend($req);
        return $tokenSet;
    }

    /**
     * @param string $token
     */
    public function _introspectTokenWithNone($token)
    {
        $qstr = $this->_generateTokenRequest([
            'client_id' => $this->options->appId,
            'token' => $token,
        ]);
        $api = '';
        if ($this->options->protocol === 'oidc') {
            $api = '/oidc/token/introspection';
        } elseif ($this->options->protocol === 'oauth') {
            $api = '/oauth/token/introspection';
        }
        $req = new Request('POST', $api, [
            'body' => $qstr,
        ]);
        $tokenSet = $this->httpSend($req);
        return $tokenSet;
    }

    /**
     * @param string $token
     */
    public function introspectToken($token)
    {
        if (!in_array($this->options->protocol, ['oauth', 'oidc'])) {
            throw new Error(
                '初始化 AuthenticationClient 时传入的 protocol 参数必须为 oauth 或 oidc，请检查参数'
            );
        }
        if (!isset($this->options->secret) && $this->options->introspectionEndPointAuthMethod !== 'none') {
            throw new Error(
                '请在初始化 AuthenticationClient 时传入 appId 和 secret 参数'
            );
        }
        if ($this->options->introspectionEndPointAuthMethod === 'client_secret_post') {
            $res = $this->_introspectTokenWithClientSecretPost($token);
            return $res;
        }
        if ($this->options->introspectionEndPointAuthMethod === 'none') {
            $res = $this->_introspectTokenWithNone($token);
            return $res;
        }
        if ($this->options->introspectionEndPointAuthMethod === 'client_secret_basic') {
            $res = $this->_introspectTokenWithClientSecretBasic($token);
            return $res;
        }
        throw new Error(
            '初始化 AuthenticationClient 时传入的 introspectionEndPointAuthMethod 参数可选值为 client_secret_base、client_secret_post、none，请检查参数'
        );
    }

    public function listApplications(array $params = [])
    {
        $page = isset($params['page']) ? $params['page'] : 1;
        $limit = isset($params['limit']) ? $params['limit'] : 10;
        $data = $this->httpGet("/api/v2/users/me/applications/allowed?page=$page&limit=$limit");
        return $data;
    }

    /**
     * @param string $email
     * @param string $emailCode
     */
    public function bindEmail($email, $emailCode)
    {
        $param = new BindEmailParam($email, $emailCode);
        return $this->request($param->createRequest());
    }

    /**
     * @param string $token
     */
    public function revokeToken($token)
    {
        if (!in_array($this->options->protocol, ['oauth', 'oidc'])) {
            throw new Error('初始化 AuthenticationClient 时传入的 protocol 参数必须为 oauth 或 oidc，请检查参数');
        }
        if (!isset($this->options->secret) && $this->options->revocationEndPointAuthMethod !== 'none') {
            throw new Error(
                '请在初始化 AuthenticationClient 时传入 appId 和 secret 参数'
            );
        }
        if ($this->options->introspectionEndPointAuthMethod === 'client_secret_post') {
            $this->_revokeTokenWithClientSecretPost($token);
            return true;
        }
        if ($this->options->introspectionEndPointAuthMethod === 'none') {
            $this->_revokeTokenWithClientSecretBasic($token);
            return true;
        }
        if ($this->options->introspectionEndPointAuthMethod === 'client_secret_basic') {
            $this->_revokeTokenWithNone($token);
            return true;
        }
    }

    /**
     * @param string $token
     */
    public function _revokeTokenWithClientSecretPost($token)
    {
        $qstr = $this->_generateTokenRequest([
            'client_id' => $this->options->appId,
            'client_secret' => $this->options->secret,
            'token' => $token,
        ]);
        $api = '';
        if ($this->options->protocol === 'oidc') {
            $api = '/oidc/token/revocation';
        } elseif ($this->options->protocol === 'oauth') {
            $api = '/oauth/token/revocation';
        }
        $req = new Request('POST', $api, [
            'body' => $qstr,
            'headers' =>
            [
                'Content-Type' => 'application/x-www-form-urlencoded',
            ],
        ]);
        $tokenSet = $this->httpSend($req);
        return $tokenSet;
    }

    /**
     * @param string $token
     */
    public function _revokeTokenWithClientSecretBasic($token)
    {
        $qstr = $this->_generateTokenRequest([
            'client_id' => $this->options->appId,
            'token' => $token,
        ]);
        $api = '';
        if ($this->options->protocol === 'oidc') {
            $api = '/oidc/token/revocation';
        } elseif ($this->options->protocol === 'oauth') {
            $api = '/oauth/token/revocation';
        }
        $req = new Request('POST', $api, [
            'body' => $qstr,
        ]);
        $tokenSet = $this->httpSend($req);
        return $tokenSet;
    }

    /**
     * @param string $token
     */
    public function _revokeTokenWithNone($token)
    {
        $qstr = $this->_generateTokenRequest([
            'token' => $token,
        ]);
        $api = '';
        if ($this->options->protocol === 'oidc') {
            $api = '/oidc/token/revocation';
        } elseif ($this->options->protocol === 'oauth') {
            throw new Error(
                'OAuth 2.0 暂不支持用 client_secret_basic 模式身份验证撤回 Token'
            );
        }
        $req = new Request('POST', $api, [
            'body' => $qstr,
            'headers' =>
            [
                'Authorization' => $this->_generateBasicAuthToken(),
            ],
        ]);
        $tokenSet = $this->httpSend($req);
        return $tokenSet;
    }

    /**
     * @param string $ticket
     * @param string $service
     */
    public function validateTicketV1($ticket, $service)
    {
        $api = '/cas-idp/' . $this->options->appId . '/validate?service=' . $service . '&ticket=' . $ticket;
        $req = new Request('GET', $api, [
            'headers' => array_merge(
                $this->getOidcHeaders()
            ),
        ]);

        $res = $this->httpSend($req);
        list($valid, $username) = explode('\n', $res);
        if ($valid === 'yes') {
            if ($username) {
                return [
                    'valid' => true,
                    'username' => $username,
                ];
            } else {
                return [
                    'valid' => true,
                ];
            }
        } else {
            return [
                'valid' => false,
                'username' => $username,
                'message' => 'ticket 不合法',
            ];
        }
    }

    public function unbindEmail()
    {
        $param = new UnbindEmailParam();
        $user = $this->request($param->createRequest())->unbindEmail;
        $this->setCurrentUser($user);
        return $user;
    }

    /**
     * @param string $key
     */
    public function removeUdfValue($key)
    {
        $userId = $this->checkLoggedIn();
        $param = new RemoveUdvParam(UDFTargetType::USER, $userId, $key);
        $this->request($param->createRequest());
        return true;
    }

    public function setUdfValue(array $data)
    {
        if (count($data) === 0) {
            throw new Error('empty udf value list');
        }
        $att = [];
        foreach ($data as $key => $value) {
            array_push($att, (object) [
                'key' => $key,
                'value' => json_encode($value),
            ]);
        }
        $userId = $this->checkLoggedIn();
        $param = (new SetUdvBatchParam(UDFTargetType::USER, $userId))->withUdvList($att);
        $res = $this->request($param->createRequest());
        return Utils::convertUdv($res);
    }

    public function getToken()
    {
        return $this->accessToken;
    }

    /**
     * @param string $rolecode
     * @param string $namespace
     */
    public function hasRole($rolecode, $namespace = 'default')
    {
        $param = (new GetUserRolesParam($this->checkLoggedIn()))->withNamespace($namespace);
        $user = $this->request($param->createRequest());
        if (!$user) {
            return false;
        }
        $roleList = $user->roles->list;
        if (count($roleList) == 0) {
            return false;
        }
        $hasRole = false;
        foreach ($roleList as $item) {
            if ($item->code === $rolecode) {
                $hasRole = true;
            }
        }

        return $hasRole;
    }

    public function clearCurrentUser()
    {
        $this->user = null;
        $this->accessToken = null;
    }

    public function validateToken(array $options)
    {
        $options = (object)$options;
        if (
            isset($options->accessToken) &&
            isset($options->idToken) &&
            $options->accessToken &&
            $options->idToken
        ) {
            throw new Error('accessToken 和 idToken 只能传入一个，不能同时传入');
        }
        if (!empty($options->idToken) && !empty($options->accessToken)) {
            throw new Error('accessToken 和 idToken 只能传入一个，不能同时传入');
        }
        if (!empty($options->idToken)) {
            $api = "/api/v2/oidc/validate_token?id_token=$$options->idToken";
            $req = new Request('GET', $api);
            $data = $this->httpSend($req);
            return $data;
        } elseif (!empty($options->accessToken)) {
            $api = "/api/v2/oidc/validate_token?access_token=$$options->accessToken";
            $req = new Request('GET', $api);
            $data = $this->httpSend($req);
            return $data;
        }
    }
}
