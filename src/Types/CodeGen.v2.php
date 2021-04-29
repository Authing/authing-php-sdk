<?php /** @noinspection PhpMultipleClassesDeclarationsInOneFile */

namespace Authing\Types;

class Query {
  /**
   * Required
   * 
   * @var bool
   * 
   */
  public $isActionAllowed;

  /**
   * Required
   * 
   * @var bool
   * 
   */
  public $isActionDenied;

  /**
   * Optional
   * 
   * @var PaginatedAuthorizedTargets
   * 
   */
  public $authorizedTargets;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $qiniuUptoken;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $isDomainAvaliable;

  /**
   * 获取社会化登录定义
   * Optional
   * 
   * @var SocialConnection
   * 
   */
  public $socialConnection;

  /**
   * 获取所有社会化登录定义
   * Required
   * 
   * @var SocialConnection[]
   * 
   */
  public $socialConnections;

  /**
   * 获取当前用户池的社会化登录配置
   * Required
   * 
   * @var SocialConnectionInstance
   * 
   */
  public $socialConnectionInstance;

  /**
   * 获取当前用户池的所有社会化登录配置
   * Required
   * 
   * @var SocialConnectionInstance[]
   * 
   */
  public $socialConnectionInstances;

  /**
   * Required
   * 
   * @var EmailTemplate[]
   * 
   */
  public $emailTemplates;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $previewEmail;

  /**
   * 获取函数模版
   * Required
   * 
   * @var string
   * 
   */
  public $templateCode;

  /**
   * Optional
   * 
   * @var Function
   * 
   */
  public $function;

  /**
   * Required
   * 
   * @var PaginatedFunctions
   * 
   */
  public $functions;

  /**
   * Optional
   * 
   * @var Group
   * 
   */
  public $group;

  /**
   * Required
   * 
   * @var PaginatedGroups
   * 
   */
  public $groups;

  /**
   * 查询 MFA 信息
   * Optional
   * 
   * @var Mfa
   * 
   */
  public $queryMfa;

  /**
   * Optional
   * 
   * @var Node
   * 
   */
  public $nodeById;

  /**
   * 通过 code 查询节点
   * Optional
   * 
   * @var Node
   * 
   */
  public $nodeByCode;

  /**
   * 查询组织机构详情
   * Required
   * 
   * @var Org
   * 
   */
  public $org;

  /**
   * 查询用户池组织机构列表
   * Required
   * 
   * @var PaginatedOrgs
   * 
   */
  public $orgs;

  /**
   * 查询子节点列表
   * Required
   * 
   * @var Node[]
   * 
   */
  public $childrenNodes;

  /**
   * Required
   * 
   * @var Node
   * 
   */
  public $rootNode;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $isRootNode;

  /**
   * Required
   * 
   * @var Node[]
   * 
   */
  public $searchNodes;

  /**
   * Required
   * 
   * @var CheckPasswordStrengthResult
   * 
   */
  public $checkPasswordStrength;

  /**
   * Optional
   * 
   * @var Policy
   * 
   */
  public $policy;

  /**
   * Required
   * 
   * @var PaginatedPolicies
   * 
   */
  public $policies;

  /**
   * Required
   * 
   * @var PaginatedPolicyAssignments
   * 
   */
  public $policyAssignments;

  /**
   * 获取一个对象被授权的资源列表
   * Optional
   * 
   * @var PaginatedAuthorizedResources
   * 
   */
  public $authorizedResources;

  /**
   * 通过 **code** 查询角色详情
   * Optional
   * 
   * @var Role
   * 
   */
  public $role;

  /**
   * 获取角色列表
   * Required
   * 
   * @var PaginatedRoles
   * 
   */
  public $roles;

  /**
   * 查询某个实体定义的自定义数据
   * Required
   * 
   * @var UserDefinedData[]
   * 
   */
  public $udv;

  /**
   * 查询用户池定义的自定义字段
   * Required
   * 
   * @var UserDefinedField[]
   * 
   */
  public $udf;

  /**
   * 批量查询多个对象的自定义数据
   * Required
   * 
   * @var UserDefinedDataMap[]
   * 
   */
  public $udfValueBatch;

  /**
   * Optional
   * 
   * @var User
   * 
   */
  public $user;

  /**
   * Required
   * 
   * @var User[]
   * 
   */
  public $userBatch;

  /**
   * Required
   * 
   * @var PaginatedUsers
   * 
   */
  public $users;

  /**
   * 已归档的用户列表
   * Required
   * 
   * @var PaginatedUsers
   * 
   */
  public $archivedUsers;

  /**
   * Required
   * 
   * @var PaginatedUsers
   * 
   */
  public $searchUser;

  /**
   * Optional
   * 
   * @var JWTTokenStatus
   * 
   */
  public $checkLoginStatus;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $isUserExists;

  /**
   * Optional
   * 
   * @var User
   * 
   */
  public $findUser;

  /**
   * 查询用户池详情
   * Required
   * 
   * @var UserPool
   * 
   */
  public $userpool;

  /**
   * 查询用户池列表
   * Required
   * 
   * @var PaginatedUserpool
   * 
   */
  public $userpools;

  /**
   * Required
   * 
   * @var UserPoolType[]
   * 
   */
  public $userpoolTypes;

  /**
   * 获取 accessToken ，如 SDK 初始化
   * Required
   * 
   * @var AccessTokenRes
   * 
   */
  public $accessToken;

  /**
   * 用户池注册白名单列表
   * Required
   * 
   * @var WhiteList[]
   * 
   */
  public $whitelist;
}

class ResourceType {
  const DATA = 'DATA';
  const API = 'API';
  const MENU = 'MENU';
  const UI = 'UI';
  const BUTTON = 'BUTTON';
}

class PolicyAssignmentTargetType {
  const USER = 'USER';
  const ROLE = 'ROLE';
  const GROUP = 'GROUP';
  const ORG = 'ORG';
  const AK_SK = 'AK_SK';
}

/**
 * AuthorizedTargetsActionsInput
 */
class AuthorizedTargetsActionsInput {
  /**
   * Required
   * 
   * @var Operator
   * 
   */
  public $op;

  /**
   * Required
   * 
   * @var string[]
   * 
   */
  public $list;

/**
 * @param $op Operator op
 * @param $list string[] list
 */

public function __construct($op, $list) {
$this->op = $op;
$this->list = $list;
}

}
    

class Operator {
  const AND = 'AND';
  const OR = 'OR';
}

class PaginatedAuthorizedTargets {
  /**
   * Optional
   * 
   * @var ResourcePermissionAssignment[]
   * 
   */
  public $list;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $totalCount;
}

class ResourcePermissionAssignment {
  /**
   * Optional
   * 
   * @var PolicyAssignmentTargetType
   * 
   */
  public $targetType;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $targetIdentifier;

  /**
   * Optional
   * 
   * @var string[]
   * 
   */
  public $actions;
}

class SocialConnection {
  /**
   * 社会化登录服务商唯一标志
   * Required
   * 
   * @var string
   * 
   */
  public $provider;

  /**
   * 名称
   * Required
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * logo
   * Required
   * 
   * @var string
   * 
   */
  public $logo;

  /**
   * 描述信息
   * Optional
   * 
   * @var string
   * 
   */
  public $description;

  /**
   * 表单字段
   * Optional
   * 
   * @var SocialConnectionField[]
   * 
   */
  public $fields;
}

class SocialConnectionField {
  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $key;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $label;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $type;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $placeholder;

  /**
   * Optional
   * 
   * @var SocialConnectionField[]
   * 
   */
  public $children;
}

class SocialConnectionInstance {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $provider;

  /**
   * Required
   * 
   * @var bool
   * 
   */
  public $enabled;

  /**
   * Optional
   * 
   * @var SocialConnectionInstanceField[]
   * 
   */
  public $fields;
}

class SocialConnectionInstanceField {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $key;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $value;
}

class EmailTemplate {
  /**
   * 邮件模版类型
   * Required
   * 
   * @var EmailTemplateType
   * 
   */
  public $type;

  /**
   * 模版名称
   * Required
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * 邮件主题
   * Required
   * 
   * @var string
   * 
   */
  public $subject;

  /**
   * 显示的邮件发送人
   * Required
   * 
   * @var string
   * 
   */
  public $sender;

  /**
   * 邮件模版内容
   * Required
   * 
   * @var string
   * 
   */
  public $content;

  /**
   * 重定向链接，操作成功后，用户将被重定向到此 URL。
   * Optional
   * 
   * @var string
   * 
   */
  public $redirectTo;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $hasURL;

  /**
   * 验证码过期时间（单位为秒）
   * Optional
   * 
   * @var int
   * 
   */
  public $expiresIn;

  /**
   * 是否开启（自定义模版）
   * Optional
   * 
   * @var bool
   * 
   */
  public $enabled;

  /**
   * 是否是系统默认模版
   * Optional
   * 
   * @var bool
   * 
   */
  public $isSystem;
}

class EmailTemplateType {
  const RESET_PASSWORD = 'RESET_PASSWORD';
  const PASSWORD_RESETED_NOTIFICATION = 'PASSWORD_RESETED_NOTIFICATION';
  const CHANGE_PASSWORD = 'CHANGE_PASSWORD';
  const WELCOME = 'WELCOME';
  const VERIFY_EMAIL = 'VERIFY_EMAIL';
  const CHANGE_EMAIL = 'CHANGE_EMAIL';
}

/**
 * 函数
 */
class FunctionType {
  /**
   * ID
   * Required
   * 
   * @var string
   * 
   */
  public $id;

  /**
   * 函数名称
   * Required
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * 源代码
   * Required
   * 
   * @var string
   * 
   */
  public $sourceCode;

  /**
   * 描述信息
   * Optional
   * 
   * @var string
   * 
   */
  public $description;

  /**
   * 云函数链接
   * Optional
   * 
   * @var string
   * 
   */
  public $url;
}

class SortByEnum {
  const CREATEDAT_DESC = 'CREATEDAT_DESC';
  const CREATEDAT_ASC = 'CREATEDAT_ASC';
  const UPDATEDAT_DESC = 'UPDATEDAT_DESC';
  const UPDATEDAT_ASC = 'UPDATEDAT_ASC';
}

class PaginatedFunctions {
  /**
   * Required
   * 
   * @var Function[]
   * 
   */
  public $list;

  /**
   * Required
   * 
   * @var int
   * 
   */
  public $totalCount;
}

class Group {
  /**
   * 唯一标志 code
   * Required
   * 
   * @var string
   * 
   */
  public $code;

  /**
   * 名称
   * Required
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * 描述
   * Optional
   * 
   * @var string
   * 
   */
  public $description;

  /**
   * 创建时间
   * Optional
   * 
   * @var string
   * 
   */
  public $createdAt;

  /**
   * 修改时间
   * Optional
   * 
   * @var string
   * 
   */
  public $updatedAt;

  /**
   * 包含的用户列表
   * Required
   * 
   * @var PaginatedUsers
   * 
   */
  public $users;

  /**
   * 被授权访问的所有资源
   * Optional
   * 
   * @var PaginatedAuthorizedResources
   * 
   */
  public $authorizedResources;
}

class PaginatedUsers {
  /**
   * Required
   * 
   * @var int
   * 
   */
  public $totalCount;

  /**
   * Required
   * 
   * @var User[]
   * 
   */
  public $list;
}

class User {
  /**
   * 用户 ID
   * Required
   * 
   * @var string
   * 
   */
  public $id;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $arn;

  /**
   * 用户在组织机构中的状态
   * Optional
   * 
   * @var UserStatus
   * 
   */
  public $status;

  /**
   * 用户池 ID
   * Required
   * 
   * @var string
   * 
   */
  public $userPoolId;

  /**
   * 用户名，用户池内唯一
   * Optional
   * 
   * @var string
   * 
   */
  public $username;

  /**
   * 邮箱，用户池内唯一
   * Optional
   * 
   * @var string
   * 
   */
  public $email;

  /**
   * 邮箱是否已验证
   * Optional
   * 
   * @var bool
   * 
   */
  public $emailVerified;

  /**
   * 手机号，用户池内唯一
   * Optional
   * 
   * @var string
   * 
   */
  public $phone;

  /**
   * 手机号是否已验证
   * Optional
   * 
   * @var bool
   * 
   */
  public $phoneVerified;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $unionid;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $openid;

  /**
   * 用户的身份信息
   * Optional
   * 
   * @var Identity[]
   * 
   */
  public $identities;

  /**
   * 昵称，该字段不唯一。
   * Optional
   * 
   * @var string
   * 
   */
  public $nickname;

  /**
   * 注册方式
   * Optional
   * 
   * @var string[]
   * 
   */
  public $registerSource;

  /**
   * 头像链接，默认为 https://usercontents.authing.cn/authing-avatar.png
   * Optional
   * 
   * @var string
   * 
   */
  public $photo;

  /**
   * 用户密码，数据库使用密钥加 salt 进行加密，非原文密码。
   * Optional
   * 
   * @var string
   * 
   */
  public $password;

  /**
   * 用户社会化登录第三方身份提供商返回的原始用户信息，非社会化登录方式注册的用户此字段为空。
   * Optional
   * 
   * @var string
   * 
   */
  public $oauth;

  /**
   * 用户登录凭证，开发者可以在后端检验该 token 的合法性，从而验证用户身份。详细文档请见：[验证 Token](https://docs.authing.co/advanced/verify-jwt-token.html)
   * Optional
   * 
   * @var string
   * 
   */
  public $token;

  /**
   * token 过期时间
   * Optional
   * 
   * @var string
   * 
   */
  public $tokenExpiredAt;

  /**
   * 用户登录总次数
   * Optional
   * 
   * @var int
   * 
   */
  public $loginsCount;

  /**
   * 用户最近一次登录时间
   * Optional
   * 
   * @var string
   * 
   */
  public $lastLogin;

  /**
   * 用户上一次登录时使用的 IP
   * Optional
   * 
   * @var string
   * 
   */
  public $lastIP;

  /**
   * 用户注册时间
   * Optional
   * 
   * @var string
   * 
   */
  public $signedUp;

  /**
   * 该账号是否被禁用
   * Optional
   * 
   * @var bool
   * 
   */
  public $blocked;

  /**
   * 账号是否被软删除
   * Optional
   * 
   * @var bool
   * 
   */
  public $isDeleted;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $device;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $browser;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $company;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $givenName;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $familyName;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $middleName;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $profile;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $preferredUsername;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $website;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $gender;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $birthdate;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $zoneinfo;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $locale;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $address;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $formatted;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $streetAddress;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $locality;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $region;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $postalCode;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $city;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $province;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $country;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $createdAt;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $updatedAt;

  /**
   * 用户所在的角色列表
   * Optional
   * 
   * @var PaginatedRoles
   * 
   */
  public $roles;

  /**
   * 用户所在的分组列表
   * Optional
   * 
   * @var PaginatedGroups
   * 
   */
  public $groups;

  /**
   * 用户所在的部门列表
   * Optional
   * 
   * @var PaginatedDepartments
   * 
   */
  public $departments;

  /**
   * 被授权访问的所有资源
   * Optional
   * 
   * @var PaginatedAuthorizedResources
   * 
   */
  public $authorizedResources;

  /**
   * 用户外部 ID
   * Optional
   * 
   * @var string
   * 
   */
  public $externalId;
}

class UserStatus {
  const Suspended = 'Suspended';
  const Resigned = 'Resigned';
  const Activated = 'Activated';
  const Archived = 'Archived';
}

class Identity {
  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $openid;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $userIdInIdp;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $userId;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $connectionId;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $isSocial;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $provider;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $userPoolId;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $refreshToken;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $accessToken;
}

class PaginatedRoles {
  /**
   * Required
   * 
   * @var int
   * 
   */
  public $totalCount;

  /**
   * Required
   * 
   * @var Role[]
   * 
   */
  public $list;
}

class Role {
  /**
   * 权限组 code
   * Required
   * 
   * @var string
   * 
   */
  public $namespace;

  /**
   * 唯一标志 code
   * Required
   * 
   * @var string
   * 
   */
  public $code;

  /**
   * 资源描述符 arn
   * Required
   * 
   * @var string
   * 
   */
  public $arn;

  /**
   * 角色描述
   * Optional
   * 
   * @var string
   * 
   */
  public $description;

  /**
   * 是否为系统内建，系统内建的角色不能删除
   * Optional
   * 
   * @var bool
   * 
   */
  public $isSystem;

  /**
   * 创建时间
   * Optional
   * 
   * @var string
   * 
   */
  public $createdAt;

  /**
   * 修改时间
   * Optional
   * 
   * @var string
   * 
   */
  public $updatedAt;

  /**
   * 被授予此角色的用户列表
   * Required
   * 
   * @var PaginatedUsers
   * 
   */
  public $users;

  /**
   * 被授权访问的所有资源
   * Optional
   * 
   * @var PaginatedAuthorizedResources
   * 
   */
  public $authorizedResources;

  /**
   * 父角色
   * Optional
   * 
   * @var Role
   * 
   */
  public $parent;
}

class PaginatedAuthorizedResources {
  /**
   * Required
   * 
   * @var int
   * 
   */
  public $totalCount;

  /**
   * Required
   * 
   * @var AuthorizedResource[]
   * 
   */
  public $list;
}

class AuthorizedResource {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $code;

  /**
   * Optional
   * 
   * @var ResourceType
   * 
   */
  public $type;

  /**
   * Optional
   * 
   * @var string[]
   * 
   */
  public $actions;
}

class PaginatedGroups {
  /**
   * Required
   * 
   * @var int
   * 
   */
  public $totalCount;

  /**
   * Required
   * 
   * @var Group[]
   * 
   */
  public $list;
}

class PaginatedDepartments {
  /**
   * Required
   * 
   * @var UserDepartment[]
   * 
   */
  public $list;

  /**
   * Required
   * 
   * @var int
   * 
   */
  public $totalCount;
}

class UserDepartment {
  /**
   * Required
   * 
   * @var Node
   * 
   */
  public $department;

  /**
   * 是否为主部门
   * Required
   * 
   * @var bool
   * 
   */
  public $isMainDepartment;

  /**
   * 加入该部门的时间
   * Optional
   * 
   * @var string
   * 
   */
  public $joinedAt;
}

class Node {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $id;

  /**
   * 组织机构 ID
   * Optional
   * 
   * @var string
   * 
   */
  public $orgId;

  /**
   * 节点名称
   * Required
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * 多语言名称，**key** 为标准 **i18n** 语言编码，**value** 为对应语言的名称。
   * Optional
   * 
   * @var string
   * 
   */
  public $nameI18n;

  /**
   * 描述信息
   * Optional
   * 
   * @var string
   * 
   */
  public $description;

  /**
   * 多语言描述信息
   * Optional
   * 
   * @var string
   * 
   */
  public $descriptionI18n;

  /**
   * 在父节点中的次序值。**order** 值大的排序靠前。有效的值范围是[0, 2^32)
   * Optional
   * 
   * @var int
   * 
   */
  public $order;

  /**
   * 节点唯一标志码，可以通过 code 进行搜索
   * Optional
   * 
   * @var string
   * 
   */
  public $code;

  /**
   * 是否为根节点
   * Optional
   * 
   * @var bool
   * 
   */
  public $root;

  /**
   * 距离父节点的深度（如果是查询整棵树，返回的 **depth** 为距离根节点的深度，如果是查询某个节点的子节点，返回的 **depth** 指的是距离该节点的深度。）
   * Optional
   * 
   * @var int
   * 
   */
  public $depth;

  /**
   * Required
   * 
   * @var string[]
   * 
   */
  public $path;

  /**
   * Required
   * 
   * @var string[]
   * 
   */
  public $codePath;

  /**
   * Required
   * 
   * @var string[]
   * 
   */
  public $namePath;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $createdAt;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $updatedAt;

  /**
   * 该节点的子节点 **ID** 列表
   * Optional
   * 
   * @var string[]
   * 
   */
  public $children;

  /**
   * 节点的用户列表
   * Required
   * 
   * @var PaginatedUsers
   * 
   */
  public $users;

  /**
   * 被授权访问的所有资源
   * Optional
   * 
   * @var PaginatedAuthorizedResources
   * 
   */
  public $authorizedResources;
}

class Mfa {
  /**
   * MFA ID
   * Required
   * 
   * @var string
   * 
   */
  public $id;

  /**
   * 用户 ID
   * Required
   * 
   * @var string
   * 
   */
  public $userId;

  /**
   * 用户池 ID
   * Required
   * 
   * @var string
   * 
   */
  public $userPoolId;

  /**
   * 是否开启 MFA
   * Required
   * 
   * @var bool
   * 
   */
  public $enable;

  /**
   * 密钥
   * Optional
   * 
   * @var string
   * 
   */
  public $secret;
}

class Org {
  /**
   * 组织机构 ID
   * Required
   * 
   * @var string
   * 
   */
  public $id;

  /**
   * 根节点
   * Required
   * 
   * @var Node
   * 
   */
  public $rootNode;

  /**
   * 组织机构节点列表
   * Required
   * 
   * @var Node[]
   * 
   */
  public $nodes;
}

class PaginatedOrgs {
  /**
   * Required
   * 
   * @var int
   * 
   */
  public $totalCount;

  /**
   * Required
   * 
   * @var Org[]
   * 
   */
  public $list;
}

class CheckPasswordStrengthResult {
  /**
   * Required
   * 
   * @var bool
   * 
   */
  public $valid;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $message;
}

class Policy {
  /**
   * 权限组 code
   * Required
   * 
   * @var string
   * 
   */
  public $namespace;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $code;

  /**
   * Required
   * 
   * @var bool
   * 
   */
  public $isDefault;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $description;

  /**
   * Required
   * 
   * @var PolicyStatement[]
   * 
   */
  public $statements;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $createdAt;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $updatedAt;

  /**
   * 被授权次数
   * Required
   * 
   * @var int
   * 
   */
  public $assignmentsCount;

  /**
   * 授权记录
   * Required
   * 
   * @var PolicyAssignment[]
   * 
   */
  public $assignments;
}

class PolicyStatement {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $resource;

  /**
   * Required
   * 
   * @var string[]
   * 
   */
  public $actions;

  /**
   * Optional
   * 
   * @var PolicyEffect
   * 
   */
  public $effect;

  /**
   * Optional
   * 
   * @var PolicyStatementCondition[]
   * 
   */
  public $condition;
}

class PolicyEffect {
  const ALLOW = 'ALLOW';
  const DENY = 'DENY';
}

class PolicyStatementCondition {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $param;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $operator;

  /**
   * Required
   * 
   * @var any
   * 
   */
  public $value;
}

class PolicyAssignment {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $code;

  /**
   * Required
   * 
   * @var PolicyAssignmentTargetType
   * 
   */
  public $targetType;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $targetIdentifier;
}

class PaginatedPolicies {
  /**
   * Required
   * 
   * @var int
   * 
   */
  public $totalCount;

  /**
   * Required
   * 
   * @var Policy[]
   * 
   */
  public $list;
}

class PaginatedPolicyAssignments {
  /**
   * Required
   * 
   * @var int
   * 
   */
  public $totalCount;

  /**
   * Required
   * 
   * @var PolicyAssignment[]
   * 
   */
  public $list;
}

class UDFTargetType {
  const NODE = 'NODE';
  const ORG = 'ORG';
  const USER = 'USER';
  const USERPOOL = 'USERPOOL';
  const ROLE = 'ROLE';
  const PERMISSION = 'PERMISSION';
  const APPLICATION = 'APPLICATION';
}

class UserDefinedData {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $key;

  /**
   * Required
   * 
   * @var UdfDataType
   * 
   */
  public $dataType;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $value;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $label;
}

class UDFDataType {
  const STRING = 'STRING';
  const NUMBER = 'NUMBER';
  const DATETIME = 'DATETIME';
  const BOOLEAN = 'BOOLEAN';
  const OBJECT = 'OBJECT';
}

class UserDefinedField {
  /**
   * Required
   * 
   * @var UdfTargetType
   * 
   */
  public $targetType;

  /**
   * Required
   * 
   * @var UdfDataType
   * 
   */
  public $dataType;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $key;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $label;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $options;
}

class UserDefinedDataMap {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $targetId;

  /**
   * Required
   * 
   * @var UserDefinedData[]
   * 
   */
  public $data;
}

/**
 * SearchUserDepartmentOpt
 */
class SearchUserDepartmentOpt {
  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $departmentId;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $includeChildrenDepartments;


public function __construct() {

}

/**
 * @param $departmentId string departmentId
 * @return SearchUserDepartmentOpt
 */
public function withDepartmentId($departmentId) {
  $this->departmentId = $departmentId;
  return $this;
}

/**
 * @param $includeChildrenDepartments bool includeChildrenDepartments
 * @return SearchUserDepartmentOpt
 */
public function withIncludeChildrenDepartments($includeChildrenDepartments) {
  $this->includeChildrenDepartments = $includeChildrenDepartments;
  return $this;
}
}
    

/**
 * SearchUserGroupOpt
 */
class SearchUserGroupOpt {
  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $code;


public function __construct() {

}

/**
 * @param $code string code
 * @return SearchUserGroupOpt
 */
public function withCode($code) {
  $this->code = $code;
  return $this;
}
}
    

/**
 * SearchUserRoleOpt
 */
class SearchUserRoleOpt {
  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $namespace;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $code;

/**
 * @param $code string code
 */

public function __construct($code) {
$this->code = $code;
}

/**
 * @param $namespace string namespace
 * @return SearchUserRoleOpt
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
}
    

class JWTTokenStatus {
  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $code;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $message;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $status;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $exp;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $iat;

  /**
   * Optional
   * 
   * @var JWTTokenStatusDetail
   * 
   */
  public $data;
}

class JWTTokenStatusDetail {
  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $id;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $userPoolId;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $arn;
}

class UserPool {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $id;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $domain;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $description;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $secret;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $jwtSecret;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $ownerId;

  /**
   * Optional
   * 
   * @var UserPoolType[]
   * 
   */
  public $userpoolTypes;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $logo;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $createdAt;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $updatedAt;

  /**
   * 用户邮箱是否验证（用户的 emailVerified 字段）默认值，默认为 false
   * Required
   * 
   * @var bool
   * 
   */
  public $emailVerifiedDefault;

  /**
   * 用户注册之后是否发送欢迎邮件
   * Required
   * 
   * @var bool
   * 
   */
  public $sendWelcomeEmail;

  /**
   * 是否关闭注册
   * Required
   * 
   * @var bool
   * 
   */
  public $registerDisabled;

  /**
   * 是否开启用户池下应用间单点登录
   * Required
   * 
   * @var bool
   * 
   */
  public $appSsoEnabled;

  /**
   * 用户池禁止注册后，是否还显示微信小程序扫码登录。当 **showWXMPQRCode** 为 **true** 时，
   * 前端显示小程序码，此时只有以前允许注册时，扫码登录过的用户可以继续登录；新用户扫码无法登录。
   * Optional
   * 
   * @var bool
   * 
   */
  public $showWxQRCodeWhenRegisterDisabled;

  /**
   * 前端跨域请求白名单
   * Optional
   * 
   * @var string
   * 
   */
  public $allowedOrigins;

  /**
   * 用户 **token** 有效时间，单位为秒，默认为 15 天。
   * Optional
   * 
   * @var int
   * 
   */
  public $tokenExpiresAfter;

  /**
   * 是否已删除
   * Optional
   * 
   * @var bool
   * 
   */
  public $isDeleted;

  /**
   * 注册频繁检测
   * Optional
   * 
   * @var FrequentRegisterCheckConfig
   * 
   */
  public $frequentRegisterCheck;

  /**
   * 登录失败检测
   * Optional
   * 
   * @var LoginFailCheckConfig
   * 
   */
  public $loginFailCheck;

  /**
   * 手机号修改策略
   * Optional
   * 
   * @var ChangePhoneStrategy
   * 
   */
  public $changePhoneStrategy;

  /**
   * 邮箱修改策略
   * Optional
   * 
   * @var ChangeEmailStrategy
   * 
   */
  public $changeEmailStrategy;

  /**
   * APP 扫码登录配置
   * Optional
   * 
   * @var QrcodeLoginStrategy
   * 
   */
  public $qrcodeLoginStrategy;

  /**
   * APP 拉起小程序登录配置
   * Optional
   * 
   * @var App2WxappLoginStrategy
   * 
   */
  public $app2WxappLoginStrategy;

  /**
   * 注册白名单配置
   * Optional
   * 
   * @var RegisterWhiteListConfig
   * 
   */
  public $whitelist;

  /**
   * 自定义短信服务商配置
   * Optional
   * 
   * @var CustomSMSProvider
   * 
   */
  public $customSMSProvider;

  /**
   * 用户池套餐类型
   * Optional
   * 
   * @var int
   * 
   */
  public $packageType;

  /**
   * 是否使用自定义数据库 CUSTOM_USER_STORE 模式
   * Optional
   * 
   * @var bool
   * 
   */
  public $useCustomUserStore;

  /**
   * 是否要求邮箱必须验证才能登录（如果是通过邮箱登录的话）
   * Optional
   * 
   * @var bool
   * 
   */
  public $loginRequireEmailVerified;

  /**
   * 短信验证码长度
   * Optional
   * 
   * @var int
   * 
   */
  public $verifyCodeLength;
}

class UserPoolType {
  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $code;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $description;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $image;

  /**
   * Optional
   * 
   * @var string[]
   * 
   */
  public $sdks;
}

class FrequentRegisterCheckConfig {
  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $timeInterval;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $limit;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $enabled;
}

class LoginFailCheckConfig {
  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $timeInterval;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $limit;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $enabled;
}

class ChangePhoneStrategy {
  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $verifyOldPhone;
}

class ChangeEmailStrategy {
  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $verifyOldEmail;
}

class QrcodeLoginStrategy {
  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $qrcodeExpiresAfter;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $returnFullUserInfo;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $allowExchangeUserInfoFromBrowser;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $ticketExpiresAfter;
}

class App2WxappLoginStrategy {
  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $ticketExpriresAfter;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $ticketExchangeUserInfoNeedSecret;
}

class RegisterWhiteListConfig {
  /**
   * 是否开启手机号注册白名单
   * Optional
   * 
   * @var bool
   * 
   */
  public $phoneEnabled;

  /**
   * 是否开启邮箱注册白名单
   * Optional
   * 
   * @var bool
   * 
   */
  public $emailEnabled;

  /**
   * 是否开用户名注册白名单
   * Optional
   * 
   * @var bool
   * 
   */
  public $usernameEnabled;
}

class CustomSMSProvider {
  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $enabled;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $provider;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $config;
}

class PaginatedUserpool {
  /**
   * Required
   * 
   * @var int
   * 
   */
  public $totalCount;

  /**
   * Required
   * 
   * @var UserPool[]
   * 
   */
  public $list;
}

class AccessTokenRes {
  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $accessToken;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $exp;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $iat;
}

class WhitelistType {
  const USERNAME = 'USERNAME';
  const EMAIL = 'EMAIL';
  const PHONE = 'PHONE';
}

class WhiteList {
  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $createdAt;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $updatedAt;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $value;
}

class Mutation {
  /**
   * 允许操作某个资源
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $allow;

  /**
   * 将一个（类）资源授权给用户、角色、分组、组织机构，且可以分别指定不同的操作权限。
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $authorizeResource;

  /**
   * 配置社会化登录
   * Required
   * 
   * @var SocialConnectionInstance
   * 
   */
  public $createSocialConnectionInstance;

