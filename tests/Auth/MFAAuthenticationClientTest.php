<?php
require_once __DIR__ . '../../vendor/autoload.php';

use Authing\Auth\MFAAuthenticationClient;
use PHPUnit\Framework\TestCase;
use Test\TestConfig;

class MFAAuthenticationClientTest extends TestCase
{
    /**
     * @var MFAAuthenticationClient
     */
    private $mfaAuthenticationClient;
    private $_testConfig;

    private function randomString()
    {
        return rand() . '';
    }

    /**
     *
     * @return void
     * @Description
     * @example
     * @author Xintao Li
     * @since
     */
    protected function setUp(): void
    {
        $moduleName = str_replace('ClientTest', '', __CLASS__);
        $this->_testConfig = (object) TestConfig::getConfig($moduleName);
        $this->mfaAuthenticationClient = new MFAAuthenticationClient(new AuthenticationClient(function ($options) {
            $options->appId = $this->_testConfig->appId;
        }));
    }

    protected function tearDown(): void
    {}

    public function testVerifyFaceMfa()
    {
        extract($this->_testConfig);
        $this->mfaAuthenticationClient->verifyFaceMfa($photo, $mfaToken);
    }

    public function testAssociateFaceByBlob()
    {
        
    }

    public function testAssociateFaceByLocalFile()
    {
        
    }

    public function testAssociateFaceByUrl()
    {
        
    }
}
