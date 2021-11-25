<?php
include_once 'D:\authing-php-sdk\tests\config\TestConfig.php';
include_once '..\..\src\Mgmt\UdfManagementClient.php';
use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\UdfManagementClient;
use Authing\Types\UDFDataType;
use Authing\Types\UDFTargetType;
use PHPUnit\Framework\TestCase;

class UdfManagementClientTest extends TestCase
{
    /**
     * @var UdfManagementClient
     */
    private $client;


    public function setUp(): void
    {
        $management = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        $management->requestToken();
        $this->client = $management->udfs();
    }

    public function testPaginate()
    {
        $udfs = $this->client->paginate(UDFTargetType::USER);
        $this->assertEquals(true, sizeof($udfs) > 0);
    }

    public function testSet()
    {
        $udf = $this->client->set(UDFTargetType::USER, "key", UDFDataType::STRING, "label");
        $this->assertEquals("key", $udf->key);
    }

    public function testRemove()
    {
        $this->client->set(UDFTargetType::USER, "key", UDFDataType::STRING, "label");
        $message = $this->client->remove(UDFTargetType::USER, "key");
        $this->assertEquals(200, $message->code);
    }

    public function test_setUdvBatch()
    {
        $data = $this->client->setUdvBatch(UDFTargetType::USER, '614fd9ae42b192fc32823b10', [
            (object) [
                'key' => 'test',
                'value' => 'this is value',
            ],
        ]);
        parent::assertNotNull($data);
    }


    public function testListUdv()
    {
        $data = $this->client->listUdv(UDFTargetType::USER, '614fd9ae42b192fc32823b10');
        parent::assertNotNull($data);
    }

    
}
