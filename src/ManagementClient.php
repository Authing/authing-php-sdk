<?php


namespace Authing;

use Exception;

require_once __DIR__ . '/CodeGen.php';

class ManagementClient extends BaseClient
{
    /**
     * @var string
     */
    private $secret;

    public function __construct($userPoolId, $secret)
    {
        parent::__construct($userPoolId);
        $this->$secret = $secret;
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
}