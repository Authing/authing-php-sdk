<?php

/**
 * 命名空间
 */

namespace Authing;

/**
 * 导入
 */

require_once "util/Tool.php";

use ElephantIO\Client;
use ElephantIO\Engine\SocketIO\Version2X;
use ElephantIO\Exception\SocketException;

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
    //用户池Secret
    public $_accessKeySecret;
    // 超时时间
    public $_timeout;
    //事件订阅地址
    public $_socketHost;
    //private
    private $_wsMap;
    private $_eventBus;
    private $_retryTimes = 3;

    /**
     * 构造函数
     * @param array $option 必须，用于传递参数，如 array("accessKeyId" => "AUTHING_USERPOOL_ID", "appSecret" => "AUTHING_USERPOOL_SECRET", "host" => "https://api.authing.cn")
     * @param string accessKeyId 必须，应用 ID
     * @param string accessKeySecret 必须，应用 Secret
     * @param string host 必须，应用域名，例如 example.authing.cn
     * @param integer timeout 可选，超时时间，单位为秒，默认为 10
     * @throws \Exception
     */
    public function __construct($option)
    {
        if (
            !isset($option["accessKeyId"])
        ) {
            throw new \Exception('请在初始化 ManagementClient 时传入 accessKeyId');
        }

        if (
            !isset($option["accessKeySecret"])
        ) {
            throw new \Exception('请在初始化 ManagementClient 时传入 accessKeySecret');
        }

        if (
            !isset($option["host"])
        ) {
            $option["host"] = "https://api.authing.cn";
        }

        if (
            !isset($option["timeout"])
        ) {
            $option["timeout"] = 10;
        }

        $this->_url = $option["host"];
        $this->_accessKey = array("id" => $option["accessKeyId"], "secret" => $option["accessKeySecret"]);
        $this->_userPoolID = $option["accessKeyId"];
        $this->_accessKeySecret = $option["accessKeySecret"];
        $this->_timeout = $option["timeout"];
        $this->_getAccessToken($this->_accessKey["id"], $this->_accessKey["secret"]);
        $this->_socketHost = $option["socketHost"];
        $this->_wsMap = [];
        $this->_eventBus = [];
    }

    /**
     * 构造请求
     */
    private function request($parMethod, $parPath, $parGet = [], $parPost = [])
    {
        //过期
        if (!empty($this->_accessTokenTime) and time() >= $this->_accessTokenTime) {
            $this->_accessToken = null;
            $this->_accessTokenTime = null;
            $this->_getAccessToken($this->_accessKey["id"], $this->_accessKey["secret"]);
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
            "x-authing-sdk-version" => "authing-php-sdk:5.0.0",
        );
        // 请求
        $varRes = Util\Tool::request($parMethod, $this->_url . $parPath, $parGet, $parPost, $varHeader, $this->_timeout);
        return $varRes;
    }

    public function getManagementToken($option = array())
    {
        // 组装请求
        $varPost = array(
            "accessKeySecret" => $option["accessKeySecret"],
            "accessKeyId" => $option["accessKeyId"],
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/get-management-token", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取 Access Token
     */
    private function _getAccessToken($accessKeyId, $accessKeySecret)
    {
        $tempAccessToken = $this->getManagementToken(array("accessKeyId" => $accessKeyId, "accessKeySecret" => $accessKeySecret))["data"];
        $this->_accessToken = $tempAccessToken["access_token"];
        $this->_accessTokenTime = time() + $tempAccessToken["expires_in"];
    }


    /**
     * 获取/搜索用户列表
     * @summary 获取/搜索用户列表
     * @description
     * 此接口用于获取用户列表，支持模糊搜索，以及通过用户基础字段、用户自定义字段、用户所在部门、用户历史登录应用等维度筛选用户。
     *
     * ### 模糊搜素示例
     *
     * 模糊搜索默认会从 `phone`, `email`, `name`, `username`, `nickname` 五个字段对用户进行模糊搜索，你也可以通过设置 `options.fuzzySearchOn`
     * 决定模糊匹配的字段范围：
     *
     * ```json
     * {
     * "keywords": "北京",
     * "options": {
     * "fuzzySearchOn": [
     * "address"
     * ]
     * }
     * }
     * ```
     *
     * ### 高级搜索示例
     *
     * 你可以通过 `advancedFilter` 进行高级搜索，高级搜索支持通过用户的基础信息、自定义数据、所在部门、用户来源、登录应用、外部身份源信息等维度对用户进行筛选。
     * **且这些筛选条件可以任意组合。**
     *
     * #### 筛选状态为禁用的用户
     *
     * 用户状态（`status`）为字符串类型，可选值为 `Activated` 和 `Suspended`：
     *
     * ```json
     * {
     * "advancedFilter": [
     * {
     * "field": "status",
     * "operator": "EQUAL",
     * "value": "Suspended"
     * }
     * ]
     * }
     * ```
     *
     * #### 筛选邮箱中包含 `@example.com` 的用户
     *
     * 用户邮箱（`email`）为字符串类型，可以进行模糊搜索：
     *
     * ```json
     * {
     * "advancedFilter": [
     * {
     * "field": "email",
     * "operator": "CONTAINS",
     * "value": "@example.com"
     * }
     * ]
     * }
     * ```
     *
     * #### 根据用户的任意扩展字段进行搜索
     *
     * ```json
     * {
     * "advancedFilter": [
     * {
     * "field": "some-custom-key",
     * "operator": "EQUAL",
     * "value": "some-value"
     * }
     * ]
     * }
     * ```
     *
     * #### 根据用户登录次数筛选
     *
     * 筛选登录次数大于 10 的用户：
     *
     * ```json
     * {
     * "advancedFilter": [
     * {
     * "field": "loginsCount",
     * "operator": "GREATER",
     * "value": 10
     * }
     * ]
     * }
     * ```
     *
     * 筛选登录次数在 10 - 100 次的用户：
     *
     * ```json
     * {
     * "advancedFilter": [
     * {
     * "field": "loginsCount",
     * "operator": "BETWEEN",
     * "value": [10, 100]
     * }
     * ]
     * }
     * ```
     *
     * #### 根据用户上次登录时间进行筛选
     *
     * 筛选最近 7 天内登录过的用户：
     *
     * ```json
     * {
     * "advancedFilter": [
     * {
     * "field": "lastLoginTime",
     * "operator": "GREATER",
     * "value": new Date(Date.now() - 7 * 24 * 60 * 60 * 1000)
     * }
     * ]
     * }
     * ```
     *
     * 筛选在某一段时间内登录过的用户：
     *
     * ```json
     * {
     * "advancedFilter": [
     * {
     * "field": "lastLoginTime",
     * "operator": "BETWEEN",
     * "value": [
     * new Date(Date.now() - 14 * 24 * 60 * 60 * 1000),
     * new Date(Date.now() - 7 * 24 * 60 * 60 * 1000)
     * ]
     * }
     * ]
     * }
     * ```
     *
     * #### 根据用户曾经登录过的应用筛选
     *
     * 筛选出曾经登录过应用 `appId1` 或者 `appId2` 的用户：
     *
     * ```json
     * {
     * "advancedFilter": [
     * {
     * "field": "loggedInApps",
     * "operator": "IN",
     * "value": [
     * "appId1",
     * "appId2"
     * ]
     * }
     * ]
     * }
     * ```
     *
     * #### 根据用户所在部门进行筛选
     *
     * ```json
     * {
     * "advancedFilter": [
     * {
     * "field": "department",
     * "operator": "IN",
     * "value": [
     * {
     * "organizationCode": "steamory",
     * "departmentId": "root",
     * "departmentIdType": "department_id",
     * "includeChildrenDepartments": true
     * }
     * ]
     * }
     * ]
     * }
     * ```
     *
     *
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string keywords 可选，模糊搜索关键字，默认 null
     * @param Array<ListUsersAdvancedFilterItemDto> advancedFilter 可选，高级搜索，默认 null
     * @param ListUsersOptionsDto options 可选，可选项，默认 null
     * @return UserPaginatedRespDto
     */
    public function listUsers($option = array())
    {
        // 组装请求
        $varPost = array(
            "keywords" => Util\Tool::getOrDefault($option, "keywords", null),
            "advancedFilter" => Util\Tool::getOrDefault($option, "advancedFilter", null),
            "options" => Util\Tool::getOrDefault($option, "options", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/list-users", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户列表
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param 'Suspended' | 'Resigned' | 'Activated' | 'Archived' | 'Deactivated' status 可选，账户当前状态，如 已停用、已离职、正常状态、已归档
     * @param number updatedAtStart 可选，用户创建、修改开始时间，为精确到秒的 UNIX 时间戳；支持获取从某一段时间之后的增量数据
     * @param number updatedAtEnd 可选，用户创建、修改终止时间，为精确到秒的 UNIX 时间戳；支持获取某一段时间内的增量数据。默认为当前时间
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param boolean withIdentities 可选，是否获取 identities，默认 false
     * @param boolean withDepartmentIds 可选，是否获取部门 ID 列表，默认 false
     * @return UserPaginatedRespDto
     * @deprecated
     * @summary 获取用户列表
     * @description 获取用户列表接口，支持分页，可以选择获取自定义数据、identities 等。
     */
    public function listUsersLegacy($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "status" => Util\Tool::getOrDefault($option, "status", null),
            "updatedAtStart" => Util\Tool::getOrDefault($option, "updatedAtStart", null),
            "updatedAtEnd" => Util\Tool::getOrDefault($option, "updatedAtEnd", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
            "withIdentities" => Util\Tool::getOrDefault($option, "withIdentities", null),
            "withDepartmentIds" => Util\Tool::getOrDefault($option, "withDepartmentIds", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-users", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户信息
     * @summary 获取用户信息
     * @description 通过用户 ID，获取用户详情，可以选择获取自定义数据、identities、选择指定用户 ID 类型等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户 ID
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 'user_id'
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param boolean withIdentities 可选，是否获取 identities，默认 false
     * @param boolean withDepartmentIds 可选，是否获取部门 ID 列表，默认 false
     * @return UserSingleRespDto
     */
    public function getUser($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
            "withIdentities" => Util\Tool::getOrDefault($option, "withIdentities", null),
            "withDepartmentIds" => Util\Tool::getOrDefault($option, "withDepartmentIds", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量获取用户信息
     * @summary 批量获取用户信息
     * @description 通过用户 ID 列表，批量获取用户信息，可以选择获取自定义数据、identities、选择指定用户 ID 类型等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> userIds 必须，用户 ID 数组
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 'user_id'
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param boolean withIdentities 可选，是否获取 identities，默认 false
     * @param boolean withDepartmentIds 可选，是否获取部门 ID 列表，默认 false
     * @return UserListRespDto
     */
    public function getUserBatch($option = array())
    {
        // 组装请求
        $varGet = array(
            "userIds" => Util\Tool::getOrDefault($option, "userIds", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
            "withIdentities" => Util\Tool::getOrDefault($option, "withIdentities", null),
            "withDepartmentIds" => Util\Tool::getOrDefault($option, "withDepartmentIds", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user-batch", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 创建用户
     * @summary 创建用户
     * @description 创建用户，邮箱、手机号、用户名必须包含其中一个，邮箱、手机号、用户名、externalId 用户池内唯一，此接口将以管理员身份创建用户因此不需要进行手机号验证码检验等安全检测。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'Suspended' | 'Resigned' | 'Activated' | 'Archived' | 'Deactivated' status 可选，账户当前状态，默认 null
     * @param string email 可选，邮箱，不区分大小写，默认 null
     * @param string phone 可选，手机号，不带区号。如果是国外手机号，请在 phoneCountryCode 参数中指定区号。，默认 null
     * @param string phoneCountryCode 可选，手机区号，中国大陆手机号可不填。Authing 短信服务暂不内置支持国际手机号，你需要在 Authing 控制台配置对应的国际短信服务。完整的手机区号列表可参阅 https://en.wikipedia.org/wiki/List_of_country_calling_codes。，默认 null
     * @param string username 可选，用户名，用户池内唯一，默认 null
     * @param string externalId 可选，第三方外部 ID，默认 null
     * @param string name 可选，用户真实名称，不具备唯一性，默认 null
     * @param string nickname 可选，昵称，默认 null
     * @param string photo 可选，头像链接，默认 null
     * @param 'M' | 'F' | 'U' gender 可选，性别，默认 null
     * @param boolean emailVerified 可选，邮箱是否验证，默认 null
     * @param boolean phoneVerified 可选，手机号是否验证，默认 null
     * @param string birthdate 可选，出生日期，默认 null
     * @param string country 可选，所在国家，默认 null
     * @param string province 可选，所在省份，默认 null
     * @param string city 可选，所在城市，默认 null
     * @param string address 可选，所处地址，默认 null
     * @param string streetAddress 可选，所处街道地址，默认 null
     * @param string postalCode 可选，邮政编码号，默认 null
     * @param string company 可选，所在公司，默认 null
     * @param string browser 可选，最近一次登录时使用的浏览器 UA，默认 null
     * @param string device 可选，最近一次登录时使用的设备，默认 null
     * @param string givenName 可选，名，默认 null
     * @param string familyName 可选，姓，默认 null
     * @param string middleName 可选，中间名，默认 null
     * @param string profile 可选，Preferred Username，默认 null
     * @param string preferredUsername 可选，Preferred Username，默认 null
     * @param string website 可选，用户个人网页，默认 null
     * @param string zoneinfo 可选，用户时区信息，默认 null
     * @param string locale 可选，Locale，默认 null
     * @param string formatted 可选，标准的完整地址，默认 null
     * @param string region 可选，用户所在区域，默认 null
     * @param string password 可选，用户密码。我们使用 HTTPS 协议对密码进行安全传输，可以在一定程度上保证安全性。如果你还需要更高级别的安全性，我们还支持 RSA256 和国密 SM2 两种方式对密码进行加密。详情见 `passwordEncryptType` 参数。，默认 null
     * @param string salt 可选，加密用户密码的盐，默认 null
     * @param Array<string> tenantIds 可选，租户 ID，默认 null
     * @param CreateUserOtpDto otp 可选，用户的 OTP 验证器，默认 null
     * @param Array<string> departmentIds 可选，用户所属部门 ID 列表，默认 null
     * @param any customData 可选，自定义数据，传入的对象中的 key 必须先在用户池定义相关自定义字段，默认 null
     * @param Array<CreateIdentityDto> identities 可选，第三方身份源（建议调用绑定接口进行绑定），默认 null
     * @param CreateUserOptionsDto options 可选，可选参数，默认 null
     * @return UserSingleRespDto
     */
    public function createUser($option = array())
    {
        // 组装请求
        $varPost = array(
            "status" => Util\Tool::getOrDefault($option, "status", null),
            "email" => Util\Tool::getOrDefault($option, "email", null),
            "phone" => Util\Tool::getOrDefault($option, "phone", null),
            "phoneCountryCode" => Util\Tool::getOrDefault($option, "phoneCountryCode", null),
            "username" => Util\Tool::getOrDefault($option, "username", null),
            "externalId" => Util\Tool::getOrDefault($option, "externalId", null),
            "name" => Util\Tool::getOrDefault($option, "name", null),
            "nickname" => Util\Tool::getOrDefault($option, "nickname", null),
            "photo" => Util\Tool::getOrDefault($option, "photo", null),
            "gender" => Util\Tool::getOrDefault($option, "gender", null),
            "emailVerified" => Util\Tool::getOrDefault($option, "emailVerified", null),
            "phoneVerified" => Util\Tool::getOrDefault($option, "phoneVerified", null),
            "birthdate" => Util\Tool::getOrDefault($option, "birthdate", null),
            "country" => Util\Tool::getOrDefault($option, "country", null),
            "province" => Util\Tool::getOrDefault($option, "province", null),
            "city" => Util\Tool::getOrDefault($option, "city", null),
            "address" => Util\Tool::getOrDefault($option, "address", null),
            "streetAddress" => Util\Tool::getOrDefault($option, "streetAddress", null),
            "postalCode" => Util\Tool::getOrDefault($option, "postalCode", null),
            "company" => Util\Tool::getOrDefault($option, "company", null),
            "browser" => Util\Tool::getOrDefault($option, "browser", null),
            "device" => Util\Tool::getOrDefault($option, "device", null),
            "givenName" => Util\Tool::getOrDefault($option, "givenName", null),
            "familyName" => Util\Tool::getOrDefault($option, "familyName", null),
            "middleName" => Util\Tool::getOrDefault($option, "middleName", null),
            "profile" => Util\Tool::getOrDefault($option, "profile", null),
            "preferredUsername" => Util\Tool::getOrDefault($option, "preferredUsername", null),
            "website" => Util\Tool::getOrDefault($option, "website", null),
            "zoneinfo" => Util\Tool::getOrDefault($option, "zoneinfo", null),
            "locale" => Util\Tool::getOrDefault($option, "locale", null),
            "formatted" => Util\Tool::getOrDefault($option, "formatted", null),
            "region" => Util\Tool::getOrDefault($option, "region", null),
            "password" => Util\Tool::getOrDefault($option, "password", null),
            "salt" => Util\Tool::getOrDefault($option, "salt", null),
            "tenantIds" => Util\Tool::getOrDefault($option, "tenantIds", null),
            "otp" => Util\Tool::getOrDefault($option, "otp", null),
            "departmentIds" => Util\Tool::getOrDefault($option, "departmentIds", null),
            "customData" => Util\Tool::getOrDefault($option, "customData", null),
            "identities" => Util\Tool::getOrDefault($option, "identities", null),
            "options" => Util\Tool::getOrDefault($option, "options", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-user", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量创建用户
     * @summary 批量创建用户
     * @description 批量创建用户，邮箱、手机号、用户名必须包含其中一个，邮箱、手机号、用户名、externalId 用户池内唯一，此接口将以管理员身份创建用户因此不需要进行手机号验证码检验等安全检测。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<CreateUserInfoDto> list 必须，用户列表
     * @param CreateUserOptionsDto options 可选，可选参数，默认 null
     * @return UserListRespDto
     */
    public function createUsersBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getOrDefault($option, "list", null),
            "options" => Util\Tool::getOrDefault($option, "options", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-users-batch", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改用户资料
     * @summary 修改用户资料
     * @description 通过用户 ID，修改用户资料，邮箱、手机号、用户名、externalId 用户池内唯一，此接口将以管理员身份修改用户资料因此不需要进行手机号验证码检验等安全检测。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param string phoneCountryCode 可选，手机区号，中国大陆手机号可不填。Authing 短信服务暂不内置支持国际手机号，你需要在 Authing 控制台配置对应的国际短信服务。完整的手机区号列表可参阅 https://en.wikipedia.org/wiki/List_of_country_calling_codes。，默认 null
     * @param string name 可选，用户真实名称，不具备唯一性，默认 null
     * @param string nickname 可选，昵称，默认 null
     * @param string photo 可选，头像链接，默认 null
     * @param string externalId 可选，第三方外部 ID，默认 null
     * @param 'Suspended' | 'Resigned' | 'Activated' | 'Archived' | 'Deactivated' status 可选，账户当前状态，默认 null
     * @param boolean emailVerified 可选，邮箱是否验证，默认 null
     * @param boolean phoneVerified 可选，手机号是否验证，默认 null
     * @param string birthdate 可选，出生日期，默认 null
     * @param string country 可选，所在国家，默认 null
     * @param string province 可选，所在省份，默认 null
     * @param string city 可选，所在城市，默认 null
     * @param string address 可选，所处地址，默认 null
     * @param string streetAddress 可选，所处街道地址，默认 null
     * @param string postalCode 可选，邮政编码号，默认 null
     * @param 'M' | 'F' | 'U' gender 可选，性别，默认 null
     * @param string username 可选，用户名，用户池内唯一，默认 null
     * @param string email 可选，邮箱，不区分大小写，默认 null
     * @param string phone 可选，手机号，不带区号。如果是国外手机号，请在 phoneCountryCode 参数中指定区号。，默认 null
     * @param string password 可选，用户密码。我们使用 HTTPS 协议对密码进行安全传输，可以在一定程度上保证安全性。如果你还需要更高级别的安全性，我们还支持 RSA256 和国密 SM2 两种方式对密码进行加密。详情见 `passwordEncryptType` 参数。，默认 null
     * @param string company 可选，所在公司，默认 null
     * @param string browser 可选，最近一次登录时使用的浏览器 UA，默认 null
     * @param string device 可选，最近一次登录时使用的设备，默认 null
     * @param string givenName 可选，名，默认 null
     * @param string familyName 可选，姓，默认 null
     * @param string middleName 可选，中间名，默认 null
     * @param string profile 可选，Preferred Username，默认 null
     * @param string preferredUsername 可选，Preferred Username，默认 null
     * @param string website 可选，用户个人网页，默认 null
     * @param string zoneinfo 可选，用户时区信息，默认 null
     * @param string locale 可选，Locale，默认 null
     * @param string formatted 可选，标准的完整地址，默认 null
     * @param string region 可选，用户所在区域，默认 null
     * @param any customData 可选，自定义数据，传入的对象中的 key 必须先在用户池定义相关自定义字段，默认 null
     * @param UpdateUserOptionsDto options 可选，可选参数，默认 null
     * @return UserSingleRespDto
     */
    public function updateUser($option = array())
    {
        // 组装请求
        $varPost = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "phoneCountryCode" => Util\Tool::getOrDefault($option, "phoneCountryCode", null),
            "name" => Util\Tool::getOrDefault($option, "name", null),
            "nickname" => Util\Tool::getOrDefault($option, "nickname", null),
            "photo" => Util\Tool::getOrDefault($option, "photo", null),
            "externalId" => Util\Tool::getOrDefault($option, "externalId", null),
            "status" => Util\Tool::getOrDefault($option, "status", null),
            "emailVerified" => Util\Tool::getOrDefault($option, "emailVerified", null),
            "phoneVerified" => Util\Tool::getOrDefault($option, "phoneVerified", null),
            "birthdate" => Util\Tool::getOrDefault($option, "birthdate", null),
            "country" => Util\Tool::getOrDefault($option, "country", null),
            "province" => Util\Tool::getOrDefault($option, "province", null),
            "city" => Util\Tool::getOrDefault($option, "city", null),
            "address" => Util\Tool::getOrDefault($option, "address", null),
            "streetAddress" => Util\Tool::getOrDefault($option, "streetAddress", null),
            "postalCode" => Util\Tool::getOrDefault($option, "postalCode", null),
            "gender" => Util\Tool::getOrDefault($option, "gender", null),
            "username" => Util\Tool::getOrDefault($option, "username", null),
            "email" => Util\Tool::getOrDefault($option, "email", null),
            "phone" => Util\Tool::getOrDefault($option, "phone", null),
            "password" => Util\Tool::getOrDefault($option, "password", null),
            "company" => Util\Tool::getOrDefault($option, "company", null),
            "browser" => Util\Tool::getOrDefault($option, "browser", null),
            "device" => Util\Tool::getOrDefault($option, "device", null),
            "givenName" => Util\Tool::getOrDefault($option, "givenName", null),
            "familyName" => Util\Tool::getOrDefault($option, "familyName", null),
            "middleName" => Util\Tool::getOrDefault($option, "middleName", null),
            "profile" => Util\Tool::getOrDefault($option, "profile", null),
            "preferredUsername" => Util\Tool::getOrDefault($option, "preferredUsername", null),
            "website" => Util\Tool::getOrDefault($option, "website", null),
            "zoneinfo" => Util\Tool::getOrDefault($option, "zoneinfo", null),
            "locale" => Util\Tool::getOrDefault($option, "locale", null),
            "formatted" => Util\Tool::getOrDefault($option, "formatted", null),
            "region" => Util\Tool::getOrDefault($option, "region", null),
            "customData" => Util\Tool::getOrDefault($option, "customData", null),
            "options" => Util\Tool::getOrDefault($option, "options", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-user", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量修改用户资料
     * @summary 批量修改用户资料
     * @description 批量修改用户资料，邮箱、手机号、用户名、externalId 用户池内唯一，此接口将以管理员身份修改用户资料因此不需要进行手机号验证码检验等安全检测。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<UpdateUserInfoDto> list 必须，用户列表
     * @param UpdateUserBatchOptionsDto options 可选，可选参数，默认 null
     * @return UserListRespDto
     */
    public function updateUserBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getOrDefault($option, "list", null),
            "options" => Util\Tool::getOrDefault($option, "options", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-user-batch", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 删除用户
     * @summary 删除用户
     * @description 通过用户 ID 列表，删除用户，支持批量删除，可以选择指定用户 ID 类型等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> userIds 必须，用户 ID 列表
     * @param DeleteUsersBatchOptionsDto options 可选，可选参数，默认 null
     * @return IsSuccessRespDto
     */
    public function deleteUsersBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "userIds" => Util\Tool::getOrDefault($option, "userIds", null),
            "options" => Util\Tool::getOrDefault($option, "options", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-users-batch", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户的外部身份源
     * @summary 获取用户的外部身份源
     * @description 通过用户 ID，获取用户的外部身份源、选择指定用户 ID 类型。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 'user_id'
     * @return IdentityListRespDto
     */
    public function getUserIdentities($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user-identities", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户角色列表
     * @summary 获取用户角色列表
     * @description 通过用户 ID，获取用户角色列表，可以选择所属权限分组 code、选择指定用户 ID 类型等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 'user_id'
     * @param string namespace 可选，所属权限分组的 code
     * @return RolePaginatedRespDto
     */
    public function getUserRoles($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user-roles", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户实名认证信息
     * @summary 获取用户实名认证信息
     * @description 通过用户 ID，获取用户实名认证信息，可以选择指定用户 ID 类型。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 'user_id'
     * @return PrincipalAuthenticationInfoPaginatedRespDto
     */
    public function getUserPrincipalAuthenticationInfo($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user-principal-authentication-info", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 删除用户实名认证信息
     * @summary 删除用户实名认证信息
     * @description 通过用户 ID，删除用户实名认证信息，可以选择指定用户 ID 类型等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param ResetUserPrincipalAuthenticationInfoOptionsDto options 可选，可选参数，默认 null
     * @return IsSuccessRespDto
     */
    public function resetUserPrincipalAuthenticationInfo($option = array())
    {
        // 组装请求
        $varPost = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "options" => Util\Tool::getOrDefault($option, "options", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/reset-user-principal-authentication-info", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户部门列表
     * @summary 获取用户部门列表
     * @description 通过用户 ID，获取用户部门列表，支持分页，可以选择获取自定义数据、选择指定用户 ID 类型、增序或降序等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 'user_id'
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param 'DepartmentCreatedAt' | 'JoinDepartmentAt' | 'DepartmentName' | 'DepartmemtCode' sortBy 可选，排序依据，如 部门创建时间、加入部门时间、部门名称、部门标志符，默认 'JoinDepartmentAt'
     * @param 'Asc' | 'Desc' orderBy 可选，增序或降序，默认 'Desc'
     * @return UserDepartmentPaginatedRespDto
     */
    public function getUserDepartments($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
            "sortBy" => Util\Tool::getOrDefault($option, "sortBy", null),
            "orderBy" => Util\Tool::getOrDefault($option, "orderBy", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user-departments", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 设置用户所在部门
     * @summary 设置用户所在部门
     * @description 通过用户 ID，设置用户所在部门，可以选择指定用户 ID 类型等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<SetUserDepartmentDto> departments 必须，部门信息
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param SetUserDepartmentsOptionsDto options 可选，可选参数，默认 null
     * @return IsSuccessRespDto
     */
    public function setUserDepartments($option = array())
    {
        // 组装请求
        $varPost = array(
            "departments" => Util\Tool::getOrDefault($option, "departments", null),
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "options" => Util\Tool::getOrDefault($option, "options", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/set-user-departments", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户分组列表
     * @summary 获取用户分组列表
     * @description 通过用户 ID，获取用户分组列表，可以选择指定用户 ID 类型等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 'user_id'
     * @return GroupPaginatedRespDto
     */
    public function getUserGroups($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user-groups", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户 MFA 绑定信息
     * @summary 获取用户 MFA 绑定信息
     * @description 通过用户 ID，获取用户 MFA 绑定信息，可以选择指定用户 ID 类型等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 'user_id'
     * @return UserMfaSingleRespDto
     */
    public function getUserMfaInfo($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user-mfa-info", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取已归档的用户列表
     * @summary 获取已归档的用户列表
     * @description 获取已归档的用户列表，支持分页，可以筛选开始时间等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param number startAt 可选，开始时间，为精确到秒的 UNIX 时间戳，默认不指定
     * @return ListArchivedUsersSingleRespDto
     */
    public function listArchivedUsers($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "startAt" => Util\Tool::getOrDefault($option, "startAt", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-archived-users", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 强制下线用户
     * @summary 强制下线用户
     * @description 通过用户 ID、App ID 列表，强制让用户下线，可以选择指定用户 ID 类型等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> appIds 必须，APP ID 列表
     * @param string userId 必须，用户 ID
     * @param KickUsersOptionsDto options 可选，可选参数，默认 null
     * @return IsSuccessRespDto
     */
    public function kickUsers($option = array())
    {
        // 组装请求
        $varPost = array(
            "appIds" => Util\Tool::getOrDefault($option, "appIds", null),
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "options" => Util\Tool::getOrDefault($option, "options", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/kick-users", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 判断用户是否存在
     * @summary 判断用户是否存在
     * @description 根据条件判断用户是否存在，可以筛选用户名、邮箱、手机号、第三方外部 ID 等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string username 可选，用户名，用户池内唯一，默认 null
     * @param string email 可选，邮箱，不区分大小写，默认 null
     * @param string phone 可选，手机号，不带区号。如果是国外手机号，请在 phoneCountryCode 参数中指定区号。，默认 null
     * @param string externalId 可选，第三方外部 ID，默认 null
     * @return IsUserExistsRespDto
     */
    public function isUserExists($option = array())
    {
        // 组装请求
        $varPost = array(
            "username" => Util\Tool::getOrDefault($option, "username", null),
            "email" => Util\Tool::getOrDefault($option, "email", null),
            "phone" => Util\Tool::getOrDefault($option, "phone", null),
            "externalId" => Util\Tool::getOrDefault($option, "externalId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/is-user-exists", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户可访问的应用
     * @summary 获取用户可访问的应用
     * @description 通过用户 ID，获取用户可访问的应用，可以选择指定用户 ID 类型等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 'user_id'
     * @return AppListRespDto
     */
    public function getUserAccessibleApps($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user-accessible-apps", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户授权的应用
     * @summary 获取用户授权的应用
     * @description 通过用户 ID，获取用户授权的应用，可以选择指定用户 ID 类型等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 'user_id'
     * @return AppListRespDto
     */
    public function getUserAuthorizedApps($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user-authorized-apps", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 判断用户是否有某个角色
     * @summary 判断用户是否有某个角色
     * @description 通过用户 ID，判断用户是否有某个角色，支持传入多个角色，可以选择指定用户 ID 类型等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<HasRoleRolesDto> roles 必须，角色列表
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param HasAnyRoleOptionsDto options 可选，可选参数，默认 null
     * @return HasAnyRoleRespDto
     */
    public function hasAnyRole($option = array())
    {
        // 组装请求
        $varPost = array(
            "roles" => Util\Tool::getOrDefault($option, "roles", null),
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "options" => Util\Tool::getOrDefault($option, "options", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/has-any-role", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户的登录历史记录
     * @summary 获取用户的登录历史记录
     * @description 通过用户 ID，获取用户登录历史记录，支持分页，可以选择指定用户 ID 类型、应用 ID、开始与结束时间戳等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 'user_id'
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
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
            "clientIp" => Util\Tool::getOrDefault($option, "clientIp", null),
            "start" => Util\Tool::getOrDefault($option, "start", null),
            "end" => Util\Tool::getOrDefault($option, "end", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user-login-history", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户曾经登录过的应用
     * @summary 获取用户曾经登录过的应用
     * @description 通过用户 ID，获取用户曾经登录过的应用，可以选择指定用户 ID 类型等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 'user_id'
     * @return UserLoggedInAppsListRespDto
     */
    public function getUserLoggedinApps($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user-loggedin-apps", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户曾经登录过的身份源
     * @summary 获取用户曾经登录过的身份源
     * @description 通过用户 ID，获取用户曾经登录过的身份源，可以选择指定用户 ID 类型等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 'user_id'
     * @return UserLoggedInIdentitiesRespDto
     */
    public function getUserLoggedinIdentities($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user-logged-in-identities", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 用户离职
     * @summary 用户离职
     * @description 通过用户 ID，对用户进行离职操作
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 null
     * @return ResignUserRespDto
     */
    public function resignUser($option = array())
    {
        // 组装请求
        $varPost = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/resign-user", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量用户离职
     * @summary 批量用户离职
     * @description 通过用户 ID，对用户进行离职操作
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> userIds 必须，用户 ID 数组
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 null
     * @return ResignUserRespDto
     */
    public function resignUserBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "userIds" => Util\Tool::getOrDefault($option, "userIds", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/resign-user-batch", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户被授权的所有资源
     * @summary 获取用户被授权的所有资源
     * @description 通过用户 ID，获取用户被授权的所有资源，可以选择指定用户 ID 类型等，用户被授权的资源是用户自身被授予、通过分组继承、通过角色继承、通过组织机构继承的集合。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param 'user_id' | 'external_id' | 'phone' | 'email' | 'username' | 'identity' userIdType 可选，用户 ID 类型，默认值为 `user_id`，可选值为：
     * - `user_id`: Authing 用户 ID，如 `6319a1504f3xxxxf214dd5b7`
     * - `phone`: 用户手机号
     * - `email`: 用户邮箱
     * - `username`: 用户名
     * - `external_id`: 用户在外部系统的 ID，对应 Authing 用户信息的 `externalId` 字段
     * - `identity`: 用户的外部身份源信息，格式为 `<extIdpId>:<userIdInIdp>`，其中 `<extIdpId>` 为 Authing 身份源的 ID，`<userIdInIdp>` 为用户在外部身份源的 ID。
     * 示例值：`62f20932716fbcc10d966ee5:ou_8bae746eac07cd2564654140d2a9ac61`。
     * ，默认 'user_id'
     * @param string namespace 可选，所属权限分组的 code
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' | 'UI' resourceType 可选，资源类型，如 数据、API、菜单、按钮
     * @return AuthorizedResourcePaginatedRespDto
     */
    public function getUserAuthorizedResources($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "userIdType" => Util\Tool::getOrDefault($option, "userIdType", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
            "resourceType" => Util\Tool::getOrDefault($option, "resourceType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user-authorized-resources", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 检查某个用户在应用下是否具备 Session 登录态
     * @summary 检查某个用户在应用下是否具备 Session 登录态
     * @description 检查某个用户在应用下是否具备 Session 登录态
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string appId 必须，App ID
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @return CheckSessionStatusRespDto
     */
    public function checkSessionStatus($option = array())
    {
        // 组装请求
        $varPost = array(
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/check-session-status", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 导入用户的 OTP
     * @summary 导入用户的 OTP
     * @description 导入用户的 OTP
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<ImportOtpItemDto> list 必须，参数列表
     * @return CommonResponseDto
     */
    public function importOtp($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getOrDefault($option, "list", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/import-otp", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取组织机构详情
     * @summary 获取组织机构详情
     * @description 获取组织机构详情
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 Code（organizationCode）
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @return OrganizationSingleRespDto
     */
    public function getOrganization($option = array())
    {
        // 组装请求
        $varGet = array(
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-organization", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量获取组织机构详情
     * @summary 批量获取组织机构详情
     * @description 批量获取组织机构详情
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> organizationCodeList 必须，组织 Code（organizationCode）列表
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @return OrganizationListRespDto
     */
    public function getOrganizationsBatch($option = array())
    {
        // 组装请求
        $varGet = array(
            "organizationCodeList" => Util\Tool::getOrDefault($option, "organizationCodeList", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-organization-batch", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取组织机构列表
     * @summary 获取组织机构列表
     * @description 获取组织机构列表，支持分页。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param boolean fetchAll 可选，拉取所有，默认 false
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @return OrganizationPaginatedRespDto
     */
    public function listOrganizations($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "fetchAll" => Util\Tool::getOrDefault($option, "fetchAll", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-organizations", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 创建组织机构
     * @summary 创建组织机构
     * @description 创建组织机构，会创建一个只有一个节点的组织机构，可以选择组织描述信息、根节点自定义 ID、多语言等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
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
            "organizationName" => Util\Tool::getOrDefault($option, "organizationName", null),
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "description" => Util\Tool::getOrDefault($option, "description", null),
            "openDepartmentId" => Util\Tool::getOrDefault($option, "openDepartmentId", null),
            "i18n" => Util\Tool::getOrDefault($option, "i18n", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-organization", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改组织机构
     * @summary 修改组织机构
     * @description 通过组织 code，修改组织机构，可以选择部门描述、新组织 code、组织名称等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
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
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "description" => Util\Tool::getOrDefault($option, "description", null),
            "openDepartmentId" => Util\Tool::getOrDefault($option, "openDepartmentId", null),
            "leaderUserIds" => Util\Tool::getOrDefault($option, "leaderUserIds", null),
            "i18n" => Util\Tool::getOrDefault($option, "i18n", null),
            "organizationNewCode" => Util\Tool::getOrDefault($option, "organizationNewCode", null),
            "organizationName" => Util\Tool::getOrDefault($option, "organizationName", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-organization", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 删除组织机构
     * @summary 删除组织机构
     * @description 通过组织 code，删除组织机构树。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @return IsSuccessRespDto
     */
    public function deleteOrganization($option = array())
    {
        // 组装请求
        $varPost = array(
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-organization", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 搜索组织机构列表
     * @summary 搜索组织机构列表
     * @description 通过搜索关键词，搜索组织机构列表，支持分页。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string keywords 必须，搜索关键词，如组织机构名称
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @return OrganizationPaginatedRespDto
     */
    public function searchOrganizations($option = array())
    {
        // 组装请求
        $varGet = array(
            "keywords" => Util\Tool::getOrDefault($option, "keywords", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/search-organizations", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取部门信息
     * @summary 获取部门信息
     * @description 通过组织 code 以及 部门 ID 或 部门 code，获取部门信息，可以获取自定义数据。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 可选，部门 ID，根部门传 `root`。departmentId 和 departmentCode 必传其一。
     * @param string departmentCode 可选，部门 code。departmentId 和 departmentCode 必传其一。
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 'department_id'
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @return DepartmentSingleRespDto
     */
    public function getDepartment($option = array())
    {
        // 组装请求
        $varGet = array(
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "departmentId" => Util\Tool::getOrDefault($option, "departmentId", null),
            "departmentCode" => Util\Tool::getOrDefault($option, "departmentCode", null),
            "departmentIdType" => Util\Tool::getOrDefault($option, "departmentIdType", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-department", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 创建部门
     * @summary 创建部门
     * @description 通过组织 code、部门名称、父部门 ID，创建部门，可以设置多种参数。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string parentDepartmentId 必须，父部门 id
     * @param string name 必须，部门名称
     * @param string organizationCode 必须，组织 Code（organizationCode）
     * @param string openDepartmentId 可选，自定义部门 ID，用于存储自定义的 ID，默认 null
     * @param string description 可选，部门描述，默认 null
     * @param string code 可选，部门识别码，默认 null
     * @param boolean isVirtualNode 可选，是否是虚拟部门，默认 null
     * @param DepartmentI18nDto i18n 可选，多语言设置，默认 null
     * @param any customData 可选，部门的扩展字段数据，默认 null
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的父部门 ID 的类型，默认 null
     * @return DepartmentSingleRespDto
     */
    public function createDepartment($option = array())
    {
        // 组装请求
        $varPost = array(
            "parentDepartmentId" => Util\Tool::getOrDefault($option, "parentDepartmentId", null),
            "name" => Util\Tool::getOrDefault($option, "name", null),
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "openDepartmentId" => Util\Tool::getOrDefault($option, "openDepartmentId", null),
            "description" => Util\Tool::getOrDefault($option, "description", null),
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "isVirtualNode" => Util\Tool::getOrDefault($option, "isVirtualNode", null),
            "i18n" => Util\Tool::getOrDefault($option, "i18n", null),
            "customData" => Util\Tool::getOrDefault($option, "customData", null),
            "departmentIdType" => Util\Tool::getOrDefault($option, "departmentIdType", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-department", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改部门
     * @summary 修改部门
     * @description 通过组织 code、部门 ID，修改部门，可以设置多种参数。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string departmentId 必须，部门系统 ID（为 Authing 系统自动生成，不可修改）
     * @param string organizationCode 必须，组织 Code（organizationCode）
     * @param Array<string> leaderUserIds 可选，部门负责人 ID，默认 null
     * @param string description 可选，部门描述，默认 null
     * @param string code 可选，部门识别码，默认 null
     * @param DepartmentI18nDto i18n 可选，多语言设置，默认 null
     * @param string name 可选，部门名称，默认 null
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 null
     * @param string parentDepartmentId 可选，父部门 ID，默认 null
     * @param any customData 可选，自定义数据，传入的对象中的 key 必须先在用户池定义相关自定义字段，默认 null
     * @return DepartmentSingleRespDto
     */
    public function updateDepartment($option = array())
    {
        // 组装请求
        $varPost = array(
            "departmentId" => Util\Tool::getOrDefault($option, "departmentId", null),
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "leaderUserIds" => Util\Tool::getOrDefault($option, "leaderUserIds", null),
            "description" => Util\Tool::getOrDefault($option, "description", null),
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "i18n" => Util\Tool::getOrDefault($option, "i18n", null),
            "name" => Util\Tool::getOrDefault($option, "name", null),
            "departmentIdType" => Util\Tool::getOrDefault($option, "departmentIdType", null),
            "parentDepartmentId" => Util\Tool::getOrDefault($option, "parentDepartmentId", null),
            "customData" => Util\Tool::getOrDefault($option, "customData", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-department", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 删除部门
     * @summary 删除部门
     * @description 通过组织 code、部门 ID，删除部门。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string departmentId 必须，部门系统 ID（为 Authing 系统自动生成，不可修改）
     * @param string organizationCode 必须，组织 Code（organizationCode）
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 null
     * @return IsSuccessRespDto
     */
    public function deleteDepartment($option = array())
    {
        // 组装请求
        $varPost = array(
            "departmentId" => Util\Tool::getOrDefault($option, "departmentId", null),
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "departmentIdType" => Util\Tool::getOrDefault($option, "departmentIdType", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-department", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 搜索部门
     * @summary 搜索部门
     * @description 通过组织 code、搜索关键词，搜索部门，可以搜索组织名称等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string keywords 必须，搜索关键词，如组织名称等
     * @param string organizationCode 必须，组织 code
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 null
     * @return DepartmentListRespDto
     */
    public function searchDepartments($option = array())
    {
        // 组装请求
        $varPost = array(
            "keywords" => Util\Tool::getOrDefault($option, "keywords", null),
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/search-departments", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取子部门列表
     * @summary 获取子部门列表
     * @description 通过组织 code、部门 ID，获取子部门列表，可以选择获取自定义数据、虚拟组织等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 必须，需要获取的部门 ID
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 'department_id'
     * @param boolean excludeVirtualNode 可选，是否要排除虚拟组织，默认 false
     * @param boolean onlyVirtualNode 可选，是否只包含虚拟组织，默认 false
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @return DepartmentPaginatedRespDto
     */
    public function listChildrenDepartments($option = array())
    {
        // 组装请求
        $varGet = array(
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "departmentId" => Util\Tool::getOrDefault($option, "departmentId", null),
            "departmentIdType" => Util\Tool::getOrDefault($option, "departmentIdType", null),
            "excludeVirtualNode" => Util\Tool::getOrDefault($option, "excludeVirtualNode", null),
            "onlyVirtualNode" => Util\Tool::getOrDefault($option, "onlyVirtualNode", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-children-departments", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取部门成员列表
     * @summary 获取部门成员列表
     * @description 通过组织 code、部门 ID、排序，获取部门成员列表，支持分页，可以选择获取自定义数据、identities 等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 必须，部门 ID，根部门传 `root`
     * @param 'Default' | 'JoinDepartmentAt' sortBy 必须，排序依据，默认 'JoinDepartmentAt'
     * @param 'Asc' | 'Desc' orderBy 必须，增序还是倒序，默认 'Desc'
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 'department_id'
     * @param boolean includeChildrenDepartments 可选，是否包含子部门的成员，默认 false
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param boolean withIdentities 可选，是否获取 identities，默认 false
     * @param boolean withDepartmentIds 可选，是否获取部门 ID 列表，默认 false
     * @return UserPaginatedRespDto
     */
    public function listDepartmentMembers($option = array())
    {
        // 组装请求
        $varGet = array(
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "departmentId" => Util\Tool::getOrDefault($option, "departmentId", null),
            "sortBy" => Util\Tool::getOrDefault($option, "sortBy", null),
            "orderBy" => Util\Tool::getOrDefault($option, "orderBy", null),
            "departmentIdType" => Util\Tool::getOrDefault($option, "departmentIdType", null),
            "includeChildrenDepartments" => Util\Tool::getOrDefault($option, "includeChildrenDepartments", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
            "withIdentities" => Util\Tool::getOrDefault($option, "withIdentities", null),
            "withDepartmentIds" => Util\Tool::getOrDefault($option, "withDepartmentIds", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-department-members", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取部门直属成员 ID 列表
     * @summary 获取部门直属成员 ID 列表
     * @description 通过组织 code、部门 ID，获取部门直属成员 ID 列表。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 必须，部门 ID，根部门传 `root`
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 'department_id'
     * @return UserIdListRespDto
     */
    public function listDepartmentMemberIds($option = array())
    {
        // 组装请求
        $varGet = array(
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "departmentId" => Util\Tool::getOrDefault($option, "departmentId", null),
            "departmentIdType" => Util\Tool::getOrDefault($option, "departmentIdType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-department-member-ids", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 搜索部门下的成员
     * @summary 搜索部门下的成员
     * @description 通过组织 code、部门 ID、搜索关键词，搜索部门下的成员，支持分页，可以选择获取自定义数据、identities 等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 必须，部门 ID，根部门传 `root`
     * @param string keywords 必须，搜索关键词，如成员名称
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 'department_id'
     * @param boolean includeChildrenDepartments 可选，是否包含子部门的成员，默认 false
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @param boolean withIdentities 可选，是否获取 identities，默认 false
     * @param boolean withDepartmentIds 可选，是否获取部门 ID 列表，默认 false
     * @return UserPaginatedRespDto
     */
    public function searchDepartmentMembers($option = array())
    {
        // 组装请求
        $varGet = array(
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "departmentId" => Util\Tool::getOrDefault($option, "departmentId", null),
            "keywords" => Util\Tool::getOrDefault($option, "keywords", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "departmentIdType" => Util\Tool::getOrDefault($option, "departmentIdType", null),
            "includeChildrenDepartments" => Util\Tool::getOrDefault($option, "includeChildrenDepartments", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
            "withIdentities" => Util\Tool::getOrDefault($option, "withIdentities", null),
            "withDepartmentIds" => Util\Tool::getOrDefault($option, "withDepartmentIds", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/search-department-members", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 部门下添加成员
     * @summary 部门下添加成员
     * @description 通过部门 ID、组织 code，添加部门下成员。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
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
            "userIds" => Util\Tool::getOrDefault($option, "userIds", null),
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "departmentId" => Util\Tool::getOrDefault($option, "departmentId", null),
            "departmentIdType" => Util\Tool::getOrDefault($option, "departmentIdType", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/add-department-members", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 部门下删除成员
     * @summary 部门下删除成员
     * @description 通过部门 ID、组织 code，删除部门下成员。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
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
            "userIds" => Util\Tool::getOrDefault($option, "userIds", null),
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "departmentId" => Util\Tool::getOrDefault($option, "departmentId", null),
            "departmentIdType" => Util\Tool::getOrDefault($option, "departmentIdType", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/remove-department-members", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取父部门信息
     * @summary 获取父部门信息
     * @description 通过组织 code、部门 ID，获取父部门信息，可以选择获取自定义数据等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 必须，部门 ID
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 'department_id'
     * @param boolean withCustomData 可选，是否获取自定义数据，默认 false
     * @return DepartmentSingleRespDto
     */
    public function getParentDepartment($option = array())
    {
        // 组装请求
        $varGet = array(
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "departmentId" => Util\Tool::getOrDefault($option, "departmentId", null),
            "departmentIdType" => Util\Tool::getOrDefault($option, "departmentIdType", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-parent-department", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 判断用户是否在某个部门下
     * @summary 判断用户是否在某个部门下
     * @description 通过组织 code、部门 ID，判断用户是否在某个部门下，可以选择包含子部门。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string userId 必须，用户唯一标志，可以是用户 ID、用户名、邮箱、手机号、外部 ID、在外部身份源的 ID。
     * @param string organizationCode 必须，组织 code
     * @param string departmentId 必须，部门 ID，根部门传 `root`。departmentId 和 departmentCode 必传其一。
     * @param 'department_id' | 'open_department_id' departmentIdType 可选，此次调用中使用的部门 ID 的类型，默认 'department_id'
     * @param boolean includeChildrenDepartments 可选，是否包含子部门，默认 false
     * @return IsUserInDepartmentRespDto
     */
    public function isUserInDepartment($option = array())
    {
        // 组装请求
        $varGet = array(
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "departmentId" => Util\Tool::getOrDefault($option, "departmentId", null),
            "departmentIdType" => Util\Tool::getOrDefault($option, "departmentIdType", null),
            "includeChildrenDepartments" => Util\Tool::getOrDefault($option, "includeChildrenDepartments", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/is-user-in-department", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取分组详情
     * @summary 获取分组详情
     * @description 通过分组 code，获取分组详情。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，分组 code
     * @return GroupSingleRespDto
     */
    public function getGroup($option = array())
    {
        // 组装请求
        $varGet = array(
            "code" => Util\Tool::getOrDefault($option, "code", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-group", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取分组列表
     * @summary 获取分组列表
     * @description 获取分组列表，支持分页。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string keywords 可选，搜索分组 code 或分组名称
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @return GroupPaginatedRespDto
     */
    public function listGroups($option = array())
    {
        // 组装请求
        $varGet = array(
            "keywords" => Util\Tool::getOrDefault($option, "keywords", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-groups", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 创建分组
     * @summary 创建分组
     * @description 创建分组，一个分组必须包含分组名称与唯一标志符 code，且必须为一个合法的英文标志符，如 developers。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string description 必须，分组描述
     * @param string name 必须，分组名称
     * @param string code 必须，分组 code
     * @return GroupSingleRespDto
     */
    public function createGroup($option = array())
    {
        // 组装请求
        $varPost = array(
            "description" => Util\Tool::getOrDefault($option, "description", null),
            "name" => Util\Tool::getOrDefault($option, "name", null),
            "code" => Util\Tool::getOrDefault($option, "code", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-group", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量创建分组
     * @summary 批量创建分组
     * @description 批量创建分组，一个分组必须包含分组名称与唯一标志符 code，且必须为一个合法的英文标志符，如 developers。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<CreateGroupReqDto> list 必须，批量分组
     * @return GroupListRespDto
     */
    public function createGroupsBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getOrDefault($option, "list", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-groups-batch", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改分组
     * @summary 修改分组
     * @description 通过分组 code，修改分组，可以修改此分组的 code。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string description 必须，分组描述
     * @param string code 必须，分组 code
     * @param string name 可选，分组名称，默认 null
     * @param string newCode 可选，分组新的 code，默认 null
     * @return GroupSingleRespDto
     */
    public function updateGroup($option = array())
    {
        // 组装请求
        $varPost = array(
            "description" => Util\Tool::getOrDefault($option, "description", null),
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "name" => Util\Tool::getOrDefault($option, "name", null),
            "newCode" => Util\Tool::getOrDefault($option, "newCode", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-group", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量删除分组
     * @summary 批量删除分组
     * @description 通过分组 code，批量删除分组。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> codeList 必须，分组 code 列表
     * @return IsSuccessRespDto
     */
    public function deleteGroupsBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "codeList" => Util\Tool::getOrDefault($option, "codeList", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-groups-batch", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 添加分组成员
     * @summary 添加分组成员
     * @description 添加分组成员，成员以用户 ID 数组形式传递。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> userIds 必须，用户 ID 数组
     * @param string code 必须，分组 code
     * @return IsSuccessRespDto
     */
    public function addGroupMembers($option = array())
    {
        // 组装请求
        $varPost = array(
            "userIds" => Util\Tool::getOrDefault($option, "userIds", null),
            "code" => Util\Tool::getOrDefault($option, "code", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/add-group-members", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量移除分组成员
     * @summary 批量移除分组成员
     * @description 批量移除分组成员，成员以用户 ID 数组形式传递。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> userIds 必须，用户 ID 数组
     * @param string code 必须，分组 code
     * @return IsSuccessRespDto
     */
    public function removeGroupMembers($option = array())
    {
        // 组装请求
        $varPost = array(
            "userIds" => Util\Tool::getOrDefault($option, "userIds", null),
            "code" => Util\Tool::getOrDefault($option, "code", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/remove-group-members", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取分组成员列表
     * @summary 获取分组成员列表
     * @description 通过分组 code，获取分组成员列表，支持分页，可以获取自定义数据、identities、部门 ID 列表。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
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
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
            "withIdentities" => Util\Tool::getOrDefault($option, "withIdentities", null),
            "withDepartmentIds" => Util\Tool::getOrDefault($option, "withDepartmentIds", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-group-members", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取分组被授权的资源列表
     * @summary 获取分组被授权的资源列表
     * @description 通过分组 code，获取分组被授权的资源列表，可以通过资源类型、权限分组 code 筛选。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，分组 code
     * @param string namespace 可选，所属权限分组的 code
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' | 'UI' resourceType 可选，资源类型
     * @return AuthorizedResourceListRespDto
     */
    public function getGroupAuthorizedResources($option = array())
    {
        // 组装请求
        $varGet = array(
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
            "resourceType" => Util\Tool::getOrDefault($option, "resourceType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-group-authorized-resources", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取角色详情
     * @summary 获取角色详情
     * @description 通过权限分组内角色 code，获取角色详情。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组内角色的唯一标识符
     * @param string namespace 可选，所属权限分组的 code
     * @return RoleSingleRespDto
     */
    public function getRole($option = array())
    {
        // 组装请求
        $varGet = array(
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-role", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 分配角色
     * @summary 分配角色
     * @description 通过权限分组内角色 code，分配角色，被分配者可以是用户或部门。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<TargetDto> targets 必须，目标对象
     * @param string code 必须，权限分组内角色的唯一标识符
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsSuccessRespDto
     */
    public function assignRole($option = array())
    {
        // 组装请求
        $varPost = array(
            "targets" => Util\Tool::getOrDefault($option, "targets", null),
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/assign-role", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 移除分配的角色
     * @summary 移除分配的角色
     * @description 通过权限分组内角色 code，移除分配的角色，被分配者可以是用户或部门。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<TargetDto> targets 必须，移除角色的目标
     * @param string code 必须，权限分组内角色的唯一标识符
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsSuccessRespDto
     */
    public function revokeRole($option = array())
    {
        // 组装请求
        $varPost = array(
            "targets" => Util\Tool::getOrDefault($option, "targets", null),
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/revoke-role", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取角色被授权的资源列表
     * @summary 获取角色被授权的资源列表
     * @description 通过权限分组内角色 code，获取角色被授权的资源列表。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组内角色的唯一标识符
     * @param string namespace 可选，所属权限分组的 code
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' | 'UI' resourceType 可选，资源类型，如 数据、API、按钮、菜单
     * @return RoleAuthorizedResourcePaginatedRespDto
     */
    public function getRoleAuthorizedResources($option = array())
    {
        // 组装请求
        $varGet = array(
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
            "resourceType" => Util\Tool::getOrDefault($option, "resourceType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-role-authorized-resources", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取角色成员列表
     * @summary 获取角色成员列表
     * @description 通过权限分组内内角色 code，获取角色成员列表，支持分页，可以选择或获取自定义数据、identities 等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
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
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "withCustomData" => Util\Tool::getOrDefault($option, "withCustomData", null),
            "withIdentities" => Util\Tool::getOrDefault($option, "withIdentities", null),
            "withDepartmentIds" => Util\Tool::getOrDefault($option, "withDepartmentIds", null),
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-role-members", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取角色的部门列表
     * @summary 获取角色的部门列表
     * @description 通过权限分组内角色 code，获取角色的部门列表，支持分页。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
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
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-role-departments", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 创建角色
     * @summary 创建角色
     * @description 通过权限分组内角色 code，创建角色，可以选择权限分组、角色描述等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组内角色的唯一标识符
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @param string description 可选，角色描述，默认 null
     * @return RoleSingleRespDto
     */
    public function createRole($option = array())
    {
        // 组装请求
        $varPost = array(
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
            "description" => Util\Tool::getOrDefault($option, "description", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-role", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取角色列表
     * @summary 获取角色列表
     * @description 获取角色列表，支持分页。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string keywords 可选，用于根据角色的 code 进行模糊搜索，可选。
     * @param string namespace 可选，所属权限分组的 code，默认 'default'
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @return RolePaginatedRespDto
     */
    public function listRoles($option = array())
    {
        // 组装请求
        $varGet = array(
            "keywords" => Util\Tool::getOrDefault($option, "keywords", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-roles", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 删除角色
     * @summary 删除角色
     * @description 删除角色，可以批量删除。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> codeList 必须，角色 code 列表
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsSuccessRespDto
     */
    public function deleteRolesBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "codeList" => Util\Tool::getOrDefault($option, "codeList", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-roles-batch", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量创建角色
     * @summary 批量创建角色
     * @description 批量创建角色，可以选择权限分组、角色描述等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<RoleListItem> list 必须，角色列表
     * @return IsSuccessRespDto
     */
    public function createRolesBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getOrDefault($option, "list", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-roles-batch", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改角色
     * @summary 修改角色
     * @description 通过权限分组内角色新旧 code，修改角色，可以选择角色描述等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
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
            "newCode" => Util\Tool::getOrDefault($option, "newCode", null),
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
            "description" => Util\Tool::getOrDefault($option, "description", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-role", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取身份源列表
     * @summary 获取身份源列表
     * @description 获取身份源列表，可以指定 租户 ID 筛选。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string tenantId 可选，租户 ID
     * @param string appId 可选，应用 ID
     * @return ExtIdpListPaginatedRespDto
     */
    public function listExtIdp($option = array())
    {
        // 组装请求
        $varGet = array(
            "tenantId" => Util\Tool::getOrDefault($option, "tenantId", null),
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-ext-idp", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取身份源详情
     * @summary 获取身份源详情
     * @description 通过 身份源 ID，获取身份源详情，可以指定 租户 ID 筛选。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string id 必须，身份源 ID
     * @param string tenantId 可选，租户 ID
     * @param string appId 可选，应用 ID
     * @param 'social' | 'enterprise' type 可选，身份源类型
     * @return ExtIdpDetailSingleRespDto
     */
    public function getExtIdp($option = array())
    {
        // 组装请求
        $varGet = array(
            "tenantId" => Util\Tool::getOrDefault($option, "tenantId", null),
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
            "id" => Util\Tool::getOrDefault($option, "id", null),
            "type" => Util\Tool::getOrDefault($option, "type", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-ext-idp", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 创建身份源
     * @summary 创建身份源
     * @description 创建身份源，可以设置身份源名称、连接类型、租户 ID 等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'oidc' | 'oauth2' | 'saml' | 'ldap' | 'ad' | 'cas' | 'azure-ad' | 'wechat' | 'google' | 'qq' | 'wechatwork' | 'dingtalk' | 'weibo' | 'github' | 'alipay' | 'apple' | 'baidu' | 'lark' | 'gitlab' | 'twitter' | 'facebook' | 'slack' | 'linkedin' | 'yidun' | 'qingcloud' | 'gitee' | 'instagram' | 'welink' type 必须，身份源连接类型
     * @param string name 必须，身份源名称
     * @param string tenantId 可选，租户 ID，默认 null
     * @return ExtIdpSingleRespDto
     */
    public function createExtIdp($option = array())
    {
        // 组装请求
        $varPost = array(
            "type" => Util\Tool::getOrDefault($option, "type", null),
            "name" => Util\Tool::getOrDefault($option, "name", null),
            "tenantId" => Util\Tool::getOrDefault($option, "tenantId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-ext-idp", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 更新身份源配置
     * @summary 更新身份源配置
     * @description 更新身份源配置，可以设置身份源 ID 与 名称。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string id 必须，身份源 ID
     * @param string name 必须，名称
     * @return ExtIdpSingleRespDto
     */
    public function updateExtIdp($option = array())
    {
        // 组装请求
        $varPost = array(
            "id" => Util\Tool::getOrDefault($option, "id", null),
            "name" => Util\Tool::getOrDefault($option, "name", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-ext-idp", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 删除身份源
     * @summary 删除身份源
     * @description 通过身份源 ID，删除身份源。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string id 必须，身份源 ID
     * @return IsSuccessRespDto
     */
    public function deleteExtIdp($option = array())
    {
        // 组装请求
        $varPost = array(
            "id" => Util\Tool::getOrDefault($option, "id", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-ext-idp", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 在某个已有身份源下创建新连接
     * @summary 在某个已有身份源下创建新连接
     * @description 在某个已有身份源下创建新连接，可以设置身份源图标、是否只支持登录等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param any fields 必须，连接的自定义配置信息
     * @param string displayName 必须，连接在登录页的显示名称
     * @param string identifier 必须，身份源连接标识
     * @param 'oidc' | 'oauth' | 'saml' | 'ldap' | 'ad' | 'cas' | 'azure-ad' | 'alipay' | 'facebook' | 'twitter' | 'google:mobile' | 'google' | 'wechat:pc' | 'wechat:mobile' | 'wechat:webpage-authorization' | 'wechatmp-qrcode' | 'wechat:miniprogram:default' | 'wechat:miniprogram:qrconnect' | 'wechat:miniprogram:app-launch' | 'github' | 'qq' | 'wechatwork:corp:qrconnect' | 'wechatwork:agency:qrconnect' | 'wechatwork:service-provider:qrconnect' | 'wechatwork:mobile' | 'wechatwork:agency:mobile' | 'dingtalk' | 'dingtalk:provider' | 'weibo' | 'apple' | 'apple:web' | 'baidu' | 'lark-internal' | 'lark-public' | 'gitlab' | 'linkedin' | 'slack' | 'yidun' | 'qingcloud' | 'gitee' | 'instagram' | 'welink' | 'ad-kerberos' type 必须，身份源连接类型
     * @param string extIdpId 必须，身份源连接 ID
     * @param boolean loginOnly 可选，是否只支持登录，默认 null
     * @param string logo 可选，身份源图标，默认 null
     * @return ExtIdpConnDetailSingleRespDto
     */
    public function createExtIdpConn($option = array())
    {
        // 组装请求
        $varPost = array(
            "fields" => Util\Tool::getOrDefault($option, "fields", null),
            "displayName" => Util\Tool::getOrDefault($option, "displayName", null),
            "identifier" => Util\Tool::getOrDefault($option, "identifier", null),
            "type" => Util\Tool::getOrDefault($option, "type", null),
            "extIdpId" => Util\Tool::getOrDefault($option, "extIdpId", null),
            "loginOnly" => Util\Tool::getOrDefault($option, "loginOnly", null),
            "logo" => Util\Tool::getOrDefault($option, "logo", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-ext-idp-conn", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 更新身份源连接
     * @summary 更新身份源连接
     * @description 更新身份源连接，可以设置身份源图标、是否只支持登录等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
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
            "fields" => Util\Tool::getOrDefault($option, "fields", null),
            "displayName" => Util\Tool::getOrDefault($option, "displayName", null),
            "id" => Util\Tool::getOrDefault($option, "id", null),
            "logo" => Util\Tool::getOrDefault($option, "logo", null),
            "loginOnly" => Util\Tool::getOrDefault($option, "loginOnly", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-ext-idp-conn", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 删除身份源连接
     * @summary 删除身份源连接
     * @description 通过身份源连接 ID，删除身份源连接。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string id 必须，身份源连接 ID
     * @return IsSuccessRespDto
     */
    public function deleteExtIdpConn($option = array())
    {
        // 组装请求
        $varPost = array(
            "id" => Util\Tool::getOrDefault($option, "id", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-ext-idp-conn", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 身份源连接开关
     * @summary 身份源连接开关
     * @description 身份源连接开关，可以打开或关闭身份源连接。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string appId 必须，应用 ID
     * @param boolean enabled 必须，是否开启身份源连接
     * @param string id 必须，身份源连接 ID
     * @param string tenantId 可选，租户 ID，默认 null
     * @param Array<string> appIds 可选，应用 ID 列表，默认 null
     * @return IsSuccessRespDto
     */
    public function changeExtIdpConnState($option = array())
    {
        // 组装请求
        $varPost = array(
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
            "enabled" => Util\Tool::getOrDefault($option, "enabled", null),
            "id" => Util\Tool::getOrDefault($option, "id", null),
            "tenantId" => Util\Tool::getOrDefault($option, "tenantId", null),
            "appIds" => Util\Tool::getOrDefault($option, "appIds", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/change-ext-idp-conn-state", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 租户关联身份源
     * @summary 租户关联身份源
     * @description 租户可以关联或取消关联身份源连接。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param boolean association 必须，是否关联身份源
     * @param string id 必须，身份源连接 ID
     * @param string tenantId 可选，租户 ID，默认 null
     * @return IsSuccessRespDto
     */
    public function changeExtIdpConnAssociationState($option = array())
    {
        // 组装请求
        $varPost = array(
            "association" => Util\Tool::getOrDefault($option, "association", null),
            "id" => Util\Tool::getOrDefault($option, "id", null),
            "tenantId" => Util\Tool::getOrDefault($option, "tenantId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/change-ext-idp-conn-association-state", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 租户控制台获取身份源列表
     * @summary 租户控制台获取身份源列表
     * @description 在租户控制台内获取身份源列表，可以根据 应用 ID 筛选。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string tenantId 可选，租户 ID
     * @param string appId 可选，应用 ID
     * @param 'social' | 'enterprise' type 可选，身份源类型
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @return ExtIdpListPaginatedRespDto
     */
    public function listTenantExtIdp($option = array())
    {
        // 组装请求
        $varGet = array(
            "tenantId" => Util\Tool::getOrDefault($option, "tenantId", null),
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
            "type" => Util\Tool::getOrDefault($option, "type", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-tenant-ext-idp", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 身份源下应用的连接详情
     * @summary 身份源下应用的连接详情
     * @description 在身份源详情页获取应用的连接情况
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string id 必须，身份源 ID
     * @param string tenantId 可选，租户 ID
     * @param string appId 可选，应用 ID
     * @param 'social' | 'enterprise' type 可选，身份源类型
     * @return ExtIdpListPaginatedRespDto
     */
    public function extIdpConnStateByApps($option = array())
    {
        // 组装请求
        $varGet = array(
            "tenantId" => Util\Tool::getOrDefault($option, "tenantId", null),
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
            "id" => Util\Tool::getOrDefault($option, "id", null),
            "type" => Util\Tool::getOrDefault($option, "type", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/ext-idp-conn-apps", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户内置字段列表
     * @summary 获取用户内置字段列表
     * @description 获取用户内置的字段列表
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return CustomFieldListRespDto
     */
    public function getUserBaseFields($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-user-base-fields", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改用户内置字段配置
     * @summary 修改用户内置字段配置
     * @description 修改用户内置字段配置，内置字段不允许修改数据类型、唯一性。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<SetUserBaseFieldDto> list 必须，自定义字段列表
     * @return CustomFieldListRespDto
     */
    public function setUserBaseFields($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getOrDefault($option, "list", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/set-user-base-fields", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取自定义字段列表
     * @summary 获取自定义字段列表
     * @description 通过主体类型，获取用户、部门或角色的自定义字段列表。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'USER' | 'ROLE' | 'GROUP' | 'DEPARTMENT' targetType 必须，目标对象类型：
     * - `USER`: 用户
     * - `ROLE`: 角色
     * - `GROUP`: 分组
     * - `DEPARTMENT`: 部门
     * ;该接口暂不支持分组(GROUP)
     * @return CustomFieldListRespDto
     */
    public function getCustomFields($option = array())
    {
        // 组装请求
        $varGet = array(
            "targetType" => Util\Tool::getOrDefault($option, "targetType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-custom-fields", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 创建/修改自定义字段定义
     * @summary 创建/修改自定义字段定义
     * @description 创建/修改用户、部门或角色自定义字段定义，如果传入的 key 不存在则创建，存在则更新。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<SetCustomFieldDto> list 必须，自定义字段列表
     * @return CustomFieldListRespDto
     */
    public function setCustomFields($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getOrDefault($option, "list", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/set-custom-fields", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 设置自定义字段的值
     * @summary 设置自定义字段的值
     * @description 给用户、角色或部门设置自定义字段的值，如果存在则更新，不存在则创建。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<SetCustomDataDto> list 必须，自定义数据列表
     * @param string targetIdentifier 必须，目标对象的唯一标志符：
     * - 如果是用户，为用户的 ID，如 `6343b98b7cfxxx9366e9b7c`
     * - 如果是角色，为角色的 code，如 `admin`
     * - 如果是分组，为分组的 code，如 `developer`
     * - 如果是部门，为部门的 ID，如 `6343bafc019xxxx889206c4c`
     *
     * @param 'USER' | 'ROLE' | 'GROUP' | 'DEPARTMENT' targetType 必须，目标对象类型：
     * - `USER`: 用户
     * - `ROLE`: 角色
     * - `GROUP`: 分组
     * - `DEPARTMENT`: 部门
     *
     * @param string namespace 可选，所属权限分组的 code，当 target_type 为角色的时候需要填写，否则可以忽略，默认 null
     * @return IsSuccessRespDto
     */
    public function setCustomData($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getOrDefault($option, "list", null),
            "targetIdentifier" => Util\Tool::getOrDefault($option, "targetIdentifier", null),
            "targetType" => Util\Tool::getOrDefault($option, "targetType", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/set-custom-data", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户、分组、角色、组织机构的自定义字段值
     * @summary 获取用户、分组、角色、组织机构的自定义字段值
     * @description 通过筛选条件，获取用户、分组、角色、组织机构的自定义字段值。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'USER' | 'ROLE' | 'GROUP' | 'DEPARTMENT' targetType 必须，目标对象类型：
     * - `USER`: 用户
     * - `ROLE`: 角色
     * - `GROUP`: 分组
     * - `DEPARTMENT`: 部门
     *
     * @param string targetIdentifier 必须，目标对象的唯一标志符：
     * - 如果是用户，为用户的 ID，如 `6343b98b7cfxxx9366e9b7c`
     * - 如果是角色，为角色的 code，如 `admin`
     * - 如果是分组，为分组的 code，如 `developer`
     * - 如果是部门，为部门的 ID，如 `6343bafc019xxxx889206c4c`
     *
     * @param string namespace 可选，所属权限分组的 code，当 targetType 为角色的时候需要填写，否则可以忽略
     * @return GetCustomDataRespDto
     */
    public function getCustomData($option = array())
    {
        // 组装请求
        $varGet = array(
            "targetType" => Util\Tool::getOrDefault($option, "targetType", null),
            "targetIdentifier" => Util\Tool::getOrDefault($option, "targetIdentifier", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-custom-data", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 创建资源
     * @summary 创建资源
     * @description 创建资源，可以设置资源的描述、定义的操作类型、URL 标识等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' | 'UI' type 必须，资源类型，如数据、API、按钮、菜单
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
            "type" => Util\Tool::getOrDefault($option, "type", null),
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "description" => Util\Tool::getOrDefault($option, "description", null),
            "actions" => Util\Tool::getOrDefault($option, "actions", null),
            "apiIdentifier" => Util\Tool::getOrDefault($option, "apiIdentifier", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-resource", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量创建资源
     * @summary 批量创建资源
     * @description 批量创建资源，可以设置资源的描述、定义的操作类型、URL 标识等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<CreateResourceBatchItemDto> list 必须，资源列表
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsSuccessRespDto
     */
    public function createResourcesBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getOrDefault($option, "list", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-resources-batch", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取资源详情
     * @summary 获取资源详情
     * @description 根据筛选条件，获取资源详情。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，资源唯一标志符
     * @param string namespace 可选，所属权限分组的 code
     * @return ResourceRespDto
     */
    public function getResource($option = array())
    {
        // 组装请求
        $varGet = array(
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-resource", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量获取资源详情
     * @summary 批量获取资源详情
     * @description 根据筛选条件，批量获取资源详情。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> codeList 必须，资源 code 列表，批量可以使用逗号分隔
     * @param string namespace 可选，所属权限分组的 code
     * @return ResourceListRespDto
     */
    public function getResourcesBatch($option = array())
    {
        // 组装请求
        $varGet = array(
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
            "codeList" => Util\Tool::getOrDefault($option, "codeList", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-resources-batch", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 分页获取资源列表
     * @summary 分页获取资源列表
     * @description 根据筛选条件，分页获取资源详情列表。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string namespace 可选，所属权限分组的 code
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' | 'UI' type 可选，资源类型
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @return ResourcePaginatedRespDto
     */
    public function listResources($option = array())
    {
        // 组装请求
        $varGet = array(
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
            "type" => Util\Tool::getOrDefault($option, "type", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-resources", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改资源
     * @summary 修改资源
     * @description 修改资源，可以设置资源的描述、定义的操作类型、URL 标识等。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，资源唯一标志符
     * @param string description 可选，资源描述，默认 null
     * @param Array<ResourceAction> actions 可选，资源定义的操作类型，默认 null
     * @param string apiIdentifier 可选，API 资源的 URL 标识，默认 null
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' | 'UI' type 可选，资源类型，如数据、API、按钮、菜单，默认 null
     * @return ResourceRespDto
     */
    public function updateResource($option = array())
    {
        // 组装请求
        $varPost = array(
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "description" => Util\Tool::getOrDefault($option, "description", null),
            "actions" => Util\Tool::getOrDefault($option, "actions", null),
            "apiIdentifier" => Util\Tool::getOrDefault($option, "apiIdentifier", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
            "type" => Util\Tool::getOrDefault($option, "type", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-resource", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 删除资源
     * @summary 删除资源
     * @description 通过资源唯一标志符以及所属权限分组，删除资源。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，资源唯一标志符
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsSuccessRespDto
     */
    public function deleteResource($option = array())
    {
        // 组装请求
        $varPost = array(
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-resource", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量删除资源
     * @summary 批量删除资源
     * @description 通过资源唯一标志符以及所属权限分组，批量删除资源
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> codeList 必须，资源 code 列表
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsSuccessRespDto
     */
    public function deleteResourcesBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "codeList" => Util\Tool::getOrDefault($option, "codeList", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-resources-batch", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 关联/取消关联应用资源到租户
     * @summary 关联/取消关联应用资源到租户
     * @description 通过资源唯一标识以及权限分组，关联或取消关联资源到租户
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string appId 必须，应用 ID
     * @param boolean association 必须，是否关联应用资源
     * @param string code 必须，资源 Code
     * @param string tenantId 可选，租户 ID，默认 null
     * @return IsSuccessRespDto
     */
    public function associateTenantResource($option = array())
    {
        // 组装请求
        $varPost = array(
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
            "association" => Util\Tool::getOrDefault($option, "association", null),
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "tenantId" => Util\Tool::getOrDefault($option, "tenantId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/associate-tenant-resource", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 创建权限分组
     * @summary 创建权限分组
     * @description 创建权限分组，可以设置分组名称与描述信息。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组唯一标志符
     * @param string name 可选，权限分组名称，默认 null
     * @param string description 可选，权限分组描述信息，默认 null
     * @return NamespaceRespDto
     */
    public function createNamespace($option = array())
    {
        // 组装请求
        $varPost = array(
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "name" => Util\Tool::getOrDefault($option, "name", null),
            "description" => Util\Tool::getOrDefault($option, "description", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-namespace", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量创建权限分组
     * @summary 批量创建权限分组
     * @description 批量创建权限分组，可以分别设置分组名称与描述信息。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<CreateNamespacesBatchItemDto> list 必须，权限分组列表
     * @return IsSuccessRespDto
     */
    public function createNamespacesBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getOrDefault($option, "list", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-namespaces-batch", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取权限分组详情
     * @summary 获取权限分组详情
     * @description 通过权限分组唯一标志符，获取权限分组详情。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组唯一标志符
     * @return NamespaceRespDto
     */
    public function getNamespace($option = array())
    {
        // 组装请求
        $varGet = array(
            "code" => Util\Tool::getOrDefault($option, "code", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-namespace", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量获取权限分组详情
     * @summary 批量获取权限分组详情
     * @description 分别通过权限分组唯一标志符，批量获取权限分组详情。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> codeList 必须，资源 code 列表，批量可以使用逗号分隔
     * @return NamespaceListRespDto
     */
    public function getNamespacesBatch($option = array())
    {
        // 组装请求
        $varGet = array(
            "codeList" => Util\Tool::getOrDefault($option, "codeList", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-namespaces-batch", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改权限分组信息
     * @summary 修改权限分组信息
     * @description 修改权限分组信息，可以修改名称、描述信息以及新的唯一标志符。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
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
            "code" => Util\Tool::getOrDefault($option, "code", null),
            "description" => Util\Tool::getOrDefault($option, "description", null),
            "name" => Util\Tool::getOrDefault($option, "name", null),
            "newCode" => Util\Tool::getOrDefault($option, "newCode", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-namespace", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 删除权限分组信息
     * @summary 删除权限分组信息
     * @description 通过权限分组唯一标志符，删除权限分组信息。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string code 必须，权限分组唯一标志符
     * @return IsSuccessRespDto
     */
    public function deleteNamespace($option = array())
    {
        // 组装请求
        $varPost = array(
            "code" => Util\Tool::getOrDefault($option, "code", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-namespace", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 批量删除权限分组
     * @summary 批量删除权限分组
     * @description 分别通过权限分组唯一标志符，批量删除权限分组。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> codeList 必须，权限分组 code 列表
     * @return IsSuccessRespDto
     */
    public function deleteNamespacesBatch($option = array())
    {
        // 组装请求
        $varPost = array(
            "codeList" => Util\Tool::getOrDefault($option, "codeList", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-namespaces-batch", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 授权资源
     * @summary 授权资源
     * @description 将一个/多个资源授权给用户、角色、分组、组织机构等主体，且可以分别指定不同的操作权限。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<AuthorizeResourceItem> list 必须，授权资源列表
     * @param string namespace 可选，所属权限分组的 code，默认 null
     * @return IsSuccessRespDto
     */
    public function authorizeResources($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getOrDefault($option, "list", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/authorize-resources", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取某个主体被授权的资源列表
     * @summary 获取某个主体被授权的资源列表
     * @description 根据筛选条件，获取某个主体被授权的资源列表。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'USER' | 'ROLE' | 'GROUP' | 'DEPARTMENT' targetType 必须，目标对象类型：
     * - `USER`: 用户
     * - `ROLE`: 角色
     * - `GROUP`: 分组
     * - `DEPARTMENT`: 部门
     *
     * @param string targetIdentifier 必须，目标对象的唯一标志符：
     * - 如果是用户，为用户的 ID，如 `6343b98b7cfxxx9366e9b7c`
     * - 如果是角色，为角色的 code，如 `admin`
     * - 如果是分组，为分组的 code，如 `developer`
     * - 如果是部门，为部门的 ID，如 `6343bafc019xxxx889206c4c`
     *
     * @param string namespace 可选，所属权限分组的 code
     * @param 'DATA' | 'API' | 'MENU' | 'BUTTON' | 'UI' resourceType 可选，限定资源类型，如数据、API、按钮、菜单
     * @param Array<string> resourceList 可选，限定查询的资源列表，如果指定，只会返回所指定的资源列表。
     * @param boolean withDenied 可选，是否获取被拒绝的资源，默认 false
     * @return AuthorizedResourcePaginatedRespDto
     */
    public function getAuthorizedResources($option = array())
    {
        // 组装请求
        $varGet = array(
            "targetType" => Util\Tool::getOrDefault($option, "targetType", null),
            "targetIdentifier" => Util\Tool::getOrDefault($option, "targetIdentifier", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
            "resourceType" => Util\Tool::getOrDefault($option, "resourceType", null),
            "resourceList" => Util\Tool::getOrDefault($option, "resourceList", null),
            "withDenied" => Util\Tool::getOrDefault($option, "withDenied", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-authorized-resources", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 判断用户是否对某个资源的某个操作有权限
     * @summary 判断用户是否对某个资源的某个操作有权限
     * @description 判断用户是否对某个资源的某个操作有权限。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
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
            "action" => Util\Tool::getOrDefault($option, "action", null),
            "resource" => Util\Tool::getOrDefault($option, "resource", null),
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/is-action-allowed", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取资源被授权的主体
     * @summary 获取资源被授权的主体
     * @description 获取资源被授权的主体
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string resource 必须，资源
     * @param string namespace 可选，权限分组，默认 null
     * @param 'USER' | 'ROLE' | 'GROUP' | 'DEPARTMENT' targetType 可选，目标对象类型：
     * - `USER`: 用户
     * - `ROLE`: 角色
     * - `GROUP`: 分组
     * - `DEPARTMENT`: 部门
     * ，默认 null
     * @param number page 可选，当前页数，从 1 开始，默认 null
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 null
     * @return GetResourceAuthorizedTargetRespDto
     */
    public function getResourceAuthorizedTargets($option = array())
    {
        // 组装请求
        $varPost = array(
            "resource" => Util\Tool::getOrDefault($option, "resource", null),
            "namespace" => Util\Tool::getOrDefault($option, "namespace", null),
            "targetType" => Util\Tool::getOrDefault($option, "targetType", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/get-resource-authorized-targets", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取同步任务详情
     * @summary 获取同步任务详情
     * @description 获取同步任务详情
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number syncTaskId 必须，同步任务 ID
     * @return SyncTaskSingleRespDto
     */
    public function getSyncTask($option = array())
    {
        // 组装请求
        $varGet = array(
            "syncTaskId" => Util\Tool::getOrDefault($option, "syncTaskId", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-sync-task", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取同步任务列表
     * @summary 获取同步任务列表
     * @description 获取同步任务列表
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @return SyncTaskPaginatedRespDto
     */
    public function listSyncTasks($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-sync-tasks", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 创建同步任务
     * @summary 创建同步任务
     * @description 创建同步任务
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<SyncTaskFieldMapping> fieldMapping 必须，字段映射配置
     * @param 'manually' | 'timed' | 'automatic' syncTaskTrigger 必须，同步任务触发类型：
     * - `manually`: 手动触发执行
     * - `timed`: 定时触发
     * - `automatic`: 根据事件自动触发
     *
     * @param 'upstream' | 'downstream' syncTaskFlow 必须，同步任务数据流向：
     * - `upstream`: 作为上游，将数据同步到 Authing
     * - `downstream`: 作为下游，将 Authing 数据同步到此系统
     *
     * @param SyncTaskClientConfig clientConfig 必须，同步任务配置信息
     * @param 'lark' | 'lark-international' | 'wechatwork' | 'dingtalk' | 'active-directory' | 'italent' | 'maycur' | 'ldap' | 'moka' | 'fxiaoke' | 'scim' | 'xiaoshouyi' | 'kayang' | 'custom' syncTaskType 必须，同步任务类型:
     * - `lark`: 飞书
     * - `lark-international`: 飞书国际版
     * - `wechatwork`: 企业微信
     * - `dingtalk`: 钉钉
     * - `active-directory`: Windows AD
     * - `ldap`: LDAP
     * - `italent`: 北森
     * - `maycur`: 每刻报销
     * - `moka`: Moka
     * - `fxiaoke`: 纷享销客
     * - `xiaoshouyi`: 销售易
     * - `kayang`: 嘉扬 HR
     * - `scim`: 自定义同步源
     *
     * @param string syncTaskName 必须，同步任务名称
     * @param string organizationCode 可选，此同步任务绑定的组织机构。针对上游同步，需执行一次同步任务之后才会绑定组织机构；针对下游同步，创建同步任务的时候就需要设置。，默认 null
     * @param SyncTaskProvisioningScope provisioningScope 可选，同步范围，**只针对下游同步任务有效**。为空表示同步整个组织机构。，默认 null
     * @param SyncTaskTimedScheduler timedScheduler 可选，定时同步时间设置，默认 null
     * @return SyncTaskPaginatedRespDto
     */
    public function createSyncTask($option = array())
    {
        // 组装请求
        $varPost = array(
            "fieldMapping" => Util\Tool::getOrDefault($option, "fieldMapping", null),
            "syncTaskTrigger" => Util\Tool::getOrDefault($option, "syncTaskTrigger", null),
            "syncTaskFlow" => Util\Tool::getOrDefault($option, "syncTaskFlow", null),
            "clientConfig" => Util\Tool::getOrDefault($option, "clientConfig", null),
            "syncTaskType" => Util\Tool::getOrDefault($option, "syncTaskType", null),
            "syncTaskName" => Util\Tool::getOrDefault($option, "syncTaskName", null),
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "provisioningScope" => Util\Tool::getOrDefault($option, "provisioningScope", null),
            "timedScheduler" => Util\Tool::getOrDefault($option, "timedScheduler", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-sync-task", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改同步任务
     * @summary 修改同步任务
     * @description 修改同步任务
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number syncTaskId 必须，同步任务 ID
     * @param string syncTaskName 可选，同步任务名称，默认 null
     * @param 'lark' | 'lark-international' | 'wechatwork' | 'dingtalk' | 'active-directory' | 'italent' | 'maycur' | 'ldap' | 'moka' | 'fxiaoke' | 'scim' | 'xiaoshouyi' | 'kayang' | 'custom' syncTaskType 可选，同步任务类型:
     * - `lark`: 飞书
     * - `lark-international`: 飞书国际版
     * - `wechatwork`: 企业微信
     * - `dingtalk`: 钉钉
     * - `active-directory`: Windows AD
     * - `ldap`: LDAP
     * - `italent`: 北森
     * - `maycur`: 每刻报销
     * - `moka`: Moka
     * - `fxiaoke`: 纷享销客
     * - `xiaoshouyi`: 销售易
     * - `kayang`: 嘉扬 HR
     * - `scim`: 自定义同步源
     * ，默认 null
     * @param SyncTaskClientConfig clientConfig 可选，同步任务配置信息，默认 null
     * @param 'upstream' | 'downstream' syncTaskFlow 可选，同步任务数据流向：
     * - `upstream`: 作为上游，将数据同步到 Authing
     * - `downstream`: 作为下游，将 Authing 数据同步到此系统
     * ，默认 null
     * @param 'manually' | 'timed' | 'automatic' syncTaskTrigger 可选，同步任务触发类型：
     * - `manually`: 手动触发执行
     * - `timed`: 定时触发
     * - `automatic`: 根据事件自动触发
     * ，默认 null
     * @param string organizationCode 可选，此同步任务绑定的组织机构。针对上游同步，需执行一次同步任务之后才会绑定组织机构；针对下游同步，创建同步任务的时候就需要设置。，默认 null
     * @param SyncTaskProvisioningScope provisioningScope 可选，同步范围，**只针对下游同步任务有效**。为空表示同步整个组织机构。，默认 null
     * @param Array<SyncTaskFieldMapping> fieldMapping 可选，字段映射配置，默认 null
     * @param SyncTaskTimedScheduler timedScheduler 可选，定时同步时间设置，默认 null
     * @return SyncTaskPaginatedRespDto
     */
    public function updateSyncTask($option = array())
    {
        // 组装请求
        $varPost = array(
            "syncTaskId" => Util\Tool::getOrDefault($option, "syncTaskId", null),
            "syncTaskName" => Util\Tool::getOrDefault($option, "syncTaskName", null),
            "syncTaskType" => Util\Tool::getOrDefault($option, "syncTaskType", null),
            "clientConfig" => Util\Tool::getOrDefault($option, "clientConfig", null),
            "syncTaskFlow" => Util\Tool::getOrDefault($option, "syncTaskFlow", null),
            "syncTaskTrigger" => Util\Tool::getOrDefault($option, "syncTaskTrigger", null),
            "organizationCode" => Util\Tool::getOrDefault($option, "organizationCode", null),
            "provisioningScope" => Util\Tool::getOrDefault($option, "provisioningScope", null),
            "fieldMapping" => Util\Tool::getOrDefault($option, "fieldMapping", null),
            "timedScheduler" => Util\Tool::getOrDefault($option, "timedScheduler", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-sync-task", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 执行同步任务
     * @summary 执行同步任务
     * @description 执行同步任务
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number syncTaskId 必须，同步任务 ID
     * @return TriggerSyncTaskRespDto
     */
    public function triggerSyncTask($option = array())
    {
        // 组装请求
        $varPost = array(
            "syncTaskId" => Util\Tool::getOrDefault($option, "syncTaskId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/trigger-sync-task", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取同步作业详情
     * @summary 获取同步作业详情
     * @description 获取同步作业详情
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number syncJobId 必须，同步作业 ID
     * @return SyncJobSingleRespDto
     */
    public function getSyncJob($option = array())
    {
        // 组装请求
        $varGet = array(
            "syncJobId" => Util\Tool::getOrDefault($option, "syncJobId", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-sync-job", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取同步作业详情
     * @summary 获取同步作业详情
     * @description 获取同步作业详情
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number syncTaskId 必须，同步任务 ID
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param 'manually' | 'timed' | 'automatic' syncTrigger 可选，同步任务触发类型：
     * - `manually`: 手动触发执行
     * - `timed`: 定时触发
     * - `automatic`: 根据事件自动触发
     *
     * @return SyncJobPaginatedRespDto
     */
    public function listSyncJobs($option = array())
    {
        // 组装请求
        $varGet = array(
            "syncTaskId" => Util\Tool::getOrDefault($option, "syncTaskId", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "syncTrigger" => Util\Tool::getOrDefault($option, "syncTrigger", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-sync-jobs", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取同步作业详情
     * @summary 获取同步作业详情
     * @description 获取同步作业详情
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number syncJobId 必须，同步作业 ID
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param boolean success 可选，根据是否操作成功进行筛选
     * @param 'CreateUser' | 'UpdateUser' | 'DeleteUser' | 'UpdateUserIdentifier' | 'ChangeUserDepartment' | 'CreateDepartment' | 'UpdateDepartment' | 'DeleteDepartment' | 'MoveDepartment' | 'UpdateDepartmentLeader' | 'CreateGroup' | 'UpdateGroup' | 'DeleteGroup' | 'Updateless' action 可选，根据操作类型进行筛选：
     * - `CreateUser`: 创建用户
     * - `UpdateUser`: 修改用户信息
     * - `DeleteUser`: 删除用户
     * - `UpdateUserIdentifier`: 修改用户唯一标志符
     * - `ChangeUserDepartment`: 修改用户部门
     * - `CreateDepartment`: 创建部门
     * - `UpdateDepartment`: 修改部门信息
     * - `DeleteDepartment`: 删除部门
     * - `MoveDepartment`: 移动部门
     * - `UpdateDepartmentLeader`: 同步部门负责人
     * - `CreateGroup`: 创建分组
     * - `UpdateGroup`: 修改分组
     * - `DeleteGroup`: 删除分组
     * - `Updateless`: 无更新
     *
     * @param 'DEPARTMENT' | 'USER' objectType 可选，操作对象类型:
     * - `department`: 部门
     * - `user`: 用户
     *
     * @return TriggerSyncTaskRespDto
     */
    public function listSyncJobLogs($option = array())
    {
        // 组装请求
        $varGet = array(
            "syncJobId" => Util\Tool::getOrDefault($option, "syncJobId", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "success" => Util\Tool::getOrDefault($option, "success", null),
            "action" => Util\Tool::getOrDefault($option, "action", null),
            "objectType" => Util\Tool::getOrDefault($option, "objectType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-sync-job-logs", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取同步风险操作列表
     * @summary 获取同步风险操作列表
     * @description 获取同步风险操作列表
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number syncTaskId 必须，同步任务 ID
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param Array<'PENDING' | 'SUCCESS' | 'FAILED' | 'CANCELED' | 'EXECUTING'> status 可选，根据执行状态筛选
     * @param Array<'DEPARTMENT' | 'USER'> objectType 可选，根据操作对象类型，默认获取所有类型的记录：
     * - `department`: 部门
     * - `user`: 用户
     *
     * @return SyncRiskOperationPaginatedRespDto
     */
    public function listSyncRiskOperations($option = array())
    {
        // 组装请求
        $varGet = array(
            "syncTaskId" => Util\Tool::getOrDefault($option, "syncTaskId", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "status" => Util\Tool::getOrDefault($option, "status", null),
            "objectType" => Util\Tool::getOrDefault($option, "objectType", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-sync-risk-operations", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 执行同步风险操作
     * @summary 执行同步风险操作
     * @description 执行同步风险操作
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<number> syncRiskOperationIds 必须，同步任务风险操作 ID
     * @return TriggerSyncRiskOperationsRespDto
     */
    public function triggerSyncRiskOperations($option = array())
    {
        // 组装请求
        $varPost = array(
            "syncRiskOperationIds" => Util\Tool::getOrDefault($option, "syncRiskOperationIds", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/trigger-sync-risk-operations", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 取消同步风险操作
     * @summary 取消同步风险操作
     * @description 取消同步风险操作
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<number> syncRiskOperationIds 必须，同步任务风险操作 ID
     * @return CancelSyncRiskOperationsRespDto
     */
    public function cancelSyncRiskOperation($option = array())
    {
        // 组装请求
        $varPost = array(
            "syncRiskOperationIds" => Util\Tool::getOrDefault($option, "syncRiskOperationIds", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/cancel-sync-risk-operation", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用户行为日志
     * @summary 获取用户行为日志
     * @description 可以选择请求 ID、客户端 IP、用户 ID、应用 ID、开始时间戳、请求是否成功、分页参数去获取用户行为日志
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string requestId 可选，请求 ID，默认 null
     * @param string clientIp 可选，客户端 IP，默认 null
     * @param string eventType 可选，事件类型，默认 null
     * @param string userId 可选，用户 ID，默认 null
     * @param string appId 可选，应用 ID，默认 null
     * @param number start 可选，开始时间戳，默认 null
     * @param number end 可选，结束时间戳，默认 null
     * @param boolean success 可选，请求是否成功，默认 null
     * @param ListWebhooksDto pagination 可选，分页，默认 null
     * @return UserActionLogRespDto
     */
    public function getUserActionLogs($option = array())
    {
        // 组装请求
        $varPost = array(
            "requestId" => Util\Tool::getOrDefault($option, "requestId", null),
            "clientIp" => Util\Tool::getOrDefault($option, "clientIp", null),
            "eventType" => Util\Tool::getOrDefault($option, "eventType", null),
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
            "start" => Util\Tool::getOrDefault($option, "start", null),
            "end" => Util\Tool::getOrDefault($option, "end", null),
            "success" => Util\Tool::getOrDefault($option, "success", null),
            "pagination" => Util\Tool::getOrDefault($option, "pagination", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/get-user-action-logs", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取管理员操作日志
     * @summary 获取管理员操作日志
     * @description 可以选择请求 ID、客户端 IP、操作类型、资源类型、管理员用户 ID、请求是否成功、开始时间戳、结束时间戳、分页来获取管理员操作日志接口
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string requestId 可选，请求 ID，默认 null
     * @param string clientIp 可选，客户端 IP，默认 null
     * @param string operationType 可选，操作类型，默认 null
     * @param string resourceType 可选，资源类型，默认 null
     * @param string userId 可选，管理员用户 ID，默认 null
     * @param boolean success 可选，请求是否成功，默认 null
     * @param number start 可选，开始时间戳，默认 null
     * @param number end 可选，结束时间戳，默认 null
     * @param ListWebhooksDto pagination 可选，分页，默认 null
     * @return AdminAuditLogRespDto
     */
    public function getAdminAuditLogs($option = array())
    {
        // 组装请求
        $varPost = array(
            "requestId" => Util\Tool::getOrDefault($option, "requestId", null),
            "clientIp" => Util\Tool::getOrDefault($option, "clientIp", null),
            "operationType" => Util\Tool::getOrDefault($option, "operationType", null),
            "resourceType" => Util\Tool::getOrDefault($option, "resourceType", null),
            "userId" => Util\Tool::getOrDefault($option, "userId", null),
            "success" => Util\Tool::getOrDefault($option, "success", null),
            "start" => Util\Tool::getOrDefault($option, "start", null),
            "end" => Util\Tool::getOrDefault($option, "end", null),
            "pagination" => Util\Tool::getOrDefault($option, "pagination", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/get-admin-audit-logs", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取邮件模版列表
     * @summary 获取邮件模版列表
     * @description 获取邮件模版列表
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return GetEmailTemplatesRespDto
     */
    public function getEmailTemplates($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-email-templates", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改邮件模版
     * @summary 修改邮件模版
     * @description 修改邮件模版
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string content 必须，邮件内容模版
     * @param string sender 必须，邮件发件人名称
     * @param string subject 必须，邮件主题
     * @param string name 必须，邮件模版名称
     * @param boolean customizeEnabled 必须，是否启用自定义模版
     * @param 'WELCOME_EMAIL' | 'FIRST_CREATED_USER' | 'REGISTER_VERIFY_CODE' | 'LOGIN_VERIFY_CODE' | 'MFA_VERIFY_CODE' | 'INFORMATION_COMPLETION_VERIFY_CODE' | 'FIRST_EMAIL_LOGIN_VERIFY' | 'CONSOLE_CONDUCTED_VERIFY' | 'USER_PASSWORD_UPDATE_REMIND' | 'ADMIN_RESET_USER_PASSWORD_NOTIFICATION' | 'USER_PASSWORD_RESET_NOTIFICATION' | 'RESET_PASSWORD_VERIFY_CODE' | 'SELF_UNLOCKING_VERIFY_CODE' | 'EMAIL_BIND_VERIFY_CODE' | 'EMAIL_UNBIND_VERIFY_CODE' type 必须，模版类型:
     * - `WELCOME_EMAIL`: 欢迎邮件
     * - `FIRST_CREATED_USER`: 首次创建用户通知
     * - `REGISTER_VERIFY_CODE`: 注册验证码
     * - `LOGIN_VERIFY_CODE`: 登录验证码
     * - `MFA_VERIFY_CODE`: MFA 验证码
     * - `INFORMATION_COMPLETION_VERIFY_CODE`: 注册信息补全验证码
     * - `FIRST_EMAIL_LOGIN_VERIFY`: 首次邮箱登录验证
     * - `CONSOLE_CONDUCTED_VERIFY`: 在控制台发起邮件验证
     * - `USER_PASSWORD_UPDATE_REMIND`: 用户到期提醒
     * - `ADMIN_RESET_USER_PASSWORD_NOTIFICATION`: 管理员重置用户密码成功通知
     * - `USER_PASSWORD_RESET_NOTIFICATION`: 用户密码重置成功通知
     * - `RESET_PASSWORD_VERIFY_CODE`: 重置密码验证码
     * - `SELF_UNLOCKING_VERIFY_CODE`: 自助解锁验证码
     * - `EMAIL_BIND_VERIFY_CODE`: 绑定邮箱验证码
     * - `EMAIL_UNBIND_VERIFY_CODE`: 解绑邮箱验证码
     *
     * @param number expiresIn 可选，验证码/邮件有效时间，只有验证类邮件才有有效时间。，默认 null
     * @param string redirectTo 可选，完成邮件验证之后跳转到的地址，只针对 `FIRST_EMAIL_LOGIN_VERIFY` 和 `CONSOLE_CONDUCTED_VERIFY` 类型的模版有效。，默认 null
     * @param 'handlebar' | 'ejs' tplEngine 可选，模版渲染引擎。Authing 邮件模版目前支持两种渲染引擎：
     * - `handlebar`: 详细使用方法请见：[handlebars 官方文档](https://handlebarsjs.com/)
     * - `ejs`: 详细使用方法请见：[ejs 官方文档](https://ejs.co/)
     *
     * 默认将使用 `handlerbar` 作为膜拜渲染引擎。
     * ，默认 null
     * @return EmailTemplateSingleItemRespDto
     */
    public function updateEmailTemplate($option = array())
    {
        // 组装请求
        $varPost = array(
            "content" => Util\Tool::getOrDefault($option, "content", null),
            "sender" => Util\Tool::getOrDefault($option, "sender", null),
            "subject" => Util\Tool::getOrDefault($option, "subject", null),
            "name" => Util\Tool::getOrDefault($option, "name", null),
            "customizeEnabled" => Util\Tool::getOrDefault($option, "customizeEnabled", null),
            "type" => Util\Tool::getOrDefault($option, "type", null),
            "expiresIn" => Util\Tool::getOrDefault($option, "expiresIn", null),
            "redirectTo" => Util\Tool::getOrDefault($option, "redirectTo", null),
            "tplEngine" => Util\Tool::getOrDefault($option, "tplEngine", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-email-template", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 预览邮件模版
     * @summary 预览邮件模版
     * @description 预览邮件模版
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'WELCOME_EMAIL' | 'FIRST_CREATED_USER' | 'REGISTER_VERIFY_CODE' | 'LOGIN_VERIFY_CODE' | 'MFA_VERIFY_CODE' | 'INFORMATION_COMPLETION_VERIFY_CODE' | 'FIRST_EMAIL_LOGIN_VERIFY' | 'CONSOLE_CONDUCTED_VERIFY' | 'USER_PASSWORD_UPDATE_REMIND' | 'ADMIN_RESET_USER_PASSWORD_NOTIFICATION' | 'USER_PASSWORD_RESET_NOTIFICATION' | 'RESET_PASSWORD_VERIFY_CODE' | 'SELF_UNLOCKING_VERIFY_CODE' | 'EMAIL_BIND_VERIFY_CODE' | 'EMAIL_UNBIND_VERIFY_CODE' type 必须，模版类型:
     * - `WELCOME_EMAIL`: 欢迎邮件
     * - `FIRST_CREATED_USER`: 首次创建用户通知
     * - `REGISTER_VERIFY_CODE`: 注册验证码
     * - `LOGIN_VERIFY_CODE`: 登录验证码
     * - `MFA_VERIFY_CODE`: MFA 验证码
     * - `INFORMATION_COMPLETION_VERIFY_CODE`: 注册信息补全验证码
     * - `FIRST_EMAIL_LOGIN_VERIFY`: 首次邮箱登录验证
     * - `CONSOLE_CONDUCTED_VERIFY`: 在控制台发起邮件验证
     * - `USER_PASSWORD_UPDATE_REMIND`: 用户到期提醒
     * - `ADMIN_RESET_USER_PASSWORD_NOTIFICATION`: 管理员重置用户密码成功通知
     * - `USER_PASSWORD_RESET_NOTIFICATION`: 用户密码重置成功通知
     * - `RESET_PASSWORD_VERIFY_CODE`: 重置密码验证码
     * - `SELF_UNLOCKING_VERIFY_CODE`: 自助解锁验证码
     * - `EMAIL_BIND_VERIFY_CODE`: 绑定邮箱验证码
     * - `EMAIL_UNBIND_VERIFY_CODE`: 解绑邮箱验证码
     *
     * @param string content 可选，邮件内容模版，可选，如果不传默认使用用户池配置的邮件模版进行渲染。，默认 null
     * @param string subject 可选，邮件主题，可选，如果不传默认使用用户池配置的邮件模版进行渲染。，默认 null
     * @param string sender 可选，邮件发件人名称，可选，如果不传默认使用用户池配置的邮件模版进行渲染。，默认 null
     * @param number expiresIn 可选，验证码/邮件有效时间，只有验证类邮件才有有效时间。可选，如果不传默认使用用户池配置的邮件模版进行渲染。，默认 null
     * @param 'handlebar' | 'ejs' tplEngine 可选，模版渲染引擎。Authing 邮件模版目前支持两种渲染引擎：
     * - `handlebar`: 详细使用方法请见：[handlebars 官方文档](https://handlebarsjs.com/)
     * - `ejs`: 详细使用方法请见：[ejs 官方文档](https://ejs.co/)
     *
     * 默认将使用 `handlerbar` 作为膜拜渲染引擎。
     * ，默认 null
     * @return PreviewEmailTemplateRespDto
     */
    public function previewEmailTemplate($option = array())
    {
        // 组装请求
        $varPost = array(
            "type" => Util\Tool::getOrDefault($option, "type", null),
            "content" => Util\Tool::getOrDefault($option, "content", null),
            "subject" => Util\Tool::getOrDefault($option, "subject", null),
            "sender" => Util\Tool::getOrDefault($option, "sender", null),
            "expiresIn" => Util\Tool::getOrDefault($option, "expiresIn", null),
            "tplEngine" => Util\Tool::getOrDefault($option, "tplEngine", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/preview-email-template", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取第三方邮件服务配置
     * @summary 获取第三方邮件服务配置
     * @description 获取第三方邮件服务配置
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return EmailProviderRespDto
     */
    public function getEmailProvider($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-email-provider", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 配置第三方邮件服务
     * @summary 配置第三方邮件服务
     * @description 配置第三方邮件服务
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'ali' | 'qq' | 'sendgrid' | 'custom' type 必须，第三方邮件服务商类型:
     * - `custom`: 自定义 SMTP 邮件服务
     * - `ali`: [阿里企业邮箱](https://www.ali-exmail.cn/Land/)
     * - `qq`: [腾讯企业邮箱](https://work.weixin.qq.com/mail/)
     * - `sendgrid`: [SendGrid 邮件服务](https://sendgrid.com/)
     *
     * @param boolean enabled 必须，是否启用，如果不启用，将默认使用 Authing 内置的邮件服务
     * @param SMTPEmailProviderConfigInput smtpConfig 可选，SMTP 邮件服务配置，默认 null
     * @param SendGridEmailProviderConfigInput sendGridConfig 可选，SendGrid 邮件服务配置，默认 null
     * @param AliExmailEmailProviderConfigInput aliExmailConfig 可选，阿里企业邮件服务配置，默认 null
     * @param TencentExmailEmailProviderConfigInput tencentExmailConfig 可选，腾讯企业邮件服务配置，默认 null
     * @return EmailProviderRespDto
     */
    public function configEmailProvider($option = array())
    {
        // 组装请求
        $varPost = array(
            "type" => Util\Tool::getOrDefault($option, "type", null),
            "enabled" => Util\Tool::getOrDefault($option, "enabled", null),
            "smtpConfig" => Util\Tool::getOrDefault($option, "smtpConfig", null),
            "sendGridConfig" => Util\Tool::getOrDefault($option, "sendGridConfig", null),
            "aliExmailConfig" => Util\Tool::getOrDefault($option, "aliExmailConfig", null),
            "tencentExmailConfig" => Util\Tool::getOrDefault($option, "tencentExmailConfig", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/config-email-provider", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取应用详情
     * @summary 获取应用详情
     * @description 通过应用 ID，获取应用详情。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string appId 必须，应用 ID
     * @return ApplicationSingleRespDto
     */
    public function getApplication($option = array())
    {
        // 组装请求
        $varGet = array(
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-application", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取应用列表
     * @summary 获取应用列表
     * @description 获取应用列表
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param boolean isIntegrateApp 可选，是否为集成应用，默认 false
     * @param boolean isSelfBuiltApp 可选，是否为自建应用，默认 false
     * @param boolean ssoEnabled 可选，是否开启单点登录，默认 false
     * @param string keywords 可选，模糊搜索字符串
     * @return ApplicationPaginatedRespDto
     */
    public function listApplications($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "isIntegrateApp" => Util\Tool::getOrDefault($option, "isIntegrateApp", null),
            "isSelfBuiltApp" => Util\Tool::getOrDefault($option, "isSelfBuiltApp", null),
            "ssoEnabled" => Util\Tool::getOrDefault($option, "ssoEnabled", null),
            "keywords" => Util\Tool::getOrDefault($option, "keywords", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-applications", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取应用简单信息
     * @summary 获取应用简单信息
     * @description 通过应用 ID，获取应用简单信息。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string appId 必须，应用 ID
     * @return ApplicationSimpleInfoSingleRespDto
     */
    public function getApplicationSimpleInfo($option = array())
    {
        // 组装请求
        $varGet = array(
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-application-simple-info", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取应用简单信息列表
     * @summary 获取应用简单信息列表
     * @description 获取应用简单信息列表
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @param boolean isIntegrateApp 可选，是否为集成应用，默认 false
     * @param boolean isSelfBuiltApp 可选，是否为自建应用，默认 false
     * @param boolean ssoEnabled 可选，是否开启单点登录，默认 false
     * @param string keywords 可选，模糊搜索字符串
     * @return ApplicationSimpleInfoPaginatedRespDto
     */
    public function listApplicationSimpleInfo($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
            "isIntegrateApp" => Util\Tool::getOrDefault($option, "isIntegrateApp", null),
            "isSelfBuiltApp" => Util\Tool::getOrDefault($option, "isSelfBuiltApp", null),
            "ssoEnabled" => Util\Tool::getOrDefault($option, "ssoEnabled", null),
            "keywords" => Util\Tool::getOrDefault($option, "keywords", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-application-simple-info", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 创建应用
     * @summary 创建应用
     * @description 创建应用
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string appName 必须，应用名称
     * @param string template 可选，集成应用模版类型，**集成应用必填**。集成应用只需要填 `template` 和 `templateData` 两个字段，其他的字段将被忽略。，默认 null
     * @param string templateData 可选，集成应用配置信息，**集成应用必填**。，默认 null
     * @param string appIdentifier 可选，应用唯一标志，**自建应用必填**。，默认 null
     * @param string appLogo 可选，应用 Logo 链接，默认 null
     * @param string appDescription 可选，应用描述信息，默认 null
     * @param 'web' | 'spa' | 'native' | 'api' appType 可选，应用类型，默认 null
     * @param 'oidc' | 'oauth' | 'saml' | 'cas' | 'asa' defaultProtocol 可选，默认应用协议类型，默认 null
     * @param Array<string> redirectUris 可选，应用登录回调地址，默认 null
     * @param Array<string> logoutRedirectUris 可选，应用退出登录回调地址，默认 null
     * @param string initLoginUri 可选，发起登录地址：在 Authing 应用详情点击「体验登录」或在应用面板点击该应用图标时，会跳转到此 URL，默认为 Authing 登录页。，默认 null
     * @param boolean ssoEnabled 可选，是否开启 SSO 单点登录，默认 null
     * @param OIDCConfig oidcConfig 可选，OIDC 协议配置，默认 null
     * @param boolean samlProviderEnabled 可选，是否开启 SAML 身份提供商，默认 null
     * @param SamlIdpConfig samlConfig 可选，SAML 协议配置，默认 null
     * @param boolean oauthProviderEnabled 可选，是否开启 OAuth 身份提供商，默认 null
     * @param OauthIdpConfig oauthConfig 可选，OAuth2.0 协议配置。【重要提示】不再推荐使用 OAuth2.0，建议切换到 OIDC。，默认 null
     * @param boolean casProviderEnabled 可选，是否开启 CAS 身份提供商，默认 null
     * @param CasIdPConfig casConfig 可选，CAS 协议配置，默认 null
     * @param ApplicationLoginConfigInputDto loginConfig 可选，登录配置，默认 null
     * @param ApplicationRegisterConfigInputDto registerConfig 可选，注册配置，默认 null
     * @param ApplicationBrandingConfigInputDto brandingConfig 可选，品牌化配置，默认 null
     * @return ApplicationPaginatedRespDto
     */
    public function createApplication($option = array())
    {
        // 组装请求
        $varPost = array(
            "appName" => Util\Tool::getOrDefault($option, "appName", null),
            "template" => Util\Tool::getOrDefault($option, "template", null),
            "templateData" => Util\Tool::getOrDefault($option, "templateData", null),
            "appIdentifier" => Util\Tool::getOrDefault($option, "appIdentifier", null),
            "appLogo" => Util\Tool::getOrDefault($option, "appLogo", null),
            "appDescription" => Util\Tool::getOrDefault($option, "appDescription", null),
            "appType" => Util\Tool::getOrDefault($option, "appType", null),
            "defaultProtocol" => Util\Tool::getOrDefault($option, "defaultProtocol", null),
            "redirectUris" => Util\Tool::getOrDefault($option, "redirectUris", null),
            "logoutRedirectUris" => Util\Tool::getOrDefault($option, "logoutRedirectUris", null),
            "initLoginUri" => Util\Tool::getOrDefault($option, "initLoginUri", null),
            "ssoEnabled" => Util\Tool::getOrDefault($option, "ssoEnabled", null),
            "oidcConfig" => Util\Tool::getOrDefault($option, "oidcConfig", null),
            "samlProviderEnabled" => Util\Tool::getOrDefault($option, "samlProviderEnabled", null),
            "samlConfig" => Util\Tool::getOrDefault($option, "samlConfig", null),
            "oauthProviderEnabled" => Util\Tool::getOrDefault($option, "oauthProviderEnabled", null),
            "oauthConfig" => Util\Tool::getOrDefault($option, "oauthConfig", null),
            "casProviderEnabled" => Util\Tool::getOrDefault($option, "casProviderEnabled", null),
            "casConfig" => Util\Tool::getOrDefault($option, "casConfig", null),
            "loginConfig" => Util\Tool::getOrDefault($option, "loginConfig", null),
            "registerConfig" => Util\Tool::getOrDefault($option, "registerConfig", null),
            "brandingConfig" => Util\Tool::getOrDefault($option, "brandingConfig", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-application", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 删除应用
     * @summary 删除应用
     * @description 通过应用 ID，删除应用。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string appId 必须，应用 ID
     * @return IsSuccessRespDto
     */
    public function deleteApplication($option = array())
    {
        // 组装请求
        $varPost = array(
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-application", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取应用密钥
     * @summary 获取应用密钥
     * @description 获取应用密钥
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string appId 必须，应用 ID
     * @return GetApplicationSecretRespDto
     */
    public function getApplicationSecret($option = array())
    {
        // 组装请求
        $varGet = array(
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-application-secret", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 刷新应用密钥
     * @summary 刷新应用密钥
     * @description 刷新应用密钥
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string appId 必须，应用 ID
     * @return RefreshApplicationSecretRespDto
     */
    public function refreshApplicationSecret($option = array())
    {
        // 组装请求
        $varPost = array(
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/refresh-application-secret", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取应用当前登录用户
     * @summary 获取应用当前登录用户
     * @description 获取应用当前处于登录状态的用户
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string appId 必须，应用 ID
     * @param ListApplicationActiveUsersOptionsDto options 可选，可选项，默认 null
     * @return UserPaginatedRespDto
     */
    public function listApplicationActiveUsers($option = array())
    {
        // 组装请求
        $varPost = array(
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
            "options" => Util\Tool::getOrDefault($option, "options", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/list-application-active-users", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取应用默认访问授权策略
     * @summary 获取应用默认访问授权策略
     * @description 获取应用默认访问授权策略
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string appId 必须，应用 ID
     * @return GetApplicationPermissionStrategyRespDto
     */
    public function getApplicationPermissionStrategy($option = array())
    {
        // 组装请求
        $varGet = array(
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-application-permission-strategy", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 更新应用默认访问授权策略
     * @summary 更新应用默认访问授权策略
     * @description 更新应用默认访问授权策略
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'ALLOW_ALL' | 'DENY_ALL' permissionStrategy 必须，应用访问授权策略
     * @param string appId 必须，应用 ID
     * @return IsSuccessRespDto
     */
    public function updateApplicationPermissionStrategy($option = array())
    {
        // 组装请求
        $varPost = array(
            "permissionStrategy" => Util\Tool::getOrDefault($option, "permissionStrategy", null),
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-application-permission-strategy", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 授权应用访问权限
     * @summary 授权应用访问权限
     * @description 给用户、分组、组织或角色授权应用访问权限，如果用户、分组、组织或角色不存在，则跳过，进行下一步授权，不返回报错
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<ApplicationPermissionRecordItem> list 必须，授权主体列表，最多 10 条
     * @param string appId 必须，应用 ID
     * @return IsSuccessRespDto
     */
    public function authorizeApplicationAccess($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getOrDefault($option, "list", null),
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/authorize-application-access", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 删除应用访问授权记录
     * @summary 删除应用访问授权记录
     * @description 取消给用户、分组、组织或角色的应用访问权限授权,如果传入数据不存在，则返回数据不报错处理。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<DeleteApplicationPermissionRecordItem> list 必须，授权主体列表，最多 10 条
     * @param string appId 必须，应用 ID
     * @return IsSuccessRespDto
     */
    public function revokeApplicationAccess($option = array())
    {
        // 组装请求
        $varPost = array(
            "list" => Util\Tool::getOrDefault($option, "list", null),
            "appId" => Util\Tool::getOrDefault($option, "appId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/revoke-application-access", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 检测域名是否可用
     * @summary 检测域名是否可用
     * @description 检测域名是否可用于创建新应用或更新应用域名
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string domain 必须，域名
     * @return CheckDomainAvailableSecretRespDto
     */
    public function checkDomainAvailable($option = array())
    {
        // 组装请求
        $varPost = array(
            "domain" => Util\Tool::getOrDefault($option, "domain", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/check-domain-available", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取安全配置
     * @summary 获取安全配置
     * @description 无需传参获取安全配置
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return SecuritySettingsRespDto
     */
    public function getSecuritySettings($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-security-settings", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改安全配置
     * @summary 修改安全配置
     * @description 可选安全域、Authing Token 有效时间（秒）、验证码长度、验证码尝试次数、用户修改邮箱的安全策略、用户修改手机号的安全策略、Cookie 过期时间设置、是否禁止用户注册、频繁注册检测配置、验证码注册后是否要求用户设置密码、未验证的邮箱登录时是否禁止登录并发送认证邮件、用户自助解锁配置、Authing 登录页面是否开启登录账号选择、APP 扫码登录安全配置进行修改安全配置
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> allowedOrigins 可选，安全域（CORS），默认 null
     * @param number authingTokenExpiresIn 可选，Authing Token 有效时间（秒），默认 null
     * @param number verifyCodeLength 可选，验证码长度。包含短信验证码、邮件验证码和图形验证码。，默认 null
     * @param number verifyCodeMaxAttempts 可选，验证码尝试次数。在一个验证码有效周期内（默认为 60 s），用户输入验证码错误次数超过此阈值之后，将会导致当前验证码失效，需要重新发送。，默认 null
     * @param ChangeEmailStrategyDto changeEmailStrategy 可选，用户修改邮箱的安全策略，默认 null
     * @param ChangePhoneStrategyDto changePhoneStrategy 可选，用户修改手机号的安全策略，默认 null
     * @param CookieSettingsDto cookieSettings 可选，Cookie 过期时间设置，默认 null
     * @param boolean registerDisabled 可选，是否禁止用户注册，开启之后，用户将无法自主注册，只能管理员为其创建账号。针对 B2B 和 B2E 类型用户池，默认开启。，默认 null
     * @param RegisterAnomalyDetectionConfigDto registerAnomalyDetection 可选，频繁注册检测配置，默认 null
     * @param boolean completePasswordAfterPassCodeLogin 可选，验证码注册后是否要求用户设置密码（仅针对 Authing 登录页和 Guard 有效，不针对 API 调用）。，默认 null
     * @param LoginAnomalyDetectionConfigDto loginAnomalyDetection 可选，登录防暴破配置，默认 null
     * @param boolean loginRequireEmailVerified 可选，当使用邮箱登录时，未验证的邮箱登录时是否禁止登录并发送认证邮件。当用户收到邮件并完成验证之后，才能进行登录。，默认 null
     * @param SelfUnlockAccountConfigDto selfUnlockAccount 可选，用户自助解锁配置。注：只有绑定了手机号/邮箱的用户才可以自助解锁，默认 null
     * @param boolean enableLoginAccountSwitch 可选，Authing 登录页面是否开启登录账号选择，默认 null
     * @param QrcodeLoginStrategyDto qrcodeLoginStrategy 可选，APP 扫码登录安全配置，默认 null
     * @return SecuritySettingsRespDto
     */
    public function updateSecuritySettings($option = array())
    {
        // 组装请求
        $varPost = array(
            "allowedOrigins" => Util\Tool::getOrDefault($option, "allowedOrigins", null),
            "authingTokenExpiresIn" => Util\Tool::getOrDefault($option, "authingTokenExpiresIn", null),
            "verifyCodeLength" => Util\Tool::getOrDefault($option, "verifyCodeLength", null),
            "verifyCodeMaxAttempts" => Util\Tool::getOrDefault($option, "verifyCodeMaxAttempts", null),
            "changeEmailStrategy" => Util\Tool::getOrDefault($option, "changeEmailStrategy", null),
            "changePhoneStrategy" => Util\Tool::getOrDefault($option, "changePhoneStrategy", null),
            "cookieSettings" => Util\Tool::getOrDefault($option, "cookieSettings", null),
            "registerDisabled" => Util\Tool::getOrDefault($option, "registerDisabled", null),
            "registerAnomalyDetection" => Util\Tool::getOrDefault($option, "registerAnomalyDetection", null),
            "completePasswordAfterPassCodeLogin" => Util\Tool::getOrDefault($option, "completePasswordAfterPassCodeLogin", null),
            "loginAnomalyDetection" => Util\Tool::getOrDefault($option, "loginAnomalyDetection", null),
            "loginRequireEmailVerified" => Util\Tool::getOrDefault($option, "loginRequireEmailVerified", null),
            "selfUnlockAccount" => Util\Tool::getOrDefault($option, "selfUnlockAccount", null),
            "enableLoginAccountSwitch" => Util\Tool::getOrDefault($option, "enableLoginAccountSwitch", null),
            "qrcodeLoginStrategy" => Util\Tool::getOrDefault($option, "qrcodeLoginStrategy", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-security-settings", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取全局多因素认证配置
     * @summary 获取全局多因素认证配置
     * @description 无需传参获取全局多因素认证配置
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return MFASettingsRespDto
     */
    public function getGlobalMfaSettings($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-global-mfa-settings", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改全局多因素认证配置
     * @summary 修改全局多因素认证配置
     * @description 传入 MFA 认证因素列表进行开启,
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<'OTP' | 'SMS' | 'EMAIL' | 'FACE'> enabledFactors 必须，开启的 MFA 认证因素列表
     * @return MFASettingsRespDto
     */
    public function updateGlobalMfaSettings($option = array())
    {
        // 组装请求
        $varPost = array(
            "enabledFactors" => Util\Tool::getOrDefault($option, "enabledFactors", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-global-mfa-settings", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取套餐详情
     * @summary 获取套餐详情
     * @description 获取当前用户池套餐详情。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return CostGetCurrentPackageRespDto
     */
    public function getCurrentPackageInfo($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-current-package-info", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取用量详情
     * @summary 获取用量详情
     * @description 获取当前用户池用量详情。
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return CostGetCurrentUsageRespDto
     */
    public function getUsageInfo($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-usage-info", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取 MAU 使用记录
     * @summary 获取 MAU 使用记录
     * @description 获取当前用户池 MAU 使用记录
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string startTime 必须，起始时间（年月日）
     * @param string endTime 必须，截止时间（年月日）
     * @return CostGetMauPeriodUsageHistoryRespDto
     */
    public function getMauPeriodUsageHistory($option = array())
    {
        // 组装请求
        $varGet = array(
            "startTime" => Util\Tool::getOrDefault($option, "startTime", null),
            "endTime" => Util\Tool::getOrDefault($option, "endTime", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-mau-period-usage-history", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取所有权益
     * @summary 获取所有权益
     * @description 获取当前用户池所有权益
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return CostGetAllRightItemRespDto
     */
    public function getAllRightsItem($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-all-rights-items", null, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取订单列表
     * @summary 获取订单列表
     * @description 获取当前用户池订单列表
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @return CostGetOrdersRespDto
     */
    public function getOrders($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-orders", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取订单详情
     * @summary 获取订单详情
     * @description 获取当前用户池订单详情
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string orderNo 必须，订单号
     * @return CostGetOrderDetailRespDto
     */
    public function getOrderDetail($option = array())
    {
        // 组装请求
        $varGet = array(
            "orderNo" => Util\Tool::getOrDefault($option, "orderNo", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-order-detail", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取订单支付明细
     * @summary 获取订单支付明细
     * @description 获取当前用户池订单支付明细
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string orderNo 必须，订单号
     * @return CostGetOrderPayDetailRespDto
     */
    public function getOrderPayDetail($option = array())
    {
        // 组装请求
        $varGet = array(
            "orderNo" => Util\Tool::getOrDefault($option, "orderNo", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-order-pay-detail", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 创建 Pipeline 函数
     * @summary 创建 Pipeline 函数
     * @description 创建 Pipeline 函数
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string sourceCode 必须，函数源代码
     * @param 'PRE_REGISTER' | 'POST_REGISTER' | 'PRE_AUTHENTICATION' | 'POST_AUTHENTICATION' | 'PRE_OIDC_ID_TOKEN_ISSUED' | 'PRE_OIDC_ACCESS_TOKEN_ISSUED' | 'PRE_COMPLETE_USER_INFO' scene 必须，函数的触发场景：
     * - `PRE_REGISTER`: 注册前
     * - `POST_REGISTER`: 注册后
     * - `PRE_AUTHENTICATION`: 认证前
     * - `POST_AUTHENTICATION`: 认证后
     * - `PRE_OIDC_ID_TOKEN_ISSUED`: OIDC ID Token 签发前
     * - `PRE_OIDC_ACCESS_TOKEN_ISSUED`: OIDC Access Token 签发前
     * - `PRE_COMPLETE_USER_INFO`: 补全用户信息前
     *
     * @param string funcName 必须，函数名称
     * @param string funcDescription 可选，函数描述，默认 null
     * @param boolean isAsynchronous 可选，是否异步执行。设置为异步执行的函数不会阻塞整个流程的执行，适用于异步通知的场景，比如飞书群通知、钉钉群通知等。，默认 null
     * @param number timeout 可选，函数运行超时时间，要求必须为整数，最短为 1 秒，最长为 60 秒，默认为 3 秒。，默认 null
     * @param boolean terminateOnTimeout 可选，如果函数运行超时，是否终止整个流程，默认为否。，默认 null
     * @param boolean enabled 可选，是否启用此 Pipeline，默认 null
     * @return PipelineFunctionSingleRespDto
     */
    public function createPipelineFunction($option = array())
    {
        // 组装请求
        $varPost = array(
            "sourceCode" => Util\Tool::getOrDefault($option, "sourceCode", null),
            "scene" => Util\Tool::getOrDefault($option, "scene", null),
            "funcName" => Util\Tool::getOrDefault($option, "funcName", null),
            "funcDescription" => Util\Tool::getOrDefault($option, "funcDescription", null),
            "isAsynchronous" => Util\Tool::getOrDefault($option, "isAsynchronous", null),
            "timeout" => Util\Tool::getOrDefault($option, "timeout", null),
            "terminateOnTimeout" => Util\Tool::getOrDefault($option, "terminateOnTimeout", null),
            "enabled" => Util\Tool::getOrDefault($option, "enabled", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-pipeline-function", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取 Pipeline 函数详情
     * @summary 获取 Pipeline 函数详情
     * @description 获取 Pipeline 函数详情
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string funcId 必须，Pipeline 函数 ID
     * @return PipelineFunctionSingleRespDto
     */
    public function getPipelineFunction($option = array())
    {
        // 组装请求
        $varGet = array(
            "funcId" => Util\Tool::getOrDefault($option, "funcId", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-pipeline-function", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 重新上传 Pipeline 函数
     * @summary 重新上传 Pipeline 函数
     * @description 当 Pipeline 函数上传失败时，重新上传 Pipeline 函数
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string funcId 必须，Pipeline 函数 ID
     * @return PipelineFunctionSingleRespDto
     */
    public function reuploadPipelineFunction($option = array())
    {
        // 组装请求
        $varPost = array(
            "funcId" => Util\Tool::getOrDefault($option, "funcId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/reupload-pipeline-function", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改 Pipeline 函数
     * @summary 修改 Pipeline 函数
     * @description 修改 Pipeline 函数
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string funcId 必须，Pipeline 函数 ID
     * @param string funcName 可选，函数名称，默认 null
     * @param string funcDescription 可选，函数描述，默认 null
     * @param string sourceCode 可选，函数源代码。如果修改之后，函数会重新上传。，默认 null
     * @param boolean isAsynchronous 可选，是否异步执行。设置为异步执行的函数不会阻塞整个流程的执行，适用于异步通知的场景，比如飞书群通知、钉钉群通知等。，默认 null
     * @param number timeout 可选，函数运行超时时间，最短为 1 秒，最长为 60 秒，默认为 3 秒。，默认 null
     * @param boolean terminateOnTimeout 可选，如果函数运行超时，是否终止整个流程，默认为否。，默认 null
     * @param boolean enabled 可选，是否启用此 Pipeline，默认 null
     * @return PipelineFunctionSingleRespDto
     */
    public function updatePipelineFunction($option = array())
    {
        // 组装请求
        $varPost = array(
            "funcId" => Util\Tool::getOrDefault($option, "funcId", null),
            "funcName" => Util\Tool::getOrDefault($option, "funcName", null),
            "funcDescription" => Util\Tool::getOrDefault($option, "funcDescription", null),
            "sourceCode" => Util\Tool::getOrDefault($option, "sourceCode", null),
            "isAsynchronous" => Util\Tool::getOrDefault($option, "isAsynchronous", null),
            "timeout" => Util\Tool::getOrDefault($option, "timeout", null),
            "terminateOnTimeout" => Util\Tool::getOrDefault($option, "terminateOnTimeout", null),
            "enabled" => Util\Tool::getOrDefault($option, "enabled", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-pipeline-function", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改 Pipeline 函数顺序
     * @summary 修改 Pipeline 函数顺序
     * @description 修改 Pipeline 函数顺序
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> order 必须，新的排序方式，按照函数 ID 的先后顺序进行排列。
     * @param 'PRE_REGISTER' | 'POST_REGISTER' | 'PRE_AUTHENTICATION' | 'POST_AUTHENTICATION' | 'PRE_OIDC_ID_TOKEN_ISSUED' | 'PRE_OIDC_ACCESS_TOKEN_ISSUED' | 'PRE_COMPLETE_USER_INFO' scene 必须，函数的触发场景：
     * - `PRE_REGISTER`: 注册前
     * - `POST_REGISTER`: 注册后
     * - `PRE_AUTHENTICATION`: 认证前
     * - `POST_AUTHENTICATION`: 认证后
     * - `PRE_OIDC_ID_TOKEN_ISSUED`: OIDC ID Token 签发前
     * - `PRE_OIDC_ACCESS_TOKEN_ISSUED`: OIDC Access Token 签发前
     * - `PRE_COMPLETE_USER_INFO`: 补全用户信息前
     *
     * @return CommonResponseDto
     */
    public function updatePipelineOrder($option = array())
    {
        // 组装请求
        $varPost = array(
            "order" => Util\Tool::getOrDefault($option, "order", null),
            "scene" => Util\Tool::getOrDefault($option, "scene", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-pipeline-order", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 删除 Pipeline 函数
     * @summary 删除 Pipeline 函数
     * @description 删除 Pipeline 函数
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string funcId 必须，Pipeline 函数 ID
     * @return CommonResponseDto
     */
    public function deletePipelineFunction($option = array())
    {
        // 组装请求
        $varPost = array(
            "funcId" => Util\Tool::getOrDefault($option, "funcId", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-pipeline-function", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取 Pipeline 函数列表
     * @summary 获取 Pipeline 函数列表
     * @description 获取 Pipeline 函数列表
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'PRE_REGISTER' | 'POST_REGISTER' | 'PRE_AUTHENTICATION' | 'POST_AUTHENTICATION' | 'PRE_OIDC_ID_TOKEN_ISSUED' | 'PRE_OIDC_ACCESS_TOKEN_ISSUED' | 'PRE_COMPLETE_USER_INFO' scene 必须，通过函数的触发场景进行筛选（可选，默认返回所有）：
     * - `PRE_REGISTER`: 注册前
     * - `POST_REGISTER`: 注册后
     * - `PRE_AUTHENTICATION`: 认证前
     * - `POST_AUTHENTICATION`: 认证后
     * - `PRE_OIDC_ID_TOKEN_ISSUED`: OIDC ID Token 签发前
     * - `PRE_OIDC_ACCESS_TOKEN_ISSUED`: OIDC Access Token 签发前
     * - `PRE_COMPLETE_USER_INFO`: 补全用户信息前
     *
     * @return PipelineFunctionPaginatedRespDto
     */
    public function listPipelineFunctions($option = array())
    {
        // 组装请求
        $varGet = array(
            "scene" => Util\Tool::getOrDefault($option, "scene", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-pipeline-functions", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取 Pipeline 日志
     * @summary 获取 Pipeline 日志
     * @description 获取 Pipeline
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string funcId 必须，Pipeline 函数 ID
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @return PipelineFunctionPaginatedRespDto
     */
    public function getPipelineLogs($option = array())
    {
        // 组装请求
        $varGet = array(
            "funcId" => Util\Tool::getOrDefault($option, "funcId", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-pipeline-logs", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 创建 Webhook
     * @summary 创建 Webhook
     * @description 你需要指定 Webhoook 名称、Webhook 回调地址、请求数据格式、用户真实名称来创建 Webhook。还可选是否启用、请求密钥进行创建
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param 'application/json' | 'application/x-www-form-urlencoded' contentType 必须，请求数据格式
     * @param Array<'test' | 'register' | 'login' | 'mfa:verified' | 'kick' | 'user:created' | 'user:password-changed' | 'user:updated' | 'user:email-verified' | 'user:archived' | 'user:unarchived' | 'user:blocked' | 'user:unblocked' | 'user:deleted' | 'user:register-whitelist-added' | 'user:register-whitelist-deleted' | 'user:udv-changed' | 'user:link-account' | 'user:password-update-remind' | 'permission:revoke' | 'permission:add' | 'resource:created' | 'resource:delete' | 'resource:updated' | 'role:created' | 'role:updated' | 'role:deleted' | 'role:assigned' | 'role:unassigned' | 'role:udv-changed' | 'application:mfa:enabled' | 'application:mfa:disabled' | 'group:created' | 'group:updated' | 'group:deleted' | 'group:member-added' | 'group:member-removed' | 'organization:created' | 'organization:imported' | 'organization:deleted' | 'organization:node-added' | 'organization:node-updated' | 'organization:tree-updated' | 'organization:node-deleted' | 'organization:node-moved' | 'organization:member-added' | 'organization:member-removed' | 'organization:udv-changed' | 'privilege-namespace:created' | 'privilege-namespace:updated' | 'privilege-namespace:deleted' | 'user-pool:cooperator-added' | 'user-pool:cooperator-removed' | 'user-pool:secret-refreshed' | 'user-pool:updated' | 'user-pool:udf-added' | 'user-pool:udf-deleted' | 'user-pool:env-added' | 'user-pool:env-deleted' | 'user-pool:env-updated' | 'user-pool:launchpad-app-installed' | 'user-pool:launchpad-app-uninstalled' | 'application:created' | 'application:updated' | 'application:deleted' | 'application:secret-refreshed'> events 必须，用户真实名称，不具备唯一性。 示例值: 张三
     * @param string url 必须，Webhook 回调地址
     * @param string name 必须，Webhook 名称
     * @param boolean enabled 可选，是否启用，默认 null
     * @param string secret 可选，请求密钥，默认 null
     * @return CreateWebhookRespDto
     */
    public function createWebhook($option = array())
    {
        // 组装请求
        $varPost = array(
            "contentType" => Util\Tool::getOrDefault($option, "contentType", null),
            "events" => Util\Tool::getOrDefault($option, "events", null),
            "url" => Util\Tool::getOrDefault($option, "url", null),
            "name" => Util\Tool::getOrDefault($option, "name", null),
            "enabled" => Util\Tool::getOrDefault($option, "enabled", null),
            "secret" => Util\Tool::getOrDefault($option, "secret", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/create-webhook", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取 Webhook 列表
     * @summary 获取 Webhook 列表
     * @description 获取 Webhook 列表，可选页数、分页大小来获取
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param number page 可选，当前页数，从 1 开始，默认 1
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 10
     * @return GetWebhooksRespDto
     */
    public function listWebhooks($option = array())
    {
        // 组装请求
        $varGet = array(
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/list-webhooks", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 修改 Webhook 配置
     * @summary 修改 Webhook 配置
     * @description 需要指定 webhookId，可选 Webhoook 名称、Webhook 回调地址、请求数据格式、用户真实名称、是否启用、请求密钥参数进行修改 webhook
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string webhookId 必须，Webhook ID
     * @param string name 可选，Webhook 名称，默认 null
     * @param string url 可选，Webhook 回调地址，默认 null
     * @param Array<'test' | 'register' | 'login' | 'mfa:verified' | 'kick' | 'user:created' | 'user:password-changed' | 'user:updated' | 'user:email-verified' | 'user:archived' | 'user:unarchived' | 'user:blocked' | 'user:unblocked' | 'user:deleted' | 'user:register-whitelist-added' | 'user:register-whitelist-deleted' | 'user:udv-changed' | 'user:link-account' | 'user:password-update-remind' | 'permission:revoke' | 'permission:add' | 'resource:created' | 'resource:delete' | 'resource:updated' | 'role:created' | 'role:updated' | 'role:deleted' | 'role:assigned' | 'role:unassigned' | 'role:udv-changed' | 'application:mfa:enabled' | 'application:mfa:disabled' | 'group:created' | 'group:updated' | 'group:deleted' | 'group:member-added' | 'group:member-removed' | 'organization:created' | 'organization:imported' | 'organization:deleted' | 'organization:node-added' | 'organization:node-updated' | 'organization:tree-updated' | 'organization:node-deleted' | 'organization:node-moved' | 'organization:member-added' | 'organization:member-removed' | 'organization:udv-changed' | 'privilege-namespace:created' | 'privilege-namespace:updated' | 'privilege-namespace:deleted' | 'user-pool:cooperator-added' | 'user-pool:cooperator-removed' | 'user-pool:secret-refreshed' | 'user-pool:updated' | 'user-pool:udf-added' | 'user-pool:udf-deleted' | 'user-pool:env-added' | 'user-pool:env-deleted' | 'user-pool:env-updated' | 'user-pool:launchpad-app-installed' | 'user-pool:launchpad-app-uninstalled' | 'application:created' | 'application:updated' | 'application:deleted' | 'application:secret-refreshed'> events 可选，用户真实名称，不具备唯一性。 示例值: 张三，默认 null
     * @param 'application/json' | 'application/x-www-form-urlencoded' contentType 可选，请求数据格式，默认 null
     * @param boolean enabled 可选，是否启用，默认 null
     * @param string secret 可选，请求密钥，默认 null
     * @return UpdateWebhooksRespDto
     */
    public function updateWebhook($option = array())
    {
        // 组装请求
        $varPost = array(
            "webhookId" => Util\Tool::getOrDefault($option, "webhookId", null),
            "name" => Util\Tool::getOrDefault($option, "name", null),
            "url" => Util\Tool::getOrDefault($option, "url", null),
            "events" => Util\Tool::getOrDefault($option, "events", null),
            "contentType" => Util\Tool::getOrDefault($option, "contentType", null),
            "enabled" => Util\Tool::getOrDefault($option, "enabled", null),
            "secret" => Util\Tool::getOrDefault($option, "secret", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/update-webhook", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 删除 Webhook
     * @summary 删除 Webhook
     * @description 通过指定多个 webhookId,以数组的形式进行 webhook 的删除,如果 webhookId 不存在,不提示报错
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param Array<string> webhookIds 必须，webhookId 数组
     * @return DeleteWebhookRespDto
     */
    public function deleteWebhook($option = array())
    {
        // 组装请求
        $varPost = array(
            "webhookIds" => Util\Tool::getOrDefault($option, "webhookIds", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/delete-webhook", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取 Webhook 日志
     * @summary 获取 Webhook 日志
     * @description 通过指定 webhookId，可选 page 和 limit 来获取 webhook 日志,如果 webhookId 不存在,不返回报错信息
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string webhookId 必须，Webhook ID
     * @param number page 可选，当前页数，从 1 开始，默认 null
     * @param number limit 可选，每页数目，最大不能超过 50，默认为 10，默认 null
     * @return ListWebhookLogsRespDto
     */
    public function getWebhookLogs($option = array())
    {
        // 组装请求
        $varPost = array(
            "webhookId" => Util\Tool::getOrDefault($option, "webhookId", null),
            "page" => Util\Tool::getOrDefault($option, "page", null),
            "limit" => Util\Tool::getOrDefault($option, "limit", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/get-webhook-logs", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 手动触发 Webhook 执行
     * @summary 手动触发 Webhook 执行
     * @description 通过指定 webhookId，可选请求头和请求体进行手动触发 webhook 执行
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string webhookId 必须，Webhook ID
     * @param any requestHeaders 可选，请求头，默认 null
     * @param any requestBody 可选，请求体，默认 null
     * @return TriggerWebhookRespDto
     */
    public function triggerWebhook($option = array())
    {
        // 组装请求
        $varPost = array(
            "webhookId" => Util\Tool::getOrDefault($option, "webhookId", null),
            "requestHeaders" => Util\Tool::getOrDefault($option, "requestHeaders", null),
            "requestBody" => Util\Tool::getOrDefault($option, "requestBody", null),
        );
        // 发送请求
        $varRes = $this->request("POST", "/api/v3/trigger-webhook", null, $varPost);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取 Webhook 详情
     * @summary 获取 Webhook 详情
     * @description 根据指定的 webhookId 获取 webhook 详情
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @param string webhookId 必须，Webhook ID
     * @return GetWebhookRespDto
     */
    public function getWebhook($option = array())
    {
        // 组装请求
        $varGet = array(
            "webhookId" => Util\Tool::getOrDefault($option, "webhookId", null),
        );
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-webhook", $varGet, null);
        // 返回
        return $varRes["body"];
    }

    /**
     * 获取 Webhook 事件列表
     * @summary 获取 Webhook 事件列表
     * @description 返回事件列表和分类列表
     * @param array $option 用于传递参数，如 array("email" => "main@test.com")
     * @return WebhookEventListRespDto
     */
    public function getWebhookEventList($option = array())
    {
        // 发送请求
        $varRes = $this->request("GET", "/api/v3/get-webhook-event-list", null, null);
        // 返回
        return $varRes["body"];
    }

     /**
     * 初始化 Authing 事件订阅 websocket
     * 
     * @param string $eventCode
     * @param boolean $retry 
     * 
     * @return resource 
     */
    private function _initWebsocket($eventCode, $retry=false) {
        if (!isset($this->_socketClient) || $retry) {
            $this->_socketClient = new Client(new Version2X($this->_socketHost), null);
            $headers = [
                "authorization" => Util\Tool::buildAuthorization($this->_userPoolID, $this->_accessKeySecret, "websocket", $this->_socketHost)
            ];
            $this->_socketClient->initialize();
            $this->_socketClient->emit("register", $eventCode, $headers);
        }
    }

    /**
     * 重连 Authing 事件订阅 websocket
     * 
     * @param string $eventCode 
     */
    private function _reconnect($eventCode) {
        if (isset($this->_socketClient)) {
            if ($this->_retryTimes > 0) {
                $this->_retryTimes -= 1;
                $this->_socketClient->close();
                $this->_socketClient = null;
                sleep(2);
                $this->_initWebsocket($eventCode, true);
                echo "Authing 事件订阅 Websocket 服务第 ".(3 - $this->_retryTimes)." 次重连。\n";
            } else {
                throw new Exception("\nAuthing 事件订阅 Websocket 服务连接超时！\n");
            }
        }
    }

    /**
     * Authing 事件订阅方法
     * 
     * @param string $eventCode 订阅事件 Code
     * @param callable $callback 消息回调
     * @param callable $errCallback 错误回调
     * @param integer $delay 轮询延迟
     */
    public function sub($eventCode, $callback, $errCallback, $delay=10000) {
        if (!is_string($eventCode)) {
            throw new \TypeError("\n事件名只能为字符串！\n");
        }
        if (!is_callable($callback)) {
            throw new \TypeError("\n消息回调只能为函数！\n");
        }
        if (!$this->_socketHost) {
            echo "\n请先设置 Authing 事件订阅 Websocket !\n";
            return;
        }
    
        $this->_initWebsocket($eventCode);
        if (!isset($this->_eventBus[$eventCode])) {
            $this->_eventBus[$eventCode] = [];
        }
        array_push($this->_eventBus[$eventCode], [$callback, $errCallback]);
    
        while (true) {
            try {
                $this->_socketClient->keepAlive();
                $data = $this->_socketClient->read();
                if (isset($this->_eventBus[$eventCode])) {
                    foreach ($this->_eventBus[$eventCode] as list($cb, $_)) {
                        $cb($data);
                    }
                } else {
                    echo "未订阅的事件：".$eventCode."\n";
                }
            } catch (SocketException $e) {
                echo "与 Authing 的 ws 连接已断开！\n";
                $this->_reconnect($eventCode);
            }
            usleep($delay * 1000);
        }
    }
    
}