<?php


namespace Authing\Mgmt;

use Authing\Types\ChildrenNodesParam;
use Authing\Types\CommonMessage;
use Authing\Types\CreateOrgParam;
use Authing\Types\DeleteNodeParam;
use Authing\Types\DeleteOrgParam;
use Authing\Types\IsRootNodeParam;
use Authing\Types\MoveNodeParam;
use Authing\Types\Node;
use Authing\Types\NodeByIdWithMembersParam;
use Authing\Types\Org;
use Authing\Types\OrgParam;
use Authing\Types\OrgsParam;
use Authing\Types\PaginatedOrgs;
use Authing\Types\PaginatedUsers;
use Authing\Types\RootNodeParam;
use Exception;
use stdClass;

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
    public function create($name, $description = null, $code = null) {
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
    public function deleteById($id) {
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
    public function paginate($page = 1, $limit = 10) {
        $param = (new OrgsParam())->withPage($page)->withLimit($limit);
        // TODO: buildTree
        $data = $this->client->request($param->createRequest());
        $orgs = $data->orgs;
        $list = $orgs->list;
        array_map(function($org) {
            $this->buildTree($org);
        }, $list);
        $totalCount = $orgs->totalCount;
        $_ = new stdClass;
        $_->totalCount = $totalCount;
        $_->list = $list;
        return $_;
    }

    public function addNode($orgId, $parentNodeId, $data) {

    }

    public function updateNode($id, $updates) {

    }

    /**
     * 获取组织机构详情
     *
     * @param $id string 组织机构 ID
     * @return Org
     * @throws Exception
     */
    public function findById($id) {
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
    public function deleteNode($orgId, $nodeId) {
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
    public function moveNode($orgId, $nodeId, $targetParentId) {
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
    public function isRootNode($orgId, $nodeId) {
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
    public function listChildren($orgId, $nodeId) {
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
    public function rootNode($orgId) {
        $param = new RootNodeParam($orgId);
        return $this->client->request($param->createRequest());
    }

    public function importByJson($json) {

    }

    public function addMembers($nodeId, $userIds) {

    }

    /**
     * 获取节点成员
     *
     * @param $param NodeByIdWithMembersParam
     * @return PaginatedUsers
     * @throws Exception
     */
    public function listMembers($param) {
        return $this->client->request($param->createRequest())->users;
    }

    public function removeMembers($nodeId, $userIds) {

    }
}