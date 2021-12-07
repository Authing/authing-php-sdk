<?php
include_once '..\config\TestConfig.php';
include_once '..\..\src\Mgmt\UsersManagementClient.php';
include_once '..\..\src\Auth\AuthenticationClient.php';
use Test\TestConfig;
use PHPUnit\Framework\TestCase;
use Authing\Mgmt\ManagementClient;
use Authing\Types\CreateUserInput;
use Authing\Types\UpdateUserInput;
use Authing\Types\IsUserExistsParam;
use Authing\Mgmt\Utils;
use Authing\Mgmt\UsersManagementClient;
use Authing\Auth\AuthenticationClient;

class UsersManagementClientTest extends TestCase
{
    /**
     * @var UsersManagementClient
     */
    private $client;

    /**
     * @var AuthenticationClient
     */
    private $authclient;

    private function randomString()
    {
        return rand() . '';
    }

    public function setUp(): void
    {
//        $moduleName = str_replace('ClientTest', '', __CLASS__);
//        $manageConfig = (object) TestConfig::getConfig('Management');
//        $this->_testConfig = (object) TestConfig::getConfig($moduleName);
        $management = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        $management->requestToken();
        $this->client = $management->users();

        $this->authclient = new AuthenticationClient(function ($opts) {
            $opts->appId = "61319680ea8b30c9ca9ca071";
        });
    }

    public function test_paginate()
    {
        $users = $this->client->paginate();
        parent::assertNotNull($users);
    }

