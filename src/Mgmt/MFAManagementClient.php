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
    public function __construct(ManagementClient $client)
    {
        $this->client = $client;
    }

    public function getStatus(string $userId)
    {
        $data = $this->client->httpGet("/api/v2/users/$userId/mfa-bound");
        return $data;
    }

    public function unAssociateMfa(string $userId, string $type)
    {
        $data = $this->client->httpDelete("/api/v2/users/$userId/mfa-bound?type=$type");
        return true;
    }
}
