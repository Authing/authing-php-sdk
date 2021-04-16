<?php

use Authing\Mgmt\MFAManagementClient;
use Authing\Mgmt\ManagementClient;
use PHPUnit\Framework\TestCase;

class MFAManagementClientTest extends TestCase
{
    /**
     * @var MFAManagementClient
     */
    private $client;

    private $_testConfig;

    private function randomString()
    {
        return rand() . '';
    }

    public function setUp(): void
    {
        $moduleName = str_replace('ClientTest', '', __CLASS__);
        $manageConfig = (object) TestConfig::getConfig('Management');
        $this->_testConfig = (object) TestConfig::getConfig($moduleName);
        $management = new ManagementClient($manageConfig->userPoolId, $manageConfig->userPoolSercet);
        $management->requestToken();
        $this->client = $management->mfa();
    }

}
