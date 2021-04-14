<?php


use Authing\Mgmt\GroupsManagementClient;
use Authing\Mgmt\ManagementClient;
use PHPUnit\Framework\TestCase;

class GroupsManagementClientTest extends TestCase
{
    /**
     * @var GroupsManagementClient
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
        $this->client = $management->groups();
    }

    public function testPaginate() {
        $groups = $this->client->paginate();
        $this->assertEquals(true, $groups->totalCount > 0);
    }

    public function testCreate() {
        $code = $this->randomString();
        $group = $this->client->create($code, "group name");
        $this->assertEquals($code, $group->code);
    }

    public function testUpdate() {
        $code = $this->randomString();
        $group = $this->client->create($code, "group name");

        $group = $this->client->update($group->code, "desc");
        $this->assertEquals("desc", $group->name);
    }

    public function testDetail() {
        $code = $this->randomString();
        $group = $this->client->create($code, "group name");

        $group = $this->client->detail($group->code);
        $this->assertEquals($code, $group->code);
    }

    public function testDelete() {
        $code = $this->randomString();
        $group = $this->client->create($code, "group name");

        $message = $this->client->delete($group->code);
        $this->assertEquals(200, $message->code);
    }

    public function testDeleteMany() {
        $code = $this->randomString();
        $group = $this->client->create($code, "group name");

        $message = $this->client->deleteMany([$group->code]);
        $this->assertEquals(200, $message->code);
    }
}