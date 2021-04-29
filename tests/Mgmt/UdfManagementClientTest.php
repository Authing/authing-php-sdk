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
    private $udfManagement;
    private $_testConfig;

    public function setUp(): void
    {
        $moduleName = str_replace('ClientTest', '', __CLASS__);
        $manageConfig = (object) TestConfig::getConfig('Management');
        $this->_testConfig = (object) TestConfig::getConfig($moduleName);
        $management = new ManagementClient($manageConfig->userPoolId, $manageConfig->userPoolSercet);
        $management->requestToken();
        $this->udfManagement = $management->udf();
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

    public function testListUdv()
    {
        $udfTargetType = UDFTargetType::NODE;
        $targetId = $this->_testConfig->nodeId;
        $data = $this->udfManagement->listUdv($udfTargetType, $targetId);
        parent::assertNotNull($data);
    }

    
}
