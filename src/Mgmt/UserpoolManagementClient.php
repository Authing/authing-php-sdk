<?php


namespace Authing\Mgmt;


use Authing\Types\CommonMessage;
use Authing\Types\Env;
use Authing\Types\UpdateUserpoolInput;
use Authing\Types\UpdateUserpoolParam;
use Authing\Types\UserPool;
use Authing\Types\UserpoolParam;
use Exception;

class UserpoolManagementClient
{
    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * UserpoolManagementClient constructor.
     * @param $client ManagementClient
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * 获取用户池详情
     *
     * @return UserPool
     * @throws Exception
     */
    public function detail() {
        $param = new UserpoolParam();
        return $this->client->request($param->createRequest());
    }

    /**
     * 更新用户池信息
     *
     * @param $updates UpdateUserpoolInput
     * @return UserPool
     * @throws Exception
     */
    public function update($updates) {
        $param = new UpdateUserpoolParam($updates);
        return $this->client->request($param->createRequest());
    }

    /**
     * 获取环境变量列表
     *
     * @return Env[]
     * @throws Exception
     */
    public function listEnv() {
        $res = $this->client->httpGet('/api/v2/env');

        if ($res->code != 200) {
            throw new Exception($res->message, $res->code);
        }

        return (array)$res->data;
    }

    /**
     * 添加环境变量
     *
     * @param $key string
     * @param $value mixed
     * @return Env
     * @throws Exception
     */
    public function addEnv($key, $value) {
        $res = $this->client->httpPost('/api/v2/env', [
            "key" => $key,
            "value" => $value,
        ]);

        if ($res->code != 200) {
            throw new Exception($res->message, $res->code);
        }

        return $res->data;
    }

    /**
     * 移除环境变量
     *
     * @param $key string
     * @return object
     * @throws Exception
     */
    public function removeEnv($key) {
        $res = $this->client->httpDelete('/api/v2/env/' . $key);

        if ($res->code != 200) {
            throw new Exception($res->message, $res->code);
        }

        return $res;
    }
}