  /**
   * 开启社会化登录
   * Required
   * 
   * @var SocialConnectionInstance
   * 
   */
  public $enableSocialConnectionInstance;

  /**
   * 关闭社会化登录
   * Required
   * 
   * @var SocialConnectionInstance
   * 
   */
  public $disableSocialConnectionInstance;

  /**
   * 设置用户在某个组织机构内所在的主部门
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $setMainDepartment;

  /**
   * 配置自定义邮件模版
   * Required
   * 
   * @var EmailTemplate
   * 
   */
  public $configEmailTemplate;

  /**
   * 启用自定义邮件模版
   * Required
   * 
   * @var EmailTemplate
   * 
   */
  public $enableEmailTemplate;

  /**
   * 停用自定义邮件模版（将会使用系统默认邮件模版）
   * Required
   * 
   * @var EmailTemplate
   * 
   */
  public $disableEmailTemplate;

  /**
   * 发送邮件
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $sendEmail;

  /**
   * 创建函数
   * Optional
   * 
   * @var Function
   * 
   */
  public $createFunction;

  /**
   * 修改函数
   * Required
   * 
   * @var Function
   * 
   */
  public $updateFunction;

  /**
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $deleteFunction;

  /**
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $addUserToGroup;

  /**
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $removeUserFromGroup;

  /**
   * 创建角色
   * Required
   * 
   * @var Group
   * 
   */
  public $createGroup;

  /**
   * 修改角色
   * Required
   * 
   * @var Group
   * 
   */
  public $updateGroup;

  /**
   * 批量删除角色
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $deleteGroups;

  /**
   * Optional
   * 
   * @var User
   * 
   */
  public $loginByEmail;

  /**
   * Optional
   * 
   * @var User
   * 
   */
  public $loginByUsername;

  /**
   * Optional
   * 
   * @var User
   * 
   */
  public $loginByPhoneCode;

  /**
   * Optional
   * 
   * @var User
   * 
   */
  public $loginByPhonePassword;

  /**
   * 修改 MFA 信息
   * Optional
   * 
   * @var Mfa
   * 
   */
  public $changeMfa;

  /**
   * 创建组织机构
   * Required
   * 
   * @var Org
   * 
   */
  public $createOrg;

  /**
   * 删除组织机构
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $deleteOrg;

  /**
   * 添加子节点
   * Required
   * 
   * @var Org
   * 
   */
  public $addNode;

  /**
   * 添加子节点
   * Required
   * 
   * @var Node
   * 
   */
  public $addNodeV2;

  /**
   * 修改节点
   * Required
   * 
   * @var Node
   * 
   */
  public $updateNode;

  /**
   * 删除节点（会一并删掉子节点）
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $deleteNode;

  /**
   * （批量）将成员添加到节点中
   * Required
   * 
   * @var Node
   * 
   */
  public $addMember;

  /**
   * （批量）将成员从节点中移除
   * Required
   * 
   * @var Node
   * 
   */
  public $removeMember;

  /**
   * Required
   * 
   * @var Org
   * 
   */
  public $moveNode;

  /**
   * Optional
   * 
   * @var CommonMessage
   * 
   */
  public $resetPassword;

  /**
   * Required
   * 
   * @var Policy
   * 
   */
  public $createPolicy;

  /**
   * Required
   * 
   * @var Policy
   * 
   */
  public $updatePolicy;

  /**
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $deletePolicy;

  /**
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $deletePolicies;

  /**
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $addPolicyAssignments;

  /**
   * 开启授权
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $enablePolicyAssignment;

  /**
   * 开启授权
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $disbalePolicyAssignment;

  /**
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $removePolicyAssignments;

  /**
   * Optional
   * 
   * @var User
   * 
   */
  public $registerByUsername;

  /**
   * Optional
   * 
   * @var User
   * 
   */
  public $registerByEmail;

  /**
   * Optional
   * 
   * @var User
   * 
   */
  public $registerByPhoneCode;

  /**
   * 创建角色
   * Required
   * 
   * @var Role
   * 
   */
  public $createRole;

  /**
   * 修改角色
   * Required
   * 
   * @var Role
   * 
   */
  public $updateRole;

  /**
   * 删除角色
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $deleteRole;

  /**
   * 批量删除角色
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $deleteRoles;

  /**
   * 给用户授权角色
   * Optional
   * 
   * @var CommonMessage
   * 
   */
  public $assignRole;

  /**
   * 撤销角色
   * Optional
   * 
   * @var CommonMessage
   * 
   */
  public $revokeRole;

  /**
   * 使用子账号登录
   * Required
   * 
   * @var User
   * 
   */
  public $loginBySubAccount;

  /**
   * Required
   * 
   * @var UserDefinedField
   * 
   */
  public $setUdf;

  /**
   * Optional
   * 
   * @var CommonMessage
   * 
   */
  public $removeUdf;

  /**
   * Optional
   * 
   * @var UserDefinedData[]
   * 
   */
  public $setUdv;

  /**
   * Optional
   * 
   * @var CommonMessage
   * 
   */
  public $setUdfValueBatch;

  /**
   * Optional
   * 
   * @var UserDefinedData[]
   * 
   */
  public $removeUdv;

  /**
   * Optional
   * 
   * @var UserDefinedData[]
   * 
   */
  public $setUdvBatch;

  /**
   * Optional
   * 
   * @var RefreshToken
   * 
   */
  public $refreshToken;

  /**
   * 创建用户。此接口需要管理员权限，普通用户注册请使用 **register** 接口。
   * Required
   * 
   * @var User
   * 
   */
  public $createUser;

  /**
   * 更新用户信息。
   * Required
   * 
   * @var User
   * 
   */
  public $updateUser;

  /**
   * 修改用户密码，此接口需要验证原始密码，管理员直接修改请使用 **updateUser** 接口。
   * Required
   * 
   * @var User
   * 
   */
  public $updatePassword;

  /**
   * 绑定手机号，调用此接口需要当前用户未绑定手机号
   * Required
   * 
   * @var User
   * 
   */
  public $bindPhone;

  /**
   * 绑定邮箱
   * Required
   * 
   * @var User
   * 
   */
  public $bindEmail;

  /**
   * 解绑定手机号，调用此接口需要当前用户已绑定手机号并且绑定了其他登录方式
   * Required
   * 
   * @var User
   * 
   */
  public $unbindPhone;

  /**
   * 修改手机号。此接口需要验证手机号验证码，管理员直接修改请使用 **updateUser** 接口。
   * Required
   * 
   * @var User
   * 
   */
  public $updatePhone;

  /**
   * 修改邮箱。此接口需要验证邮箱验证码，管理员直接修改请使用 updateUser 接口。
   * Required
   * 
   * @var User
   * 
   */
  public $updateEmail;

  /**
   * 解绑定邮箱
   * Required
   * 
   * @var User
   * 
   */
  public $unbindEmail;

  /**
   * 删除用户
   * Optional
   * 
   * @var CommonMessage
   * 
   */
  public $deleteUser;

  /**
   * 批量删除用户
   * Optional
   * 
   * @var CommonMessage
   * 
   */
  public $deleteUsers;

  /**
   * 创建用户池
   * Required
   * 
   * @var UserPool
   * 
   */
  public $createUserpool;

  /**
   * Required
   * 
   * @var UserPool
   * 
   */
  public $updateUserpool;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $refreshUserpoolSecret;

  /**
   * Required
   * 
   * @var CommonMessage
   * 
   */
  public $deleteUserpool;

  /**
   * Required
   * 
   * @var RefreshAccessTokenRes
   * 
   */
  public $refreshAccessToken;

  /**
   * Required
   * 
   * @var WhiteList[]
   * 
   */
  public $addWhitelist;

  /**
   * Required
   * 
   * @var WhiteList[]
   * 
   */
  public $removeWhitelist;
}

class CommonMessage {
  /**
   * 可读的接口响应说明，请以业务状态码 code 作为判断业务是否成功的标志
   * Optional
   * 
   * @var string
   * 
   */
  public $message;

  /**
   * 业务状态码（与 HTTP 响应码不同），但且仅当为 200 的时候表示操作成功表示，详细说明请见：
   * [Authing 错误代码列表](https://docs.authing.co/advanced/error-code.html)
   * Optional
   * 
   * @var int
   * 
   */
  public $code;
}

/**
 * AuthorizeResourceOpt
 */
class AuthorizeResourceOpt {
  /**
   * Required
   * 
   * @var PolicyAssignmentTargetType
   * 
   */
  public $targetType;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $targetIdentifier;

  /**
   * Optional
   * 
   * @var string[]
   * 
   */
  public $actions;

/**
 * @param $targetType PolicyAssignmentTargetType targetType
 * @param $targetIdentifier string targetIdentifier
 */

public function __construct($targetType, $targetIdentifier) {
$this->targetType = $targetType;
$this->targetIdentifier = $targetIdentifier;
}

/**
 * @param $actions string[] actions
 * @return AuthorizeResourceOpt
 */
public function withActions($actions) {
  $this->actions = $actions;
  return $this;
}
}
    

/**
 * CreateSocialConnectionInstanceInput
 */
class CreateSocialConnectionInstanceInput {
  /**
   * 社会化登录 provider
   * Required
   * 
   * @var string
   * 
   */
  public $provider;

  /**
   * Optional
   * 
   * @var CreateSocialConnectionInstanceFieldInput[]
   * 
   */
  public $fields;

/**
 * @param $provider string 社会化登录 provider
 */

public function __construct($provider) {
$this->provider = $provider;
}

/**
 * @param $fields CreateSocialConnectionInstanceFieldInput[] fields
 * @return CreateSocialConnectionInstanceInput
 */
public function withFields($fields) {
  $this->fields = $fields;
  return $this;
}
}
    

/**
 * CreateSocialConnectionInstanceFieldInput
 */
class CreateSocialConnectionInstanceFieldInput {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $key;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $value;

/**
 * @param $key string key
 * @param $value string value
 */

public function __construct($key, $value) {
$this->key = $key;
$this->value = $value;
}

}
    

/**
 * ConfigEmailTemplateInput
 */
class ConfigEmailTemplateInput {
  /**
   * 邮件模版类型
   * Required
   * 
   * @var EmailTemplateType
   * 
   */
  public $type;

  /**
   * 模版名称
   * Required
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * 邮件主题
   * Required
   * 
   * @var string
   * 
   */
  public $subject;

  /**
   * 显示的邮件发送人
   * Required
   * 
   * @var string
   * 
   */
  public $sender;

  /**
   * 邮件模版内容
   * Required
   * 
   * @var string
   * 
   */
  public $content;

  /**
   * 重定向链接，操作成功后，用户将被重定向到此 URL。
   * Optional
   * 
   * @var string
   * 
   */
  public $redirectTo;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $hasURL;

  /**
   * 验证码过期时间（单位为秒）
   * Optional
   * 
   * @var int
   * 
   */
  public $expiresIn;

/**
 * @param $type EmailTemplateType 邮件模版类型
 * @param $name string 模版名称
 * @param $subject string 邮件主题
 * @param $sender string 显示的邮件发送人
 * @param $content string 邮件模版内容
 */

public function __construct($type, $name, $subject, $sender, $content) {
$this->type = $type;
$this->name = $name;
$this->subject = $subject;
$this->sender = $sender;
$this->content = $content;
}

/**
 * @param $redirectTo string 重定向链接，操作成功后，用户将被重定向到此 URL。
 * @return ConfigEmailTemplateInput
 */
public function withRedirectTo($redirectTo) {
  $this->redirectTo = $redirectTo;
  return $this;
}

/**
 * @param $hasURL bool hasURL
 * @return ConfigEmailTemplateInput
 */
public function withHasUrl($hasURL) {
  $this->hasURL = $hasURL;
  return $this;
}

/**
 * @param $expiresIn int 验证码过期时间（单位为秒）
 * @return ConfigEmailTemplateInput
 */
public function withExpiresIn($expiresIn) {
  $this->expiresIn = $expiresIn;
  return $this;
}
}
    

class EmailScene {
  const RESET_PASSWORD = 'RESET_PASSWORD';
  const VERIFY_EMAIL = 'VERIFY_EMAIL';
  const CHANGE_EMAIL = 'CHANGE_EMAIL';
  const MFA_VERIFY = 'MFA_VERIFY';
}

/**
 * CreateFunctionInput
 */
class CreateFunctionInput {
  /**
   * 函数名称
   * Required
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * 源代码
   * Required
   * 
   * @var string
   * 
   */
  public $sourceCode;

  /**
   * 描述信息
   * Optional
   * 
   * @var string
   * 
   */
  public $description;

  /**
   * 云函数链接
   * Optional
   * 
   * @var string
   * 
   */
  public $url;

/**
 * @param $name string 函数名称
 * @param $sourceCode string 源代码
 */

public function __construct($name, $sourceCode) {
$this->name = $name;
$this->sourceCode = $sourceCode;
}

/**
 * @param $description string 描述信息
 * @return CreateFunctionInput
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}

/**
 * @param $url string 云函数链接
 * @return CreateFunctionInput
 */
public function withUrl($url) {
  $this->url = $url;
  return $this;
}
}
    

/**
 * UpdateFunctionInput
 */
class UpdateFunctionInput {
  /**
   * ID
   * Required
   * 
   * @var string
   * 
   */
  public $id;

  /**
   * 函数名称
   * Optional
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * 源代码
   * Optional
   * 
   * @var string
   * 
   */
  public $sourceCode;

  /**
   * 描述信息
   * Optional
   * 
   * @var string
   * 
   */
  public $description;

  /**
   * 云函数链接
   * Optional
   * 
   * @var string
   * 
   */
  public $url;

/**
 * @param $id string ID
 */

public function __construct($id) {
$this->id = $id;
}

/**
 * @param $name string 函数名称
 * @return UpdateFunctionInput
 */
public function withName($name) {
  $this->name = $name;
  return $this;
}

/**
 * @param $sourceCode string 源代码
 * @return UpdateFunctionInput
 */
public function withSourceCode($sourceCode) {
  $this->sourceCode = $sourceCode;
  return $this;
}

/**
 * @param $description string 描述信息
 * @return UpdateFunctionInput
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}

/**
 * @param $url string 云函数链接
 * @return UpdateFunctionInput
 */
public function withUrl($url) {
  $this->url = $url;
  return $this;
}
}
    

/**
 * LoginByEmailInput
 */
class LoginByEmailInput {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $email;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $password;

  /**
   * 图形验证码
   * Optional
   * 
   * @var string
   * 
   */
  public $captchaCode;

  /**
   * 如果用户不存在，是否自动创建一个账号
   * Optional
   * 
   * @var bool
   * 
   */
  public $autoRegister;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $clientIp;

  /**
   * 设置用户自定义字段，要求符合 Array<{ key: string; value: string }> 格式
   * Optional
   * 
   * @var string
   * 
   */
  public $params;

  /**
   * 请求上下文信息，将会传递到 pipeline 中
   * Optional
   * 
   * @var string
   * 
   */
  public $context;

/**
 * @param $email string email
 * @param $password string password
 */

public function __construct($email, $password) {
$this->email = $email;
$this->password = $password;
}

/**
 * @param $captchaCode string 图形验证码
 * @return LoginByEmailInput
 */
public function withCaptchaCode($captchaCode) {
  $this->captchaCode = $captchaCode;
  return $this;
}

/**
 * @param $autoRegister bool 如果用户不存在，是否自动创建一个账号
 * @return LoginByEmailInput
 */
public function withAutoRegister($autoRegister) {
  $this->autoRegister = $autoRegister;
  return $this;
}

/**
 * @param $clientIp string clientIp
 * @return LoginByEmailInput
 */
public function withClientIp($clientIp) {
  $this->clientIp = $clientIp;
  return $this;
}

/**
 * @param $params string 设置用户自定义字段，要求符合 Array<{ key: string; value: string }> 格式
 * @return LoginByEmailInput
 */
public function withParams($params) {
  $this->params = $params;
  return $this;
}

/**
 * @param $context string 请求上下文信息，将会传递到 pipeline 中
 * @return LoginByEmailInput
 */
public function withContext($context) {
  $this->context = $context;
  return $this;
}
}
    

/**
 * LoginByUsernameInput
 */
class LoginByUsernameInput {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $username;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $password;

  /**
   * 图形验证码
   * Optional
   * 
   * @var string
   * 
   */
  public $captchaCode;

  /**
   * 如果用户不存在，是否自动创建一个账号
   * Optional
   * 
   * @var bool
   * 
   */
  public $autoRegister;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $clientIp;

  /**
   * 设置用户自定义字段，要求符合 Array<{ key: string; value: string }> 格式
   * Optional
   * 
   * @var string
   * 
   */
  public $params;

  /**
   * 请求上下文信息，将会传递到 pipeline 中
   * Optional
   * 
   * @var string
   * 
   */
  public $context;

/**
 * @param $username string username
 * @param $password string password
 */

public function __construct($username, $password) {
$this->username = $username;
$this->password = $password;
}

/**
 * @param $captchaCode string 图形验证码
 * @return LoginByUsernameInput
 */
public function withCaptchaCode($captchaCode) {
  $this->captchaCode = $captchaCode;
  return $this;
}

/**
 * @param $autoRegister bool 如果用户不存在，是否自动创建一个账号
 * @return LoginByUsernameInput
 */
public function withAutoRegister($autoRegister) {
  $this->autoRegister = $autoRegister;
  return $this;
}

/**
 * @param $clientIp string clientIp
 * @return LoginByUsernameInput
 */
public function withClientIp($clientIp) {
  $this->clientIp = $clientIp;
  return $this;
}

/**
 * @param $params string 设置用户自定义字段，要求符合 Array<{ key: string; value: string }> 格式
 * @return LoginByUsernameInput
 */
public function withParams($params) {
  $this->params = $params;
  return $this;
}

/**
 * @param $context string 请求上下文信息，将会传递到 pipeline 中
 * @return LoginByUsernameInput
 */
public function withContext($context) {
  $this->context = $context;
  return $this;
}
}
    

/**
 * LoginByPhoneCodeInput
 */
class LoginByPhoneCodeInput {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $phone;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $code;

  /**
   * 如果用户不存在，是否自动创建一个账号
   * Optional
   * 
   * @var bool
   * 
   */
  public $autoRegister;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $clientIp;

  /**
   * 设置用户自定义字段，要求符合 Array<{ key: string; value: string }> 格式
   * Optional
   * 
   * @var string
   * 
   */
  public $params;

  /**
   * 请求上下文信息，将会传递到 pipeline 中
   * Optional
   * 
   * @var string
   * 
   */
  public $context;

/**
 * @param $phone string phone
 * @param $code string code
 */

public function __construct($phone, $code) {
$this->phone = $phone;
$this->code = $code;
}

/**
 * @param $autoRegister bool 如果用户不存在，是否自动创建一个账号
 * @return LoginByPhoneCodeInput
 */
public function withAutoRegister($autoRegister) {
  $this->autoRegister = $autoRegister;
  return $this;
}

/**
 * @param $clientIp string clientIp
 * @return LoginByPhoneCodeInput
 */
public function withClientIp($clientIp) {
  $this->clientIp = $clientIp;
  return $this;
}

/**
 * @param $params string 设置用户自定义字段，要求符合 Array<{ key: string; value: string }> 格式
 * @return LoginByPhoneCodeInput
 */
public function withParams($params) {
  $this->params = $params;
  return $this;
}

/**
 * @param $context string 请求上下文信息，将会传递到 pipeline 中
 * @return LoginByPhoneCodeInput
 */
public function withContext($context) {
  $this->context = $context;
  return $this;
}
}
    

/**
 * LoginByPhonePasswordInput
 */
class LoginByPhonePasswordInput {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $phone;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $password;

  /**
   * 图形验证码
   * Optional
   * 
   * @var string
   * 
   */
  public $captchaCode;

  /**
   * 如果用户不存在，是否自动创建一个账号
   * Optional
   * 
   * @var bool
   * 
   */
  public $autoRegister;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $clientIp;

  /**
   * 设置用户自定义字段，要求符合 Array<{ key: string; value: string }> 格式
   * Optional
   * 
   * @var string
   * 
   */
  public $params;

  /**
   * 请求上下文信息，将会传递到 pipeline 中
   * Optional
   * 
   * @var string
   * 
   */
  public $context;

/**
 * @param $phone string phone
 * @param $password string password
 */

public function __construct($phone, $password) {
$this->phone = $phone;
$this->password = $password;
}

/**
 * @param $captchaCode string 图形验证码
 * @return LoginByPhonePasswordInput
 */
public function withCaptchaCode($captchaCode) {
  $this->captchaCode = $captchaCode;
  return $this;
}

/**
 * @param $autoRegister bool 如果用户不存在，是否自动创建一个账号
 * @return LoginByPhonePasswordInput
 */
public function withAutoRegister($autoRegister) {
  $this->autoRegister = $autoRegister;
  return $this;
}

/**
 * @param $clientIp string clientIp
 * @return LoginByPhonePasswordInput
 */
public function withClientIp($clientIp) {
  $this->clientIp = $clientIp;
  return $this;
}

/**
 * @param $params string 设置用户自定义字段，要求符合 Array<{ key: string; value: string }> 格式
 * @return LoginByPhonePasswordInput
 */
public function withParams($params) {
  $this->params = $params;
  return $this;
}

/**
 * @param $context string 请求上下文信息，将会传递到 pipeline 中
 * @return LoginByPhonePasswordInput
 */
public function withContext($context) {
  $this->context = $context;
  return $this;
}
}
    

/**
 * PolicyStatementInput
 */
class PolicyStatementInput {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $resource;

  /**
   * Required
   * 
   * @var string[]
   * 
   */
  public $actions;

  /**
   * Optional
   * 
   * @var PolicyEffect
   * 
   */
  public $effect;

  /**
   * Optional
   * 
   * @var PolicyStatementConditionInput[]
   * 
   */
  public $condition;

/**
 * @param $resource string resource
 * @param $actions string[] actions
 */

public function __construct($resource, $actions) {
$this->resource = $resource;
$this->actions = $actions;
}

/**
 * @param $effect PolicyEffect effect
 * @return PolicyStatementInput
 */
public function withEffect($effect) {
  $this->effect = $effect;
  return $this;
}

/**
 * @param $condition PolicyStatementConditionInput[] condition
 * @return PolicyStatementInput
 */
public function withCondition($condition) {
  $this->condition = $condition;
  return $this;
}
}
    

/**
 * PolicyStatementConditionInput
 */
class PolicyStatementConditionInput {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $param;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $operator;

  /**
   * Required
   * 
   * @var any
   * 
   */
  public $value;

/**
 * @param $param string param
 * @param $operator string operator
 * @param $value any value
 */

public function __construct($param, $operator, $value) {
$this->param = $param;
$this->operator = $operator;
$this->value = $value;
}

}
    

/**
 * RegisterByUsernameInput
 */
class RegisterByUsernameInput {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $username;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $password;

  /**
   * Optional
   * 
   * @var RegisterProfile
   * 
   */
  public $profile;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $forceLogin;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $generateToken;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $clientIp;

  /**
   * 设置用户自定义字段，要求符合 Array<{ key: string; value: string }> 格式
   * Optional
   * 
   * @var string
   * 
   */
  public $params;

  /**
   * 请求上下文信息，将会传递到 pipeline 中
   * Optional
   * 
   * @var string
   * 
   */
  public $context;

/**
 * @param $username string username
 * @param $password string password
 */

public function __construct($username, $password) {
$this->username = $username;
$this->password = $password;
}

/**
 * @param $profile RegisterProfile profile
 * @return RegisterByUsernameInput
 */
public function withProfile($profile) {
  $this->profile = $profile;
  return $this;
}

/**
 * @param $forceLogin bool forceLogin
 * @return RegisterByUsernameInput
 */
public function withForceLogin($forceLogin) {
  $this->forceLogin = $forceLogin;
  return $this;
}

/**
 * @param $generateToken bool generateToken
 * @return RegisterByUsernameInput
 */
public function withGenerateToken($generateToken) {
  $this->generateToken = $generateToken;
  return $this;
}

/**
 * @param $clientIp string clientIp
 * @return RegisterByUsernameInput
 */
public function withClientIp($clientIp) {
  $this->clientIp = $clientIp;
  return $this;
}

/**
 * @param $params string 设置用户自定义字段，要求符合 Array<{ key: string; value: string }> 格式
 * @return RegisterByUsernameInput
 */
public function withParams($params) {
  $this->params = $params;
  return $this;
}

/**
 * @param $context string 请求上下文信息，将会传递到 pipeline 中
 * @return RegisterByUsernameInput
 */
public function withContext($context) {
  $this->context = $context;
  return $this;
}
}
    

/**
 * RegisterProfile
 */
class RegisterProfile {
  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $ip;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $oauth;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $username;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $nickname;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $company;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $photo;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $device;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $browser;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $givenName;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $familyName;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $middleName;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $profile;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $preferredUsername;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $website;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $gender;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $birthdate;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $zoneinfo;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $locale;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $address;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $formatted;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $streetAddress;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $locality;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $region;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $postalCode;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $country;

  /**
   * Optional
   * 
   * @var UserDdfInput[]
   * 
   */
  public $udf;


public function __construct() {

}

/**
 * @param $ip string ip
 * @return RegisterProfile
 */
public function withIp($ip) {
  $this->ip = $ip;
  return $this;
}

/**
 * @param $oauth string oauth
 * @return RegisterProfile
 */
public function withOauth($oauth) {
  $this->oauth = $oauth;
  return $this;
}

/**
 * @param $username string username
 * @return RegisterProfile
 */
public function withUsername($username) {
  $this->username = $username;
  return $this;
}

/**
 * @param $nickname string nickname
 * @return RegisterProfile
 */
public function withNickname($nickname) {
  $this->nickname = $nickname;
  return $this;
}

/**
 * @param $company string company
 * @return RegisterProfile
 */
public function withCompany($company) {
  $this->company = $company;
  return $this;
}

/**
 * @param $photo string photo
 * @return RegisterProfile
 */
public function withPhoto($photo) {
  $this->photo = $photo;
  return $this;
}

/**
 * @param $device string device
 * @return RegisterProfile
 */
public function withDevice($device) {
  $this->device = $device;
  return $this;
}

/**
 * @param $browser string browser
 * @return RegisterProfile
 */
public function withBrowser($browser) {
  $this->browser = $browser;
  return $this;
}

/**
 * @param $name string name
 * @return RegisterProfile
 */
public function withName($name) {
  $this->name = $name;
  return $this;
}

/**
 * @param $givenName string givenName
 * @return RegisterProfile
 */
public function withGivenName($givenName) {
  $this->givenName = $givenName;
  return $this;
}

/**
 * @param $familyName string familyName
 * @return RegisterProfile
 */
public function withFamilyName($familyName) {
  $this->familyName = $familyName;
  return $this;
}

/**
 * @param $middleName string middleName
 * @return RegisterProfile
 */
public function withMiddleName($middleName) {
  $this->middleName = $middleName;
  return $this;
}

/**
 * @param $profile string profile
 * @return RegisterProfile
 */
public function withProfile($profile) {
  $this->profile = $profile;
  return $this;
}

/**
 * @param $preferredUsername string preferredUsername
 * @return RegisterProfile
 */
public function withPreferredUsername($preferredUsername) {
  $this->preferredUsername = $preferredUsername;
  return $this;
}

/**
 * @param $website string website
 * @return RegisterProfile
 */
public function withWebsite($website) {
  $this->website = $website;
  return $this;
}

/**
 * @param $gender string gender
 * @return RegisterProfile
 */
public function withGender($gender) {
  $this->gender = $gender;
  return $this;
}

/**
 * @param $birthdate string birthdate
 * @return RegisterProfile
 */
public function withBirthdate($birthdate) {
  $this->birthdate = $birthdate;
  return $this;
}

/**
 * @param $zoneinfo string zoneinfo
 * @return RegisterProfile
 */
public function withZoneinfo($zoneinfo) {
  $this->zoneinfo = $zoneinfo;
  return $this;
}

/**
 * @param $locale string locale
 * @return RegisterProfile
 */
public function withLocale($locale) {
  $this->locale = $locale;
  return $this;
}

/**
 * @param $address string address
 * @return RegisterProfile
 */
public function withAddress($address) {
  $this->address = $address;
  return $this;
}

/**
 * @param $formatted string formatted
 * @return RegisterProfile
 */
public function withFormatted($formatted) {
  $this->formatted = $formatted;
  return $this;
}

/**
 * @param $streetAddress string streetAddress
 * @return RegisterProfile
 */
public function withStreetAddress($streetAddress) {
  $this->streetAddress = $streetAddress;
  return $this;
}

/**
 * @param $locality string locality
 * @return RegisterProfile
 */
public function withLocality($locality) {
  $this->locality = $locality;
  return $this;
}

/**
 * @param $region string region
 * @return RegisterProfile
 */
public function withRegion($region) {
  $this->region = $region;
  return $this;
}

/**
 * @param $postalCode string postalCode
 * @return RegisterProfile
 */
public function withPostalCode($postalCode) {
  $this->postalCode = $postalCode;
  return $this;
}

/**
 * @param $country string country
 * @return RegisterProfile
 */
public function withCountry($country) {
  $this->country = $country;
  return $this;
}

/**
 * @param $udf UserDdfInput[] udf
 * @return RegisterProfile
 */
public function withUdf($udf) {
  $this->udf = $udf;
  return $this;
}
}
    

/**
 * UserDdfInput
 */
class UserDdfInput {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $key;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $value;

/**
 * @param $key string key
 * @param $value string value
 */

public function __construct($key, $value) {
$this->key = $key;
$this->value = $value;
}

}
    

/**
 * RegisterByEmailInput
 */
class RegisterByEmailInput {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $email;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $password;

  /**
   * Optional
   * 
   * @var RegisterProfile
   * 
   */
  public $profile;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $forceLogin;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $generateToken;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $clientIp;

  /**
   * 设置用户自定义字段，要求符合 Array<{ key: string; value: string }> 格式
   * Optional
   * 
   * @var string
   * 
   */
  public $params;

  /**
   * 请求上下文信息，将会传递到 pipeline 中
   * Optional
   * 
   * @var string
   * 
   */
  public $context;

/**
 * @param $email string email
 * @param $password string password
 */

public function __construct($email, $password) {
$this->email = $email;
$this->password = $password;
}

/**
 * @param $profile RegisterProfile profile
 * @return RegisterByEmailInput
 */
public function withProfile($profile) {
  $this->profile = $profile;
  return $this;
}

/**
 * @param $forceLogin bool forceLogin
 * @return RegisterByEmailInput
 */
public function withForceLogin($forceLogin) {
  $this->forceLogin = $forceLogin;
  return $this;
}

/**
 * @param $generateToken bool generateToken
 * @return RegisterByEmailInput
 */
public function withGenerateToken($generateToken) {
  $this->generateToken = $generateToken;
  return $this;
}

/**
 * @param $clientIp string clientIp
 * @return RegisterByEmailInput
 */
public function withClientIp($clientIp) {
  $this->clientIp = $clientIp;
  return $this;
}

/**
 * @param $params string 设置用户自定义字段，要求符合 Array<{ key: string; value: string }> 格式
 * @return RegisterByEmailInput
 */
public function withParams($params) {
  $this->params = $params;
  return $this;
}

/**
 * @param $context string 请求上下文信息，将会传递到 pipeline 中
 * @return RegisterByEmailInput
 */
public function withContext($context) {
  $this->context = $context;
  return $this;
}
}
    

