<?php


namespace Authing\Mgmt;

use Authing\Types\AllowParam;
use Authing\Types\CommonMessage;
use Authing\Types\IsActionAllowedParam;
use Authing\Types\PolicyAssignmentTargetType;
use Authing\Types\AuthorizedResourcesParam;

use Exception;
use stdClass;

function formatAuthorizedResources($obj) {
    // $authorizedResources = $obj->authorizedResources;
    $list = $obj->list;
    $total = $obj->totalCount;
    array_map(function($_){
        foreach($_ as $key => $value) {
            if(!$_->$key) {
                unset($_->$key);
            }
        }
        return $_;
    }, (array)$list);
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
    public function allow($resource, $action, $userId=null, $role=null) {
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
    public function isAllowed($userId, $action, $resource) {
        $param = new IsActionAllowedParam($resource, $action, $userId);
        return $this->client->request($param->createRequest());
    }

    // targetType: PolicyAssignmentTargetType,
    // targetIdentifier: string,
    // namespace: string,
    function listAuthorizedResources($targetType, string $targetIdentifier, string $namespace, $ops = []) {
        $resourceType = null;
        if(count($ops) > 0) {
            $resourceType = $ops->$resourceType;
        }
        $param = (new AuthorizedResourcesParam())->withTargetType($targetType)->withTargetIdentifier($targetIdentifier)->withNamespace($namespace)->withResourceType($resourceType);
        $data = formatAuthorizedResources($this->client->request($param->createRequest()));
        return $data;
    }

}