<?php


namespace Authing\Mgmt;

use Authing\BaseClient;
use Authing\InvalidArgumentException;
use Authing\Types\AccessTokenParam;
use Authing\Types\AccessTokenRes;
use Authing\Types\UserParam;
use Authing\Types\ListUserAuthorizedResourcesParam;
use Exception;

class ManagementClient extends BaseClient
{
    /**
     * @var string
     */
    private $secret;

    /**
     * ManagementClient constructor.
     * @param $userPoolId string
     * @param $secret string
     * @throws InvalidArgumentException
     */
    public function __construct($userPoolId, $secret)
    {
        // parent::__construct(function ($ops) {
        //     $ops->userPoolId = $userPoolId;
        // });
        parent::__construct($userPoolId);
        $this->secret = $secret;
    }

    /**
     * 获取当前用户
     *
     * @return User
     * @throws Exception
     */
    function getCurrentUser() {
        $param = new UserParam();
        $user = $this->request($param->createRequest());
        $this->setAccessToken($this->accessToken); 
        $this->user = $user;
        return $user;
    }

    /**
     * 获取 access token
     *
     * @return AccessTokenRes
     * @throws Exception
     */
    public function requestToken() {
        $param = new AccessTokenParam($this->userPoolId, $this->secret);
        $res = $this->request($param->createRequest());
        $this->accessToken = $res->accessToken;
        return $res;
    }

    /**
     * 获取用户管理模块
     *
     * @return UsersManagementClient
     */
    public function users() {
        return new UsersManagementClient($this);
    }

    /**
     * 获取角色管理模块
     *
     * @return RolesManagementClient
     */
    public function roles() {
        return new RolesManagementClient($this);
    }

    /**
     * 获取权限控制模块
     *
     * @return AclManagementClient
     */
    public function acl() {
        return new AclManagementClient($this);
    }

    /**
     * 获取自定义字段管理模块
     *
     * @return UdfManagementClient
     */
    public function udf() {
        return new UdfManagementClient($this);
    }

    /**
     * 获取策略管理模块
     *
     * @return PoliciesManagementClient
     */
    public function policies() {
        return new PoliciesManagementClient($this);
    }

    /**
     * 获取用户池管理模块
     *
     * @return UserpoolManagementClient
     */
    public function userpool() {
        return new UserpoolManagementClient($this);
    }

    /**
     * 获取白名单管理模块
     *
     * @return WhitelistManagementClient
     */
    public function whitelist() {
        return new WhitelistManagementClient($this);
    }

    /**
     * @return GroupsManagementClient
     */
    public function groups() {
        return new GroupsManagementClient($this);
    }

    function listAuthorizedResources($userId, $namespace) {
        $user = $this->getCurrentUser();
        if (!$user) {
            throw new Exception("未登录，请登录");
        }
        if (!isset($namespace) && !is_string($namespace) && !isset($userId) && !is_string($userId)) {
            throw new Exception("userId namespace 为必填");
        }
        $param = (new ListUserAuthorizedResourcesParam($userId))->withNamespace($namespace);
        $resUser = $this->request($param->createRequest());
        if ($resUser) {
            return $resUser->authorizedResources;
        } else {
            throw new Exception("用户不存在");
        }
    }
}