/**
 * RegisterByPhoneCodeInput
 */
class RegisterByPhoneCodeInput {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $phone;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $code;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $password;

  /**
   * Optional
   * 
   * @var RegisterProfile
   * 
   */
  public $profile;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $forceLogin;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $generateToken;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $clientIp;

  /**
   * 设置用户自定义字段，要求符合 Array<{ key: string; value: string }> 格式
   * Optional
   * 
   * @var string
   * 
   */
  public $params;

  /**
   * 请求上下文信息，将会传递到 pipeline 中
   * Optional
   * 
   * @var string
   * 
   */
  public $context;

/**
 * @param $phone string phone
 * @param $code string code
 */

public function __construct($phone, $code) {
$this->phone = $phone;
$this->code = $code;
}

/**
 * @param $password string password
 * @return RegisterByPhoneCodeInput
 */
public function withPassword($password) {
  $this->password = $password;
  return $this;
}

/**
 * @param $profile RegisterProfile profile
 * @return RegisterByPhoneCodeInput
 */
public function withProfile($profile) {
  $this->profile = $profile;
  return $this;
}

/**
 * @param $forceLogin bool forceLogin
 * @return RegisterByPhoneCodeInput
 */
public function withForceLogin($forceLogin) {
  $this->forceLogin = $forceLogin;
  return $this;
}

/**
 * @param $generateToken bool generateToken
 * @return RegisterByPhoneCodeInput
 */
public function withGenerateToken($generateToken) {
  $this->generateToken = $generateToken;
  return $this;
}

/**
 * @param $clientIp string clientIp
 * @return RegisterByPhoneCodeInput
 */
public function withClientIp($clientIp) {
  $this->clientIp = $clientIp;
  return $this;
}

/**
 * @param $params string 设置用户自定义字段，要求符合 Array<{ key: string; value: string }> 格式
 * @return RegisterByPhoneCodeInput
 */
public function withParams($params) {
  $this->params = $params;
  return $this;
}

/**
 * @param $context string 请求上下文信息，将会传递到 pipeline 中
 * @return RegisterByPhoneCodeInput
 */
public function withContext($context) {
  $this->context = $context;
  return $this;
}
}
    

/**
 * SetUdfValueBatchInput
 */
class SetUdfValueBatchInput {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $targetId;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $key;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $value;

/**
 * @param $targetId string targetId
 * @param $key string key
 * @param $value string value
 */

public function __construct($targetId, $key, $value) {
$this->targetId = $targetId;
$this->key = $key;
$this->value = $value;
}

}
    

/**
 * UserDefinedDataInput
 */
class UserDefinedDataInput {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $key;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $value;

/**
 * @param $key string key
 */

public function __construct($key) {
$this->key = $key;
}

/**
 * @param $value string value
 * @return UserDefinedDataInput
 */
public function withValue($value) {
  $this->value = $value;
  return $this;
}
}
    

class RefreshToken {
  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $token;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $iat;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $exp;
}

/**
 * CreateUserInput
 */
class CreateUserInput {
  /**
   * 用户名，用户池内唯一
   * Optional
   * 
   * @var string
   * 
   */
  public $username;

  /**
   * 邮箱，不区分大小写，如 Bob@example.com 和 bob@example.com 会识别为同一个邮箱。用户池内唯一。
   * Optional
   * 
   * @var string
   * 
   */
  public $email;

  /**
   * 邮箱是否已验证
   * Optional
   * 
   * @var bool
   * 
   */
  public $emailVerified;

  /**
   * 手机号，用户池内唯一
   * Optional
   * 
   * @var string
   * 
   */
  public $phone;

  /**
   * 手机号是否已验证
   * Optional
   * 
   * @var bool
   * 
   */
  public $phoneVerified;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $unionid;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $openid;

  /**
   * 昵称，该字段不唯一。
   * Optional
   * 
   * @var string
   * 
   */
  public $nickname;

  /**
   * 头像链接，默认为 https://usercontents.authing.cn/authing-avatar.png
   * Optional
   * 
   * @var string
   * 
   */
  public $photo;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $password;

  /**
   * 注册方式
   * Optional
   * 
   * @var string[]
   * 
   */
  public $registerSource;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $browser;

  /**
   * 用户社会化登录第三方身份提供商返回的原始用户信息，非社会化登录方式注册的用户此字段为空。
   * Optional
   * 
   * @var string
   * 
   */
  public $oauth;

  /**
   * 用户累计登录次数，当你从你原有用户系统向 Authing 迁移的时候可以设置此字段。
   * Optional
   * 
   * @var int
   * 
   */
  public $loginsCount;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $lastLogin;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $company;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $lastIP;

  /**
   * 用户注册时间，当你从你原有用户系统向 Authing 迁移的时候可以设置此字段。
   * Optional
   * 
   * @var string
   * 
   */
  public $signedUp;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $blocked;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $isDeleted;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $device;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $givenName;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $familyName;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $middleName;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $profile;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $preferredUsername;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $website;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $gender;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $birthdate;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $zoneinfo;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $locale;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $address;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $formatted;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $streetAddress;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $locality;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $region;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $postalCode;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $country;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $externalId;


public function __construct() {

}

/**
 * @param $username string 用户名，用户池内唯一
 * @return CreateUserInput
 */
public function withUsername($username) {
  $this->username = $username;
  return $this;
}

/**
 * @param $email string 邮箱，不区分大小写，如 Bob@example.com 和 bob@example.com 会识别为同一个邮箱。用户池内唯一。
 * @return CreateUserInput
 */
public function withEmail($email) {
  $this->email = $email;
  return $this;
}

/**
 * @param $emailVerified bool 邮箱是否已验证
 * @return CreateUserInput
 */
public function withEmailVerified($emailVerified) {
  $this->emailVerified = $emailVerified;
  return $this;
}

/**
 * @param $phone string 手机号，用户池内唯一
 * @return CreateUserInput
 */
public function withPhone($phone) {
  $this->phone = $phone;
  return $this;
}

/**
 * @param $phoneVerified bool 手机号是否已验证
 * @return CreateUserInput
 */
public function withPhoneVerified($phoneVerified) {
  $this->phoneVerified = $phoneVerified;
  return $this;
}

/**
 * @param $unionid string unionid
 * @return CreateUserInput
 */
public function withUnionid($unionid) {
  $this->unionid = $unionid;
  return $this;
}

/**
 * @param $openid string openid
 * @return CreateUserInput
 */
public function withOpenid($openid) {
  $this->openid = $openid;
  return $this;
}

/**
 * @param $nickname string 昵称，该字段不唯一。
 * @return CreateUserInput
 */
public function withNickname($nickname) {
  $this->nickname = $nickname;
  return $this;
}

/**
 * @param $photo string 头像链接，默认为 https://usercontents.authing.cn/authing-avatar.png
 * @return CreateUserInput
 */
public function withPhoto($photo) {
  $this->photo = $photo;
  return $this;
}

/**
 * @param $password string password
 * @return CreateUserInput
 */
public function withPassword($password) {
  $this->password = $password;
  return $this;
}

/**
 * @param $registerSource string[] 注册方式
 * @return CreateUserInput
 */
public function withRegisterSource($registerSource) {
  $this->registerSource = $registerSource;
  return $this;
}

/**
 * @param $browser string browser
 * @return CreateUserInput
 */
public function withBrowser($browser) {
  $this->browser = $browser;
  return $this;
}

/**
 * @param $oauth string 用户社会化登录第三方身份提供商返回的原始用户信息，非社会化登录方式注册的用户此字段为空。
 * @return CreateUserInput
 */
public function withOauth($oauth) {
  $this->oauth = $oauth;
  return $this;
}

/**
 * @param $loginsCount int 用户累计登录次数，当你从你原有用户系统向 Authing 迁移的时候可以设置此字段。
 * @return CreateUserInput
 */
public function withLoginsCount($loginsCount) {
  $this->loginsCount = $loginsCount;
  return $this;
}

/**
 * @param $lastLogin string lastLogin
 * @return CreateUserInput
 */
public function withLastLogin($lastLogin) {
  $this->lastLogin = $lastLogin;
  return $this;
}

/**
 * @param $company string company
 * @return CreateUserInput
 */
public function withCompany($company) {
  $this->company = $company;
  return $this;
}

/**
 * @param $lastIP string lastIP
 * @return CreateUserInput
 */
public function withLastIp($lastIP) {
  $this->lastIP = $lastIP;
  return $this;
}

/**
 * @param $signedUp string 用户注册时间，当你从你原有用户系统向 Authing 迁移的时候可以设置此字段。
 * @return CreateUserInput
 */
public function withSignedUp($signedUp) {
  $this->signedUp = $signedUp;
  return $this;
}

/**
 * @param $blocked bool blocked
 * @return CreateUserInput
 */
public function withBlocked($blocked) {
  $this->blocked = $blocked;
  return $this;
}

/**
 * @param $isDeleted bool isDeleted
 * @return CreateUserInput
 */
public function withIsDeleted($isDeleted) {
  $this->isDeleted = $isDeleted;
  return $this;
}

/**
 * @param $device string device
 * @return CreateUserInput
 */
public function withDevice($device) {
  $this->device = $device;
  return $this;
}

/**
 * @param $name string name
 * @return CreateUserInput
 */
public function withName($name) {
  $this->name = $name;
  return $this;
}

/**
 * @param $givenName string givenName
 * @return CreateUserInput
 */
public function withGivenName($givenName) {
  $this->givenName = $givenName;
  return $this;
}

/**
 * @param $familyName string familyName
 * @return CreateUserInput
 */
public function withFamilyName($familyName) {
  $this->familyName = $familyName;
  return $this;
}

/**
 * @param $middleName string middleName
 * @return CreateUserInput
 */
public function withMiddleName($middleName) {
  $this->middleName = $middleName;
  return $this;
}

/**
 * @param $profile string profile
 * @return CreateUserInput
 */
public function withProfile($profile) {
  $this->profile = $profile;
  return $this;
}

/**
 * @param $preferredUsername string preferredUsername
 * @return CreateUserInput
 */
public function withPreferredUsername($preferredUsername) {
  $this->preferredUsername = $preferredUsername;
  return $this;
}

/**
 * @param $website string website
 * @return CreateUserInput
 */
public function withWebsite($website) {
  $this->website = $website;
  return $this;
}

/**
 * @param $gender string gender
 * @return CreateUserInput
 */
public function withGender($gender) {
  $this->gender = $gender;
  return $this;
}

/**
 * @param $birthdate string birthdate
 * @return CreateUserInput
 */
public function withBirthdate($birthdate) {
  $this->birthdate = $birthdate;
  return $this;
}

/**
 * @param $zoneinfo string zoneinfo
 * @return CreateUserInput
 */
public function withZoneinfo($zoneinfo) {
  $this->zoneinfo = $zoneinfo;
  return $this;
}

/**
 * @param $locale string locale
 * @return CreateUserInput
 */
public function withLocale($locale) {
  $this->locale = $locale;
  return $this;
}

/**
 * @param $address string address
 * @return CreateUserInput
 */
public function withAddress($address) {
  $this->address = $address;
  return $this;
}

/**
 * @param $formatted string formatted
 * @return CreateUserInput
 */
public function withFormatted($formatted) {
  $this->formatted = $formatted;
  return $this;
}

/**
 * @param $streetAddress string streetAddress
 * @return CreateUserInput
 */
public function withStreetAddress($streetAddress) {
  $this->streetAddress = $streetAddress;
  return $this;
}

/**
 * @param $locality string locality
 * @return CreateUserInput
 */
public function withLocality($locality) {
  $this->locality = $locality;
  return $this;
}

/**
 * @param $region string region
 * @return CreateUserInput
 */
public function withRegion($region) {
  $this->region = $region;
  return $this;
}

/**
 * @param $postalCode string postalCode
 * @return CreateUserInput
 */
public function withPostalCode($postalCode) {
  $this->postalCode = $postalCode;
  return $this;
}

/**
 * @param $country string country
 * @return CreateUserInput
 */
public function withCountry($country) {
  $this->country = $country;
  return $this;
}

/**
 * @param $externalId string externalId
 * @return CreateUserInput
 */
public function withExternalId($externalId) {
  $this->externalId = $externalId;
  return $this;
}
}
    

/**
 * UpdateUserInput
 */
class UpdateUserInput {
  /**
   * 邮箱。直接修改用户邮箱需要管理员权限，普通用户修改邮箱请使用 **updateEmail** 接口。
   * Optional
   * 
   * @var string
   * 
   */
  public $email;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $unionid;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $openid;

  /**
   * 邮箱是否已验证。直接修改 emailVerified 需要管理员权限。
   * Optional
   * 
   * @var bool
   * 
   */
  public $emailVerified;

  /**
   * 手机号。直接修改用户手机号需要管理员权限，普通用户修改邮箱请使用 **updatePhone** 接口。
   * Optional
   * 
   * @var string
   * 
   */
  public $phone;

  /**
   * 手机号是否已验证。直接修改 **phoneVerified** 需要管理员权限。
   * Optional
   * 
   * @var bool
   * 
   */
  public $phoneVerified;

  /**
   * 用户名，用户池内唯一
   * Optional
   * 
   * @var string
   * 
   */
  public $username;

  /**
   * 昵称，该字段不唯一。
   * Optional
   * 
   * @var string
   * 
   */
  public $nickname;

  /**
   * 密码。直接修改用户密码需要管理员权限，普通用户修改邮箱请使用 **updatePassword** 接口。
   * Optional
   * 
   * @var string
   * 
   */
  public $password;

  /**
   * 头像链接，默认为 https://usercontents.authing.cn/authing-avatar.png
   * Optional
   * 
   * @var string
   * 
   */
  public $photo;

  /**
   * 注册方式
   * Optional
   * 
   * @var string
   * 
   */
  public $company;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $browser;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $device;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $oauth;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $tokenExpiredAt;

  /**
   * 用户累计登录次数，当你从你原有用户系统向 Authing 迁移的时候可以设置此字段。
   * Optional
   * 
   * @var int
   * 
   */
  public $loginsCount;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $lastLogin;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $lastIP;

  /**
   * 用户注册时间，当你从你原有用户系统向 Authing 迁移的时候可以设置此字段。
   * Optional
   * 
   * @var bool
   * 
   */
  public $blocked;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $givenName;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $familyName;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $middleName;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $profile;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $preferredUsername;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $website;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $gender;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $birthdate;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $zoneinfo;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $locale;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $address;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $formatted;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $streetAddress;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $locality;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $region;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $postalCode;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $city;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $province;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $country;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $externalId;


public function __construct() {

}

/**
 * @param $email string 邮箱。直接修改用户邮箱需要管理员权限，普通用户修改邮箱请使用 **updateEmail** 接口。
 * @return UpdateUserInput
 */
public function withEmail($email) {
  $this->email = $email;
  return $this;
}

/**
 * @param $unionid string unionid
 * @return UpdateUserInput
 */
public function withUnionid($unionid) {
  $this->unionid = $unionid;
  return $this;
}

/**
 * @param $openid string openid
 * @return UpdateUserInput
 */
public function withOpenid($openid) {
  $this->openid = $openid;
  return $this;
}

/**
 * @param $emailVerified bool 邮箱是否已验证。直接修改 emailVerified 需要管理员权限。
 * @return UpdateUserInput
 */
public function withEmailVerified($emailVerified) {
  $this->emailVerified = $emailVerified;
  return $this;
}

/**
 * @param $phone string 手机号。直接修改用户手机号需要管理员权限，普通用户修改邮箱请使用 **updatePhone** 接口。
 * @return UpdateUserInput
 */
public function withPhone($phone) {
  $this->phone = $phone;
  return $this;
}

/**
 * @param $phoneVerified bool 手机号是否已验证。直接修改 **phoneVerified** 需要管理员权限。
 * @return UpdateUserInput
 */
public function withPhoneVerified($phoneVerified) {
  $this->phoneVerified = $phoneVerified;
  return $this;
}

/**
 * @param $username string 用户名，用户池内唯一
 * @return UpdateUserInput
 */
public function withUsername($username) {
  $this->username = $username;
  return $this;
}

/**
 * @param $nickname string 昵称，该字段不唯一。
 * @return UpdateUserInput
 */
public function withNickname($nickname) {
  $this->nickname = $nickname;
  return $this;
}

/**
 * @param $password string 密码。直接修改用户密码需要管理员权限，普通用户修改邮箱请使用 **updatePassword** 接口。
 * @return UpdateUserInput
 */
public function withPassword($password) {
  $this->password = $password;
  return $this;
}

/**
 * @param $photo string 头像链接，默认为 https://usercontents.authing.cn/authing-avatar.png
 * @return UpdateUserInput
 */
public function withPhoto($photo) {
  $this->photo = $photo;
  return $this;
}

/**
 * @param $company string 注册方式
 * @return UpdateUserInput
 */
public function withCompany($company) {
  $this->company = $company;
  return $this;
}

/**
 * @param $browser string browser
 * @return UpdateUserInput
 */
public function withBrowser($browser) {
  $this->browser = $browser;
  return $this;
}

/**
 * @param $device string device
 * @return UpdateUserInput
 */
public function withDevice($device) {
  $this->device = $device;
  return $this;
}

/**
 * @param $oauth string oauth
 * @return UpdateUserInput
 */
public function withOauth($oauth) {
  $this->oauth = $oauth;
  return $this;
}

/**
 * @param $tokenExpiredAt string tokenExpiredAt
 * @return UpdateUserInput
 */
public function withTokenExpiredAt($tokenExpiredAt) {
  $this->tokenExpiredAt = $tokenExpiredAt;
  return $this;
}

/**
 * @param $loginsCount int 用户累计登录次数，当你从你原有用户系统向 Authing 迁移的时候可以设置此字段。
 * @return UpdateUserInput
 */
public function withLoginsCount($loginsCount) {
  $this->loginsCount = $loginsCount;
  return $this;
}

/**
 * @param $lastLogin string lastLogin
 * @return UpdateUserInput
 */
public function withLastLogin($lastLogin) {
  $this->lastLogin = $lastLogin;
  return $this;
}

/**
 * @param $lastIP string lastIP
 * @return UpdateUserInput
 */
public function withLastIp($lastIP) {
  $this->lastIP = $lastIP;
  return $this;
}

/**
 * @param $blocked bool 用户注册时间，当你从你原有用户系统向 Authing 迁移的时候可以设置此字段。
 * @return UpdateUserInput
 */
public function withBlocked($blocked) {
  $this->blocked = $blocked;
  return $this;
}

/**
 * @param $name string name
 * @return UpdateUserInput
 */
public function withName($name) {
  $this->name = $name;
  return $this;
}

/**
 * @param $givenName string givenName
 * @return UpdateUserInput
 */
public function withGivenName($givenName) {
  $this->givenName = $givenName;
  return $this;
}

/**
 * @param $familyName string familyName
 * @return UpdateUserInput
 */
public function withFamilyName($familyName) {
  $this->familyName = $familyName;
  return $this;
}

/**
 * @param $middleName string middleName
 * @return UpdateUserInput
 */
public function withMiddleName($middleName) {
  $this->middleName = $middleName;
  return $this;
}

/**
 * @param $profile string profile
 * @return UpdateUserInput
 */
public function withProfile($profile) {
  $this->profile = $profile;
  return $this;
}

/**
 * @param $preferredUsername string preferredUsername
 * @return UpdateUserInput
 */
public function withPreferredUsername($preferredUsername) {
  $this->preferredUsername = $preferredUsername;
  return $this;
}

/**
 * @param $website string website
 * @return UpdateUserInput
 */
public function withWebsite($website) {
  $this->website = $website;
  return $this;
}

/**
 * @param $gender string gender
 * @return UpdateUserInput
 */
public function withGender($gender) {
  $this->gender = $gender;
  return $this;
}

/**
 * @param $birthdate string birthdate
 * @return UpdateUserInput
 */
public function withBirthdate($birthdate) {
  $this->birthdate = $birthdate;
  return $this;
}

/**
 * @param $zoneinfo string zoneinfo
 * @return UpdateUserInput
 */
public function withZoneinfo($zoneinfo) {
  $this->zoneinfo = $zoneinfo;
  return $this;
}

/**
 * @param $locale string locale
 * @return UpdateUserInput
 */
public function withLocale($locale) {
  $this->locale = $locale;
  return $this;
}

/**
 * @param $address string address
 * @return UpdateUserInput
 */
public function withAddress($address) {
  $this->address = $address;
  return $this;
}

/**
 * @param $formatted string formatted
 * @return UpdateUserInput
 */
public function withFormatted($formatted) {
  $this->formatted = $formatted;
  return $this;
}

/**
 * @param $streetAddress string streetAddress
 * @return UpdateUserInput
 */
public function withStreetAddress($streetAddress) {
  $this->streetAddress = $streetAddress;
  return $this;
}

/**
 * @param $locality string locality
 * @return UpdateUserInput
 */
public function withLocality($locality) {
  $this->locality = $locality;
  return $this;
}

/**
 * @param $region string region
 * @return UpdateUserInput
 */
public function withRegion($region) {
  $this->region = $region;
  return $this;
}

/**
 * @param $postalCode string postalCode
 * @return UpdateUserInput
 */
public function withPostalCode($postalCode) {
  $this->postalCode = $postalCode;
  return $this;
}

/**
 * @param $city string city
 * @return UpdateUserInput
 */
public function withCity($city) {
  $this->city = $city;
  return $this;
}

/**
 * @param $province string province
 * @return UpdateUserInput
 */
public function withProvince($province) {
  $this->province = $province;
  return $this;
}

/**
 * @param $country string country
 * @return UpdateUserInput
 */
public function withCountry($country) {
  $this->country = $country;
  return $this;
}

/**
 * @param $externalId string externalId
 * @return UpdateUserInput
 */
public function withExternalId($externalId) {
  $this->externalId = $externalId;
  return $this;
}
}
    

/**
 * UpdateUserpoolInput
 */
class UpdateUserpoolInput {
  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $logo;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $domain;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $description;

  /**
   * Optional
   * 
   * @var string[]
   * 
   */
  public $userpoolTypes;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $emailVerifiedDefault;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $sendWelcomeEmail;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $registerDisabled;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $appSsoEnabled;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $allowedOrigins;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $tokenExpiresAfter;

  /**
   * Optional
   * 
   * @var FrequentRegisterCheckConfigInput
   * 
   */
  public $frequentRegisterCheck;

  /**
   * Optional
   * 
   * @var LoginFailCheckConfigInput
   * 
   */
  public $loginFailCheck;

  /**
   * Optional
   * 
   * @var ChangePhoneStrategyInput
   * 
   */
  public $changePhoneStrategy;

  /**
   * Optional
   * 
   * @var ChangeEmailStrategyInput
   * 
   */
  public $changeEmailStrategy;

  /**
   * Optional
   * 
   * @var QrcodeLoginStrategyInput
   * 
   */
  public $qrcodeLoginStrategy;

  /**
   * Optional
   * 
   * @var App2WxappLoginStrategyInput
   * 
   */
  public $app2WxappLoginStrategy;

  /**
   * Optional
   * 
   * @var RegisterWhiteListConfigInput
   * 
   */
  public $whitelist;

  /**
   * 自定义短信服务商配置
   * Optional
   * 
   * @var CustomSmsProviderInput
   * 
   */
  public $customSMSProvider;

  /**
   * 是否要求邮箱必须验证才能登录（如果是通过邮箱登录的话）
   * Optional
   * 
   * @var bool
   * 
   */
  public $loginRequireEmailVerified;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $verifyCodeLength;


public function __construct() {

}

/**
 * @param $name string name
 * @return UpdateUserpoolInput
 */
public function withName($name) {
  $this->name = $name;
  return $this;
}

/**
 * @param $logo string logo
 * @return UpdateUserpoolInput
 */
public function withLogo($logo) {
  $this->logo = $logo;
  return $this;
}

/**
 * @param $domain string domain
 * @return UpdateUserpoolInput
 */
public function withDomain($domain) {
  $this->domain = $domain;
  return $this;
}

/**
 * @param $description string description
 * @return UpdateUserpoolInput
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}

/**
 * @param $userpoolTypes string[] userpoolTypes
 * @return UpdateUserpoolInput
 */
public function withUserpoolTypes($userpoolTypes) {
  $this->userpoolTypes = $userpoolTypes;
  return $this;
}

/**
 * @param $emailVerifiedDefault bool emailVerifiedDefault
 * @return UpdateUserpoolInput
 */
public function withEmailVerifiedDefault($emailVerifiedDefault) {
  $this->emailVerifiedDefault = $emailVerifiedDefault;
  return $this;
}

/**
 * @param $sendWelcomeEmail bool sendWelcomeEmail
 * @return UpdateUserpoolInput
 */
public function withSendWelcomeEmail($sendWelcomeEmail) {
  $this->sendWelcomeEmail = $sendWelcomeEmail;
  return $this;
}

/**
 * @param $registerDisabled bool registerDisabled
 * @return UpdateUserpoolInput
 */
public function withRegisterDisabled($registerDisabled) {
  $this->registerDisabled = $registerDisabled;
  return $this;
}

/**
 * @param $appSsoEnabled bool appSsoEnabled
 * @return UpdateUserpoolInput
 */
public function withAppSsoEnabled($appSsoEnabled) {
  $this->appSsoEnabled = $appSsoEnabled;
  return $this;
}

/**
 * @param $allowedOrigins string allowedOrigins
 * @return UpdateUserpoolInput
 */
public function withAllowedOrigins($allowedOrigins) {
  $this->allowedOrigins = $allowedOrigins;
  return $this;
}

/**
 * @param $tokenExpiresAfter int tokenExpiresAfter
 * @return UpdateUserpoolInput
 */
public function withTokenExpiresAfter($tokenExpiresAfter) {
  $this->tokenExpiresAfter = $tokenExpiresAfter;
  return $this;
}

/**
 * @param $frequentRegisterCheck FrequentRegisterCheckConfigInput frequentRegisterCheck
 * @return UpdateUserpoolInput
 */
public function withFrequentRegisterCheck($frequentRegisterCheck) {
  $this->frequentRegisterCheck = $frequentRegisterCheck;
  return $this;
}

/**
 * @param $loginFailCheck LoginFailCheckConfigInput loginFailCheck
 * @return UpdateUserpoolInput
 */
public function withLoginFailCheck($loginFailCheck) {
  $this->loginFailCheck = $loginFailCheck;
  return $this;
}

/**
 * @param $changePhoneStrategy ChangePhoneStrategyInput changePhoneStrategy
 * @return UpdateUserpoolInput
 */
public function withChangePhoneStrategy($changePhoneStrategy) {
  $this->changePhoneStrategy = $changePhoneStrategy;
  return $this;
}

/**
 * @param $changeEmailStrategy ChangeEmailStrategyInput changeEmailStrategy
 * @return UpdateUserpoolInput
 */
public function withChangeEmailStrategy($changeEmailStrategy) {
  $this->changeEmailStrategy = $changeEmailStrategy;
  return $this;
}

/**
 * @param $qrcodeLoginStrategy QrcodeLoginStrategyInput qrcodeLoginStrategy
 * @return UpdateUserpoolInput
 */
public function withQrcodeLoginStrategy($qrcodeLoginStrategy) {
  $this->qrcodeLoginStrategy = $qrcodeLoginStrategy;
  return $this;
}

/**
 * @param $app2WxappLoginStrategy App2WxappLoginStrategyInput app2WxappLoginStrategy
 * @return UpdateUserpoolInput
 */
public function withApp2WxappLoginStrategy($app2WxappLoginStrategy) {
  $this->app2WxappLoginStrategy = $app2WxappLoginStrategy;
  return $this;
}

/**
 * @param $whitelist RegisterWhiteListConfigInput whitelist
 * @return UpdateUserpoolInput
 */
public function withWhitelist($whitelist) {
  $this->whitelist = $whitelist;
  return $this;
}

/**
 * @param $customSMSProvider CustomSmsProviderInput 自定义短信服务商配置
 * @return UpdateUserpoolInput
 */
public function withCustomSmsProvider($customSMSProvider) {
  $this->customSMSProvider = $customSMSProvider;
  return $this;
}

/**
 * @param $loginRequireEmailVerified bool 是否要求邮箱必须验证才能登录（如果是通过邮箱登录的话）
 * @return UpdateUserpoolInput
 */
public function withLoginRequireEmailVerified($loginRequireEmailVerified) {
  $this->loginRequireEmailVerified = $loginRequireEmailVerified;
  return $this;
}

/**
 * @param $verifyCodeLength int verifyCodeLength
 * @return UpdateUserpoolInput
 */
public function withVerifyCodeLength($verifyCodeLength) {
  $this->verifyCodeLength = $verifyCodeLength;
  return $this;
}
}
    

/**
 * FrequentRegisterCheckConfigInput
 */
class FrequentRegisterCheckConfigInput {
  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $timeInterval;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $limit;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $enabled;


public function __construct() {

}

/**
 * @param $timeInterval int timeInterval
 * @return FrequentRegisterCheckConfigInput
 */
public function withTimeInterval($timeInterval) {
  $this->timeInterval = $timeInterval;
  return $this;
}

/**
 * @param $limit int limit
 * @return FrequentRegisterCheckConfigInput
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $enabled bool enabled
 * @return FrequentRegisterCheckConfigInput
 */
public function withEnabled($enabled) {
  $this->enabled = $enabled;
  return $this;
}
}
    

/**
 * LoginFailCheckConfigInput
 */
class LoginFailCheckConfigInput {
  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $timeInterval;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $limit;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $enabled;


public function __construct() {

}

/**
 * @param $timeInterval int timeInterval
 * @return LoginFailCheckConfigInput
 */
public function withTimeInterval($timeInterval) {
  $this->timeInterval = $timeInterval;
  return $this;
}

/**
 * @param $limit int limit
 * @return LoginFailCheckConfigInput
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $enabled bool enabled
 * @return LoginFailCheckConfigInput
 */
public function withEnabled($enabled) {
  $this->enabled = $enabled;
  return $this;
}
}
    

/**
 * ChangePhoneStrategyInput
 */
class ChangePhoneStrategyInput {
  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $verifyOldPhone;


public function __construct() {

}

/**
 * @param $verifyOldPhone bool verifyOldPhone
 * @return ChangePhoneStrategyInput
 */
public function withVerifyOldPhone($verifyOldPhone) {
  $this->verifyOldPhone = $verifyOldPhone;
  return $this;
}
}
    

/**
 * ChangeEmailStrategyInput
 */
class ChangeEmailStrategyInput {
  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $verifyOldEmail;


public function __construct() {

}

/**
 * @param $verifyOldEmail bool verifyOldEmail
 * @return ChangeEmailStrategyInput
 */
public function withVerifyOldEmail($verifyOldEmail) {
  $this->verifyOldEmail = $verifyOldEmail;
  return $this;
}
}
    

/**
 * QrcodeLoginStrategyInput
 */
