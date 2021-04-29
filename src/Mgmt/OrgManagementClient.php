<?php

namespace Authing\Mgmt;

use Error;
use stdClass;
use Exception;
use Authing\Types\Org;
use Authing\Types\Node;
use Authing\Types\OrgParam;
use Authing\Types\OrgsParam;
use Authing\Types\CommonMessage;
use Authing\Types\MoveNodeParam;
use Authing\Types\NodeByIdParam;
use Authing\Types\PaginatedOrgs;
use Authing\Types\RootNodeParam;
use Authing\Types\CreateOrgParam;
use Authing\Types\DeleteOrgParam;
use Authing\Types\PaginatedUsers;
use Authing\Types\DeleteNodeParam;
use Authing\Types\IsRootNodeParam;
use Authing\Types\ChildrenNodesParam;
use Authing\Types\SetMainDepartmentParam;


use Authing\Types\NodeByIdWithMembersParam;
use Authing\Types\ListNodeByIdAuthorizedResourcesParam;
use Authing\Types\ListNodeByCodeAuthorizedResourcesParam;

class OrgManagementClient
{
    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * OrgManagementClient constructor.
     * @param $client ManagementClient
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * 创建组织机构，会创建一个只有一个节点的组织机构。
     *
     * @param string $name 组织机构名称，该名称会作为该组织机构根节点的名称。
     * @param string $description 根节点描述
     * @param string $code 根节点唯一标志，必须为合法的英文字符。
     * @return Org
     * @throws Exception
     */
    public function create($name, $description = null, $code = null)
    {
        $param = (new CreateOrgParam($name))->withCode($code)->withDescription($description);
        return $this->client->request($param->createRequest());
    }

    /**
     * 删除组织机构树
     *
     * @param $id
     * @return CommonMessage
     * @throws Exception
     */
    public function deleteById($id)
    {
        $param = new DeleteOrgParam($id);
        return $this->client->request($param->createRequest());
    }

    private function buildTree($org)
    {
        $org->tree = $this->buildTree(json_encode($org->nodes));
        return $org;
    }

    /**
     * 获取用户池组织机构列表
     *
     * @param int $page
     * @param int $limit
     * @return PaginatedOrgs
     * @throws Exception
     */
    public function paginate($page = 1, $limit = 10)
    {
        $param = (new OrgsParam())->withPage($page)->withLimit($limit);
        // TODO: buildTree
        $data = $this->client->request($param->createRequest());
        $orgs = $data->orgs;
        $list = $orgs->list;
        array_map(function ($org) {
            $this->buildTree($org);
        }, $list);
        $totalCount = $orgs->totalCount;
        $_ = new stdClass;
        $_->totalCount = $totalCount;
        $_->list = $list;
        return $_;
    }

    public function addNode($orgId, $parentNodeId, $data)
    {

    }

    public function updateNode($id, $updates)
    {

    }

    /**
     * 获取组织机构详情
     *
     * @param $id string 组织机构 ID
     * @return Org
     * @throws Exception
     */
    public function findById($id)
    {
        $param = new OrgParam($id);
        // TODO: buildTree
        return $this->client->request($param->createRequest());
    }

    /**
     * 删除节点
     *
     * @param $orgId string 组织机构 ID
     * @param $nodeId string 节点 ID
     * @return CommonMessage
     * @throws Exception
     */
    public function deleteNode($orgId, $nodeId)
    {
        $param = new DeleteNodeParam($orgId, $nodeId);
        return $this->client->request($param->createRequest());
    }

    /**
     * 移动节点
     *
     * @param $orgId string 组织机构 ID
     * @param $nodeId string 需要移动的节点 ID
     * @param $targetParentId string 目标父节点 ID
     * @return Org
     * @throws Exception
     */
    public function moveNode($orgId, $nodeId, $targetParentId)
    {
        $param = new MoveNodeParam($orgId, $nodeId, $targetParentId);
        // TODO: buildTree
        return $this->client->request($param->createRequest());
    }

