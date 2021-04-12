<?php

namespace Authing\Mgmt;
use Authing\Mgmt\ManagementClient;

class ApplicationsManagementClient {
    private array $options;

    /**
     * @var ManagementClient
     */
    private ManagementClient $client;

    public function __construct(ManagementClient $client)
    {
        $this->client = $client;
    }

    public function list(array $params = [])
    {
        $page = $params['page'] ?? 1;
        $limit = $params['limit'] ?? 10;
        $data = $this->client->httpGet("/api/v2/applications?page=$page&limit=$limit");
        return $data;
    }

    public function findById(string $id)
    {
        $data = $this->client->httpGet("/api/v2/applications/$id");
        return $data;
    }

    public function create(array $options)
    {
        $res = $this->client->httpPost('/api/v2/applications', (object)$options);
        return $res;
    }

    public function delete(string $appId)
    {
        $this->client->httpDelete("/api/v2/applications/$appId");
        return true;
    }

    public function activeUsers(string $appId, int $page = 1, int $limit = 10)
    {
        $res = $this->client->httpGet("/api/v2/applications/$appId/active-users?page=$page&limit=$limit");
        return $res;
    }

    public function refreshApplicationSecret(string $appId)
    {
        $res = $this->client->httpPatch("/api/v2/application/$appId/refresh-secret");
        return $res;
    }

    
}