class QrcodeLoginStrategyInput {
  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $qrcodeExpiresAfter;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $returnFullUserInfo;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $allowExchangeUserInfoFromBrowser;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $ticketExpiresAfter;


public function __construct() {

}

/**
 * @param $qrcodeExpiresAfter int qrcodeExpiresAfter
 * @return QrcodeLoginStrategyInput
 */
public function withQrcodeExpiresAfter($qrcodeExpiresAfter) {
  $this->qrcodeExpiresAfter = $qrcodeExpiresAfter;
  return $this;
}

/**
 * @param $returnFullUserInfo bool returnFullUserInfo
 * @return QrcodeLoginStrategyInput
 */
public function withReturnFullUserInfo($returnFullUserInfo) {
  $this->returnFullUserInfo = $returnFullUserInfo;
  return $this;
}

/**
 * @param $allowExchangeUserInfoFromBrowser bool allowExchangeUserInfoFromBrowser
 * @return QrcodeLoginStrategyInput
 */
public function withAllowExchangeUserInfoFromBrowser($allowExchangeUserInfoFromBrowser) {
  $this->allowExchangeUserInfoFromBrowser = $allowExchangeUserInfoFromBrowser;
  return $this;
}

/**
 * @param $ticketExpiresAfter int ticketExpiresAfter
 * @return QrcodeLoginStrategyInput
 */
public function withTicketExpiresAfter($ticketExpiresAfter) {
  $this->ticketExpiresAfter = $ticketExpiresAfter;
  return $this;
}
}
    

/**
 * App2WxappLoginStrategyInput
 */
class App2WxappLoginStrategyInput {
  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $ticketExpriresAfter;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $ticketExchangeUserInfoNeedSecret;


public function __construct() {

}

/**
 * @param $ticketExpriresAfter int ticketExpriresAfter
 * @return App2WxappLoginStrategyInput
 */
public function withTicketExpriresAfter($ticketExpriresAfter) {
  $this->ticketExpriresAfter = $ticketExpriresAfter;
  return $this;
}

/**
 * @param $ticketExchangeUserInfoNeedSecret bool ticketExchangeUserInfoNeedSecret
 * @return App2WxappLoginStrategyInput
 */
public function withTicketExchangeUserInfoNeedSecret($ticketExchangeUserInfoNeedSecret) {
  $this->ticketExchangeUserInfoNeedSecret = $ticketExchangeUserInfoNeedSecret;
  return $this;
}
}
    

/**
 * RegisterWhiteListConfigInput
 */
class RegisterWhiteListConfigInput {
  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $phoneEnabled;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $emailEnabled;

  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $usernameEnabled;


public function __construct() {

}

/**
 * @param $phoneEnabled bool phoneEnabled
 * @return RegisterWhiteListConfigInput
 */
public function withPhoneEnabled($phoneEnabled) {
  $this->phoneEnabled = $phoneEnabled;
  return $this;
}

/**
 * @param $emailEnabled bool emailEnabled
 * @return RegisterWhiteListConfigInput
 */
public function withEmailEnabled($emailEnabled) {
  $this->emailEnabled = $emailEnabled;
  return $this;
}

/**
 * @param $usernameEnabled bool usernameEnabled
 * @return RegisterWhiteListConfigInput
 */
public function withUsernameEnabled($usernameEnabled) {
  $this->usernameEnabled = $usernameEnabled;
  return $this;
}
}
    

/**
 * CustomSmsProviderInput
 */
class CustomSmsProviderInput {
  /**
   * Optional
   * 
   * @var bool
   * 
   */
  public $enabled;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $provider;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $config;


public function __construct() {

}

/**
 * @param $enabled bool enabled
 * @return CustomSmsProviderInput
 */
public function withEnabled($enabled) {
  $this->enabled = $enabled;
  return $this;
}

/**
 * @param $provider string provider
 * @return CustomSmsProviderInput
 */
public function withProvider($provider) {
  $this->provider = $provider;
  return $this;
}

/**
 * @param $config string config
 * @return CustomSmsProviderInput
 */
public function withConfig($config) {
  $this->config = $config;
  return $this;
}
}
    

class RefreshAccessTokenRes {
  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $accessToken;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $exp;

  /**
   * Optional
   * 
   * @var int
   * 
   */
  public $iat;
}

/**
 * 批量删除返回结果
 */
class BatchOperationResult {
  /**
   * 删除成功的个数
   * Required
   * 
   * @var int
   * 
   */
  public $succeedCount;

  /**
   * 删除失败的个数
   * Required
   * 
   * @var int
   * 
   */
  public $failedCount;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $message;

  /**
   * Optional
   * 
   * @var string[]
   * 
   */
  public $errors;
}

class KeyValuePair {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $key;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $value;
}

/**
 * SocialConnectionFieldInput
 */
class SocialConnectionFieldInput {
  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $key;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $label;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $type;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $placeholder;

  /**
   * Optional
   * 
   * @var SocialConnectionFieldInput[]
   * 
   */
  public $children;


public function __construct() {

}

/**
 * @param $key string key
 * @return SocialConnectionFieldInput
 */
public function withKey($key) {
  $this->key = $key;
  return $this;
}

/**
 * @param $label string label
 * @return SocialConnectionFieldInput
 */
public function withLabel($label) {
  $this->label = $label;
  return $this;
}

/**
 * @param $type string type
 * @return SocialConnectionFieldInput
 */
public function withType($type) {
  $this->type = $type;
  return $this;
}

/**
 * @param $placeholder string placeholder
 * @return SocialConnectionFieldInput
 */
public function withPlaceholder($placeholder) {
  $this->placeholder = $placeholder;
  return $this;
}

/**
 * @param $children SocialConnectionFieldInput[] children
 * @return SocialConnectionFieldInput
 */
public function withChildren($children) {
  $this->children = $children;
  return $this;
}
}
    

/**
 * CreateSocialConnectionInput
 */
class CreateSocialConnectionInput {
  /**
   * Required
   * 
   * @var string
   * 
   */
  public $provider;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $name;

  /**
   * Required
   * 
   * @var string
   * 
   */
  public $logo;

  /**
   * Optional
   * 
   * @var string
   * 
   */
  public $description;

  /**
   * Optional
   * 
   * @var SocialConnectionFieldInput[]
   * 
   */
  public $fields;

/**
 * @param $provider string provider
 * @param $name string name
 * @param $logo string logo
 */

public function __construct($provider, $name, $logo) {
$this->provider = $provider;
$this->name = $name;
$this->logo = $logo;
}

/**
 * @param $description string description
 * @return CreateSocialConnectionInput
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}

/**
 * @param $fields SocialConnectionFieldInput[] fields
 * @return CreateSocialConnectionInput
 */
public function withFields($fields) {
  $this->fields = $fields;
  return $this;
}
}
    

    
class AddMemberResponse {

    /**
     * @var Node
     */
    public $addMember;
}
    
class AddMemberParam {

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

    /**
     * Optional
     * 
     * @var SortByEnum
     */
    public $sortBy;

    /**
     * Optional
     * 
     * @var bool
     */
    public $includeChildrenNodes;

    /**
     * Optional
     * 
     * @var string
     */
    public $nodeId;

    /**
     * Optional
     * 
     * @var string
     */
    public $orgId;

    /**
     * Optional
     * 
     * @var string
     */
    public $nodeCode;

    /**
     * Required
     * 
     * @var string[]
     */
    public $userIds;

    /**
     * Optional
     * 
     * @var bool
     */
    public $isLeader;

/**
 * @param $userIds string[]
 */
public function __construct($userIds) {
$this->userIds = $userIds;
}

/**
 * @param $page int
 * @return AddMemberParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return AddMemberParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $sortBy SortByEnum
 * @return AddMemberParam
 */
public function withSortBy($sortBy) {
  $this->sortBy = $sortBy;
  return $this;
}

/**
 * @param $includeChildrenNodes bool
 * @return AddMemberParam
 */
public function withIncludeChildrenNodes($includeChildrenNodes) {
  $this->includeChildrenNodes = $includeChildrenNodes;
  return $this;
}

/**
 * @param $nodeId string
 * @return AddMemberParam
 */
public function withNodeId($nodeId) {
  $this->nodeId = $nodeId;
  return $this;
}

/**
 * @param $orgId string
 * @return AddMemberParam
 */
public function withOrgId($orgId) {
  $this->orgId = $orgId;
  return $this;
}

/**
 * @param $nodeCode string
 * @return AddMemberParam
 */
public function withNodeCode($nodeCode) {
  $this->nodeCode = $nodeCode;
  return $this;
}

/**
 * @param $isLeader bool
 * @return AddMemberParam
 */
public function withIsLeader($isLeader) {
  $this->isLeader = $isLeader;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::AddMemberDocument,
        "operationName" => "addMember",
        "variables" => $this
      ];
    }

    const AddMemberDocument = <<<EOF
mutation addMember(\$page: Int, \$limit: Int, \$sortBy: SortByEnum, \$includeChildrenNodes: Boolean, \$nodeId: String, \$orgId: String, \$nodeCode: String, \$userIds: [String!]!, \$isLeader: Boolean) {
  addMember(nodeId: \$nodeId, orgId: \$orgId, nodeCode: \$nodeCode, userIds: \$userIds, isLeader: \$isLeader) {
    id
    orgId
    name
    nameI18n
    description
    descriptionI18n
    order
    code
    root
    depth
    path
    createdAt
    updatedAt
    children
    users(page: \$page, limit: \$limit, sortBy: \$sortBy, includeChildrenNodes: \$includeChildrenNodes) {
      totalCount
      list {
        id
        arn
        userPoolId
        username
        status
        email
        emailVerified
        phone
        phoneVerified
        unionid
        openid
        nickname
        registerSource
        photo
        password
        oauth
        token
        tokenExpiredAt
        loginsCount
        lastLogin
        lastIP
        signedUp
        blocked
        isDeleted
        device
        browser
        company
        name
        givenName
        familyName
        middleName
        profile
        preferredUsername
        website
        gender
        birthdate
        zoneinfo
        locale
        address
        formatted
        streetAddress
        locality
        region
        postalCode
        city
        province
        country
        createdAt
        updatedAt
        externalId
      }
    }
  }
}
EOF;
}
    

    
class AddNodeResponse {

    /**
     * @var Org
     */
    public $addNode;
}
    
class AddNodeParam {

    /**
     * Required
     * 
     * @var string
     */
    public $orgId;

    /**
     * Optional
     * 
     * @var string
     */
    public $parentNodeId;

    /**
     * Required
     * 
     * @var string
     */
    public $name;

    /**
     * Optional
     * 
     * @var string
     */
    public $nameI18n;

    /**
     * Optional
     * 
     * @var string
     */
    public $description;

    /**
     * Optional
     * 
     * @var string
     */
    public $descriptionI18n;

    /**
     * Optional
     * 
     * @var int
     */
    public $order;

    /**
     * Optional
     * 
     * @var string
     */
    public $code;

/**
 * @param $orgId string
 * @param $name string
 */
public function __construct($orgId,$name) {
$this->orgId = $orgId;
$this->name = $name;
}

/**
 * @param $parentNodeId string
 * @return AddNodeParam
 */
public function withParentNodeId($parentNodeId) {
  $this->parentNodeId = $parentNodeId;
  return $this;
}

/**
 * @param $nameI18n string
 * @return AddNodeParam
 */
public function withNameI18n($nameI18n) {
  $this->nameI18n = $nameI18n;
  return $this;
}

/**
 * @param $description string
 * @return AddNodeParam
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}

/**
 * @param $descriptionI18n string
 * @return AddNodeParam
 */
public function withDescriptionI18n($descriptionI18n) {
  $this->descriptionI18n = $descriptionI18n;
  return $this;
}

/**
 * @param $order int
 * @return AddNodeParam
 */
public function withOrder($order) {
  $this->order = $order;
  return $this;
}

/**
 * @param $code string
 * @return AddNodeParam
 */
public function withCode($code) {
  $this->code = $code;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::AddNodeDocument,
        "operationName" => "addNode",
        "variables" => $this
      ];
    }

    const AddNodeDocument = <<<EOF
mutation addNode(\$orgId: String!, \$parentNodeId: String, \$name: String!, \$nameI18n: String, \$description: String, \$descriptionI18n: String, \$order: Int, \$code: String) {
  addNode(orgId: \$orgId, parentNodeId: \$parentNodeId, name: \$name, nameI18n: \$nameI18n, description: \$description, descriptionI18n: \$descriptionI18n, order: \$order, code: \$code) {
    id
    rootNode {
      id
      orgId
      name
      nameI18n
      description
      descriptionI18n
      order
      code
      root
      depth
      path
      createdAt
      updatedAt
      children
    }
    nodes {
      id
      orgId
      name
      nameI18n
      description
      descriptionI18n
      order
      code
      root
      depth
      path
      createdAt
      updatedAt
      children
    }
  }
}
EOF;
}
    

    
class AddNodeV2Response {

    /**
     * @var Node
     */
    public $addNodeV2;
}
    
class AddNodeV2Param {

    /**
     * Required
     * 
     * @var string
     */
    public $orgId;

    /**
     * Optional
     * 
     * @var string
     */
    public $parentNodeId;

    /**
     * Required
     * 
     * @var string
     */
    public $name;

    /**
     * Optional
     * 
     * @var string
     */
    public $nameI18n;

    /**
     * Optional
     * 
     * @var string
     */
    public $description;

    /**
     * Optional
     * 
     * @var string
     */
    public $descriptionI18n;

    /**
     * Optional
     * 
     * @var int
     */
    public $order;

    /**
     * Optional
     * 
     * @var string
     */
    public $code;

/**
 * @param $orgId string
 * @param $name string
 */
public function __construct($orgId,$name) {
$this->orgId = $orgId;
$this->name = $name;
}

/**
 * @param $parentNodeId string
 * @return AddNodeV2Param
 */
public function withParentNodeId($parentNodeId) {
  $this->parentNodeId = $parentNodeId;
  return $this;
}

/**
 * @param $nameI18n string
 * @return AddNodeV2Param
 */
public function withNameI18n($nameI18n) {
  $this->nameI18n = $nameI18n;
  return $this;
}

/**
 * @param $description string
 * @return AddNodeV2Param
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}

/**
 * @param $descriptionI18n string
 * @return AddNodeV2Param
 */
public function withDescriptionI18n($descriptionI18n) {
  $this->descriptionI18n = $descriptionI18n;
  return $this;
}

/**
 * @param $order int
 * @return AddNodeV2Param
 */
public function withOrder($order) {
  $this->order = $order;
  return $this;
}

/**
 * @param $code string
 * @return AddNodeV2Param
 */
public function withCode($code) {
  $this->code = $code;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::AddNodeV2Document,
        "operationName" => "addNodeV2",
        "variables" => $this
      ];
    }

    const AddNodeV2Document = <<<EOF
mutation addNodeV2(\$orgId: String!, \$parentNodeId: String, \$name: String!, \$nameI18n: String, \$description: String, \$descriptionI18n: String, \$order: Int, \$code: String) {
  addNodeV2(orgId: \$orgId, parentNodeId: \$parentNodeId, name: \$name, nameI18n: \$nameI18n, description: \$description, descriptionI18n: \$descriptionI18n, order: \$order, code: \$code) {
    id
    orgId
    name
    nameI18n
    description
    descriptionI18n
    order
    code
    root
    depth
    path
    createdAt
    updatedAt
    children
  }
}
EOF;
}
    

    
class AddPolicyAssignmentsResponse {

    /**
     * @var CommonMessage
     */
    public $addPolicyAssignments;
}
    
class AddPolicyAssignmentsParam {

    /**
     * Required
     * 
     * @var string[]
     */
    public $policies;

    /**
     * Required
     * 
     * @var PolicyAssignmentTargetType
     */
    public $targetType;

    /**
     * Optional
     * 
     * @var string[]
     */
    public $targetIdentifiers;

    /**
     * Optional
     * 
     * @var bool
     */
    public $inheritByChildren;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

/**
 * @param $policies string[]
 * @param $targetType PolicyAssignmentTargetType
 */
public function __construct($policies,$targetType) {
$this->policies = $policies;
$this->targetType = $targetType;
}

/**
 * @param $targetIdentifiers string[]
 * @return AddPolicyAssignmentsParam
 */
public function withTargetIdentifiers($targetIdentifiers) {
  $this->targetIdentifiers = $targetIdentifiers;
  return $this;
}

/**
 * @param $inheritByChildren bool
 * @return AddPolicyAssignmentsParam
 */
public function withInheritByChildren($inheritByChildren) {
  $this->inheritByChildren = $inheritByChildren;
  return $this;
}

/**
 * @param $namespace string
 * @return AddPolicyAssignmentsParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::AddPolicyAssignmentsDocument,
        "operationName" => "addPolicyAssignments",
        "variables" => $this
      ];
    }

    const AddPolicyAssignmentsDocument = <<<EOF
mutation addPolicyAssignments(\$policies: [String!]!, \$targetType: PolicyAssignmentTargetType!, \$targetIdentifiers: [String!], \$inheritByChildren: Boolean, \$namespace: String) {
  addPolicyAssignments(policies: \$policies, targetType: \$targetType, targetIdentifiers: \$targetIdentifiers, inheritByChildren: \$inheritByChildren, namespace: \$namespace) {
    message
    code
  }
}
EOF;
}
    

    
class AddUserToGroupResponse {

    /**
     * @var CommonMessage
     */
    public $addUserToGroup;
}
    
class AddUserToGroupParam {

    /**
     * Required
     * 
     * @var string[]
     */
    public $userIds;

    /**
     * Optional
     * 
     * @var string
     */
    public $code;

/**
 * @param $userIds string[]
 */
public function __construct($userIds) {
$this->userIds = $userIds;
}

/**
 * @param $code string
 * @return AddUserToGroupParam
 */
public function withCode($code) {
  $this->code = $code;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::AddUserToGroupDocument,
        "operationName" => "addUserToGroup",
        "variables" => $this
      ];
    }

    const AddUserToGroupDocument = <<<EOF
mutation addUserToGroup(\$userIds: [String!]!, \$code: String) {
  addUserToGroup(userIds: \$userIds, code: \$code) {
    message
    code
  }
}
EOF;
}
    

    
class AddWhitelistResponse {

    /**
     * @var WhiteList[]
     */
    public $addWhitelist;
}
    
class AddWhitelistParam {

    /**
     * Required
     * 
     * @var WhitelistType
     */
    public $type;

    /**
     * Required
     * 
     * @var string[]
     */
    public $list;

/**
 * @param $type WhitelistType
 * @param $list string[]
 */
public function __construct($type,$list) {
$this->type = $type;
$this->list = $list;
}

    function createRequest() {
      return [
        "query" => self::AddWhitelistDocument,
        "operationName" => "addWhitelist",
        "variables" => $this
      ];
    }

    const AddWhitelistDocument = <<<EOF
mutation addWhitelist(\$type: WhitelistType!, \$list: [String!]!) {
  addWhitelist(type: \$type, list: \$list) {
    createdAt
    updatedAt
    value
  }
}
EOF;
}
    

    
class AllowResponse {

    /**
     * @var CommonMessage
     */
    public $allow;
}
    
class AllowParam {

    /**
     * Required
     * 
     * @var string
     */
    public $resource;

    /**
     * Required
     * 
     * @var string
     */
    public $action;

    /**
     * Optional
     * 
     * @var string
     */
    public $userId;

    /**
     * Optional
     * 
     * @var string[]
     */
    public $userIds;

    /**
     * Optional
     * 
     * @var string
     */
    public $roleCode;

    /**
     * Optional
     * 
     * @var string[]
     */
    public $roleCodes;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

/**
 * @param $resource string
 * @param $action string
 */
public function __construct($resource,$action) {
$this->resource = $resource;
$this->action = $action;
}

/**
 * @param $userId string
 * @return AllowParam
 */
public function withUserId($userId) {
  $this->userId = $userId;
  return $this;
}

/**
 * @param $userIds string[]
 * @return AllowParam
 */
public function withUserIds($userIds) {
  $this->userIds = $userIds;
  return $this;
}

/**
 * @param $roleCode string
 * @return AllowParam
 */
public function withRoleCode($roleCode) {
  $this->roleCode = $roleCode;
  return $this;
}

/**
 * @param $roleCodes string[]
 * @return AllowParam
 */
public function withRoleCodes($roleCodes) {
  $this->roleCodes = $roleCodes;
  return $this;
}

/**
 * @param $namespace string
 * @return AllowParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::AllowDocument,
        "operationName" => "allow",
        "variables" => $this
      ];
    }

    const AllowDocument = <<<EOF
mutation allow(\$resource: String!, \$action: String!, \$userId: String, \$userIds: [String!], \$roleCode: String, \$roleCodes: [String!], \$namespace: String) {
  allow(resource: \$resource, action: \$action, userId: \$userId, userIds: \$userIds, roleCode: \$roleCode, roleCodes: \$roleCodes, namespace: \$namespace) {
    message
    code
  }
}
EOF;
}
    

    
class AssignRoleResponse {

    /**
     * @var CommonMessage
     */
    public $assignRole;
}
    
class AssignRoleParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Optional
     * 
     * @var string
     */
    public $roleCode;

    /**
     * Optional
     * 
     * @var string[]
     */
    public $roleCodes;

    /**
     * Optional
     * 
     * @var string[]
     */
    public $userIds;

    /**
     * Optional
     * 
     * @var string[]
     */
    public $groupCodes;

    /**
     * Optional
     * 
     * @var string[]
     */
    public $nodeCodes;

public function __construct() {

}

/**
 * @param $namespace string
 * @return AssignRoleParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}

/**
 * @param $roleCode string
 * @return AssignRoleParam
 */
public function withRoleCode($roleCode) {
  $this->roleCode = $roleCode;
  return $this;
}

/**
 * @param $roleCodes string[]
 * @return AssignRoleParam
 */
public function withRoleCodes($roleCodes) {
  $this->roleCodes = $roleCodes;
  return $this;
}

/**
 * @param $userIds string[]
 * @return AssignRoleParam
 */
public function withUserIds($userIds) {
  $this->userIds = $userIds;
  return $this;
}

/**
 * @param $groupCodes string[]
 * @return AssignRoleParam
 */
public function withGroupCodes($groupCodes) {
  $this->groupCodes = $groupCodes;
  return $this;
}

/**
 * @param $nodeCodes string[]
 * @return AssignRoleParam
 */
public function withNodeCodes($nodeCodes) {
  $this->nodeCodes = $nodeCodes;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::AssignRoleDocument,
        "operationName" => "assignRole",
        "variables" => $this
      ];
    }

    const AssignRoleDocument = <<<EOF
mutation assignRole(\$namespace: String, \$roleCode: String, \$roleCodes: [String], \$userIds: [String!], \$groupCodes: [String!], \$nodeCodes: [String!]) {
  assignRole(namespace: \$namespace, roleCode: \$roleCode, roleCodes: \$roleCodes, userIds: \$userIds, groupCodes: \$groupCodes, nodeCodes: \$nodeCodes) {
    message
    code
  }
}
EOF;
}
    

    
class AuthorizeResourceResponse {

    /**
     * @var CommonMessage
     */
    public $authorizeResource;
}
    
class AuthorizeResourceParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Optional
     * 
     * @var string
     */
    public $resource;

    /**
     * Optional
     * 
     * @var ResourceType
     */
    public $resourceType;

    /**
     * Optional
     * 
     * @var AuthorizeResourceOpt[]
     */
    public $opts;

public function __construct() {

}

/**
 * @param $namespace string
 * @return AuthorizeResourceParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}

/**
 * @param $resource string
 * @return AuthorizeResourceParam
 */
public function withResource($resource) {
  $this->resource = $resource;
  return $this;
}

/**
 * @param $resourceType ResourceType
 * @return AuthorizeResourceParam
 */
public function withResourceType($resourceType) {
  $this->resourceType = $resourceType;
  return $this;
}

/**
 * @param $opts AuthorizeResourceOpt[]
 * @return AuthorizeResourceParam
 */
public function withOpts($opts) {
  $this->opts = $opts;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::AuthorizeResourceDocument,
        "operationName" => "authorizeResource",
        "variables" => $this
      ];
    }

    const AuthorizeResourceDocument = <<<EOF
mutation authorizeResource(\$namespace: String, \$resource: String, \$resourceType: ResourceType, \$opts: [AuthorizeResourceOpt]) {
  authorizeResource(namespace: \$namespace, resource: \$resource, resourceType: \$resourceType, opts: \$opts) {
    code
    message
  }
}
EOF;
}
    

    
class BindEmailResponse {

    /**
     * @var User
     */
    public $bindEmail;
}
    
class BindEmailParam {

    /**
     * Required
     * 
     * @var string
     */
    public $email;

    /**
     * Required
     * 
     * @var string
     */
    public $emailCode;

/**
 * @param $email string
 * @param $emailCode string
 */
public function __construct($email,$emailCode) {
$this->email = $email;
$this->emailCode = $emailCode;
}

    function createRequest() {
      return [
        "query" => self::BindEmailDocument,
        "operationName" => "bindEmail",
        "variables" => $this
      ];
    }

    const BindEmailDocument = <<<EOF
mutation bindEmail(\$email: String!, \$emailCode: String!) {
  bindEmail(email: \$email, emailCode: \$emailCode) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
  }
}
EOF;
}
    

    
class BindPhoneResponse {

    /**
     * @var User
     */
    public $bindPhone;
}
    
class BindPhoneParam {

    /**
     * Required
     * 
     * @var string
     */
    public $phone;

    /**
     * Required
     * 
     * @var string
     */
    public $phoneCode;

/**
 * @param $phone string
 * @param $phoneCode string
 */
public function __construct($phone,$phoneCode) {
$this->phone = $phone;
$this->phoneCode = $phoneCode;
}

    function createRequest() {
      return [
        "query" => self::BindPhoneDocument,
        "operationName" => "bindPhone",
        "variables" => $this
      ];
    }

    const BindPhoneDocument = <<<EOF
mutation bindPhone(\$phone: String!, \$phoneCode: String!) {
  bindPhone(phone: \$phone, phoneCode: \$phoneCode) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
  }
}
EOF;
}
    

    
class ChangeMfaResponse {

    /**
     * @var Mfa
     */
    public $changeMfa;
}
    
class ChangeMfaParam {

    /**
     * Optional
     * 
     * @var bool
     */
    public $enable;

    /**
     * Optional
     * 
     * @var string
     */
    public $id;

    /**
     * Optional
     * 
     * @var string
     */
    public $userId;

    /**
     * Optional
     * 
     * @var string
     */
    public $userPoolId;

    /**
     * Optional
     * 
     * @var bool
     */
    public $refresh;

public function __construct() {

}

/**
 * @param $enable bool
 * @return ChangeMfaParam
 */
public function withEnable($enable) {
  $this->enable = $enable;
  return $this;
}

/**
 * @param $id string
 * @return ChangeMfaParam
 */
public function withId($id) {
  $this->id = $id;
  return $this;
}

/**
 * @param $userId string
 * @return ChangeMfaParam
 */
public function withUserId($userId) {
  $this->userId = $userId;
  return $this;
}

/**
 * @param $userPoolId string
 * @return ChangeMfaParam
 */
public function withUserPoolId($userPoolId) {
  $this->userPoolId = $userPoolId;
  return $this;
}

/**
 * @param $refresh bool
 * @return ChangeMfaParam
 */
public function withRefresh($refresh) {
  $this->refresh = $refresh;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::ChangeMfaDocument,
        "operationName" => "changeMfa",
        "variables" => $this
      ];
    }

    const ChangeMfaDocument = <<<EOF
mutation changeMfa(\$enable: Boolean, \$id: String, \$userId: String, \$userPoolId: String, \$refresh: Boolean) {
  changeMfa(enable: \$enable, id: \$id, userId: \$userId, userPoolId: \$userPoolId, refresh: \$refresh) {
    id
    userId
    userPoolId
    enable
    secret
  }
}
EOF;
}
    

    
class ConfigEmailTemplateResponse {

    /**
     * @var EmailTemplate
     */
    public $configEmailTemplate;
}
    
class ConfigEmailTemplateParam {

    /**
     * Required
     * 
     * @var ConfigEmailTemplateInput
     */
    public $input;

/**
 * @param $input ConfigEmailTemplateInput
 */
public function __construct($input) {
$this->input = $input;
}

    function createRequest() {
      return [
        "query" => self::ConfigEmailTemplateDocument,
        "operationName" => "configEmailTemplate",
        "variables" => $this
      ];
    }

    const ConfigEmailTemplateDocument = <<<EOF
mutation configEmailTemplate(\$input: ConfigEmailTemplateInput!) {
  configEmailTemplate(input: \$input) {
    type
    name
    subject
    sender
    content
    redirectTo
    hasURL
    expiresIn
    enabled
    isSystem
  }
}
EOF;
}
    

    
class CreateFunctionResponse {

    /**
     * @var Function
     */
    public $createFunction;
}
    
class CreateFunctionParam {

    /**
     * Required
     * 
     * @var CreateFunctionInput
     */
    public $input;

/**
 * @param $input CreateFunctionInput
 */
public function __construct($input) {
$this->input = $input;
}

    function createRequest() {
      return [
        "query" => self::CreateFunctionDocument,
        "operationName" => "createFunction",
        "variables" => $this
      ];
    }

    const CreateFunctionDocument = <<<EOF
mutation createFunction(\$input: CreateFunctionInput!) {
  createFunction(input: \$input) {
    id
    name
    sourceCode
    description
    url
  }
}
EOF;
}
    

    
class CreateGroupResponse {

    /**
     * @var Group
     */
    public $createGroup;
}
    
class CreateGroupParam {

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Required
     * 
     * @var string
     */
    public $name;

    /**
     * Optional
     * 
     * @var string
     */
    public $description;

/**
 * @param $code string
 * @param $name string
 */
public function __construct($code,$name) {
$this->code = $code;
$this->name = $name;
}

/**
 * @param $description string
 * @return CreateGroupParam
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::CreateGroupDocument,
        "operationName" => "createGroup",
        "variables" => $this
      ];
    }

    const CreateGroupDocument = <<<EOF
mutation createGroup(\$code: String!, \$name: String!, \$description: String) {
  createGroup(code: \$code, name: \$name, description: \$description) {
    code
    name
    description
    createdAt
    updatedAt
  }
}
EOF;
}
    

    
class CreateOrgResponse {

    /**
     * @var Org
     */
    public $createOrg;
}
    
class CreateOrgParam {

    /**
     * Required
     * 
     * @var string
     */
    public $name;

    /**
     * Optional
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var string
     */
    public $description;

/**
 * @param $name string
 */
public function __construct($name) {
$this->name = $name;
}

/**
 * @param $code string
 * @return CreateOrgParam
 */
public function withCode($code) {
  $this->code = $code;
  return $this;
}

/**
 * @param $description string
 * @return CreateOrgParam
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::CreateOrgDocument,
        "operationName" => "createOrg",
        "variables" => $this
      ];
    }

    const CreateOrgDocument = <<<EOF
mutation createOrg(\$name: String!, \$code: String, \$description: String) {
  createOrg(name: \$name, code: \$code, description: \$description) {
    id
    rootNode {
      id
      orgId
      name
      nameI18n
      description
      descriptionI18n
      order
      code
      root
      depth
      path
      createdAt
      updatedAt
      children
    }
    nodes {
      id
      orgId
      name
      nameI18n
      description
      descriptionI18n
      order
      code
      root
      depth
      path
      createdAt
      updatedAt
      children
    }
  }
}
EOF;
}
    

    
class CreatePolicyResponse {

    /**
     * @var Policy
     */
    public $createPolicy;
}
    
class CreatePolicyParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var string
     */
    public $description;

    /**
     * Required
     * 
     * @var PolicyStatementInput[]
     */
    public $statements;

/**
 * @param $code string
 * @param $statements PolicyStatementInput[]
 */
public function __construct($code,$statements) {
$this->code = $code;
$this->statements = $statements;
}

