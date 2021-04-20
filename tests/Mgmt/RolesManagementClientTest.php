<?php


use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\RolesManagementClient;
use Authing\Types\CreateRoleParam;
use PHPUnit\Framework\TestCase;

class RolesManagementClientTest extends TestCase
{
    /**
     * @var RolesManagementClient
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
        $this->client = $management->roles();
    }

    public function testPaginate() {
        $roles = $this->client->paginate();
        $this->assertEquals(true, $roles->totalCount > 0);
    }

    public function testCreate() {
        $code = $this->randomString();
        $role = $this->client->create($code);
        $this->assertEquals($code, $role->code);
    }

    public function testUpdate() {
        $code = $this->randomString();
        $role = $this->client->create($code);

        $role = $this->client->update($role->code, "desc");
        $this->assertEquals("desc", $role->description);
    }

    public function testDetail() {
        $code = $this->randomString();
        $role = $this->client->create($code);

        $role = $this->client->detail($role->code);
        $this->assertEquals($code, $role->code);
    }

    public function testDelete() {
        $code = $this->randomString();
        $role = $this->client->create($code);

        $message = $this->client->delete($role->code);
        $this->assertEquals(200, $message->code);
    }

    public function testDeleteMany() {
        $code = $this->randomString();
        $role = $this->client->create($code);

        $message = $this->client->deleteMany([$role->code]);
        $this->assertEquals(200, $message->code);
    }

    public function testListUsers() {
        $code = $this->randomString();
        $role = $this->client->create($code);

        $users = $this->client->listUsers($role->code);
        $this->assertEquals(true, $users->totalCount == 0);
    }

    public function testListPolicies() {
        $code = $this->randomString();
        $role = $this->client->create($code);

        $policies = $this->client->listPolicies($role->code);
        $this->assertEquals(true, $policies->totalCount == 0);
    }
}
