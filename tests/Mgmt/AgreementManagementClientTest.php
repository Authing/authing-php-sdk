<?php
include_once 'D:\authing-php-sdk\tests\config\TestConfig.php';
include_once '..\..\src\Mgmt\AgreementManagementClient.php';
use Test\TestConfig;
use PHPUnit\Framework\TestCase;
use Authing\Mgmt\ManagementClient;
use Authing\Types\PolicyAssignmentTargetType;
use Authing\Mgmt\Utils;
// use PHPUnit\Framework\Assert;
use Authing\Mgmt\Acl\AclManagementClient;

class AgreementManagementClientTest extends TestCase
{
    /**
     * @var AgreementManagementClient
     */
    private $client;


    public function setUp(): void
    {
        $management = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        //$management->setHost("http://localhost:3000");
        $management->requestToken();
        $this->client = $management->agreementManagementClient();
    }

    public function test_create()
    {
        $result = $this->client->create('61319680ea8b30c9ca9ca071',['title'=>'2']);
        $this->assertNotNull($result);

    }

    public function test_list()
    {
        $result = $this->client->list('61319680ea8b30c9ca9ca071');
        $this->assertNotNull($result);

    }

    public function test_delete()
    {
        $result = $this->client->create('61319680ea8b30c9ca9ca071',['title'=>'123412543']);
        $result = $this->client->delete('61319680ea8b30c9ca9ca071',$result->id);
        $this->assertNotNull($result);
    }

    public function test_modify()
    {
        $result = $this->client->create('61319680ea8b30c9ca9ca071',['title'=>'testupdatebefore']);
        $result = $this->client->modify('61319680ea8b30c9ca9ca071',$result->id,['title'=>'testupdateafter']);
        $this->assertNotNull($result);
    }

    public function test_sort()
    {
      $result = $this->client->sort('61319680ea8b30c9ca9ca071',['336','335']);

        $this->assertNotNull($result);
    }
}
