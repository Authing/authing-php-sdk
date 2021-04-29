<?php
require_once __DIR__ . '../../../vendor/autoload.php';

use Authing\Auth\AuthenticationClient;
use Authing\Types\LoginByUsernameInput;
use Authing\Types\RegisterByEmailInput;
use Authing\Types\RegisterByUsernameInput;
use Authing\Types\LoginByEmailInput;
use Authing\Types\LoginByPhonePasswordInput;
use Authing\Types\UpdateUserInput;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use PHPUnit\Framework\TestCase;
use Test\TestConfig;

class AuthenticationClientTest extends TestCase
{
    /**
     * @var AuthenticationClient
     */
    private $client;
    private $_testConfig;

    private function randomString()
    {
        return rand() . '';
    }

    protected function setUp(): void
    {
        $moduleName = str_replace('ClientTest', '', __CLASS__);
        $this->_testConfig = (object) TestConfig::getConfig($moduleName);
        $this->client = new AuthenticationClient(function ($options) {
            $options->appId = $this->_testConfig->appId;
        });
        $username = $this->_testConfig->username;
        $password = $this->_testConfig->password;
        // new LoginByUsernameInput($username, $password)
        $this->client->loginByUsername($username, $password);
    }

    protected function tearDown(): void
    {
    }

    /**
     * @group test
     *
     * @return void
     * @Description
     * @example
     * @author Xintao Li
     * @since
     */
    public function test_setToken()
    {
        $newToken = 'test-token';
        $this->client->setToken($newToken);
        parent::assertEquals($newToken, $this->client->getToken());
    }

    /**
     * @group notest
     *
     * @return void
     * @Description
     * @example
     * @author Xintao Li
     * @since
     */
    public function test_setMfaAuthorizationHeader()
    {
        $mfaToken = 'test-mfaToken';
        $this->client->setMfaAuthorizationHeader($mfaToken);
        parent::assertEquals($mfaToken, $this->client->getMfaAuthorizationHeader());
    }

    /**
     * @group notest
     *
     * @return void
     * @Description
     * @example
     * @author Xintao Li
     * @since
     */
    public function test_clearMfaAuthorizationHeader()
    {
        $this->client->clearMfaAuthorizationHeader();
        parent::assertEquals($this->client->getMfaAuthorizationHeader(), '');
    }

    /**
     * @group notest
     *
     * @return void
     * @Description
     * @example
     * @author Xintao Li
     * @since
     */
    public function test_getCurrentUser()
    {
        $user = $this->client->getCurrentUser();
        $username = $this->_testConfig->username;
        parent::assertEquals($user->username, $username);
    }

    public function test_setCurrentUser()
    {
        $user = $this->client->getCurrentUser();
        $currentToken = $this->client->getToken();
        $newUser = (object) [
            'username' => 'new username',
            'token' => 'new token'
        ];
        $this->client->setCurrentUser($newUser);
        parent::assertEquals($this->client->getToken(), 'new token');
        // parent::assertEquals(($this->client->getCurrentUser())->id, $newUser->id);
    }

    public function test_registerByEmail()
    {
        $email = 'test@qq.com';
        $password = 'password';
        // $input = new RegisterByEmailInput($email, $password);
        $user = $this->client->registerByEmail($email, $password);
        parent::assertNotEmpty($user);
    }

    public function test_registerByUsername()
    {
        $username = 'test-username';
        $password = 'password';
        // $input = new RegisterByUsernameInput($username, $password);
        $user = $this->client->registerByUsername($username, $password);
        parent::assertNotEmpty($user);
    }

    /**
     * @todo Something
     */
    public function test_registerByPhoneCode()
    {
        # code...
    }

    /**
     * @todo Something
     */
    public function test_sendSmsCode()
    {
    }

    public function test_loginByEmail()
    {
        $email = $this->_testConfig->email;
        $password = 'password';
        // $input = new LoginByEmailInput($email, $password);
        $user = $this->client->loginByEmail($email, $password);
        parent::assertNotEmpty($user);
    }