/**
 * @param $namespace string
 * @return CreatePolicyParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}

/**
 * @param $description string
 * @return CreatePolicyParam
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::CreatePolicyDocument,
        "operationName" => "createPolicy",
        "variables" => $this
      ];
    }

    const CreatePolicyDocument = <<<EOF
mutation createPolicy(\$namespace: String, \$code: String!, \$description: String, \$statements: [PolicyStatementInput!]!) {
  createPolicy(namespace: \$namespace, code: \$code, description: \$description, statements: \$statements) {
    namespace
    code
    isDefault
    description
    statements {
      resource
      actions
      effect
      condition {
        param
        operator
        value
      }
    }
    createdAt
    updatedAt
    assignmentsCount
  }
}
EOF;
}
    

    
class CreateRoleResponse {

    /**
     * @var Role
     */
    public $createRole;
}
    
class CreateRoleParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var string
     */
    public $description;

    /**
     * Optional
     * 
     * @var string
     */
    public $parent;

/**
 * @param $code string
 */
public function __construct($code) {
$this->code = $code;
}

/**
 * @param $namespace string
 * @return CreateRoleParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}

/**
 * @param $description string
 * @return CreateRoleParam
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}

/**
 * @param $parent string
 * @return CreateRoleParam
 */
public function withParent($parent) {
  $this->parent = $parent;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::CreateRoleDocument,
        "operationName" => "createRole",
        "variables" => $this
      ];
    }

    const CreateRoleDocument = <<<EOF
mutation createRole(\$namespace: String, \$code: String!, \$description: String, \$parent: String) {
  createRole(namespace: \$namespace, code: \$code, description: \$description, parent: \$parent) {
    namespace
    code
    arn
    description
    createdAt
    updatedAt
    parent {
      namespace
      code
      arn
      description
      createdAt
      updatedAt
    }
  }
}
EOF;
}
    

    
class CreateSocialConnectionInstanceResponse {

    /**
     * @var SocialConnectionInstance
     */
    public $createSocialConnectionInstance;
}
    
class CreateSocialConnectionInstanceParam {

    /**
     * Required
     * 
     * @var CreateSocialConnectionInstanceInput
     */
    public $input;

/**
 * @param $input CreateSocialConnectionInstanceInput
 */
public function __construct($input) {
$this->input = $input;
}

    function createRequest() {
      return [
        "query" => self::CreateSocialConnectionInstanceDocument,
        "operationName" => "createSocialConnectionInstance",
        "variables" => $this
      ];
    }

    const CreateSocialConnectionInstanceDocument = <<<EOF
mutation createSocialConnectionInstance(\$input: CreateSocialConnectionInstanceInput!) {
  createSocialConnectionInstance(input: \$input) {
    provider
    enabled
    fields {
      key
      value
    }
  }
}
EOF;
}
    

    
class CreateUserResponse {

    /**
     * @var User
     */
    public $createUser;
}
    
class CreateUserParam {

    /**
     * Required
     * 
     * @var CreateUserInput
     */
    public $userInfo;

    /**
     * Optional
     * 
     * @var bool
     */
    public $keepPassword;

/**
 * @param $userInfo CreateUserInput
 */
public function __construct($userInfo) {
$this->userInfo = $userInfo;
}

/**
 * @param $keepPassword bool
 * @return CreateUserParam
 */
public function withKeepPassword($keepPassword) {
  $this->keepPassword = $keepPassword;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::CreateUserDocument,
        "operationName" => "createUser",
        "variables" => $this
      ];
    }

    const CreateUserDocument = <<<EOF
mutation createUser(\$userInfo: CreateUserInput!, \$keepPassword: Boolean) {
  createUser(userInfo: \$userInfo, keepPassword: \$keepPassword) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
    externalId
  }
}
EOF;
}
    

    
class CreateUserpoolResponse {

    /**
     * @var UserPool
     */
    public $createUserpool;
}
    
class CreateUserpoolParam {

    /**
     * Required
     * 
     * @var string
     */
    public $name;

    /**
     * Required
     * 
     * @var string
     */
    public $domain;

    /**
     * Optional
     * 
     * @var string
     */
    public $description;

    /**
     * Optional
     * 
     * @var string
     */
    public $logo;

    /**
     * Optional
     * 
     * @var string[]
     */
    public $userpoolTypes;

/**
 * @param $name string
 * @param $domain string
 */
public function __construct($name,$domain) {
$this->name = $name;
$this->domain = $domain;
}

/**
 * @param $description string
 * @return CreateUserpoolParam
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}

/**
 * @param $logo string
 * @return CreateUserpoolParam
 */
public function withLogo($logo) {
  $this->logo = $logo;
  return $this;
}

/**
 * @param $userpoolTypes string[]
 * @return CreateUserpoolParam
 */
public function withUserpoolTypes($userpoolTypes) {
  $this->userpoolTypes = $userpoolTypes;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::CreateUserpoolDocument,
        "operationName" => "createUserpool",
        "variables" => $this
      ];
    }

    const CreateUserpoolDocument = <<<EOF
mutation createUserpool(\$name: String!, \$domain: String!, \$description: String, \$logo: String, \$userpoolTypes: [String!]) {
  createUserpool(name: \$name, domain: \$domain, description: \$description, logo: \$logo, userpoolTypes: \$userpoolTypes) {
    id
    name
    domain
    description
    secret
    jwtSecret
    userpoolTypes {
      code
      name
      description
      image
      sdks
    }
    logo
    createdAt
    updatedAt
    emailVerifiedDefault
    sendWelcomeEmail
    registerDisabled
    appSsoEnabled
    showWxQRCodeWhenRegisterDisabled
    allowedOrigins
    tokenExpiresAfter
    isDeleted
    frequentRegisterCheck {
      timeInterval
      limit
      enabled
    }
    loginFailCheck {
      timeInterval
      limit
      enabled
    }
    changePhoneStrategy {
      verifyOldPhone
    }
    changeEmailStrategy {
      verifyOldEmail
    }
    qrcodeLoginStrategy {
      qrcodeExpiresAfter
      returnFullUserInfo
      allowExchangeUserInfoFromBrowser
      ticketExpiresAfter
    }
    app2WxappLoginStrategy {
      ticketExpriresAfter
      ticketExchangeUserInfoNeedSecret
    }
    whitelist {
      phoneEnabled
      emailEnabled
      usernameEnabled
    }
    customSMSProvider {
      enabled
      provider
    }
    packageType
  }
}
EOF;
}
    

    
class DeleteFunctionResponse {

    /**
     * @var CommonMessage
     */
    public $deleteFunction;
}
    
class DeleteFunctionParam {

    /**
     * Required
     * 
     * @var string
     */
    public $id;

/**
 * @param $id string
 */
public function __construct($id) {
$this->id = $id;
}

    function createRequest() {
      return [
        "query" => self::DeleteFunctionDocument,
        "operationName" => "deleteFunction",
        "variables" => $this
      ];
    }

    const DeleteFunctionDocument = <<<EOF
mutation deleteFunction(\$id: String!) {
  deleteFunction(id: \$id) {
    message
    code
  }
}
EOF;
}
    

    
class DeleteGroupsResponse {

    /**
     * @var CommonMessage
     */
    public $deleteGroups;
}
    
class DeleteGroupsParam {

    /**
     * Required
     * 
     * @var string[]
     */
    public $codeList;

/**
 * @param $codeList string[]
 */
public function __construct($codeList) {
$this->codeList = $codeList;
}

    function createRequest() {
      return [
        "query" => self::DeleteGroupsDocument,
        "operationName" => "deleteGroups",
        "variables" => $this
      ];
    }

    const DeleteGroupsDocument = <<<EOF
mutation deleteGroups(\$codeList: [String!]!) {
  deleteGroups(codeList: \$codeList) {
    message
    code
  }
}
EOF;
}
    

    
class DeleteNodeResponse {

    /**
     * @var CommonMessage
     */
    public $deleteNode;
}
    
class DeleteNodeParam {

    /**
     * Required
     * 
     * @var string
     */
    public $orgId;

    /**
     * Required
     * 
     * @var string
     */
    public $nodeId;

/**
 * @param $orgId string
 * @param $nodeId string
 */
public function __construct($orgId,$nodeId) {
$this->orgId = $orgId;
$this->nodeId = $nodeId;
}

    function createRequest() {
      return [
        "query" => self::DeleteNodeDocument,
        "operationName" => "deleteNode",
        "variables" => $this
      ];
    }

    const DeleteNodeDocument = <<<EOF
mutation deleteNode(\$orgId: String!, \$nodeId: String!) {
  deleteNode(orgId: \$orgId, nodeId: \$nodeId) {
    message
    code
  }
}
EOF;
}
    

    
class DeleteOrgResponse {

    /**
     * @var CommonMessage
     */
    public $deleteOrg;
}
    
class DeleteOrgParam {

    /**
     * Required
     * 
     * @var string
     */
    public $id;

/**
 * @param $id string
 */
public function __construct($id) {
$this->id = $id;
}

    function createRequest() {
      return [
        "query" => self::DeleteOrgDocument,
        "operationName" => "deleteOrg",
        "variables" => $this
      ];
    }

    const DeleteOrgDocument = <<<EOF
mutation deleteOrg(\$id: String!) {
  deleteOrg(id: \$id) {
    message
    code
  }
}
EOF;
}
    

    
class DeletePoliciesResponse {

    /**
     * @var CommonMessage
     */
    public $deletePolicies;
}
    
class DeletePoliciesParam {

    /**
     * Required
     * 
     * @var string[]
     */
    public $codeList;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

/**
 * @param $codeList string[]
 */
public function __construct($codeList) {
$this->codeList = $codeList;
}

/**
 * @param $namespace string
 * @return DeletePoliciesParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::DeletePoliciesDocument,
        "operationName" => "deletePolicies",
        "variables" => $this
      ];
    }

    const DeletePoliciesDocument = <<<EOF
mutation deletePolicies(\$codeList: [String!]!, \$namespace: String) {
  deletePolicies(codeList: \$codeList, namespace: \$namespace) {
    message
    code
  }
}
EOF;
}
    

    
class DeletePolicyResponse {

    /**
     * @var CommonMessage
     */
    public $deletePolicy;
}
    
class DeletePolicyParam {

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

/**
 * @param $code string
 */
public function __construct($code) {
$this->code = $code;
}

/**
 * @param $namespace string
 * @return DeletePolicyParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::DeletePolicyDocument,
        "operationName" => "deletePolicy",
        "variables" => $this
      ];
    }

    const DeletePolicyDocument = <<<EOF
mutation deletePolicy(\$code: String!, \$namespace: String) {
  deletePolicy(code: \$code, namespace: \$namespace) {
    message
    code
  }
}
EOF;
}
    

    
class DeleteRoleResponse {

    /**
     * @var CommonMessage
     */
    public $deleteRole;
}
    
class DeleteRoleParam {

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

/**
 * @param $code string
 */
public function __construct($code) {
$this->code = $code;
}

/**
 * @param $namespace string
 * @return DeleteRoleParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::DeleteRoleDocument,
        "operationName" => "deleteRole",
        "variables" => $this
      ];
    }

    const DeleteRoleDocument = <<<EOF
mutation deleteRole(\$code: String!, \$namespace: String) {
  deleteRole(code: \$code, namespace: \$namespace) {
    message
    code
  }
}
EOF;
}
    

    
class DeleteRolesResponse {

    /**
     * @var CommonMessage
     */
    public $deleteRoles;
}
    
class DeleteRolesParam {

    /**
     * Required
     * 
     * @var string[]
     */
    public $codeList;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

/**
 * @param $codeList string[]
 */
public function __construct($codeList) {
$this->codeList = $codeList;
}

/**
 * @param $namespace string
 * @return DeleteRolesParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::DeleteRolesDocument,
        "operationName" => "deleteRoles",
        "variables" => $this
      ];
    }

    const DeleteRolesDocument = <<<EOF
mutation deleteRoles(\$codeList: [String!]!, \$namespace: String) {
  deleteRoles(codeList: \$codeList, namespace: \$namespace) {
    message
    code
  }
}
EOF;
}
    

    
class DeleteUserResponse {

    /**
     * @var CommonMessage
     */
    public $deleteUser;
}
    
class DeleteUserParam {

    /**
     * Required
     * 
     * @var string
     */
    public $id;

/**
 * @param $id string
 */
public function __construct($id) {
$this->id = $id;
}

    function createRequest() {
      return [
        "query" => self::DeleteUserDocument,
        "operationName" => "deleteUser",
        "variables" => $this
      ];
    }

    const DeleteUserDocument = <<<EOF
mutation deleteUser(\$id: String!) {
  deleteUser(id: \$id) {
    message
    code
  }
}
EOF;
}
    

    
class DeleteUserpoolResponse {

    /**
     * @var CommonMessage
     */
    public $deleteUserpool;
}
    
class DeleteUserpoolParam {



    function createRequest() {
      return [
        "query" => self::DeleteUserpoolDocument,
        "operationName" => "deleteUserpool",
        "variables" => $this
      ];
    }

    const DeleteUserpoolDocument = <<<EOF
mutation deleteUserpool {
  deleteUserpool {
    message
    code
  }
}
EOF;
}
    

    
class DeleteUsersResponse {

    /**
     * @var CommonMessage
     */
    public $deleteUsers;
}
    
class DeleteUsersParam {

    /**
     * Required
     * 
     * @var string[]
     */
    public $ids;

/**
 * @param $ids string[]
 */
public function __construct($ids) {
$this->ids = $ids;
}

    function createRequest() {
      return [
        "query" => self::DeleteUsersDocument,
        "operationName" => "deleteUsers",
        "variables" => $this
      ];
    }

    const DeleteUsersDocument = <<<EOF
mutation deleteUsers(\$ids: [String!]!) {
  deleteUsers(ids: \$ids) {
    message
    code
  }
}
EOF;
}
    

    
class DisableEmailTemplateResponse {

    /**
     * @var EmailTemplate
     */
    public $disableEmailTemplate;
}
    
class DisableEmailTemplateParam {

    /**
     * Required
     * 
     * @var EmailTemplateType
     */
    public $type;

/**
 * @param $type EmailTemplateType
 */
public function __construct($type) {
$this->type = $type;
}

    function createRequest() {
      return [
        "query" => self::DisableEmailTemplateDocument,
        "operationName" => "disableEmailTemplate",
        "variables" => $this
      ];
    }

    const DisableEmailTemplateDocument = <<<EOF
mutation disableEmailTemplate(\$type: EmailTemplateType!) {
  disableEmailTemplate(type: \$type) {
    type
    name
    subject
    sender
    content
    redirectTo
    hasURL
    expiresIn
    enabled
    isSystem
  }
}
EOF;
}
    

    
class DisableSocialConnectionInstanceResponse {

    /**
     * @var SocialConnectionInstance
     */
    public $disableSocialConnectionInstance;
}
    
class DisableSocialConnectionInstanceParam {

    /**
     * Required
     * 
     * @var string
     */
    public $provider;

/**
 * @param $provider string
 */
public function __construct($provider) {
$this->provider = $provider;
}

    function createRequest() {
      return [
        "query" => self::DisableSocialConnectionInstanceDocument,
        "operationName" => "disableSocialConnectionInstance",
        "variables" => $this
      ];
    }

    const DisableSocialConnectionInstanceDocument = <<<EOF
mutation disableSocialConnectionInstance(\$provider: String!) {
  disableSocialConnectionInstance(provider: \$provider) {
    provider
    enabled
    fields {
      key
      value
    }
  }
}
EOF;
}
    

    
class DisbalePolicyAssignmentResponse {

    /**
     * @var CommonMessage
     */
    public $disbalePolicyAssignment;
}
    
class DisbalePolicyAssignmentParam {

    /**
     * Required
     * 
     * @var string
     */
    public $policy;

    /**
     * Required
     * 
     * @var PolicyAssignmentTargetType
     */
    public $targetType;

    /**
     * Required
     * 
     * @var string
     */
    public $targetIdentifier;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

/**
 * @param $policy string
 * @param $targetType PolicyAssignmentTargetType
 * @param $targetIdentifier string
 */
public function __construct($policy,$targetType,$targetIdentifier) {
$this->policy = $policy;
$this->targetType = $targetType;
$this->targetIdentifier = $targetIdentifier;
}

/**
 * @param $namespace string
 * @return DisbalePolicyAssignmentParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::DisbalePolicyAssignmentDocument,
        "operationName" => "disbalePolicyAssignment",
        "variables" => $this
      ];
    }

    const DisbalePolicyAssignmentDocument = <<<EOF
mutation disbalePolicyAssignment(\$policy: String!, \$targetType: PolicyAssignmentTargetType!, \$targetIdentifier: String!, \$namespace: String) {
  disbalePolicyAssignment(policy: \$policy, targetType: \$targetType, targetIdentifier: \$targetIdentifier, namespace: \$namespace) {
    message
    code
  }
}
EOF;
}
    

    
class EnableEmailTemplateResponse {

    /**
     * @var EmailTemplate
     */
    public $enableEmailTemplate;
}
    
class EnableEmailTemplateParam {

    /**
     * Required
     * 
     * @var EmailTemplateType
     */
    public $type;

/**
 * @param $type EmailTemplateType
 */
public function __construct($type) {
$this->type = $type;
}

    function createRequest() {
      return [
        "query" => self::EnableEmailTemplateDocument,
        "operationName" => "enableEmailTemplate",
        "variables" => $this
      ];
    }

    const EnableEmailTemplateDocument = <<<EOF
mutation enableEmailTemplate(\$type: EmailTemplateType!) {
  enableEmailTemplate(type: \$type) {
    type
    name
    subject
    sender
    content
    redirectTo
    hasURL
    expiresIn
    enabled
    isSystem
  }
}
EOF;
}
    

    
class EnablePolicyAssignmentResponse {

    /**
     * @var CommonMessage
     */
    public $enablePolicyAssignment;
}
    
class EnablePolicyAssignmentParam {

    /**
     * Required
     * 
     * @var string
     */
    public $policy;

    /**
     * Required
     * 
     * @var PolicyAssignmentTargetType
     */
    public $targetType;

    /**
     * Required
     * 
     * @var string
     */
    public $targetIdentifier;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

/**
 * @param $policy string
 * @param $targetType PolicyAssignmentTargetType
 * @param $targetIdentifier string
 */
public function __construct($policy,$targetType,$targetIdentifier) {
$this->policy = $policy;
$this->targetType = $targetType;
$this->targetIdentifier = $targetIdentifier;
}

/**
 * @param $namespace string
 * @return EnablePolicyAssignmentParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::EnablePolicyAssignmentDocument,
        "operationName" => "enablePolicyAssignment",
        "variables" => $this
      ];
    }

    const EnablePolicyAssignmentDocument = <<<EOF
mutation enablePolicyAssignment(\$policy: String!, \$targetType: PolicyAssignmentTargetType!, \$targetIdentifier: String!, \$namespace: String) {
  enablePolicyAssignment(policy: \$policy, targetType: \$targetType, targetIdentifier: \$targetIdentifier, namespace: \$namespace) {
    message
    code
  }
}
EOF;
}
    

    
class EnableSocialConnectionInstanceResponse {

    /**
     * @var SocialConnectionInstance
     */
    public $enableSocialConnectionInstance;
}
    
class EnableSocialConnectionInstanceParam {

    /**
     * Required
     * 
     * @var string
     */
    public $provider;

/**
 * @param $provider string
 */
public function __construct($provider) {
$this->provider = $provider;
}

    function createRequest() {
      return [
        "query" => self::EnableSocialConnectionInstanceDocument,
        "operationName" => "enableSocialConnectionInstance",
        "variables" => $this
      ];
    }

    const EnableSocialConnectionInstanceDocument = <<<EOF
mutation enableSocialConnectionInstance(\$provider: String!) {
  enableSocialConnectionInstance(provider: \$provider) {
    provider
    enabled
    fields {
      key
      value
    }
  }
}
EOF;
}
    

    
class LoginByEmailResponse {

    /**
     * @var User
     */
    public $loginByEmail;
}
    
class LoginByEmailParam {

    /**
     * Required
     * 
     * @var LoginByEmailInput
     */
    public $input;

/**
 * @param $input LoginByEmailInput
 */
public function __construct($input) {
$this->input = $input;
}

    function createRequest() {
      return [
        "query" => self::LoginByEmailDocument,
        "operationName" => "loginByEmail",
        "variables" => $this
      ];
    }

    const LoginByEmailDocument = <<<EOF
mutation loginByEmail(\$input: LoginByEmailInput!) {
  loginByEmail(input: \$input) {
    id
    arn
    status
    userPoolId
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
    externalId
  }
}
EOF;
}
    

    
class LoginByPhoneCodeResponse {

    /**
     * @var User
     */
    public $loginByPhoneCode;
}
    
class LoginByPhoneCodeParam {

    /**
     * Required
     * 
     * @var LoginByPhoneCodeInput
     */
    public $input;

/**
 * @param $input LoginByPhoneCodeInput
 */
public function __construct($input) {
$this->input = $input;
}

    function createRequest() {
      return [
        "query" => self::LoginByPhoneCodeDocument,
        "operationName" => "loginByPhoneCode",
        "variables" => $this
      ];
    }

    const LoginByPhoneCodeDocument = <<<EOF
mutation loginByPhoneCode(\$input: LoginByPhoneCodeInput!) {
  loginByPhoneCode(input: \$input) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
    externalId
  }
}
EOF;
}
    

    
class LoginByPhonePasswordResponse {

    /**
     * @var User
     */
    public $loginByPhonePassword;
}
    
class LoginByPhonePasswordParam {

    /**
     * Required
     * 
     * @var LoginByPhonePasswordInput
     */
    public $input;

/**
 * @param $input LoginByPhonePasswordInput
 */
public function __construct($input) {
$this->input = $input;
}

    function createRequest() {
      return [
        "query" => self::LoginByPhonePasswordDocument,
        "operationName" => "loginByPhonePassword",
        "variables" => $this
      ];
    }

    const LoginByPhonePasswordDocument = <<<EOF
mutation loginByPhonePassword(\$input: LoginByPhonePasswordInput!) {
  loginByPhonePassword(input: \$input) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
    externalId
  }
}
EOF;
}
    

    
class LoginBySubAccountResponse {

    /**
     * @var User
     */
    public $loginBySubAccount;
}
    
class LoginBySubAccountParam {

    /**
     * Required
     * 
     * @var string
     */
    public $account;

    /**
     * Required
     * 
     * @var string
     */
    public $password;

    /**
     * Optional
     * 
     * @var string
     */
    public $captchaCode;

    /**
     * Optional
     * 
     * @var string
     */
    public $clientIp;

/**
 * @param $account string
 * @param $password string
 */
public function __construct($account,$password) {
$this->account = $account;
$this->password = $password;
}

/**
 * @param $captchaCode string
 * @return LoginBySubAccountParam
 */
public function withCaptchaCode($captchaCode) {
  $this->captchaCode = $captchaCode;
  return $this;
}

/**
 * @param $clientIp string
 * @return LoginBySubAccountParam
 */
public function withClientIp($clientIp) {
  $this->clientIp = $clientIp;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::LoginBySubAccountDocument,
        "operationName" => "loginBySubAccount",
        "variables" => $this
      ];
    }

    const LoginBySubAccountDocument = <<<EOF
mutation loginBySubAccount(\$account: String!, \$password: String!, \$captchaCode: String, \$clientIp: String) {
  loginBySubAccount(account: \$account, password: \$password, captchaCode: \$captchaCode, clientIp: \$clientIp) {
    id
    arn
    status
    userPoolId
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
    externalId
  }
}
EOF;
}
    

    
class LoginByUsernameResponse {

    /**
     * @var User
     */
    public $loginByUsername;
}
    
class LoginByUsernameParam {

    /**
     * Required
     * 
     * @var LoginByUsernameInput
     */
    public $input;

/**
 * @param $input LoginByUsernameInput
 */
public function __construct($input) {
$this->input = $input;
}

    function createRequest() {
      return [
        "query" => self::LoginByUsernameDocument,
        "operationName" => "loginByUsername",
        "variables" => $this
      ];
    }

    const LoginByUsernameDocument = <<<EOF
mutation loginByUsername(\$input: LoginByUsernameInput!) {
  loginByUsername(input: \$input) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
    externalId
  }
}
EOF;
}
    

    
class MoveNodeResponse {

    /**
     * @var Org
     */
    public $moveNode;
}
    
class MoveNodeParam {

    /**
     * Required
     * 
     * @var string
     */
    public $orgId;

    /**
     * Required
     * 
     * @var string
     */
    public $nodeId;

    /**
     * Required
     * 
     * @var string
     */
    public $targetParentId;

/**
 * @param $orgId string
 * @param $nodeId string
 * @param $targetParentId string
 */
public function __construct($orgId,$nodeId,$targetParentId) {
$this->orgId = $orgId;
$this->nodeId = $nodeId;
$this->targetParentId = $targetParentId;
}

    function createRequest() {
      return [
        "query" => self::MoveNodeDocument,
        "operationName" => "moveNode",
        "variables" => $this
      ];
    }

    const MoveNodeDocument = <<<EOF
mutation moveNode(\$orgId: String!, \$nodeId: String!, \$targetParentId: String!) {
  moveNode(orgId: \$orgId, nodeId: \$nodeId, targetParentId: \$targetParentId) {
    id
    rootNode {
      id
      orgId
      name
      nameI18n
      description
      descriptionI18n
      order
      code
      root
      depth
      path
      createdAt
      updatedAt
      children
    }
    nodes {
      id
      orgId
      name
      nameI18n
      description
      descriptionI18n
      order
      code
      root
      depth
      path
      createdAt
      updatedAt
      children
    }
  }
}
EOF;
}
    

    
class RefreshAccessTokenResponse {

    /**
     * @var RefreshAccessTokenRes
     */
    public $refreshAccessToken;
}
    
class RefreshAccessTokenParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $accessToken;

public function __construct() {

}

/**
 * @param $accessToken string
 * @return RefreshAccessTokenParam
 */
public function withAccessToken($accessToken) {
  $this->accessToken = $accessToken;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::RefreshAccessTokenDocument,
        "operationName" => "refreshAccessToken",
        "variables" => $this
      ];
    }

    const RefreshAccessTokenDocument = <<<EOF
mutation refreshAccessToken(\$accessToken: String) {
  refreshAccessToken(accessToken: \$accessToken) {
    accessToken
    exp
    iat
  }
}
EOF;
}
    

    
class RefreshTokenResponse {

    /**
     * @var RefreshToken
     */
    public $refreshToken;
}
    
class RefreshTokenParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $id;

public function __construct() {

}

/**
 * @param $id string
 * @return RefreshTokenParam
 */
public function withId($id) {
  $this->id = $id;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::RefreshTokenDocument,
        "operationName" => "refreshToken",
        "variables" => $this
      ];
    }

    const RefreshTokenDocument = <<<EOF
mutation refreshToken(\$id: String) {
  refreshToken(id: \$id) {
    token
    iat
    exp
  }
}
EOF;
}
    

    
class RefreshUserpoolSecretResponse {

    /**
     * @var string
     */
    public $refreshUserpoolSecret;
}
    
class RefreshUserpoolSecretParam {



    function createRequest() {
      return [
        "query" => self::RefreshUserpoolSecretDocument,
        "operationName" => "refreshUserpoolSecret",
        "variables" => $this
      ];
    }

    const RefreshUserpoolSecretDocument = <<<EOF
mutation refreshUserpoolSecret {
  refreshUserpoolSecret
}
EOF;
}
    

    
class RegisterByEmailResponse {

    /**
     * @var User
     */
    public $registerByEmail;
}
    
class RegisterByEmailParam {

    /**
     * Required
     * 
     * @var RegisterByEmailInput
     */
    public $input;

/**
 * @param $input RegisterByEmailInput
 */
public function __construct($input) {
$this->input = $input;
}

    function createRequest() {
      return [
        "query" => self::RegisterByEmailDocument,
        "operationName" => "registerByEmail",
        "variables" => $this
      ];
    }

    const RegisterByEmailDocument = <<<EOF
mutation registerByEmail(\$input: RegisterByEmailInput!) {
  registerByEmail(input: \$input) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
    externalId
  }
}
EOF;
}
    

    
class RegisterByPhoneCodeResponse {

    /**
     * @var User
     */
    public $registerByPhoneCode;
}
    
class RegisterByPhoneCodeParam {

    /**
     * Required
     * 
     * @var RegisterByPhoneCodeInput
     */
    public $input;

/**
 * @param $input RegisterByPhoneCodeInput
 */
public function __construct($input) {
$this->input = $input;
}

    function createRequest() {
      return [
        "query" => self::RegisterByPhoneCodeDocument,
        "operationName" => "registerByPhoneCode",
        "variables" => $this
      ];
    }

    const RegisterByPhoneCodeDocument = <<<EOF
mutation registerByPhoneCode(\$input: RegisterByPhoneCodeInput!) {
  registerByPhoneCode(input: \$input) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
    externalId
  }
}
EOF;
}
    

    
class RegisterByUsernameResponse {

    /**
     * @var User
     */
    public $registerByUsername;
}
    
class RegisterByUsernameParam {

    /**
     * Required
     * 
     * @var RegisterByUsernameInput
     */
    public $input;

/**
 * @param $input RegisterByUsernameInput
 */
public function __construct($input) {
$this->input = $input;
}

    function createRequest() {
      return [
        "query" => self::RegisterByUsernameDocument,
        "operationName" => "registerByUsername",
        "variables" => $this
      ];
    }

    const RegisterByUsernameDocument = <<<EOF
mutation registerByUsername(\$input: RegisterByUsernameInput!) {
  registerByUsername(input: \$input) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
    externalId
  }
}
EOF;
}
    

    
class RemoveMemberResponse {

    /**
     * @var Node
     */
    public $removeMember;
}
    
class RemoveMemberParam {

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

    /**
     * Optional
     * 
     * @var SortByEnum
     */
    public $sortBy;

    /**
     * Optional
     * 
     * @var bool
     */
    public $includeChildrenNodes;

    /**
     * Optional
     * 
     * @var string
     */
    public $nodeId;

    /**
     * Optional
     * 
     * @var string
     */
    public $orgId;

    /**
     * Optional
     * 
     * @var string
     */
    public $nodeCode;

    /**
     * Required
     * 
     * @var string[]
     */
    public $userIds;

/**
 * @param $userIds string[]
 */
public function __construct($userIds) {
$this->userIds = $userIds;
}

/**
 * @param $page int
 * @return RemoveMemberParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return RemoveMemberParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $sortBy SortByEnum
 * @return RemoveMemberParam
 */
public function withSortBy($sortBy) {
  $this->sortBy = $sortBy;
  return $this;
}

/**
 * @param $includeChildrenNodes bool
 * @return RemoveMemberParam
 */
public function withIncludeChildrenNodes($includeChildrenNodes) {
  $this->includeChildrenNodes = $includeChildrenNodes;
  return $this;
}

/**
 * @param $nodeId string
 * @return RemoveMemberParam
 */
public function withNodeId($nodeId) {
  $this->nodeId = $nodeId;
  return $this;
}

/**
 * @param $orgId string
 * @return RemoveMemberParam
 */
public function withOrgId($orgId) {
  $this->orgId = $orgId;
  return $this;
}

/**
 * @param $nodeCode string
 * @return RemoveMemberParam
 */
public function withNodeCode($nodeCode) {
  $this->nodeCode = $nodeCode;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::RemoveMemberDocument,
        "operationName" => "removeMember",
        "variables" => $this
      ];
    }

    const RemoveMemberDocument = <<<EOF
