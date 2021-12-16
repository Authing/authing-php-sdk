<?php
include_once '..\config\TestConfig.php';
include_once '..\..\src\Mgmt\RolesManagementClient.php';
use Test\TestConfig;

use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\Roles\RolesManagementClient;
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
        $management = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        //$management->setHost("http://localhost:3000");
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
        print_r($users);
        $this->assertEquals(true, $users->users->totalCount == 0);
    }

    public function testListPolicies() {
        $code = $this->randomString();
        $role = $this->client->create($code);
        $policies = $this->client->listPolicies($role->code);
        print_r($policies);
        $this->assertEquals(true, $policies->totalCount == 0);
    }

    public function testFindByCode() {
        $code = $this->randomString();
        $role = $this->client->create($code);
        $roleByCode = $this->client->findByCode($role->code);
        $json_string = json_encode($roleByCode);
        echo $json_string;
        $this->assertEquals($role->code, $roleByCode->code);
    }

    public function testAddPolicies() {
//        $code = $this->randomString();
//        $role = $this->client->create($code);
//        print_r($role);
        $result = $this->client->addPolicies('1127983743',['1168282826']);
        print_r($result);
    }

    public function testAddUsers() {
        $code = $this->randomString();
        $role = $this->client->create($code);
        $result = $this->client->addUsers($role->code,["614fd9ae42b192fc32823b10"]);
        $this->assertEquals(200,$result->code);
    }

    public function testRemoveUsers() {
        $result = $this->client->removeUsers('1751873474',["614fd9ae42b192fc32823b10"]);
        $this->assertEquals(200,$result->code);
    }

    /**
     * testSetUdValue  getUdfValue
     */
    public function testSetUdValue() {
        $code = $this->randomString();
        $role = $this->client->create($code);
        //print_r($role);
        $result = $this->client->setUdfValue($role->id,[
                'age' => '24',
                'school' => '800'
        ]);
        print_r($result);
        $this->assertEquals(true,true);
    }


    public function testgetUdfValue() {
        $result = $this->client->getUdfValue('6196085fe155471c6da40c02');
        print_r($result);
        $this->assertEquals(true,true);
    }


    public function testSetUdfValueBatch() {
        $code = $this->randomString();
        $role = $this->client->create($code);
        $result = $this->client->setUdfValueBatch([
            (object)[
                'roleId' => $role->id,
                'data' => [
                    'school' => 'henandaxue',
                    'age' => '25'
                ]
            ]
        ]);
        $this->assertEquals(200,$result->code);
    }

    public function testgetUdfValueBatch() {
         $result = $this->client->getUdfValueBatch(["619610026f1c9c01f31eed12"]);
         print_r($result);
    }

    public function testremoveUdfValue() {
         $this->client->removeUdfValue('619610026f1c9c01f31eed12','school');
        $this->assertEquals(true,true);
    }

    public function testgetSpecificUdfValue() {
        $result = $this->client->getSpecificUdfValue('619610026f1c9c01f31eed12','age');
        print_r($result);
        $this->assertEquals(true,true);
    }

    public function testlistAuthorizedResources() {
        $result = $this->client->listAuthorizedResources('619610026f1c9c01f31eed12','');
        print_r($result);
        $this->assertEquals(true,true);
    }

}