    /**
     * @todo Something
     */
    public function test_loginByPhoneCode()
    {
        # code...
    }

    public function test_loginByPhonePassword()
    {
        $phone = $this->_testConfig->phone;
        $password = 'password';
        // $input = new LoginByPhonePasswordInput($phone, $password);
        $user = $this->client->loginByPhonePassword($phone, $password);
        parent::assertNotEmpty($user);
    }

    /**
     * @todo Something
     */
    public function test_loginBySubAccount()
    {
        # code...
    }

    public function test_checkLoginStatus()
    {
        $token = $this->client->getToken();
        $res = $this->client->checkLoginStatus($token);
        $this->assertNotNull($res);
    }

    /**
     * @todo Something
     */
    public function test_sendEmail()
    {
        # code...
    }

    /**
     * @todo Something
     */
    public function test_resetPasswordByPhoneCode()
    {
        # code...
    }

    /**
     * @todo Something
     */
    public function test_resetPasswordByEmailCode()
    {
        # code...
    }

    public function test_updateProfile()
    {
        $input = (new UpdateUserInput())->withAddress(';扁担李')->withCity('bei jing');
        $user = $this->client->updateProfile($input);
        parent::assertNotNull($user);
    }

    public function test_updatePassword()
    {
        $oldPassword = $this->_testConfig->password;
        $newPassword = 'new password';
        $user = $this->client->updatePassword($newPassword, $oldPassword);
        parent::assertNotNull($user);
        $user = $this->client->updatePassword($oldPassword, $newPassword);
        parent::assertNotNull($user);
    }

    /**
     * @todo Something
     */
    public function test_updatePhone()
    {
        # code...
    }

    /**
     * @todo Something
     */
    public function test_updateEmail()
    {
        # code...
    }

    /**
     * @todo Something
     */
    public function test_bindPhone()
    {
        # code...
    }

    /**
     * @todo Something
     */
    public function test_unBindPhone()
    {
        # code...
    }

    public function test_logout()
    {
        $token = $this->client->getToken();
        $this->client->logout();
        parent::assertNotEquals($token, $this->client->getToken());
        parent::assertEquals($this->client->getToken(), '');
    }

    public function test_listUdv()
    {
        $data = $this->client->listUdv();
        parent::assertNotNull($data);
    }

    public function test_setUdv()
    {
        $key = 'test key';
        $value = 'test value';
        $data = $this->client->setUdv($key, $value);
        parent::assertNotNull($data);
    }

    public function test_removeUdv()
    {
        $key = 'test key';
        $data = $this->client->removeUdv($key);
        parent::assertNotNull($data);
    }

    public function test_checkPasswordStrength()
    {
        $strongPassword = 'PHP@javascript_!%1';
        $simplePassword = '123456';
        $data = $this->client->checkPasswordStrength($strongPassword);
        parent::assertNotNull($data);
        $data = $this->client->checkPasswordStrength($simplePassword);
        parent::assertNotNull($data);
    }

    /**
     * @todo Something
     */
    public function test_linkAccount()
    {
        # code...
    }

    /**
     * @todo Something
     */
    public function test_unLinkAccount()
    {
        # code...
    }

    public function test_listOrgs()
    {
        $orgs = $this->client->listOrgs();
        parent::assertNotNull($orgs);
    }

    public function test_loginByLdap()
    {
        $ldapUserName = $this->_testConfig->ldapUserName;
        $password = $this->_testConfig->password;
        $data = $this->client->loginByLdap($ldapUserName, $password);
        parent::assertNotNull($data);
    }

    public function test_loginByAd()
    {
        $adUserName = $this->_testConfig->adUserName;
        $password = $this->_testConfig->password;
        $data = $this->client->loginByAd($adUserName, $password);
        parent::assertNotNull($data);
    }

    public function test_getUdfValue()
    {
        $data = $this->client->getUdfValue();
        parent::assertNotNull($data);
    }

