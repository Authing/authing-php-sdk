<?php

/**
 * 命名空间
 */

namespace Authing;

/**
 * 导入
 */

require_once "util/Tool.php";

/**
 * ManagementClient
 */

class ManagementClient
{
    //域名
    public $_url;
    //AccessKey
    public $_accessKey;
    //AccessToken
    public $_accessToken;
    //AccessToken超时时间
    public $_accessTokenTime;
    //用户池ID
    public $_userPoolID;

    /**
     * 构造函数
     */
    public function __construct($accessKeyId, $accessKeySecret, $host = "https://api.authing.cn")
    {
        $this->_url = $host;
        $this->_accessKey = array("id" => $accessKeyId, "secret" => $accessKeySecret);
        $this->_userPoolID = $accessKeyId;
        $this->_getAccessToken($this->_accessKey["id"],  $this->_accessKey["secret"]);
    }

    /**
     * 构造请求
     */
    private function _requests($parMethod, $parGet = [], $parPost = [])
    {
        //过期
        if (!empty($this->_accessTokenTime) and time() >= $this->_accessTokenTime) {
            $this->_accessToken = null;
            $this->_accessTokenTime = null;
            $this->_getAccessToken($this->_accessKey["id"],  $this->_accessKey["secret"]);
        }
        //处理
        if ($parGet != []) $parGet = Util\Tool::formatData($parGet);
        if ($parPost != []) $parPost = Util\Tool::formatData($parPost);
        //头部
        $varHeader = array(
            "Authorization" => "Bearer " . $this->_accessToken,
            "Content-Type" => "application/json",
            "x-authing-userpool-id" => $this->_userPoolID,
            "x-authing-request-from" => "php-sdk",
            "x-authing-sdk-version" => "php:5.0.0",
        );
        //请求
        $varReq = Util\Tool::request($this->_url . $parMethod, $parGet, $parPost, $varHeader);
        return $varReq;
    }

    /**
     * 获取 Access Token
     */
    private function _getAccessToken($accessKeyId,  $accessKeySecret)
    {
        $tempAccessToken = $this->getManagementToken(array("accessKeyId" => $accessKeyId, "accessKeySecret" => $accessKeySecret))["data"];
        $this->_accessToken = $tempAccessToken["access_token"];
        $this->_accessTokenTime = time() + $tempAccessToken["expires_in"];
    }

