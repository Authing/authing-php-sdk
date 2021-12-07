<?php
include_once '..\config\TestConfig.php';
include_once '..\..\src\Mgmt\ApplicationsManagementClient.php';

use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\ApplicationsManagementClient;
use PHPUnit\Framework\TestCase;
use Authing\Mgmt\Acl\AclManagementClient;
use Authing\Mgmt\Utils;

class ApplicationsManagementClientTest extends TestCase
{
    /**
     * @var ApplicationsManagementClient
     */
    private $client;

    public function setUp(): void
    {
        $management = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        //$management->setHost("http://localhost:3000");
        $management->requestToken();
        $this->client = $management->applications();
    }

    public function test_create()
    {
        $result = $this->client->create([
            'name' => 'testname',
            'identifier' =>  ' only one 1111 ',
            'redirectUris' => 'http://www.1111.cn',
            'logo' => 'https: //files.authing.co/authing-console/authing-logo-new.svg'
        ]);
        $this->assertNotNull($result);

    }

    public function test_createResourceBatch()
    {
        $result = $this->client->createResourceBatch([
            'name' => 'testnameww',
            'identifier' => 'onlyo111wwne',
            'redirectUris' => 'http://authing1234ww.cn',
            'logo' => 'https: //files.authing.co/authing-console/authing-logo-new.svg'
        ]);
        $this->assertNotNull($result);

    }


    public function test_delete()
    {
        $result = $this->client->create([
            'name' => 'tetaaa',
            'identifier' => 'onlyo111aaawwne',
            'redirectUris' => 'http://authing1234waaw.cn',
            'logo' => 'https: //files.authing.co/authing-console/authing-logo-new.svg'
        ]);
        $result = $this->client->delete($result->id);
        $this->assertNotNull($result);
    }

    public function test_list()
    {
        $result = $this->client->create([
            'name' => 'tetbbb',
            'identifier' => 'onlyo111bbbwwne',
            'redirectUris' => 'http://authibbb.cn',
            'logo' => 'https: //files.authing.co/authing-console/authing-logo-new.svg'
        ]);
        $result = $this->client->list();
        $this->assertNotNull($result);
    }

    public function test_findById()
    {
        $result = $this->client->create([
            'name' => 'tetbbggb',
            'identifier' => 'onlyo111ggbbbwwne',
            'redirectUris' => 'http://authiggbbb.cn',
            'logo' => 'https: //files.authing.co/authing-console/authing-logo-new.svg'
        ]);
        $result = $this->client->findById($result->id);
        $this->assertNotNull($result);
    }

    public function test_createAgreement()
    {
        $result = $this->client->createAgreement('61319680ea8b30c9ca9ca071', [
            'title' => '2'
        ]);
        $this->assertNotNull($result);
    }

    public function test_deleteAgreement()
    {
        $result = $this->client->createAgreement('61319680ea8b30c9ca9ca071', [
            'title' => '123449999'
        ]);
        $result = $this->client->deleteAgreement('61319680ea8b30c9ca9ca071', $result->id);
        $this->assertNotNull($result);
    }

    public function test_listAgreement()
    {
        $result = $this->client->listAgreement('61319680ea8b30c9ca9ca071');
        $this->assertNotNull($result);
    }

    public function test_modifyAgreement()
    {
        $result = $this->client->createAgreement('61319680ea8b30c9ca9ca071', [
            'title' => 'before'
        ]);
        $result = $this->client->modifyAgreement('61319680ea8b30c9ca9ca071', $result->id, ['title' => 'after1123']);
        $this->assertNotNull($result);
    }

    public function test_sortAgreement()
    {
        $result = $this->client->sortAgreement('61319680ea8b30c9ca9ca071', ['342', '341']);
        $this->assertNotNull($result);
    }

    public function test_createResource()
    {
        $code = 'test_houyong';
        $type = 'DATA';
        $description = 'description';
        $actions = [
            (object)[
                'name' => 'test_create_resource',
                'description' => 'test_create_resource description'
            ]
        ];
        $result = $this->client->createResource([
            'code' => $code,
            'type' => $type,
            'description' => $description,
            'actions' => $actions,
            'namespace' => 'default',
        ]);
        $this->assertNotNull($result);
    }

