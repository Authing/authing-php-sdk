<?php
use Test\TestConfig;
use PHPUnit\Framework\TestCase;
use Authing\Mgmt\ManagementClient;
use Authing\Types\PolicyAssignmentTargetType;
use Authing\Mgmt\Utils;
// use PHPUnit\Framework\Assert;
use Authing\Mgmt\Acl\AclManagementClient;

class AclManagementClientTest extends TestCase
{
    /**
     * @var AclManagementClient
     */
    private $client;

    private $_testConfig;

    public function setUp(): void
    {
        $moduleName = str_replace('ClientTest', '', __CLASS__);
        $manageConfig = (object) TestConfig::getConfig('Management');
        $this->_testConfig = (object) TestConfig::getConfig($moduleName);
        $management = new ManagementClient($manageConfig->userPoolId, $manageConfig->userPoolSercet);
        $management->requestToken();
        $this->aclManagement = $management->acls();
    }

    public function test_Allow()
    {
        $userId = $this->_testConfig->userId;
        $resource = $this->_testConfig->resource;
        $action = $this->_testConfig->action[0];
        
        $res = $this->client->allow($userId, $resource, $action);
        parent::assertNotNull($res);
    }

    public function test_IsAllowed()
    {
        $userId = $this->_testConfig->userId;
        $resource = $this->_testConfig->resource;
        $action = $this->_testConfig->action[0];

        $flag = $this->client->isAllowed($userId, $resource, $action);
        parent::assertTrue($flag);
    }

    public function test_listAuthorizedResources()
    {
        $targetType = PolicyAssignmentTargetType::USER;
        $userId = $this->_testConfig->testUserId;
        $namespace = 'default';
        $res = $this->client->listAuthorizedResources($targetType, $userId, $namespace);
        parent::assertNotNull($res);
    }

    public function test_getResources()
    {
        // $namespace = $this->_testConfig->namespace;

    }

    public function test_createResource()
    {
        $code = 'test_code';
        $type = 'DATA';
        $description = 'description';
        $actions = [
            (object) [
                'name' => 'test_create_resource',
                'description' => 'test_create_resource description'
            ]
        ];
        $res = $this->client->createResource([
            'code' => $code,
            'type' => $type,
            'description' => $description,
            'actions' => $actions,
            'namespace' => 'default',
        ]);
        parent::assertNotNull($res);
    }

    public function test_updateResource()
    {
        $code = 'test_code';
        $type = 'DATA';
        $description = 'new description';
        $actions = [
            (object) [
                'name' => 'new test_create_resource',
                'description' => 'new test_create_resource description'
            ]
        ];
        $res = $this->client->updateResource($code, [
            'type' => $type,
            'description' => $description,
            'actions' => $actions,
            'namespace' => 'default',
        ]);
        parent::assertNotNull($res);
    }

    public function test_deleteResource()
    {
        $targetType = PolicyAssignmentTargetType::USER;
        $userId = $this->_testConfig->testUserId;
        $namespace = 'default';
        $oldResource = $this->client->listAuthorizedResources($targetType, $userId, $namespace);
        $flag = $this->client->deleteResource('test_code', 'default');
        parent::assertTrue($flag);
        $newResource =
        $this->client->listAuthorizedResources($targetType, $userId, $namespace);
        parent::assertNotSame($oldResource->data, $newResource->data);
    }

    public function test_programmaticAccessAccountList()
    {
        $appId = $this->_testConfig->appId;
        $res = $this->aclManagement->programmaticAccessAccountList($appId);
        parent::assertNotEmpty($res);
        parent::assertNotEmpty($res->data);
        parent::assertEquals(gettype($res->data->list), 'array');
    }

    public function test_createProgrammaticAccessAccount()
    {
        $appId = $this->_testConfig->appId;
        $res = $this->client->createProgrammaticAccessAccount($appId);
        parent::assertNotNull($res);
    }

