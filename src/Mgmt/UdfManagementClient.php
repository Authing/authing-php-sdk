<?php


namespace Authing\Mgmt;


use Authing\Types\CommonMessage;
use Authing\Types\RemoveUdfParam;
use Authing\Types\SetUdfParam;
use Authing\Types\UDFDataType;
use Authing\Types\UdfParam;
use Authing\Types\UDFTargetType;
use Authing\Types\UserDefinedField;
use Exception;

class UdfManagementClient
{
    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * UdfManagementClient constructor.
     * @param $client ManagementClient
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * 获取自定义字段元信息列表
     *
     * @param $targetType UDFTargetType
     * @return UserDefinedField[]
     * @throws Exception
     */
    public function paginate($targetType)
    {
        $param = new UdfParam($targetType);
        return (array)$this->client->request($param->createRequest());
    }

    /**
     * 设置自定义字段元信息
     *
     * @param $targetType UDFTargetType 自定义字段目标类型， USER 表示用户、ROLE 表示角色。
     * @param $key string 字段 key
     * @param $dataType UDFDataType 数据类型，目前共支持五种数据类型。STRING 为字符串、NUMBER 为数字、DATETIME 为日期、BOOLEAN 为 boolean 值、OBJECT 为对象。
     * @param $label string 字段 Label，一般是一个 Human Readable 字符串。
     * @return UserDefinedField
     * @throws Exception
     */
    public function set($targetType, $key, $dataType, $label)
    {
        $param = new SetUdfParam($targetType, $key, $dataType, $label);
        return $this->client->request($param->createRequest());
    }

    /**
     * 移除自定义字段元数据
     *
     * @param $targetType UDFTargetType 自定义字段目标类型， USER 表示用户、ROLE 表示角色。
     * @param $key string 字段 key
     * @return CommonMessage
     * @throws Exception
     */
    public function remove($targetType, $key)
    {
        $param = new RemoveUdfParam($targetType, $key);
        return $this->client->request($param->createRequest());
    }
}