<?php
require_once __DIR__ . '../../../vendor/autoload.php';

use Authing\Mgmt\AclManagementClient;
use Authing\Mgmt\ManagementClient;
use PHPUnit\Framework\TestCase;
// use PHPUnit\Framework\Assert;
use Test\TestConfig;

class AclManagementClientTest extends TestCase
{
    /**
     * @var AclManagementClient
     */
    private $aclManagement;

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

    public function testAllow()
    {
        // $this->client->allow("resource id", "action id", "user id");
    }

    public function testIsAllowed()
    {
        // $this->client->isAllowed("user id", "action id", "resource id");
    }

    public function testProgrammaticAccessAccountList()
    {
        $appId = $this->_testConfig->appId;
        $res = $this->aclManagement->programmaticAccessAccountList($appId);
        parent::assertNotEmpty($res);
        parent::assertNotEmpty($res->data);
        parent::assertEquals(gettype($res->data->list), 'array');
        // parent::assertIsArray($res->data->list, 'array');
        // parent::assertIsNotArray($res->data->list);
        // parent::assertArraySubset();
    }
}
