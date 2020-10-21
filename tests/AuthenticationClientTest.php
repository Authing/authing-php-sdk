<?php

use Authing\AuthenticationClient;
use Authing\EmailScene;
use Authing\LoginByEmailInput;
use Authing\LoginByPhoneCodeInput;
use Authing\LoginByPhonePasswordInput;
use Authing\LoginByUsernameInput;
use Authing\RegisterByEmailInput;
use Authing\RegisterByPhoneCodeInput;
use Authing\RegisterByUsernameInput;
use PHPUnit\Framework\TestCase;

class AuthenticationClientTest extends TestCase {
    /**
     * @var AuthenticationClient
     */
    private $client;

    private function randomString() {
        return rand() . '';
    }

    protected function setUp(): void {
        $this->client = new AuthenticationClient("59f86b4832eb28071bdd9214");
    }

    protected function tearDown(): void {

    }

    public function testGetCurrentUser()
    {
        $user = $this->client->getCurrentUser();
        $this->assertNotEquals($user, null);
    }

    /**
     * @throws Exception
     */
    public function testRegisterByEmail() {
        $email = $this->randomString() . "@gmail.com";
        $password = "123456";
        $user = $this->client->registerByEmail(new RegisterByEmailInput($email, $password));
        $this->assertEquals($user->email, $email);
    }

    /**
     * @throws Exception
     */
    public function testRegisterByUsername() {
        $username = $this->randomString();
        $password = "123456";
        $user = $this->client->registerByUsername(new RegisterByUsernameInput($username, $password));
        $this->assertEquals($user->username, $username);
    }

    /**
     * @throws Exception
     */
    public function testRegisterByPhoneCode() {
        $phone = "17611161550";
        $code = "1234";
        $password = "123456";
        $user = $this->client->registerByPhoneCode((new RegisterByPhoneCodeInput($phone, $code))->withPassword($password));
        $this->assertEquals($user->phone, $phone);
    }

    /**
     * @throws Exception
     */
    public function testLoginByEmail() {
        $email = $this->randomString() . "@gmail.com";
        $password = "123456";
        $user = $this->client->loginByEmail(new LoginByEmailInput($email, $password));
        $this->assertEquals($user->email, $email);
    }

    /**
     * @throws Exception
     */
    public function testLoginByUsername() {
        $username = $this->randomString();
        $password = "123456";
        $user = $this->client->loginByUsername(new LoginByUsernameInput($username, $password));
        $this->assertEquals($user->username, $username);
    }

    /**
     * @throws Exception
     */
    public function testLoginByPhoneCode() {
        $phone = "17611161550";
        $code = "1234";
        $user = $this->client->loginByPhoneCode((new LoginByPhoneCodeInput($phone, $code)));
        $this->assertEquals($user->phone, $phone);
    }

    /**
     * @throws Exception
     */
    public function testLoginByPhonePassword() {
        $phone = "17611161550";
        $password = "123456";
        $user = $this->client->loginByPhonePassword((new LoginByPhonePasswordInput($phone, $password)));
        $this->assertEquals($user->phone, $phone);
    }

    /**
     * @throws Exception
     */
    public function testSendSmsCode() {
        $phone = "17611161550";
        $this->client->sendSmsCode($phone);
    }

    /**
     * @throws Exception
     */
    public function testSendEmail() {
        $email = "1498881550@qq.com";
        $this->client->sendEmail($email, EmailScene::RESET_PASSWORD);
    }

    /**
     * @throws Exception
     */
    public function testCheckLoginStatus() {
        $status = $this->client->checkLoginStatus();
        $this->assertEquals($status->code, 200);
    }

    public function testResetPasswordByPhoneCode() {
        $phone = "17611161550";
        $code = "1234";
        $newPassword = "123456";
        $this->client->resetPasswordByPhoneCode($phone, $code, $newPassword);
    }

    public function testResetPasswordByEmailCode() {
        $email = "1498881550@qq.com";
        $code = "1234";
        $newPassword = "123456";
        $this->client->resetPasswordByEmailCode($email, $code, $newPassword);
    }

    public function testUpdateProfile() {
        $user = $this->client->updateProfile((new \Authing\UpdateUserInput())->withNickname("nickname"));
        $this->assertEquals($user->nickname, 'nickname');
    }

    public function testUpdatePassword() {
        $user = $this->client->updatePassword("", "");
        $this->assertEquals($user !== null, true);
    }

    public function testUpdateEmail() {
        $user = $this->client->updateEmail("1498881550@qq.com", "1234");
        $this->assertEquals($user !== null, true);
    }

    public function testUpdatePhone() {
        $user = $this->client->updatePhone("17611161550", "1234");
        $this->assertEquals($user !== null, true);
    }

    public function testRefreshToken() {
        $token = $this->client->refreshToken();
        $this->assertEquals($token->token !== null, true);
    }

    public function testBindPhone() {
        $user = $this->client->bindPhone("17611161550", "1234");
        $this->assertEquals($user !== null, true);
    }

    public function testUnbindPhone() {
        $user = $this->client->unBindPhone();
        $this->assertEquals($user !== null, true);
    }

    public function logout() {
        $this->client->logout();
    }
}
