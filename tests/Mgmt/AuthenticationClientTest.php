<?php
include_once 'D:\authing-php-sdk\tests\config\TestConfig.php';
include_once '..\..\src\Auth\AuthenticationClient.php';
include_once '..\..\src\Mgmt\UsersManagementClient.php';

use Test\TestConfig;
use PHPUnit\Framework\TestCase;
use Authing\Mgmt\ManagementClient;
use Authing\Types\CreateUserInput;
use Authing\Types\UpdateUserInput;
use Authing\Types\IsUserExistsParam;
use Authing\Mgmt\Utils;
use Authing\Mgmt\UsersManagementClient;
use Authing\Auth\AuthenticationClient;
use Authing\Types\RegisterByPhoneCodeInput;
use Authing\Types\RegisterProfile;
use Authing\Types\CodeChallengeDigestParam;

class AuthenticationClientTest extends TestCase
{
    /**
     * @var AuthenticationClient
     */
    private $authclient;

//    /**
//     * @return UsersManagementClient
//     */
//    private $userclient;

    private function randomString()
    {
        return rand() . '';
    }

    public function setUp(): void
    {
        $management = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        $management->requestToken();
        $this->userclient = $management->users();

        $this->authclient = new AuthenticationClient(function ($opts) {
            $opts->appId = "61319680ea8b30c9ca9ca071";
        });
    }

    public function test_loginByEmail()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password));
        $res = $this->authclient->loginByEmail($email,$password);
        parent::assertNotNull($res);
    }

    public function test_loginByUsername()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $username = $this->randomString();
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password)->withUsername($username));
        $res = $this->authclient->loginByUsername($username,$password);
        parent::assertNotNull($res);
    }


    public function test_loginByAd()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $username = $this->randomString();
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password)->withUsername($username));
        $res = $this->authclient->loginByAd($username,$password);
        parent::assertNotNull($res);
    }


    public function test_loginByPhoneCode()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $username = $this->randomString();
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password)->withUsername($username)->withPhoto('18856980539'));
        $res = $this->authclient->loginByPhoneCode('18856980539','5519');
        parent::assertNotNull($res);

    }

    public function test_loginByPhonePassword(){
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $username = $this->randomString();
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password)->withUsername($username)->withPhoto('18856780939'));
        $res = $this->authclient->loginByPhonePassword('18856780939',$password);
        parent::assertNotNull($res);
    }

    public function test_registerByEmail(){
        $email =  'aaaa@gmail.com';
        $password = '123456';
        $res = $this->authclient->registerByEmail($email,$password);
        parent::assertNotNull($res);
    }

    public function test_registerByUsername(){
        $password = '123456';
        $res = $this->authclient->registerByUsername('hhhh',$password);
        parent::assertNotNull($res);
    }

    public function test_registerByPhoneCode(){
        $password = '123456';
        $res = $this->authclient->registerByPhoneCode('aaa','5075',$password,new RegisterProfile(),[]);
        parent::assertNotNull($res);
    }

    public function test_loginByLdap(){
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $username = $this->randomString();
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password)->withUsername($username)->withPhoto('18878451478'));
        $res = $this->authclient->loginByLdap('18878451478',$password);
        parent::assertNotNull($res);
    }

    public function test_loginBySubAccount(){
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $username = $this->randomString();
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password)->withUsername($username)->withPhoto('18878451478'));
        $res = $this->authclient->loginBySubAccount('',$password);
        parent::assertNotNull($res);
    }

    public function test_removeUdfValue()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $username = $this->randomString();
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password)->withUsername($username));
        $res = $this->authclient->loginByUsername($username,$password);

        $cuser = $this->authclient->getCurrentUser();

        $listudv = $this->authclient->listUdv();

        $setudv = $this->authclient->setUdv('test','test');

        $listudv = $this->authclient->listUdv();

        $setudv = $this->authclient->removeUdv('test','test');

        $listudv = $this->authclient->listUdv();

        $setudv = $this->authclient->setUdfValue(['test'=>'aa']);

        $getudfvalue = $this->authclient->getUdfValue();

        parent::assertNotNull($getudfvalue);

    }

    public function test_resetPasswordByEmailCode()
    {
        $res = $this->authclient->resetPasswordByEmailCode('houyworking@163.com','5624','hy8262111');
        parent::assertNotNull($res);
    }

    public function test_resetPasswordByPhoneCode()
    {
        $res = $this->authclient->resetPasswordByPhoneCode('18856980539','5624','hy8262111');
        parent::assertNotNull($res);
    }

    public function test_sendSmsCode()
    {
        $res = $this->authclient->sendSmsCode('18856980539',);
        parent::assertNotNull($res);
    }

    public function test_sendEmail()
    {

        $res = $this->authclient->sendEmail('houyworking@163.com','RESET_PASSWORD');
        parent::assertNotNull($res);
    }

    public function test_unbindEmail()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $username = $this->randomString();
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password)->withUsername($username)->withPhoto('18845612541'));
        $res = $this->authclient->loginByUsername('1856708561',$password);
        $res = $this->authclient->unbindEmail();
        parent::assertNotNull($res);
    }

    public function test_unBindPhone()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $username = $this->randomString();
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password)->withUsername($username)->withPhoto('18845612541'));
        $res = $this->authclient->loginByUsername('1421112838',$password);
        $res = $this->authclient->unBindPhone();
        parent::assertNotNull($res);
    }

    public function test_updateEmail()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $username = $this->randomString();
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password)->withUsername($username)->withPhoto('18845612541'));
        $res = $this->authclient->loginByUsername('1421112838',$password);
        $res = $this->authclient->updateEmail();
        parent::assertNotNull($res);
    }

    public function test_updatePassword()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $username = $this->randomString();
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password)->withUsername($username)->withPhoto('18845612541'));
        $res = $this->authclient->loginByUsername($username,$password);
        $res = $this->authclient->updatePassword('12345678',$password);
        $res = $this->authclient->loginByUsername($username,'12345678');

        parent::assertNotNull($res);
    }

    public function test_updatePhone()
    {
        //$res = $this->authclient->loginByUsername($username,$password);
        $res = $this->authclient->updatePhone('','','18856980539','');

        parent::assertNotNull($res);
    }

    public function test_listApplications()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $username = $this->randomString();
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password)->withUsername($username)->withPhoto('18845612541'));
        $res = $this->authclient->loginByUsername($username,$password);
        $res = $this->authclient->listApplications();

        parent::assertNotNull($res);
    }

    public function test_listOrgs()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $username = $this->randomString();
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password)->withUsername($username)->withPhoto('18845612541'));
        $res = $this->authclient->loginByUsername($username,$password);
        $res = $this->authclient->listOrgs();

        parent::assertNotNull($res);
    }
    public function test_getCodeChallengeDigest()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $username = $this->randomString();
        $user = $this->userclient->create((new CreateUserInput())->withEmail($email)->withPassword($password)->withUsername($username)->withPhoto('18845612541'));
        $res = $this->authclient->loginByUsername($username,$password);
        $rcode = $this->authclient->generateCodeChallenge();
        $res = $this->authclient->getCodeChallengeDigest(['codeChallenge'=> "S256"]);

        parent::assertNotNull($res);
    }

    public function test_computedPasswordSecurityLevel()
    {

        $res = $this->authclient->computedPasswordSecurityLevel('124235@4q3q4');
        parent::assertNotNull($res);
    }
}
