<?php

use Authing\Mgmt\GroupsManagementClient;
use Authing\Mgmt\ManagementClient;
use PHPUnit\Framework\TestCase;

class GroupsManagementClientTest extends TestCase
{
    /**
     * @var GroupsManagementClient
     */
    private $groupsManagement;

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
}
