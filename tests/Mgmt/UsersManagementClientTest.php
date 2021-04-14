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

    private function randomString() {
        return rand() . '';
    }

    public function setUp(): void
    {
        $management = new ManagementClient("59f86b4832eb28071bdd9214", "4b880fff06b080f154ee48c9e689a541");
        $management->setHost("http://localhost:3000");
        $management->requestToken();
        $this->client = $management->users();
    }

    public function testPaginate() {
        $users = $this->client->paginate();
        $this->assertEquals(true, $users->totalCount > 0);
    }

    public function testCreate() {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));
        $this->assertEquals($email, $user->email);
    }

    public function testUpdate() {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $user = $this->client->update($user->id, (new UpdateUserInput())->withNickname("nickname"));
        $this->assertEquals("nickname", $user->nickname);
    }

    public function testDetail() {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $user = $this->client->detail($user->id);
        $this->assertEquals($email, $user->email);
    }

    public function testDelete() {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->delete($user->id);
        $this->assertEquals(200, $message->code);
    }

    public function testDeleteMany() {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->deleteMany([$user->id]);
        $this->assertEquals(200, $message->code);
    }

    public function testRefreshToken() {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->refreshToken($user->id);
        $this->assertNotEquals(null, $message->token);
    }

    public function testCheckLoginStatus() {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $message = $this->client->checkLoginStatus($user->token);
        $this->assertEquals(200, $message->code);
    }

    public function testListRoles() {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $roles = $this->client->listRoles($user->id);
        $this->assertEquals(true, $roles->totalCount == 0);
    }

    public function testListPolicies() {
        $email = $this->randomString() . '@gmail.com';
        $password = '123456';
        $user = $this->client->create((new CreateUserInput())->withEmail($email)->withPassword($password));

        $policies = $this->client->listPolicies($user->id);
        $this->assertEquals(true, $policies->totalCount == 0);
    }
}