<?php

namespace Authing\Mgmt\Roles;

use Error;
use stdClass;
use Exception;
use Authing\Types\Role;
use Authing\Types\UdvParam;
use Authing\Types\RoleParam;
use Authing\Types\RolesParam;
use Authing\Types\UDFDataType;
use Authing\Types\CommonMessage;
use Authing\Types\UDFTargetType;
use Authing\Types\PaginatedRoles;
use Authing\Types\PaginatedUsers;
use Authing\Types\RemoveUdvParam;
use Authing\Types\AssignRoleParam;
use Authing\Types\CreateRoleParam;
use Authing\Types\DeleteRoleParam;
use Authing\Types\RevokeRoleParam;
use Authing\Types\UpdateRoleParam;
use Authing\Types\DeleteRolesParam;
use Authing\Types\SetUdvBatchParam;
use Authing\Types\RoleWithUsersParam;
use Authing\Types\UdfValueBatchParam;
use Authing\Types\SetUdfValueBatchInput;
use Authing\Types\SetUdfValueBatchParam;
use Authing\Types\PolicyAssignmentsParam;
use Authing\Types\AddPolicyAssignmentsParam;
use Authing\Types\PaginatedPolicyAssignments;
use Authing\Types\PolicyAssignmentTargetType;
use Authing\Types\RemovePolicyAssignmentsParam;
use Authing\Types\ListRoleAuthorizedResourcesParam;

function formatAuthorizedResources($obj)
{
    $authorizedResources = $obj->authorizedResources;
    $list = $authorizedResources->list;
    $total = $authorizedResources->totalCount;
    array_map(function ($_) {
        foreach ($_ as $key => $value) {
            if (!$_->$key) {
                unset($_->$key);
            }
        }
        return $_;
    }, (array) $list);
    $res = new stdClass;
    $res->list = $list;
    $res->totalCount = $total;
    return $res;
}

function convertUdv(array $data)
{
    foreach ($data as $item) {
        $dataType = $item->dataType;
        $value = $item->value;
        if ($dataType === UDFDataType::NUMBER) {
            $item->value = json_encode($value);
        } else if ($dataType === UDFDataType::BOOLEAN) {
            $item->value = json_encode($value);
        } else if ($dataType === UDFDataType::DATETIME) {
            // set data time
            // $item->value = intval($value);
        } else if ($dataType === UDFDataType::OBJECT) {
            $item->value = json_encode($value);
        }
    }
    return $data;
}

function convertUdvToKeyValuePair(array $data)
{
    foreach ($data as $item) {
        $dataType = $item->dataType;
        $value = $item->value;
        if ($dataType === UDFDataType::NUMBER) {
            $item->value = json_encode($value);
        } else if ($dataType === UDFDataType::BOOLEAN) {
            $item->value = json_encode($value);
        } else if ($dataType === UDFDataType::DATETIME) {
            // set data time
            // $item->value = intval($value);
        } else if ($dataType === UDFDataType::OBJECT) {
            $item->value = json_encode($value);
        }
    }

    $ret = new stdClass();
    foreach ($data as $item) {
        $key = $item->key;
        $ret->$key = $item->value;
    }
    return $ret;
}

class RolesManagementClient
{
    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * RolesManagementClient constructor.
     * @param $client ManagementClient
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * 获取角色列表
     *
     * @param $page int 分页页数
     * @param $limit int 分页大小
     * @return PaginatedRoles
     * @throws Exception
     */
    public function paginate($page = 1, $limit = 10)
    {
        $param = (new RolesParam())->withPage($page)->withLimit($limit);
        return $this->client->request($param->createRequest());
    }

    /**
     * 创建角色
     *
     * @param $code string 角色唯一标志
     * @param $description string 角色描述
     * @param $parentCode string 父角色唯一标志
     * @return Role
     * @throws Exception
     */
    public function create($code, $description = null, $namespace = null)
    {
        $param = (new CreateRoleParam($code))->withDescription($description)->withNamespace($namespace);
        return $this->client->request($param->createRequest());
    }

    /**
     * 获取角色信息
     *
     * @param $code string 角色唯一标志
     * @return Role
     * @throws Exception
     */
    public function detail($code)
    {
        $param = new RoleParam($code);
        return $this->client->request($param->createRequest());
    }

    public function findByCode(string $code, string $namespace = '')
    {
        $param = (new RoleParam($code))->withNamespace($namespace);
        return $this->client->request($param->createRequest());
    }

    /**
     * 更新角色信息
     *
     * @param $code string 角色唯一 ID
     * @param $description string 角色描述
     * @param $newCode string 新的角色唯一 ID
     * @return Role
     * @throws Exception
     */
    public function update($code, $description = null, $newCode = null)
    {
        $param = (new UpdateRoleParam($code))->withDescription($description)->withNewCode($newCode);
        return $this->client->request($param->createRequest());
    }

    /**
     * 删除角色
     *
     * @param $code string 角色唯一 ID
     * @return CommonMessage
     * @throws Exception
     */
    public function delete($code)
    {
        $param = new DeleteRoleParam($code);
        return $this->client->request($param->createRequest());
    }

