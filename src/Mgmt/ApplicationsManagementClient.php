<?php

namespace Authing\Mgmt;

use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\Acl\AclManagementClient;
use Authing\Mgmt\AgreementManagementClient;
use Authing\Mgmt\Roles\RolesManagementClient;

class ApplicationsManagementClient
{
    /**
     * @var mixed[]
     */
    private $options;

    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * @var AclManagementClient
     */
    private $acl;

    /**
     * @var RolesManagementClient
     */
    private $roles;

    /**
     * @var AgreementManagementClient
     */
    private $agreements;

    /**
     * @param \Authing\Mgmt\ManagementClient $client
     */
    public function __construct($client)
    {
        $this->client = $client;
        $this->acl = new AclManagementClient($client);
        $this->roles = new RolesManagementClient($client);
        $this->agreements = new AgreementManagementClient($client);
    }

    public function list(array $params = [])
    {
        $page = isset($params['page']) ? $params['page'] : 1;
        $limit = isset($params['limit']) ? $params['limit'] : 10;
        $data = $this->client->httpGet("/api/v2/applications?page=$page&limit=$limit");
        return $data;
    }

    /**
     * @param string $id
     */
    public function findById($id)
    {
        $data = $this->client->httpGet("/api/v2/applications/$id");
        return $data;
    }

    public function create(array $options)
    {
        $res = $this->client->httpPost('/api/v2/applications', (object)$options);
        return $res;
    }

    /**
     * @param string $appId
     */
    public function delete($appId)
    {
        $this->client->httpDelete("/api/v2/applications/$appId");
        return true;
    }

    /**
     * @param string $appId
     * @param int $page
     * @param int $limit
     */
    public function activeUsers($appId, $page = 1, $limit = 10)
    {
        $res = $this->client->httpGet("/api/v2/applications/$appId/active-users?page=$page&limit=$limit");
        return $res;
    }

    /**
     * @param string $appId
     */
    public function refreshApplicationSecret($appId)
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

    /**
     * @param string $code
     */
    public function updateResource($code, array $options)
    {
        $args = func_get_args();
        return $this->acl->updateResource(...$args);
    }

    /**
     * @param string $code
     * @param string $namespaceCode
     */
    public function deleteResource($code, $namespaceCode)
    {
        $args = func_get_args();
        return $this->acl->deleteResource(...$args);
    }

    public function getAccessPolicies(array $options)
    {
        $args = func_get_args();
        return $this->acl->getAccessPolicies(...$args);
    }

    public function enableAccessPolicy(array $options)
    {
        $args = func_get_args();
        return $this->acl->enableAccessPolicy(...$args);
    }

    public function disableAccessPolicy(array $options)
    {
        $args = func_get_args();
        return $this->acl->disableAccessPolicy(...$args);
    }

    public function deleteAccessPolicy(array $options)
    {
        $args = func_get_args();
        return $this->acl->deleteAccessPolicy(...$args);
    }

    public function allowAccess(array $options)
    {
        $args = func_get_args();
        return $this->acl->allowAccess(...$args);
    }

    public function denyAccess(array $options)
    {
        $args = func_get_args();
        return $this->acl->denyAccess(...$args);
    }

    public function updateDefaultAccessPolicy(array $options)
    {
        $args = func_get_args();
        return $this->acl->updateDefaultAccessPolicy(...$args);
    }

    public function createRole($code, $description = null, $parentCode = null)
    {
        $args = func_get_args();
        return $this->roles->create(...$args);
    }

    public function findRole($code)
    {
        $args = func_get_args();
        return $this->roles->detail(...$args);
    }

    public function updateRole($code, $description = null, $newCode = null)
    {
        $args = func_get_args();
        return $this->roles->update(...$args);
    }

    public function deleteRole($code)
    {
        $args = func_get_args();
        return $this->roles->delete(...$args);
    }

    public function getRoles($page = 1, $limit = 10)
    {
        $args = func_get_args();
        return $this->roles->paginate(...$args);
    }

    public function getUsersByRoleCode($code)
    {
        $args = func_get_args();
        return $this->roles->listUsers(...$args);
    }

    public function addUsersToRole($code, $userIds)
    {
        $args = func_get_args();
        return $this->roles->addUsers(...$args);
    }

    public function removeUsersFromRole($code, $userIds)
    {
        $args = func_get_args();
        return $this->roles->removeUsers(...$args);
    }

    public function listAuthorizedResourcesByRole($roleCode, $namespace, $opts = [])
    {
        $args = func_get_args();
        return $this->roles->listAuthorizedResources(...$args);
    }

    /**
     * @param string $appId
     */
    public function listAgreement($appId)
    {
        $args = func_get_args();
        return $this->agreements->list(...$args);
    }

    /**
     * @param string $appId
     */
    public function createAgreement($appId, array $agreement)
    {
        $args = func_get_args();
        return $this->agreements->create(...$args);
    }

    /**
     * @param string $appId
     * @param int $agreementId
     */
    public function deleteAgreement($appId, $agreementId)
    {
        $args = func_get_args();
        return $this->agreements->delete(...$args);
    }

    /**
     * @param string $appId
     * @param int $agreementId
     */
    public function modifyAgreement($appId, $agreementId, array $updates)
    {
        $args = func_get_args();
        return $this->agreements->modify(...$args);
    }

    /**
     * @param string $appId
     */
    public function sortAgreement($appId, array $order)
    {
         $args = func_get_args();
        return $this->agreements->sort(...$args);
    }
}
