<?php

namespace Authing\Mgmt;
use Authing\Mgmt\ManagementClient;

class AgreementManagementClient {
    private array $options;

    /**
     * @var ManagementClient
     */
    private ManagementClient $client;

    public function __construct(ManagementClient $client)
    {
        $this->client = $client;
    }

    public function list(string $appId)
    {
        $data = $this->client->httpGet("/api/v2/applications/$appId/agreements");
        return $data;
    }

    public function create(string $appId, array $agreement)
    {
        $data = [
            'lang' => 'zh-CN',
            'required' => true,
        ];
        foreach($agreement as $key => $value) {
            $data[$key] = $value;
        }
        $res = $this->client->httpPost("/api/v2/applications/$appId/agreements", $data);
        return $res;
    }

    public function delete(string $appId, int $agreementId)
    {
        $this->client->httpDelete("/api/v2/applications/$appId/agreements/$agreementId");
        return true;
    }

    public function modify(string $appId, int $agreementId, array $updates)
    {
        $data = $this->client->httpPut("/api/v2/applications/$appId/agreements/$agreementId", $updates);
        return $data;
    }

    public function sort(string $appId, array $order)
    {
        $this->client->httpPost("/api/v2/applications/$appId/agreements/sort", [
            'ids' => $order
        ]);
        return true;
    }
}