    public function test_computedPasswordSecurityLevel()
    {
        $strongPassword = 'PHP@javascript_!%1';
        $simplePassword = '123456';
        $data = $this->client->computedPasswordSecurityLevel($strongPassword);
        parent::assertNotNull($data);
        $data = $this->client->computedPasswordSecurityLevel($simplePassword);
        parent::assertNotNull($data);
    }

    public function test_getSecurityLevel()
    {
        $data = $this->client->getSecurityLevel();
        parent::assertNotNull($data);
    }

    /**
     * @todo Something
     */
    public function test_listAuthorizedResources()
    {
        # code...
    }

    /**
     * @todo Something
     */
    public function test_bindEmail()
    {
        # code...
    }

    /**
     * @todo Something
     */
    public function test_unbindEmail()
    {
        # code...
    }

    public function test_setUdfValue()
    {
        $udfValue = [
            'test key' => 'test value'
        ];
        $data = $this->client->setUdfValue($udfValue);
        parent::assertNotNull($data);
    }

    public function test_removeUdfValue()
    {
        $key = 'test key';
        $flag = $this->client->removeUdfValue($key);
        parent::assertTrue($flag);
    }

    public function test_getToken()
    {
        $token = $this->client->getToken();
        parent::assertNotEmpty($token);
    }

    public function test_hasRole()
    {
        $roleCode = $this->_testConfig->roleCode;
        $flag = $this->client->hasRole($roleCode);
        parent::assertTrue($flag);
        $roleCode = '------';
        $flag = $this->client->hasRole($roleCode);
        parent::assertFalse($flag);
    }

