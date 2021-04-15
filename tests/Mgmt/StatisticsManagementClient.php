<?php
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

    private $_testConfig;

    public function setUp(): void
    {
        $moduleName = str_replace('ClientTest', '', __CLASS__);
        $manageConfig = (object) TestConfig::getConfig('Management');
        $this->_testConfig = (object) TestConfig::getConfig($moduleName);
        $management = new ManagementClient($manageConfig->userPoolId, $manageConfig->userPoolSercet);
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
