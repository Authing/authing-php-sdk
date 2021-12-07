<?php

namespace Authing\Mgmt;

include_once '..\..\src\Mgmt\AclManagementClient.php';
include_once '..\..\src\Mgmt\AgreementManagementClient.php';
include_once '..\..\src\Mgmt\RolesManagementClient.php';

use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\Acl\AclManagementClient;
use Authing\Mgmt\AgreementManagementClient;
use Authing\Mgmt\Roles\RolesManagementClient;

class ApplicationsManagementClient
{
    private array $options;

    /**
     * @var ManagementClient
     */
    private ManagementClient $client;

    /**
     * @var AclManagementClient
     */
    private AclManagementClient $acl;

    /**
     * @var RolesManagementClient
     */
    private RolesManagementClient $roles;

    /**
     * @var AgreementManagementClient
     */
    private AgreementManagementClient $agreements;

    public function __construct(ManagementClient $client)
    {
        $this->client = $client;
        $this->acl = new AclManagementClient($client);
        $this->roles = new RolesManagementClient($client);
        $this->agreements = new AgreementManagementClient($client);
    }

    public function list(array $params = [])
    {
        $page = $params['page'] ?? 1;
        $limit = $params['limit'] ?? 10;
        $data = $this->client->httpGet("/api/v2/applications?page=$page&limit=$limit");
        return $data;
    }

    public function findById(string $id)
    {
        $data = $this->client->httpGet("/api/v2/applications/$id");
        return $data;
    }

    public function create(array $options)
    {
        $res = $this->client->httpPost('/api/v2/applications', (object)$options);
        return $res;
    }

    public function delete(string $appId)
    {
        $this->client->httpDelete("/api/v2/applications/$appId");
        return true;
    }

    public function activeUsers(string $appId, int $page = 1, int $limit = 10)
    {
        $res = $this->client->httpGet("/api/v2/applications/$appId/active-users?page=$page&limit=$limit");
        return $res;
    }

    public function refreshApplicationSecret(string $appId)
    {
        $res = $this->client->httpPatch("/api/v2/application/$appId/refresh-secret");
        return $res;
    }

    public function listResources(array $options)
    {
        $args = func_get_args();
        return $this->acl->getResources(...$args);
    }

    public function createResource(array $options)
    {
        $args = func_get_args();
        return $this->acl->createResource(...$args);
    }

    public function createResourceBatch(string $appId, array $resources)
    {
        foreach ($resources as &$resource) {
            $resource['namespace'] = $appId;
        }
        unset($resource);
        return $this->acl->createResourceBatch($resources);
    }

//    public function updateResource(string $code, array $options)
//    {
//        $args = func_get_args();
//        return $this->acl->updateResource(...$args);
//    }
    public function updateResource(string $appId, array $options)
    {
        $options['namespace'] = $appId;
        return $this->acl->updateResource($options['code'], $options);
    }

    public function deleteResource(string $code, string $namespaceCode)
    {
        $args = func_get_args();
        return $this->acl->deleteResource(...$args);
    }

    public function getAccessPolicies(string $appId, array $options = [])
    {
        $options['appId'] = $appId;
        return $this->acl->getAccessPolicies($options);
    }

    public function enableAccessPolicy(string $appId, array $options)
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->enableAccessPolicy($options);
    }

    public function disableAccessPolicy(string $appId, array $options)
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->disableAccessPolicy($options);
    }

    public function deleteAccessPolicy(string $appId, array $options)
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->deleteAccessPolicy($options);
    }

//    public function enableAccessPolicy(array $options)
//    {
//        $args = func_get_args();
//        return $this->acl->enableAccessPolicy(...$args);
//    }
//
//    public function disableAccessPolicy(array $options)
//    {
//        $args = func_get_args();
//        return $this->acl->disableAccessPolicy(...$args);
//    }
//
//    public function deleteAccessPolicy(array $options)
//    {
//        $args = func_get_args();
//        return $this->acl->deleteAccessPolicy(...$args);
//    }

    public function allowAccess(string $appId, array $options)
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->allowAccess($options);
    }

    public function denyAccess(string $appId, array $options)
    {
        $options['appId'] = $appId;
        $options['namespace'] = $appId;
        return $this->acl->denyAccess($options);
    }

