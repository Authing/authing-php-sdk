<?php


namespace Authing;

use Exception;

require_once __DIR__ . '/CodeGen.php';

class AuthenticationClient extends BaseClient
{
    public function __construct($userPoolId)
    {
        parent::__construct($userPoolId);
    }

    /**
     * 获取当前用户
     *
     * @return User
     * @throws Exception
     */
    function getCurrentUser() {
        $param = new UserParam();
        return $this->request($param->createRequest());
    }

    /**
     * 通过邮箱密码注册
     *
     * @param $input RegisterByEmailInput
     * @return User
     * @throws Exception
     */
    function registerByEmail($input) {
        if ($input->password) {
            $input->password = $this->encrypt($input->password);
        }

        $param = new RegisterByEmailParam($input);
        return $this->request($param->createRequest());
    }

    /**
     * 通过用户名密码注册
     *
     * @param $input RegisterByUsernameInput
     * @return User
     * @throws Exception
     */
    function registerByUsername($input) {
        if ($input->password) {
            $input->password = $this->encrypt($input->password);
        }

        $param = new RegisterByUsernameParam($input);
        return $this->request($param->createRequest());
    }

    /**
     * 通过手机号验证码注册
     *
     * @param $input RegisterByPhoneCodeInput
     * @return User
     * @throws Exception
     */
    function registerByPhoneCode($input) {
        if ($input->password) {
            $input->password = $this->encrypt($input->password);
        }

        $param = new RegisterByPhoneCodeParam($input);
        return $this->request($param->createRequest());
    }

    /**
     * 发送手机验证码
     *
     * @param $phone
     * @return object
     * @throws Exception
     */
    function sendSmsCode($phone) {
        return $this->post( "/api/v2/sms/send", [
            "phone" => $phone
        ]);
    }

    /**
     * 通过邮箱登录
     *
     * @param $input LoginByEmailInput
     * @return User
     * @throws Exception
     */
    function loginByEmail($input) {
        if ($input->password) {
            $input->password = $this->encrypt($input->password);
        }

        $param = new LoginByEmailParam($input);
        return $this->request($param->createRequest());
    }

    /**
     * 通过用户名密码登录
     *
     * @param $input LoginByUsernameInput
     * @return User
     * @throws Exception
     */
    function loginByUsername($input) {
        if ($input->password) {
            $input->password = $this->encrypt($input->password);
        }

        $param = new LoginByUsernameParam($input);
        return $this->request($param->createRequest());
    }

    /**
     * 通过手机号验证码登录
     *
     * @param $input LoginByPhoneCodeInput
     * @return User
     * @throws Exception
     */
    function loginByPhoneCode($input) {
        $param = new LoginByPhoneCodeParam($input);
        return $this->request($param->createRequest());
    }

    /**
     * 通过手机号密码登录
     *
     * @param $input LoginByPhonePasswordInput
     * @return User
     * @throws Exception
     */
    function loginByPhonePassword($input) {
        $param = new LoginByPhonePasswordParam($input);
        return $this->request($param->createRequest());
    }

    /**
     * 检查登录状态
     *
     * @param string $token
     * @return JWTTokenStatus
     * @throws Exception
     */
    function checkLoginStatus($token = null) {
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
    function sendEmail($email, $scene) {
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
    function resetPasswordByPhoneCode($phone,  $code, $newPassword) {
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
    function resetPasswordByEmailCode($email, $code, $newPassword) {
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
    function updateProfile($input) {
        $param = new UpdateUserParam($input);
        return $this->request($param->createRequest());
    }

    /**
     * 更新密码
     *
     * @param $newPassword string 新密码
     * @param $oldPassword string 旧密码
     * @return User
     * @throws Exception
     */
    function updatePassword($newPassword, $oldPassword) {
        $newPassword = $this->encrypt($newPassword);
        $oldPassword = $this->encrypt($oldPassword);
        $param = (new UpdatePasswordParam($newPassword))->withOldPassword($oldPassword);
        return $this->request($param->createRequest());
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
    function updatePhone($phone, $phoneCode, $oldPhone = null, $oldPhoneCode = null) {
        $param = (new UpdatePhoneParam($phone, $phoneCode))->withOldPhone($oldPhone)->withOldPhoneCode($oldPhoneCode);
        return $this->request($param->createRequest());
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
    function updateEmail($email, $emailCode, $oldEmail = null, $oldEmailCode = null) {
        $param = (new UpdateEmailParam($email, $emailCode))->withOldEmail($oldEmail)->withOldEmailCode($oldEmailCode);
        return $this->request($param->createRequest());
    }

    /**
     * 刷新 access token
     *
     * @return RefreshToken
     * @throws Exception
     */
    function refreshToken() {
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
    function bindPhone($phone, $phoneCode) {
        $param = new BindPhoneParam($phone, $phoneCode);
        return $this->request($param->createRequest());
    }

    /**
     * 解绑定手机号
     *
     * @return User
     * @throws Exception
     */
    function unBindPhone() {
        $param = new UnbindPhoneParam();
        return $this->request($param->createRequest());
    }

    /**
     * 注销
     *
     * @throws Exception
     */
    function logout() {
        $param = new UpdateUserParam((new UpdateUserInput())->withTokenExpiredAt('0'));
        $this->request($param->createRequest());
        $this->accessToken = '';
    }
}