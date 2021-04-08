<?php

namespace Authing\Mgmt;

use Authing\Types\AllowParam;
use Authing\Types\AuthorizedResourcesParam;
use Authing\Types\CommonMessage;
use Authing\Types\IsActionAllowedParam;
use Exception;
use stdClass;

function formatAuthorizedResources($obj)
{
    // $authorizedResources = $obj->authorizedResources;
    $list = $obj->list;
    $total = $obj->totalCount;
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

class AclManagementClient
{
    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * AclManagementClient constructor.
     * @param $client ManagementClient
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * 允许某个用户操作某个资源
     *
     * @param $resource string 资源 ID
     * @param $action string 操作 ID
     * @param $userId string 用户 ID
     * @param $role string 角色 ID
     * @return CommonMessage
     * @throws Exception
     */
    public function allow($resource, $action, $userId = null, $role = null)
    {
        $param = (new AllowParam($resource, $action))->withUserId($userId)->withRoleCode($role);
        return $this->client->request($param->createRequest());
    }

    /**
     * 是否允许某个用户操作某个资源
     *
     * @param $userId string 用户 ID
     * @param $action string 操作 ID
     * @param $resource string 资源 ID
     * @return bool
     * @throws Exception
     */
    public function isAllowed($userId, $action, $resource)
    {
        $param = new IsActionAllowedParam($resource, $action, $userId);
        return $this->client->request($param->createRequest());
    }

    // targetType: PolicyAssignmentTargetType,
    // targetIdentifier: string,
    // namespace: string,
    public function listAuthorizedResources($targetType, string $targetIdentifier, string $namespace, $ops = [])
    {
        $resourceType = null;
        if (count($ops) > 0) {
            $resourceType = $ops['resourceType'];
        }
        $param = (new AuthorizedResourcesParam())->withTargetType($targetType)->withTargetIdentifier($targetIdentifier)->withNamespace($namespace)->withResourceType($resourceType);
        $data = formatAuthorizedResources($this->client->request($param->createRequest()));
        return $data;
    }

    public function getResources(array $options)
    {
        extract($options, EXTR_OVERWRITE);
        $array = [
            'namespaceCode' => $namespaceCode,
            'type' => $type,
            'limit' => $limit ?? 10,
            'page' => $page ?? 1,
        ];
        $params = http_build_query($array);
        $data = $this->client->httpGet("/api/v2/resources?$params");
    }

    public function createResource(array $options)
    {
        if (!isset($options['code'])) {
            throw new Error('请为资源设定一个资源标识符');
        }
        if (!isset($options['actions']) || count($options['actions']) === 0) {
            throw new Error('请至少定义一个资源操作');
        }
        if (!isset($options['namespace'])) {
            throw new Error('请传入权限分组标识符');
        }
        $data = $this->client->httpPost('/api/v2/resources', $options);

        return $data;
    }

    public function updateResource(string $code, array $options)
    {
        $data = $this->client->httpPost("/api/v2/resources/$code", $options);
        return $data;
    }

    public function deleteResource(string $code, string $namespaceCode)
    {
        $data = $this->client->httpDelete("/api/v2/resources/$code?namespace=$namespaceCode");
        return true;
    }
}