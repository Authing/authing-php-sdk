<?php

namespace Authing\Mgmt;
use Authing\Mgmt\ManagementClient;

class UserActionManagementClient {
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

    public function list(array $params = [
        'page' => 1,
        'limit' => 10
    ])
    {
        $userPoolId = $this->client->options->userPoolId;
        $page = $params['page'] ?? 1;
        $limit = $params['limit'] ?? 10;
        $att = [
            'page' => $page,
            'limit' => $limit,
            'clientip' => $params['clientIp'],
            'operation_name' => $params['operationName'],
            'operator_arn' => $params['operatoArn']
        ];
        $qstr = http_build_query($att);
        $data = $this->client->httpGet("/api/v2/analysis/user-action?$qstr");
        return $data;
    }

    public function export()
    {
        # code...
    }
}

