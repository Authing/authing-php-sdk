<?php


namespace Authing\Auth;
use InvalidArgumentException;
use Authing\Types\BindPhoneParam;
use Authing\Types\CheckLoginStatusParam;
use Authing\Types\CommonMessage;
use Authing\Types\EmailScene;
use Authing\Types\JWTTokenStatus;
use Authing\Types\LoginByEmailInput;
use Authing\Types\LoginByEmailParam;
use Authing\Types\LoginByPhoneCodeInput;
use Authing\Types\LoginByPhoneCodeParam;
use Authing\Types\LoginByPhonePasswordInput;
use Authing\Types\LoginByPhonePasswordParam;
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
use Authing\Types\SetUdvParam;
use Authing\Types\UDFTargetType;
use Authing\Types\UdvParam;
use Authing\Types\UnbindPhoneParam;
use Authing\Types\UpdateEmailParam;
use Authing\Types\UpdatePasswordParam;
use Authing\Types\UpdatePhoneParam;
use Authing\Types\UpdateUserInput;
use Authing\Types\UpdateUserParam;
use Authing\Types\User;
use Authing\Types\UserDefinedData;
use Authing\Types\UserParam;
use Authing\BaseClient;
use Authing\Types\CheckPasswordStrengthParam;
use Authing\Types\ListUserAuthorizedResourcesParam;
use Error;
use Exception;
use PHPUnit\Framework\Constraint\Callback;
use stdClass;


class MFAAuthenticationClient
{

    protected $user;
    protected AuthenticationClient $client;

    /**
     * AuthenticationClient constructor.
     * @param $userPoolId string
     * @throws InvalidArgumentException
     */
    public function __construct($authenticationClient)
    {
        $this->client = $authenticationClient;
    }

    /**
     * 获取当前用户
     *
     * @return User
     * @throws Exception
     */
    function getCurrentUser() {
        $param = new UserParam();
        $user = $this->client->request($param->createRequest());
        $this->accessToken = $user->token ?: $this->accessToken;
        $this->user = $user;
        return $user;
    }

    /**
     * 设置当前用户
     *
     * @return User
     * @throws Exception
     */
    function setCurrentUser() {
        $param = new UserParam();
        $user = $this->client->request($param->createRequest());
        $this->accessToken = $user->token ?: $this->accessToken;
        $this->user = $user;
        return $user;
    }

    public function assosicateMfaAuthenticator(Callback $cb)
    {
        $_ = new stdClass;
        $cb($_);
        if (isset($_->authenticatorType) && is_string($_->authenticatorType)) {
            $data = $this->client->httpPost('/api/v2/mfa/totp/associate', $_);
            return $data;
        } else {
            throw new Error('authenticatorType 为非空字符串');
        }
    }

    public function verifyTotpMfa(Callback $cb)
    {
        $_ = new stdClass;
        $cb($_);
        if (
            isset($_->totp) && 
            is_string($_->totp) && 
            isset($_->mfaToken) && 
            is_string($_->mfaToken)
        ) {
            $this->client->setMfaAuthorizationHeader($_->mfaToken);
            $data = $this->client->httpPost('/api/v2/mfa/totp/verify', $_);
            $this->client->clearMfaAuthorizationHeader();
            return $data;
        } else {
            throw new Error('totp mfaToken 需要被设置');
        }
    }

    public function getMfaAuthenticators(Callback $cb)
    {
        $_ = new stdClass;
        $cb($_);
        if (isset($_->type) && is_string($_->type)) {
            $data = $this->client->httpGet('/api/v2/mfa/authenticator', $_);
            return $data;
        } else {
            throw new Error('type 需要被设置为字符串');
        }
    }

    public function deleteMfaAuthenticator()
    {
        $this->client->httpDelete('/api/v2/mfa/totp/associate');
        $resData = new stdClass;
        $resData->code = 200;
        $resData->message = 'TOTP MFA 解绑成功';
        return $resData;
    }

    public function confirmAssosicateMfaAuthenticator(Callback $cb)
    {
        $_ = new stdClass;
        $cb($_);
        if (
            isset($_->totp) && 
            is_string($_->totp) &&
            isset($_->authenticatorType) &&
            is_string($_->authenticatorType)
        ) {
            $_->authenticator_type = $_->authenticatorType;
            $data = $this->client->httpPost('/api/v2/mfa/totp/associate/confirm', $_);
            $resData = new stdClass;
            $resData->code = 200;
            $resData->message = 'TOTP MFA 绑定成功';
            return $resData;
        } else {
            throw new Error('totp mfaToken 需要被设置');
        }
    }

    public function verifyAppSmsMfa(Callback $cb)
    {
        $_ = new stdClass;
        $cb($_);
        if (
            isset($_->phone) && 
            is_string($_->phone) && 
            isset($_->code) && 
            is_string($_->code) && 
            isset($_->mfaToken) && 
            is_string($_->mfaToken)
            ) {
            $this->client->setMfaAuthorizationHeader($_->mfaToken);
            $data = $this->client->httpPost('/api/v2/applications/mfa/sms/verify', $_);
            $this->client->clearMfaAuthorizationHeader();
            return $data;
        } else {
            throw new Error('phone code mfaToken 需要被设置');
        }
    }

    public function verifyAppEmailMfa(Callback $cb)
    {
        $_ = new stdClass;
        $cb($_);
        if (
            isset($_->phone) && 
            is_string($_->phone) && 
            isset($_->code) && 
            is_string($_->code) && 
            isset($_->mfaToken) && 
            is_string($_->mfaToken)
            ) {
            $this->client->setMfaAuthorizationHeader($_->mfaToken);
            $data = $this->client->httpPost('/api/v2/applications/mfa/sms/verify', $_);
            $this->client->clearMfaAuthorizationHeader();
            return $data;
        } else {
            throw new Error('phone code mfaToken 需要被设置');
        }
    }

    public function phoneOrEmailBindable(Callback $cb)
    {
        $_ = new stdClass;
        $cb($_);
        if (
            isset($_->phone) && 
            is_string($_->phone) && 
            isset($_->email) && 
            is_string($_->email) && 
            isset($_->mfaToken) && 
            is_string($_->mfaToken)
            ) {
            $this->client->setMfaAuthorizationHeader($_->mfaToken);
            $data = $this->client->httpPost('/api/v2/applications/mfa/check', $_);
            $this->client->clearMfaAuthorizationHeader();
            return $data;
        } else {
            throw new Error('phone email mfaToken 需要被设置');
        }
    }

    public function verifyTotpRecoveryCode(Callback $cb)
    {
        $_ = new stdClass;
        $cb($_);
        if (
            isset($_->recoveryCode) && 
            is_string($_->recoveryCode) && 
            isset($_->mfaToken) && 
            is_string($_->mfaToken)
            ) {
            $this->client->setMfaAuthorizationHeader($_->mfaToken);
            $data = $this->client->httpPost('/api/v2/mfa/totp/recovery', $_);
            $this->client->clearMfaAuthorizationHeader();
            return $data;
        } else {
            throw new Error('recoveryCode mfaToken 需要被设置');
        }
    }
}