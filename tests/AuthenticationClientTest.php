<?php

use Authing\Auth\AuthenticationClient;
use Authing\Types\EmailScene;
use Authing\Types\LoginByEmailInput;
use Authing\Types\LoginByPhoneCodeInput;
use Authing\Types\LoginByPhonePasswordInput;
use Authing\Types\LoginByUsernameInput;
use Authing\Types\RegisterByEmailInput;
use Authing\Types\RegisterByPhoneCodeInput;
use Authing\Types\RegisterByUsernameInput;
use Authing\Types\UpdateUserInput;
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
        $this->client->setHost("http://localhost:3000");
    }

    protected function tearDown(): void {

    }

    public function testGetCurrentUser()
    {
        $username = "test";
        $password = "123456";
        $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

        $user = $this->client->getCurrentUser();
        $this->assertNotEquals(null, $user);
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
        $email = "test@test.com";
        $password = "123456";
        $user = $this->client->loginByEmail(new LoginByEmailInput($email, $password));
        $this->assertEquals($user->email, $email);
    }

    /**
     * @throws Exception
     */
    public function testLoginByUsername() {
        $username = "test";
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
        $message = $this->client->sendSmsCode($phone);
        $this->assertEquals(200, $message->code);
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
        $username = "test";
        $password = "123456";
        $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

        $status = $this->client->checkLoginStatus();
        $this->assertEquals(200, $status->code);
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
        $username = "test";
        $password = "123456";
        $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

        $user = $this->client->updateProfile((new UpdateUserInput())->withNickname("nickname"));
        $this->assertEquals('nickname', $user->nickname);
    }

    public function testUpdatePassword() {
        $username = "test";
        $password = "123456";
        $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

        $user = $this->client->updatePassword("111111", "123456");
        $this->assertEquals(true, $user !== null);
    }

    public function testUpdateEmail() {
        $username = "test";
        $password = "123456";
        $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

        $user = $this->client->updateEmail("1498881550@qq.com", "1234");
        $this->assertEquals(true, $user !== null);
    }

    public function testUpdatePhone() {
        $username = "test";
        $password = "123456";
        $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

        $user = $this->client->updatePhone("17611161550", "1234");
        $this->assertEquals(true, $user !== null);
    }

    public function testRefreshToken() {
        $username = "test";
        $password = "123456";
        $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

        $token = $this->client->refreshToken();
        $this->assertEquals(true, $token->token !== null);
    }

    public function testBindPhone() {
        $username = "test";
        $password = "123456";
        $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

        $user = $this->client->bindPhone("17611161550", "1234");
        $this->assertEquals(true, $user !== null);
    }

    public function testUnbindPhone() {
        $username = "test";
        $password = "123456";
        $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

        $user = $this->client->unBindPhone();
        $this->assertEquals(true, $user !== null);
    }

    public function logout() {
        $this->client->logout();
    }
}
