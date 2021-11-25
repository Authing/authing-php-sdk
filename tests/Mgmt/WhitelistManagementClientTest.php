<?php
include_once 'D:\authing-php-sdk\tests\config\TestConfig.php';
include_once '..\..\src\Mgmt\WhitelistManagementClient.php';
use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\WhitelistManagementClient;
use Authing\Types\WhitelistType;
use PHPUnit\Framework\TestCase;

class WhitelistManagementClientTest extends TestCase
{
    /**
     * @var WhitelistManagementClient
     */
    private $client;

    private function randomString() {
        return rand() . '';
    }

    public function setUp(): void
    {
        $management = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        $management->requestToken();
        $this->client = $management->whitelists();
    }

    public function testPaginate() {
        $list = $this->client->paginate(WhitelistType::EMAIL);
        $this->assertEquals(true, sizeof($list) == 0);
    }

    public function testAdd() {
        $result = $this->client->add(WhitelistType::EMAIL, ["testa@test.com"]);
        $this->assertNotNull($result);
    }

    public function testRemove() {
        $this->client->remove(WhitelistType::EMAIL, ["test@test.com"]);
        $list = $this->client->paginate(WhitelistType::EMAIL);
        $this->assertNotNull($list);
    }

    public function testEnable() {
        $this->client->enable(WhitelistType::EMAIL);
        $this->assertEquals(true, true);
    }

    public function testDisable() {
        $this->client->disable(WhitelistType::EMAIL);
        $this->assertEquals(true, true);
    }
}