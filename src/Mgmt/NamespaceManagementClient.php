<?php

namespace Authing\Mgmt;
use Authing\Mgmt\ManagementClient;

class NamespaceManagementClient {
    private array $options;

    /**
     * @var ManagementClient
     */
    private ManagementClient $client;

    public function __construct(ManagementClient $client)
    {
        $this->client = $client;
        $this->options = $client->options;
    }

    public function list(array $params = [])
    {
        $userPoolId = $this->options->userPoolId;
        $page = $params['page'] ?? 1;
        $limit = $params['limit'] ?? 10;
        $data = $this->client->httpGet("/api/v2/resource-namespace/$userPoolId/?page=$page&limit=$limit");
        return $data;
    }


    public function create(string $code, string $name, string $description = "")
    {
        $res = $this->client->httpPost("/api/v2/resource-namespace/{$this->options->userPoolId}", (object)[
            'name' => $name,
            'code' => $code,
            'description' => $description
        ]);
        return $res;
    }

    public function delete(string $code)
    {
        $this->client->httpDelete("/api/v2/resource-namespace/{$this->options->userPoolId}/code/$code");
        return true;
    }

    public function update(string $code, array $updates)
    {
        $data = $this->client->httpPut("/api/v2/resource-namespace/{$this->options->userPoolId}/code/{$code}", (object)$updates);
        return $data;
    }
}

