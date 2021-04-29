<?php


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
        $management = new ManagementClient("59f86b4832eb28071bdd9214", "4b880fff06b080f154ee48c9e689a541");
        $management->setHost("http://localhost:3000");
        $management->requestToken();
        $this->client = $management->userpool();
    }

    public function testDetail() {
        $userpool = $this->client->detail();
        $this->assertEquals("root 用户池", $userpool->name);
    }

    public function testUpdate() {
        $userpool = $this->client->update((new UpdateUserpoolInput())->withDescription("official"));
        $this->assertEquals("official", $userpool->description);
    }

    public function testListEnv() {
        $envs = $this->client->listEnv();
        $this->assertEquals(true, sizeof($envs) > 0);
    }

    public function testAddEnv() {
        $env = $this->client->addEnv("key", "value");
        $this->assertEquals("key", $env->key);
    }

    public function testRemoveEnv() {
        $message = $this->client->removeEnv("key");
        $this->assertEquals(200, $message->code);
    }
}