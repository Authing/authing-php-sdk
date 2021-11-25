<?php
include_once 'D:\authing-php-sdk\tests\config\TestConfig.php';
include_once '..\..\src\Mgmt\StatisticsManagementClient.php';
use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\StatisticsManagementClient;
use PHPUnit\Framework\TestCase;
// use PHPUnit\Framework\Assert;
use Test\TestConfig;

class StatisticsManagementClientTest extends TestCase
{
    /**
     * @var StatisticsManagementClient
     */
    private $statisticsManagement;


    public function setUp(): void
    {
        $management = new ManagementClient('6131967faf2eb55a2b7cebcc', '4c829dbf3a29bcfcb2019017045c714f');
        $management->requestToken();
        $this->statisticsManagement = $management->statistics();
    }

    public function testListAuditLogs()
    {
        $logs = $this->statisticsManagement->listAuditLogs();
        parent::assertNotEmpty($logs);
        parent::assertEquals(gettype($logs->list), 'array');
        parent::assertLessThanOrEqual($logs->totalCount, count($logs->list));
        parent::assertLessThanOrEqual(count($logs->list), 10);
        $limit = 30;
        $logs = $this->statisticsManagement->listAuditLogs(
            [
                'limit' => $limit,
            ]);
        parent::assertLessThanOrEqual(count($logs->list), $limit);
    }

    public function testListUserActions()
    {
        $logs = $this->statisticsManagement->listUserActions();
        parent::assertNotEmpty($logs);
        parent::assertEquals(gettype($logs->list), 'array');
        parent::assertLessThanOrEqual($logs->totalCount, count($logs->list));
        parent::assertLessThanOrEqual(count($logs->list), 10);
        $limit = 30;
        $logs = $this->statisticsManagement->listUserActions(
            [
                'limit' => $limit,
            ]);
        parent::assertLessThanOrEqual(count($logs->list), $limit);
    }
}
