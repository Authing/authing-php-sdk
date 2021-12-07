<?php

namespace Authing\Mgmt;

use Authing\Types\AddMemberParam;
use Authing\Types\AddNodeV2Param;
use Authing\Types\MoveMembersParam;
use Authing\Types\RemoveMemberParam;
use Authing\Types\SearchNodesParam;
use Authing\Types\UpdateNodeParam;
use Error;
use FluentTraversable\FluentTraversable;
use FluentTraversable\Semantics\is;
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

    public static function buildTree1($data)
    {
        $rootNodes = array_filter($data, function ($item) {
            if (!isset($item->root)) {
                return false;
            }
            return $item->root == true;
        });
        $mapChildren = function ($childId) use ($data, &$mapChildren) {
            /* $node = array_filter($data, function ($item) use ($childId) {
                return $item->id == $childId;
            }); */
            $node =
                FluentTraversable::from($data)
                    ->filter(function ($item) use ($childId) {
                        return $item->id == $childId;
                    })
                    ->toArray();
            if (count($node) > 0) {
                $node = (object)$node[0];
            } else {
                $node = (object)[];
            }
            if (is_array($node->children) && count($node->children) > 0) {
                $childs = array_map($mapChildren, $node->children);
                $childs = array_filter($childs, function ($item) {
                    return $item;
                });
            }
            return $node;
        };
        $tree = FluentTraversable::from($rootNodes)
            ->map(function ($node) use (&$mapChildren) {
                $node->children = FluentTraversable::from($node->children)
                    ->map($mapChildren)
                    ->filter(is::notNull())
                    ->toArray();
                return $node;
            })
            ->toArray();
        return $tree[0];
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
//        $orgs = $data->orgs;
//        $list = $orgs->list;
//        array_map(function ($org) {
//            $this->buildTree($org);
//        }, $list);
//        $totalCount = $orgs->totalCount;
//        $_ = new stdClass;
//        $_->totalCount = $totalCount;
//        $_->list = $list;
//        return $_;
        return $data;
    }

    public function addNode(string $orgId, string $parentNodeId, array $data)
    {
        $data = (object)$data;
        $param = (new AddNodeV2Param($orgId, $data->name))
            ->withParentNodeId($parentNodeId)
            ->withCode($data->code ?? null)
            ->withDescription($data->description ?? null)
            ->withNameI18n($data->nameI18n ?? null)
            ->withOrder($data->order ?? null);
        return $this->client->request($param->createRequest());
    }

    public function updateNode(string $id, array $updates)
    {
        $updates = (object)$updates;
        $param = (new UpdateNodeParam($id))
            ->withCode($updates->code ?? null)
            ->withDescription($updates->description ?? null)
            ->withName($updates->name ?? null);
        return $this->client->request($param->createRequest());
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
//    public function moveNode($orgId, $nodeId, $targetParentId)
//    {
//        $param = new MoveNodeParam($orgId, $nodeId, $targetParentId);
//        // TODO: buildTree
//        return $this->client->request($param->createRequest());
//    }
    public function moveNode(string $orgId, string $nodeId, string $targetParentId)
    {
        $param = new MoveNodeParam($orgId, $nodeId, $targetParentId);
        $data = $this->client->request($param->createRequest());
        return $this->buildTree($data);
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

    public function importByJson(array $json)
    {
        $res = $this->client->httpPost('/api/v2/orgs/import', [
            'filetype' => 'json',
            'file' => $json,
        ]);
        return $res;
    }

    public function addMembers(string $nodeId, array $userIds)
    {
        $param = new AddMemberParam($nodeId, $userIds);
        $res = $this->client->request($param->createRequest());
        return $res->users;
    }


//    public function listMembers($param)
//    {
//        return $this->client->request($param->createRequest())->users;
//    }
    public function listMembers(string $nodeId, array $options)
    {
        $options = (object)$options;
        $param = (new NodeByIdWithMembersParam($nodeId))
            ->withIncludeChildrenNodes($options->includeChildrenNodes ?? false)
            ->withLimit($options->limit ?? 10)
            ->withPage($options->page ?? 1);
        $res = $this->client->request($param->createRequest())->users;
        return $res;
    }

    public function searchNodes(string $keyword)
    {
        $param = new SearchNodesParam($keyword);
        return $this->client->request($param->createRequest());
    }

    public function startSync(array $options)
    {
        $options = (object)$options;
        $providerType = $options->providerType ?? null;
        $adConnectorId = $options->adConnectorId ?? null;
        $url = '';
        $body = [];
        if ($providerType === 'wechatwork') {
            $url = 'connections/enterprise/wechatwork/start-sync';
        }
        switch ($providerType) {
            case 'wechatwork':
                $url = 'connections/enterprise/wechatwork/start-sync';
                break;
            case 'dingtalk':
                $url = 'connections/enterprise/dingtalk/start-sync';
                break;
            case 'ad':
                if ($adConnectorId) {
                    throw new Exception('must provider adConnectorId');
                }
                $url = 'api/v2/ad/sync';
                $body = [
                    'connectionId' => $adConnectorId
                ];
                break;
        }
        $res = $this->client->httpPost($url, $body);
        return true;
    }

    public function moveMembers(array $options)
    {
        $options = (object)$options;
        $param = new MoveMembersParam($options->userIds, $options->sourceNodeId, $options->targetNodeId);
        $this->client->request($param->createRequest());
        return true;
    }

    public function removeMembers(string $nodeId, array $userIds)
    {
        $param = (new RemoveMemberParam($userIds))->withNodeId($nodeId);
        $res = $this->client->request($param->createRequest());
        return $res;
    }

    public function getNodeById(string $nodeId)
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

    public function setMainDepartment(string $userId, string $departmentId)
    {
        $param = (new SetMainDepartmentParam($userId))->withDepartmentId($departmentId);
        $data = $this->client->request($param->createRequest());
        return $data;
    }

    public function exportByOrgId(string $orgId)
    {
        $data = $this->client->httpGet("/api/v2/orgs/export?org_id=$orgId");
        return $data;
    }

    public function listAuthorizedResourcesByNodeId(string $nodeId, string $namespace, string $resourceType = '')
    {
        $param = (new ListNodeByIdAuthorizedResourcesParam($nodeId))->withNamespace($namespace)->withResourceType($resourceType);
        $node = $this->client->request($param->createRequest());
        if (!$node) {
            throw new Error('组织机构节点不存在');
        }
//        $totalCount = $node->authorizedResources->totalCount;
//
//        $list = ($node->authorizedResources);
        return $node;
    }

//    public function listAuthorizedResourcesByNodeId(string $nodeId, string $namespace, array $options = [])
//    {
//        $resourceType = $options['resourceType'] ?? new stdClass;
//        $param = (new ListNodeByIdAuthorizedResourcesParam($nodeId))->withNamespace($namespace)->withResourceType($resourceType);
//        $node = $this->client->request($param->createRequest())->nodeById;
//        if (!$node) {
//            throw new Error('组织机构节点不存在');
//        }
//        $list = $node->authorizedResources->list;
//        $totalCount = $node->authorizedResources->totalCount;
//
//        $list = formatAuthorizedResources($list);
//        $_ = new stdClass;
//        $_->list = $list;
//        $_->totalCount = $totalCount;
//        return $_;
//    }

    public function listAuthorizedResourcesByNodeCode(string $orgId, string $code, string $namespace, array $options = [])
    {
        $resourceType = $options['resourceType'] ?? new stdClass;
        $param = (new ListNodeByCodeAuthorizedResourcesParam($orgId, $code))->withNamespace($namespace)->withResourceType($resourceType);
        $node = $this->client->request($param->createRequest());
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
