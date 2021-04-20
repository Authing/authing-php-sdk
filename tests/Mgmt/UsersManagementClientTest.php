<?php

use Test\TestConfig;
use PHPUnit\Framework\TestCase;
use Authing\Mgmt\ManagementClient;
use Authing\Types\CreateUserInput;
use Authing\Types\UpdateUserInput;
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
        $management = new ManagementClient($manageConfig->userPoolId, $manageConfig->userPoolSercet);
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
        $password = '123456';
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
        $userIds = array_map(function($item) {
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
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->refreshToken($user->id);
        $this->assertNotEquals(null, $message->token);
    }

    public function test_listPolicies()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $policies = $this->client->listPolicies($user->id);
        $this->assertEquals(true, $policies->totalCount == 0);
    }

    public function test_addPolicies()
    {
        # code...
    }

    public function test_removePolicies()
    {
        # code...
    }

    public function test_listUdv()
    {
        # code...
    }

    public function test_setUdv()
    {
        # code...
    }

    public function test_removeUdv()
    {
        # code...
    }

    public function test_getUdfValueBatch()
    {
        # code...
    }

    public function test_setUdfValue()
    {
        # code...
    }

    public function test_setUdfValueBatch()
    {
        # code...
    }

    public function test_removeUdfValue()
    {
        # code...
    }

    public function test_listOrgs()
    {
        # code...
    }

    public function test_listAuthorizedResources()
    {
        # code...
    }

    public function test_find()
    {
        # code...
    }

    public function test_listArchivedUsers()
    {
        $data = $this->client->listArchivedUsers();
        parent::assertNotEmpty($data);
    }

    public function test_listDepartment()
    {
        $userId = $this->_testConfig->userId;
        $data = $this->client->listDepartment($userId);
        parent::assertNotEmpty($data);
    }

    public function test_getUdfValue()
    {
        $userId = $this->_testConfig->userId;
        $data = $this->client->getUdfValue($userId);
        parent::assertNotEmpty($data);
    }

    public function test_kick()
    {
        # code...
    }

    public function test_listUserActions()
    {
        # code...
    }

    public function test_hasRole()
    {
        # code...
    }

    public function test_setUdvBatch()
    {
        // $data = $this->client->setUdfValueBatch();
        // parent::assertNotEmpty($data);
    }
}
