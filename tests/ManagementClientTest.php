<?php

include "../src/ManagementClient.php";


use Authing;
use PHPUnit\Framework\TestCase;

class ManagementClientTest extends TestCase
{
    /**
     * @var Authing\ManagementClient
     */
    public $managementClient;


    public function setUp()
    {
        $this->managementClient = new Authing\ManagementClient(
            array(
                "accessKeyId" => "6343b98b7cf019a9366e9b7c",
                "accessKeySecret" => "fb0cefa691df76920a1611b9dec38120",
                "host" => "http://localhost:3000"
            )
        );
    }

    public function testListUsers()
    {
        $data = $this->managementClient->listUsers();
        print_r($data);
    }
}