    public function test_create()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create(
            (new CreateUserInput())
                ->withEmail($email)
                ->withPassword($password)
        );
        parent::assertNotNull($user);
        parent::assertEquals($email, $user->email);
    }

    public function test_update()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create(
            (new CreateUserInput())
                ->withEmail($email)
                ->withPassword($password)
        );

        $updates = (new UpdateUserInput())->withEmail($email)->withUsername('nickname11');
        $user = $this->client->update(
            $user->id,
            $updates
        );
        $this->assertEquals("nickname11", $user->username);
    }

    public function test_detail()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create(
            (new CreateUserInput())
                ->withEmail($email)
                ->withPassword($password)
        );
        $user = $this->client->detail($user->id);
        $this->assertEquals($email, $user->email);
    }

    public function test_search()
    {

        $res = $this->client->search('nickname');
        parent::assertNotNull($res);

    }

    public function test_batch()
    {
//        $users = $this->client->paginate()->data;
//        $length = count($users);
//        $userIds = array_map(function ($item) {
//            return $item->id;
//        }, $users);
        $resUsers = $this->client->batch(['619ef8bd5479301aa3c4f268']);
        parent::assertNotNull($resUsers);
    }

    public function test_delete()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->delete($user->id);
        $this->assertEquals(200, $message->code);
    }

    public function test_deleteMany()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create(
            (new CreateUserInput())
                ->withEmail($email)
                ->withPassword($password)
        );

        $message = $this->client->deleteMany([$user->id]);
        $this->assertEquals(200, $message->code);
    }

    public function test_exists()
    {
        $params = (new IsUserExistsParam())->withUsername('nickname');
        $flag = $this->client->exists($params);
        $this->assertTrue($flag);
        $params = (new IsUserExistsParam())->withUsername(Utils::randomString(5));
        $flag = $this->client->exists($params);
        $this->assertFalse($flag);
    }

    public function test_logout(){
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));
        $res = $this->authclient->loginByEmail($email,$password);
        $message = $this->client->checkLoginStatus($res->token);
        $res1 = $this->client->logout(['userId'=>$user->id,'appId'=>'61319680ea8b30c9ca9ca071']);
        $message = $this->client->checkLoginStatus($user->token);
        parent::assertNotNull($res);

    }

    public function test_sendFirstLoginVerifyEmail(){
        $email = '11348@qq.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->sendFirstLoginVerifyEmail($user->id,'61319680ea8b30c9ca9ca071');
        $json_string = json_encode($message);
        echo $json_string;
        parent::assertNotNull($message);

    }

    public function test_checkLoginStatus()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->checkLoginStatus($user->token);
        $this->assertEquals(200, $message->code);
    }

    public function test_listGroups()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->listGroups('619efb608a4eb70503b64d17');
        $this->assertEquals(200, $message->code);
    }

    public function test_addGroup()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create(
            (new CreateUserInput())
                ->withEmail($email)
                ->withPassword($password)
        );

        $message = $this->client->addGroup($user->id, '2110899804');
        $this->assertEquals(200, $message->code);
    }

    public function test_removeGroup()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create(
            (new CreateUserInput())
                ->withEmail($email)
                ->withPassword($password)
        );

        $message = $this->client->addGroup($user->id, '2110899804');

        $message = $this->client->removeGroup($user->id, '2110899804');
        $this->assertEquals(200, $message->code);
    }

    public function test_listRoles()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create(
            (new CreateUserInput())
            ->withEmail($email)
            ->withPassword($password)
        );
        $this->client->addRoles($user->id, ['asafda']);
        $message = $this->client->listRoles($user->id);
        $this->assertEquals(200, $message->code);
    }

    public function test_addRoles()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create(
            (new CreateUserInput())
            ->withEmail($email)
            ->withPassword($password)
        );

        $message = $this->client->addRoles($user->id, ['asafda']);
        $this->assertEquals(200, $message->code);
    }

    public function test_removeRoles()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create(
            (new CreateUserInput())
                ->withEmail($email)
                ->withPassword($password)
        );

         $this->client->addRoles($user->id, ['asafda']);

        $message = $this->client->removeRoles($user->id, ['asafda']);
        $this->assertEquals(200, $message->code);
    }

    public function test_refreshToken()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->refreshToken($user->id);
        $json_string = json_encode($message);
        echo $json_string;
        $this->assertNotEquals(null, $message->token);
    }

    public function test_listPolicies()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $policies = $this->client->listPolicies($user->id);
        $this->assertEquals(true, $policies->totalCount == 0);
    }

    public function test_addPolicies()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create(
            (new CreateUserInput())
            ->withEmail($email)
            ->withPassword($password)
        );

        $message = $this->client->addPolicies($user->id, ['595703619']);
        $this->assertEquals(200, $message->code);
    }

    public function test_removePolicies()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create(
            (new CreateUserInput())
            ->withEmail($email)
            ->withPassword($password)
        );
        $this->client->addPolicies($user->id,['595703619']);

        $message = $this->client->removePolicies(
            $user->id,
            ['595703619']
        );
        $this->assertEquals(200, $message->code);
    }

    public function test_listUdv()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $udvs = $this->client->listUdv($user->id);
        $this->assertEquals(true, count($udvs) == 0);
    }

    public function test_setUdv()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $key = 'school2';
        $value = 'STRING';
        $udvs = $this->client->setUdv($user->id, $key, $value);
        parent::assertNotNull($udvs);
    }

    public function test_removeUdv()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $key = 'key';
        $value = 'value';
        $udv = $this->client->setUdv($user->id, $key, $value);
        parent::assertNotNull($udv);

        $flag = $this->client->removeUdv($user->id, $key);
        parent::assertNotNull($flag);
    }

    public function test_getUdfValueBatch()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $udf = $this->client->getUdfValueBatch([
            '619dff15a36bed4f4362d176',
            '619dff0ca7fa40e5cea8773d'
        ]);
        parent::assertNotNull($udf);
    }

    public function test_setUdfValue()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $udfValue = [
            'school' => '25',
            'age' => '20'
        ];
        $res = $this->client->setUdfValue($user->id, $udfValue);
        parent::assertNotNull($res);
    }

    public function test_setUdfValueBatch()
    {
        $res = $this->client->setUdfValueBatch([
            [
                'userId' => '619dff15a36bed4f4362d176',
                'data' => (object)[
                    'school' => 'new 华中科技大学',
                    'age' => '100'
                ],
            ],
            [
                'userId' => '619dff0ca7fa40e5cea8773d',
                'data' => (object)[
                    'school' => 'new 清华大学',
                    'age' => '100'
                ],
            ],
        ]);
        parent::assertNotNull($res);
    }

    public function test_removeUdfValue()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $udfValue = [
            'school' => '华中科技大学',
            'age' => '20'
        ];
        $res = $this->client->setUdfValue($user->id, $udfValue);
        
        $res = $this->client->removeUdfValue($user->id, 'school');
        parent::assertNotNull($res);
    }

    public function test_listOrgs()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $res = $this->client->listOrgs('614fd9ae42b192fc32823b10');

        $json_string = json_encode($res);
        echo $json_string;
        $this->assertEquals(true, count($res) == 0);
    }

    public function test_listAuthorizedResources()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $namespace = "default";
        $res = $this->client->listAuthorizedResources($user->id, $namespace);
        $this->assertNotNull($res);
    }

    public function test_find()
    {
        $res = $this->client->find([
            'username' => 'nickname'
        ]);
        parent::assertNotNull($res);
    }

    public function test_listArchivedUsers()
    {
        $data = $this->client->listArchivedUsers();
        parent::assertNotEmpty($data);
    }

    public function test_listDepartment()
    {

        $data = $this->client->listDepartment('614fd9ae42b192fc32823b10');
        $json_string = json_encode($data);
        echo $json_string;
        parent::assertNotEmpty($data);
    }

    public function test_getUdfValue()
    {
        $data = $this->client->getUdfValue('619dff691e2bdae581c80fbd');
        parent::assertNotEmpty($data);
    }

    public function test_kick()
    {
        $res = $this->client->kick(['619e0c347bbfad002df1f043']);
        parent::assertEquals(200,$res->code);

    }

    public function test_listUserActions()
    {
        $res = $this->client->listUserActions();
        parent::assertNotNull($res);
    }

    public function test_hasRole()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create(
            (new CreateUserInput())
                ->withEmail($email)
                ->withPassword($password)
        );

        $this->client->addRoles($user->id, ['asafda']);
        $result = $this->client->hasRole($user->id, 'asafda1', '');
        parent::assertNotNull($result);

    }

}
