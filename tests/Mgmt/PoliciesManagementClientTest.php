<?php
include_once '..\config\TestConfig.php';
include_once '..\..\src\Mgmt\PoliciesManagementClient.php';

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
        $management = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        $management->requestToken();
        $this->policiesManagement = $management->policies();
    }

    public function testPaginate()
    {
        $policies = $this->policiesManagement->paginate();
        $this->assertEquals(true, $policies->totalCount > 0);
    }

    public function testCreate()
    {
        $code = $this->randomString();
        $statements = [new PolicyStatementInput("DATA:test", ["test:edit"],'ALLOW')];
        $policy = $this->policiesManagement->create($code, $statements);
        $this->assertEquals($code, $policy->code);
    }

    public function test_enableAssignment()
    {
        $code = $this->randomString();
        $statements = [new PolicyStatementInput("DATA:test_createresource", ["test_createresource:edit"],'ALLOW')];
        $policy = $this->policiesManagement->create($code, $statements);
        //"policies":["dleflDCmQ"],"targetType":"USER","targetIdentifiers":["614fd9ae42b192fc32823b10"],"namespace":"default"}
        $result = $this->policiesManagement->enableAssignment($code,'USER','614fd9ae42b192fc32823b10','default');
        $this->assertEquals(200, $result->code);

    }

    public function test_disableAssignment()
    {
        $code = $this->randomString();
        $statements = [new PolicyStatementInput("DATA:test_createresource1", ["test_createresource1:edit"],'ALLOW')];
        $policy = $this->policiesManagement->create($code, $statements);
        //"policies":["dleflDCmQ"],"targetType":"USER","targetIdentifiers":["614fd9ae42b192fc32823b10"],"namespace":"default"}
        $result = $this->policiesManagement->disableAssignment($code,'USER','614fd9ae42b192fc32823b10','default');
        $this->assertEquals(200, $result->code);

    }

    public function test_listAssignments()
    {
        $policy = $this->policiesManagement->listAssignments('675292908');
        $this->assertNotNull($policy);
    }


    public function testUpdate()
    {
        $code = $this->randomString();
        $statements = [new PolicyStatementInput("DATA:test_createresource", ["test_createresource:edit"],'ALLOW')];
        $policy = $this->policiesManagement->create($code, $statements);

        $statements = [new PolicyStatementInput("DATA:test_createresource", ["test_createresource:delete"],'ALLOW')];

        $policy = $this->policiesManagement->update($policy->code, $statements);

        $policy = $this->policiesManagement->detail($policy->code);
        $this->assertEquals($code, $policy->code);
    }

    public function testDetail()
    {
        $code = $this->randomString();
        $statements = [new PolicyStatementInput("DATA:test_createresource", ["test_createresource:edit"],'ALLOW')];
        $policy = $this->policiesManagement->create($code, $statements);

        $policy = $this->policiesManagement->detail($policy->code);
        $this->assertEquals($code, $policy->code);
    }

    public function testDelete()
    {
        $code = $this->randomString();
        $statements = [new PolicyStatementInput("DATA:test_createresource", ["test_createresource:edit"],'ALLOW')];
        $policy = $this->policiesManagement->create($code, $statements);

        $message = $this->policiesManagement->delete($policy->code);
        $this->assertEquals(200, $message->code);
    }

    public function testDeleteMany()
    {
        $code = $this->randomString();
        $statements = [new PolicyStatementInput("DATA:test_createresource", ["test_createresource:edit"],'ALLOW')];
        $policy = $this->policiesManagement->create($code, $statements);

        $message = $this->policiesManagement->deleteMany([$policy->code]);
        $this->assertEquals(200, $message->code);
    }

    public function test_addAssignments()
    {
        $result = $this->policiesManagement->addAssignments(['675292908'],'USER',['614fd9ae42b192fc32823b10']);
        $this->assertEquals(200, $result->code);
    }


    public function test_removeAssignments()
    {
        $result = $this->policiesManagement->removeAssignments(['675292908'],'USER',['614fd9ae42b192fc32823b10']);
        $this->assertEquals(200, $result->code);

    }



}
