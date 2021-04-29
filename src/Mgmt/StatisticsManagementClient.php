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

    /**
     * @param \Authing\Mgmt\ManagementClient $client
     */
    public function __construct($client)
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

        $requestParam->page = isset($options->page) ? $options->page : 1;
        $requestParam->limit = isset($options->limit) ? $options->limit : 10;
        $params = http_build_query($requestParam);
        $data = $this->client->httpGet("/api/v2/analysis/user-action?$params");
        list($list, $totalCount) = (array)$data->data;
        array_map(function ($item) {
            return (object) [
                'userpoolId' => $item->userpool_id,
                'userId' => (isset($item->user) ? $item->user : null) && $item->user->id,
                'username' => (isset($item->user) ? $item->user : null) && $item->user->displayName,
                'cityName' => (isset($item->geoip) ? $item->geoip : null) && $item->geoip->city_name,
                'regionName' => (isset($item->geoip) ? $item->geoip : null) && $item->geoip->region_name,
                'clientIp' => (isset($item->geoip) ? $item->geoip : null) && $item->geoip->ip,
                'operationDesc' => $item->operation_desc,
                'operationName' => $item->operation_name,
                'timestamp' => $item->timestamp,
                'appId' => $item->app_id,
                'appName' => isset($item->appName) ? $item->appName : null,
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

        $requestParam->page = isset($options->page) ? $options->page : 1;
        $requestParam->limit = isset($options->limit) ? $options->limit : 10;
        $params = http_build_query($requestParam);
        $data = $this->client->httpGet("/api/v2/analysis/user-action?$params");

        list($list, $totalCount) = (array)$data->data;
        array_map(function ($item) {
            return (object) [
                'userpoolId' => $item->userpool_id,
                'operatorType' => isset($item->operator_type) ? $item->operator_type : null,
                'userId' => (isset($item->user) ? $item->user : null) && $item->user->id,
                'username' => (isset($item->user) ? $item->user : null) && $item->user->displayName,
                'cityName' => (isset($item->geoip) ? $item->geoip : null) && $item->geoip->city_name,
                'regionName' => (isset($item->geoip) ? $item->geoip : null) && $item->geoip->region_name,
                'clientIp' => (isset($item->geoip) ? $item->geoip : null) && $item->geoip->ip,
                'operationDesc' => $item->operation_desc,
                'operationName' => $item->operation_name,
                'timestamp' => $item->timestamp,
                'appId' => $item->app_id,
                'appName' => isset($item->appName) ? $item->appName : null,
            ];
        }, $list);
        return (object)[
            'list' => $list,
            'totalCount' => $totalCount,
        ];

    }

}
