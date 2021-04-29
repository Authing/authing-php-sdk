<?php

namespace Authing\Mgmt;
use Authing\Mgmt\ManagementClient;

class NamespaceManagementClient {
    /**
     * @var mixed[]
     */
    private $options;

    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * @param \Authing\Mgmt\ManagementClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
        $this->options = $client->options;
    }

    public function list(array $params = [])
    {
        $userPoolId = $this->client->options->userPoolId;
        $page = isset($params['page']) ? $params['page'] : 1;
        $limit = isset($params['limit']) ? $params['limit'] : 10;
        $data = $this->client->httpGet("/api/v2/resource-namespace/$userPoolId/?page=$page&limit=$limit");
        return $data;
    }


    /**
     * @param string $code
     * @param string $name
     * @param string $description
     */
    public function create($code, $name, $description = "")
    {
        $res = $this->client->httpPost("/api/v2/resource-namespace/{$this->client->options->userPoolId}", (object)[
            'name' => $name,
            'code' => $code,
            'description' => $description
        ]);
        return $res;
    }

    /**
     * @param string $code
     */
    public function delete($code)
    {
        $this->client->httpDelete("/api/v2/resource-namespace/{$this->client->options->userPoolId}/code/$code");
        return true;
    }

    /**
     * @param string $code
     */
    public function update($code, array $updates)
    {
        $data = $this->client->httpPut("/api/v2/resource-namespace/{$this->client->options->userPoolId}/code/{$code}", (object)$updates);
        return $data;
    }
}