    public function test_deleteResource()
    {
        $result = $this->client->deleteResource('test_houyong', 'default');
        $this->assertNotNull($result);
    }

    public function test_listResources()
    {
        $result = $this->client->listResources([
            'namespace' => 'default',
            'type' => 'DATA'
        ]);
        $this->assertNotNull($result);
    }

    public function test_createRole()
    {
        $result = $this->client->createRole('61319680ea8b30c9ca9ca071', [
            'code' => '12345',
            'description' => 'DESCRIPTION']);
        $this->assertNotNull($result);
    }

    public function test_findRole()
    {
        $code = Utils::randomString(5);
        $result = $this->client->createRole('61319680ea8b30c9ca9ca071', [
            'code' => $code,
            'description' => 'DESCRIPTION']);
        $result = $this->client->findRole('61319680ea8b30c9ca9ca071', $result->code);
        $this->assertNotNull($result);
    }

    public function test_deleteRole()
    {
        $code = Utils::randomString(5);
        $result = $this->client->createRole('61319680ea8b30c9ca9ca071', [
            'code' => $code,
            'description' => 'DESCRIPTION']);
        $result = $this->client->deleteRole('61319680ea8b30c9ca9ca071', $result->code);
        $this->assertEquals(200, $result->code);
    }

    public function test_deleteRoles()
    {
        $code = Utils::randomString(5);
        $result = $this->client->createRole('61319680ea8b30c9ca9ca071', [
            'code' => $code,
            'description' => 'DESCRIPTION']);


        $code1 = Utils::randomString(5);
        $result1 = $this->client->createRole('61319680ea8b30c9ca9ca071', [
            'code' => $code1,
            'description' => 'DESCRIPTION1']);

        $result = $this->client->deleteRoles('61319680ea8b30c9ca9ca071', [$result->code,$result1->code]);
        $this->assertEquals(200, $result->code);
    }

    public function test_listAuthorizedResourcesByRole()
    {
        $code = Utils::randomString(5);
        $result = $this->client->createRole('61319680ea8b30c9ca9ca071', [
            'code' => $code,
            'description' => 'DESCRIPTION']);
        $result = $this->client->listAuthorizedResourcesByRole('61319680ea8b30c9ca9ca071', 'yw34z', 'DATA');
        $this->assertNotNull($result);
    }

    public function test_getRoles()
    {
        $result = $this->client->getRoles('61319680ea8b30c9ca9ca071', []);
        $this->assertNotNull($result);
    }

    public function test_getUsersByRoleCode()
    {
        $result = $this->client->getUsersByRoleCode('61319680ea8b30c9ca9ca071', '67mhx');
        $this->assertNotNull($result);
    }

    public function test_removeUsersFromRole()
    {
        $result = $this->client->removeUsersFromRole('61319680ea8b30c9ca9ca071', '67mhx',['614fd9ae42b192fc32823b10']);
        $this->assertNotNull($result);
    }


    public function test_updateRole()
    {
        $result = $this->client->updateRole('61319680ea8b30c9ca9ca071', ['description'=>'hhh','code'=>'7843a']);
        $this->assertNotNull($result);
    }

    public function test_updateResource()
    {
        $result = $this->client->updateResource('default',
            [
                'type' => 'API',
                'code' => 'test_createresource123456',
                'actions' => [
                    (object)[
                        'name' => 'codeNames:actionName',
                        'description' => 'actionDescription'
                    ],
                    (object)[
                        'name' => 'codeNames:actionName',
                        'description' => 'actionDescription'
                    ]
                ],
                'description' => '新的描述',
                'apiIdentifier' => 'http://xxx.com'
            ]);
        $this->assertNotNull($result);
    }

    public function test_refreshApplicationSecret()
    {
        $result = $this->client->refreshApplicationSecret('619b41fa07e10fd1a1507c50');
        $this->assertNotNull($result);
    }

}
