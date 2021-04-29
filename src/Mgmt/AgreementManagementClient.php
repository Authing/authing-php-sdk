<?php

namespace Authing\Mgmt;
use Authing\Mgmt\ManagementClient;

class AgreementManagementClient {
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
    }

    /**
     * @param string $appId
     */
    public function list($appId)
    {
        $data = $this->client->httpGet("/api/v2/applications/$appId/agreements");
        return $data;
    }

    /**
     * @param string $appId
     */
    public function create($appId, array $agreement)
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

    /**
     * @param string $appId
     * @param int $agreementId
     */
    public function delete($appId, $agreementId)
    {
        $this->client->httpDelete("api/v2/applications/$appId/agreements/$agreementId");
        return true;
    }

    /**
     * @param string $appId
     * @param int $agreementId
     */
    public function modify($appId, $agreementId, array $updates)
    {
        $data = $this->client->httpPut("/api/v2/applications/$appId/agreements/$agreementId", $updates);
        return $data;
    }

    /**
     * @param string $appId
     */
    public function sort($appId, array $order)
    {
        $this->client->httpPost("/api/v2/applications/$appId/agreements/sort", [
            'ids' => $order
        ]);
        return true;
    }
}

