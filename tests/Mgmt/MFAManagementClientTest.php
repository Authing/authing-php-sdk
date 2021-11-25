<?php
include_once '..\config\TestConfig.php';
include_once '..\..\src\Mgmt\MFAManagementClient.php';

use Authing\Mgmt\MFAManagementClient;
use Authing\Mgmt\ManagementClient;
use PHPUnit\Framework\TestCase;

class MFAManagementClientTest extends TestCase
{
    /**
     * @var MFAManagementClient
     */
    private $client;


    private function randomString()
    {
        return rand() . '';
    }

    public function setUp(): void
    {
        $management = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        $management->requestToken();
        $this->client = $management->mfa();
    }

    public function test_getStatus()
    {
        $result = $this->client->getStatus('614fd9ae42b192fc32823b10');
        $this->assertNotNull($result);
    }

    public function test_unAssociateMfa()
    {
        $result = $this->client->unAssociateMfa('614fd9ae42b192fc32823b10','FACE');
        $this->assertNotNull($result);
    }

}
