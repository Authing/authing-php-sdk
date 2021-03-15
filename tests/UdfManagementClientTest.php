<?php


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
        $management = new ManagementClient("59f86b4832eb28071bdd9214", "4b880fff06b080f154ee48c9e689a541");
        $management->setHost("http://localhost:3000");
        $management->requestToken();
        $this->client = $management->udf();
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
}