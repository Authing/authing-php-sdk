<?php

use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\UsersManagementClient;
use Authing\Types\CreateUserInput;
use Authing\Types\UpdateUserInput;
use PHPUnit\Framework\TestCase;

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

    public function testPaginate()
    {
        $users = $this->client->paginate();
        $this->assertEquals(true, $users->totalCount > 0);
    }

    public function testCreate()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));
        $this->assertEquals($email, $user->email);
    }

    public function testUpdate()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $user = $this->client->update($user->id, (new UpdateUserInput())->withNickname("nickname"));
        $this->assertEquals("nickname", $user->nickname);
    }

    public function testDetail()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $user = $this->client->detail($user->id);
        $this->assertEquals($email, $user->email);
    }

    public function testDelete()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->delete($user->id);
        $this->assertEquals(200, $message->code);
    }

    public function testDeleteMany()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->deleteMany([$user->id]);
        $this->assertEquals(200, $message->code);
    }

    public function testRefreshToken()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->refreshToken($user->id);
        $this->assertNotEquals(null, $message->token);
    }

    public function testCheckLoginStatus()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->checkLoginStatus($user->token);
        $this->assertEquals(200, $message->code);
    }

    public function testListRoles()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $roles = $this->client->listRoles($user->id);
        $this->assertEquals(true, $roles->totalCount == 0);
    }

    public function testListPolicies()
    {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $policies = $this->client->listPolicies($user->id);
        $this->assertEquals(true, $policies->totalCount == 0);
    }

    public function testGetUdfValue()
    {
        $userId = $this->_testConfig->userId;
        $data = $this->client->getUdfValue($userId);
        parent::assertNotEmpty($data);
    }

    public function testListArchivedUsers()
    {
        $data = $this->client->listArchivedUsers();
        parent::assertNotEmpty($data);
    }

    public function testListDepartment()
    {
        $userId = $this->_testConfig->userId;
        $data = $this->client->listDepartment($userId);
        parent::assertNotEmpty($data);
    }

    public function testSetUdvBatch()
    {
        $data = $this->client->setUdfValueBatch();
        parent::assertNotEmpty($data);
    }

    
}