    /**
     * 获取 Management API Token
     * @summary 获取 Management API Token
     * @description 获取 Management API Token
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string accessKeySecret 必须，AccessKey Secret: 如果是以用户池全局 AK/SK 初始化，为用户池密钥；如果是以协作管理员的 AK/SK 初始化，为协作管理员的 SK。
     * @param string accessKeyId 必须，AccessKey ID: 如果是以用户池全局 AK/SK 初始化，为用户池 ID；如果是以协作管理员的 AK/SK 初始化，为协作管理员的 AccessKey ID。
     * @return GetManagementTokenRespDto
     */
    public function getManagementToken($option = array())
    {
        // 组装请求
        $varPost = array(
            "accessKeySecret" => Util\Tool::getSet($option["accessKeySecret"]),
            "accessKeyId" => Util\Tool::getSet($option["accessKeyId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-management-token", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户信息
     * @summary 获取用户信息
     * @description 通过 id、username、email、phone、email、externalId 获取用户详情
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param boolean withIdentities 可选，是否获取 identities，默认 false
     * @param boolean withDepartmentIds 可选，是否获取部门 ID 列表，默认 false
     * @param string phone 可选，手机号
     * @param string email 可选，邮箱
     * @param string username 可选，用户名
     * @param string externalId 可选，原系统 ID
     * @return UserSingleRespDto
     */
    public function getUser($option = array())
    {
        // 组装请求
        $varGet = array(
            "withCustomData" => Util\Tool::getSet($option["withCustomData"]),
            "withIdentities" => Util\Tool::getSet($option["withIdentities"]),
            "withDepartmentIds" => Util\Tool::getSet($option["withDepartmentIds"]),
            "userId" => Util\Tool::getSet($option["userId"]),
            "phone" => Util\Tool::getSet($option["phone"]),
            "email" => Util\Tool::getSet($option["email"]),
            "username" => Util\Tool::getSet($option["username"]),
            "externalId" => Util\Tool::getSet($option["externalId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-user", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 批量获取用户信息
     * @summary 批量获取用户信息
     * @description 根据用户 id 批量获取用户信息
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> userIds 必须，用户 ID 数组
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param boolean withIdentities 可选，是否获取 identities，默认 false
     * @param boolean withDepartmentIds 可选，是否获取部门 ID 列表，默认 false
     * @return UserListRespDto
     */
    public function getUserBatch($option = array())
    {
        // 组装请求
        $varGet = array(
            "withCustomData" => Util\Tool::getSet($option["withCustomData"]),
            "withIdentities" => Util\Tool::getSet($option["withIdentities"]),
            "withDepartmentIds" => Util\Tool::getSet($option["withDepartmentIds"]),
            "userIds" => Util\Tool::getSet($option["userIds"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-user-batch", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户列表
     * @summary 获取用户列表
     * @description 获取用户列表接口，支持分页
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param 'Suspended' | 'Resigned' | 'Activated' | 'Archived' status 可选，账户当前状态
     * @param number updatedAtStart 可选，用户创建、修改开始时间，为精确到秒的 UNIX 时间戳；支持获取从某一段时间之后的增量数据。
     * @param number updatedAtEnd 可选，用户创建、修改终止时间，为精确到秒的 UNIX 时间戳；支持获取某一段时间内的增量数据。默认为当前时间。
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param boolean withIdentities 可选，是否获取 identities，默认 false
     * @param boolean withDepartmentIds 可选，是否获取部门 ID 列表，默认 false
     * @return UserPaginatedRespDto
     */
    public function listUsers($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getSet($option["page"]),
            "limit" => Util\Tool::getSet($option["limit"]),
            "status" => Util\Tool::getSet($option["status"]),
            "updatedAtStart" => Util\Tool::getSet($option["updatedAtStart"]),
            "updatedAtEnd" => Util\Tool::getSet($option["updatedAtEnd"]),
            "withCustomData" => Util\Tool::getSet($option["withCustomData"]),
            "withIdentities" => Util\Tool::getSet($option["withIdentities"]),
            "withDepartmentIds" => Util\Tool::getSet($option["withDepartmentIds"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/list-users", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户的外部身份源
     * @summary 获取用户的外部身份源
     * @description 获取用户的外部身份源
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @return IdentityListRespDto
     */
    public function getUserIdentities($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getSet($option["userId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-user-identities", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户角色列表
     * @summary 获取用户角色列表
     * @description 获取用户角色列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @param string namespace 可选，所属权限分组的 code
     * @return RolePaginatedRespDto
     */
    public function getUserRoles($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getSet($option["userId"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-user-roles", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户实名认证信息
     * @summary 获取用户实名认证信息
     * @description 获取用户实名认证信息
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @return PrincipalAuthenticationInfoPaginatedRespDto
     */
    public function getUserPrincipalAuthenticationInfo($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getSet($option["userId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-user-principal-authentication-info", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 删除用户实名认证信息
     * @summary 删除用户实名认证信息
     * @description 删除用户实名认证信息
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @return IsSuccessRespDto
     */
    public function resetUserPrincipalAuthenticationInfo($option = array())
    {
        // 组装请求
        $varPost = array(
            "userId" => Util\Tool::getSet($option["userId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/reset-user-principal-authentication-info", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户部门列表
     * @summary 获取用户部门列表
     * @description 获取用户部门列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param 'DepartmentCreatedAt' | 'JoinDepartmentAt' | 'DepartmentName' | 'DepartmemtCode' sortBy 必须，排序依据，默认 'JoinDepartmentAt'
     * @param 'Asc' | 'Desc' orderBy 必须，增序还是倒序，默认 'Desc'
     * @return UserDepartmentPaginatedRespDto
     */
    public function getUserDepartments($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getSet($option["userId"]),
            "page" => Util\Tool::getSet($option["page"]),
            "limit" => Util\Tool::getSet($option["limit"]),
            "withCustomData" => Util\Tool::getSet($option["withCustomData"]),
            "sortBy" => Util\Tool::getSet($option["sortBy"]),
            "orderBy" => Util\Tool::getSet($option["orderBy"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-user-departments", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 设置用户所在部门
     * @summary 设置用户所在部门
     * @description 设置用户所在部门
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<SetUserDepartmentDto> departments 必须，部门信息
     * @param string userId 必须，用户 ID
     * @return IsSuccessRespDto
     */
    public function setUserDepartment($option = array())
    {
        // 组装请求
        $varPost = array(
            "departments" => Util\Tool::getSet($option["departments"]),
            "userId" => Util\Tool::getSet($option["userId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/set-user-departments", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户分组列表
     * @summary 获取用户分组列表
     * @description 获取用户分组列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @return GroupPaginatedRespDto
     */
    public function getUserGroups($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getSet($option["userId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-user-groups", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 删除用户
     * @summary 删除用户
     * @description 删除用户（支持批量删除）
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> userIds 必须，用户 ID 列表
     * @return IsSuccessRespDto
     */
    public function deleteUsersBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "userIds" => Util\Tool::getSet($option["userIds"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/delete-users-batch", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户 MFA 绑定信息
     * @summary 获取用户 MFA 绑定信息
     * @description 获取用户 MFA 绑定信息
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @return UserMfaSingleRespDto
     */
    public function getUserMfaInfo($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getSet($option["userId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-user-mfa-info", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取已归档的用户列表
     * @summary 获取已归档的用户列表
     * @description 获取已归档的用户列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param number startAt 可选，开始时间，为精确到秒的 UNIX 时间戳，默认不指定。
     * @return ListArchivedUsersSingleRespDto
     */
    public function listArchivedUsers($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getSet($option["page"]),
            "limit" => Util\Tool::getSet($option["limit"]),
            "startAt" => Util\Tool::getSet($option["startAt"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/list-archived-users", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 强制下线用户
     * @summary 强制下线用户
     * @description 强制下线用户
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> appIds 必须，APP ID 集合
     * @param string userId 必须，用户 ID
     * @return IsSuccessRespDto
     */
    public function kickUsers($option = array())
    {
        // 组装请求
        $varPost = array(
            "appIds" => Util\Tool::getSet($option["appIds"]),
            "userId" => Util\Tool::getSet($option["userId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/kick-users", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 判断用户是否存在
     * @summary 判断用户是否存在
     * @description 根据条件判断用户是否存在
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string username 可选，用户名，用户池内唯一，默认 null
     * @param string email 可选，邮箱，默认 null
     * @param string phone 可选，手机号，默认 null
     * @param string externalId 可选，第三方外部 ID，默认 null
     * @return IsUserExistsRespDto
     */
    public function isUserExists($option = array())
    {
        // 组装请求
        $varPost = array(
            "username" => Util\Tool::getSet($option["username"]),
            "email" => Util\Tool::getSet($option["email"]),
            "phone" => Util\Tool::getSet($option["phone"]),
            "externalId" => Util\Tool::getSet($option["externalId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/is-user-exists", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 创建用户
     * @summary 创建用户
     * @description 创建用户，邮箱、手机号、用户名必须包含其中一个
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param 'Suspended' | 'Resigned' | 'Activated' | 'Archived' status 可选，账户当前状态，默认 null
     * @param string email 可选，邮箱，默认 null
     * @param 'sm2' | 'rsa' | 'none' passwordEncryptType 可选，加密类型，默认 null
     * @param string phone 可选，手机号，默认 null
     * @param string phoneCountryCode 可选，手机区号，默认 null
     * @param string username 可选，用户名，用户池内唯一，默认 null
     * @param string name 可选，用户真实名称，不具备唯一性，默认 null
     * @param string nickname 可选，昵称，默认 null
     * @param string photo 可选，头像链接，默认 null
     * @param 'M' | 'W' | 'U' gender 可选，性别，默认 null
     * @param boolean emailVerified 可选，邮箱是否验证，默认 null
     * @param boolean phoneVerified 可选，手机号是否验证，默认 null
     * @param string birthdate 可选，出生日期，默认 null
     * @param string country 可选，所在国家，默认 null
     * @param string province 可选，所在省份，默认 null
     * @param string city 可选，所在城市，默认 null
     * @param string address 可选，所处地址，默认 null
     * @param string streetAddress 可选，所处街道地址，默认 null
     * @param string postalCode 可选，邮政编码号，默认 null
     * @param string externalId 可选，第三方外部 ID，默认 null
     * @param Array<string> departmentIds 可选，用户所属部门 ID 列表，默认 null
     * @param any customData 可选，自定义数据，传入的对象中的 key 必须先在用户池定义相关自定义字段，默认 null
     * @param string password 可选，密码。可选加密方式进行加密，默认为未加密，默认 null
     * @param Array<string> tenantIds 可选，租户 ID，默认 null
     * @param Array<CreateIdentityDto> identities 可选，第三方身份源（建议调用绑定接口进行绑定），默认 null
     * @param CreateUserOptionsDto options 可选，附加选项，默认 null
     * @return UserSingleRespDto
     */
    public function createUser($option = array())
    {
        // 组装请求
        $varPost = array(
            "status" => Util\Tool::getSet($option["status"]),
            "email" => Util\Tool::getSet($option["email"]),
            "passwordEncryptType" => Util\Tool::getSet($option["passwordEncryptType"]),
            "phone" => Util\Tool::getSet($option["phone"]),
            "phoneCountryCode" => Util\Tool::getSet($option["phoneCountryCode"]),
            "username" => Util\Tool::getSet($option["username"]),
            "name" => Util\Tool::getSet($option["name"]),
            "nickname" => Util\Tool::getSet($option["nickname"]),
            "photo" => Util\Tool::getSet($option["photo"]),
            "gender" => Util\Tool::getSet($option["gender"]),
            "emailVerified" => Util\Tool::getSet($option["emailVerified"]),
            "phoneVerified" => Util\Tool::getSet($option["phoneVerified"]),
            "birthdate" => Util\Tool::getSet($option["birthdate"]),
            "country" => Util\Tool::getSet($option["country"]),
            "province" => Util\Tool::getSet($option["province"]),
            "city" => Util\Tool::getSet($option["city"]),
            "address" => Util\Tool::getSet($option["address"]),
            "streetAddress" => Util\Tool::getSet($option["streetAddress"]),
            "postalCode" => Util\Tool::getSet($option["postalCode"]),
            "externalId" => Util\Tool::getSet($option["externalId"]),
            "departmentIds" => Util\Tool::getSet($option["departmentIds"]),
            "customData" => Util\Tool::getSet($option["customData"]),
            "password" => Util\Tool::getSet($option["password"]),
            "tenantIds" => Util\Tool::getSet($option["tenantIds"]),
            "identities" => Util\Tool::getSet($option["identities"]),
            "options" => Util\Tool::getSet($option["options"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/create-user", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 批量创建用户
     * @summary 批量创建用户
     * @description 此接口将以管理员身份批量创建用户，不需要进行手机号验证码检验等安全检测。用户的手机号、邮箱、用户名、externalId 用户池内唯一。
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<CreateUserInfoDto> list 必须，批量用户
     * @param CreateUserOptionsDto options 可选，附加选项，默认 null
     * @return UserListRespDto
     */
    public function createUserBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getSet($option["list"]),
            "options" => Util\Tool::getSet($option["options"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/create-users-batch", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 修改用户资料
     * @summary 修改用户资料
     * @description 修改用户资料
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @param string phoneCountryCode 可选，手机区号，默认 null
     * @param string name 可选，用户真实名称，不具备唯一性，默认 null
     * @param string nickname 可选，昵称，默认 null
     * @param string photo 可选，头像链接，默认 null
     * @param string externalId 可选，第三方外部 ID，默认 null
     * @param 'Suspended' | 'Resigned' | 'Activated' | 'Archived' status 可选，账户当前状态，默认 null
     * @param boolean emailVerified 可选，邮箱是否验证，默认 null
     * @param boolean phoneVerified 可选，手机号是否验证，默认 null
     * @param string birthdate 可选，出生日期，默认 null
     * @param string country 可选，所在国家，默认 null
     * @param string province 可选，所在省份，默认 null
     * @param string city 可选，所在城市，默认 null
     * @param string address 可选，所处地址，默认 null
     * @param string streetAddress 可选，所处街道地址，默认 null
     * @param string postalCode 可选，邮政编码号，默认 null
     * @param 'M' | 'W' | 'U' gender 可选，性别，默认 null
     * @param string username 可选，用户名，用户池内唯一，默认 null
     * @param 'sm2' | 'rsa' | 'none' passwordEncryptType 可选，加密类型，默认 null
     * @param string email 可选，邮箱，默认 null
     * @param string phone 可选，手机号，默认 null
     * @param string password 可选，密码。可选加密方式进行加密，默认为未加密，默认 null
     * @param any customData 可选，自定义数据，传入的对象中的 key 必须先在用户池定义相关自定义字段，默认 null
     * @return UserSingleRespDto
     */
    public function updateUser($option = array())
    {
        // 组装请求
        $varPost = array(
            "userId" => Util\Tool::getSet($option["userId"]),
            "phoneCountryCode" => Util\Tool::getSet($option["phoneCountryCode"]),
            "name" => Util\Tool::getSet($option["name"]),
            "nickname" => Util\Tool::getSet($option["nickname"]),
            "photo" => Util\Tool::getSet($option["photo"]),
            "externalId" => Util\Tool::getSet($option["externalId"]),
            "status" => Util\Tool::getSet($option["status"]),
            "emailVerified" => Util\Tool::getSet($option["emailVerified"]),
            "phoneVerified" => Util\Tool::getSet($option["phoneVerified"]),
            "birthdate" => Util\Tool::getSet($option["birthdate"]),
            "country" => Util\Tool::getSet($option["country"]),
            "province" => Util\Tool::getSet($option["province"]),
            "city" => Util\Tool::getSet($option["city"]),
            "address" => Util\Tool::getSet($option["address"]),
            "streetAddress" => Util\Tool::getSet($option["streetAddress"]),
            "postalCode" => Util\Tool::getSet($option["postalCode"]),
            "gender" => Util\Tool::getSet($option["gender"]),
            "username" => Util\Tool::getSet($option["username"]),
            "passwordEncryptType" => Util\Tool::getSet($option["passwordEncryptType"]),
            "email" => Util\Tool::getSet($option["email"]),
            "phone" => Util\Tool::getSet($option["phone"]),
            "password" => Util\Tool::getSet($option["password"]),
            "customData" => Util\Tool::getSet($option["customData"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/update-user", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户可访问应用
     * @summary 获取用户可访问应用
     * @description 获取用户可访问应用
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @return AppListRespDto
     */
    public function getUserAccessibleApps($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getSet($option["userId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-user-accessible-apps", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户授权的应用
     * @summary 获取用户授权的应用
     * @description 获取用户授权的应用
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @return AppListRespDto
     */
    public function getUserAuthorizedApps($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getSet($option["userId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-user-authorized-apps", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 判断用户是否有某个角色
     * @summary 判断用户是否有某个角色
     * @description 判断用户是否有某个角色，支持同时传入多个角色进行判断
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<HasRoleRolesDto> roles 必须，角色列表
     * @param string userId 必须，用户 ID
     * @return HasAnyRoleRespDto
     */
    public function hasAnyRole($option = array())
    {
        // 组装请求
        $varPost = array(
            "roles" => Util\Tool::getSet($option["roles"]),
            "userId" => Util\Tool::getSet($option["userId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/has-any-role", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户的登录历史记录
     * @summary 获取用户的登录历史记录
     * @description 获取用户登录历史记录
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @param string appId 可选，应用 ID
     * @param string clientIp 可选，客户端 IP
     * @param number start 可选，开始时间戳（毫秒）
     * @param number end 可选，结束时间戳（毫秒）
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @return UserLoginHistoryPaginatedRespDto
     */
    public function getUserLoginHistory($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getSet($option["userId"]),
            "appId" => Util\Tool::getSet($option["appId"]),
            "clientIp" => Util\Tool::getSet($option["clientIp"]),
            "start" => Util\Tool::getSet($option["start"]),
            "end" => Util\Tool::getSet($option["end"]),
            "page" => Util\Tool::getSet($option["page"]),
            "limit" => Util\Tool::getSet($option["limit"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-user-login-history", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户曾经登录过的应用
     * @summary 获取用户曾经登录过的应用
     * @description 获取用户曾经登录过的应用
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @return UserLoggedInAppsListRespDto
     */
    public function getUserLoggedInApps($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getSet($option["userId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-user-loggedin-apps", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户曾经登录过的身份源
     * @summary 获取用户曾经登录过的身份源
     * @description 获取用户曾经登录过的身份源
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @return UserLoggedInIdentitiesRespDto
     */
    public function getUserLoggedInIdentities($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getSet($option["userId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-user-logged-in-identities", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户被授权的所有资源
     * @summary 获取用户被授权的所有资源
     * @description 获取用户被授权的所有资源，用户被授权的资源是用户自身被授予、通过分组继承、通过角色继承、通过组织机构继承的集合
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @param string namespace 可选，所属权限分组的 code
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' resourceType 可选，资源类型
     * @return AuthorizedResourcePaginatedRespDto
     */
    public function getUserAuthorizedResources($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getSet($option["userId"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
            "resourceType" => Util\Tool::getSet($option["resourceType"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-user-authorized-resources", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取分组详情
     * @summary 获取分组详情
     * @description 获取分组详情，通过 code 唯一标志用户池中的一个分组
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，分组 code
     * @return GroupSingleRespDto
     */
    public function getGroup($option = array())
    {
        // 组装请求
        $varGet = array(
            "code" => Util\Tool::getSet($option["code"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-group", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取分组列表
     * @summary 获取分组列表
     * @description 获取分组列表接口，支持分页
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @return GroupPaginatedRespDto
     */
    public function listGroups($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getSet($option["page"]),
            "limit" => Util\Tool::getSet($option["limit"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/list-groups", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 创建分组
     * @summary 创建分组
     * @description 创建分组，一个分组必须包含一个用户池全局唯一的标志符（code），此标志符必须为一个合法的英文标志符，如 developers；以及分组名称
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string description 必须，分组描述
     * @param string name 必须，分组名称
     * @param string code 必须，分组 code
     * @return GroupSingleRespDto
     */
    public function createGroup($option = array())
    {
        // 组装请求
        $varPost = array(
            "description" => Util\Tool::getSet($option["description"]),
            "name" => Util\Tool::getSet($option["name"]),
            "code" => Util\Tool::getSet($option["code"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/create-group", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 批量创建分组
     * @summary 批量创建分组
     * @description 批量创建分组
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<CreateGroupReqDto> list 必须，批量分组
     * @return GroupListRespDto
     */
    public function createGroupsBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getSet($option["list"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/create-groups-batch", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 修改分组
     * @summary 修改分组
     * @description 修改分组，通过 code 唯一标志用户池中的一个分组。你可以修改此分组的 code
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string description 必须，分组描述
     * @param string name 必须，分组名称
     * @param string code 必须，分组 code
     * @param string newCode 可选，分组新的 code，默认 null
     * @return GroupSingleRespDto
     */
    public function updateGroup($option = array())
    {
        // 组装请求
        $varPost = array(
            "description" => Util\Tool::getSet($option["description"]),
            "name" => Util\Tool::getSet($option["name"]),
            "code" => Util\Tool::getSet($option["code"]),
            "newCode" => Util\Tool::getSet($option["newCode"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/update-group", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 批量删除分组
     * @summary 批量删除分组
     * @description 批量删除分组
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> codeList 必须，分组 code 列表
     * @return IsSuccessRespDto
     */
    public function deleteGroupsBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "codeList" => Util\Tool::getSet($option["codeList"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/delete-groups-batch", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 添加分组成员
     * @summary 添加分组成员
     * @description 添加分组成员
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> userIds 必须，用户 ID 数组
     * @param string code 必须，分组 code
     * @return IsSuccessRespDto
     */
    public function addGroupMembers($option = array())
    {
        // 组装请求
        $varPost = array(
            "userIds" => Util\Tool::getSet($option["userIds"]),
            "code" => Util\Tool::getSet($option["code"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/add-group-members", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 批量移除分组成员
     * @summary 批量移除分组成员
     * @description 批量移除分组成员
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> userIds 必须，用户 ID 数组
     * @param string code 必须，分组 code
     * @return IsSuccessRespDto
     */
    public function removeGroupMembers($option = array())
    {
        // 组装请求
        $varPost = array(
            "userIds" => Util\Tool::getSet($option["userIds"]),
            "code" => Util\Tool::getSet($option["code"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/remove-group-members", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取分组成员列表
     * @summary 获取分组成员列表
     * @description 获取分组成员列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，分组 code
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param boolean withIdentities 可选，是否获取 identities，默认 false
     * @param boolean withDepartmentIds 可选，是否获取部门 ID 列表，默认 false
     * @return UserPaginatedRespDto
     */
    public function listGroupMembers($option = array())
    {
        // 组装请求
        $varGet = array(
            "code" => Util\Tool::getSet($option["code"]),
            "page" => Util\Tool::getSet($option["page"]),
            "limit" => Util\Tool::getSet($option["limit"]),
            "withCustomData" => Util\Tool::getSet($option["withCustomData"]),
            "withIdentities" => Util\Tool::getSet($option["withIdentities"]),
            "withDepartmentIds" => Util\Tool::getSet($option["withDepartmentIds"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/list-group-members", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取分组被授权的资源列表
     * @summary 获取分组被授权的资源列表
     * @description 获取分组被授权的资源列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，分组 code
     * @param string namespace 可选，所属权限分组的 code
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' resourceType 可选，资源类型
     * @return AuthorizedResourceListRespDto
     */
    public function getGroupAuthorizedResources($option = array())
    {
        // 组装请求
        $varGet = array(
            "code" => Util\Tool::getSet($option["code"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
            "resourceType" => Util\Tool::getSet($option["resourceType"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-group-authorized-resources", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取角色详情
     * @summary 获取角色详情
     * @description 获取角色详情
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组内角色的唯一标识符
     * @param string namespace 可选，所属权限分组的 code
     * @return RoleSingleRespDto
     */
    public function getRole($option = array())
    {
        // 组装请求
        $varGet = array(
            "code" => Util\Tool::getSet($option["code"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-role", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 分配角色
     * @summary 分配角色
     * @description 分配角色，被分配者可以是用户，可以是部门
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<TargetDto> targets 必须，目标对象
     * @param string code 必须，权限分组内角色的唯一标识符
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsSuccessRespDto
     */
    public function assignRole($option = array())
    {
        // 组装请求
        $varPost = array(
            "targets" => Util\Tool::getSet($option["targets"]),
            "code" => Util\Tool::getSet($option["code"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/assign-role", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 移除分配的角色
     * @summary 移除分配的角色
     * @description 移除分配的角色，被分配者可以是用户，可以是部门
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<TargetDto> targets 必须，移除角色的目标
     * @param string code 必须，权限分组内角色的唯一标识符
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsSuccessRespDto
     */
    public function revokeRole($option = array())
    {
        // 组装请求
        $varPost = array(
            "targets" => Util\Tool::getSet($option["targets"]),
            "code" => Util\Tool::getSet($option["code"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/revoke-role", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 角色被授权的资源列表
     * @summary 角色被授权的资源列表
     * @description 角色被授权的资源列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组内角色的唯一标识符
     * @param string namespace 可选，所属权限分组的 code
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' resourceType 可选，资源类型
     * @return RoleAuthorizedResourcePaginatedRespDto
     */
    public function getRoleAuthorizedResources($option = array())
    {
        // 组装请求
        $varGet = array(
            "code" => Util\Tool::getSet($option["code"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
            "resourceType" => Util\Tool::getSet($option["resourceType"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-role-authorized-resources", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取角色成员列表
     * @summary 获取角色成员列表
     * @description 获取角色成员列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组内角色的唯一标识符
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param boolean withIdentities 可选，是否获取 identities，默认 false
     * @param boolean withDepartmentIds 可选，是否获取部门 ID 列表，默认 false
     * @param string namespace 可选，所属权限分组的 code
     * @return UserPaginatedRespDto
     */
    public function listRoleMembers($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getSet($option["page"]),
            "limit" => Util\Tool::getSet($option["limit"]),
            "withCustomData" => Util\Tool::getSet($option["withCustomData"]),
            "withIdentities" => Util\Tool::getSet($option["withIdentities"]),
            "withDepartmentIds" => Util\Tool::getSet($option["withDepartmentIds"]),
            "code" => Util\Tool::getSet($option["code"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/list-role-members", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取角色的部门列表
     * @summary 获取角色的部门列表
     * @description 获取角色的部门列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组内角色的唯一标识符
     * @param string namespace 可选，所属权限分组的 code
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @return RoleDepartmentListPaginatedRespDto
     */
    public function listRoleDepartments($option = array())
    {
        // 组装请求
        $varGet = array(
            "code" => Util\Tool::getSet($option["code"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
            "page" => Util\Tool::getSet($option["page"]),
            "limit" => Util\Tool::getSet($option["limit"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/list-role-departments", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 创建角色
     * @summary 创建角色
     * @description 创建角色，可以指定不同的权限分组
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组内角色的唯一标识符
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @param string description 可选，角色描述，默认 null
     * @return RoleSingleRespDto
     */
    public function createRole($option = array())
    {
        // 组装请求
        $varPost = array(
            "code" => Util\Tool::getSet($option["code"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
            "description" => Util\Tool::getSet($option["description"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/create-role", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取角色列表
     * @summary 获取角色列表
     * @description 获取角色列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string namespace 可选，所属权限分组的 code，默认 'default'
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @return RolePaginatedRespDto
     */
    public function listRoles($option = array())
    {
        // 组装请求
        $varGet = array(
            "namespace" => Util\Tool::getSet($option["namespace"]),
            "page" => Util\Tool::getSet($option["page"]),
            "limit" => Util\Tool::getSet($option["limit"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/list-roles", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * （批量）删除角色
     * @summary （批量）删除角色
     * @description 删除角色
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> codeList 必须，角色 code 集合
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsSuccessRespDto
     */
    public function deleteRolesBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "codeList" => Util\Tool::getSet($option["codeList"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/delete-roles-batch", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 批量创建角色
     * @summary 批量创建角色
     * @description 批量创建角色
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<RoleListItem> list 必须，角色列表
     * @return IsSuccessRespDto
     */
    public function createRolesBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getSet($option["list"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/create-roles-batch", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 修改角色
     * @summary 修改角色
     * @description 修改角色
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string newCode 必须，角色新的权限分组内唯一识别码
     * @param string code 必须，权限分组内角色的唯一标识符
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @param string description 可选，角色描述，默认 null
     * @return IsSuccessRespDto
     */
    public function updateRole($option = array())
    {
        // 组装请求
        $varPost = array(
            "newCode" => Util\Tool::getSet($option["newCode"]),
            "code" => Util\Tool::getSet($option["code"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
            "description" => Util\Tool::getSet($option["description"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/update-role", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取顶层组织机构列表
     * @summary 获取顶层组织机构列表
     * @description 获取顶层组织机构列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param boolean fetchAll 可选，拉取所有，默认 false
     * @return OrganizationPaginatedRespDto
     */
    public function listOrganizations($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getSet($option["page"]),
            "limit" => Util\Tool::getSet($option["limit"]),
            "fetchAll" => Util\Tool::getSet($option["fetchAll"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/list-organizations", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 创建顶层组织机构
     * @summary 创建顶层组织机构
     * @description 创建组织机构，会创建一个只有一个节点的组织机构
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationName 必须，组织名称
     * @param string organizationCode 必须，组织 code
     * @param string description 可选，组织描述信息，默认 null
     * @param string openDepartmentId 可选，根节点自定义 ID，默认 null
     * @param OrganizationNameI18nDto i18n 可选，多语言设置，默认 null
     * @return OrganizationSingleRespDto
     */
    public function createOrganization($option = array())
    {
        // 组装请求
        $varPost = array(
            "organizationName" => Util\Tool::getSet($option["organizationName"]),
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
            "description" => Util\Tool::getSet($option["description"]),
            "openDepartmentId" => Util\Tool::getSet($option["openDepartmentId"]),
            "i18n" => Util\Tool::getSet($option["i18n"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/create-organization", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 修改顶层组织机构
     * @summary 修改顶层组织机构
     * @description 修改顶层组织机构
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @param string description 可选，部门描述，默认 null
     * @param string openDepartmentId 可选，根节点自定义 ID，默认 null
     * @param Array<string> leaderUserIds 可选，部门负责人 ID，默认 null
     * @param OrganizationNameI18nDto i18n 可选，多语言设置，默认 null
     * @param string organizationNewCode 可选，新组织 code，默认 null
     * @param string organizationName 可选，组织名称，默认 null
     * @return OrganizationSingleRespDto
     */
    public function updateOrganization($option = array())
    {
        // 组装请求
        $varPost = array(
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
            "description" => Util\Tool::getSet($option["description"]),
            "openDepartmentId" => Util\Tool::getSet($option["openDepartmentId"]),
            "leaderUserIds" => Util\Tool::getSet($option["leaderUserIds"]),
            "i18n" => Util\Tool::getSet($option["i18n"]),
            "organizationNewCode" => Util\Tool::getSet($option["organizationNewCode"]),
            "organizationName" => Util\Tool::getSet($option["organizationName"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/update-organization", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 删除组织机构
     * @summary 删除组织机构
     * @description 删除组织机构树
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @return IsSuccessRespDto
     */
    public function deleteOrganization($option = array())
    {
        // 组装请求
        $varPost = array(
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/delete-organization", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取部门信息
     * @summary 获取部门信息
     * @description 获取部门信息
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 可选，部门 id，根部门传 `root`。departmentId 和 departmentCode 必传其一。
     * @param string departmentCode 可选，部门 code。departmentId 和 departmentCode 必传其一。
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 'department_id'
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @return DepartmentSingleRespDto
     */
    public function getDepartment($option = array())
    {
        // 组装请求
        $varGet = array(
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
            "departmentId" => Util\Tool::getSet($option["departmentId"]),
            "departmentCode" => Util\Tool::getSet($option["departmentCode"]),
            "departmentIdType" => Util\Tool::getSet($option["departmentIdType"]),
            "withCustomData" => Util\Tool::getSet($option["withCustomData"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-department", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 创建部门
     * @summary 创建部门
     * @description 创建部门
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @param string parentDepartmentId 必须，父部门 id
     * @param string name 必须，部门名称
     * @param string openDepartmentId 可选，自定义部门 ID，用于存储自定义的 ID，默认 null
     * @param string description 可选，部门描述，默认 null
     * @param string code 可选，部门识别码，默认 null
     * @param boolean isVirtualNode 可选，是否是虚拟部门，默认 null
     * @param I18nDto i18n 可选，多语言设置，默认 null
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的父部门 ID 的类型，默认 null
     * @return DepartmentSingleRespDto
     */
    public function createDepartment($option = array())
    {
        // 组装请求
        $varPost = array(
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
            "parentDepartmentId" => Util\Tool::getSet($option["parentDepartmentId"]),
            "name" => Util\Tool::getSet($option["name"]),
            "openDepartmentId" => Util\Tool::getSet($option["openDepartmentId"]),
            "description" => Util\Tool::getSet($option["description"]),
            "code" => Util\Tool::getSet($option["code"]),
            "isVirtualNode" => Util\Tool::getSet($option["isVirtualNode"]),
            "i18n" => Util\Tool::getSet($option["i18n"]),
            "departmentIdType" => Util\Tool::getSet($option["departmentIdType"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/create-department", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 修改部门
     * @summary 修改部门
     * @description 修改部门
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 必须，部门系统 ID（为 Authing 系统自动生成，不可修改）
     * @param Array<string> leaderUserIds 可选，部门负责人 ID，默认 null
     * @param string description 可选，部门描述，默认 null
     * @param string code 可选，部门识别码，默认 null
     * @param I18nDto i18n 可选，多语言设置，默认 null
     * @param string name 可选，部门名称，默认 null
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 null
     * @param string parentDepartmentId 可选，父部门 id，默认 null
     * @return DepartmentSingleRespDto
     */
    public function updateDepartment($option = array())
    {
        // 组装请求
        $varPost = array(
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
            "departmentId" => Util\Tool::getSet($option["departmentId"]),
            "leaderUserIds" => Util\Tool::getSet($option["leaderUserIds"]),
            "description" => Util\Tool::getSet($option["description"]),
            "code" => Util\Tool::getSet($option["code"]),
            "i18n" => Util\Tool::getSet($option["i18n"]),
            "name" => Util\Tool::getSet($option["name"]),
            "departmentIdType" => Util\Tool::getSet($option["departmentIdType"]),
            "parentDepartmentId" => Util\Tool::getSet($option["parentDepartmentId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/update-department", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 删除部门
     * @summary 删除部门
     * @description 删除部门
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 必须，部门系统 ID（为 Authing 系统自动生成，不可修改）
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 null
     * @return IsSuccessRespDto
     */
    public function deleteDepartment($option = array())
    {
        // 组装请求
        $varPost = array(
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
            "departmentId" => Util\Tool::getSet($option["departmentId"]),
            "departmentIdType" => Util\Tool::getSet($option["departmentIdType"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/delete-department", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 搜索部门
     * @summary 搜索部门
     * @description 搜索部门
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string keywords 必须，搜索关键词
     * @param string organizationCode 必须，组织 code
     * @return DepartmentListRespDto
     */
    public function searchDepartments($option = array())
    {
        // 组装请求
        $varPost = array(
            "keywords" => Util\Tool::getSet($option["keywords"]),
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/search-departments", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取子部门列表
     * @summary 获取子部门列表
     * @description 获取子部门列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string departmentId 必须，需要获取的部门 ID
     * @param string organizationCode 必须，组织 code
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 'department_id'
     * @param boolean excludeVirtualNode 可选，是否要排除虚拟组织，默认 false
     * @return DepartmentPaginatedRespDto
     */
    public function listChildrenDepartments($option = array())
    {
        // 组装请求
        $varGet = array(
            "departmentId" => Util\Tool::getSet($option["departmentId"]),
            "departmentIdType" => Util\Tool::getSet($option["departmentIdType"]),
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
            "excludeVirtualNode" => Util\Tool::getSet($option["excludeVirtualNode"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/list-children-departments", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取部门成员列表
     * @summary 获取部门成员列表
     * @description 获取部门成员列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 必须，部门 id，根部门传 `root`
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 'department_id'
     * @param boolean includeChildrenDepartments 可选，是否包含子部门的成员，默认 false
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param boolean withIdentities 可选，是否获取 identities，默认 false
     * @param boolean withDepartmentIds 可选，是否获取部门 ID 列表，默认 false
     * @param 'Default' | 'JoinDepartmentAt' sortBy 必须，排序依据，默认 'JoinDepartmentAt'
     * @param 'Asc' | 'Desc' orderBy 必须，增序还是倒序，默认 'Desc'
     * @return UserPaginatedRespDto
     */
    public function listDepartmentMembers($option = array())
    {
        // 组装请求
        $varGet = array(
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
            "departmentId" => Util\Tool::getSet($option["departmentId"]),
            "departmentIdType" => Util\Tool::getSet($option["departmentIdType"]),
            "includeChildrenDepartments" => Util\Tool::getSet($option["includeChildrenDepartments"]),
            "page" => Util\Tool::getSet($option["page"]),
            "limit" => Util\Tool::getSet($option["limit"]),
            "withCustomData" => Util\Tool::getSet($option["withCustomData"]),
            "withIdentities" => Util\Tool::getSet($option["withIdentities"]),
            "withDepartmentIds" => Util\Tool::getSet($option["withDepartmentIds"]),
            "sortBy" => Util\Tool::getSet($option["sortBy"]),
            "orderBy" => Util\Tool::getSet($option["orderBy"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/list-department-members", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取部门直属成员 ID 列表
     * @summary 获取部门直属成员 ID 列表
     * @description 获取部门直属成员 ID 列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 必须，部门 id，根部门传 `root`
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 'department_id'
     * @return UserIdListRespDto
     */
    public function listDepartmentMemberIds($option = array())
    {
        // 组装请求
        $varGet = array(
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
            "departmentId" => Util\Tool::getSet($option["departmentId"]),
            "departmentIdType" => Util\Tool::getSet($option["departmentIdType"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/list-department-member-ids", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 搜索部门下的成员
     * @summary 搜索部门下的成员
     * @description 搜索部门下的成员
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string keywords 必须，搜索关键词
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 必须，部门 id，根部门传 `root`
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 'department_id'
     * @param boolean includeChildrenDepartments 可选，是否包含子部门的成员，默认 false
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param boolean withIdentities 可选，是否获取 identities，默认 false
     * @return UserPaginatedRespDto
     */
    public function searchDepartmentMembers($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getSet($option["page"]),
            "limit" => Util\Tool::getSet($option["limit"]),
            "keywords" => Util\Tool::getSet($option["keywords"]),
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
            "departmentId" => Util\Tool::getSet($option["departmentId"]),
            "departmentIdType" => Util\Tool::getSet($option["departmentIdType"]),
            "includeChildrenDepartments" => Util\Tool::getSet($option["includeChildrenDepartments"]),
            "withCustomData" => Util\Tool::getSet($option["withCustomData"]),
            "withIdentities" => Util\Tool::getSet($option["withIdentities"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/search-department-members", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 部门下添加成员
     * @summary 部门下添加成员
     * @description 部门下添加成员
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> userIds 必须，用户 ID 列表
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 必须，部门系统 ID（为 Authing 系统自动生成，不可修改）
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 null
     * @return IsSuccessRespDto
     */
    public function addDepartmentMembers($option = array())
    {
        // 组装请求
        $varPost = array(
            "userIds" => Util\Tool::getSet($option["userIds"]),
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
            "departmentId" => Util\Tool::getSet($option["departmentId"]),
            "departmentIdType" => Util\Tool::getSet($option["departmentIdType"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/add-department-members", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 部门下删除成员
     * @summary 部门下删除成员
     * @description 部门下删除成员
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> userIds 必须，用户 ID 列表
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 必须，部门系统 ID（为 Authing 系统自动生成，不可修改）
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 null
     * @return IsSuccessRespDto
     */
    public function removeDepartmentMembers($option = array())
    {
        // 组装请求
        $varPost = array(
            "userIds" => Util\Tool::getSet($option["userIds"]),
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
            "departmentId" => Util\Tool::getSet($option["departmentId"]),
            "departmentIdType" => Util\Tool::getSet($option["departmentIdType"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/remove-department-members", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取父部门信息
     * @summary 获取父部门信息
     * @description 获取父部门信息
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 必须，部门 id
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 'department_id'
     * @return DepartmentSingleRespDto
     */
    public function getParentDepartment($option = array())
    {
        // 组装请求
        $varGet = array(
            "organizationCode" => Util\Tool::getSet($option["organizationCode"]),
            "departmentId" => Util\Tool::getSet($option["departmentId"]),
            "departmentIdType" => Util\Tool::getSet($option["departmentIdType"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-parent-department", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取身份源列表
     * @summary 获取身份源列表
     * @description 获取身份源列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string tenantId 可选，租户 ID
     * @return ExtIdpListPaginatedRespDto
     */
    public function listExtIdp($option = array())
    {
        // 组装请求
        $varGet = array(
            "tenantId" => Util\Tool::getSet($option["tenantId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/list-ext-idp", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取身份源详情
     * @summary 获取身份源详情
     * @description 获取身份源详情
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string id 必须，身份源 id
     * @param string tenantId 可选，租户 ID
     * @return ExtIdpDetailSingleRespDto
     */
    public function getExtIdp($option = array())
    {
        // 组装请求
        $varGet = array(
            "tenantId" => Util\Tool::getSet($option["tenantId"]),
            "id" => Util\Tool::getSet($option["id"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-ext-idp", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 创建身份源
     * @summary 创建身份源
     * @description 创建身份源
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param 'oidc' | 'oauth2' | 'saml' | 'ldap' | 'ad' | 'cas' | 'azure-ad' | 'wechat' | 'google' | 'qq' | 'wechatwork' | 'dingtalk' | 'weibo' | 'github' | 'alipay' | 'apple' | 'baidu' | 'lark' | 'gitlab' | 'twitter' | 'facebook' | 'slack' | 'linkedin' | 'yidun' | 'qingcloud' | 'gitee' | 'instagram' | 'welink' type 必须，身份源连接类型
     * @param string name 必须，身份源名称
     * @param string tenantId 可选，租户 ID，默认 null
     * @return ExtIdpSingleRespDto
     */
    public function createExtIdp($option = array())
    {
        // 组装请求
        $varPost = array(
            "type" => Util\Tool::getSet($option["type"]),
            "name" => Util\Tool::getSet($option["name"]),
            "tenantId" => Util\Tool::getSet($option["tenantId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/create-ext-idp", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 更新身份源配置
     * @summary 更新身份源配置
     * @description 更新身份源配置
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string id 必须，身份源 ID
     * @param string name 必须，名称
     * @return ExtIdpSingleRespDto
     */
    public function updateExtIdp($option = array())
    {
        // 组装请求
        $varPost = array(
            "id" => Util\Tool::getSet($option["id"]),
            "name" => Util\Tool::getSet($option["name"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/update-ext-idp", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 删除身份源
     * @summary 删除身份源
     * @description 删除身份源
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string id 必须，身份源 ID
     * @return IsSuccessRespDto
     */
    public function deleteExtIdp($option = array())
    {
        // 组装请求
        $varPost = array(
            "id" => Util\Tool::getSet($option["id"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/delete-ext-idp", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 在某个已有身份源下创建新连接
     * @summary 在某个已有身份源下创建新连接
     * @description 在某个已有身份源下创建新连接
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param any fields 必须，连接的自定义配置信息
     * @param string displayName 必须，连接在登录页的显示名称
     * @param string identifier 必须，身份源连接标识
     * @param 'oidc' | 'oauth' | 'saml' | 'ldap' | 'ad' | 'cas' | 'azure-ad' | 'alipay' | 'facebook' | 'twitter' | 'google' | 'wechat:pc' | 'wechat:mobile' | 'wechat:webpage-authorization' | 'wechatmp-qrcode' | 'wechat:miniprogram:default' | 'wechat:miniprogram:qrconnect' | 'wechat:miniprogram:app-launch' | 'github' | 'qq' | 'wechatwork:corp:qrconnect' | 'wechatwork:agency:qrconnect' | 'wechatwork:service-provider:qrconnect' | 'wechatwork:mobile' | 'dingtalk' | 'dingtalk:provider' | 'weibo' | 'apple' | 'apple:web' | 'baidu' | 'lark-internal' | 'lark-public' | 'gitlab' | 'linkedin' | 'slack' | 'yidun' | 'qingcloud' | 'gitee' | 'instagram' | 'welink' type 必须，身份源连接类型
     * @param string extIdpId 必须，身份源连接 id
     * @param boolean loginOnly 可选，是否只支持登录，默认 null
     * @param string logo 可选，身份源图标，默认 null
     * @return ExtIdpConnDetailSingleRespDto
     */
    public function createExtIdpConn($option = array())
    {
        // 组装请求
        $varPost = array(
            "fields" => Util\Tool::getSet($option["fields"]),
            "displayName" => Util\Tool::getSet($option["displayName"]),
            "identifier" => Util\Tool::getSet($option["identifier"]),
            "type" => Util\Tool::getSet($option["type"]),
            "extIdpId" => Util\Tool::getSet($option["extIdpId"]),
            "loginOnly" => Util\Tool::getSet($option["loginOnly"]),
            "logo" => Util\Tool::getSet($option["logo"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/create-ext-idp-conn", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 更新身份源连接
     * @summary 更新身份源连接
     * @description 更新身份源连接
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param any fields 必须，身份源连接自定义参数（增量修改）
     * @param string displayName 必须，身份源连接显示名称
     * @param string id 必须，身份源连接 ID
     * @param string logo 可选，身份源连接的图标，默认 null
     * @param boolean loginOnly 可选，是否只支持登录，默认 null
     * @return ExtIdpConnDetailSingleRespDto
     */
    public function updateExtIdpConn($option = array())
    {
        // 组装请求
        $varPost = array(
            "fields" => Util\Tool::getSet($option["fields"]),
            "displayName" => Util\Tool::getSet($option["displayName"]),
            "id" => Util\Tool::getSet($option["id"]),
            "logo" => Util\Tool::getSet($option["logo"]),
            "loginOnly" => Util\Tool::getSet($option["loginOnly"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/update-ext-idp-conn", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 删除身份源连接
     * @summary 删除身份源连接
     * @description 删除身份源连接
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string id 必须，身份源连接 ID
     * @return IsSuccessRespDto
     */
    public function deleteExtIdpConn($option = array())
    {
        // 组装请求
        $varPost = array(
            "id" => Util\Tool::getSet($option["id"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/delete-ext-idp-conn", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 身份源连接开关
     * @summary 身份源连接开关
     * @description 身份源连接开关
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string appId 必须，应用 ID
     * @param boolean enabled 必须，是否开启身份源连接
     * @param string id 必须，身份源连接 ID
     * @param string tenantId 可选，租户 ID，默认 null
     * @return IsSuccessRespDto
     */
    public function changeConnState($option = array())
    {
        // 组装请求
        $varPost = array(
            "appId" => Util\Tool::getSet($option["appId"]),
            "enabled" => Util\Tool::getSet($option["enabled"]),
            "id" => Util\Tool::getSet($option["id"]),
            "tenantId" => Util\Tool::getSet($option["tenantId"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/enable-ext-idp-conn", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户池配置的自定义字段列表
     * @summary 获取用户池配置的自定义字段列表
     * @description 获取用户池配置的自定义字段列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param 'USER' | 'ROLE' | 'GROUP' | 'DEPARTMENT' targetType 必须，主体类型，目前支持用户、角色、分组和部门
     * @return CustomFieldListRespDto
     */
    public function getCustomFields($option = array())
    {
        // 组装请求
        $varGet = array(
            "targetType" => Util\Tool::getSet($option["targetType"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-custom-fields", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 创建/修改自定义字段定义
     * @summary 创建/修改自定义字段定义
     * @description 创建/修改自定义字段定义，如果传入的 key 不存在则创建，存在则更新。
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<SetCustomFieldDto> list 必须，自定义字段列表
     * @return CustomFieldListRespDto
     */
    public function setCustomFields($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getSet($option["list"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/set-custom-fields", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 设置自定义字段的值
     * @summary 设置自定义字段的值
     * @description 给用户、角色、部门设置自定义字段的值，如果存在则更新，不存在则创建。
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<SetCustomDataDto> list 必须，自定义数据列表
     * @param string targetIdentifier 必须，主体类型的唯一标志符。如果是用户则为用户 ID，角色为角色的 code，部门为部门的 ID
     * @param 'USER' | 'ROLE' | 'GROUP' | 'DEPARTMENT' targetType 必须，主体类型，目前支持用户、角色、分组和部门
     * @param string namespace 可选，所属权限分组的 code，当 target_type 为角色的时候需要填写，否则可以忽略。，默认 null
     * @return IsSuccessRespDto
     */
    public function setCustomData($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getSet($option["list"]),
            "targetIdentifier" => Util\Tool::getSet($option["targetIdentifier"]),
            "targetType" => Util\Tool::getSet($option["targetType"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/set-custom-data", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取用户、分组、角色、组织机构的自定义字段值
     * @summary 获取用户、分组、角色、组织机构的自定义字段值
     * @description 获取用户、分组、角色、组织机构的自定义字段值
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param 'USER' | 'ROLE' | 'GROUP' | 'DEPARTMENT' targetType 必须，主体类型，目前支持用户、角色、分组和部门
     * @param string targetIdentifier 必须，目标对象唯一标志符
     * @param string namespace 可选，所属权限分组的 code，当 targetType 为角色的时候需要填写，否则可以忽略。
     * @return GetCustomDataRespDto
     */
    public function getCustomData($option = array())
    {
        // 组装请求
        $varGet = array(
            "targetType" => Util\Tool::getSet($option["targetType"]),
            "targetIdentifier" => Util\Tool::getSet($option["targetIdentifier"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-custom-data", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 创建资源
     * @summary 创建资源
     * @description 创建资源
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' type 必须，资源类型，如数据、API、按钮、菜单
     * @param string code 必须，资源唯一标志符
     * @param string description 可选，资源描述，默认 null
     * @param Array<ResourceAction> actions 可选，资源定义的操作类型，默认 null
     * @param string apiIdentifier 可选，API 资源的 URL 标识，默认 null
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return ResourceRespDto
     */
    public function createResource($option = array())
    {
        // 组装请求
        $varPost = array(
            "type" => Util\Tool::getSet($option["type"]),
            "code" => Util\Tool::getSet($option["code"]),
            "description" => Util\Tool::getSet($option["description"]),
            "actions" => Util\Tool::getSet($option["actions"]),
            "apiIdentifier" => Util\Tool::getSet($option["apiIdentifier"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/create-resource", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 批量创建资源
     * @summary 批量创建资源
     * @description 批量创建资源
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<CreateResourceBatchItemDto> list 必须，资源列表
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsSuccessRespDto
     */
    public function createResourcesBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getSet($option["list"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/create-resources-batch", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取资源详情
     * @summary 获取资源详情
     * @description 获取资源详情
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，资源唯一标志符
     * @param string namespace 可选，所属权限分组的 code
     * @return ResourceRespDto
     */
    public function getResource($option = array())
    {
        // 组装请求
        $varGet = array(
            "code" => Util\Tool::getSet($option["code"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-resource", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 批量获取资源详情
     * @summary 批量获取资源详情
     * @description 批量获取资源详情
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> codeList 必须，资源 code 列表,批量可以使用逗号分隔
     * @param string namespace 可选，所属权限分组的 code
     * @return ResourceListRespDto
     */
    public function getResourcesBatch($option = array())
    {
        // 组装请求
        $varGet = array(
            "namespace" => Util\Tool::getSet($option["namespace"]),
            "codeList" => Util\Tool::getSet($option["codeList"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-resources-batch", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 分页获取资源列表
     * @summary 分页获取资源列表
     * @description 分页获取资源列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string namespace 可选，所属权限分组的 code
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' type 可选，资源类型
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @return ResourcePaginatedRespDto
     */
    public function listResources($option = array())
    {
        // 组装请求
        $varGet = array(
            "namespace" => Util\Tool::getSet($option["namespace"]),
            "type" => Util\Tool::getSet($option["type"]),
            "page" => Util\Tool::getSet($option["page"]),
            "limit" => Util\Tool::getSet($option["limit"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/list-resources", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 修改资源
     * @summary 修改资源
     * @description 修改资源（Pratial Update）
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，资源唯一标志符
     * @param string description 可选，资源描述，默认 null
     * @param Array<ResourceAction> actions 可选，资源定义的操作类型，默认 null
     * @param string apiIdentifier 可选，API 资源的 URL 标识，默认 null
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' type 可选，资源类型，如数据、API、按钮、菜单，默认 null
     * @return ResourceRespDto
     */
    public function updateResource($option = array())
    {
        // 组装请求
        $varPost = array(
            "code" => Util\Tool::getSet($option["code"]),
            "description" => Util\Tool::getSet($option["description"]),
            "actions" => Util\Tool::getSet($option["actions"]),
            "apiIdentifier" => Util\Tool::getSet($option["apiIdentifier"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
            "type" => Util\Tool::getSet($option["type"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/update-resource", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 删除资源
     * @summary 删除资源
     * @description 删除资源
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，资源唯一标志符
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsSuccessRespDto
     */
    public function deleteResource($option = array())
    {
        // 组装请求
        $varPost = array(
            "code" => Util\Tool::getSet($option["code"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/delete-resource", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 批量删除资源
     * @summary 批量删除资源
     * @description 批量删除资源
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> codeList 必须，资源 code 列表
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsSuccessRespDto
     */
    public function deleteResourcesBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "codeList" => Util\Tool::getSet($option["codeList"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/delete-resources-batch", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 创建权限分组
     * @summary 创建权限分组
     * @description 创建权限分组
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组唯一标志符
     * @param string name 可选，权限分组名称，默认 null
     * @param string description 可选，权限分组描述信息，默认 null
     * @return NamespaceRespDto
     */
    public function createNamespace($option = array())
    {
        // 组装请求
        $varPost = array(
            "code" => Util\Tool::getSet($option["code"]),
            "name" => Util\Tool::getSet($option["name"]),
            "description" => Util\Tool::getSet($option["description"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/create-namespace", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 批量创建权限分组
     * @summary 批量创建权限分组
     * @description 批量创建权限分组
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<CreateNamespacesBatchItemDto> list 必须，权限分组列表
     * @return IsSuccessRespDto
     */
    public function createNamespacesBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getSet($option["list"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/create-namespaces-batch", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取权限分组详情
     * @summary 获取权限分组详情
     * @description 获取权限分组详情
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组唯一标志符
     * @return NamespaceRespDto
     */
    public function getNamespace($option = array())
    {
        // 组装请求
        $varGet = array(
            "code" => Util\Tool::getSet($option["code"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-namespace", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 批量获取权限分组详情
     * @summary 批量获取权限分组详情
     * @description 批量获取权限分组详情
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> codeList 必须，资源 code 列表,批量可以使用逗号分隔
     * @return NamespaceListRespDto
     */
    public function getNamespacesBatch($option = array())
    {
        // 组装请求
        $varGet = array(
            "codeList" => Util\Tool::getSet($option["codeList"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-namespaces-batch", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 修改权限分组信息
     * @summary 修改权限分组信息
     * @description 修改权限分组信息
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组唯一标志符
     * @param string description 可选，权限分组描述信息，默认 null
     * @param string name 可选，权限分组名称，默认 null
     * @param string newCode 可选，权限分组新的唯一标志符，默认 null
     * @return UpdateNamespaceRespDto
     */
    public function updateNamespace($option = array())
    {
        // 组装请求
        $varPost = array(
            "code" => Util\Tool::getSet($option["code"]),
            "description" => Util\Tool::getSet($option["description"]),
            "name" => Util\Tool::getSet($option["name"]),
            "newCode" => Util\Tool::getSet($option["newCode"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/update-namespace", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 删除权限分组信息
     * @summary 删除权限分组信息
     * @description 删除权限分组信息
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组唯一标志符
     * @return IsSuccessRespDto
     */
    public function deleteNamespace($option = array())
    {
        // 组装请求
        $varPost = array(
            "code" => Util\Tool::getSet($option["code"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/delete-namespace", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 批量删除权限分组
     * @summary 批量删除权限分组
     * @description 批量删除权限分组
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> codeList 必须，权限分组 code 列表
     * @return IsSuccessRespDto
     */
    public function deleteNamespacesBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "codeList" => Util\Tool::getSet($option["codeList"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/delete-namespaces-batch", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 授权资源
     * @summary 授权资源
     * @description 给多个主体同时授权多个资源
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param Array<AuthorizeResourceItem> list 必须，授权列表
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsSuccessRespDto
     */
    public function authorizeResources($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getSet($option["list"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/authorize-resources", null, $varPost);
        // 返回
        return $varReq["body"];
    }

    /**
     * 获取某个主体被授权的资源列表
     * @summary 获取某个主体被授权的资源列表
     * @description 获取某个主体被授权的资源列表
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param 'USER' | 'ROLE' | 'GROUP' | 'DEPARTMENT' targetType 必须，目标对象类型
     * @param string targetIdentifier 必须，目标对象唯一标志符
     * @param string namespace 可选，所属权限分组的 code
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' resourceType 可选，限定资源类型，如数据、API、按钮、菜单
     * @param Array<string> resourceList 可选，限定查询的资源列表，如果指定，只会返回所指定的资源列表。
     * @param boolean withDenied 可选，是否获取被拒绝的资源，默认 false
     * @return AuthorizedResourcePaginatedRespDto
     */
    public function getAuthorizedResources($option = array())
    {
        // 组装请求
        $varGet = array(
            "namespace" => Util\Tool::getSet($option["namespace"]),
            "targetType" => Util\Tool::getSet($option["targetType"]),
            "targetIdentifier" => Util\Tool::getSet($option["targetIdentifier"]),
            "resourceType" => Util\Tool::getSet($option["resourceType"]),
            "resourceList" => Util\Tool::getSet($option["resourceList"]),
            "withDenied" => Util\Tool::getSet($option["withDenied"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/get-authorized-resources", $varGet, null);
        // 返回
        return $varReq["body"];
    }

    /**
     * 判断用户是否对某个资源的某个操作有权限
     * @summary 判断用户是否对某个资源的某个操作有权限
     * @description 判断用户是否对某个资源的某个操作有权限
     * @param array $option 可选，用于传递参数，如 array("email" => "main@test.com")
     * @param string action 必须，资源对应的操作
     * @param string resource 必须，资源标识符
     * @param string userId 必须，用户 ID
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsActionAllowedRespDtp
     */
    public function isActionAllowed($option = array())
    {
        // 组装请求
        $varPost = array(
            "action" => Util\Tool::getSet($option["action"]),
            "resource" => Util\Tool::getSet($option["resource"]),
            "userId" => Util\Tool::getSet($option["userId"]),
            "namespace" => Util\Tool::getSet($option["namespace"]),
        );
        // 发送请求
        $varReq = $this->_requests("/api/v3/is-action-allowed", null, $varPost);
        // 返回
        return $varReq["body"];
    }

}