    /**
     * 批量删除角色
     *
     * @param $codeList string[] 角色唯一 ID 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function deleteMany($codeList)
    {
        $param = new DeleteRolesParam($codeList);
        return $this->client->request($param->createRequest());
    }

    /**
     * 获取用户列表
     *
     * @param $code string 角色唯一标志
     * @return PaginatedUsers
     * @throws Exception
     */
    public function listUsers($code)
    {
        $param = new RoleWithUsersParam($code);
        return $this->client->request($param->createRequest());
    }

    /**
     * 批量添加用户
     *
     * @param $code string 角色唯一 ID
     * @param $userIds string[] 用户 ID 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function addUsers($code, $userIds)
    {
        $param = (new AssignRoleParam())->withUserIds($userIds)->withRoleCodes([$code]);
        return $this->client->request($param->createRequest());
    }

    /**
     * 批量移除用户
     *
     * @param $code string 角色唯一 ID
     * @param $userIds string[] 用户 ID 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function removeUsers($code, $userIds)
    {
        $param = (new RevokeRoleParam())->withUserIds($userIds)->withRoleCodes([$code]);
        return $this->client->request($param->createRequest());
    }

    /**
     * 获取策略列表
     *
     * @param $code string 角色唯一 ID
     * @param $page int 分页页数
     * @param $limit int 分页大小
     * @return PaginatedPolicyAssignments
     * @throws Exception
     */
    public function listPolicies($code, $page = 1, $limit = 10)
    {
        $param = (new PolicyAssignmentsParam())
            ->withPage($page)
            ->withLimit($limit)
            ->withTargetIdentifier($code)
            ->withTargetType(PolicyAssignmentTargetType::ROLE);
        return $this->client->request($param->createRequest());
    }

    /**
     * 添加策略
     *
     * @param $code string 角色唯一 ID
     * @param $policies string[] 策略 ID 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function addPolicies($code, $policies)
    {
        $param = (new AddPolicyAssignmentsParam($policies, PolicyAssignmentTargetType::ROLE))
            ->withTargetIdentifiers([$code]);
        return $this->client->request($param->createRequest());
    }

    /**
     * 移除策略
     *
     * @param $code string 角色唯一 ID
     * @param $policies string[] 策略 ID 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function removePolicies($code, $policies)
    {
        $param = (new RemovePolicyAssignmentsParam($policies, PolicyAssignmentTargetType::ROLE))
            ->withTargetIdentifiers([$code]);
        return $this->client->request($param->createRequest());
    }

    public function listAuthorizedResources($roleCode, $namespace, $opts = [])
    {
        $resourceType = null;
        if (count($opts) > 0) {
            $resourceType = $opts['resourceType'];
        }
        $param = (new ListRoleAuthorizedResourcesParam($roleCode))->withNamespace($namespace)->withResourceType($resourceType);
        $data = $this->client->request($param->createRequest());

        return formatAuthorizedResources($data);
    }

    public function getUdfValue(string $roleId)
    {
        $param = (new UdvParam('ROLE', $roleId));
        $data = $this->client->request($param->createRequest());
        $list = $data->udv;
        return convertUdvToKeyValuePair($list);
    }

    public function getSpecificUdfValue(string $roleId, string $udfKey)
    {
        $param = new UdvParam(UDFTargetType::ROLE, $roleId);
        $data = $this->client->request($param->createRequest())->udv;

        $udfMap = convertUdvToKeyValuePair($data);
        $udfValue = new stdClass();

        foreach ($udfMap as $key => $value) {
            if ($udfKey === $key) {
                $udfValue->$key = $value;
            }
        }

        return $udfValue;
    }

    public function getUdfValueBatch(array $roleIds)
    {
        if (count($roleIds) === 0) {
            throw new Error('empty user id list');
        }

        $param = new UdfValueBatchParam(UDFTargetType::ROLE, $roleIds);
        $data = $this->client->request($param->createRequest())->udfValueBatch;

        $ret = new stdClass();
        foreach ($data as $value) {
            $targetId = $value->targetId;
            $_data = $value->data;
            $ret->$targetId = convertUdvToKeyValuePair($data);
        }

        return $ret;
    }

    public function setUdfValue(string $roleId, array $data)
    {
        if (count($data) === 0) {
            throw new Error('empty udf value list');
        }

        $param = (new SetUdvBatchParam(UDFTargetType::ROLE, $roleId))->withUdvList((object)$data);
        $this->client->request($param->createRequest());
    }

    public function setUdfValueBatch(array $input)
    {
        if (count($input) === 0) {
            throw new Error('empty input list');
        }
        $params = [];
        foreach ($input as $item) {
            $userId = $item->roleId;
            $data = $item->data;
            foreach ($data as $key => $value) {
                $param = new SetUdfValueBatchInput($userId, $key, $value);
                array_push($params, $param);
            }
        }
        $param = new SetUdfValueBatchParam(UDFTargetType::ROLE, $params);
        $this->client->request($param->createRequest());
    }

    public function removeUdfValue(string $roleId, string $key)
    {
        $param = new RemoveUdvParam(UDFTargetType::ROLE, $roleId, $key);
        $this->client->request($param->createRequest());
    }
}