    /**
     * 判断是否为根节点
     *
     * @param $orgId string 组织机构 ID
     * @param $nodeId string 节点 ID
     * @return boolean
     * @throws Exception
     */
    public function isRootNode($orgId, $nodeId)
    {
        $param = new IsRootNodeParam($orgId, $nodeId);
        return $this->client->request($param->createRequest());
    }

    /**
     * 获取子节点列表
     *
     * @param $orgId string 组织机构 ID
     * @param $nodeId string 节点 ID
     * @return Node[]
     * @throws Exception
     */
    public function listChildren($orgId, $nodeId)
    {
        $param = new ChildrenNodesParam($orgId, $nodeId);
        return $this->client->request($param->createRequest());
    }

    /**
     * 获取根节点
     *
     * @param $orgId string 组织机构 ID
     * @return Node[]
     * @throws Exception
     */
    public function rootNode($orgId)
    {
        $param = new RootNodeParam($orgId);
        return $this->client->request($param->createRequest());
    }

    public function importByJson($json)
    {

    }

    public function addMembers($nodeId, $userIds)
    {

    }

    /**
     * 获取节点成员
     *
     * @param $param NodeByIdWithMembersParam
     * @return PaginatedUsers
     * @throws Exception
     */
    public function listMembers($param)
    {
        return $this->client->request($param->createRequest())->users;
    }

    public function removeMembers($nodeId, $userIds)
    {

    }

    /**
     * @param string $nodeId
     */
    public function getNodeById($nodeId)
    {
        $param = new NodeByIdParam($nodeId);
        $node = $this->client->request($param->createRequest());
        return $node;
    }

    public function exportAll()
    {
        $data = $this->client->httpGet('/api/v2/orgs/export');
        return $data;
    }

    /**
     * @param string $userId
     * @param string $departmentId
     */
    public function setMainDepartment($userId, $departmentId)
    {
        $param = (new SetMainDepartmentParam($userId))->withDepartmentId($departmentId);
        $data = $this->client->request($param->createRequest())->setMainDepartment;
        return $data;
    }

    /**
     * @param string $orgId
     */
    public function exportByOrgId($orgId)
    {
        $data = $this->client->httpGet("/api/v2/orgs/export?org_id=$orgId");
        return $data;
    }

    /**
     * @param string $nodeId
     * @param string $namespace
     */
    public function listAuthorizedResourcesByNodeId($nodeId, $namespace, array $options = [])
    {
        $resourceType = isset($options['resourceType']) ? $options['resourceType'] : new stdClass;
        $param = (new ListNodeByIdAuthorizedResourcesParam($nodeId))->withNamespace($namespace)->withResourceType($resourceType);
        $node = $this->client->request($param->createRequest())->nodeById;
        if (!$node) {
            throw new Error('组织机构节点不存在');
        }
        $list = $node->authorizedResources->list;
        $totalCount = $node->authorizedResources->totalCount;

        $list = formatAuthorizedResources($list);
        $_ = new stdClass;
        $_->list = $list;
        $_->totalCount = $totalCount;
        return $_;
    }

    /**
     * @param string $orgId
     * @param string $code
     * @param string $namespace
     */
    public function listAuthorizedResourcesByNodeCode($orgId, $code, $namespace, array $options = [])
    {
        $resourceType = isset($options['resourceType']) ? $options['resourceType'] : new stdClass;
        $param = (new ListNodeByCodeAuthorizedResourcesParam($orgId, $code))->withNamespace($namespace)->withResourceType($resourceType);
        $node = $this->client->request($param->createRequest())->nodeById;
        if (!$node) {
            throw new Error('组织机构节点不存在');
        }
        $list = $node->authorizedResources->list;
        $totalCount = $node->authorizedResources->totalCount;

        $list = formatAuthorizedResources($list);
        $_ = new stdClass;
        $_->list = $list;
        $_->totalCount = $totalCount;
        return $_;
    }
}