mutation removeMember(\$page: Int, \$limit: Int, \$sortBy: SortByEnum, \$includeChildrenNodes: Boolean, \$nodeId: String, \$orgId: String, \$nodeCode: String, \$userIds: [String!]!) {
  removeMember(nodeId: \$nodeId, orgId: \$orgId, nodeCode: \$nodeCode, userIds: \$userIds) {
    id
    name
    nameI18n
    description
    descriptionI18n
    order
    code
    root
    depth
    createdAt
    updatedAt
    children
    users(page: \$page, limit: \$limit, sortBy: \$sortBy, includeChildrenNodes: \$includeChildrenNodes) {
      totalCount
      list {
        id
        arn
        userPoolId
        status
        username
        email
        emailVerified
        phone
        phoneVerified
        unionid
        openid
        nickname
        registerSource
        photo
        password
        oauth
        token
        tokenExpiredAt
        loginsCount
        lastLogin
        lastIP
        signedUp
        blocked
        isDeleted
        device
        browser
        company
        name
        givenName
        familyName
        middleName
        profile
        preferredUsername
        website
        gender
        birthdate
        zoneinfo
        locale
        address
        formatted
        streetAddress
        locality
        region
        postalCode
        city
        province
        country
        createdAt
        updatedAt
      }
    }
  }
}
EOF;
}
    

    
class RemovePolicyAssignmentsResponse {

    /**
     * @var CommonMessage
     */
    public $removePolicyAssignments;
}
    
class RemovePolicyAssignmentsParam {

    /**
     * Required
     * 
     * @var string[]
     */
    public $policies;

    /**
     * Required
     * 
     * @var PolicyAssignmentTargetType
     */
    public $targetType;

    /**
     * Optional
     * 
     * @var string[]
     */
    public $targetIdentifiers;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

/**
 * @param $policies string[]
 * @param $targetType PolicyAssignmentTargetType
 */
public function __construct($policies,$targetType) {
$this->policies = $policies;
$this->targetType = $targetType;
}

/**
 * @param $targetIdentifiers string[]
 * @return RemovePolicyAssignmentsParam
 */
public function withTargetIdentifiers($targetIdentifiers) {
  $this->targetIdentifiers = $targetIdentifiers;
  return $this;
}

/**
 * @param $namespace string
 * @return RemovePolicyAssignmentsParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::RemovePolicyAssignmentsDocument,
        "operationName" => "removePolicyAssignments",
        "variables" => $this
      ];
    }

    const RemovePolicyAssignmentsDocument = <<<EOF
mutation removePolicyAssignments(\$policies: [String!]!, \$targetType: PolicyAssignmentTargetType!, \$targetIdentifiers: [String!], \$namespace: String) {
  removePolicyAssignments(policies: \$policies, targetType: \$targetType, targetIdentifiers: \$targetIdentifiers, namespace: \$namespace) {
    message
    code
  }
}
EOF;
}
    

    
class RemoveUdfResponse {

    /**
     * @var CommonMessage
     */
    public $removeUdf;
}
    
class RemoveUdfParam {

    /**
     * Required
     * 
     * @var UdfTargetType
     */
    public $targetType;

    /**
     * Required
     * 
     * @var string
     */
    public $key;

/**
 * @param $targetType UdfTargetType
 * @param $key string
 */
public function __construct($targetType,$key) {
$this->targetType = $targetType;
$this->key = $key;
}

    function createRequest() {
      return [
        "query" => self::RemoveUdfDocument,
        "operationName" => "removeUdf",
        "variables" => $this
      ];
    }

    const RemoveUdfDocument = <<<EOF
mutation removeUdf(\$targetType: UDFTargetType!, \$key: String!) {
  removeUdf(targetType: \$targetType, key: \$key) {
    message
    code
  }
}
EOF;
}
    

    
class RemoveUdvResponse {

    /**
     * @var UserDefinedData[]
     */
    public $removeUdv;
}
    
class RemoveUdvParam {

    /**
     * Required
     * 
     * @var UdfTargetType
     */
    public $targetType;

    /**
     * Required
     * 
     * @var string
     */
    public $targetId;

    /**
     * Required
     * 
     * @var string
     */
    public $key;

/**
 * @param $targetType UdfTargetType
 * @param $targetId string
 * @param $key string
 */
public function __construct($targetType,$targetId,$key) {
$this->targetType = $targetType;
$this->targetId = $targetId;
$this->key = $key;
}

    function createRequest() {
      return [
        "query" => self::RemoveUdvDocument,
        "operationName" => "removeUdv",
        "variables" => $this
      ];
    }

    const RemoveUdvDocument = <<<EOF
mutation removeUdv(\$targetType: UDFTargetType!, \$targetId: String!, \$key: String!) {
  removeUdv(targetType: \$targetType, targetId: \$targetId, key: \$key) {
    key
    dataType
    value
    label
  }
}
EOF;
}
    

    
class RemoveUserFromGroupResponse {

    /**
     * @var CommonMessage
     */
    public $removeUserFromGroup;
}
    
class RemoveUserFromGroupParam {

    /**
     * Required
     * 
     * @var string[]
     */
    public $userIds;

    /**
     * Optional
     * 
     * @var string
     */
    public $code;

/**
 * @param $userIds string[]
 */
public function __construct($userIds) {
$this->userIds = $userIds;
}

/**
 * @param $code string
 * @return RemoveUserFromGroupParam
 */
public function withCode($code) {
  $this->code = $code;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::RemoveUserFromGroupDocument,
        "operationName" => "removeUserFromGroup",
        "variables" => $this
      ];
    }

    const RemoveUserFromGroupDocument = <<<EOF
mutation removeUserFromGroup(\$userIds: [String!]!, \$code: String) {
  removeUserFromGroup(userIds: \$userIds, code: \$code) {
    message
    code
  }
}
EOF;
}
    

    
class RemoveWhitelistResponse {

    /**
     * @var WhiteList[]
     */
    public $removeWhitelist;
}
    
class RemoveWhitelistParam {

    /**
     * Required
     * 
     * @var WhitelistType
     */
    public $type;

    /**
     * Required
     * 
     * @var string[]
     */
    public $list;

/**
 * @param $type WhitelistType
 * @param $list string[]
 */
public function __construct($type,$list) {
$this->type = $type;
$this->list = $list;
}

    function createRequest() {
      return [
        "query" => self::RemoveWhitelistDocument,
        "operationName" => "removeWhitelist",
        "variables" => $this
      ];
    }

    const RemoveWhitelistDocument = <<<EOF
mutation removeWhitelist(\$type: WhitelistType!, \$list: [String!]!) {
  removeWhitelist(type: \$type, list: \$list) {
    createdAt
    updatedAt
    value
  }
}
EOF;
}
    

    
class ResetPasswordResponse {

    /**
     * @var CommonMessage
     */
    public $resetPassword;
}
    
class ResetPasswordParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $phone;

    /**
     * Optional
     * 
     * @var string
     */
    public $email;

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Required
     * 
     * @var string
     */
    public $newPassword;

/**
 * @param $code string
 * @param $newPassword string
 */
public function __construct($code,$newPassword) {
$this->code = $code;
$this->newPassword = $newPassword;
}

/**
 * @param $phone string
 * @return ResetPasswordParam
 */
public function withPhone($phone) {
  $this->phone = $phone;
  return $this;
}

/**
 * @param $email string
 * @return ResetPasswordParam
 */
public function withEmail($email) {
  $this->email = $email;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::ResetPasswordDocument,
        "operationName" => "resetPassword",
        "variables" => $this
      ];
    }

    const ResetPasswordDocument = <<<EOF
mutation resetPassword(\$phone: String, \$email: String, \$code: String!, \$newPassword: String!) {
  resetPassword(phone: \$phone, email: \$email, code: \$code, newPassword: \$newPassword) {
    message
    code
  }
}
EOF;
}
    

    
class RevokeRoleResponse {

    /**
     * @var CommonMessage
     */
    public $revokeRole;
}
    
class RevokeRoleParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Optional
     * 
     * @var string
     */
    public $roleCode;

    /**
     * Optional
     * 
     * @var string[]
     */
    public $roleCodes;

    /**
     * Optional
     * 
     * @var string[]
     */
    public $userIds;

    /**
     * Optional
     * 
     * @var string[]
     */
    public $groupCodes;

    /**
     * Optional
     * 
     * @var string[]
     */
    public $nodeCodes;

public function __construct() {

}

/**
 * @param $namespace string
 * @return RevokeRoleParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}

/**
 * @param $roleCode string
 * @return RevokeRoleParam
 */
public function withRoleCode($roleCode) {
  $this->roleCode = $roleCode;
  return $this;
}

/**
 * @param $roleCodes string[]
 * @return RevokeRoleParam
 */
public function withRoleCodes($roleCodes) {
  $this->roleCodes = $roleCodes;
  return $this;
}

/**
 * @param $userIds string[]
 * @return RevokeRoleParam
 */
public function withUserIds($userIds) {
  $this->userIds = $userIds;
  return $this;
}

/**
 * @param $groupCodes string[]
 * @return RevokeRoleParam
 */
public function withGroupCodes($groupCodes) {
  $this->groupCodes = $groupCodes;
  return $this;
}

/**
 * @param $nodeCodes string[]
 * @return RevokeRoleParam
 */
public function withNodeCodes($nodeCodes) {
  $this->nodeCodes = $nodeCodes;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::RevokeRoleDocument,
        "operationName" => "revokeRole",
        "variables" => $this
      ];
    }

    const RevokeRoleDocument = <<<EOF
mutation revokeRole(\$namespace: String, \$roleCode: String, \$roleCodes: [String], \$userIds: [String!], \$groupCodes: [String!], \$nodeCodes: [String!]) {
  revokeRole(namespace: \$namespace, roleCode: \$roleCode, roleCodes: \$roleCodes, userIds: \$userIds, groupCodes: \$groupCodes, nodeCodes: \$nodeCodes) {
    message
    code
  }
}
EOF;
}
    

    
class SendEmailResponse {

    /**
     * @var CommonMessage
     */
    public $sendEmail;
}
    
class SendEmailParam {

    /**
     * Required
     * 
     * @var string
     */
    public $email;

    /**
     * Required
     * 
     * @var EmailScene
     */
    public $scene;

/**
 * @param $email string
 * @param $scene EmailScene
 */
public function __construct($email,$scene) {
$this->email = $email;
$this->scene = $scene;
}

    function createRequest() {
      return [
        "query" => self::SendEmailDocument,
        "operationName" => "sendEmail",
        "variables" => $this
      ];
    }

    const SendEmailDocument = <<<EOF
mutation sendEmail(\$email: String!, \$scene: EmailScene!) {
  sendEmail(email: \$email, scene: \$scene) {
    message
    code
  }
}
EOF;
}
    

    
class SetMainDepartmentResponse {

    /**
     * @var CommonMessage
     */
    public $setMainDepartment;
}
    
class SetMainDepartmentParam {

    /**
     * Required
     * 
     * @var string
     */
    public $userId;

    /**
     * Optional
     * 
     * @var string
     */
    public $departmentId;

/**
 * @param $userId string
 */
public function __construct($userId) {
$this->userId = $userId;
}

/**
 * @param $departmentId string
 * @return SetMainDepartmentParam
 */
public function withDepartmentId($departmentId) {
  $this->departmentId = $departmentId;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::SetMainDepartmentDocument,
        "operationName" => "setMainDepartment",
        "variables" => $this
      ];
    }

    const SetMainDepartmentDocument = <<<EOF
mutation setMainDepartment(\$userId: String!, \$departmentId: String) {
  setMainDepartment(userId: \$userId, departmentId: \$departmentId) {
    message
    code
  }
}
EOF;
}
    

    
class SetUdfResponse {

    /**
     * @var UserDefinedField
     */
    public $setUdf;
}
    
class SetUdfParam {

    /**
     * Required
     * 
     * @var UdfTargetType
     */
    public $targetType;

    /**
     * Required
     * 
     * @var string
     */
    public $key;

    /**
     * Required
     * 
     * @var UdfDataType
     */
    public $dataType;

    /**
     * Required
     * 
     * @var string
     */
    public $label;

    /**
     * Optional
     * 
     * @var string
     */
    public $options;

/**
 * @param $targetType UdfTargetType
 * @param $key string
 * @param $dataType UdfDataType
 * @param $label string
 */
public function __construct($targetType,$key,$dataType,$label) {
$this->targetType = $targetType;
$this->key = $key;
$this->dataType = $dataType;
$this->label = $label;
}

/**
 * @param $options string
 * @return SetUdfParam
 */
public function withOptions($options) {
  $this->options = $options;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::SetUdfDocument,
        "operationName" => "setUdf",
        "variables" => $this
      ];
    }

    const SetUdfDocument = <<<EOF
mutation setUdf(\$targetType: UDFTargetType!, \$key: String!, \$dataType: UDFDataType!, \$label: String!, \$options: String) {
  setUdf(targetType: \$targetType, key: \$key, dataType: \$dataType, label: \$label, options: \$options) {
    targetType
    dataType
    key
    label
    options
  }
}
EOF;
}
    

    
class SetUdfValueBatchResponse {

    /**
     * @var CommonMessage
     */
    public $setUdfValueBatch;
}
    
class SetUdfValueBatchParam {

    /**
     * Required
     * 
     * @var UdfTargetType
     */
    public $targetType;

    /**
     * Required
     * 
     * @var SetUdfValueBatchInput[]
     */
    public $input;

/**
 * @param $targetType UdfTargetType
 * @param $input SetUdfValueBatchInput[]
 */
public function __construct($targetType,$input) {
$this->targetType = $targetType;
$this->input = $input;
}

    function createRequest() {
      return [
        "query" => self::SetUdfValueBatchDocument,
        "operationName" => "setUdfValueBatch",
        "variables" => $this
      ];
    }

    const SetUdfValueBatchDocument = <<<EOF
mutation setUdfValueBatch(\$targetType: UDFTargetType!, \$input: [SetUdfValueBatchInput!]!) {
  setUdfValueBatch(targetType: \$targetType, input: \$input) {
    code
    message
  }
}
EOF;
}
    

    
class SetUdvResponse {

    /**
     * @var UserDefinedData[]
     */
    public $setUdv;
}
    
class SetUdvParam {

    /**
     * Required
     * 
     * @var UdfTargetType
     */
    public $targetType;

    /**
     * Required
     * 
     * @var string
     */
    public $targetId;

    /**
     * Required
     * 
     * @var string
     */
    public $key;

    /**
     * Required
     * 
     * @var string
     */
    public $value;

/**
 * @param $targetType UdfTargetType
 * @param $targetId string
 * @param $key string
 * @param $value string
 */
public function __construct($targetType,$targetId,$key,$value) {
$this->targetType = $targetType;
$this->targetId = $targetId;
$this->key = $key;
$this->value = $value;
}

    function createRequest() {
      return [
        "query" => self::SetUdvDocument,
        "operationName" => "setUdv",
        "variables" => $this
      ];
    }

    const SetUdvDocument = <<<EOF
mutation setUdv(\$targetType: UDFTargetType!, \$targetId: String!, \$key: String!, \$value: String!) {
  setUdv(targetType: \$targetType, targetId: \$targetId, key: \$key, value: \$value) {
    key
    dataType
    value
    label
  }
}
EOF;
}
    

    
class SetUdvBatchResponse {

    /**
     * @var UserDefinedData[]
     */
    public $setUdvBatch;
}
    
class SetUdvBatchParam {

    /**
     * Required
     * 
     * @var UdfTargetType
     */
    public $targetType;

    /**
     * Required
     * 
     * @var string
     */
    public $targetId;

    /**
     * Optional
     * 
     * @var UserDefinedDataInput[]
     */
    public $udvList;

/**
 * @param $targetType UdfTargetType
 * @param $targetId string
 */
public function __construct($targetType,$targetId) {
$this->targetType = $targetType;
$this->targetId = $targetId;
}

/**
 * @param $udvList UserDefinedDataInput[]
 * @return SetUdvBatchParam
 */
public function withUdvList($udvList) {
  $this->udvList = $udvList;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::SetUdvBatchDocument,
        "operationName" => "setUdvBatch",
        "variables" => $this
      ];
    }

    const SetUdvBatchDocument = <<<EOF
mutation setUdvBatch(\$targetType: UDFTargetType!, \$targetId: String!, \$udvList: [UserDefinedDataInput!]) {
  setUdvBatch(targetType: \$targetType, targetId: \$targetId, udvList: \$udvList) {
    key
    dataType
    value
    label
  }
}
EOF;
}
    

    
class UnbindEmailResponse {

    /**
     * @var User
     */
    public $unbindEmail;
}
    
class UnbindEmailParam {



    function createRequest() {
      return [
        "query" => self::UnbindEmailDocument,
        "operationName" => "unbindEmail",
        "variables" => $this
      ];
    }

    const UnbindEmailDocument = <<<EOF
mutation unbindEmail {
  unbindEmail {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
  }
}
EOF;
}
    

    
class UnbindPhoneResponse {

    /**
     * @var User
     */
    public $unbindPhone;
}
    
class UnbindPhoneParam {



    function createRequest() {
      return [
        "query" => self::UnbindPhoneDocument,
        "operationName" => "unbindPhone",
        "variables" => $this
      ];
    }

    const UnbindPhoneDocument = <<<EOF
mutation unbindPhone {
  unbindPhone {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
  }
}
EOF;
}
    

    
class UpdateEmailResponse {

    /**
     * @var User
     */
    public $updateEmail;
}
    
class UpdateEmailParam {

    /**
     * Required
     * 
     * @var string
     */
    public $email;

    /**
     * Required
     * 
     * @var string
     */
    public $emailCode;

    /**
     * Optional
     * 
     * @var string
     */
    public $oldEmail;

    /**
     * Optional
     * 
     * @var string
     */
    public $oldEmailCode;

/**
 * @param $email string
 * @param $emailCode string
 */
public function __construct($email,$emailCode) {
$this->email = $email;
$this->emailCode = $emailCode;
}

/**
 * @param $oldEmail string
 * @return UpdateEmailParam
 */
public function withOldEmail($oldEmail) {
  $this->oldEmail = $oldEmail;
  return $this;
}

/**
 * @param $oldEmailCode string
 * @return UpdateEmailParam
 */
public function withOldEmailCode($oldEmailCode) {
  $this->oldEmailCode = $oldEmailCode;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::UpdateEmailDocument,
        "operationName" => "updateEmail",
        "variables" => $this
      ];
    }

    const UpdateEmailDocument = <<<EOF
mutation updateEmail(\$email: String!, \$emailCode: String!, \$oldEmail: String, \$oldEmailCode: String) {
  updateEmail(email: \$email, emailCode: \$emailCode, oldEmail: \$oldEmail, oldEmailCode: \$oldEmailCode) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
  }
}
EOF;
}
    

    
class UpdateFunctionResponse {

    /**
     * @var Function
     */
    public $updateFunction;
}
    
class UpdateFunctionParam {

    /**
     * Required
     * 
     * @var UpdateFunctionInput
     */
    public $input;

/**
 * @param $input UpdateFunctionInput
 */
public function __construct($input) {
$this->input = $input;
}

    function createRequest() {
      return [
        "query" => self::UpdateFunctionDocument,
        "operationName" => "updateFunction",
        "variables" => $this
      ];
    }

    const UpdateFunctionDocument = <<<EOF
mutation updateFunction(\$input: UpdateFunctionInput!) {
  updateFunction(input: \$input) {
    id
    name
    sourceCode
    description
    url
  }
}
EOF;
}
    

    
class UpdateGroupResponse {

    /**
     * @var Group
     */
    public $updateGroup;
}
    
class UpdateGroupParam {

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var string
     */
    public $name;

    /**
     * Optional
     * 
     * @var string
     */
    public $description;

    /**
     * Optional
     * 
     * @var string
     */
    public $newCode;

/**
 * @param $code string
 */
public function __construct($code) {
$this->code = $code;
}

/**
 * @param $name string
 * @return UpdateGroupParam
 */
public function withName($name) {
  $this->name = $name;
  return $this;
}

/**
 * @param $description string
 * @return UpdateGroupParam
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}

/**
 * @param $newCode string
 * @return UpdateGroupParam
 */
public function withNewCode($newCode) {
  $this->newCode = $newCode;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::UpdateGroupDocument,
        "operationName" => "updateGroup",
        "variables" => $this
      ];
    }

    const UpdateGroupDocument = <<<EOF
mutation updateGroup(\$code: String!, \$name: String, \$description: String, \$newCode: String) {
  updateGroup(code: \$code, name: \$name, description: \$description, newCode: \$newCode) {
    code
    name
    description
    createdAt
    updatedAt
  }
}
EOF;
}
    

    
class UpdateNodeResponse {

    /**
     * @var Node
     */
    public $updateNode;
}
    
class UpdateNodeParam {

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

    /**
     * Optional
     * 
     * @var SortByEnum
     */
    public $sortBy;

    /**
     * Optional
     * 
     * @var bool
     */
    public $includeChildrenNodes;

    /**
     * Required
     * 
     * @var string
     */
    public $id;

    /**
     * Optional
     * 
     * @var string
     */
    public $name;

    /**
     * Optional
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var string
     */
    public $description;

/**
 * @param $id string
 */
public function __construct($id) {
$this->id = $id;
}

/**
 * @param $page int
 * @return UpdateNodeParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return UpdateNodeParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $sortBy SortByEnum
 * @return UpdateNodeParam
 */
public function withSortBy($sortBy) {
  $this->sortBy = $sortBy;
  return $this;
}

/**
 * @param $includeChildrenNodes bool
 * @return UpdateNodeParam
 */
public function withIncludeChildrenNodes($includeChildrenNodes) {
  $this->includeChildrenNodes = $includeChildrenNodes;
  return $this;
}

/**
 * @param $name string
 * @return UpdateNodeParam
 */
public function withName($name) {
  $this->name = $name;
  return $this;
}

/**
 * @param $code string
 * @return UpdateNodeParam
 */
public function withCode($code) {
  $this->code = $code;
  return $this;
}

/**
 * @param $description string
 * @return UpdateNodeParam
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::UpdateNodeDocument,
        "operationName" => "updateNode",
        "variables" => $this
      ];
    }

    const UpdateNodeDocument = <<<EOF
mutation updateNode(\$page: Int, \$limit: Int, \$sortBy: SortByEnum, \$includeChildrenNodes: Boolean, \$id: String!, \$name: String, \$code: String, \$description: String) {
  updateNode(id: \$id, name: \$name, code: \$code, description: \$description) {
    id
    orgId
    name
    nameI18n
    description
    descriptionI18n
    order
    code
    root
    depth
    path
    createdAt
    updatedAt
    children
    users(page: \$page, limit: \$limit, sortBy: \$sortBy, includeChildrenNodes: \$includeChildrenNodes) {
      totalCount
    }
  }
}
EOF;
}
    

    
class UpdatePasswordResponse {

    /**
     * @var User
     */
    public $updatePassword;
}
    
class UpdatePasswordParam {

    /**
     * Required
     * 
     * @var string
     */
    public $newPassword;

    /**
     * Optional
     * 
     * @var string
     */
    public $oldPassword;

/**
 * @param $newPassword string
 */
public function __construct($newPassword) {
$this->newPassword = $newPassword;
}

/**
 * @param $oldPassword string
 * @return UpdatePasswordParam
 */
public function withOldPassword($oldPassword) {
  $this->oldPassword = $oldPassword;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::UpdatePasswordDocument,
        "operationName" => "updatePassword",
        "variables" => $this
      ];
    }

    const UpdatePasswordDocument = <<<EOF
mutation updatePassword(\$newPassword: String!, \$oldPassword: String) {
  updatePassword(newPassword: \$newPassword, oldPassword: \$oldPassword) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
  }
}
EOF;
}
    

    
class UpdatePhoneResponse {

    /**
     * @var User
     */
    public $updatePhone;
}
    
class UpdatePhoneParam {

    /**
     * Required
     * 
     * @var string
     */
    public $phone;

    /**
     * Required
     * 
     * @var string
     */
    public $phoneCode;

    /**
     * Optional
     * 
     * @var string
     */
    public $oldPhone;

    /**
     * Optional
     * 
     * @var string
     */
    public $oldPhoneCode;

/**
 * @param $phone string
 * @param $phoneCode string
 */
public function __construct($phone,$phoneCode) {
$this->phone = $phone;
$this->phoneCode = $phoneCode;
}

/**
 * @param $oldPhone string
 * @return UpdatePhoneParam
 */
public function withOldPhone($oldPhone) {
  $this->oldPhone = $oldPhone;
  return $this;
}

/**
 * @param $oldPhoneCode string
 * @return UpdatePhoneParam
 */
public function withOldPhoneCode($oldPhoneCode) {
  $this->oldPhoneCode = $oldPhoneCode;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::UpdatePhoneDocument,
        "operationName" => "updatePhone",
        "variables" => $this
      ];
    }

    const UpdatePhoneDocument = <<<EOF
mutation updatePhone(\$phone: String!, \$phoneCode: String!, \$oldPhone: String, \$oldPhoneCode: String) {
  updatePhone(phone: \$phone, phoneCode: \$phoneCode, oldPhone: \$oldPhone, oldPhoneCode: \$oldPhoneCode) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
  }
}
EOF;
}
    

    
class UpdatePolicyResponse {

    /**
     * @var Policy
     */
    public $updatePolicy;
}
    
class UpdatePolicyParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var string
     */
    public $description;

    /**
     * Optional
     * 
     * @var PolicyStatementInput[]
     */
    public $statements;

    /**
     * Optional
     * 
     * @var string
     */
    public $newCode;

/**
 * @param $code string
 */
public function __construct($code) {
$this->code = $code;
}

/**
 * @param $namespace string
 * @return UpdatePolicyParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}

/**
 * @param $description string
 * @return UpdatePolicyParam
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}

/**
 * @param $statements PolicyStatementInput[]
 * @return UpdatePolicyParam
 */
public function withStatements($statements) {
  $this->statements = $statements;
  return $this;
}

/**
 * @param $newCode string
 * @return UpdatePolicyParam
 */
public function withNewCode($newCode) {
  $this->newCode = $newCode;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::UpdatePolicyDocument,
        "operationName" => "updatePolicy",
        "variables" => $this
      ];
    }

    const UpdatePolicyDocument = <<<EOF
mutation updatePolicy(\$namespace: String, \$code: String!, \$description: String, \$statements: [PolicyStatementInput!], \$newCode: String) {
  updatePolicy(namespace: \$namespace, code: \$code, description: \$description, statements: \$statements, newCode: \$newCode) {
    namespace
    code
    description
    statements {
      resource
      actions
      effect
      condition {
        param
        operator
        value
      }
    }
    createdAt
    updatedAt
  }
}
EOF;
}
    

    
class UpdateRoleResponse {

    /**
     * @var Role
     */
    public $updateRole;
}
    
class UpdateRoleParam {

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var string
     */
    public $description;

    /**
     * Optional
     * 
     * @var string
     */
    public $newCode;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

/**
 * @param $code string
 */
public function __construct($code) {
$this->code = $code;
}

/**
 * @param $description string
 * @return UpdateRoleParam
 */
public function withDescription($description) {
  $this->description = $description;
  return $this;
}

/**
 * @param $newCode string
 * @return UpdateRoleParam
 */
public function withNewCode($newCode) {
  $this->newCode = $newCode;
  return $this;
}

/**
 * @param $namespace string
 * @return UpdateRoleParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::UpdateRoleDocument,
        "operationName" => "updateRole",
        "variables" => $this
      ];
    }

    const UpdateRoleDocument = <<<EOF
mutation updateRole(\$code: String!, \$description: String, \$newCode: String, \$namespace: String) {
  updateRole(code: \$code, description: \$description, newCode: \$newCode, namespace: \$namespace) {
    namespace
    code
    arn
    description
    createdAt
    updatedAt
    parent {
      namespace
      code
      arn
      description
      createdAt
      updatedAt
    }
  }
}
EOF;
}
    

    
class UpdateUserResponse {

    /**
     * @var User
     */
    public $updateUser;
}
    
class UpdateUserParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $id;

    /**
     * Required
     * 
     * @var UpdateUserInput
     */
    public $input;

/**
 * @param $input UpdateUserInput
 */
public function __construct($input) {
$this->input = $input;
}

/**
 * @param $id string
 * @return UpdateUserParam
 */
public function withId($id) {
  $this->id = $id;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::UpdateUserDocument,
        "operationName" => "updateUser",
        "variables" => $this
      ];
    }

    const UpdateUserDocument = <<<EOF
mutation updateUser(\$id: String, \$input: UpdateUserInput!) {
  updateUser(id: \$id, input: \$input) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
    externalId
  }
}
EOF;
}
    

    
class UpdateUserpoolResponse {

    /**
     * @var UserPool
     */
    public $updateUserpool;
}
    
class UpdateUserpoolParam {

    /**
     * Required
     * 
     * @var UpdateUserpoolInput
     */
    public $input;

/**
 * @param $input UpdateUserpoolInput
 */
public function __construct($input) {
$this->input = $input;
}

    function createRequest() {
      return [
        "query" => self::UpdateUserpoolDocument,
        "operationName" => "updateUserpool",
        "variables" => $this
      ];
    }

    const UpdateUserpoolDocument = <<<EOF
mutation updateUserpool(\$input: UpdateUserpoolInput!) {
  updateUserpool(input: \$input) {
    id
    name
    domain
    description
    secret
    jwtSecret
    userpoolTypes {
      code
      name
      description
      image
      sdks
    }
    logo
    createdAt
    updatedAt
    emailVerifiedDefault
    sendWelcomeEmail
    registerDisabled
    appSsoEnabled
    showWxQRCodeWhenRegisterDisabled
    allowedOrigins
    tokenExpiresAfter
    isDeleted
    frequentRegisterCheck {
      timeInterval
      limit
      enabled
    }
    loginFailCheck {
      timeInterval
      limit
      enabled
    }
    changePhoneStrategy {
      verifyOldPhone
    }
    changeEmailStrategy {
      verifyOldEmail
    }
    qrcodeLoginStrategy {
      qrcodeExpiresAfter
      returnFullUserInfo
      allowExchangeUserInfoFromBrowser
      ticketExpiresAfter
    }
    app2WxappLoginStrategy {
      ticketExpriresAfter
      ticketExchangeUserInfoNeedSecret
    }
    whitelist {
      phoneEnabled
      emailEnabled
      usernameEnabled
    }
    customSMSProvider {
      enabled
      provider
      config
    }
    packageType
    useCustomUserStore
    loginRequireEmailVerified
    verifyCodeLength
  }
}
EOF;
}
    

    
class AccessTokenResponse {

    /**
     * @var AccessTokenRes
     */
    public $accessToken;
}
    
class AccessTokenParam {

    /**
     * Required
     * 
     * @var string
     */
    public $userPoolId;

    /**
     * Required
     * 
     * @var string
     */
    public $secret;

/**
 * @param $userPoolId string
 * @param $secret string
 */
public function __construct($userPoolId,$secret) {
$this->userPoolId = $userPoolId;
$this->secret = $secret;
}

    function createRequest() {
      return [
        "query" => self::AccessTokenDocument,
        "operationName" => "accessToken",
        "variables" => $this
      ];
    }

