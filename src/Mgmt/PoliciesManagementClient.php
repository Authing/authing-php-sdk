<?php

namespace Authing\Mgmt;

use Authing\Types\AddPolicyAssignmentsParam;
use Authing\Types\CommonMessage;
use Authing\Types\CreatePolicyParam;
use Authing\Types\DeletePoliciesParam;
use Authing\Types\DeletePolicyParam;
use Authing\Types\DisbalePolicyAssignmentParam;
use Authing\Types\PaginatedPolicies;
use Authing\Types\PaginatedPolicyAssignments;
use Authing\Types\PoliciesParam;
use Authing\Types\Policy;
use Authing\Types\PolicyAssignmentsParam;
use Authing\Types\PolicyAssignmentTargetType;
use Authing\Types\PolicyParam;
use Authing\Types\PolicyStatementInput;
use Authing\Types\RemovePolicyAssignmentsParam;
use Authing\Types\UpdatePolicyParam;
use Authing\Types\EnablePolicyAssignmentParam;


use Exception;

class PoliciesManagementClient
{
    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * PoliciesManagementClient constructor.
     * @param $client ManagementClient
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * 获取策略列表
     *
     * @param int $page 分页页数，默认为 1
     * @param int $limit 分页大小，默认为 10
     * @param bool $excludeDefault 是否排除系统默认资源，默认为 true
     * @return PaginatedPolicies
     * @throws Exception
     */
    public function paginate($page = 1, $limit = 10, $excludeDefault = true)
    {
        // TODO： 这个方法有问题
        // $param = (new PoliciesParam())->withPage($page)->withLimit($limit)->withExcludeDefault($excludeDefault);
        // return $this->client->request($param->createRequest());
    }

    /**
     * 创建策略
     *
     * @param $code string 策略唯一标志
     * @param $statements PolicyStatementInput[] 策略语句，详细格式与说明请见 https://docs.authing.co/docs/access-control/index.html
     * @param $description string 描述
     * @return Policy
     * @throws Exception
     */
    public function create($code, $statements, $description = null)
    {
        $param = (new CreatePolicyParam($code, $statements))->withDescription($description);
        return $this->client->request($param->createRequest());
    }

    /**
     * 更新策略
     *
     * @param $code string 策略唯一标志
     * @param $statements PolicyStatementInput[] 策略语句，详细格式与说明请见 https://docs.authing.co/docs/access-control/index.html
     * @param $description string 描述
     * @param $newCode string 新唯一标志
     * @return Policy
     * @throws Exception
     */
    public function update($code, $statements = null, $description = null, $newCode = null)
    {
        $param = (new UpdatePolicyParam($code))->withStatements($statements)->withDescription($description)->withNewCode($newCode);
        return $this->client->request($param->createRequest());
    }

    /**
     * 获取策略详情
     *
     * @param $code string 策略唯一标志
     * @return Policy
     * @throws Exception
     */
    public function detail($code)
    {
        $param = new PolicyParam($code);
        return $this->client->request($param->createRequest());
    }

    /**
     * 删除用户
     *
     * @param $code string 策略唯一标志
     * @return CommonMessage
     * @throws Exception
     */
    public function delete($code)
    {
        $param = new DeletePolicyParam($code);
        return $this->client->request($param->createRequest());
    }

    /**
     * 批量删除用户
     *
     * @param $codeList string[]
     * @return CommonMessage
     * @throws Exception
     */
    public function deleteMany($codeList)
    {
        $param = new DeletePoliciesParam($codeList);
        return $this->client->request($param->createRequest());
    }

    /**
     * 获取策略授权记录
     *
     * @param $code string 策略唯一标志
     * @param int $page 分页页数，默认为 1
     * @param int $limit 分页大小，默认为 10
     * @return PaginatedPolicyAssignments
     * @throws Exception
     */
    public function listAssignments($code, $page = 1, $limit = 10)
    {
        $param = (new PolicyAssignmentsParam())->withCode($code)->withPage($page)->withLimit($limit);
        return $this->client->request($param->createRequest());
    }

    /**
     * 添加策略授权
     *
     * @param $policies string[] 策略 code 列表
     * @param $targetType PolicyAssignmentTargetType 可选值为 USER (用户) 和 ROLE (角色)
     * @param $targetIdentifiers string[] 用户 id 列表和角色 code 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function addAssignments($policies, $targetType, $targetIdentifiers)
    {
        $param = (new AddPolicyAssignmentsParam($policies, $targetType))->withTargetIdentifiers($targetIdentifiers);
        return $this->client->request($param->createRequest());
    }

    /**
     * 移除策略授权
     *
     * @param $policies string[] 策略 code 列表
     * @param $targetType PolicyAssignmentTargetType 可选值为 USER (用户) 和 ROLE (角色)
     * @param $targetIdentifiers string[] 用户 id 列表和角色 code 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function removeAssignments($policies, $targetType, $targetIdentifiers)
    {
        $param = (new RemovePolicyAssignmentsParam($policies, $targetType))->withTargetIdentifiers($targetIdentifiers);
        return $this->client->request($param->createRequest());
    }
}