    public function test_disableProgrammaticAccessAccount()
    {
        $appId = $this->_testConfig->appId;
        $res = $this->client->createProgrammaticAccessAccount($appId);
        parent::assertNotNull($res);
        $data = $this->client->disableProgrammaticAccessAccount($res->id);
        parent::assertNotNull($data);
    }

    public function test_listNamespaces()
    {
        $data = $this->client->listNamespaces();
        parent::assertNotNull($data);
    }

    public function test_deleteNamespace()
    {
        $oldNamespaces = $this->client->listNamespaces();
        parent::assertNotNull($oldNamespaces);

        $namespace = $oldNamespaces->data[0];
        $flag = $this->client->deleteNamespace($namespace);
        parent::assertTrue($flag);
    }

    public function test_createNamespace()
    {
        $code = Utils::randomString(5);
        $name = Utils::randomString(5);
        $description = Utils::randomString(5);
        $res = $this->client->createNamespace($code, $name, $description);
        parent::assertNotNull($res);
    }

    public function test_updateNamespace()
    {
        $code = Utils::randomString(5);
        $name = Utils::randomString(5);
        $description = Utils::randomString(5);
        $res = $this->client->createNamespace($code, $name, $description);
        parent::assertNotNull($res);

        $newName =
        Utils::randomString(5);
        $res = $this->client->updateNamespace($code, [
            'name' => $newName,
            // 'description' => $description
        ]);
        parent::assertNotNull($res);
        parent::assertEquals($res->name, $newName);
    }

    public function test_deleteProgrammaticAccessAccount()
    {
        $appId = $this->_testConfig->appId;
        $res = $this->client->createProgrammaticAccessAccount($appId);
        parent::assertNotNull($res);
        $res = $this->client->deleteProgrammaticAccessAccount($res->id);
        parent::assertTrue($res);
    }

    public function test_enableProgrammaticAccessAccount()
    {
        $appId = $this->_testConfig->appId;
        $res = $this->client->createProgrammaticAccessAccount($appId);
        parent::assertNotNull($res);
        $res = $this->client->enableProgrammaticAccessAccount($res->id);
        parent::assertNotNull($res);
    }

    public function test_refreshProgrammaticAccessAccountSecret()
    {
        $appId = $this->_testConfig->appId;
        $res = $this->client->createProgrammaticAccessAccount($appId);
        parent::assertNotNull($res);
        $data = $this->client->refreshProgrammaticAccessAccountSecret($res->id);
        parent::assertEquals($res->id, $data->id);
        // parent::assertNotEquals($res->id, $data->id);
    }

    public function test_authorizeResource()
    {
        // $this->client->authorizeResource();
    }

    public function test_getAuthorizedTargets()
    {
        $data = [
            'namespace' => '6063f88dabb536e9a23a6c80',
            'resource' => 'book',
            'resourceType' => 'DATA',
            'actions' => (object)[
                'op' => 'OR',
                'list' => ['write', 'read']
            ],
            'targetType' => 'USER'
        ];
        $res = $this->client->getAuthorizedTargets($data);
        parent::assertNotNull($res);
    }

    public function test_listResourcePermissions()
    {
        $data = $this->client->listResourcePermissions();
        parent::assertNotNull($data);
    }

    public function test_listResources()
    {
        $res = $this->client->listResources([
            'namespace' => 'default'
        ]);
        parent::assertNotNull($res);
    }

    public function test_getAccessPolicies()
    {
        # code...
    }

    public function test_enableAccessPolicy()
    {
        # code...
    }

    public function test_disableAccessPolicy()
    {
        # code...
    }

    public function test_deleteAccessPolicy()
    {
        # code...
    }

    public function test_allowAccess()
    {
        # code...
    }

    public function test_denyAccess()
    {
        # code...
    }

    public function test_updateDefaultAccessPolicy()
    {
        # code...
    }

}
