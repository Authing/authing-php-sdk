<?php

/**
 * 命名空间
 */

namespace Test;

use Authing\ManagementClient;

/**
 * ManagementClientTest
 */

class ManagementClientTest extends \PHPUnit\Framework\TestCase
{

    public $management;

    public function setUp()
    {
        parent::setUp();
        $this->management = new ManagementClient("628779b1b806c9e5f17f101a", "3c07e7e500cf91485a6e00a98e99743b");
    }

    public function testMain()
    {
        $users = $this->management->listUsers();
        $this->assertEquals(200, $users["statusCode"]);
    }
}
