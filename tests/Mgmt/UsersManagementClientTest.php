<?php

use Test\TestConfig;
use PHPUnit\Framework\TestCase;
use Authing\Mgmt\ManagementClient;
use Authing\Types\CreateUserInput;
use Authing\Types\UpdateUserInput;
use Authing\Types\IsUserExistsParam;
use Authing\Mgmt\Utils;
use Authing\Mgmt\UsersManagementClient;

class UsersManagementClientTest extends TestCase
{
    /**
     * @var UsersManagementClient
     */
    private $client;
    private $_testConfig;

    private function randomString()
    {
        return rand() . '';
    }

    public function setUp(): void
    {
        $moduleName = str_replace('ClientTest', '', __CLASS__);
        $manageConfig = (object) TestConfig::getConfig('Management');
        $this->_testConfig = (object) TestConfig::getConfig($moduleName);
        $management = new ManagementClient(
            $manageConfig->userPoolId,
            $manageConfig->userPoolSercet
        );
        $management->requestToken();
        $this->client = $management->users();
    }

    public function test_paginate()
    {
        $users = $this->client->paginate();
        parent::assertNotNull($users);
    }

    public function test_create()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = $this->_testConfig->password;
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
        $password = $this->_testConfig->password;
        $user = $this->client->create(
            (new CreateUserInput())
                ->withEmail($email)
                ->withPassword($password)
        );

        $user = $this->client->update(
            $user->id,
            (new UpdateUserInput())
                ->withNickname("nickname")
        );
        $this->assertEquals("nickname", $user->nickname);
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
        $query = $this->_testConfig->username;
        $this->client->search($query);
    }

    public function test_batch()
    {
        $users = $this->client->paginate()->data;
        $length = count($users);
        $userIds = array_map(function ($item) {
            return $item->id;
        }, $users);
        $resUsers = $this->client->batch($userIds);
        parent::assertEquals(count($resUsers), $length);
    }

    public function test_delete()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = $this->_testConfig->password;
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->delete($user->id);
        $this->assertEquals(200, $message->code);
    }

    public function test_deleteMany()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = $this->_testConfig->password;
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
        $params = (new IsUserExistsParam())->withUsername($this->_testConfig->username);
        $flag = $this->client->exists($params);
        $this->assertTrue($flag);
        $params = (new IsUserExistsParam())->withUsername(Utils::randomString(5));
        $flag = $this->client->exists($params);
        $this->assertFalse($flag);
    }

    public function test_checkLoginStatus()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = $this->_testConfig->password;
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->checkLoginStatus($user->token);
        $this->assertEquals(200, $message->code);
    }

    public function test_listGroups()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = $this->_testConfig->password;
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->listGroups($user->id);
        $this->assertEquals(200, $message->code);
    }

    public function test_addGroup()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = $this->_testConfig->password;
        $user = $this->client->create(
            (new CreateUserInput())
                ->withEmail($email)
                ->withPassword($password)
        );
        $groupId = $this->_testConfig->groupId;

        $message = $this->client->addGroup($user->id, $groupId);
        $this->assertEquals(200, $message->code);
    }

    public function test_removeGroup()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = $this->_testConfig->password;
        $user = $this->client->create(
            (new CreateUserInput())
                ->withEmail($email)
                ->withPassword($password)
        );
        $groupId = $this->_testConfig->groupId;

        $message = $this->client->removeGroup($user->id, $groupId);
        $this->assertEquals(200, $message->code);
    }

    public function test_listRoles()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = $this->_testConfig->password;
        $user = $this->client->create(
            (new CreateUserInput())
            ->withEmail($email)
            ->withPassword($password)
        );
        $message = $this->client->listRoles($user->id);
        $this->assertEquals(200, $message->code);
    }

    public function test_addRoles()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = $this->_testConfig->password;
        $user = $this->client->create(
            (new CreateUserInput())
            ->withEmail($email)
            ->withPassword($password)
        );
        $roles = $this->_testConfig->roleCodes;
        $message = $this->client->addRoles($user->id, $roles);
        $this->assertEquals(200, $message->code);
    }

    public function test_removeRoles()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = $this->_testConfig->password;
        $user = $this->client->create(
            (new CreateUserInput())
            ->withEmail($email)
            ->withPassword($password)
        );
        $roles = $this->_testConfig->roleCodes;
        $this->client->addRoles($user->id, $roles);

        $lastRole = $roles[count($roles) - 1];
        $message = $this->client->removeRoles($user->id, [$lastRole]);
        $this->assertEquals(200, $message->code);
    }

    public function test_refreshToken()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->refreshToken($user->id);
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
        $password = $this->_testConfig->password;
        $user = $this->client->create(
            (new CreateUserInput())
            ->withEmail($email)
            ->withPassword($password)
        );
        $policies = $this->_testConfig->policies;
        $message = $this->client->addPolicies($user->id, $policies);
        $this->assertEquals(200, $message->code);
    }

    public function test_removePolicies()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = $this->_testConfig->password;
        $user = $this->client->create(
            (new CreateUserInput())
            ->withEmail($email)
            ->withPassword($password)
        );
        $policies = $this->_testConfig->policies;
        $this->client->addPolicies($user->id, $policies);

        $lastPolicie = $policies[count($policies) - 1];
        $message = $this->client->removePolicies(
            $user->id,
            [$lastPolicie]
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

        $key = 'key';
        $value = 'value';
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
            $user->id
        ]);
        parent::assertNotNull($udf);
    }

    public function test_setUdfValue()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $udfValue = [
            'school' => '华中科技大学',
            'age' => 20,
        ];
        $res = $this->client->setUdfValue($user->id, $udfValue);
        parent::assertNotNull($res);
    }

    public function test_setUdfValueBatch()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $udfValue = [
            [
                'userId' => 'USER_ID1',
                'data' => (object)[
                'school' => '华中科技大学',
                ],
            ],
            [
                'userId' => 'USER_ID2',
                'data' => (object)[
                'school' => '清华大学',
                'age' => 100,
                ],
            ],
        ];
        $res = $this->client->setUdfValueBatch($user->id, $udfValue);
        parent::assertNotNull($res);
    }

    public function test_removeUdfValue()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $udfValue = [
            'school' => '华中科技大学',
            'age' => 20,
        ];
        $res = $this->client->setUdfValue($user->id, $udfValue);
        
        $res = $this->client->removeUdfValue($user->id, 'school');
        parent::assertNotNull($res);
    }

    public function test_listOrgs()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $res = $this->client->listOrgs($user->id);
        $this->assertEquals(true, count($res) == 0);
    }

    public function test_listAuthorizedResources()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = 'password';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $namespace = "";
        $res = $this->client->listAuthorizedResources($user->id, $namespace);
        $this->assertEquals(true, count($res) == 0);
    }

    public function test_find()
    {
        $res = $this->client->find([
            'username' => $this->_testConfig->username
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
        $userId = $this->_testConfig->testUserId;
        $data = $this->client->listDepartment($userId);
        parent::assertNotEmpty($data);
    }

    public function test_getUdfValue()
    {
        $userId = $this->_testConfig->testUserId;
        $data = $this->client->getUdfValue($userId);
        parent::assertNotEmpty($data);
    }

    public function test_kick()
    {
        // 用户 token 功能消失

    }

    public function test_listUserActions()
    {
        $res = $this->client->listUserActions();
        parent::assertNotNull($res);
    }

    public function test_hasRole()
    {
        $userId = $this->_testConfig->testUserId;
        $userRole = $this->_testConfig->testUserRole;
        $this->client->hasRole($userId, $userRole, '');
    }

}
