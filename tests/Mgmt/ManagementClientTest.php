<?php

use Authing\Mgmt\ManagementClient;
use PHPUnit\Framework\TestCase;

class ManagementClientTest extends TestCase
{
    /**
     * @var ManagementClient
     */
    private $managementClient;

    private $_testConfig;

    public function setUp(): void
    {
        $moduleName = str_replace('ClientTest', '', __CLASS__);
        $this->_testConfig = (object) TestConfig::getConfig($moduleName);
        $this->managementClient = new ManagementClient($this->_testConfig->userPoolId, $this->_testConfig->userPoolSercet);
        $this->managementClient->requestToken();
    }

    public function testAllow()
    {
        // $this->client->allow("resource id", "action id", "user id");
    }

    public function testIsAllowed()
    {
        // $this->client->isAllowed("user id", "action id", "resource id");
    }

    public function testRequestToken()
    {
        $this->managementClient->accessToken = null;
        parent::assertEmpty($this->managementClient->accessToken);
        $token = $this->managementClient->requestToken();
        parent::assertNotEmpty($token);
    }

    public function testCheckLoginStatus()
    {
        $accessToken = $this->managementClient->accessToken;
        $user = $this->managementClient->checkLoginStatus($accessToken);
        parent::assertNotEmpty($user);
        parent::assertNotEmpty($user->id);
        $this->managementClient->setAccessToken('');
        $user = $this->managementClient->checkLoginStatus($accessToken);
        parent::assertNull($user);
    }
}
