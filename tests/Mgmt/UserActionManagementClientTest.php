<?php

use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\UserActionManagementClient;
use Authing\Types\UDFDataType;
use Authing\Types\UDFTargetType;
use PHPUnit\Framework\TestCase;

class UserActionManagementClientTest extends TestCase
{
    /**
     * @var UserActionManagementClient
     */
    private $userActionManagement;
    private $_testConfig;

    public function setUp(): void
    {
        $moduleName = str_replace('ClientTest', '', __CLASS__);
        $manageConfig = (object) TestConfig::getConfig('Management');
        $this->_testConfig = (object) TestConfig::getConfig($moduleName);
        $management = new ManagementClient($manageConfig->userPoolId, $manageConfig->userPoolSercet);
        $management->requestToken();
        $this->userActionManagement = $management->userActions();
    }

   public function testExport()
   {
    //    $data = $this->userActionManagement->expo
   }

   public function testList()
   {
       $data = $this->userActionManagement->list();
       parent::assertNotEmpty($data);
   }
}
