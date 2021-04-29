<?php

namespace Authing\Mgmt\Mfa;

use Authing\Mgmt\ManagementClient;
use Exception;

class MFAManagementClient
{
    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * MFAManagementClient constructor.
     * @param $client ManagementClient
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @param string $userId
     */
    public function getStatus($userId)
    {
        $data = $this->client->httpGet("/api/v2/users/$userId/mfa-bound");
        return $data;
    }

    /**
     * @param string $userId
     * @param string $type
     */
    public function unAssociateMfa($userId, $type)
    {
        $data = $this->client->httpDelete("/api/v2/users/$userId/mfa-bound?type=$type");
        return true;
    }
}
