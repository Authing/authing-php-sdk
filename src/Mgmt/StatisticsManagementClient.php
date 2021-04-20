<?php

namespace Authing\Mgmt;

use Authing\Mgmt\ManagementClient;

class StatisticsManagementClient
{
    private $options;

    /**
     * @var ManagementClient
     */
    private $client;

    public function __construct(ManagementClient $client)
    {
        $this->client = $client;
    }

    public function listUserActions(array $options = [])
    {
        $options = (object) $options;
        $requestParam = (object) [];
        if (isset($options->clientIp)) {
            $requestParam->clientIp = $options->clientIp;
        }
        if (isset($options->operationNames)) {
            $requestParam->operation_name = $options->operationNames;
        }
        if (isset($options->userIds) && count($options->userIds) > 0) {
            array_map(function ($item) {
                $userPoolId = $this->client->options->userPoolId;
                return "arn:cn:authing:$userPoolId:user:$item";
            }, $options->userIds);
            $requestParam->operator_arn = $options->userIds;
        }

        $requestParam->page = $options->page ?? 1;
        $requestParam->limit = $options->limit ?? 10;
        $params = http_build_query($requestParam);
        $data = $this->client->httpGet("/api/v2/analysis/user-action?$params");
        ['list' => $list, 'totalCount' => $totalCount] = (array)$data->data;
        array_map(function ($item) {
            return (object) [
                'userpoolId' => $item->userpool_id,
                'userId' => ($item->user ?? null) && $item->user->id,
                'username' => ($item->user ?? null) && $item->user->displayName,
                'cityName' => ($item->geoip ?? null) && $item->geoip->city_name,
                'regionName' => ($item->geoip ?? null) && $item->geoip->region_name,
                'clientIp' => ($item->geoip ?? null) && $item->geoip->ip,
                'operationDesc' => $item->operation_desc,
                'operationName' => $item->operation_name,
                'timestamp' => $item->timestamp,
                'appId' => $item->app_id,
                'appName' => $item->appName ?? null,
            ];
        }, $list);
        return (object)[
            'list' => $list,
            'totalCount' => $totalCount,
        ];
    }

    public function listAuditLogs(array $options = [])
    {
        $options = (object) $options;
        $requestParam = (object) [];
        if (isset($options->clientIp)) {
            $requestParam->clientIp = $options->clientIp;
        }
        if (isset($options->operationNames)) {
            $requestParam->operation_name = $options->operationNames;
        }
        if (isset($options->operatorArns)) {
            $requestParam->operator_arn = $options->operatorArns;
        }

        $requestParam->page = $options->page ?? 1;
        $requestParam->limit = $options->limit ?? 10;
        $params = http_build_query($requestParam);
        $data = $this->client->httpGet("/api/v2/analysis/user-action?$params");

        ['list' => $list, 'totalCount' => $totalCount] = (array)$data->data;
        array_map(function ($item) {
            return (object) [
                'userpoolId' => $item->userpool_id,
                'operatorType' => $item->operator_type ?? null,
                'userId' => ($item->user ?? null) && $item->user->id,
                'username' => ($item->user ?? null) && $item->user->displayName,
                'cityName' => ($item->geoip ?? null) && $item->geoip->city_name,
                'regionName' => ($item->geoip ?? null) && $item->geoip->region_name,
                'clientIp' => ($item->geoip ?? null) && $item->geoip->ip,
                'operationDesc' => $item->operation_desc,
                'operationName' => $item->operation_name,
                'timestamp' => $item->timestamp,
                'appId' => $item->app_id,
                'appName' => $item->appName ?? null,
            ];
        }, $list);
        return (object)[
            'list' => $list,
            'totalCount' => $totalCount,
        ];

    }

}
