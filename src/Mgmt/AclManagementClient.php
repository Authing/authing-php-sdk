<?php

namespace Authing\Mgmt\Acl;

use Authing\Types\AllowParam;
use Authing\Types\AuthorizedResourcesParam;
use Authing\Types\AuthorizeResourceParam;
use Authing\Types\CommonMessage;
use Authing\Types\IsActionAllowedParam;
use Authing\Mgmt\ManagementClient;
use Error;
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

function randomString(int $randomLenth = 32)
{
    $randomLenth = $randomLenth ?? 32;
    $t = 'abcdefhijkmnprstwxyz2345678';
    $a = strlen($t);
    $n = '';

    for ($i = 0; $i < $randomLenth; $i++) {
        $n .= $t[rand(0, $a - 1)];
    }
    return $n;
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
        return $data;
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

    public function programmaticAccessAccountList(string $appId, int $page = 1, int $limit = 10)
    {
        $res = $this->client->httpGet("/api/v2/applications/$appId/programmatic-access-accounts?limit=$limit&page=$page");
        return $res;
    }

    public function createProgrammaticAccessAccount(string $appId, array $options = ["tokenLifetime" => 600])
    {
        $res = $this->client->httpPost("/api/v2/applications/$appId/programmatic-access-accounts", $options);
        return $res;
    }

    public function disableProgrammaticAccessAccount(string $programmaticAccessAccountId)
    {
        $res = $this->client->httpPatch('/api/v2/applications/programmatic-access-accounts', [
            'id' => $programmaticAccessAccountId,
            'enabled' => false,
        ]);
        return $res;
    }

    public function listNamespaces(int $page = 1, int $limit = 10)
    {
        $api = "/api/v2/resource-namespace/{$this->options->userPoolId}";
        $param = http_build_query([
            "page" => $page,
            "limit" => $limit,
        ]);
        $data = $this->client->httpGet($api.$param);
        return $data;
    }

    public function deleteNamespace(string $code)
    {
        $api = "/api/v2/resource-namespace/${this.options.userPoolId}/code/$code";
        $this->client->httpDelete($api);
        return true;
    }

    public function createNamespace(string $code, string $name, string $description = '')
    {
        $api = "/api/v2/resource-namespace/{$this->options->userPoolId}";
        $data = $this->client->httpPost($api, [
            'name' => $name,
            'code' => $code,
            'description' => $description
        ]);
        return $data;
    }

    public function updateNamespace(string $code, array $updates)
    {
        $api = "/api/v2/resource-namespace/${this.options.userPoolId}/code/$code";
        $this->client->httpPut($api, $updates);
    }

    public function deleteProgrammaticAccessAccount(string $programmaticAccessAccountId)
    {
        $this->client->httpDelete("/api/v2/applications/programmatic-access-accounts?id=$programmaticAccessAccountId");
        return true;
    }

    public function enableProgrammaticAccessAccount(string $programmaticAccessAccountId)
    {
        $res = $this->client->httpPatch("/api/v2/applications/programmatic-access-accounts", [
            'id' => $programmaticAccessAccountId,
            'enabled' => true,
        ]);
        return $res;
    }

    public function refreshProgrammaticAccessAccountSecret(string $programmaticAccessAccountId, string $programmaticAccessAccountSecret = '')
    {
        if (!isset($programmaticAccessAccountSecret) || $programmaticAccessAccountSecret === '') {
            $programmaticAccessAccountSecret = randomString(32);
        }
        $res = $this->client->httpPatch('/api/v2/applications/programmatic-access-accounts', [
            'id' => $programmaticAccessAccountId,
            'secret' => $programmaticAccessAccountSecret,
        ]);
        return $res;
    }

    public function authorizeResource(array $params)
    {
        $namespace = $params['namespace'];
        $resource = $params['resource'];
        $opts = $params['opts'];
        $param = (new AuthorizeResourceParam())->withNamespace($namespace)->withOpts($opts)->withResource($resource);
        $res = $this->client->request($param->createRequest());
        return $res;
    }

    public function listResourcePermissions()
    {
        # code...
    }

    public function listResources(array $options)
    {
        $api = "/api/v2/resources";
        $param = http_build_query([
            'namespaceCode' => $options['namespace'] ?? $options['namespaceCode'],
            'type' => $options['type'],
            'limit' => $options['limit'] ?? 10,
            'page' => $options['page'] ?? 1,
        ]);
        $data = $this->client->httpGet($api.$param);
        return $data;
    }

    public function getApplicationAccessPolicies(array $options)
    {
        if (!$options['appId']) {
            throw new Error('请传入 appId');
        }
        $options = (object) $options;
        $appId = $options->appId;
        $page = $options->page ?? 1;
        $limit = $options->limit ?? 10;
        $res = $this->client->httpGet("/api/v2/applications/$appId/authorization/records?page=$page&limit=$limit");
        return $res;
    }

    public function enableApplicationAccessPolicy(array $options)
    {
        if (!$options['appId']) {
            throw new Error('请传入 appId');
        }
        if (!$options['targetType']) {
            throw new Error(
                '请传入主体类型，可选值为 USER、ROLE、ORG、GROUP，含义为用户、角色、组织机构节点、用户分组'
            );
        }
        if (!$options['targetIdentifiers']) {
            throw new Error('请传入主体 id');
        }
        extract($options, EXTR_OVERWRITE);
        $data = [
            'targetType' => $targetType,
            'namespace' => $namespace ?? null,
            'targetIdentifiers' => $targetIdentifiers,
            'inheritByChildren' => $inheritByChildren ?? null,
        ];
        $this->client->httpPost("/api/v2/applications/$appId/authorization/enable-effect", $data);
        return (object) [
            'code' => 200,
            'message' => '启用应用访问控制策略成功',
        ];
    }

    public function disableApplicationAccessPolicy(array $options)
    {
        if (!$options['appId']) {
            throw new Error('请传入 appId');
        }
        if (!$options['targetType']) {
            throw new Error(
                '请传入主体类型，可选值为 USER、ROLE、ORG、GROUP，含义为用户、角色、组织机构节点、用户分组'
            );
        }
        if (!$options['targetIdentifiers']) {
            throw new Error('请传入主体 id');
        }
        extract($options, EXTR_OVERWRITE);
        $data = [
            'targetType' => $targetType,
            'namespace' => $namespace ?? null,
            'targetIdentifiers' => $targetIdentifiers,
            'inheritByChildren' => $inheritByChildren ?? null,
        ];

        $this->client->httpPost("/api/v2/applications/$appId/authorization/disable-effect", $data);
        $_ = new stdClass();
        $_->code = 200;
        $_->message = '停用应用访问控制策略成功';
        return $_;
    }

    public function deleteApplicationAccessPolicy(array $options)
    {
        if (!$options['appId']) {
            throw new Error('请传入 appId');
        }
        if (!$options['targetType']) {
            throw new Error(
                '请传入主体类型，可选值为 USER、ROLE、ORG、GROUP，含义为用户、角色、组织机构节点、用户分组'
            );
        }
        if (!$options['targetIdentifiers']) {
            throw new Error('请传入主体 id');
        }
        extract($options, EXTR_OVERWRITE);
        $data = [
            'targetType' => $targetType,
            'namespace' => $namespace ?? null,
            'targetIdentifiers' => $targetIdentifiers,
            'inheritByChildren' => $inheritByChildren ?? null,
        ];

        $this->client->httpPost("/api/v2/applications/$appId/authorization/revoke", $data);
        $_ = new stdClass();
        $_->code = 200;
        $_->message = '删除应用访问控制策略成功';
        return $_;
    }

    public function allowAccessApplication(array $options)
    {
        if (!$options['appId']) {
            throw new Error('请传入 appId');
        }
        if (!$options['targetType']) {
            throw new Error(
                '请传入主体类型，可选值为 USER、ROLE、ORG、GROUP，含义为用户、角色、组织机构节点、用户分组'
            );
        }
        if (!$options['targetIdentifiers']) {
            throw new Error('请传入主体 id');
        }
        extract($options, EXTR_OVERWRITE);
        $data = [
            'targetType' => $targetType,
            'namespace' => $namespace ?? null,
            'targetIdentifiers' => $targetIdentifiers,
            'inheritByChildren' => $inheritByChildren ?? null,
        ];

        $this->client->httpPost("/api/v2/applications/$appId/authorization/allow", $data);
        $_ = new stdClass();
        $_->code = 200;
        $_->message = '允许主体访问应用的策略配置已生效';
        return $_;
    }

    public function denyAccessApplication(array $options)
    {
        if (!$options['appId']) {
            throw new Error('请传入 appId');
        }
        if (!$options['targetType']) {
            throw new Error(
                '请传入主体类型，可选值为 USER、ROLE、ORG、GROUP，含义为用户、角色、组织机构节点、用户分组'
            );
        }
        if (!$options['targetIdentifiers']) {
            throw new Error('请传入主体 id');
        }
        extract($options, EXTR_OVERWRITE);
        $data = [
            'targetType' => $targetType,
            'namespace' => $namespace ?? null,
            'targetIdentifiers' => $targetIdentifiers,
            'inheritByChildren' => $inheritByChildren ?? null,
        ];

        $this->client->httpPost("/api/v2/applications/$appId/authorization/deny", $data);
        $_ = new stdClass();
        $_->code = 200;
        $_->message = '拒绝主体访问应用的策略配置已生效';
        return $_;
    }

    public function updateDefaultApplicationAccessPolicy(array $options)
    {
        if (!$options['appId']) {
            throw new Error('请传入 appId');
        }
        if (!$options['defaultStrategy']) {
            throw new Error(
                '请传入默认策略，可选值为 ALLOW_ALL、DENY_ALL，含义为默认允许所有用户登录应用、默认拒绝所有用户登录应用'
            );
        }
        $appId = $options['appId'];
        $data = new stdClass();
        $data->permissionStrategy = new stdClass();
        $data->permissionStrategy->defaultStrategy = $options['defaultStrategy'];
        $res = $this->client->httpPost("/api/v2/applications/$appId", $data);
        return $res;
    }
}