    const AccessTokenDocument = <<<EOF
query accessToken(\$userPoolId: String!, \$secret: String!) {
  accessToken(userPoolId: \$userPoolId, secret: \$secret) {
    accessToken
    exp
    iat
  }
}
EOF;
}
    

    
class ArchivedUsersResponse {

    /**
     * @var PaginatedUsers
     */
    public $archivedUsers;
}
    
class ArchivedUsersParam {

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

public function __construct() {

}

/**
 * @param $page int
 * @return ArchivedUsersParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return ArchivedUsersParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::ArchivedUsersDocument,
        "operationName" => "archivedUsers",
        "variables" => $this
      ];
    }

    const ArchivedUsersDocument = <<<EOF
query archivedUsers(\$page: Int, \$limit: Int) {
  archivedUsers(page: \$page, limit: \$limit) {
    totalCount
    list {
      id
      arn
      status
      userPoolId
      username
      email
      emailVerified
      phone
      phoneVerified
      unionid
      openid
      nickname
      registerSource
      photo
      password
      oauth
      token
      tokenExpiredAt
      loginsCount
      lastLogin
      lastIP
      signedUp
      blocked
      isDeleted
      device
      browser
      company
      name
      givenName
      familyName
      middleName
      profile
      preferredUsername
      website
      gender
      birthdate
      zoneinfo
      locale
      address
      formatted
      streetAddress
      locality
      region
      postalCode
      city
      province
      country
      createdAt
      updatedAt
      externalId
    }
  }
}
EOF;
}
    

    
class AuthorizedTargetsResponse {

    /**
     * @var PaginatedAuthorizedTargets
     */
    public $authorizedTargets;
}
    
class AuthorizedTargetsParam {

    /**
     * Required
     * 
     * @var string
     */
    public $namespace;

    /**
     * Required
     * 
     * @var ResourceType
     */
    public $resourceType;

    /**
     * Required
     * 
     * @var string
     */
    public $resource;

    /**
     * Optional
     * 
     * @var PolicyAssignmentTargetType
     */
    public $targetType;

    /**
     * Optional
     * 
     * @var AuthorizedTargetsActionsInput
     */
    public $actions;

/**
 * @param $namespace string
 * @param $resourceType ResourceType
 * @param $resource string
 */
public function __construct($namespace,$resourceType,$resource) {
$this->namespace = $namespace;
$this->resourceType = $resourceType;
$this->resource = $resource;
}

/**
 * @param $targetType PolicyAssignmentTargetType
 * @return AuthorizedTargetsParam
 */
public function withTargetType($targetType) {
  $this->targetType = $targetType;
  return $this;
}

/**
 * @param $actions AuthorizedTargetsActionsInput
 * @return AuthorizedTargetsParam
 */
public function withActions($actions) {
  $this->actions = $actions;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::AuthorizedTargetsDocument,
        "operationName" => "authorizedTargets",
        "variables" => $this
      ];
    }

    const AuthorizedTargetsDocument = <<<EOF
query authorizedTargets(\$namespace: String!, \$resourceType: ResourceType!, \$resource: String!, \$targetType: PolicyAssignmentTargetType, \$actions: AuthorizedTargetsActionsInput) {
  authorizedTargets(namespace: \$namespace, resource: \$resource, resourceType: \$resourceType, targetType: \$targetType, actions: \$actions) {
    totalCount
    list {
      targetType
      targetIdentifier
      actions
    }
  }
}
EOF;
}
    

    
class CheckLoginStatusResponse {

    /**
     * @var JWTTokenStatus
     */
    public $checkLoginStatus;
}
    
class CheckLoginStatusParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $token;

public function __construct() {

}

/**
 * @param $token string
 * @return CheckLoginStatusParam
 */
public function withToken($token) {
  $this->token = $token;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::CheckLoginStatusDocument,
        "operationName" => "checkLoginStatus",
        "variables" => $this
      ];
    }

    const CheckLoginStatusDocument = <<<EOF
query checkLoginStatus(\$token: String) {
  checkLoginStatus(token: \$token) {
    code
    message
    status
    exp
    iat
    data {
      id
      userPoolId
      arn
    }
  }
}
EOF;
}
    

    
class CheckPasswordStrengthResponse {

    /**
     * @var CheckPasswordStrengthResult
     */
    public $checkPasswordStrength;
}
    
class CheckPasswordStrengthParam {

    /**
     * Required
     * 
     * @var string
     */
    public $password;

/**
 * @param $password string
 */
public function __construct($password) {
$this->password = $password;
}

    function createRequest() {
      return [
        "query" => self::CheckPasswordStrengthDocument,
        "operationName" => "checkPasswordStrength",
        "variables" => $this
      ];
    }

    const CheckPasswordStrengthDocument = <<<EOF
query checkPasswordStrength(\$password: String!) {
  checkPasswordStrength(password: \$password) {
    valid
    message
  }
}
EOF;
}
    

    
class ChildrenNodesResponse {

    /**
     * @var Node[]
     */
    public $childrenNodes;
}
    
class ChildrenNodesParam {

    /**
     * Required
     * 
     * @var string
     */
    public $orgId;

    /**
     * Required
     * 
     * @var string
     */
    public $nodeId;

/**
 * @param $orgId string
 * @param $nodeId string
 */
public function __construct($orgId,$nodeId) {
$this->orgId = $orgId;
$this->nodeId = $nodeId;
}

    function createRequest() {
      return [
        "query" => self::ChildrenNodesDocument,
        "operationName" => "childrenNodes",
        "variables" => $this
      ];
    }

    const ChildrenNodesDocument = <<<EOF
query childrenNodes(\$orgId: String!, \$nodeId: String!) {
  childrenNodes(orgId: \$orgId, nodeId: \$nodeId) {
    id
    orgId
    name
    nameI18n
    description
    descriptionI18n
    order
    code
    root
    depth
    path
    createdAt
    updatedAt
    children
  }
}
EOF;
}
    

    
class EmailTemplatesResponse {

    /**
     * @var EmailTemplate[]
     */
    public $emailTemplates;
}
    
class EmailTemplatesParam {



    function createRequest() {
      return [
        "query" => self::EmailTemplatesDocument,
        "operationName" => "emailTemplates",
        "variables" => $this
      ];
    }

    const EmailTemplatesDocument = <<<EOF
query emailTemplates {
  emailTemplates {
    type
    name
    subject
    sender
    content
    redirectTo
    hasURL
    expiresIn
    enabled
    isSystem
  }
}
EOF;
}
    

    
class FindUserResponse {

    /**
     * @var User
     */
    public $findUser;
}
    
class FindUserParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $email;

    /**
     * Optional
     * 
     * @var string
     */
    public $phone;

    /**
     * Optional
     * 
     * @var string
     */
    public $username;

    /**
     * Optional
     * 
     * @var string
     */
    public $externalId;

public function __construct() {

}

/**
 * @param $email string
 * @return FindUserParam
 */
public function withEmail($email) {
  $this->email = $email;
  return $this;
}

/**
 * @param $phone string
 * @return FindUserParam
 */
public function withPhone($phone) {
  $this->phone = $phone;
  return $this;
}

/**
 * @param $username string
 * @return FindUserParam
 */
public function withUsername($username) {
  $this->username = $username;
  return $this;
}

/**
 * @param $externalId string
 * @return FindUserParam
 */
public function withExternalId($externalId) {
  $this->externalId = $externalId;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::FindUserDocument,
        "operationName" => "findUser",
        "variables" => $this
      ];
    }

    const FindUserDocument = <<<EOF
query findUser(\$email: String, \$phone: String, \$username: String, \$externalId: String) {
  findUser(email: \$email, phone: \$phone, username: \$username, externalId: \$externalId) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
    externalId
  }
}
EOF;
}
    

    
class FunctionResponse {

    /**
     * @var Function
     */
    public $function;
}
    
class FunctionParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $id;

public function __construct() {

}

/**
 * @param $id string
 * @return FunctionParam
 */
public function withId($id) {
  $this->id = $id;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::FunctionDocument,
        "operationName" => "function",
        "variables" => $this
      ];
    }

    const FunctionDocument = <<<EOF
query function(\$id: String) {
  function(id: \$id) {
    id
    name
    sourceCode
    description
    url
  }
}
EOF;
}
    

    
class FunctionsResponse {

    /**
     * @var PaginatedFunctions
     */
    public $functions;
}
    
class FunctionsParam {

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

    /**
     * Optional
     * 
     * @var SortByEnum
     */
    public $sortBy;

public function __construct() {

}

/**
 * @param $page int
 * @return FunctionsParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return FunctionsParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $sortBy SortByEnum
 * @return FunctionsParam
 */
public function withSortBy($sortBy) {
  $this->sortBy = $sortBy;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::FunctionsDocument,
        "operationName" => "functions",
        "variables" => $this
      ];
    }

    const FunctionsDocument = <<<EOF
query functions(\$page: Int, \$limit: Int, \$sortBy: SortByEnum) {
  functions(page: \$page, limit: \$limit, sortBy: \$sortBy) {
    list {
      id
      name
      sourceCode
      description
      url
    }
    totalCount
  }
}
EOF;
}
    

    
class GetUserDepartmentsResponse {

    /**
     * @var User
     */
    public $getUserDepartments;
}
    
class GetUserDepartmentsParam {

    /**
     * Required
     * 
     * @var string
     */
    public $id;

    /**
     * Optional
     * 
     * @var string
     */
    public $orgId;

/**
 * @param $id string
 */
public function __construct($id) {
$this->id = $id;
}

/**
 * @param $orgId string
 * @return GetUserDepartmentsParam
 */
public function withOrgId($orgId) {
  $this->orgId = $orgId;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::GetUserDepartmentsDocument,
        "operationName" => "getUserDepartments",
        "variables" => $this
      ];
    }

    const GetUserDepartmentsDocument = <<<EOF
query getUserDepartments(\$id: String!, \$orgId: String) {
  user(id: \$id) {
    departments(orgId: \$orgId) {
      totalCount
      list {
        department {
          id
          orgId
          name
          nameI18n
          description
          descriptionI18n
          order
          code
          root
          depth
          path
          codePath
          namePath
          createdAt
          updatedAt
          children
        }
        isMainDepartment
        joinedAt
      }
    }
  }
}
EOF;
}
    

    
class GetUserGroupsResponse {

    /**
     * @var User
     */
    public $getUserGroups;
}
    
class GetUserGroupsParam {

    /**
     * Required
     * 
     * @var string
     */
    public $id;

/**
 * @param $id string
 */
public function __construct($id) {
$this->id = $id;
}

    function createRequest() {
      return [
        "query" => self::GetUserGroupsDocument,
        "operationName" => "getUserGroups",
        "variables" => $this
      ];
    }

    const GetUserGroupsDocument = <<<EOF
query getUserGroups(\$id: String!) {
  user(id: \$id) {
    groups {
      totalCount
      list {
        code
        name
        description
        createdAt
        updatedAt
      }
    }
  }
}
EOF;
}
    

    
class GetUserRolesResponse {

    /**
     * @var User
     */
    public $getUserRoles;
}
    
class GetUserRolesParam {

    /**
     * Required
     * 
     * @var string
     */
    public $id;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

/**
 * @param $id string
 */
public function __construct($id) {
$this->id = $id;
}

/**
 * @param $namespace string
 * @return GetUserRolesParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::GetUserRolesDocument,
        "operationName" => "getUserRoles",
        "variables" => $this
      ];
    }

    const GetUserRolesDocument = <<<EOF
query getUserRoles(\$id: String!, \$namespace: String) {
  user(id: \$id) {
    roles(namespace: \$namespace) {
      totalCount
      list {
        code
        namespace
        arn
        description
        createdAt
        updatedAt
        parent {
          code
          namespace
          arn
          description
          createdAt
          updatedAt
        }
      }
    }
  }
}
EOF;
}
    

    
class GroupResponse {

    /**
     * @var Group
     */
    public $group;
}
    
class GroupParam {

    /**
     * Required
     * 
     * @var string
     */
    public $code;

/**
 * @param $code string
 */
public function __construct($code) {
$this->code = $code;
}

    function createRequest() {
      return [
        "query" => self::GroupDocument,
        "operationName" => "group",
        "variables" => $this
      ];
    }

    const GroupDocument = <<<EOF
query group(\$code: String!) {
  group(code: \$code) {
    code
    name
    description
    createdAt
    updatedAt
  }
}
EOF;
}
    

    
class GroupWithUsersResponse {

    /**
     * @var Group
     */
    public $groupWithUsers;
}
    
class GroupWithUsersParam {

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

/**
 * @param $code string
 */
public function __construct($code) {
$this->code = $code;
}

/**
 * @param $page int
 * @return GroupWithUsersParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return GroupWithUsersParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::GroupWithUsersDocument,
        "operationName" => "groupWithUsers",
        "variables" => $this
      ];
    }

    const GroupWithUsersDocument = <<<EOF
query groupWithUsers(\$code: String!, \$page: Int, \$limit: Int) {
  group(code: \$code) {
    users(page: \$page, limit: \$limit) {
      totalCount
      list {
        id
        arn
        userPoolId
        username
        email
        emailVerified
        phone
        phoneVerified
        unionid
        openid
        nickname
        registerSource
        photo
        password
        oauth
        token
        tokenExpiredAt
        loginsCount
        lastLogin
        lastIP
        signedUp
        blocked
        isDeleted
        device
        browser
        company
        name
        givenName
        familyName
        middleName
        profile
        preferredUsername
        website
        gender
        birthdate
        zoneinfo
        locale
        address
        formatted
        streetAddress
        locality
        region
        postalCode
        city
        province
        country
        createdAt
        updatedAt
        externalId
      }
    }
  }
}
EOF;
}
    

    
class GroupsResponse {

    /**
     * @var PaginatedGroups
     */
    public $groups;
}
    
class GroupsParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $userId;

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

    /**
     * Optional
     * 
     * @var SortByEnum
     */
    public $sortBy;

public function __construct() {

}

/**
 * @param $userId string
 * @return GroupsParam
 */
public function withUserId($userId) {
  $this->userId = $userId;
  return $this;
}

/**
 * @param $page int
 * @return GroupsParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return GroupsParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $sortBy SortByEnum
 * @return GroupsParam
 */
public function withSortBy($sortBy) {
  $this->sortBy = $sortBy;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::GroupsDocument,
        "operationName" => "groups",
        "variables" => $this
      ];
    }

    const GroupsDocument = <<<EOF
query groups(\$userId: String, \$page: Int, \$limit: Int, \$sortBy: SortByEnum) {
  groups(userId: \$userId, page: \$page, limit: \$limit, sortBy: \$sortBy) {
    totalCount
    list {
      code
      name
      description
      createdAt
      updatedAt
    }
  }
}
EOF;
}
    

    
class IsActionAllowedResponse {

    /**
     * @var bool
     */
    public $isActionAllowed;
}
    
class IsActionAllowedParam {

    /**
     * Required
     * 
     * @var string
     */
    public $resource;

    /**
     * Required
     * 
     * @var string
     */
    public $action;

    /**
     * Required
     * 
     * @var string
     */
    public $userId;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

/**
 * @param $resource string
 * @param $action string
 * @param $userId string
 */
public function __construct($resource,$action,$userId) {
$this->resource = $resource;
$this->action = $action;
$this->userId = $userId;
}

/**
 * @param $namespace string
 * @return IsActionAllowedParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::IsActionAllowedDocument,
        "operationName" => "isActionAllowed",
        "variables" => $this
      ];
    }

    const IsActionAllowedDocument = <<<EOF
query isActionAllowed(\$resource: String!, \$action: String!, \$userId: String!, \$namespace: String) {
  isActionAllowed(resource: \$resource, action: \$action, userId: \$userId, namespace: \$namespace)
}
EOF;
}
    

    
class IsActionDeniedResponse {

    /**
     * @var bool
     */
    public $isActionDenied;
}
    
class IsActionDeniedParam {

    /**
     * Required
     * 
     * @var string
     */
    public $resource;

    /**
     * Required
     * 
     * @var string
     */
    public $action;

    /**
     * Required
     * 
     * @var string
     */
    public $userId;

/**
 * @param $resource string
 * @param $action string
 * @param $userId string
 */
public function __construct($resource,$action,$userId) {
$this->resource = $resource;
$this->action = $action;
$this->userId = $userId;
}

    function createRequest() {
      return [
        "query" => self::IsActionDeniedDocument,
        "operationName" => "isActionDenied",
        "variables" => $this
      ];
    }

    const IsActionDeniedDocument = <<<EOF
query isActionDenied(\$resource: String!, \$action: String!, \$userId: String!) {
  isActionDenied(resource: \$resource, action: \$action, userId: \$userId)
}
EOF;
}
    

    
class IsDomainAvaliableResponse {

    /**
     * @var bool
     */
    public $isDomainAvaliable;
}
    
class IsDomainAvaliableParam {

    /**
     * Required
     * 
     * @var string
     */
    public $domain;

/**
 * @param $domain string
 */
public function __construct($domain) {
$this->domain = $domain;
}

    function createRequest() {
      return [
        "query" => self::IsDomainAvaliableDocument,
        "operationName" => "isDomainAvaliable",
        "variables" => $this
      ];
    }

    const IsDomainAvaliableDocument = <<<EOF
query isDomainAvaliable(\$domain: String!) {
  isDomainAvaliable(domain: \$domain)
}
EOF;
}
    

    
class IsRootNodeResponse {

    /**
     * @var bool
     */
    public $isRootNode;
}
    
class IsRootNodeParam {

    /**
     * Required
     * 
     * @var string
     */
    public $nodeId;

    /**
     * Required
     * 
     * @var string
     */
    public $orgId;

/**
 * @param $nodeId string
 * @param $orgId string
 */
public function __construct($nodeId,$orgId) {
$this->nodeId = $nodeId;
$this->orgId = $orgId;
}

    function createRequest() {
      return [
        "query" => self::IsRootNodeDocument,
        "operationName" => "isRootNode",
        "variables" => $this
      ];
    }

    const IsRootNodeDocument = <<<EOF
query isRootNode(\$nodeId: String!, \$orgId: String!) {
  isRootNode(nodeId: \$nodeId, orgId: \$orgId)
}
EOF;
}
    

    
class IsUserExistsResponse {

    /**
     * @var bool
     */
    public $isUserExists;
}
    
class IsUserExistsParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $email;

    /**
     * Optional
     * 
     * @var string
     */
    public $phone;

    /**
     * Optional
     * 
     * @var string
     */
    public $username;

    /**
     * Optional
     * 
     * @var string
     */
    public $externalId;

public function __construct() {

}

/**
 * @param $email string
 * @return IsUserExistsParam
 */
public function withEmail($email) {
  $this->email = $email;
  return $this;
}

/**
 * @param $phone string
 * @return IsUserExistsParam
 */
public function withPhone($phone) {
  $this->phone = $phone;
  return $this;
}

/**
 * @param $username string
 * @return IsUserExistsParam
 */
public function withUsername($username) {
  $this->username = $username;
  return $this;
}

/**
 * @param $externalId string
 * @return IsUserExistsParam
 */
public function withExternalId($externalId) {
  $this->externalId = $externalId;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::IsUserExistsDocument,
        "operationName" => "isUserExists",
        "variables" => $this
      ];
    }

    const IsUserExistsDocument = <<<EOF
query isUserExists(\$email: String, \$phone: String, \$username: String, \$externalId: String) {
  isUserExists(email: \$email, phone: \$phone, username: \$username, externalId: \$externalId)
}
EOF;
}
    

    
class AuthorizedResourcesResponse {

    /**
     * @var PaginatedAuthorizedResources
     */
    public $authorizedResources;
}
    
class AuthorizedResourcesParam {

    /**
     * Optional
     * 
     * @var PolicyAssignmentTargetType
     */
    public $targetType;

    /**
     * Optional
     * 
     * @var string
     */
    public $targetIdentifier;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Optional
     * 
     * @var string
     */
    public $resourceType;

public function __construct() {

}

/**
 * @param $targetType PolicyAssignmentTargetType
 * @return AuthorizedResourcesParam
 */
public function withTargetType($targetType) {
  $this->targetType = $targetType;
  return $this;
}

/**
 * @param $targetIdentifier string
 * @return AuthorizedResourcesParam
 */
public function withTargetIdentifier($targetIdentifier) {
  $this->targetIdentifier = $targetIdentifier;
  return $this;
}

/**
 * @param $namespace string
 * @return AuthorizedResourcesParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}

/**
 * @param $resourceType string
 * @return AuthorizedResourcesParam
 */
public function withResourceType($resourceType) {
  $this->resourceType = $resourceType;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::AuthorizedResourcesDocument,
        "operationName" => "authorizedResources",
        "variables" => $this
      ];
    }

    const AuthorizedResourcesDocument = <<<EOF
query authorizedResources(\$targetType: PolicyAssignmentTargetType, \$targetIdentifier: String, \$namespace: String, \$resourceType: String) {
  authorizedResources(targetType: \$targetType, targetIdentifier: \$targetIdentifier, namespace: \$namespace, resourceType: \$resourceType) {
    totalCount
    list {
      code
      type
      actions
    }
  }
}
EOF;
}
    

    
class ListGroupAuthorizedResourcesResponse {

    /**
     * @var Group
     */
    public $listGroupAuthorizedResources;
}
    
class ListGroupAuthorizedResourcesParam {

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Optional
     * 
     * @var string
     */
    public $resourceType;

/**
 * @param $code string
 */
public function __construct($code) {
$this->code = $code;
}

/**
 * @param $namespace string
 * @return ListGroupAuthorizedResourcesParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}

/**
 * @param $resourceType string
 * @return ListGroupAuthorizedResourcesParam
 */
public function withResourceType($resourceType) {
  $this->resourceType = $resourceType;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::ListGroupAuthorizedResourcesDocument,
        "operationName" => "listGroupAuthorizedResources",
        "variables" => $this
      ];
    }

    const ListGroupAuthorizedResourcesDocument = <<<EOF
query listGroupAuthorizedResources(\$code: String!, \$namespace: String, \$resourceType: String) {
  group(code: \$code) {
    authorizedResources(namespace: \$namespace, resourceType: \$resourceType) {
      totalCount
      list {
        code
        type
        actions
      }
    }
  }
}
EOF;
}
    

    
class ListNodeByCodeAuthorizedResourcesResponse {

    /**
     * @var Node
     */
    public $listNodeByCodeAuthorizedResources;
}
    
class ListNodeByCodeAuthorizedResourcesParam {

    /**
     * Required
     * 
     * @var string
     */
    public $orgId;

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Optional
     * 
     * @var string
     */
    public $resourceType;

/**
 * @param $orgId string
 * @param $code string
 */
public function __construct($orgId,$code) {
$this->orgId = $orgId;
$this->code = $code;
}

/**
 * @param $namespace string
 * @return ListNodeByCodeAuthorizedResourcesParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}

/**
 * @param $resourceType string
 * @return ListNodeByCodeAuthorizedResourcesParam
 */
public function withResourceType($resourceType) {
  $this->resourceType = $resourceType;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::ListNodeByCodeAuthorizedResourcesDocument,
        "operationName" => "listNodeByCodeAuthorizedResources",
        "variables" => $this
      ];
    }

    const ListNodeByCodeAuthorizedResourcesDocument = <<<EOF
query listNodeByCodeAuthorizedResources(\$orgId: String!, \$code: String!, \$namespace: String, \$resourceType: String) {
  nodeByCode(orgId: \$orgId, code: \$code) {
    authorizedResources(namespace: \$namespace, resourceType: \$resourceType) {
      totalCount
      list {
        code
        type
        actions
      }
    }
  }
}
EOF;
}
    

    
class ListNodeByIdAuthorizedResourcesResponse {

    /**
     * @var Node
     */
    public $listNodeByIdAuthorizedResources;
}
    
class ListNodeByIdAuthorizedResourcesParam {

    /**
     * Required
     * 
     * @var string
     */
    public $id;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Optional
     * 
     * @var string
     */
    public $resourceType;

/**
 * @param $id string
 */
public function __construct($id) {
$this->id = $id;
}

/**
 * @param $namespace string
 * @return ListNodeByIdAuthorizedResourcesParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}

/**
 * @param $resourceType string
 * @return ListNodeByIdAuthorizedResourcesParam
 */
public function withResourceType($resourceType) {
  $this->resourceType = $resourceType;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::ListNodeByIdAuthorizedResourcesDocument,
        "operationName" => "listNodeByIdAuthorizedResources",
        "variables" => $this
      ];
    }

    const ListNodeByIdAuthorizedResourcesDocument = <<<EOF
query listNodeByIdAuthorizedResources(\$id: String!, \$namespace: String, \$resourceType: String) {
  nodeById(id: \$id) {
    authorizedResources(namespace: \$namespace, resourceType: \$resourceType) {
      totalCount
      list {
        code
        type
        actions
      }
    }
  }
}
EOF;
}
    

    
class ListRoleAuthorizedResourcesResponse {

    /**
     * @var Role
     */
    public $listRoleAuthorizedResources;
}
    
class ListRoleAuthorizedResourcesParam {

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Optional
     * 
     * @var string
     */
    public $resourceType;

/**
 * @param $code string
 */
public function __construct($code) {
$this->code = $code;
}

/**
 * @param $namespace string
 * @return ListRoleAuthorizedResourcesParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}

/**
 * @param $resourceType string
 * @return ListRoleAuthorizedResourcesParam
 */
public function withResourceType($resourceType) {
  $this->resourceType = $resourceType;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::ListRoleAuthorizedResourcesDocument,
        "operationName" => "listRoleAuthorizedResources",
        "variables" => $this
      ];
    }

    const ListRoleAuthorizedResourcesDocument = <<<EOF
query listRoleAuthorizedResources(\$code: String!, \$namespace: String, \$resourceType: String) {
  role(code: \$code, namespace: \$namespace) {
    authorizedResources(resourceType: \$resourceType) {
      totalCount
      list {
        code
        type
        actions
      }
    }
  }
}
EOF;
}
    

    
class ListUserAuthorizedResourcesResponse {

    /**
     * @var User
     */
    public $listUserAuthorizedResources;
}
    
class ListUserAuthorizedResourcesParam {

    /**
     * Required
     * 
     * @var string
     */
    public $id;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Optional
     * 
     * @var string
     */
    public $resourceType;

/**
 * @param $id string
 */
public function __construct($id) {
$this->id = $id;
}

/**
 * @param $namespace string
 * @return ListUserAuthorizedResourcesParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}

/**
 * @param $resourceType string
 * @return ListUserAuthorizedResourcesParam
 */
public function withResourceType($resourceType) {
  $this->resourceType = $resourceType;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::ListUserAuthorizedResourcesDocument,
        "operationName" => "listUserAuthorizedResources",
        "variables" => $this
      ];
    }

    const ListUserAuthorizedResourcesDocument = <<<EOF
query listUserAuthorizedResources(\$id: String!, \$namespace: String, \$resourceType: String) {
  user(id: \$id) {
    authorizedResources(namespace: \$namespace, resourceType: \$resourceType) {
      totalCount
      list {
        code
        type
        actions
      }
    }
  }
}
EOF;
}
    

    
class NodeByCodeResponse {

    /**
     * @var Node
     */
    public $nodeByCode;
}
    
class NodeByCodeParam {

    /**
     * Required
     * 
     * @var string
     */
    public $orgId;

    /**
     * Required
     * 
     * @var string
     */
    public $code;

/**
 * @param $orgId string
 * @param $code string
 */
public function __construct($orgId,$code) {
$this->orgId = $orgId;
$this->code = $code;
}

    function createRequest() {
      return [
        "query" => self::NodeByCodeDocument,
        "operationName" => "nodeByCode",
        "variables" => $this
      ];
    }

    const NodeByCodeDocument = <<<EOF
query nodeByCode(\$orgId: String!, \$code: String!) {
  nodeByCode(orgId: \$orgId, code: \$code) {
    id
    orgId
    name
    nameI18n
    description
    descriptionI18n
    order
    code
    root
    depth
    path
    createdAt
    updatedAt
    children
  }
}
EOF;
}
    

    
class NodeByCodeWithMembersResponse {

    /**
     * @var Node
     */
    public $nodeByCodeWithMembers;
}
    
class NodeByCodeWithMembersParam {

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

    /**
     * Optional
     * 
     * @var SortByEnum
     */
    public $sortBy;

    /**
     * Optional
     * 
     * @var bool
     */
    public $includeChildrenNodes;

    /**
     * Required
     * 
     * @var string
     */
    public $orgId;

    /**
     * Required
     * 
     * @var string
     */
    public $code;

/**
 * @param $orgId string
 * @param $code string
 */
public function __construct($orgId,$code) {
$this->orgId = $orgId;
$this->code = $code;
}

/**
 * @param $page int
 * @return NodeByCodeWithMembersParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return NodeByCodeWithMembersParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $sortBy SortByEnum
 * @return NodeByCodeWithMembersParam
 */
public function withSortBy($sortBy) {
  $this->sortBy = $sortBy;
  return $this;
}

/**
 * @param $includeChildrenNodes bool
 * @return NodeByCodeWithMembersParam
 */
public function withIncludeChildrenNodes($includeChildrenNodes) {
  $this->includeChildrenNodes = $includeChildrenNodes;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::NodeByCodeWithMembersDocument,
        "operationName" => "nodeByCodeWithMembers",
        "variables" => $this
      ];
    }

    const NodeByCodeWithMembersDocument = <<<EOF
query nodeByCodeWithMembers(\$page: Int, \$limit: Int, \$sortBy: SortByEnum, \$includeChildrenNodes: Boolean, \$orgId: String!, \$code: String!) {
  nodeByCode(orgId: \$orgId, code: \$code) {
    id
    orgId
    name
    nameI18n
    description
    descriptionI18n
    order
    code
    root
    depth
    createdAt
    updatedAt
    children
    users(page: \$page, limit: \$limit, sortBy: \$sortBy, includeChildrenNodes: \$includeChildrenNodes) {
      totalCount
      list {
        id
        arn
        userPoolId
        status
        username
        email
        emailVerified
        phone
        phoneVerified
        unionid
        openid
        nickname
        registerSource
        photo
        password
        oauth
        token
        tokenExpiredAt
        loginsCount
        lastLogin
        lastIP
        signedUp
        blocked
        isDeleted
        device
        browser
        company
        name
        givenName
        familyName
        middleName
        profile
        preferredUsername
        website
        gender
        birthdate
        zoneinfo
        locale
        address
        formatted
        streetAddress
        locality
        region
        postalCode
        city
        province
        country
        createdAt
        updatedAt
        externalId
      }
    }
  }
}
EOF;
}
    

    
class NodeByIdResponse {

    /**
     * @var Node
     */
    public $nodeById;
}
    
class NodeByIdParam {

    /**
     * Required
     * 
     * @var string
     */
    public $id;

/**
 * @param $id string
 */
public function __construct($id) {
$this->id = $id;
}

    function createRequest() {
      return [
        "query" => self::NodeByIdDocument,
        "operationName" => "nodeById",
        "variables" => $this
      ];
    }

    const NodeByIdDocument = <<<EOF
query nodeById(\$id: String!) {
  nodeById(id: \$id) {
    id
    orgId
    name
    nameI18n
    description
    descriptionI18n
    order
    code
    root
    depth
    path
    createdAt
    updatedAt
    children
  }
}
EOF;
}
    

    
class NodeByIdWithMembersResponse {

    /**
     * @var Node
     */
    public $nodeByIdWithMembers;
}
    
