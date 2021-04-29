<?php

use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\PoliciesManagementClient;
use Authing\Types\PolicyStatementInput;
use PHPUnit\Framework\TestCase;

class PoliciesManagementClientTest extends TestCase
{
    /**
     * @var PoliciesManagementClient
     */
    private $policiesManagement;

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
        $this->policiesManagement = $management->policies();
    }

    public function testPaginate()
    {
        $policies = $this->client->paginate();
        $this->assertEquals(true, $policies->totalCount > 0);
    }

    public function testCreate()
    {
        $code = $this->randomString();
        $statements = [new PolicyStatementInput("book:123", ["book:edit"])];
        $policy = $this->client->create($code, $statements);
        $this->assertEquals($code, $policy->code);
    }

    public function testUpdate()
    {
        $code = $this->randomString();
        $statements = [new PolicyStatementInput("book:123", ["book:edit"])];
        $policy = $this->client->create($code, $statements);

        $statements = [new PolicyStatementInput("book:234", ["book:edit"])];

        $policy = $this->client->update($policy->code, $statements);
        $this->assertEquals($code, $policy->code);
    }

    public function testDetail()
    {
        $code = $this->randomString();
        $statements = [new PolicyStatementInput("book:123", ["book:edit"])];
        $policy = $this->client->create($code, $statements);

        $policy = $this->client->detail($policy->code);
        $this->assertEquals($code, $policy->code);
    }

    public function testDelete()
    {
        $code = $this->randomString();
        $statements = [new PolicyStatementInput("book:123", ["book:edit"])];
        $policy = $this->client->create($code, $statements);

        $message = $this->client->delete($policy->code);
        $this->assertEquals(200, $message->code);
    }

    public function testDeleteMany()
    {
        $code = $this->randomString();
        $statements = [new PolicyStatementInput("book:123", ["book:edit"])];
        $policy = $this->client->create($code, $statements);

        $message = $this->client->deleteMany([$policy->code]);
        $this->assertEquals(200, $message->code);
    }

    public function testDisableAssignment()
    {
        // $this->policiesManagement->disableAssignment();
    }

    public function testEnableAssignment()
    {
        // $this->policiesManagement->enableAssignment();
    }
}
