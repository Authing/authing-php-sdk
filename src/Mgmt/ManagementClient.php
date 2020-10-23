<?php


namespace Authing\Mgmt;

use Authing\BaseClient;
use Authing\InvalidArgumentException;
use Authing\Types\AccessTokenParam;
use Authing\Types\AccessTokenRes;
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
        parent::__construct($userPoolId);
        $this->secret = $secret;
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
}