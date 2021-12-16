<?php

use Authing\Mgmt\ManagementClient;
use PHPUnit\Framework\TestCase;

class ManagementClientTest extends TestCase
{
    /**
     * @var ManagementClient
     */
    public $managementClient;


    public function setUp(): void
    {
        $this->managementClient = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        $this->managementClient->requestToken();
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
        parent::assertNotEmpty($user->data->id);
    }
}
