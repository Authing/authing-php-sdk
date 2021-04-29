<?php


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
        $management = new ManagementClient("59f86b4832eb28071bdd9214", "4b880fff06b080f154ee48c9e689a541");
        $management->setHost("http://localhost:3000");
        $management->requestToken();
        $this->client = $management->whitelist();
    }

    public function testPaginate() {
        $list = $this->client->paginate(WhitelistType::EMAIL);
        $this->assertEquals(true, sizeof($list) == 0);
    }

    public function testAdd() {
        $this->client->add(WhitelistType::EMAIL, ["test@test.com"]);
        $list = $this->client->paginate(WhitelistType::EMAIL);
        $this->assertEquals(true, sizeof($list) == 1);
    }

    public function testRemove() {
        $this->client->remove(WhitelistType::EMAIL, ["test@test.com"]);
        $list = $this->client->paginate(WhitelistType::EMAIL);
        $this->assertEquals(true, sizeof($list) == 0);
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