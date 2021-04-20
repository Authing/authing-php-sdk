<?php


namespace Authing\Mgmt;


use Authing\Types\AddWhitelistParam;
use Authing\Types\CommonMessage;
use Authing\Types\RegisterWhiteListConfigInput;
use Authing\Types\RemoveWhitelistParam;
use Authing\Types\UpdateUserpoolInput;
use Authing\Types\WhiteList;
use Authing\Types\WhitelistParam;
use Authing\Types\WhitelistType;
use Exception;

class WhitelistManagementClient
{
    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * WhitelistManagementClient constructor.
     * @param $client ManagementClient
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * 获取白名单列表
     *
     * @param $type WhitelistType 白名单类型，USERNAME 为用户名、Email 为邮箱、Phone 为手机号。
     * @return WhiteList[]
     * @throws Exception
     */
    public function paginate($type)
    {
        $param = new WhitelistParam($type);
        return (array)$this->client->request($param->createRequest());
    }

    /**
     * 添加白名单
     *
     * @param $type WhitelistType 白名单类型，USERNAME 为用户名、Email 为邮箱、Phone 为手机号。
     * @param $list string[] 白名单列表，请注意邮箱不区分大小写。
     * @return CommonMessage
     * @throws Exception
     */
    public function add($type, $list)
    {
        $param = new AddWhitelistParam($type, $list);
        return $this->client->request($param->createRequest());
    }

    /**
     * 移除白名单
     *
     * @param $type WhitelistType 白名单类型，USERNAME 为用户名、Email 为邮箱、Phone 为手机号。
     * @param $list string[] 白名单列表，请注意邮箱不区分大小写。
     * @return CommonMessage
     * @throws Exception
     */
    public function remove($type, $list)
    {
        $param = new RemoveWhitelistParam($type, $list);
        return $this->client->request($param->createRequest());
    }

    /**
     * 开启白名单
     *
     * @param $type WhitelistType 白名单类型，USERNAME 为用户名、Email 为邮箱、Phone 为手机号。
     * @throws Exception
     */
    public function enable($type)
    {
        $updates = new RegisterWhiteListConfigInput();
        switch ($type) {
            case WhitelistType::EMAIL:
                $updates->emailEnabled = true;
                break;
            case WhitelistType::PHONE:
                $updates->phoneEnabled = true;
                break;
            case WhitelistType::USERNAME:
                $updates->usernameEnabled = true;
                break;
            default:
                throw new Exception("不支持的白名单类型", 500);
        }
        $this->client->userpools()->update((new UpdateUserpoolInput())->withWhitelist($updates));
    }

    /**
     * 关闭用户池
     *
     * @param $type WhitelistType 白名单类型，USERNAME 为用户名、Email 为邮箱、Phone 为手机号。
     * @throws Exception
     */
    public function disable($type)
    {
        $updates = new RegisterWhiteListConfigInput();
        switch ($type) {
            case WhitelistType::EMAIL:
                $updates->emailEnabled = false;
                break;
            case WhitelistType::PHONE:
                $updates->phoneEnabled = false;
                break;
            case WhitelistType::USERNAME:
                $updates->usernameEnabled = false;
                break;
            default:
                throw new Exception("不支持的白名单类型", 500);
        }
        $this->client->userpools()->update((new UpdateUserpoolInput())->withWhitelist($updates));
    }// zheshiyigezhesgi 
}