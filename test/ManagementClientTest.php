<?php

/**
 * 命名空间
 */

namespace Test;

use Authing\ManagementClient;

/**
 * ManagementClientTest
 */

class ManagementClientTest extends \PHPUnit\Framework\TestCase
{
    
    public $accessKey = array("id" => "xxx", "secret" => "xxx");
    public $management;

    public function setUp()
    {
        $this->management = new ManagementClient($this->accessKey["id"], $this->accessKey["secret"]);
    }

    public function tearDown()
    {
        $this->management = null;
    }

    public function testGetManagementToken()
    {
        $option = array();
        $varRes = $this->management->getManagementToken($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetUser()
    {
        $option = array();
        $varRes = $this->management->getUser($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetUserBatch()
    {
        $option = array();
        $varRes = $this->management->getUserBatch($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testListUsers()
    {
        $option = array();
        $varRes = $this->management->listUsers($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetUserIdentities()
    {
        $option = array();
        $varRes = $this->management->getUserIdentities($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetUserRoles()
    {
        $option = array();
        $varRes = $this->management->getUserRoles($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetPrincipalAuthenticationInfo()
    {
        $option = array();
        $varRes = $this->management->getPrincipalAuthenticationInfo($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testResetPrincipalAuthenticationInfo()
    {
        $option = array();
        $varRes = $this->management->resetPrincipalAuthenticationInfo($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetUserDepartments()
    {
        $option = array();
        $varRes = $this->management->getUserDepartments($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testSetUserDepartment()
    {
        $option = array();
        $varRes = $this->management->setUserDepartment($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetUserGroups()
    {
        $option = array();
        $varRes = $this->management->getUserGroups($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testDeleteUserBatch()
    {
        $option = array();
        $varRes = $this->management->deleteUserBatch($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetUserMfaInfo()
    {
        $option = array();
        $varRes = $this->management->getUserMfaInfo($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testListArchivedUsers()
    {
        $option = array();
        $varRes = $this->management->listArchivedUsers($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testKickUsers()
    {
        $option = array();
        $varRes = $this->management->kickUsers($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testIsUserExists()
    {
        $option = array();
        $varRes = $this->management->isUserExists($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testCreateUser()
    {
        $option = array();
        $varRes = $this->management->createUser($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testCreateUserBatch()
    {
        $option = array();
        $varRes = $this->management->createUserBatch($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testUpdateUser()
    {
        $option = array();
        $varRes = $this->management->updateUser($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetUserAccessibleApps()
    {
        $option = array();
        $varRes = $this->management->getUserAccessibleApps($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetUserAuthorizedApps()
    {
        $option = array();
        $varRes = $this->management->getUserAuthorizedApps($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testHasAnyRole()
    {
        $option = array();
        $varRes = $this->management->hasAnyRole($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetUserLoginHistory()
    {
        $option = array();
        $varRes = $this->management->getUserLoginHistory($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetUserLoggedInApps()
    {
        $option = array();
        $varRes = $this->management->getUserLoggedInApps($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetUserAuthorizedResources()
    {
        $option = array();
        $varRes = $this->management->getUserAuthorizedResources($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetGroup()
    {
        $option = array();
        $varRes = $this->management->getGroup($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetGroupList()
    {
        $option = array();
        $varRes = $this->management->getGroupList($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testCreateGroup()
    {
        $option = array();
        $varRes = $this->management->createGroup($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testCreateGroupBatch()
    {
        $option = array();
        $varRes = $this->management->createGroupBatch($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testUpdateGroup()
    {
        $option = array();
        $varRes = $this->management->updateGroup($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testDeleteGroups()
    {
        $option = array();
        $varRes = $this->management->deleteGroups($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testAddGroupMembers()
    {
        $option = array();
        $varRes = $this->management->addGroupMembers($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testRemoveGroupMembers()
    {
        $option = array();
        $varRes = $this->management->removeGroupMembers($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testListGroupMembers()
    {
        $option = array();
        $varRes = $this->management->listGroupMembers($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetGroupAuthorizedResources()
    {
        $option = array();
        $varRes = $this->management->getGroupAuthorizedResources($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetRole()
    {
        $option = array();
        $varRes = $this->management->getRole($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testAssignRole()
    {
        $option = array();
        $varRes = $this->management->assignRole($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testAssignRoleBatch()
    {
        $option = array();
        $varRes = $this->management->assignRoleBatch($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testRevokeRole()
    {
        $option = array();
        $varRes = $this->management->revokeRole($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testRevokeRoleBatch()
    {
        $option = array();
        $varRes = $this->management->revokeRoleBatch($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetRoleAuthorizedResources()
    {
        $option = array();
        $varRes = $this->management->getRoleAuthorizedResources($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testListRoleMembers()
    {
        $option = array();
        $varRes = $this->management->listRoleMembers($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testListRoleDepartments()
    {
        $option = array();
        $varRes = $this->management->listRoleDepartments($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testCreateRole()
    {
        $option = array();
        $varRes = $this->management->createRole($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testListRoles()
    {
        $option = array();
        $varRes = $this->management->listRoles($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testDeleteRolesBatch()
    {
        $option = array();
        $varRes = $this->management->deleteRolesBatch($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testCreateRolesBatch()
    {
        $option = array();
        $varRes = $this->management->createRolesBatch($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testUpdateRole()
    {
        $option = array();
        $varRes = $this->management->updateRole($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testListOrganizations()
    {
        $option = array();
        $varRes = $this->management->listOrganizations($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testCreateOrganization()
    {
        $option = array();
        $varRes = $this->management->createOrganization($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testUpdateOrganization()
    {
        $option = array();
        $varRes = $this->management->updateOrganization($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testDeleteOrganization()
    {
        $option = array();
        $varRes = $this->management->deleteOrganization($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetDepartment()
    {
        $option = array();
        $varRes = $this->management->getDepartment($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testCreateDepartment()
    {
        $option = array();
        $varRes = $this->management->createDepartment($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testUpdateDepartment()
    {
        $option = array();
        $varRes = $this->management->updateDepartment($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testDeleteDepartment()
    {
        $option = array();
        $varRes = $this->management->deleteDepartment($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testSearchDepartments()
    {
        $option = array();
        $varRes = $this->management->searchDepartments($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testListChildrenDepartments()
    {
        $option = array();
        $varRes = $this->management->listChildrenDepartments($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testListDepartmentMembers()
    {
        $option = array();
        $varRes = $this->management->listDepartmentMembers($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testListDepartmentMemberIds()
    {
        $option = array();
        $varRes = $this->management->listDepartmentMemberIds($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testAddDepartmentMembers()
    {
        $option = array();
        $varRes = $this->management->addDepartmentMembers($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testRemoveDepartmentMembers()
    {
        $option = array();
        $varRes = $this->management->removeDepartmentMembers($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetParentDepartment()
    {
        $option = array();
        $varRes = $this->management->getParentDepartment($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testListExtIdp()
    {
        $option = array();
        $varRes = $this->management->listExtIdp($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetExtIdp()
    {
        $option = array();
        $varRes = $this->management->getExtIdp($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testCreateExtIdp()
    {
        $option = array();
        $varRes = $this->management->createExtIdp($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testUpdateExtIdp()
    {
        $option = array();
        $varRes = $this->management->updateExtIdp($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testDeleteExtIdp()
    {
        $option = array();
        $varRes = $this->management->deleteExtIdp($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testCreateExtIdpConn()
    {
        $option = array();
        $varRes = $this->management->createExtIdpConn($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testUpdateExtIdpConn()
    {
        $option = array();
        $varRes = $this->management->updateExtIdpConn($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testDeleteExtIdpConn()
    {
        $option = array();
        $varRes = $this->management->deleteExtIdpConn($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testChangeConnState()
    {
        $option = array();
        $varRes = $this->management->changeConnState($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetCustomFields()
    {
        $option = array();
        $varRes = $this->management->getCustomFields($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testSetCustomFields()
    {
        $option = array();
        $varRes = $this->management->setCustomFields($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testSetCustomData()
    {
        $option = array();
        $varRes = $this->management->setCustomData($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetCustomData()
    {
        $option = array();
        $varRes = $this->management->getCustomData($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testCreateResource()
    {
        $option = array();
        $varRes = $this->management->createResource($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testCreateResourcesBatch()
    {
        $option = array();
        $varRes = $this->management->createResourcesBatch($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetResource()
    {
        $option = array();
        $varRes = $this->management->getResource($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetResourcesBatch()
    {
        $option = array();
        $varRes = $this->management->getResourcesBatch($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testListResources()
    {
        $option = array();
        $varRes = $this->management->listResources($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testUpdateResource()
    {
        $option = array();
        $varRes = $this->management->updateResource($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testDeleteResource()
    {
        $option = array();
        $varRes = $this->management->deleteResource($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testDeleteResourcesBatch()
    {
        $option = array();
        $varRes = $this->management->deleteResourcesBatch($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testCreateNamespace()
    {
        $option = array();
        $varRes = $this->management->createNamespace($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testCreateNamespacesBatch()
    {
        $option = array();
        $varRes = $this->management->createNamespacesBatch($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetNamespace()
    {
        $option = array();
        $varRes = $this->management->getNamespace($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetNamespacesBatch()
    {
        $option = array();
        $varRes = $this->management->getNamespacesBatch($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testUpdateNamespace()
    {
        $option = array();
        $varRes = $this->management->updateNamespace($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testDeleteNamespace()
    {
        $option = array();
        $varRes = $this->management->deleteNamespace($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testDeleteNamespacesBatch()
    {
        $option = array();
        $varRes = $this->management->deleteNamespacesBatch($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testAuthorizeResources()
    {
        $option = array();
        $varRes = $this->management->authorizeResources($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    public function testGetTargetAuthorizedResources()
    {
        $option = array();
        $varRes = $this->management->getTargetAuthorizedResources($option);
        $this->assertEquals(200, $varRes["statusCode"]);
    }

    
}