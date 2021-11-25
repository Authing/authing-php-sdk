<?php
include_once 'D:\authing-php-sdk\tests\config\TestConfig.php';
use Test\TestConfig;
use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\OrgManagementClient;
use PHPUnit\Framework\TestCase;

class OrgManagementClientTest extends TestCase
{
    /**
     * @var OrgManagementClient
     */
    private $orgManagement;


    private function randomString()
    {
        return rand() . '';
    }

    public function setUp(): void
    {
        $management = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        $management->requestToken();
        $this->orgManagement = $management->orgs();
    }

    public function test_create()
    {
        $orgname = $this->randomString();
        $node = $this->orgManagement->create($orgname, '新建的组织结构', $orgname);

        parent::assertNotEmpty($node);
    }

    public function test_deleteById()
    {
        $orgname = $this->randomString();
        $node = $this->orgManagement->create($orgname, '新建的组织结构', $orgname);
        $node = $this->orgManagement->deleteById($node->id);
        parent::assertEquals(200,$node->code);
    }

    public function testGetNodeById()
    {
        // nodeId
        $nodeId = $this->_testConfig->nodeId;
        $node = $this->orgManagement->getNodeById($nodeId);
        parent::assertNotEmpty($node);
        parent::assertEquals($nodeId, $node->id);
    }

    public function test_findById()
    {
        $orgname = $this->randomString();
        $node = $this->orgManagement->create($orgname, '新建的组织结构', $orgname);
        $result = $this->orgManagement->findById($node->id);
        parent::assertNotNull($result);
    }

    public function test_addMembers()
    {
        $result = $this->orgManagement->addMembers('619dd41e757e82bc908df26f'
            ,['6181f8c4e62a39913c550504']);
        parent::assertNotNull($result);
    }

    public function test_listMembers()
    {
        $result = $this->orgManagement->listMembers('619dd41e757e82bc908df26f',[
            'includeChildrenNodes' => true
        ]);
        parent::assertNotNull($result);
    }

    public function test_updateNode()
    {
        $orgname = $this->randomString();
        $node = $this->orgManagement->create($orgname, '新建的组织结构', $orgname);
        $result = $this->orgManagement->updateNode($node->id,['code'=>'newcode11','description'=>'description']);
        parent::assertNotNull($result);
    }

    public function test_moveNode()
    {
        $result = $this->orgManagement->moveNode('619dd2e6606b23286db3f1a6',"619dd41e757e82bc908df26f","619dd87eff3026b6fb6777da");
        parent::assertNotNull($result);
    }

    public function test_listChildren()
    {
        $result = $this->orgManagement->listChildren('619dd2e6606b23286db3f1a6',"619dd2e6538518c7c6fe3632","619dd87eff3026b6fb6777da");
        parent::assertNotNull($result);
    }

    public function test_removeMembers()
    {
        $result = $this->orgManagement->removeMembers('619ca659ba7860b3504d290e',['614fd9ae42b192fc32823b10']);
        parent::assertNotNull($result);
    }

    public function test_addNode()
    {
        $result = $this->orgManagement->addNode('619dd2e6606b23286db3f1a6', '619dd2e6538518c7c6fe3632', [
            'name' => '测试节点',
            'code' => 'test-code111',
            'description' => '测试描述'
        ]);
        parent::assertNotNull($result);
    }

    public function test_deleteNode()
    {
        $result = $this->orgManagement->addNode('619dd2e6606b23286db3f1a6', '619dd2e6538518c7c6fe3632', [
            'name' => '测试节点222',
            'code' => 'test-code222',
            'description' => '测试描述'
        ]);

        $result = $this->orgManagement->deleteNode('619dd2e6606b23286db3f1a6',$result->id);
        parent::assertNotNull($result);
    }

    public function test_getNodeById()
    {
        $result = $this->orgManagement->addNode('619dd2e6606b23286db3f1a6', '619dd2e6538518c7c6fe3632', [
            'name' => '测试节点333',
            'code' => 'test-code333',
            'description' => '测试描述'
        ]);

        $result = $this->orgManagement->getNodeById($result->id);
        parent::assertNotNull($result);
    }


    public function test_isRootNode()
    {
        $code = $this->randomString();
        $result = $this->orgManagement->addNode('619dd2e6606b23286db3f1a6', '619dd2e6538518c7c6fe3632', [
            'name' =>$code,
            'code' => $code,
            'description' => '测试描述'
        ]);
        $result = $this->orgManagement->isRootNode('619dd2e6606b23286db3f1a6', $result->id);

        parent::assertNotNull($result);
    }

    public function test_rootNode()
    {
        $data = $this->orgManagement->rootNode('619dd2e6606b23286db3f1a6');
        parent::assertNotEmpty($data);
    }


    public function testExportByOrgId()
    {
        $data = $this->orgManagement->exportByOrgId('619dd2e6606b23286db3f1a6');
        parent::assertNotEmpty($data);
    }

    public function testExportAll()
    {
        $orgData = $this->orgManagement->exportAll();
        parent::assertNotEmpty($orgData);
    }

    public function testListAuthorizedResourcesByNodeId()
    {

        $data = $this->orgManagement->listAuthorizedResourcesByNodeId('619dd2e6538518c7c6fe3632', 'default');
        parent::assertNotEmpty($data);
    }

    public function testListAuthorizedResourcesByNodeCode()
    {
        $data = $this->orgManagement->listAuthorizedResourcesByNodeCode('619dd2e6606b23286db3f1a6', 'test-code', 'default');
        parent::assertNotEmpty($data);
    }

    public function testSetMainDepartment()
    {

        $data = $this->orgManagement->setMainDepartment('614fd9ae42b192fc32823b10', '619dd2e6538518c7c6fe3632');
        parent::assertNotEmpty($data->code);
    }

    public function test_paginate()
    {

        $data = $this->orgManagement->paginate();
        parent::assertNotEmpty($data->code);
    }

    public function test_importByJson()
    {
        $code = $this->randomString();
        $data = $this->orgManagement->importByJson([ 'name' =>$code,
            'code' => $code,
            'description' => '测试描述']);
        parent::assertNotNull($data);
    }
}