    public function test_clearCurrentUser()
    {
        $this->client->clearCurrentUser();
        parent::assertNull($this->client->getCurrentUser());
        parent::assertNull($this->client->getToken());
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
    public function test_loginByUsername()
    {
        $username = $this->_testConfig->username;
        $password = $this->_testConfig->password;
        $user = $this->client->loginByUsername($username, $password);
        $this->assertEquals($user->username, $username);
        return $this->client;
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

    // public function testGetNewAccessTokenByRefreshToken()
    // {
    //     $this->authenticationClient = new AuthenticationClient(function ($options) {
    //         $options->appId = $this->_testConfig->appId;
    //         $options->secret = $this->_testConfig->secret;
    //         $options->appHost = $this->_testConfig->appHost;
    //         $options->redirectUri = $this->_testConfig->redirectUri;
    //         $options->tokenEndPointAuthMethod = $this->_testConfig->tokenEndPointAuthMethod;
    //         $options->protocol = 'oidc';
    //     });
    //     $this->_testConfig->scope = $this->_testConfig->refreshScope['scope'];
    //     // get authorizeUrl
    //     return;
    //     $url = $this->authenticationClient->buildAuthorizeUrl((array) $this->_testConfig);
    //     echo $url;
    //     $this->assertNotEmpty($url);

    //     // post username password
    //     // ....
    //     // code -> token
    //     $token = $this->authenticationClient->getAccessTokenByCode($this->_testConfig->code);
    //     $this->authenticationClient->setToken($token->access_token);
    //     $userId = $this->authenticationClient->checkLoggedIn();

    //     $this->assertNotEmpty($userId);
    //     // get refreshToken
    //     $refresh_token = $token->refresh_token;
    //     $this->assertNotEmpty($refresh_token);
    //     // get new accessToken
    //     $newToken = $this->authenticationClient->getNewAccessTokenByRefreshToken($refresh_token);

    //     $new_refresh_token = $newToken->refresh_token;
    //     $this->authenticationClient->setToken($newToken->access_token);
    //     $new_userId = $this->authenticationClient->checkLoggedIn();

    //     $this->assertIsString($new_userId);
    //     $this->assertSame($userId, $new_userId);
    // }

    // public function testBindEmail()
    // {
    //     // $res = $this->authenticationClient->bindEmail('1409458062@qq.com', '');
    //     // $this->assertNotEmpty($res);
    // }

    // public function testUnbindEmail()
    // {
    //     // $this->authenticationClient->loginByUsername(new LoginByUsernameInput($this->_testConfig->username, $this->_testConfig->password));
    //     // $res = $this->authenticationClient->unbindEmail();
    // }

    // /**
    //  * @depends testLoginByUsername
    //  */
    // public function testSetUdfValue($authenticationClient)
    // {
    //     $res = $authenticationClient->setUdfValue([
    //         'key' => 'testkey',
    //         'value' => 'this is value',
    //     ]);
    //     // $this->assertNotEmpty($res);
    //     $this->assertEmpty($res);
    // }

    // /**
    //  * @depends testLoginByUsername
    //  * @depends testSetUdfValue
    //  */
    // public function testRemoveUdfValue(AuthenticationClient $authenticationClient)
    // {
    //     // $res = $authenticationClient->removeUdfValue('testkey');
    //     // $this->assertTrue($res);
    // }

    // public function testIntrospectToken()
    // {
    //     // $this->authenticationClient->introspectToken();
    // }

    // public function testRevokeToken()
    // {
    //     // $this->authenticationClient->revokeToken();
    // }

    // public function testValidateTicketV1()
    // {
    //     // $this->authenticationClient->validateTicketV1();
    // }

    // /**
    //  * @depends testLoginByUsername
    //  */
    // public function testGetToken(AuthenticationClient $authenticationClient)
    // {
    //     $token = $authenticationClient->getToken();
    //     $this->assertNotEmpty($token);
    // }

    // /**
    //  * @depends testLoginByUsername
    //  */
    // public function testHasRole(AuthenticationClient $authenticationClient)
    // {
    //     $roleCode = $this->_testConfig->roleCode;
    //     // add a role then get the roleCode
    //     // check current roles has this roleCode
    //     $flag = $authenticationClient->hasRole($roleCode);
    //     $this->assertTrue($flag);
    //     $flag = $authenticationClient->hasRole($roleCode . '---');
    //     $this->assertFalse($flag);
    // }

    // /**
    //  * @depends testLoginByUsername
    //  */
    // public function testBuildLogoutUrl(AuthenticationClient $authenticationClient)
    // {
    //     $authenticationClient = new AuthenticationClient(function ($options) {
    //         $options->appId = $this->_testConfig->appId;
    //         // $options->secret = $this->_testConfig->secret;
    //         $options->appHost = $this->_testConfig->appHost;
    //         $options->redirectUri = $this->_testConfig->redirectUri;
    //         // $options->tokenEndPointAuthMethod = $this->_testConfig->tokenEndPointAuthMethod;
    //         $options->protocol = 'oidc';
    //     });
    //     // oidc logout url
    //     $url = $authenticationClient->buildLogoutUrl([
    //         'redirectUri' => $this->_testConfig->redirectUri,
    //         'protocol' => 'oidc',
    //     ]);
    //     $this->assertNotEmpty($url);
    //     // $authenticationClient = new AuthenticationClient(function ($options) {
    //     //     $options->appId = $this->_testConfig->appId;
    //     //     $options->secret = $this->_testConfig->secret;
    //     //     $options->appHost = $this->_testConfig->appHost;
    //     //     $options->redirectUri = $this->_testConfig->redirectUri;
    //     //     $options->protocol = 'oidc';
    //     // });
    //     // // oidc logout url
    //     // $url = $authenticationClient->buildLogoutUrl([
    //     //     'redirectUri' => $this->_testConfig->redirectUri,
    //     //     'idToken' => '待退出用户的 idToken',
    //     //     'expert' => true,
    //     // ]);
    //     // $this->assertNotEmpty($url);

    //     // cas logout url
    //     // $url = $authenticationClient->buildLogoutUrl();
    // }

    // /**
    //  * @depends testLoginByUsername
    //  */
    // public function testClearCurrentUser(AuthenticationClient $authenticationClient)
    // {
    //     $authenticationClient->clearCurrentUser();
    //     $this->assertEmpty($authenticationClient->user);
    //     $this->assertEmpty($authenticationClient->accessToken);
    // }

    // /**
    //  * @depends testLoginByUsername
    //  */
    // public function testSendEmail(AuthenticationClient $authenticationClient)
    // {
        
    // }
}
