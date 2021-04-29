<?php


namespace Authing\Mgmt\Groups;


use Authing\Types\AddUserToGroupParam;
use Authing\Types\CommonMessage;
use Authing\Types\CreateGroupParam;
use Authing\Types\DeleteGroupsParam;
use Authing\Types\Group;
use Authing\Types\GroupParam;
use Authing\Types\GroupsParam;
use Authing\Types\GroupWithUsersParam;
use Authing\Types\PaginatedGroups;
use Authing\Types\PaginatedUsers;
use Authing\Types\RemoveUserFromGroupParam;
use Authing\Types\UpdateGroupParam;
use Authing\Types\ListGroupAuthorizedResourcesParam;

use stdClass;
use Exception;


function formatAuthorizedResources($obj) {
    $authorizedResources = $obj->authorizedResources;
    $list = $authorizedResources->list;
    $total = $authorizedResources->totalCount;
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


class GroupsManagementClient
{
    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * GroupsManagementClient constructor.
     * @param $client ManagementClient
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * 获取分组列表
     *
     * @param int $page 分页页数，默认为 1
     * @param int $limit 分页大小，默认为 10
     * @return PaginatedGroups
     * @throws Exception
     */
    public function paginate($page = 1, $limit = 10) {
        $param = (new GroupsParam())->withPage($page)->withLimit($limit);
        return $this->client->request($param->createRequest());
    }

    /**
     * 创建分组
     *
     * @param $code string 分组唯一标志符
     * @param $name string 分组名称
     * @param string $description 描述
     * @return Group
     * @throws Exception
     */
    public function create($code, $name, $description = null) {
        $param = (new CreateGroupParam($code, $name))->withDescription($description);
        return $this->client->request($param->createRequest());
    }

    /**
     * 更新分组
     *
     * @param $code string 分组唯一标志
     * @param $name string 分组名称
     * @param $description string 描述
     * @param $newCode string 新唯一标志
     * @return Group
     * @throws Exception
     */
    public function update($code, $name = null, $description = null, $newCode = null) {
        $param = (new UpdateGroupParam($code))->withName($name)->withDescription($description)->withNewCode($newCode);
        return $this->client->request($param->createRequest());
    }

    /**
     * 获取分组信息
     *
     * @param $code string 分组唯一标志
     * @return Group
     * @throws Exception
     */
    public function detail($code) {
        $param = new GroupParam($code);
        return $this->client->request($param->createRequest());
    }

    /**
     * 删除分组
     *
     * @param $code string 分组 code
     * @return CommonMessage
     * @throws Exception
     */
    public function delete($code) {
        $param = new DeleteGroupsParam([$code]);;
        return $this->client->request($param->createRequest());
    }

    /**
     * 批量删除分组
     *
     * @param $codeList string[] 分组 code 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function deleteMany($codeList) {
        $param = new DeleteGroupsParam($codeList);
        return $this->client->request($param->createRequest());
    }

    /**
     * 获取分组用户
     *
     * @param $code string 分组唯一标志
     * @param int $page 分页页数，默认为 1
     * @param int $limit 分页大小，默认为 10
     * @return PaginatedUsers
     * @throws Exception
     */
    public function listUsers($code, $page = 1, $limit = 10) {
        $param = (new GroupWithUsersParam($code))->withPage($page)->withLimit($limit);
        return $this->client->request($param->createRequest());
    }

    /**
     * 添加用户
     *
     * @param $code string 分组唯一标志
     * @param $userIds string[] 用户 ID 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function addUsers($code, $userIds) {
        $param = (new AddUserToGroupParam($userIds))->withCode($code);
        return $this->client->request($param->createRequest());
    }

    /**
     * 移除用户
     *
     * @param $code string 分组唯一标志
     * @param $userIds string[] 用户 ID 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function removeUsers($code, $userIds) {
        $param = (new RemoveUserFromGroupParam($userIds))->withCode($code);
        return $this->client->request($param->createRequest());
    }

    function listAuthorizedResources($groupCode, $namespace, $opts = [])
    {
        $resourceType = null;
        if (count($opts) > 0) {
            $resourceType = $opts['resourceType'];
        }
        $param = (new ListGroupAuthorizedResourcesParam($groupCode))->withNamespace($namespace)->withResourceType($resourceType);
        $data = $this->client->request($param->createRequest());
         
        return formatAuthorizedResources($data);
    }
}