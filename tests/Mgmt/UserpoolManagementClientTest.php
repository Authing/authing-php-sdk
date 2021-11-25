<?php
include_once 'D:\authing-php-sdk\tests\config\TestConfig.php';
include_once '..\..\src\Mgmt\UserpoolManagementClient.php';

use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\UserpoolManagementClient;
use Authing\Types\UpdateUserpoolInput;
use PHPUnit\Framework\TestCase;

class UserpoolManagementClientTest extends TestCase
{
    /**
     * @var UserpoolManagementClient
     */
    private $client;

    private function randomString() {
        return rand() . '';
    }

    public function setUp(): void
    {
        $management = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        $management->requestToken();
        $this->client = $management->userpools();
    }

    public function testDetail() {
        $userpool = $this->client->detail();
        $this->assertNotNull($userpool);
    }

    public function testUpdate() {
        $userpool = $this->client->update((new UpdateUserpoolInput())->withDescription("official111"));
        $this->assertEquals("official111", $userpool->description);
    }

    public function testListEnv() {
        $envs = $this->client->listEnv();
        $this->assertEquals(true, sizeof($envs) > 0);
    }

    public function testAddEnv() {
        $env = $this->client->addEnv("key1", "value1");
        $this->assertEquals("key1", $env->key);
    }

    public function testRemoveEnv() {
        $message = $this->client->removeEnv("key");
        $this->assertEquals(200, $message->code);
    }
}