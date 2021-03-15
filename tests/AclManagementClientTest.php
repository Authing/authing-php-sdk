<?php


use Authing\Mgmt\AclManagementClient;
use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\RolesManagementClient;
use PHPUnit\Framework\TestCase;

class AclManagementClientTest extends TestCase
{
    /**
     * @var AclManagementClient
     */
    private $client;

    public function setUp(): void
    {
        $management = new ManagementClient("59f86b4832eb28071bdd9214", "4b880fff06b080f154ee48c9e689a541");
        $management->setHost("http://localhost:3000");
        $management->requestToken();
        $this->client = $management->acl();
    }

    public function testAllow()
    {
        $this->client->allow("resource id", "action id", "user id");
    }

    public function testIsAllowed()
    {
        $this->client->isAllowed("user id", "action id", "resource id");
    }
}