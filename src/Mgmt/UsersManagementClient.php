<?php


namespace Authing\Mgmt;

use Authing\Types\AddPolicyAssignmentsParam;
use Authing\Types\AssignRoleParam;
use Authing\Types\CheckLoginStatusParam;
use Authing\Types\CommonMessage;
use Authing\Types\CreateUserInput;
use Authing\Types\CreateUserParam;
use Authing\Types\DeleteUserParam;
use Authing\Types\DeleteUsersParam;
use Authing\Types\GetUserRolesParam;
use Authing\Types\JWTTokenStatus;
use Authing\Types\PaginatedPolicyAssignments;
use Authing\Types\PaginatedRoles;
use Authing\Types\PaginatedUsers;
use Authing\Types\PolicyAssignmentsParam;
use Authing\Types\PolicyAssignmentTargetType;
use Authing\Types\RefreshToken;
use Authing\Types\RefreshTokenParam;
use Authing\Types\RemovePolicyAssignmentsParam;
use Authing\Types\RevokeRoleParam;
use Authing\Types\SearchUserParam;
use Authing\Types\UpdateUserInput;
use Authing\Types\UpdateUserParam;
use Authing\Types\User;
use Authing\Types\UserBatchParam;
use Authing\Types\UserParam;
use Authing\Types\UsersParam;
use Exception;

class UsersManagementClient
{
    /**
     * @var ManagementClient
     */
    private $client;

    /**
     * UsersManagementClient constructor.
     * @param $client ManagementClient
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * 获取用户列表
     *
     * @param $page int 分页页数
     * @param $limit int 分页大小
     * @return PaginatedUsers
     * @throws Exception
     */
    public function paginate($page = 1, $limit = 10)
    {
        $param = (new UsersParam())->withPage($page)->withLimit($limit);
        return $this->client->request($param->createRequest());
    }

    /**
     * 创建用户
     *
     * @param $input CreateUserInput
     * @return User
     * @throws Exception
     */
    public function create($input)
    {
        $param = new CreateUserParam($input);
        return $this->client->request($param->createRequest());
    }

    /**
     * 更新用户信息
     *
     * @param $userId string 用户 ID
     * @param $input UpdateUserInput
     * @return User
     * @throws Exception
     */
    public function update($userId, $input)
    {
        if ($input->password) {
            $input->password = $this->client->encrypt($input->password);
        }

        $param = (new UpdateUserParam($input))->withId($userId);
        return $this->client->request($param->createRequest());
    }

    /**
     * 获取用户信息
     *
     * @param $userId string 用户 ID
     * @return User
     * @throws Exception
     */
    public function detail($userId)
    {
        $param = (new UserParam())->withId($userId);
        return $this->client->request($param->createRequest());
    }

    /**
     * 模糊搜索用户信息
     *
     * @param $query string 关键字
     * @param $page int 分页页数
     * @param $limit int 分页大小
     * @return PaginatedUsers
     * @throws Exception
     */
    public function search($query, $page = 1, $limit = 10)
    {
        $param = (new SearchUserParam($query))->withPage($page)->withLimit($limit);
        return $this->client->request($param->createRequest());
    }

    /**
     * 通过用户 ID 批量获取用户信息
     *
     * @param $userIds string[] 用户 ID 列表
     * @return User[]
     * @throws Exception
     */
    public function batch($userIds)
    {
        $param = new UserBatchParam($userIds);
        return $this->client->request($param->createRequest());
    }

    /**
     * 删除用户
     *
     * @param $userId string 用户 ID
     * @return CommonMessage
     * @throws Exception
     */
    public function delete($userId)
    {
        $param = new DeleteUserParam($userId);
        return $this->client->request($param->createRequest());
    }

    /**
     * @param $userIds string[] 用户 ID 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function deleteMany($userIds)
    {
        $param = new DeleteUsersParam($userIds);
        return $this->client->request($param->createRequest());
    }

    /**
     * @param $token string 用户的 access token
     * @return JWTTokenStatus
     * @throws Exception
     */
    public function checkLoginStatus($token)
    {
        $param = (new CheckLoginStatusParam())->withToken($token);
        return $this->client->request($param->createRequest());
    }

    /**
     * 获取用户的角色列表
     *
     * @param $userId
     * @return PaginatedRoles
     * @throws Exception
     */
    public function listRoles($userId)
    {
        $param = new GetUserRolesParam($userId);
        return $this->client->request($param->createRequest())->roles;
    }

    /**
     * @param $userId string 用户 ID
     * @param $roles string[] 角色 code 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function addRoles($userId, $roles)
    {
        $param = (new AssignRoleParam())->withUserIds([$userId])->withRoleCodes($roles);
        return $this->client->request($param->createRequest());
    }

    /**
     * @param $userId string 用户 ID
     * @param $roles string[] 角色 code 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function removeRoles($userId, $roles)
    {
        $param = (new RevokeRoleParam())->withUserIds([$userId])->withRoleCodes($roles);
        return $this->client->request($param->createRequest());
    }

    /**
     * @param $userId string 用户 ID
     * @return RefreshToken
     * @throws Exception
     */
    public function refreshToken($userId)
    {
        $param = (new RefreshTokenParam())->withId($userId);
        return $this->client->request($param->createRequest());
    }

    /**
     * @param $userId string  用户 ID
     * @param $page int 分页页数
     * @param $limit int 分页大小
     * @return PaginatedPolicyAssignments
     * @throws Exception
     */
    public function listPolicies($userId, $page = 1, $limit = 10)
    {
        $param = (new PolicyAssignmentsParam())
            ->withPage($page)
            ->withLimit($limit)
            ->withTargetIdentifier($userId)
            // php don't have enum
            ->withTargetType(PolicyAssignmentTargetType::USER);
        return $this->client->request($param->createRequest());
    }

    /**
     * @param $userId string 用户 ID
     * @param $policies string[] 策略 code 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function addPolicies($userId, $policies)
    {
        $param = (new AddPolicyAssignmentsParam($policies, PolicyAssignmentTargetType::USER))->withTargetIdentifiers([$userId]);
        return $this->client->request($param->createRequest());
    }

    /**
     * @param $userId string 用户 ID
     * @param $policies string[] 策略 code 列表
     * @return CommonMessage
     * @throws Exception
     */
    public function removePolicies($userId, $policies)
    {
        $param = (new RemovePolicyAssignmentsParam($policies, PolicyAssignmentTargetType::USER))->withTargetIdentifiers([$userId]);
        return $this->client->request($param->createRequest());
    }
}