<?php
require_once __DIR__ . '../../vendor/autoload.php';

use Authing\Auth\AuthenticationClient;
use Authing\Types\LoginByUsernameInput;
use PHPUnit\Framework\TestCase;
use Test\TestConfig;

class AuthenticationClientTest extends TestCase
{
    /**
     * @var AuthenticationClient
     */
    private $authenticationClient;
    private $_testConfig;

    private function randomString()
    {
        return rand() . '';
    }

    /**
     *
     * @return void
     * @Description
     * @example
     * @author Xintao Li
     * @since
     */
    protected function setUp(): void
    {
        $moduleName = str_replace('ClientTest', '', __CLASS__);
        $this->_testConfig = (object) TestConfig::getConfig($moduleName);
        $this->authenticationClient = new AuthenticationClient(function ($options) {
            $options->appId = $this->_testConfig->appId;
        });
    }

    protected function tearDown(): void
    {

    }

    // public function testGetCurrentUser()
    // {
    //     $username = "test";
    //     $password = "123456";
    //     $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

    //     $user = $this->client->getCurrentUser();
    //     $this->assertNotEquals(null, $user);
    // }

    // /**
    //  * @throws Exception
    //  */
    // public function testRegisterByEmail() {
    //     $email = $this->randomString() . "@gmail.com";
    //     $password = "123456";
    //     $user = $this->client->registerByEmail(new RegisterByEmailInput($email, $password));
    //     $this->assertEquals($user->email, $email);
    // }

    // /**
    //  * @throws Exception
    //  */
    // public function testRegisterByUsername() {
    //     $username = $this->randomString();
    //     $password = "123456";
    //     $user = $this->client->registerByUsername(new RegisterByUsernameInput($username, $password));
    //     $this->assertEquals($user->username, $username);
    // }

    // /**
    //  * @throws Exception
    //  */
    // public function testRegisterByPhoneCode() {
    //     $phone = "17611161550";
    //     $code = "1234";
    //     $password = "123456";
    //     $user = $this->client->registerByPhoneCode((new RegisterByPhoneCodeInput($phone, $code))->withPassword($password));
    //     $this->assertEquals($user->phone, $phone);
    // }

    // /**
    //  * @throws Exception
    //  */
    // public function testLoginByEmail() {
    //     $email = "test@test.com";
    //     $password = "123456";
    //     $user = $this->client->loginByEmail(new LoginByEmailInput($email, $password));
    //     $this->assertEquals($user->email, $email);
    // }

    /**
     * @throws Exception
     */
    public function testLoginByUsername() {
        $username = $this->_testConfig->username;
        $password = $this->_testConfig->password;
        $user = $this->authenticationClient->loginByUsername(new LoginByUsernameInput($username, $password));
        $this->assertEquals($user->username, $username);
        return $this->authenticationClient;
    }

    // /**
    //  * @throws Exception
    //  */
    // public function testLoginByPhoneCode() {
    //     $phone = "17611161550";
    //     $code = "1234";
    //     $user = $this->client->loginByPhoneCode((new LoginByPhoneCodeInput($phone, $code)));
    //     $this->assertEquals($user->phone, $phone);
    // }

    // /**
    //  * @throws Exception
    //  */
    // public function testLoginByPhonePassword() {
    //     $phone = "17611161550";
    //     $password = "123456";
    //     $user = $this->client->loginByPhonePassword((new LoginByPhonePasswordInput($phone, $password)));
    //     $this->assertEquals($user->phone, $phone);
    // }

    // /**
    //  * @throws Exception
    //  */
    // public function testSendSmsCode() {
    //     $phone = "17611161550";
    //     $message = $this->client->sendSmsCode($phone);
    //     $this->assertEquals(200, $message->code);
    // }

    // /**
    //  * @throws Exception
    //  */
    // public function testSendEmail() {
    //     $email = "1498881550@qq.com";
    //     $this->client->sendEmail($email, EmailScene::RESET_PASSWORD);
    // }

    // /**
    //  * @throws Exception
    //  */
    // public function testCheckLoginStatus() {
    //     $username = "test";
    //     $password = "123456";
    //     $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

    //     $status = $this->client->checkLoginStatus();
    //     $this->assertEquals(200, $status->code);
    // }

    // public function testResetPasswordByPhoneCode() {
    //     $phone = "17611161550";
    //     $code = "1234";
    //     $newPassword = "123456";
    //     $this->client->resetPasswordByPhoneCode($phone, $code, $newPassword);
    // }

    // public function testResetPasswordByEmailCode() {
    //     $email = "1498881550@qq.com";
    //     $code = "1234";
    //     $newPassword = "123456";
    //     $this->client->resetPasswordByEmailCode($email, $code, $newPassword);
    // }