class NodeByIdWithMembersParam {

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

    /**
     * Optional
     * 
     * @var SortByEnum
     */
    public $sortBy;

    /**
     * Optional
     * 
     * @var bool
     */
    public $includeChildrenNodes;

    /**
     * Required
     * 
     * @var string
     */
    public $id;

/**
 * @param $id string
 */
public function __construct($id) {
$this->id = $id;
}

/**
 * @param $page int
 * @return NodeByIdWithMembersParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return NodeByIdWithMembersParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $sortBy SortByEnum
 * @return NodeByIdWithMembersParam
 */
public function withSortBy($sortBy) {
  $this->sortBy = $sortBy;
  return $this;
}

/**
 * @param $includeChildrenNodes bool
 * @return NodeByIdWithMembersParam
 */
public function withIncludeChildrenNodes($includeChildrenNodes) {
  $this->includeChildrenNodes = $includeChildrenNodes;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::NodeByIdWithMembersDocument,
        "operationName" => "nodeByIdWithMembers",
        "variables" => $this
      ];
    }

    const NodeByIdWithMembersDocument = <<<EOF
query nodeByIdWithMembers(\$page: Int, \$limit: Int, \$sortBy: SortByEnum, \$includeChildrenNodes: Boolean, \$id: String!) {
  nodeById(id: \$id) {
    id
    orgId
    name
    nameI18n
    description
    descriptionI18n
    order
    code
    root
    depth
    createdAt
    updatedAt
    children
    users(page: \$page, limit: \$limit, sortBy: \$sortBy, includeChildrenNodes: \$includeChildrenNodes) {
      totalCount
      list {
        id
        arn
        userPoolId
        status
        username
        email
        emailVerified
        phone
        phoneVerified
        unionid
        openid
        nickname
        registerSource
        photo
        password
        oauth
        token
        tokenExpiredAt
        loginsCount
        lastLogin
        lastIP
        signedUp
        blocked
        isDeleted
        device
        browser
        company
        name
        givenName
        familyName
        middleName
        profile
        preferredUsername
        website
        gender
        birthdate
        zoneinfo
        locale
        address
        formatted
        streetAddress
        locality
        region
        postalCode
        city
        province
        country
        createdAt
        updatedAt
        externalId
      }
    }
  }
}
EOF;
}
    

    
class OrgResponse {

    /**
     * @var Org
     */
    public $org;
}
    
class OrgParam {

    /**
     * Required
     * 
     * @var string
     */
    public $id;

/**
 * @param $id string
 */
public function __construct($id) {
$this->id = $id;
}

    function createRequest() {
      return [
        "query" => self::OrgDocument,
        "operationName" => "org",
        "variables" => $this
      ];
    }

    const OrgDocument = <<<EOF
query org(\$id: String!) {
  org(id: \$id) {
    id
    rootNode {
      id
      orgId
      name
      nameI18n
      description
      descriptionI18n
      order
      code
      root
      depth
      path
      createdAt
      updatedAt
      children
    }
    nodes {
      id
      orgId
      name
      nameI18n
      description
      descriptionI18n
      order
      code
      root
      depth
      path
      createdAt
      updatedAt
      children
    }
  }
}
EOF;
}
    

    
class OrgsResponse {

    /**
     * @var PaginatedOrgs
     */
    public $orgs;
}
    
class OrgsParam {

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

    /**
     * Optional
     * 
     * @var SortByEnum
     */
    public $sortBy;

public function __construct() {

}

/**
 * @param $page int
 * @return OrgsParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return OrgsParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $sortBy SortByEnum
 * @return OrgsParam
 */
public function withSortBy($sortBy) {
  $this->sortBy = $sortBy;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::OrgsDocument,
        "operationName" => "orgs",
        "variables" => $this
      ];
    }

    const OrgsDocument = <<<EOF
query orgs(\$page: Int, \$limit: Int, \$sortBy: SortByEnum) {
  orgs(page: \$page, limit: \$limit, sortBy: \$sortBy) {
    totalCount
    list {
      id
      rootNode {
        id
        name
        nameI18n
        path
        description
        descriptionI18n
        order
        code
        root
        depth
        createdAt
        updatedAt
        children
      }
      nodes {
        id
        name
        path
        nameI18n
        description
        descriptionI18n
        order
        code
        root
        depth
        createdAt
        updatedAt
        children
      }
    }
  }
}
EOF;
}
    

    
class PoliciesResponse {

    /**
     * @var PaginatedPolicies
     */
    public $policies;
}
    
class PoliciesParam {

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

public function __construct() {

}

/**
 * @param $page int
 * @return PoliciesParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return PoliciesParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $namespace string
 * @return PoliciesParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::PoliciesDocument,
        "operationName" => "policies",
        "variables" => $this
      ];
    }

    const PoliciesDocument = <<<EOF
query policies(\$page: Int, \$limit: Int, \$namespace: String) {
  policies(page: \$page, limit: \$limit, namespace: \$namespace) {
    totalCount
    list {
      namespace
      code
      description
      createdAt
      updatedAt
      statements {
        resource
        actions
        effect
        condition {
          param
          operator
          value
        }
      }
    }
  }
}
EOF;
}
    

    
class PolicyResponse {

    /**
     * @var Policy
     */
    public $policy;
}
    
class PolicyParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Required
     * 
     * @var string
     */
    public $code;

/**
 * @param $code string
 */
public function __construct($code) {
$this->code = $code;
}

/**
 * @param $namespace string
 * @return PolicyParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::PolicyDocument,
        "operationName" => "policy",
        "variables" => $this
      ];
    }

    const PolicyDocument = <<<EOF
query policy(\$namespace: String, \$code: String!) {
  policy(code: \$code, namespace: \$namespace) {
    namespace
    code
    isDefault
    description
    statements {
      resource
      actions
      effect
      condition {
        param
        operator
        value
      }
    }
    createdAt
    updatedAt
  }
}
EOF;
}
    

    
class PolicyAssignmentsResponse {

    /**
     * @var PaginatedPolicyAssignments
     */
    public $policyAssignments;
}
    
class PolicyAssignmentsParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Optional
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var PolicyAssignmentTargetType
     */
    public $targetType;

    /**
     * Optional
     * 
     * @var string
     */
    public $targetIdentifier;

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

public function __construct() {

}

/**
 * @param $namespace string
 * @return PolicyAssignmentsParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}

/**
 * @param $code string
 * @return PolicyAssignmentsParam
 */
public function withCode($code) {
  $this->code = $code;
  return $this;
}

/**
 * @param $targetType PolicyAssignmentTargetType
 * @return PolicyAssignmentsParam
 */
public function withTargetType($targetType) {
  $this->targetType = $targetType;
  return $this;
}

/**
 * @param $targetIdentifier string
 * @return PolicyAssignmentsParam
 */
public function withTargetIdentifier($targetIdentifier) {
  $this->targetIdentifier = $targetIdentifier;
  return $this;
}

/**
 * @param $page int
 * @return PolicyAssignmentsParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return PolicyAssignmentsParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::PolicyAssignmentsDocument,
        "operationName" => "policyAssignments",
        "variables" => $this
      ];
    }

    const PolicyAssignmentsDocument = <<<EOF
query policyAssignments(\$namespace: String, \$code: String, \$targetType: PolicyAssignmentTargetType, \$targetIdentifier: String, \$page: Int, \$limit: Int) {
  policyAssignments(namespace: \$namespace, code: \$code, targetType: \$targetType, targetIdentifier: \$targetIdentifier, page: \$page, limit: \$limit) {
    totalCount
    list {
      code
      targetType
      targetIdentifier
    }
  }
}
EOF;
}
    

    
class PolicyWithAssignmentsResponse {

    /**
     * @var Policy
     */
    public $policyWithAssignments;
}
    
class PolicyWithAssignmentsParam {

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

    /**
     * Required
     * 
     * @var string
     */
    public $code;

/**
 * @param $code string
 */
public function __construct($code) {
$this->code = $code;
}

/**
 * @param $page int
 * @return PolicyWithAssignmentsParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return PolicyWithAssignmentsParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::PolicyWithAssignmentsDocument,
        "operationName" => "policyWithAssignments",
        "variables" => $this
      ];
    }

    const PolicyWithAssignmentsDocument = <<<EOF
query policyWithAssignments(\$page: Int, \$limit: Int, \$code: String!) {
  policy(code: \$code) {
    code
    isDefault
    description
    statements {
      resource
      actions
      effect
    }
    createdAt
    updatedAt
    assignmentsCount
    assignments(page: \$page, limit: \$limit) {
      code
      targetType
      targetIdentifier
    }
  }
}
EOF;
}
    

    
class PreviewEmailResponse {

    /**
     * @var string
     */
    public $previewEmail;
}
    
class PreviewEmailParam {

    /**
     * Required
     * 
     * @var EmailTemplateType
     */
    public $type;

/**
 * @param $type EmailTemplateType
 */
public function __construct($type) {
$this->type = $type;
}

    function createRequest() {
      return [
        "query" => self::PreviewEmailDocument,
        "operationName" => "previewEmail",
        "variables" => $this
      ];
    }

    const PreviewEmailDocument = <<<EOF
query previewEmail(\$type: EmailTemplateType!) {
  previewEmail(type: \$type)
}
EOF;
}
    

    
class QiniuUptokenResponse {

    /**
     * @var string
     */
    public $qiniuUptoken;
}
    
class QiniuUptokenParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $type;

public function __construct() {

}

/**
 * @param $type string
 * @return QiniuUptokenParam
 */
public function withType($type) {
  $this->type = $type;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::QiniuUptokenDocument,
        "operationName" => "qiniuUptoken",
        "variables" => $this
      ];
    }

    const QiniuUptokenDocument = <<<EOF
query qiniuUptoken(\$type: String) {
  qiniuUptoken(type: \$type)
}
EOF;
}
    

    
class QueryMfaResponse {

    /**
     * @var Mfa
     */
    public $queryMfa;
}
    
class QueryMfaParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $id;

    /**
     * Optional
     * 
     * @var string
     */
    public $userId;

    /**
     * Optional
     * 
     * @var string
     */
    public $userPoolId;

public function __construct() {

}

/**
 * @param $id string
 * @return QueryMfaParam
 */
public function withId($id) {
  $this->id = $id;
  return $this;
}

/**
 * @param $userId string
 * @return QueryMfaParam
 */
public function withUserId($userId) {
  $this->userId = $userId;
  return $this;
}

/**
 * @param $userPoolId string
 * @return QueryMfaParam
 */
public function withUserPoolId($userPoolId) {
  $this->userPoolId = $userPoolId;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::QueryMfaDocument,
        "operationName" => "queryMfa",
        "variables" => $this
      ];
    }

    const QueryMfaDocument = <<<EOF
query queryMfa(\$id: String, \$userId: String, \$userPoolId: String) {
  queryMfa(id: \$id, userId: \$userId, userPoolId: \$userPoolId) {
    id
    userId
    userPoolId
    enable
    secret
  }
}
EOF;
}
    

    
class RoleResponse {

    /**
     * @var Role
     */
    public $role;
}
    
class RoleParam {

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

/**
 * @param $code string
 */
public function __construct($code) {
$this->code = $code;
}

/**
 * @param $namespace string
 * @return RoleParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::RoleDocument,
        "operationName" => "role",
        "variables" => $this
      ];
    }

    const RoleDocument = <<<EOF
query role(\$code: String!, \$namespace: String) {
  role(code: \$code, namespace: \$namespace) {
    namespace
    code
    arn
    description
    createdAt
    updatedAt
    parent {
      namespace
      code
      arn
      description
      createdAt
      updatedAt
    }
  }
}
EOF;
}
    

    
class RoleWithUsersResponse {

    /**
     * @var Role
     */
    public $roleWithUsers;
}
    
class RoleWithUsersParam {

    /**
     * Required
     * 
     * @var string
     */
    public $code;

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

/**
 * @param $code string
 */
public function __construct($code) {
$this->code = $code;
}

/**
 * @param $namespace string
 * @return RoleWithUsersParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::RoleWithUsersDocument,
        "operationName" => "roleWithUsers",
        "variables" => $this
      ];
    }

    const RoleWithUsersDocument = <<<EOF
query roleWithUsers(\$code: String!, \$namespace: String) {
  role(code: \$code, namespace: \$namespace) {
    users {
      totalCount
      list {
        id
        arn
        status
        userPoolId
        username
        email
        emailVerified
        phone
        phoneVerified
        unionid
        openid
        nickname
        registerSource
        photo
        password
        oauth
        token
        tokenExpiredAt
        loginsCount
        lastLogin
        lastIP
        signedUp
        blocked
        isDeleted
        device
        browser
        company
        name
        givenName
        familyName
        middleName
        profile
        preferredUsername
        website
        gender
        birthdate
        zoneinfo
        locale
        address
        formatted
        streetAddress
        locality
        region
        postalCode
        city
        province
        country
        createdAt
        updatedAt
        externalId
      }
    }
  }
}
EOF;
}
    

    
class RolesResponse {

    /**
     * @var PaginatedRoles
     */
    public $roles;
}
    
class RolesParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $namespace;

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

    /**
     * Optional
     * 
     * @var SortByEnum
     */
    public $sortBy;

public function __construct() {

}

/**
 * @param $namespace string
 * @return RolesParam
 */
public function withNamespace($namespace) {
  $this->namespace = $namespace;
  return $this;
}

/**
 * @param $page int
 * @return RolesParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return RolesParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $sortBy SortByEnum
 * @return RolesParam
 */
public function withSortBy($sortBy) {
  $this->sortBy = $sortBy;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::RolesDocument,
        "operationName" => "roles",
        "variables" => $this
      ];
    }

    const RolesDocument = <<<EOF
query roles(\$namespace: String, \$page: Int, \$limit: Int, \$sortBy: SortByEnum) {
  roles(namespace: \$namespace, page: \$page, limit: \$limit, sortBy: \$sortBy) {
    totalCount
    list {
      namespace
      code
      arn
      description
      createdAt
      updatedAt
    }
  }
}
EOF;
}
    

    
class RootNodeResponse {

    /**
     * @var Node
     */
    public $rootNode;
}
    
class RootNodeParam {

    /**
     * Required
     * 
     * @var string
     */
    public $orgId;

/**
 * @param $orgId string
 */
public function __construct($orgId) {
$this->orgId = $orgId;
}

    function createRequest() {
      return [
        "query" => self::RootNodeDocument,
        "operationName" => "rootNode",
        "variables" => $this
      ];
    }

    const RootNodeDocument = <<<EOF
query rootNode(\$orgId: String!) {
  rootNode(orgId: \$orgId) {
    id
    orgId
    name
    nameI18n
    description
    descriptionI18n
    order
    code
    root
    depth
    path
    codePath
    namePath
    createdAt
    updatedAt
    children
  }
}
EOF;
}
    

    
class SearchNodesResponse {

    /**
     * @var Node[]
     */
    public $searchNodes;
}
    
class SearchNodesParam {

    /**
     * Required
     * 
     * @var string
     */
    public $keyword;

/**
 * @param $keyword string
 */
public function __construct($keyword) {
$this->keyword = $keyword;
}

    function createRequest() {
      return [
        "query" => self::SearchNodesDocument,
        "operationName" => "searchNodes",
        "variables" => $this
      ];
    }

    const SearchNodesDocument = <<<EOF
query searchNodes(\$keyword: String!) {
  searchNodes(keyword: \$keyword) {
    id
    orgId
    name
    nameI18n
    description
    descriptionI18n
    order
    code
    root
    depth
    path
    codePath
    namePath
    createdAt
    updatedAt
    children
  }
}
EOF;
}
    

    
class SearchUserResponse {

    /**
     * @var PaginatedUsers
     */
    public $searchUser;
}
    
class SearchUserParam {

    /**
     * Required
     * 
     * @var string
     */
    public $query;

    /**
     * Optional
     * 
     * @var string[]
     */
    public $fields;

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

    /**
     * Optional
     * 
     * @var SearchUserDepartmentOpt[]
     */
    public $departmentOpts;

    /**
     * Optional
     * 
     * @var SearchUserGroupOpt[]
     */
    public $groupOpts;

    /**
     * Optional
     * 
     * @var SearchUserRoleOpt[]
     */
    public $roleOpts;

/**
 * @param $query string
 */
public function __construct($query) {
$this->query = $query;
}

/**
 * @param $fields string[]
 * @return SearchUserParam
 */
public function withFields($fields) {
  $this->fields = $fields;
  return $this;
}

/**
 * @param $page int
 * @return SearchUserParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return SearchUserParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $departmentOpts SearchUserDepartmentOpt[]
 * @return SearchUserParam
 */
public function withDepartmentOpts($departmentOpts) {
  $this->departmentOpts = $departmentOpts;
  return $this;
}

/**
 * @param $groupOpts SearchUserGroupOpt[]
 * @return SearchUserParam
 */
public function withGroupOpts($groupOpts) {
  $this->groupOpts = $groupOpts;
  return $this;
}

/**
 * @param $roleOpts SearchUserRoleOpt[]
 * @return SearchUserParam
 */
public function withRoleOpts($roleOpts) {
  $this->roleOpts = $roleOpts;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::SearchUserDocument,
        "operationName" => "searchUser",
        "variables" => $this
      ];
    }

    const SearchUserDocument = <<<EOF
query searchUser(\$query: String!, \$fields: [String], \$page: Int, \$limit: Int, \$departmentOpts: [SearchUserDepartmentOpt], \$groupOpts: [SearchUserGroupOpt], \$roleOpts: [SearchUserRoleOpt]) {
  searchUser(query: \$query, fields: \$fields, page: \$page, limit: \$limit, departmentOpts: \$departmentOpts, groupOpts: \$groupOpts, roleOpts: \$roleOpts) {
    totalCount
    list {
      id
      arn
      userPoolId
      status
      username
      email
      emailVerified
      phone
      phoneVerified
      unionid
      openid
      nickname
      registerSource
      photo
      password
      oauth
      token
      tokenExpiredAt
      loginsCount
      lastLogin
      lastIP
      signedUp
      blocked
      isDeleted
      device
      browser
      company
      name
      givenName
      familyName
      middleName
      profile
      preferredUsername
      website
      gender
      birthdate
      zoneinfo
      locale
      address
      formatted
      streetAddress
      locality
      region
      postalCode
      city
      province
      country
      createdAt
      updatedAt
      externalId
    }
  }
}
EOF;
}
    

    
class SocialConnectionResponse {

    /**
     * @var SocialConnection
     */
    public $socialConnection;
}
    
class SocialConnectionParam {

    /**
     * Required
     * 
     * @var string
     */
    public $provider;

/**
 * @param $provider string
 */
public function __construct($provider) {
$this->provider = $provider;
}

    function createRequest() {
      return [
        "query" => self::SocialConnectionDocument,
        "operationName" => "socialConnection",
        "variables" => $this
      ];
    }

    const SocialConnectionDocument = <<<EOF
query socialConnection(\$provider: String!) {
  socialConnection(provider: \$provider) {
    provider
    name
    logo
    description
    fields {
      key
      label
      type
      placeholder
    }
  }
}
EOF;
}
    

    
class SocialConnectionInstanceResponse {

    /**
     * @var SocialConnectionInstance
     */
    public $socialConnectionInstance;
}
    
class SocialConnectionInstanceParam {

    /**
     * Required
     * 
     * @var string
     */
    public $provider;

/**
 * @param $provider string
 */
public function __construct($provider) {
$this->provider = $provider;
}

    function createRequest() {
      return [
        "query" => self::SocialConnectionInstanceDocument,
        "operationName" => "socialConnectionInstance",
        "variables" => $this
      ];
    }

    const SocialConnectionInstanceDocument = <<<EOF
query socialConnectionInstance(\$provider: String!) {
  socialConnectionInstance(provider: \$provider) {
    provider
    enabled
    fields {
      key
      value
    }
  }
}
EOF;
}
    

    
class SocialConnectionInstancesResponse {

    /**
     * @var SocialConnectionInstance[]
     */
    public $socialConnectionInstances;
}
    
class SocialConnectionInstancesParam {



    function createRequest() {
      return [
        "query" => self::SocialConnectionInstancesDocument,
        "operationName" => "socialConnectionInstances",
        "variables" => $this
      ];
    }

    const SocialConnectionInstancesDocument = <<<EOF
query socialConnectionInstances {
  socialConnectionInstances {
    provider
    enabled
    fields {
      key
      value
    }
  }
}
EOF;
}
    

    
class SocialConnectionsResponse {

    /**
     * @var SocialConnection[]
     */
    public $socialConnections;
}
    
class SocialConnectionsParam {



    function createRequest() {
      return [
        "query" => self::SocialConnectionsDocument,
        "operationName" => "socialConnections",
        "variables" => $this
      ];
    }

    const SocialConnectionsDocument = <<<EOF
query socialConnections {
  socialConnections {
    provider
    name
    logo
    description
    fields {
      key
      label
      type
      placeholder
    }
  }
}
EOF;
}
    

    
class TemplateCodeResponse {

    /**
     * @var string
     */
    public $templateCode;
}
    
class TemplateCodeParam {



    function createRequest() {
      return [
        "query" => self::TemplateCodeDocument,
        "operationName" => "templateCode",
        "variables" => $this
      ];
    }

    const TemplateCodeDocument = <<<EOF
query templateCode {
  templateCode
}
EOF;
}
    

    
class UdfResponse {

    /**
     * @var UserDefinedField[]
     */
    public $udf;
}
    
class UdfParam {

    /**
     * Required
     * 
     * @var UdfTargetType
     */
    public $targetType;

/**
 * @param $targetType UdfTargetType
 */
public function __construct($targetType) {
$this->targetType = $targetType;
}

    function createRequest() {
      return [
        "query" => self::UdfDocument,
        "operationName" => "udf",
        "variables" => $this
      ];
    }

    const UdfDocument = <<<EOF
query udf(\$targetType: UDFTargetType!) {
  udf(targetType: \$targetType) {
    targetType
    dataType
    key
    label
    options
  }
}
EOF;
}
    

    
class UdfValueBatchResponse {

    /**
     * @var UserDefinedDataMap[]
     */
    public $udfValueBatch;
}
    
class UdfValueBatchParam {

    /**
     * Required
     * 
     * @var UdfTargetType
     */
    public $targetType;

    /**
     * Required
     * 
     * @var string[]
     */
    public $targetIds;

/**
 * @param $targetType UdfTargetType
 * @param $targetIds string[]
 */
public function __construct($targetType,$targetIds) {
$this->targetType = $targetType;
$this->targetIds = $targetIds;
}

    function createRequest() {
      return [
        "query" => self::UdfValueBatchDocument,
        "operationName" => "udfValueBatch",
        "variables" => $this
      ];
    }

    const UdfValueBatchDocument = <<<EOF
query udfValueBatch(\$targetType: UDFTargetType!, \$targetIds: [String!]!) {
  udfValueBatch(targetType: \$targetType, targetIds: \$targetIds) {
    targetId
    data {
      key
      dataType
      value
      label
    }
  }
}
EOF;
}
    

    
class UdvResponse {

    /**
     * @var UserDefinedData[]
     */
    public $udv;
}
    
class UdvParam {

    /**
     * Required
     * 
     * @var UdfTargetType
     */
    public $targetType;

    /**
     * Required
     * 
     * @var string
     */
    public $targetId;

/**
 * @param $targetType UdfTargetType
 * @param $targetId string
 */
public function __construct($targetType,$targetId) {
$this->targetType = $targetType;
$this->targetId = $targetId;
}

    function createRequest() {
      return [
        "query" => self::UdvDocument,
        "operationName" => "udv",
        "variables" => $this
      ];
    }

    const UdvDocument = <<<EOF
query udv(\$targetType: UDFTargetType!, \$targetId: String!) {
  udv(targetType: \$targetType, targetId: \$targetId) {
    key
    dataType
    value
    label
  }
}
EOF;
}
    

    
class UserResponse {

    /**
     * @var User
     */
    public $user;
}
    
class UserParam {

    /**
     * Optional
     * 
     * @var string
     */
    public $id;

public function __construct() {

}

/**
 * @param $id string
 * @return UserParam
 */
public function withId($id) {
  $this->id = $id;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::UserDocument,
        "operationName" => "user",
        "variables" => $this
      ];
    }

    const UserDocument = <<<EOF
query user(\$id: String) {
  user(id: \$id) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    identities {
      openid
      userIdInIdp
      userId
      connectionId
      isSocial
      provider
      userPoolId
    }
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
    externalId
  }
}
EOF;
}
    

    
class UserBatchResponse {

    /**
     * @var User[]
     */
    public $userBatch;
}
    
class UserBatchParam {

    /**
     * Required
     * 
     * @var string[]
     */
    public $ids;

/**
 * @param $ids string[]
 */
public function __construct($ids) {
$this->ids = $ids;
}

    function createRequest() {
      return [
        "query" => self::UserBatchDocument,
        "operationName" => "userBatch",
        "variables" => $this
      ];
    }

    const UserBatchDocument = <<<EOF
query userBatch(\$ids: [String!]!) {
  userBatch(ids: \$ids) {
    id
    arn
    userPoolId
    status
    username
    email
    emailVerified
    phone
    phoneVerified
    unionid
    openid
    nickname
    registerSource
    photo
    password
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
    device
    browser
    company
    name
    givenName
    familyName
    middleName
    profile
    preferredUsername
    website
    gender
    birthdate
    zoneinfo
    locale
    address
    formatted
    streetAddress
    locality
    region
    postalCode
    city
    province
    country
    createdAt
    updatedAt
    externalId
  }
}
EOF;
}
    

    
class UserpoolResponse {

    /**
     * @var UserPool
     */
    public $userpool;
}
    
class UserpoolParam {



    function createRequest() {
      return [
        "query" => self::UserpoolDocument,
        "operationName" => "userpool",
        "variables" => $this
      ];
    }

    const UserpoolDocument = <<<EOF
query userpool {
  userpool {
    id
    name
    domain
    description
    secret
    jwtSecret
    ownerId
    userpoolTypes {
      code
      name
      description
      image
      sdks
    }
    logo
    createdAt
    updatedAt
    emailVerifiedDefault
    sendWelcomeEmail
    registerDisabled
    appSsoEnabled
    showWxQRCodeWhenRegisterDisabled
    allowedOrigins
    tokenExpiresAfter
    isDeleted
    frequentRegisterCheck {
      timeInterval
      limit
      enabled
    }
    loginFailCheck {
      timeInterval
      limit
      enabled
    }
    changePhoneStrategy {
      verifyOldPhone
    }
    changeEmailStrategy {
      verifyOldEmail
    }
    qrcodeLoginStrategy {
      qrcodeExpiresAfter
      returnFullUserInfo
      allowExchangeUserInfoFromBrowser
      ticketExpiresAfter
    }
    app2WxappLoginStrategy {
      ticketExpriresAfter
      ticketExchangeUserInfoNeedSecret
    }
    whitelist {
      phoneEnabled
      emailEnabled
      usernameEnabled
    }
    customSMSProvider {
      enabled
      provider
      config
    }
    packageType
    useCustomUserStore
    loginRequireEmailVerified
    verifyCodeLength
  }
}
EOF;
}
    

    
class UserpoolTypesResponse {

    /**
     * @var UserPoolType[]
     */
    public $userpoolTypes;
}
    
class UserpoolTypesParam {



    function createRequest() {
      return [
        "query" => self::UserpoolTypesDocument,
        "operationName" => "userpoolTypes",
        "variables" => $this
      ];
    }

    const UserpoolTypesDocument = <<<EOF
query userpoolTypes {
  userpoolTypes {
    code
    name
    description
    image
    sdks
  }
}
EOF;
}
    

    
class UserpoolsResponse {

    /**
     * @var PaginatedUserpool
     */
    public $userpools;
}
    
class UserpoolsParam {

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

    /**
     * Optional
     * 
     * @var SortByEnum
     */
    public $sortBy;

public function __construct() {

}

/**
 * @param $page int
 * @return UserpoolsParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return UserpoolsParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $sortBy SortByEnum
 * @return UserpoolsParam
 */
public function withSortBy($sortBy) {
  $this->sortBy = $sortBy;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::UserpoolsDocument,
        "operationName" => "userpools",
        "variables" => $this
      ];
    }

    const UserpoolsDocument = <<<EOF
query userpools(\$page: Int, \$limit: Int, \$sortBy: SortByEnum) {
  userpools(page: \$page, limit: \$limit, sortBy: \$sortBy) {
    totalCount
    list {
      id
      name
      domain
      ownerId
      description
      secret
      jwtSecret
      logo
      createdAt
      updatedAt
      emailVerifiedDefault
      sendWelcomeEmail
      registerDisabled
      appSsoEnabled
      showWxQRCodeWhenRegisterDisabled
      allowedOrigins
      tokenExpiresAfter
      isDeleted
      packageType
      useCustomUserStore
      loginRequireEmailVerified
      verifyCodeLength
    }
  }
}
EOF;
}
    

    
class UsersResponse {

    /**
     * @var PaginatedUsers
     */
    public $users;
}
    
class UsersParam {

    /**
     * Optional
     * 
     * @var int
     */
    public $page;

    /**
     * Optional
     * 
     * @var int
     */
    public $limit;

    /**
     * Optional
     * 
     * @var SortByEnum
     */
    public $sortBy;

public function __construct() {

}

/**
 * @param $page int
 * @return UsersParam
 */
public function withPage($page) {
  $this->page = $page;
  return $this;
}

/**
 * @param $limit int
 * @return UsersParam
 */
public function withLimit($limit) {
  $this->limit = $limit;
  return $this;
}

/**
 * @param $sortBy SortByEnum
 * @return UsersParam
 */
public function withSortBy($sortBy) {
  $this->sortBy = $sortBy;
  return $this;
}
    function createRequest() {
      return [
        "query" => self::UsersDocument,
        "operationName" => "users",
        "variables" => $this
      ];
    }

    const UsersDocument = <<<EOF
query users(\$page: Int, \$limit: Int, \$sortBy: SortByEnum) {
  users(page: \$page, limit: \$limit, sortBy: \$sortBy) {
    totalCount
    list {
      id
      arn
      userPoolId
      status
      username
      email
      emailVerified
      phone
      phoneVerified
      unionid
      openid
      nickname
      registerSource
      photo
      password
      oauth
      token
      tokenExpiredAt
      loginsCount
      lastLogin
      lastIP
      signedUp
      blocked
      isDeleted
      device
      browser
      company
      name
      givenName
      familyName
      middleName
      profile
      preferredUsername
      website
      gender
      birthdate
      zoneinfo
      locale
      address
      formatted
      streetAddress
      locality
      region
      postalCode
      city
      province
      country
      createdAt
      updatedAt
      externalId
    }
  }
}
EOF;
}
    

    
class WhitelistResponse {

    /**
     * @var WhiteList[]
     */
    public $whitelist;
}
    
class WhitelistParam {

    /**
     * Required
     * 
     * @var WhitelistType
     */
    public $type;

/**
 * @param $type WhitelistType
 */
public function __construct($type) {
$this->type = $type;
}

    function createRequest() {
      return [
        "query" => self::WhitelistDocument,
        "operationName" => "whitelist",
        "variables" => $this
      ];
    }

    const WhitelistDocument = <<<EOF
query whitelist(\$type: WhitelistType!) {
  whitelist(type: \$type) {
    createdAt
    updatedAt
    value
  }
}
EOF;
}
    