//    public function allowAccess(array $options)
//    {
//        $args = func_get_args();
//        return $this->acl->allowAccess(...$args);
//    }
//
//    public function denyAccess(array $options)
//    {
//        $args = func_get_args();
//        return $this->acl->denyAccess(...$args);
//    }

//    public function updateDefaultAccessPolicy(array $options)
//    {
//        $args = func_get_args();
//        return $this->acl->updateDefaultAccessPolicy(...$args);
//    }
    public function updateDefaultAccessPolicy(string $appId, string $defaultStrategy)
    {
        $options = [
            'appId' => $appId,
            'defaultStrategy' => $defaultStrategy
        ];
        return $this->acl->updateDefaultAccessPolicy($options);
    }

    public function createRole(string $appId, array $options)
    {
        return $this->roles->create($options['code'], $options['description'], $appId);
    }

//    public function findRole($code)
//    {
//        $args = func_get_args();
//        return $this->roles->detail(...$args);
//    }
    public function findRole(string $appId, string $code)
    {
        return $this->roles->detail($code, $appId);
    }

//    public function updateRole($code, $description = null, $newCode = null)
//    {
//        $args = func_get_args();
//        return $this->roles->update(...$args);
//    }
    public function updateRole(string $appId, array $options)
    {
        $options['namespace'] = $appId;
        return $this->roles->update($options['code'], $options);
    }

//    public function deleteRole($code)
//    {
//        $args = func_get_args();
//        return $this->roles->delete(...$args);
//    }
    public function deleteRole(string $appId, string $code)
    {
        return $this->roles->delete($code, $appId);
    }

    public function deleteRoles(string $appId, array $codes)
    {
        return $this->roles->deleteMany($codes, $appId);
    }



//    public function getRoles($page = 1, $limit = 10)
//    {
//        $args = func_get_args();
//        return $this->roles->paginate(...$args);
//    }
    public function getRoles(string $appId, array $options = [])
    {
        $options['namespace'] = $appId;
        return $this->roles->paginate($options);
    }

//    public function getUsersByRoleCode($code)
//    {
//        $args = func_get_args();
//        return $this->roles->listUsers(...$args);
//    }
    public function getUsersByRoleCode(string $appId, string $code)
    {
        return $this->roles->listUsers($code, [
            'namespace' => $appId
        ]);
    }

//    public function addUsersToRole($code, $userIds)
//    {
//        $args = func_get_args();
//        return $this->roles->addUsers(...$args);
//    }
    public function addUsersToRole(string $appId, string $code, array $userIds)
    {
        return $this->roles->addUsers($code, $userIds, $appId);
    }

//    public function removeUsersFromRole($code, $userIds)
//    {
//        $args = func_get_args();
//        return $this->roles->removeUsers(...$args);
//    }

    public function removeUsersFromRole(string $appId, string $code, array $userIds)
    {
        return $this->roles->removeUsers($code, $userIds, $appId);
    }

//    public function listAuthorizedResourcesByRole($roleCode, $namespace, $opts = [])
//    {
//        $args = func_get_args();
//        return $this->roles->listAuthorizedResources(...$args);
//    }
    public function listAuthorizedResourcesByRole(string $appId, string $code, string $resourceType = '')
    {
        return $this->roles->listAuthorizedResources($code, $appId, $resourceType);
    }

    public function listAgreement(string $appId)
    {
        $args = func_get_args();
        return $this->agreements->list(...$args);
    }

    public function createAgreement(string $appId, array $agreement)
    {
        $args = func_get_args();
        return $this->agreements->create(...$args);
    }

    public function deleteAgreement(string $appId, int $agreementId)
    {
        $args = func_get_args();
        return $this->agreements->delete(...$args);
    }

    public function modifyAgreement(string $appId, int $agreementId, array $updates)
    {
        $args = func_get_args();
        return $this->agreements->modify(...$args);
    }

    public function sortAgreement(string $appId, array $order)
    {
         $args = func_get_args();
        return $this->agreements->sort(...$args);
    }
}
