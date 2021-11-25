<?php
include_once '..\config\TestConfig.php';
include_once '..\..\src\Mgmt\GroupsManagementClient.php';

use Test\TestConfig;
use Authing\Mgmt\GroupsManagementClient;
use Authing\Mgmt\ManagementClient;
use PHPUnit\Framework\TestCase;

class GroupsManagementClientTest extends TestCase
{
    /**
     * @var GroupsManagementClient
     */
    private $groupsManagement;


    private function randomString()
    {
        return rand() . '';
    }

    public function setUp(): void
    {
        $management = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        $management->requestToken();
        $this->groupsManagement = $management->groups();
    }

    public function testPaginate()
    {
        $groups = $this->groupsManagement->paginate();
        $this->assertEquals(true, $groups->totalCount > 0);
    }

    public function testCreate()
    {
        $code = $this->randomString();
        $group = $this->groupsManagement->create($code, "group name");
        $this->assertEquals($code, $group->code);
    }

    public function testUpdate()
    {
        $code = $this->randomString();
        $group = $this->groupsManagement->create($code, "group name");

        $group = $this->groupsManagement->update($group->code, "desc");
        $this->assertEquals("desc", $group->name);
    }

    public function testDetail()
    {
        $code = $this->randomString();
        $group = $this->groupsManagement->create($code, "group name");

        $group = $this->groupsManagement->detail($group->code);
        $this->assertEquals($code, $group->code);
    }

    public function testDelete()
    {
        $code = $this->randomString();
        $group = $this->groupsManagement->create($code, "group name");

        $message = $this->groupsManagement->delete($group->code);
        $this->assertEquals(200, $message->code);
    }

    public function testDeleteMany()
    {
        $code = $this->randomString();
        $group = $this->groupsManagement->create($code, "group name");

        $message = $this->groupsManagement->deleteMany([$group->code]);
        $this->assertEquals(200, $message->code);
    }

    public function testAddUsers()
    {
        $code = $this->randomString();
        $group = $this->groupsManagement->create($code, "group name");
        $group = $this->groupsManagement->addUsers($group->code, ['614fd9ae42b192fc32823b10']);
        $this->assertNotNull($group);
    }

    public function testRemoveUsers()
    {
        $code = $this->randomString();
        $group = $this->groupsManagement->create($code, "aaa");
        $this->groupsManagement->addUsers($group->code, ['614fd9ae42b192fc32823b10']);
        $group = $this->groupsManagement->removeUsers($code, ['614fd9ae42b192fc32823b10']);
        $this->assertNotNull($group);
    }

    public function testListAuthorizedResources()
    {
        $result = $this->groupsManagement->listAuthorizedResources('aaa','default','API');
        $this->assertNotNull($result);
    }
}
