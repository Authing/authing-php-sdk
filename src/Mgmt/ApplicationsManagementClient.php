<?php

namespace Authing\Mgmt;

class ApplicationsManagementClient {
    private array $options;
    private  $client;

    public function __construct($client)
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
}

