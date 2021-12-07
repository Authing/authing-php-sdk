<?php
include_once '..\config\TestConfig.php';
include_once '..\..\src\Mgmt\AclManagementClient.php';
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
        $management = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        $management->requestToken();
        $this->client = $management->acls();
    }

    private function randomString()
    {
        return rand() . '';
    }

    public function test_Allow()
    {
//        $userId = $this->_testConfig->userId;
//        $resource = $this->_testConfig->resource;
//        $action = $this->_testConfig->action[0];

        $result = $this->client->allow("614fd9ae42b192fc32823b10", "DATA:60a80d980ad35323242fcd8b", "5584:read");
        parent::assertEquals(200,$result->code);    }

    public function test_IsAllowed()
    {
//        $userId = $this->_testConfig->userId;
//        $resource = $this->_testConfig->resource;
//        $action = $this->_testConfig->action[0];

        $result = $this->client->isAllowed("614fd9ae42b192fc32823b10", "DATA:60a80d980ad35323242fcd8b", "5584:read",[
        'namespace' => 'pf3nn'
        ]);
        parent::assertEquals(false,$result);
    }

    public function test_listAuthorizedResources()
    {

        $res = $this->client->listAuthorizedResources('614fd9ae42b192fc32823b10', 'default', 'DATA');
        parent::assertNotNull($res);
    }

    public function test_getResources()
    {
        $res = $this->client->getResources([
            'namespace' => 'pf3nn',
            'type' => 'DATA',
        ]);
        parent::assertNotNull($res);

    }


    public function test_createResourceBatch()
    {
        $code = $this->randomString();
        $type = 'DATA';
        $description = 'description';
        $actions = [
            (object) [
                'name' => $code,
                'description' => 'test_create_resource description'
            ]
        ];
        $res = $this->client->createResourceBatch([[
            'code' => $code,
            'type' => $type,
            'description' => $description,
            'actions' => $actions,
            'namespace' => 'default',
        ]]);
        parent::assertNotNull($res);
    }

    public function test_createResource()
    {
        $code = $this->randomString();
        $type = 'DATA';
        $description = 'description';
        $actions = [
            (object) [
                'name' => $code,
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

    public function test_getResourceById(){
        $code = $this->randomString();
        $type = 'DATA';
        $description = 'description';
        $actions = [
            (object) [
                'name' => $code,
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

        $ress = $this->client->getResourceById(['id'=>$res->id]);
        $json_string = json_encode($ress);
        echo $json_string;
        parent::assertNotNull($res);

    }

    public function test_getResourceByCode(){
        $code = $this->randomString();
        $type = 'DATA';
        $description = 'description';
        $actions = [
            (object) [
                'name' => $code,
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

        $ress = $this->client->getResourceByCode(['code'=>$res->code,'namespace'=>'default']);
        $json_string = json_encode($ress);
        echo $json_string;
        parent::assertNotNull($res);

    }



    public function test_updateResource()
    {
        $code = 'test_createresource';
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
//        $targetType = PolicyAssignmentTargetType::USER;
//        $userId = $this->_testConfig->testUserId;
//        $namespace = 'default';
//        $oldResource = $this->client->listAuthorizedResources($targetType, $userId, $namespace);
        $flag = $this->client->deleteResource('test_createresource1', 'default');
        print_r($flag);
        parent::assertTrue($flag);
//        $newResource =
//        $this->client->listAuthorizedResources($targetType, $userId, $namespace);
//        parent::assertNotSame($oldResource->data, $newResource->data);
    }

    public function test_programmaticAccessAccountList()
    {
        $res = $this->client->programmaticAccessAccountList('61319680ea8b30c9ca9ca071');

        $json_string = json_encode($res);
        echo $json_string;
        parent::assertNotNull($res);
    }

    /**
     * 添加编程访问账号
     */
    public function test_createProgrammaticAccessAccount()
    {
        $res = $this->client->createProgrammaticAccessAccount('61319680ea8b30c9ca9ca071');
        $json_string = json_encode($res);
        echo $json_string;
        parent::assertNotNull($res);
    }

    public function test_disableProgrammaticAccessAccount()
    {
        $res = $this->client->createProgrammaticAccessAccount('61319680ea8b30c9ca9ca071');
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
//        $code = Utils::randomString(5);
//        $name = Utils::randomString(5);
//        $description = Utils::randomString(5);
//        $res = $this->client->createNamespace($code, $name, $description);
//        parent::assertNotNull($res);

        $newName = 'updatenamespace';
        $res = $this->client->updateNamespace('pf3nn', [
            'name' => 'newname',
            'description' => 'description'
        ]);
        parent::assertNotNull($res);
        parent::assertEquals($res->name, $newName);
    }

    public function test_deleteProgrammaticAccessAccount()
    {
        $res = $this->client->deleteProgrammaticAccessAccount('61319680ea8b30c9ca9ca071');
        parent::assertTrue($res);
    }

    public function test_enableProgrammaticAccessAccount()
    {
        $this->client->createProgrammaticAccessAccount('61319680ea8b30c9ca9ca071');
        $res = $this->client->enableProgrammaticAccessAccount('61319680ea8b30c9ca9ca071');
        parent::assertEquals(200,$res->code);
    }

    public function test_refreshProgrammaticAccessAccountSecret()
    {
        $data = $this->client->refreshProgrammaticAccessAccountSecret('61319680ea8b30c9ca9ca071');
        parent::assertEquals(200, $data->code);
    }

    public function test_authorizeResource()
    {
        $AuthorizeResourceOpt = ['targetType'=>'USER','targetIdentifier'=>'614fd9ae42b192fc32823b10','actions'=>['aa','bb']];
         $result = $this->client->authorizeResource(['namespace'=>'default',
             'resource'=>'test_createresource',
             'opts'=>$AuthorizeResourceOpt
             ]);
         $jsonstring = json_encode($result);
         echo $jsonstring;
        parent::assertEquals(200, $result->code);
    }

    public function test_getAuthorizedTargets()
    {
//        $data = [
//            'namespace' => '6063f88dabb536e9a23a6c80',
//            'resource' => 'book',
//            'resourceType' => 'DATA',
//            'actions' => (object)[
//                'op' => 'OR',
//                'list' => ['write', 'read']
//            ],
//            'targetType' => 'USER'
//        ];
        $data = [
         'namespace' => 'mycode',
         'resource' => '5584',
         'resourceType' => 'DATA',
            'actions' => (object)[
                'op' => 'OR',
                'list' => ['write', 'read']
            ],
         'targetType' => PolicyAssignmentTargetType::USER
     ];
        $res = $this->client->getAuthorizedTargets([
            'namespace' => 'mycode',
            'resource' => '5584',
            'resourceType' => 'DATA',
            'actions' => (object)[
                'op' => 'OR',
                'list' => ['write', 'read']
            ],
            'targetType' => PolicyAssignmentTargetType::USER
        ]);
        parent::assertNotNull($res);
    }

    public function test_listResourcePermissions()
    {
        $AuthorizeResourceOpt = ['targetType'=>'USER','targetIdentifier'=>'614fd9ae42b192fc32823b10','actions'=>['aa','bb']];
        $data = $this->client->listResourcePermissions($AuthorizeResourceOpt);
        parent::assertNotNull($data);
    }

    public function test_listResources()
    {
        $res = $this->client->listResources([
            'namespace' => 'default',
            'type' => 'DATA'
        ]);
        parent::assertNotNull($res);
    }

    public function test_denyAccess()
    {
        $AuthorizeResourceOpt = ['appId'=>'61319680ea8b30c9ca9ca071', 'targetType'=>'USER','targetIdentifiers'=>'614fd9ae42b192fc32823b10',
        'namespace'=>'defalut'];

        $data = $this->client->denyAccess($AuthorizeResourceOpt);
        parent::assertEquals(200,$data->code);
    }

    public function test_deleteAccessPolicy()
    {
        $AuthorizeResourceOpt = ['appId'=>'61319680ea8b30c9ca9ca071', 'targetType'=>'USER','targetIdentifiers'=>'614fd9ae42b192fc32823b10',
            'namespace'=>'defalut'];
        $data = $this->client->deleteAccessPolicy($AuthorizeResourceOpt);
        parent::assertEquals(200,$data->code);
    }

    public function test_enableAccessPolicy()
    {
        $AuthorizeResourceOpt = ['appId'=>'61319680ea8b30c9ca9ca071', 'targetType'=>'USER','targetIdentifiers'=>'614fd9ae42b192fc32823b10',
            'namespace'=>'defalut'];
        $data = $this->client->enableAccessPolicy($AuthorizeResourceOpt);
        parent::assertEquals(200,$data->code);
    }

    public function test_getAccessPolicies()
    {
        $AuthorizeResourceOpt = ['appId'=>'61319680ea8b30c9ca9ca071'];
        $data = $this->client->getAccessPolicies($AuthorizeResourceOpt);
        parent::assertNotNull($data);
    }


    public function test_allowAccess()
    {
        $AuthorizeResourceOpt = ['appId'=>'61319680ea8b30c9ca9ca071', 'targetType'=>'USER','targetIdentifiers'=>'614fd9ae42b192fc32823b10',
            'namespace'=>'defalut'];
        $data = $this->client->allowAccess($AuthorizeResourceOpt);
        parent::assertNotNull($data);
    }
}