    // public function testUpdateProfile() {
    //     $username = "test";
    //     $password = "123456";
    //     $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

    //     $user = $this->client->updateProfile((new UpdateUserInput())->withNickname("nickname"));
    //     $this->assertEquals('nickname', $user->nickname);
    // }

    // public function testUpdatePassword() {
    //     $username = "test";
    //     $password = "123456";
    //     $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

    //     $user = $this->client->updatePassword("111111", "123456");
    //     $this->assertEquals(true, $user !== null);
    // }

    // public function testUpdateEmail() {
    //     $username = "test";
    //     $password = "123456";
    //     $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

    //     $user = $this->client->updateEmail("1498881550@qq.com", "1234");
    //     $this->assertEquals(true, $user !== null);
    // }

    // public function testUpdatePhone() {
    //     $username = "test";
    //     $password = "123456";
    //     $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

    //     $user = $this->client->updatePhone("17611161550", "1234");
    //     $this->assertEquals(true, $user !== null);
    // }

    // public function testRefreshToken() {
    //     $username = "test";
    //     $password = "123456";
    //     $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

    //     $token = $this->client->refreshToken();
    //     $this->assertEquals(true, $token->token !== null);
    // }

    // public function testBindPhone() {
    //     $username = "test";
    //     $password = "123456";
    //     $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

    //     $user = $this->client->bindPhone("17611161550", "1234");
    //     $this->assertEquals(true, $user !== null);
    // }

    // public function testUnbindPhone() {
    //     $username = "test";
    //     $password = "123456";
    //     $this->client->loginByUsername(new LoginByUsernameInput($username, $password));

    //     $user = $this->client->unBindPhone();
    //     $this->assertEquals(true, $user !== null);
    // }

    // public function logout() {
    //     $this->client->logout();
    // }

    public function testGetNewAccessTokenByRefreshToken()
    {
        $this->authenticationClient = new AuthenticationClient(function ($options) {
            $options->appId = $this->_testConfig->appId;
            $options->secret = $this->_testConfig->secret;
            $options->appHost = $this->_testConfig->appHost;
            $options->redirectUri = $this->_testConfig->redirectUri;
            $options->tokenEndPointAuthMethod = $this->_testConfig->tokenEndPointAuthMethod;
            $options->protocol = 'oidc';
        });
        $this->_testConfig->scope = $this->_testConfig->refreshScope['scope'];
        // get authorizeUrl
        return;
        $url = $this->authenticationClient->buildAuthorizeUrl((array) $this->_testConfig);
        echo $url;
        $this->assertNotEmpty($url);

        // post username password
        // ....
        // code -> token
        $token = $this->authenticationClient->getAccessTokenByCode($this->_testConfig->code);
        $this->authenticationClient->setToken($token->access_token);
        $userId = $this->authenticationClient->checkLoggedIn();
        
        $this->assertNotEmpty($userId);
        // get refreshToken
        $refresh_token = $token->refresh_token;
        $this->assertNotEmpty($refresh_token);
        // get new accessToken
        $newToken = $this->authenticationClient->getNewAccessTokenByRefreshToken($refresh_token);

        $new_refresh_token = $newToken->refresh_token;
        $this->authenticationClient->setToken($newToken->access_token);
        $new_userId = $this->authenticationClient->checkLoggedIn();

        $this->assertIsString($new_userId);
        $this->assertSame($userId, $new_userId);
    }

    public function testBindEmail()
    {
        // $res = $this->authenticationClient->bindEmail('1409458062@qq.com', '');
        // $this->assertNotEmpty($res);
    }

    public function testUnbindEmail()
    {
        // $this->authenticationClient->loginByUsername(new LoginByUsernameInput($this->_testConfig->username, $this->_testConfig->password));
        // $res = $this->authenticationClient->unbindEmail();
    }
    /**
     * @depends testLoginByUsername
     */
    public function testSetUdfValue($authenticationClient)
    {
        $res = $authenticationClient->setUdfValue([
                'key' => 'testkey',
                'value' => 'this is value'
        ]);
        // $this->assertNotEmpty($res);
        $this->assertEmpty($res);
    }

    /**
     * @depends testLoginByUsername
     * @depends testSetUdfValue
     */
    public function testRemoveUdfValue($authenticationClient)
    {
        $res = $authenticationClient->removeUdfValue('testkey');
        $this->assertTrue($res);
    }

    public function testIntrospectToken()
    {
        // $this->authenticationClient->introspectToken();
    }

    public function testRevokeToken()
    {
        // $this->authenticationClient->revokeToken();
    }

    public function testValidateTicketV1()
    {
        // $this->authenticationClient->validateTicketV1();
    }
}
