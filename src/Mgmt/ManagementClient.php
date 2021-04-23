<?php


namespace Authing\Mgmt;

use Exception;
use Authing\BaseClient;
use Authing\Types\UserParam;
use Authing\Types\AccessTokenRes;
use Authing\Types\SendEmailParam;
use Authing\Types\AccessTokenParam;
use Authing\InvalidArgumentException;
use Authing\Mgmt\OrgManagementClient;
use Authing\Mgmt\UdfManagementClient;
use Authing\Mgmt\UsersManagementClient;
use Authing\Mgmt\Acl\AclManagementClient;
use Authing\Mgmt\PoliciesManagementClient;
use Authing\Mgmt\UserpoolManagementClient;
use Authing\Mgmt\WhitelistManagementClient;
use Authing\Mgmt\Roles\RolesManagementClient;
use Authing\Mgmt\ApplicationsManagementClient;
use Authing\Mgmt\Groups\GroupsManagementClient;
use Authing\Types\ListUserAuthorizedResourcesParam;


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
    public function __construct($config)
    {
        $params = func_get_args();
        parent::__construct(...$params);
        $this->requestToken();
        // parent::__construct($userPoolId);
        // $this->secret = $secret;
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
        // $param = new AccessTokenParam($this->userPoolId, $this->options->secret);
        $res = parent::requestToken();
        // $this->accessToken = $res->accessToken;
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
    public function acls() {
        return new AclManagementClient($this);
    }

    /**
     * 获取自定义字段管理模块
     *
     * @return UdfManagementClient
     */
    public function udfs() {
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
    public function userpools() {
        return new UserpoolManagementClient($this);
    }

    /**
     * 获取白名单管理模块
     *
     * @return WhitelistManagementClient
     */
    public function whitelists() {
        return new WhitelistManagementClient($this);
    }

    /**
     * @return GroupsManagementClient
     */
    public function groups() {
        return new GroupsManagementClient($this);
    }

    /**
     * @return ApplicationsManagementClient
     */
    public function applications() {
        return new ApplicationsManagementClient($this);
    }

    /**
     * @return OrgManagementClient
     */
    public function orgs() {
        return new OrgManagementClient($this);
    }

    /**
     * @return NamespaceManagementClient
     */
    public function namespaces() {
        return new NamespaceManagementClient($this);
    }

    /**
     * @return UserActionManagementClient
     */
    public function userActions() {
        return new UserActionManagementClient($this);
    }

    /**
     * @return StatisticsManagementClient
     */
    public function statistics() {
        return new StatisticsManagementClient($this);
    }


    public function sendEmail(string $email, string $scene)
    {
        $param = new SendEmailParam($email, $scene);
        $data = $this->request($param->createRequest())->sendEmail;       
        return $data;
    }

    public function checkLoginStatus(string $token, array $options = [])
    {
        $fetchUserDetail = $options['fetchUserDetail'] ?? false;
        if (!$token) return null;
        $userData = null;
        $tokenIllegal = false;
        try {
            $userData = Utils::getTokenPlayloadData($token);
        } catch (\Throwable $th) {
            $tokenIllegal = true;
        }
        if ($tokenIllegal) {
            return null;
        }
        if (!$fetchUserDetail) {
            return $userData;
        } else {
            $userId = $userData->id;
            if ($userId) {
                $user = $this->users()->detail($userId);
                return $user;
            }
        }
    }

    public function isPasswordValid(string $password)
    {
        return $this->httpPost('/api/v2/password/check', [
            'password' => $password
        ]);
    }
}