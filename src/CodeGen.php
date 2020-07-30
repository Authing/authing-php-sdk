<?php /** @noinspection PhpMultipleClassesDeclarationsInOneFile */

namespace Authing;

class Query
{
    /**
     * Optional
     *
     * @var Email
     *
     */
    public $ReadEmailSentList;

    /**
     * Optional
     *
     * @var EmailListPaged
     *
     */
    public $ReadEmailSentListByClient;

    /**
     * Optional
     *
     * @var EmailProviderList[]
     *
     */
    public $ReadEmailProvider;

    /**
     * Optional
     *
     * @var EmailProviderWithClientList[]
     *
     */
    public $ReadEmailProviderByClientAndName;

    /**
     * Optional
     *
     * @var EmailTemplateWithClient[]
     *
     */
    public $ReadEmailTemplatesByClient;

    /**
     * Optional
     *
     * @var EmailProviderWithClientList[]
     *
     */
    public $ReadEmailProviderWithClient;

    /**
     * Optional
     *
     * @var EmailTemplate
     *
     */
    public $ReadEmailTemplateByClientAndType;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $PreviewEmailByType;

    /**
     * Optional
     *
     * @var EmailTemplateWithClient[]
     *
     */
    public $ReadEmailTemplatesBySystem;

    /**
     * Optional
     *
     * @var OAuthList[]
     *
     */
    public $ReadOauthList;

    /**
     * Optional
     *
     * @var SAMLSPListItem[]
     *
     */
    public $ReadSAMLSPList;

    /**
     * Optional
     *
     * @var int[]
     *
     */
    public $userOAuthCount;

    /**
     * Optional
     *
     * @var WxQRCodeLog
     *
     */
    public $wxQRCodeLog;

    /**
     * Optional
     *
     * @var OAuthList[]
     *
     */
    public $querySystemOAuthSetting;

    /**
     * Optional
     *
     * @var NotBindOAuth[]
     *
     */
    public $notBindOAuthList;

    /**
     * Optional
     *
     * @var OAuthProviderClient
     *
     */
    public $QueryClientIdByAppId;

    /**
     * Optional
     *
     * @var OAuthProviderClient
     *
     */
    public $getOAuthedAppInfo;

    /**
     * Optional
     *
     * @var OAuthAppPagedList
     *
     */
    public $getOAuthedAppList;

    /**
     * Optional
     *
     * @var OIDCProviderClient
     *
     */
    public $GetOIDCAppInfo;

    /**
     * Optional
     *
     * @var OIDCAppPagedList
     *
     */
    public $GetOIDCAppList;

    /**
     * Optional
     *
     * @var ProviderGeneralInfo
     *
     */
    public $queryProviderInfoByDomain;

    /**
     * Optional
     *
     * @var ProviderGeneralInfo
     *
     */
    public $queryProviderInfoByAppId;

    /**
     * Optional
     *
     * @var OAuthProviderClient
     *
     */
    public $QueryAppInfoByAppID;

    /**
     * Optional
     *
     * @var OAuthProviderClient
     *
     */
    public $QueryAppInfoByDomain;

    /**
     * Optional
     *
     * @var OIDCProviderClient
     *
     */
    public $QueryOIDCAppInfoByDomain;

    /**
     * Optional
     *
     * @var OIDCProviderClient
     *
     */
    public $QueryOIDCAppInfoByAppID;

    /**
     * Optional
     *
     * @var SAMLServiceProviderClient
     *
     */
    public $QuerySAMLServiceProviderInfoByAppID;

    /**
     * Optional
     *
     * @var SAMLServiceProviderClient
     *
     */
    public $QuerySAMLServiceProviderInfoByDomain;

    /**
     * Optional
     *
     * @var SAMLIdentityProviderClient
     *
     */
    public $QuerySAMLIdentityProviderInfoByAppID;

    /**
     * Optional
     *
     * @var SAMLIdentityProviderClient
     *
     */
    public $QuerySAMLIdentityProviderInfoByDomain;

    /**
     * Optional
     *
     * @var SAMLDefaultIdentityProviderSettingsList
     *
     */
    public $QueryDefaultSAMLIdentityProviderSettingsList;

    /**
     * Optional
     *
     * @var SAMLServiceProviderAppPagedList
     *
     */
    public $GetSAMLServiceProviderList;

    /**
     * Optional
     *
     * @var SAMLServiceProviderClient
     *
     */
    public $GetSAMLServiceProviderInfo;

    /**
     * Optional
     *
     * @var SAMLIdentityProviderClient
     *
     */
    public $GetSAMLIdentityProviderInfo;

    /**
     * Optional
     *
     * @var SAMLIdentityProviderAppPagedList
     *
     */
    public $GetSAMLIdentityProviderList;

    /**
     * Optional
     *
     * @var LDAPServerList
     *
     */
    public $QueryLDAPServerList;

    /**
     * Optional
     *
     * @var LDAPServerTesterType
     *
     */
    public $TestLDAPServer;

    /**
     * Optional
     *
     * @var LDAPUserTesterType
     *
     */
    public $TestLDAPUser;

    /**
     * Optional
     *
     * @var ClientHasLDAPConfigs
     *
     */
    public $QueryClientHasLDAPConfigs;

    /**
     * Optional
     *
     * @var UserAuthorizedAppPagedList
     *
     */
    public $GetUserAuthorizedApps;

    /**
     * Optional
     *
     * @var IsAppAuthorizedByUser
     *
     */
    public $isAppAuthorizedByUser;

    /**
     * Optional
     *
     * @var IsReservedDomain
     *
     */
    public $checkIsReservedDomain;

    /**
     * Optional
     *
     * @var PricingList[]
     *
     */
    public $ReadSystemPricing;

    /**
     * Optional
     *
     * @var PagedOrders
     *
     */
    public $ReadOrders;

    /**
     * Optional
     *
     * @var UserPricingType
     *
     */
    public $ReadUserPricing;

    /**
     * Optional
     *
     * @var PagedUsers
     *
     */
    public $users;

    /**
     * Optional
     *
     * @var UserIds
     *
     */
    public $usersByOidcApp;

    /**
     * Optional
     *
     * @var ExtendUser
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var UserAnalytics
     *
     */
    public $userAnalytics;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isLoginExpired;

    /**
     * Optional
     *
     * @var UserClient
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var PagedUserClients
     *
     */
    public $userClients;

    /**
     * Optional
     *
     * @var PagedUsers
     *
     */
    public $searchUser;

    /**
     * Optional
     *
     * @var UserClientType[]
     *
     */
    public $userClientTypes;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isClientOfUser;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $getAccessTokenByAppSecret;

    /**
     * Optional
     *
     * @var UserLoginCount
     *
     */
    public $loginCount;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $qiNiuUploadToken;

    /**
     * Optional
     *
     * @var JwtDecodedData
     *
     */
    public $decodeJwtToken;

    /**
     * Optional
     *
     * @var JWTDecodedDataCheckLogin
     *
     */
    public $checkLoginStatus;

    /**
     * Optional
     *
     * @var AppSecretByClientId
     *
     */
    public $getAppSecretByClientId;

    /**
     * Optional
     *
     * @var CommonMessage
     *
     */
    public $previewEmailTemplate;

    /**
     * Optional
     *
     * @var LoginHotDotPicData
     *
     */
    public $loginHotDotPicData;

    /**
     * Optional
     *
     * @var RegisterEveryDayCount
     *
     */
    public $registerEveryDayCount;

    /**
     * Optional
     *
     * @var Statistic
     *
     */
    public $statistic;

    /**
     * Optional
     *
     * @var PagedUserClientList
     *
     */
    public $userClientList;

    /**
     * Optional
     *
     * @var UsersInGroup
     *
     */
    public $usersInGroup;

    /**
     * Optional
     *
     * @var QpsByTime[]
     *
     */
    public $qpsByTime;

    /**
     * Optional
     *
     * @var GeographicalDistributionList[]
     *
     */
    public $todayGeoDistribution;

    /**
     * Optional
     *
     * @var PagedUserClientList
     *
     */
    public $findClientsByIdArray;

    /**
     * Optional
     *
     * @var DayServiceCallListOfAllServices
     *
     */
    public $recentServiceCall;

    /**
     * Optional
     *
     * @var DayUserGrowth[]
     *
     */
    public $platformUserGrowthTrend;

    /**
     * Optional
     *
     * @var PagedRequestList
     *
     */
    public $requestList;

    /**
     * Optional
     *
     * @var UserOAuthBind[]
     *
     */
    public $bindedOAuthList;

    /**
     * Optional
     *
     * @var PatchExtendUser
     *
     */
    public $userPatch;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isClientBelongToUser;

    /**
     * Optional
     *
     * @var UserClient
     *
     */
    public $queryClient;

    /**
     * Optional
     *
     * @var PagedRoles
     *
     */
    public $clientRoles;

    /**
     * Optional
     *
     * @var PagedUserGroup
     *
     */
    public $userGroup;

    /**
     * Optional
     *
     * @var PagedUserGroup
     *
     */
    public $queryRoleByUserId;

    /**
     * Optional
     *
     * @var ClientInfoAndAccessToken
     *
     */
    public $getClientWhenSdkInit;

    /**
     * Optional
     *
     * @var ClientWebhook
     *
     */
    public $getWebhookDetail;

    /**
     * Optional
     *
     * @var ClientWebhook[]
     *
     */
    public $getAllWebhooks;

    /**
     * Optional
     *
     * @var WebhookLog
     *
     */
    public $getWebhookLogDetail;

    /**
     * Optional
     *
     * @var WebhookLog[]
     *
     */
    public $getWebhookLogs;

    /**
     * Optional
     *
     * @var WebhookSettingOptions
     *
     */
    public $getWebhookSettingOptions;

    /**
     * Optional
     *
     * @var CollaborativeUserPoolList
     *
     */
    public $queryCollaborativeUserPoolByUserId;

    /**
     * Optional
     *
     * @var Collaborators
     *
     */
    public $queryCollaboratorsByUserPoolId;

    /**
     * Optional
     *
     * @var CollaboratorPermissions
     *
     */
    public $queryCollaboratorPermissions;

    /**
     * Optional
     *
     * @var PasswordStrengthSettings
     *
     */
    public $queryPasswordStrengthSettingsByUserPoolId;

    /**
     * Optional
     *
     * @var Collaboration
     *
     */
    public $queryCollaborationByUserPoolIdAndUserId;

    /**
     * Optional
     *
     * @var PermissionList
     *
     */
    public $queryPermissionList;

    /**
     * Optional
     *
     * @var BasicUserInfo
     *
     */
    public $searchUserBasicInfoById;

    /**
     * Optional
     *
     * @var PaaswordFaas
     *
     */
    public $queryPasswordFaasEnabled;

    /**
     * Optional
     *
     * @var LoginTopEmailList[]
     *
     */
    public $emailDomainTopNList;

    /**
     * Optional
     *
     * @var RegisterMethodList[]
     *
     */
    public $registerMethodTopList;

    /**
     * Optional
     *
     * @var SMSCountInfo
     *
     */
    public $querySMSSendCount;

    /**
     * Optional
     *
     * @var Invitation[]
     *
     */
    public $queryInvitation;

    /**
     * Optional
     *
     * @var InvitationState
     *
     */
    public $queryInvitationState;

    /**
     * Optional
     *
     * @var MFA
     *
     */
    public $queryMFA;

    /**
     * Optional
     *
     * @var PagedUserPoolWithMFA
     *
     */
    public $queryAuthorizedUserPool;

    /**
     * Optional
     *
     * @var PagedCustomMFAList
     *
     */
    public $getCustomMFA;

    /**
     * Optional
     *
     * @var ValidateResult
     *
     */
    public $validatePassword;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $getUserLoginAreaStatisticOfClient;

    /**
     * Optional
     *
     * @var UserClient
     *
     */
    public $getUserPoolSettings;

    /**
     * Optional
     *
     * @var AuthAuditRecordsList
     *
     */
    public $queryAuthAuditRecords;

    /**
     * Optional
     *
     * @var UserPoolCommonInfo
     *
     */
    public $queryUserPoolCommonInfo;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isDomainAvaliable;

    /**
     * Optional
     *
     * @var CommonMessage
     *
     */
    public $checkPhoneCode;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $userExist;

    /**
     * Optional
     *
     * @var ADConnctorCommonInfo
     *
     */
    public $adConnectorByProvider;

    /**
     * Optional
     *
     * @var isAdConenctorAlive
     *
     */
    public $isAdConnectorAlive;

    /**
     * Optional
     *
     * @var ADConnector[]
     *
     */
    public $adConnectorList;

    /**
     * Optional
     *
     * @var ADConnectorEnabledProvider[]
     *
     */
    public $providerListByADConnector;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $checkAdConnectorStatus;

    /**
     * Required
     *
     * @var SAMLFieldMappings[]
     *
     */
    public $samlIdPFieldMappings;

    /**
     * Required
     *
     * @var SAMLAvaliableFieldMappings[]
     *
     */
    public $supportedSAMLFieldMappings;

    /**
     * Optional
     *
     * @var RBACRole
     *
     */
    public $rbacRole;

    /**
     * Optional
     *
     * @var PagedRBACRole
     *
     */
    public $rbacRoleList;

    /**
     * Optional
     *
     * @var RBACGroup
     *
     */
    public $rbacGroup;

    /**
     * Optional
     *
     * @var PagedRBACGroup
     *
     */
    public $rbacGroupList;

    /**
     * Optional
     *
     * @var RBACPermission
     *
     */
    public $rbacPermission;

    /**
     * Optional
     *
     * @var PagedRBACPermission
     *
     */
    public $rbacPermissionList;

    /**
     * Required
     *
     * @var UserPermissionList
     *
     */
    public $userPermissionList;

    /**
     * Required
     *
     * @var UserGroupList
     *
     */
    public $userGroupList;

    /**
     * Required
     *
     * @var UserRoleList
     *
     */
    public $userRoleList;

    /**
     * Required
     *
     * @var Org
     *
     */
    public $org;

    /**
     * Required
     *
     * @var PagedOrg
     *
     */
    public $orgs;

    /**
     * Required
     *
     * @var RBACGroup
     *
     */
    public $orgRootNode;

    /**
     * Required
     *
     * @var OrgChildNode[]
     *
     */
    public $orgChildrenNodes;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isRootNodeOfOrg;

    /**
     * Required
     *
     * @var GroupMetadata[]
     *
     */
    public $groupMetadata;

    /**
     * Required
     *
     * @var PagedRBACGroup
     *
     */
    public $searchGroupByMetadata;

    /**
     * Required
     *
     * @var RBACGroup[]
     *
     */
    public $searchOrgNodes;

    /**
     * Optional
     *
     * @var PagedUsers
     *
     */
    public $orgNodeUserList;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isUserInGroup;

    /**
     * Optional
     *
     * @var PagedUsers
     *
     */
    public $searchOrgNodeUser;

    /**
     * Optional
     *
     * @var DingTalkCorp
     *
     */
    public $DingTalkCorp;

    /**
     * Optional
     *
     * @var WechatWorkCorp
     *
     */
    public $wechatWorkCorp;

    /**
     * Required
     *
     * @var Rule
     *
     */
    public $ruleById;

    /**
     * Required
     *
     * @var PagedRules
     *
     */
    public $rules;

    /**
     * Required
     *
     * @var PagedRuleEnvVariable
     *
     */
    public $ruleEnv;

    /**
     * Optional
     *
     * @var OperationLogsList
     *
     */
    public $queryOperationLogs;

    /**
     * Optional
     *
     * @var UserPoolCommonInfo
     *
     */
    public $getUserPoolByDomain;

    /**
     * Required
     *
     * @var InterConnection[]
     *
     */
    public $interConnections;

    /**
     * Required
     *
     * @var UserMetaDataList
     *
     */
    public $userMetadata;
}

class Email
{
    /**
     * Optional
     *
     * @var PopulatedEmailSentList[]
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

class PopulatedEmailSentList
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $subject;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $content;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $sender;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $receivers;

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
     * @var Client
     *
     */
    public $client;
}

class Client
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $createdAt;

    /**
     * Optional
     *
     * @var User
     *
     */
    public $user;
}

class User
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
     * Optional
     *
     * @var bool
     *
     */
    public $emailVerified;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $phone;

    /**
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
    public $browser;

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
     * @var string
     *
     */
    public $registerInClient;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $registerMethod;

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
    public $token;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $tokenExpiredAt;

    /**
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
    public $updatedAt;

    /**
     * Optional
     *
     * @var ThirdPartyIdentity
     *
     */
    public $thirdPartyIdentity;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $oldPassword;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $metadata;
}

class ThirdPartyIdentity
{
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
    public $refreshToken;

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
    public $expiresIn;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $updatedAt;
}

class EmailListPaged
{
    /**
     * Optional
     *
     * @var int
     *
     */
    public $totalCount;

    /**
     * Optional
     *
     * @var EmailSentList[]
     *
     */
    public $list;
}

class EmailSentList
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $subject;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $content;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $sender;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $receivers;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $post;

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
     * @var string[]
     *
     */
    public $rejected;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $isDeleted;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;
}

class EmailProviderList
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $image;

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
     * @var EmailProviderForm[]
     *
     */
    public $fields;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

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
     * @var EmailProviderChildrenList
     *
     */
    public $provider;
}

class EmailProviderForm
{
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
     * @var string
     *
     */
    public $help;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $value;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $options;
}

class EmailProviderChildrenList
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $image;

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
     * @var EmailProviderForm[]
     *
     */
    public $fields;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

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
     * @var EmailProviderChildrenList
     *
     */
    public $provider;
}

class EmailProviderWithClientList
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

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
     * @var EmailProviderWithClientForm[]
     *
     */
    public $fields;

    /**
     * Optional
     *
     * @var EmailProviderWithClient
     *
     */
    public $provider;
}

class EmailProviderWithClientForm
{
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
     * @var string
     *
     */
    public $help;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $value;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $options;
}

class EmailProviderWithClient
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $image;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $description;
}

class EmailTemplateWithClient
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var EmailTemplate
     *
     */
    public $template;

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
    public $sender;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $object;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hasURL;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $URLExpireTime;

    /**
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
    public $status;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $content;
}

class EmailTemplate
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $sender;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $object;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hasURL;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $URLExpireTime;

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
     * @var string
     *
     */
    public $redirectTo;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $content;
}

class OAuthList
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $alias;

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
     * @var string
     *
     */
    public $description;

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
    public $url;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $oAuthUrl;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $wxappLogo;

    /**
     * Optional
     *
     * @var OAuthListFieldsForm[]
     *
     */
    public $fields;

    /**
     * Optional
     *
     * @var ChildrenOAuthList
     *
     */
    public $oauth;
}

class OAuthListFieldsForm
{
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
     * @var string
     *
     */
    public $value;

    /**
     * Optional
     *
     * @var OAuthListFieldsFormRecursion[]
     *
     */
    public $children;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $checked;
}

class OAuthListFieldsFormRecursion
{
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
     * @var string
     *
     */
    public $value;

    /**
     * Optional
     *
     * @var OAuthListFieldsFormRecursion[]
     *
     */
    public $children;
}

class ChildrenOAuthList
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $alias;

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
     * @var string
     *
     */
    public $description;

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
    public $url;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $oAuthUrl;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $wxappLogo;

    /**
     * Optional
     *
     * @var OAuthListFieldsForm[]
     *
     */
    public $fields;

    /**
     * Optional
     *
     * @var ChildrenOAuthList
     *
     */
    public $oauth;
}

class SAMLSPListItem
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $providerName;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $url;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $logo;
}

class WxQRCodeLog
{
    /**
     * Optional
     *
     * @var WxQRCodeLogList[]
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

class WxQRCodeLogList
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $random;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $expiredAt;

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
     * @var bool
     *
     */
    public $success;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $qrcode;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $used;

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
    public $userInfo;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $redirect;

    /**
     * Optional
     *
     * @var ClientInWxQRCodeLogList
     *
     */
    public $client;
}

class ClientInWxQRCodeLogList
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $createdAt;

    /**
     * Optional
     *
     * @var UserInClientInWxQRCodeLogList
     *
     */
    public $user;
}

class UserInClientInWxQRCodeLogList
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $username;
}

class NotBindOAuth
{
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
    public $oAuthUrl;

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
     * @var string
     *
     */
    public $name;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $binded;
}

class OAuthProviderClient
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $domain;

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
    public $redirectUris;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $appSecret;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $clientId;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $grants;

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
    public $homepageURL;

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
    public $when;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $css;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $loginUrl;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $casExpire;
}

class OAuthAppPagedList
{
    /**
     * Optional
     *
     * @var int
     *
     */
    public $totalCount;

    /**
     * Optional
     *
     * @var OAuthProviderClient[]
     *
     */
    public $list;
}

class OIDCProviderClient
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $domain;

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
    public $redirect_uris;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client_secret;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $token_endpoint_auth_method;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $id_token_signed_response_alg;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $id_token_encrypted_response_alg;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $id_token_encrypted_response_enc;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $userinfo_signed_response_alg;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $userinfo_encrypted_response_alg;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $userinfo_encrypted_response_enc;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $request_object_signing_alg;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $request_object_encryption_alg;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $request_object_encryption_enc;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $jwks_uri;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $_jwks_uri;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $custom_jwks;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $jwks;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $_jwks;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $clientId;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $grant_types;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $response_types;

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
    public $homepageURL;

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
    public $when;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $css;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $authorization_code_expire;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $id_token_expire;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $access_token_expire;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $cas_expire;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $loginUrl;

    /**
     * Optional
     *
     * @var OIDCProviderCustomStyles
     *
     */
    public $customStyles;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isForTeamory;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $confirmAuthorization;
}

class OIDCProviderCustomStyles
{
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
    public $hideQRCode;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hideUP;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hideUsername;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hideRegister;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hidePhone;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hideSocial;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hideClose;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hidePhonePassword;

    /**
     * Optional
     *
     * @var OIDCProviderCustomStylesPlaceholder
     *
     */
    public $placeholder;

    /**
     * Optional
     *
     * @var OIDCProviderCustomStylesQrcodeScanning
     *
     */
    public $qrcodeScanning;

    /**
     * Optional
     *
     * @var OidcProviderDefaultLoginMethod
     *
     */
    public $defaultLoginMethod;
}

class OIDCProviderCustomStylesPlaceholder
{
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
    public $email;

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
     * @var string
     *
     */
    public $confirmPassword;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $verfiyCode;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $newPassword;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $phone;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $phoneCode;
}

class OIDCProviderCustomStylesQrcodeScanning
{
    /**
     * Optional
     *
     * @var bool
     *
     */
    public $redirect;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $interval;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $tips;
}

class OIDCProviderDefaultLoginMethod
{
    const PHONE = 'PHONE';
    const PASSWORD = 'PASSWORD';
    const QRCODE = 'QRCODE';
}

class OIDCAppPagedList
{
    /**
     * Optional
     *
     * @var int
     *
     */
    public $totalCount;

    /**
     * Optional
     *
     * @var OIDCProviderClient[]
     *
     */
    public $list;
}

class ProviderGeneralInfo
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $name;

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
    public $clientId;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $css;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $redirect_uris;
}

class SAMLServiceProviderClient
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $domain;

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
     * @var string
     *
     */
    public $appSecret;

    /**
     * Optional
     *
     * @var SAMLDefaultIdentityProviderSettings
     *
     */
    public $defaultIdPMap;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $defaultIdPMapId;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $appId;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $clientId;

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
     * @var bool
     *
     */
    public $isDeleted;

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
    public $when;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $SPMetadata;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $IdPMetadata;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $IdPEntityID;

    /**
     * Optional
     *
     * @var AssertionConsumeService[]
     *
     */
    public $assertionConsumeService;

    /**
     * Optional
     *
     * @var AssertionMap
     *
     */
    public $mappings;

    /**
     * Required
     *
     * @var string
     *
     */
    public $redirectUrl;

    /**
     * Required
     *
     * @var string
     *
     */
    public $loginUrl;

    /**
     * Required
     *
     * @var string
     *
     */
    public $logoutUrl;

    /**
     * Required
     *
     * @var string
     *
     */
    public $nameId;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $enableSignRes;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $resSignPublicKey;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hasResEncrypted;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $resEncryptAlgorithm;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $resAbstractAlgorithm;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $resDecryptPrivateKey;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $resDecryptPrivateKeyPass;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $resEncryptPublicKey;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $enableSignReq;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $reqSignAlgorithm;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $reqAbstractAlgorithm;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $reqSignPrivateKey;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $reqSignPrivateKeyPass;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $reqSignPublicKey;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $SPUrl;
}

class SAMLDefaultIdentityProviderSettings
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $image;

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
     * @var AssertionMap
     *
     */
    public $mappings;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isDeleted;
}

class AssertionMap
{
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
    public $photo;

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
    public $providerName;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $email;
}

class AssertionConsumeService
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $binding;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $url;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isDefault;
}

class SAMLIdentityProviderClient
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $domain;

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
     * @var string
     *
     */
    public $appSecret;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $appId;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $clientId;

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
     * @var bool
     *
     */
    public $isDeleted;

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
    public $when;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $SPMetadata;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $attributeNameFormat;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $customAttributes;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $emailDomainTransformation;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $authnContextClassRef;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $IdPMetadata;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $assertionConsumerUrl;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $bindings;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $nameIds;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $attributes;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $enableSignRes;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $resSignAlgorithm;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $resAbstractAlgorithm;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $resSignPublicKey;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $resSignPrivateKey;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $resSignPrivateKeyPass;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $enableSignReq;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $reqSignPublicKey;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $enableEncryptRes;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $resEncryptPublicKey;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $css;
}

class SAMLDefaultIdentityProviderSettingsList
{
    /**
     * Optional
     *
     * @var SAMLDefaultIdentityProviderSettings[]
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

class SAMLServiceProviderAppPagedList
{
    /**
     * Optional
     *
     * @var int
     *
     */
    public $totalCount;

    /**
     * Optional
     *
     * @var SAMLServiceProviderClient[]
     *
     */
    public $list;
}

class SAMLIdentityProviderAppPagedList
{
    /**
     * Optional
     *
     * @var int
     *
     */
    public $totalCount;

    /**
     * Optional
     *
     * @var SAMLIdentityProviderClient[]
     *
     */
    public $list;
}

class LDAPServerList
{
    /**
     * Optional
     *
     * @var LDAPSingleServer[]
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

class LDAPSingleServer
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $clientId;

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
    public $ldapLink;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $baseDN;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $searchStandard;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $emailPostfix;

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
    public $password;

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
     * @var bool
     *
     */
    public $enabled;

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
    public $createdAt;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $updatedAt;
}

class LDAPServerTesterType
{
    /**
     * Optional
     *
     * @var bool
     *
     */
    public $result;
}

class LDAPUserTesterType
{
    /**
     * Optional
     *
     * @var bool
     *
     */
    public $result;
}

class ClientHasLDAPConfigs
{
    /**
     * Optional
     *
     * @var bool
     *
     */
    public $result;
}

class UserAuthorizedAppPagedList
{
    /**
     * Optional
     *
     * @var int
     *
     */
    public $totalCount;

    /**
     * Optional
     *
     * @var OAuthProviderClient[]
     *
     */
    public $OAuthApps;

    /**
     * Optional
     *
     * @var OIDCProviderClient[]
     *
     */
    public $OIDCApps;
}

class IsAppAuthorizedByUser
{
    /**
     * Optional
     *
     * @var bool
     *
     */
    public $authorized;
}

class IsReservedDomain
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $domainValue;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isReserved;
}

class PricingList
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
     * @var int
     *
     */
    public $startNumber;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $freeNumber;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $startPrice;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $maxNumber;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $d;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $features;
}

class PagedOrders
{
    /**
     * Optional
     *
     * @var OrderList[]
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

class OrderList
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $timeOfPurchase;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $flowNumber;

    /**
     * Optional
     *
     * @var float
     *
     */
    public $price;

    /**
     * Optional
     *
     * @var OrderPricing
     *
     */
    public $pricing;

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
     * @var bool
     *
     */
    public $completed;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $payMethod;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $endAt;

    /**
     * Optional
     *
     * @var OrderClient
     *
     */
    public $clientInfo;
}

class OrderPricing
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
     * @var int
     *
     */
    public $startNumber;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $freeNumber;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $startPrice;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $maxNumber;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $d;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $features;
}

class OrderClient
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $secret;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $descriptions;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $jwtExpired;

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
     * @var bool
     *
     */
    public $isDeleted;
}

class UserPricingType
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isFree;

    /**
     * Optional
     *
     * @var UserPricingNotFreeType
     *
     */
    public $pricing;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $freeNumber;
}

class UserPricingNotFreeType
{
    /**
     * Optional
     *
     * @var int
     *
     */
    public $number;
}

class PagedUsers
{
    /**
     * Optional
     *
     * @var ExtendUser[]
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

class ExtendUser
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
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
     * Optional
     *
     * @var bool
     *
     */
    public $emailVerified;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $phone;

    /**
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
    public $password;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $registerInClient;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $registerMethod;

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
    public $token;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $tokenExpiredAt;

    /**
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
    public $updatedAt;

    /**
     * Optional
     *
     * @var Group
     *
     */
    public $group;

    /**
     * Optional
     *
     * @var UserClientType
     *
     */
    public $clientType;

    /**
     * Optional
     *
     * @var UserLocation[]
     *
     */
    public $userLocation;

    /**
     * Optional
     *
     * @var PagedUserLoginHistory
     *
     */
    public $userLoginHistory;

    /**
     * Optional
     *
     * @var SystemApplicationType
     *
     */
    public $systemApplicationType;

    /**
     * Optional
     *
     * @var ThirdPartyIdentity
     *
     */
    public $thirdPartyIdentity;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $customData;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $metadata;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $salt;
}

class Group
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $descriptions;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $permissions;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $createdAt;
}

class UserClientType
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
     * @var string
     *
     */
    public $example;
}

class UserLocation
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var User
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var UserClient
     *
     */
    public $userPool;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $when;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $where;
}

class UserClient
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var User
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var IamType
     *
     */
    public $iamType;

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
     * @var UserClientType
     *
     */
    public $clientType;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $userLimit;

    /**
     * Optional
     *
     * @var UserClientType[]
     *
     */
    public $userPoolTypes;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $usersCount;

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
    public $showWXMPQRCode;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $useMiniLogin;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $useSelfWxapp;

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
    public $secret;

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
     * @var string
     *
     */
    public $descriptions;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $jwtExpired;

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
     * @var bool
     *
     */
    public $isDeleted;

    /**
     * Optional
     *
     * @var FrequentRegisterCheckConfig
     *
     */
    public $frequentRegisterCheck;

    /**
     * Optional
     *
     * @var LoginFailCheckConfig
     *
     */
    public $loginFailCheck;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $enableEmail;

    /**
     * Optional
     *
     * @var ChangePhoneStrategy
     *
     */
    public $changePhoneStrategy;

    /**
     * Optional
     *
     * @var ChangeEmailStrategy
     *
     */
    public $changeEmailStrategy;

    /**
     * Optional
     *
     * @var QrcodeLoginStrategy
     *
     */
    public $qrcodeLoginStrategy;

    /**
     * Optional
     *
     * @var App2WxappLoginStrategy
     *
     */
    public $app2WxappLoginStrategy;
}

class IAMType
{
    const EIAM = 'EIAM';
    const CIAM = 'CIAM';
}

class FrequentRegisterCheckConfig
{
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
    public $enable;
}

class LoginFailCheckConfig
{
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
    public $enable;
}

class ChangePhoneStrategy
{
    /**
     * Optional
     *
     * @var bool
     *
     */
    public $verifyOldPhone;
}

class ChangeEmailStrategy
{
    /**
     * Optional
     *
     * @var bool
     *
     */
    public $verifyOldEmail;
}

class QrcodeLoginStrategy
{
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

class App2WxappLoginStrategy
{
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

class PagedUserLoginHistory
{
    /**
     * Optional
     *
     * @var UserLoginHistory[]
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

class UserLoginHistory
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var User
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $when;

    /**
     * Optional
     *
     * @var UserClient
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $success;

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
    public $result;

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
}

class SystemApplicationType
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $descriptions;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $price;
}

class UserIds
{
    /**
     * Optional
     *
     * @var string[]
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

class UserAnalytics
{
    /**
     * Optional
     *
     * @var UserAnalyticsItem
     *
     */
    public $usersAddedToday;

    /**
     * Optional
     *
     * @var UserAnalyticsItem
     *
     */
    public $usersAddedLastWeek;

    /**
     * Optional
     *
     * @var UserAnalyticsItem
     *
     */
    public $usersLoginLastWeek;

    /**
     * Optional
     *
     * @var UserAnalyticsItem
     *
     */
    public $totalUsers;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $allUsers;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $totalApps;
}

class UserAnalyticsItem
{
    /**
     * Optional
     *
     * @var User[]
     *
     */
    public $list;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $length;
}

class PagedUserClients
{
    /**
     * Optional
     *
     * @var UserClient[]
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

class UserLoginCount
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $count;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $month;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isError;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $totalNumber;
}

class JwtDecodedData
{
    /**
     * Optional
     *
     * @var JwtPayloadData
     *
     */
    public $data;

    /**
     * Optional
     *
     * @var CommonMessage
     *
     */
    public $status;

    /**
     * Optional
     *
     * @var string
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

class JwtPayloadData
{
    /**
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
    public $id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $clientId;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $unionid;
}

class CommonMessage
{
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
     * @var int
     *
     */
    public $code;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $status;
}

class JWTDecodedDataCheckLogin
{
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
     * @var int
     *
     */
    public $code;

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
     * @var TokenWholeInfo
     *
     */
    public $token;
}

class TokenWholeInfo
{
    /**
     * Optional
     *
     * @var TokenMoreInfo
     *
     */
    public $data;

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

class TokenMoreInfo
{
    /**
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
    public $id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $clientId;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $unionid;
}

class AppSecretByClientId
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $secret;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $clientId;
}

class LoginHotDotPicData
{
    /**
     * Optional
     *
     * @var string[][]
     *
     */
    public $list;
}

class RegisterEveryDayCount
{
    /**
     * Optional
     *
     * @var string[][]
     *
     */
    public $list;
}

class Statistic
{
    /**
     * Optional
     *
     * @var StatisticInfo[]
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

class StatisticInfo
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $email;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $loginsCount;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $appsCount;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $OAuthCount;
}

class PagedUserClientList
{
    /**
     * Optional
     *
     * @var PagedUserClientListItem[]
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

class PagedUserClientListItem
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $createdAt;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $usersCount;

    /**
     * Optional
     *
     * @var UserBrief
     *
     */
    public $user;
}

class UserBrief
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $username;
}

class UsersInGroup
{
    /**
     * Optional
     *
     * @var UsersInGroupListItem[]
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

class UsersInGroupListItem
{
    /**
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
    public $username;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $upgrade;
}

class QpsByTime
{
    /**
     * Optional
     *
     * @var float
     *
     */
    public $qps;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $time;
}

class GeographicalDistributionList
{
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
     * @var float
     *
     */
    public $size;

    /**
     * Optional
     *
     * @var float[]
     *
     */
    public $point;
}

class DayServiceCallListOfAllServices
{
    /**
     * Optional
     *
     * @var DayServiceCallList[]
     *
     */
    public $userService;

    /**
     * Optional
     *
     * @var DayServiceCallList[]
     *
     */
    public $emailService;

    /**
     * Optional
     *
     * @var DayServiceCallList[]
     *
     */
    public $oAuthService;

    /**
     * Optional
     *
     * @var DayServiceCallList[]
     *
     */
    public $payService;
}

class DayServiceCallList
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $day;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $count;
}

class DayUserGrowth
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $day;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $count;
}

class PagedRequestList
{
    /**
     * Optional
     *
     * @var int
     *
     */
    public $totalCount;

    /**
     * Optional
     *
     * @var Request[]
     *
     */
    public $list;
}

class Request
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $when;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $where;

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
     * @var int
     *
     */
    public $size;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $responseTime;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $service;
}

class UserOAuthBind
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

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
    public $unionid;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $userInfo;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $createdAt;
}

class PatchExtendUser
{
    /**
     * Optional
     *
     * @var ExtendUser[]
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

class PermissionDescriptorsListInputType
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $permissionId;

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
     * @var int
     *
     */
    public $operationAllow;
}

class PagedRoles
{
    /**
     * Optional
     *
     * @var Group[]
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

class PagedUserGroup
{
    /**
     * Optional
     *
     * @var UserGroup[]
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

class UserGroup
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var User
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var UserClient
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var Group
     *
     */
    public $group;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $createdAt;
}

class ClientInfoAndAccessToken
{
    /**
     * Optional
     *
     * @var UserClient
     *
     */
    public $clientInfo;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $accessToken;
}

class ClientWebhook
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Required
     *
     * @var string
     *
     */
    public $client;

    /**
     * Required
     *
     * @var WebhookEvent[]
     *
     */
    public $events;

    /**
     * Required
     *
     * @var string
     *
     */
    public $url;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isLastTimeSuccess;

    /**
     * Required
     *
     * @var string
     *
     */
    public $contentType;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $secret;

    /**
     * Required
     *
     * @var bool
     *
     */
    public $enable;
}

class WebhookEvent
{
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
    public $label;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $description;
}

class WebhookLog
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Required
     *
     * @var string
     *
     */
    public $webhook;

    /**
     * Required
     *
     * @var string
     *
     */
    public $client;

    /**
     * Required
     *
     * @var string
     *
     */
    public $event;

    /**
     * Optional
     *
     * @var WebhookRequestType
     *
     */
    public $request;

    /**
     * Optional
     *
     * @var WebhookResponseType
     *
     */
    public $response;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $errorMessage;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $when;
}

class WebhookRequestType
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $headers;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $payload;
}

class WebhookResponseType
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $headers;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $body;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $statusCode;
}

class WebhookSettingOptions
{
    /**
     * Required
     *
     * @var WebhookEvent[]
     *
     */
    public $webhookEvents;

    /**
     * Required
     *
     * @var WebhookContentType[]
     *
     */
    public $contentTypes;
}

class WebhookContentType
{
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
    public $label;
}

class CollaborativeUserPoolList
{
    /**
     * Optional
     *
     * @var Collaboration[]
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

class Collaboration
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
     * @var User
     *
     */
    public $owner;

    /**
     * Optional
     *
     * @var User
     *
     */
    public $collaborator;

    /**
     * Optional
     *
     * @var UserClient
     *
     */
    public $userPool;

    /**
     * Optional
     *
     * @var PermissionDescriptors[]
     *
     */
    public $permissionDescriptors;
}

class PermissionDescriptors
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $permissionId;

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
     * @var int
     *
     */
    public $operationAllow;
}

class Collaborators
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $collaborationId;

    /**
     * Optional
     *
     * @var Collaboration[]
     *
     */
    public $list;
}

class CollaboratorPermissions
{
    /**
     * Optional
     *
     * @var User
     *
     */
    public $collaborator;

    /**
     * Optional
     *
     * @var PermissionDescriptors[]
     *
     */
    public $list;
}

class PasswordStrengthSettings
{
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
     * @var int
     *
     */
    public $pwdStrength;
}

class PermissionList
{
    /**
     * Optional
     *
     * @var Permission[]
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

class Permission
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $affect;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $description;
}

class BasicUserInfo
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $photo;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $email;
}

class PaaswordFaas
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $encryptUrl;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $decryptUrl;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $logs;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $enable;

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
}

class LoginTopEmailList
{
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
     * @var int
     *
     */
    public $count;
}

class RegisterMethodList
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $method;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $count;
}

class SMSCountInfo
{
    /**
     * Optional
     *
     * @var int
     *
     */
    public $count;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $limitCount;
}

class Invitation
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $phone;

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
    public $createdAt;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $updatedAt;
}

class InvitationState
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $enablePhone;

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
}

class MFA
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $userPoolId;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $enable;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $shareKey;
}

class PagedUserPoolWithMFA
{
    /**
     * Optional
     *
     * @var UserPoolWithMFA[]
     *
     */
    public $list;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $total;
}

class UserPoolWithMFA
{
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
     * @var UserClient
     *
     */
    public $userPool;

    /**
     * Optional
     *
     * @var MFA
     *
     */
    public $MFA;
}

class PagedCustomMFAList
{
    /**
     * Optional
     *
     * @var CustomMFA[]
     *
     */
    public $list;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $total;
}

class CustomMFA
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $userIdInMiniLogin;

    /**
     * Optional
     *
     * @var UserClient
     *
     */
    public $userPoolId;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $remark;

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
    public $secret;
}

class ValidateResult
{
    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isValid;
}

class AuthAuditRecordsList
{
    /**
     * Optional
     *
     * @var AuthAuditRecord[]
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

class AuthAuditRecord
{
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
    public $appType;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $appId;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $event;

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
    public $createdAt;
}

class UserPoolCommonInfo
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Required
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
    public $domain;

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
     * @var IamType
     *
     */
    public $iamType;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $userLimit;

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
     * @var ChangePhoneStrategy
     *
     */
    public $changePhoneStrategy;

    /**
     * Optional
     *
     * @var ChangeEmailStrategy
     *
     */
    public $changeEmailStrategy;

    /**
     * Optional
     *
     * @var QrcodeLoginStrategy
     *
     */
    public $qrcodeLoginStrategy;

    /**
     * Optional
     *
     * @var App2WxappLoginStrategy
     *
     */
    public $app2WxappLoginStrategy;
}

class providerType
{
    const OIDC = 'OIDC';
    const OAuth = 'OAuth';
}

class ADConnctorCommonInfo
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
     * @var bool
     *
     */
    public $status;
}

class isAdConenctorAlive
{
    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isAlive;
}

class ADConnector
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $secret;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $salt;

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
    public $userPoolId;

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
     * @var string
     *
     */
    public $createdAt;
}

class ADConnectorEnabledProvider
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $providerType;

    /**
     * Required
     *
     * @var string
     *
     */
    public $providerId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $userPoolId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $adConnectorId;
}

class SAMLFieldMappings
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $sourceExpression;

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
    public $type;

    /**
     * Required
     *
     * @var string
     *
     */
    public $targetField;
}

class SAMLAvaliableFieldMappings
{
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
    public $type;

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
     * @var bool
     *
     */
    public $editable;
}

class RBACRole
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Required
     *
     * @var string
     *
     */
    public $userPoolId;

    /**
     * Required
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
    public $createdAt;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $updatedAt;

    /**
     * Optional
     *
     * @var PagedRBACPermission
     *
     */
    public $permissions;

    /**
     * Optional
     *
     * @var PagedUsers
     *
     */
    public $users;
}

class PagedRBACPermission
{
    /**
     * Optional
     *
     * @var int
     *
     */
    public $totalCount;

    /**
     * Required
     *
     * @var RBACPermission[]
     *
     */
    public $list;
}

class RBACPermission
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

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
    public $userPoolId;

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
     * Optional
     *
     * @var string
     *
     */
    public $description;
}

class SortByEnum
{
    const CREATEDAT_DESC = 'CREATEDAT_DESC';
    const CREATEDAT_ASC = 'CREATEDAT_ASC';
    const UPDATEDAT_DESC = 'UPDATEDAT_DESC';
    const UPDATEDAT_ASC = 'UPDATEDAT_ASC';
}

class PagedRBACRole
{
    /**
     * Optional
     *
     * @var int
     *
     */
    public $totalCount;

    /**
     * Required
     *
     * @var RBACRole[]
     *
     */
    public $list;
}

class RBACGroup
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Required
     *
     * @var string
     *
     */
    public $userPoolId;

    /**
     * Required
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
    public $createdAt;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $updatedAt;

    /**
     * Optional
     *
     * @var PagedRBACRole
     *
     */
    public $roles;

    /**
     * Optional
     *
     * @var PagedRBACPermission
     *
     */
    public $permissions;

    /**
     * Optional
     *
     * @var PagedUsers
     *
     */
    public $users;
}

class PagedRBACGroup
{
    /**
     * Optional
     *
     * @var int
     *
     */
    public $totalCount;

    /**
     * Required
     *
     * @var RBACGroup[]
     *
     */
    public $list;
}

class UserPermissionList
{
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
     * @var RBACPermission[]
     *
     */
    public $list;

    /**
     * Required
     *
     * @var string[]
     *
     */
    public $rawList;
}

class UserGroupList
{
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
     * @var RBACGroup[]
     *
     */
    public $list;

    /**
     * Required
     *
     * @var string[]
     *
     */
    public $rawList;
}

class UserRoleList
{
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
     * @var RBACRole[]
     *
     */
    public $list;

    /**
     * Required
     *
     * @var string[]
     *
     */
    public $rawList;
}

class Org
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $logo;

    /**
     * Required
     *
     * @var OrgNode[]
     *
     */
    public $nodes;
}

class OrgNode
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Required
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
     * @var string[]
     *
     */
    public $children;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $root;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $depth;
}

class PagedOrg
{
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

class OrgChildrenNodesInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $groupId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $orgId;
}

class OrgChildNode
{
    /**
     * Required
     *
     * @var RBACGroup
     *
     */
    public $group;

    /**
     * Required
     *
     * @var int
     *
     */
    public $depth;
}

class IsRootNodeOfOrgInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $groupId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $orgId;
}

class GroupMetadata
{
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

class KeyValuePair
{
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

class DingTalkCorp
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $corpId;

    /**
     * Required
     *
     * @var bool
     *
     */
    public $twoWaySynchronizationOn;

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
     * Optional
     *
     * @var string
     *
     */
    public $AESKey;

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
     * @var string
     *
     */
    public $orgId;
}

class WechatWorkCorp
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $corpId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $corpName;

    /**
     * Required
     *
     * @var string
     *
     */
    public $addressBookSyncHelperSecret;

    /**
     * Required
     *
     * @var string
     *
     */
    public $addressBookSyncHelperToken;

    /**
     * Required
     *
     * @var string
     *
     */
    public $addressBookSyncHelperEncodingAESKey;

    /**
     * Required
     *
     * @var bool
     *
     */
    public $twoWaySynchronizationOn;

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
     * Optional
     *
     * @var string
     *
     */
    public $orgId;
}

class Rule
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Required
     *
     * @var string
     *
     */
    public $userPoolId;

    /**
     * Required
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
     * Required
     *
     * @var RuleTypes
     *
     */
    public $type;

    /**
     * Required
     *
     * @var bool
     *
     */
    public $enabled;

    /**
     * Required
     *
     * @var string
     *
     */
    public $faasUrl;

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
     * @var int
     *
     */
    public $order;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $async;

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
}

class RuleTypes
{
    const PRE_REGISTER = 'PRE_REGISTER';
    const POST_REGISTER = 'POST_REGISTER';
    const POST_AUTHENTICATION = 'POST_AUTHENTICATION';
    const PRE_OIDCTOKENISSUED = 'PRE_OIDCTOKENISSUED';
}

class PagedRules
{
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
     * @var Rule[]
     *
     */
    public $list;
}

class PagedRuleEnvVariable
{
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
     * @var RuleEnvVariable[]
     *
     */
    public $list;
}

class RuleEnvVariable
{
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

class OperationLogsList
{
    /**
     * Optional
     *
     * @var int
     *
     */
    public $totalCount;

    /**
     * Optional
     *
     * @var OperationLog[]
     *
     */
    public $list;
}

class OperationLog
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $operatorId;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $operatorName;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $operatorAvatar;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isAdmin;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isCollaborator;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isOwner;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $operationType;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $updatedFields;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $removedFields;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $operateAt;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $fullDocument;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $coll;
}

class InterConnection
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $sourceUserPoolId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $sourceUserId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $targetUserPoolId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $targetUserId;

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
     * @var string
     *
     */
    public $expiresdAt;
}

class UserMetaDataList
{
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
     * @var UserMetaData[]
     *
     */
    public $list;
}

class UserMetaData
{
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

class Mutation
{
    /**
     * Optional
     *
     * @var EmailSentList
     *
     */
    public $SendEmail;

    /**
     * Optional
     *
     * @var EmailProviderList
     *
     */
    public $AddEmailProvider;

    /**
     * Optional
     *
     * @var EmailProviderList[]
     *
     */
    public $RemoveEmailProvider;

    /**
     * Optional
     *
     * @var EmailProviderList
     *
     */
    public $UpdateEmailProvider;

    /**
     * Optional
     *
     * @var EmailProviderWithClientList
     *
     */
    public $SaveEmailProviderWithClient;

    /**
     * Optional
     *
     * @var EmailProviderWithClientList
     *
     */
    public $UpdateEmailTemplateWithClient;

    /**
     * Optional
     *
     * @var EmailSentList
     *
     */
    public $SendEmailByType;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $UseDefaultEmailProvider;

    /**
     * Optional
     *
     * @var EmailTemplate
     *
     */
    public $UpdateEmailTemplate;

    /**
     * Optional
     *
     * @var OAuthList
     *
     */
    public $AddOAuthList;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $RemoveOAuthList;

    /**
     * Optional
     *
     * @var OAuthProviderClient
     *
     */
    public $RemoveOAuthProvider;

    /**
     * Optional
     *
     * @var OAuthList
     *
     */
    public $UpdateOAuthList;

    /**
     * Optional
     *
     * @var OAuthList
     *
     */
    public $UpdateApplicationOAuth;

    /**
     * Optional
     *
     * @var OAuthList
     *
     */
    public $SetApplicationOAuthEnableOrDisable;

    /**
     * Optional
     *
     * @var OAuthProviderClient
     *
     */
    public $CreateOAuthProvider;

    /**
     * Optional
     *
     * @var OAuthProviderClient
     *
     */
    public $UpdateOAuthProvider;

    /**
     * Optional
     *
     * @var OIDCProviderClient
     *
     */
    public $CreateOIDCApp;

    /**
     * Optional
     *
     * @var OIDCProviderClient
     *
     */
    public $UpdateOIDCApp;

    /**
     * Optional
     *
     * @var OIDCProviderClient
     *
     */
    public $RemoveOIDCApp;

    /**
     * Optional
     *
     * @var SAMLServiceProviderClient
     *
     */
    public $CreateSAMLServiceProvider;

    /**
     * Optional
     *
     * @var SAMLServiceProviderClient
     *
     */
    public $UpdateSAMLServiceProvider;

    /**
     * Optional
     *
     * @var SAMLServiceProviderClient
     *
     */
    public $RemoveSAMLServiceProvider;

    /**
     * Optional
     *
     * @var SAMLServiceProviderClient
     *
     */
    public $EnableSAMLServiceProvider;

    /**
     * Optional
     *
     * @var SAMLIdentityProviderClient
     *
     */
    public $CreateSAMLIdentityProvider;

    /**
     * Optional
     *
     * @var SAMLIdentityProviderClient
     *
     */
    public $UpdateSAMLIdentityProvider;

    /**
     * Optional
     *
     * @var SAMLIdentityProviderClient
     *
     */
    public $RemoveSAMLIdentityProvider;

    /**
     * Optional
     *
     * @var SAMLIdentityProviderClient
     *
     */
    public $EnableSAMLIdentityProvider;

    /**
     * Optional
     *
     * @var SAMLDefaultIdentityProviderSettings
     *
     */
    public $CreateDefaultSAMLIdentityProviderSettings;

    /**
     * Optional
     *
     * @var LDAPSingleServer
     *
     */
    public $AddLDAPServer;

    /**
     * Optional
     *
     * @var LDAPSingleServer
     *
     */
    public $UpdateLDAPServer;

    /**
     * Optional
     *
     * @var LDAPSingleServer
     *
     */
    public $RemoveLDAPServer;

    /**
     * Optional
     *
     * @var User
     *
     */
    public $LoginByLDAP;

    /**
     * Optional
     *
     * @var OAuthList
     *
     */
    public $ClearAvatarSrc;

    /**
     * Optional
     *
     * @var UserAuthorizedApp
     *
     */
    public $RevokeUserAuthorizedApp;

    /**
     * Optional
     *
     * @var PricingList
     *
     */
    public $UpdateSystemPricing;

    /**
     * Optional
     *
     * @var PricingList
     *
     */
    public $AddSystemPricing;

    /**
     * Optional
     *
     * @var OrderSuccess
     *
     */
    public $order;

    /**
     * Optional
     *
     * @var OrderSuccess
     *
     */
    public $ContinuePay;

    /**
     * Optional
     *
     * @var OrderSuccess
     *
     */
    public $IncClientFlowNumber;

    /**
     * Optional
     *
     * @var ExtendUser
     *
     */
    public $register;

    /**
     * Optional
     *
     * @var ExtendUser
     *
     */
    public $createUser;

    /**
     * Optional
     *
     * @var ExtendUser
     *
     */
    public $login;

    /**
     * Optional
     *
     * @var User
     *
     */
    public $updateUser;

    /**
     * Optional
     *
     * @var User[]
     *
     */
    public $removeUsers;

    /**
     * Optional
     *
     * @var UserClient
     *
     */
    public $newClient;

    /**
     * Optional
     *
     * @var UserClient[]
     *
     */
    public $removeUserClients;

    /**
     * Optional
     *
     * @var UserClient
     *
     */
    public $updateUserClient;

    /**
     * Optional
     *
     * @var ExtendUser
     *
     */
    public $changePassword;

    /**
     * Optional
     *
     * @var CommonMessage
     *
     */
    public $sendResetPasswordEmail;

    /**
     * Optional
     *
     * @var CommonMessage
     *
     */
    public $verifyResetPasswordVerifyCode;

    /**
     * Optional
     *
     * @var CommonMessage
     *
     */
    public $sendVerifyEmail;

    /**
     * Optional
     *
     * @var InvitationCode
     *
     */
    public $generateInvitationCode;

    /**
     * Optional
     *
     * @var UserClient
     *
     */
    public $refreshAppSecret;

    /**
     * Optional
     *
     * @var UsersInGroupListItem
     *
     */
    public $updateSuperAdminUser;

    /**
     * Optional
     *
     * @var UsersInGroupListItem
     *
     */
    public $addSuperAdminUser;

    /**
     * Optional
     *
     * @var UsersInGroupListItem
     *
     */
    public $removeSuperAdminUser;

    /**
     * Optional
     *
     * @var CommonMessage
     *
     */
    public $recordRequest;

    /**
     * Optional
     *
     * @var UserOAuthBind
     *
     */
    public $bindOtherOAuth;

    /**
     * Optional
     *
     * @var UserOAuthBind
     *
     */
    public $unbindOtherOAuth;

    /**
     * Optional
     *
     * @var User
     *
     */
    public $unbindEmail;

    /**
     * Optional
     *
     * @var ExtendUser
     *
     */
    public $oauthPasswordLogin;

    /**
     * Optional
     *
     * @var Group
     *
     */
    public $createRole;

    /**
     * Optional
     *
     * @var Group
     *
     */
    public $updateRole;

    /**
     * Optional
     *
     * @var Group
     *
     */
    public $updatePermissions;

    /**
     * Optional
     *
     * @var PagedUserGroup
     *
     */
    public $assignUserToRole;

    /**
     * Optional
     *
     * @var UserGroup
     *
     */
    public $removeUserFromGroup;

    /**
     * Optional
     *
     * @var ClientWebhook
     *
     */
    public $addClientWebhook;

    /**
     * Optional
     *
     * @var ClientWebhook
     *
     */
    public $updateClientWebhook;

    /**
     * Optional
     *
     * @var ClientWebhook
     *
     */
    public $deleteClientWebhook;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $SendWebhookTest;

    /**
     * Optional
     *
     * @var RefreshToken
     *
     */
    public $refreshToken;

    /**
     * Optional
     *
     * @var Collaboration
     *
     */
    public $addCollaborator;

    /**
     * Optional
     *
     * @var Collaboration
     *
     */
    public $removeCollaborator;

    /**
     * Optional
     *
     * @var Collaboration
     *
     */
    public $updateCollaborator;

    /**
     * Optional
     *
     * @var Permission
     *
     */
    public $addPermission;

    /**
     * Optional
     *
     * @var PasswordStrengthSettings
     *
     */
    public $updatePasswordStrengthSettingsByUserPoolId;

    /**
     * Optional
     *
     * @var PagedUsers
     *
     */
    public $resetUserPoolFromWechat;

    /**
     * Optional
     *
     * @var EncryptPassword
     *
     */
    public $encryptPassword;

    /**
     * Optional
     *
     * @var PaaswordFaas
     *
     */
    public $enablePasswordFaas;

    /**
     * Optional
     *
     * @var Invitation
     *
     */
    public $addToInvitation;

    /**
     * Optional
     *
     * @var Invitation
     *
     */
    public $removeFromInvitation;

    /**
     * Optional
     *
     * @var InvitationState
     *
     */
    public $setInvitationState;

    /**
     * Optional
     *
     * @var MFA
     *
     */
    public $changeMFA;

    /**
     * Optional
     *
     * @var CustomMFA
     *
     */
    public $createCustomMFA;

    /**
     * Optional
     *
     * @var CustomMFA
     *
     */
    public $removeCustomMFA;

    /**
     * Optional
     *
     * @var CommonMessage
     *
     */
    public $recordAuthAudit;

    /**
     * Required
     *
     * @var RefreshAccessTokenData
     *
     */
    public $refreshAccessToken;

    /**
     * Required
     *
     * @var User
     *
     */
    public $passwordLessForceLogin;

    /**
     * Required
     *
     * @var User
     *
     */
    public $createUserWithoutAuthentication;

    /**
     * Optional
     *
     * @var RefreshThirdPartyIdentityResult
     *
     */
    public $refreshThirdPartyToken;

    /**
     * Optional
     *
     * @var OidcPasswordModeUserInfo
     *
     */
    public $signIn;

    /**
     * Optional
     *
     * @var RefreshedSignInToken
     *
     */
    public $refreshSignInToken;

    /**
     * Optional
     *
     * @var ADConnector
     *
     */
    public $createAdConnector;

    /**
     * Optional
     *
     * @var ADConnector
     *
     */
    public $updateAdConnector;

    /**
     * Optional
     *
     * @var ADConnector
     *
     */
    public $refreshAdConnectorSecret;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $removeAdConnector;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $enableAdConnector;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $disableAdConnector;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $enableAdConnectorForProvider;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $disableAdConnectorForProvider;

    /**
     * Optional
     *
     * @var User
     *
     */
    public $loginByAd;

    /**
     * Required
     *
     * @var SAMLFieldMappings
     *
     */
    public $setSAMLIdPFieldMapping;

    /**
     * Optional
     *
     * @var CommonMessage
     *
     */
    public $removeSAMLIdpFieldMapping;

    /**
     * Optional
     *
     * @var RBACPermission
     *
     */
    public $createRBACPermission;

    /**
     * Optional
     *
     * @var RBACPermission
     *
     */
    public $updateRBACPermission;

    /**
     * Required
     *
     * @var CommonMessage
     *
     */
    public $deleteRBACPermission;

    /**
     * Required
     *
     * @var CommonMessage
     *
     */
    public $deleteRBACPermissionBatch;

    /**
     * Optional
     *
     * @var RBACRole
     *
     */
    public $createRBACRole;

    /**
     * Optional
     *
     * @var RBACRole
     *
     */
    public $updateRBACRole;

    /**
     * Optional
     *
     * @var CommonMessage
     *
     */
    public $deleteRBACRole;

    /**
     * Required
     *
     * @var CommonMessage
     *
     */
    public $deleteRBACRoleBatch;

    /**
     * Optional
     *
     * @var RBACGroup
     *
     */
    public $createRBACGroup;

    /**
     * Optional
     *
     * @var RBACGroup
     *
     */
    public $updateRBACGroup;

    /**
     * Required
     *
     * @var CommonMessage
     *
     */
    public $deleteRBACGroup;

    /**
     * Required
     *
     * @var CommonMessage
     *
     */
    public $deleteRBACGroupBatch;

    /**
     * Required
     *
     * @var RBACRole
     *
     */
    public $assignRBACRoleToUser;

    /**
     * Required
     *
     * @var RBACRole
     *
     */
    public $assignRBACRoleToUserBatch;

    /**
     * Required
     *
     * @var RBACRole
     *
     */
    public $revokeRBACRoleFromUser;

    /**
     * Required
     *
     * @var RBACRole
     *
     */
    public $revokeRBACRoleFromUserBatch;

    /**
     * Required
     *
     * @var RBACRole
     *
     */
    public $addPermissionToRBACRole;

    /**
     * Required
     *
     * @var RBACRole
     *
     */
    public $addPermissionToRBACRoleBatch;

    /**
     * Required
     *
     * @var RBACRole
     *
     */
    public $removePermissionFromRBACRole;

    /**
     * Required
     *
     * @var RBACRole
     *
     */
    public $removePermissionFromRBACRoleBatch;

    /**
     * Required
     *
     * @var RBACGroup
     *
     */
    public $addRoleToRBACGroup;

    /**
     * Required
     *
     * @var RBACGroup
     *
     */
    public $addRoleToRBACGroupBatch;

    /**
     * Required
     *
     * @var RBACGroup
     *
     */
    public $removeRoleFromRBACGroup;

    /**
     * Required
     *
     * @var RBACGroup
     *
     */
    public $removeRoleFromRBACGroupBatch;

    /**
     * Required
     *
     * @var RBACGroup
     *
     */
    public $addUserToRBACGroup;

    /**
     * Required
     *
     * @var RBACGroup
     *
     */
    public $addUserToRBACGroupBatch;

    /**
     * Required
     *
     * @var RBACGroup
     *
     */
    public $removeUserFromRBACGroup;

    /**
     * Required
     *
     * @var RBACGroup
     *
     */
    public $removeUserFromRBACGroupBatch;

    /**
     * Required
     *
     * @var Org
     *
     */
    public $createOrg;

    /**
     * Required
     *
     * @var Org
     *
     */
    public $updateOrg;

    /**
     * Required
     *
     * @var CommonMessage
     *
     */
    public $deleteOrg;

    /**
     * Required
     *
     * @var Org
     *
     */
    public $addOrgNode;

    /**
     * Required
     *
     * @var Org
     *
     */
    public $removeOrgNode;

    /**
     * Required
     *
     * @var GroupMetadata[]
     *
     */
    public $addGroupMetadata;

    /**
     * Required
     *
     * @var GroupMetadata[]
     *
     */
    public $removeGroupMetadata;

    /**
     * Optional
     *
     * @var DingTalkCorp
     *
     */
    public $addDingTalkCorp;

    /**
     * Optional
     *
     * @var CorpSyncResult
     *
     */
    public $startDingTalkCorpInitialSync;

    /**
     * Optional
     *
     * @var WechatWorkCorp
     *
     */
    public $addWechatWorkCorp;

    /**
     * Optional
     *
     * @var CorpSyncResult
     *
     */
    public $startWechatWorkCorpInitialSync;

    /**
     * Required
     *
     * @var Rule
     *
     */
    public $createRule;

    /**
     * Required
     *
     * @var Rule
     *
     */
    public $updateRule;

    /**
     * Required
     *
     * @var CommonMessage
     *
     */
    public $deleteRule;

    /**
     * Required
     *
     * @var PagedRuleEnvVariable
     *
     */
    public $setRuleEnv;

    /**
     * Required
     *
     * @var PagedRuleEnvVariable
     *
     */
    public $removeRuleEnv;

    /**
     * Optional
     *
     * @var CommonMessage
     *
     */
    public $updateRuleOrder;

    /**
     * Optional
     *
     * @var User
     *
     */
    public $updatePhone;

    /**
     * Optional
     *
     * @var User
     *
     */
    public $updateEmail;

    /**
     * Optional
     *
     * @var CommonMessage
     *
     */
    public $sendChangeEmailVerifyCode;

    /**
     * Optional
     *
     * @var CommonMessage
     *
     */
    public $createInterConnection;

    /**
     * Required
     *
     * @var UserMetaDataList
     *
     */
    public $setUserMetadata;

    /**
     * Required
     *
     * @var UserMetaDataList
     *
     */
    public $removeUserMetadata;
}

class EmailProviderListInput
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $image;

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
     * @var EmailProviderFormInput[]
     *
     */
    public $fields;
}

class EmailProviderFormInput
{
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
     * @var string
     *
     */
    public $help;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $value;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $options;
}

class EmailProviderWithClientAddInput
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

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
     * @var EmailProviderFormAddInput[]
     *
     */
    public $fields;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $provider;
}

class EmailProviderFormAddInput
{
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
     * @var string
     *
     */
    public $help;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $value;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $options;
}

class EmailTemplateWithClientInput
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $template;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $sender;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $object;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hasURL;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $URLExpireTime;

    /**
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
    public $status;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $content;
}

class EmailTemplateInput
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $sender;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $object;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hasURL;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $URLExpireTime;

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
     * @var string
     *
     */
    public $redirectTo;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $content;
}

class OAuthListUpdateInput
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $alias;

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
     * @var string
     *
     */
    public $description;

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
    public $url;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $oAuthUrl;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $wxappLogo;
}

class OAuthListFieldsFormUpdateInput
{
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
     * @var string
     *
     */
    public $value;

    /**
     * Optional
     *
     * @var OAuthListFieldsFormRecursionInput[]
     *
     */
    public $children;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $checked;
}

class OAuthListFieldsFormRecursionInput
{
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
     * @var string
     *
     */
    public $value;

    /**
     * Optional
     *
     * @var OAuthListFieldsFormRecursionInput[]
     *
     */
    public $children;
}

class OidcProviderCustomStylesInput
{
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
    public $hideQRCode;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hideUP;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hideUsername;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hideRegister;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hidePhone;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hideSocial;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hideClose;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $hidePhonePassword;

    /**
     * Optional
     *
     * @var OidcProviderCustomStylesPlaceholderInput
     *
     */
    public $placeholder;

    /**
     * Optional
     *
     * @var OidcProviderCustomStylesQrcodeScanningInput
     *
     */
    public $qrcodeScanning;

    /**
     * Optional
     *
     * @var OidcProviderDefaultLoginMethod
     *
     */
    public $defaultLoginMethod;
}

class OidcProviderCustomStylesPlaceholderInput
{
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
    public $email;

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
     * @var string
     *
     */
    public $confirmPassword;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $verfiyCode;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $newPassword;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $phone;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $phoneCode;
}

class OidcProviderCustomStylesQrcodeScanningInput
{
    /**
     * Optional
     *
     * @var bool
     *
     */
    public $redirect;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $interval;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $tips;
}

class AssertionMapInputType
{
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
    public $photo;

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
    public $providerName;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $email;
}

class AssertionConsumeServiceInputType
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $binding;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $url;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $isDefault;
}

class UserAuthorizedApp
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $appId;

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
    public $scope;

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
    public $isRevoked;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $when;
}

class PricingFieldsInput
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
     * @var int
     *
     */
    public $startNumber;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $freeNumber;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $startPrice;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $maxNumber;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $d;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $features;
}

class OrderAddInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $user;

    /**
     * Required
     *
     * @var string
     *
     */
    public $client;

    /**
     * Required
     *
     * @var string
     *
     */
    public $pricing;

    /**
     * Required
     *
     * @var int
     *
     */
    public $flowNumber;

    /**
     * Required
     *
     * @var float
     *
     */
    public $price;

    /**
     * Required
     *
     * @var int
     *
     */
    public $timeOfPurchase;
}

class OrderSuccess
{
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
    public $url;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $charge;
}

class UserRegisterInput
{
    /**
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
     * Optional
     *
     * @var string
     *
     */
    public $phone;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $phoneCode;

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
     * @var string
     *
     */
    public $salt;

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
     * @var string
     *
     */
    public $lastIP;

    /**
     * Required
     *
     * @var string
     *
     */
    public $registerInClient;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $registerMethod;

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
     * @var string
     *
     */
    public $updatedAt;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $signedUp;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $lastLogin;
}

class UserUpdateInput
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
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
     * Optional
     *
     * @var bool
     *
     */
    public $emailVerified;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $phone;

    /**
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
    public $password;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $registerInClient;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $registerMethod;

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
    public $token;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $tokenExpiredAt;

    /**
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
    public $updatedAt;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $oldPassword;
}

class NewUserClientInput
{
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
    public $userId;

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
    public $clientTypeId;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $userPoolTypeList;

    /**
     * Optional
     *
     * @var IamType
     *
     */
    public $iamType;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $domain;
}

class UpdateUserClientInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
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
    public $userId;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $clientType;

    /**
     * Optional
     *
     * @var string[]
     *
     */
    public $userPoolTypeList;

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
    public $showWXMPQRCode;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $useMiniLogin;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $useSelfWxapp;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $enableEmail;

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
     * @var string
     *
     */
    public $descriptions;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $jwtExpired;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $secret;

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
     * @var string
     *
     */
    public $logo;

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
}

class FrequentRegisterCheckConfigInput
{
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
    public $enable;
}

class LoginFailCheckConfigInput
{
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
    public $enable;
}

class ChangePhoneStrategyInput
{
    /**
     * Optional
     *
     * @var bool
     *
     */
    public $verifyOldPhone;
}

class ChangeEmailStrategyInput
{
    /**
     * Optional
     *
     * @var bool
     *
     */
    public $verifyOldEmail;
}

class QrcodeLoginStrategyInput
{
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

class App2WxappLoginStrategyInput
{
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

class InvitationCode
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

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
    public $createdAt;
}

class SuperAdminUpdateInput
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

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
    public $email;

    /**
     * Required
     *
     * @var string
     *
     */
    public $password;
}

class RefreshToken
{
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

class PermissionDescriptorsInputType
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $permissionId;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $operationAllow;
}

class EncryptPassword
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $encryptUrl;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $decryptUrl;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $logs;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $enable;

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
     * Optional
     *
     * @var string
     *
     */
    public $password;
}

class RefreshAccessTokenData
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $accessToken;
}

class RefreshThirdPartyIdentityResult
{
    /**
     * Optional
     *
     * @var bool
     *
     */
    public $refreshSuccess;

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
    public $refreshToken;

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
     * @var string
     *
     */
    public $updatedAt;
}

class OidcPasswordModeUserInfo
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $sub;

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
    public $family_name;

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
    public $given_name;

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
    public $middle_name;

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
    public $nickname;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $picture;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $preferred_username;

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
    public $updated_at;

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
    public $zoneinfo;

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
    public $_id;

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
     * @var int
     *
     */
    public $logins_count;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $register_method;

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
     * @var string
     *
     */
    public $last_ip;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $register_in_userpool;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $last_login;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $signed_up;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $email;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $email_verified;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $phone_number;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $phone_number_verified;

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
     * @var string
     *
     */
    public $access_token;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $id_token;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $refresh_token;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $expires_in;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $token_type;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $scope;
}

class RefreshedSignInToken
{
    /**
     * Optional
     *
     * @var string
     *
     */
    public $access_token;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $id_token;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $refresh_token;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $scope;

    /**
     * Optional
     *
     * @var int
     *
     */
    public $expires_in;
}

class CreateRbacPermissionInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $userPoolId;

    /**
     * Required
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
}

class UpdateRbacPermissionInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

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
}

class CreateRbacRoleInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $userPoolId;

    /**
     * Required
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
}

class UpdateRbacRoleInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

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
}

class CreateRbacGroupInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $userPoolId;

    /**
     * Required
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
}

class UpdateRbacGroupInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

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
}

class AssignUserToRbacRoleInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $userId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $roleId;
}

class AssignUserToRbacRoleBatchInput
{
    /**
     * Required
     *
     * @var string[]
     *
     */
    public $userIdList;

    /**
     * Required
     *
     * @var string
     *
     */
    public $roleId;
}

class RevokeRbacRoleFromUserInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $userId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $roleId;
}

class RevokeRbacRoleFromUserBatchInput
{
    /**
     * Required
     *
     * @var string[]
     *
     */
    public $userIdList;

    /**
     * Required
     *
     * @var string
     *
     */
    public $roleId;
}

class AddPermissionToRbacRoleInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $permissionId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $roleId;
}

class AddPermissionToRbacRoleBatchInput
{
    /**
     * Required
     *
     * @var string[]
     *
     */
    public $permissionIdList;

    /**
     * Required
     *
     * @var string
     *
     */
    public $roleId;
}

class RemovePermissionFromRbacRoleInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $permissionId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $roleId;
}

class RemovePermissionFromRbacRoleBatchInput
{
    /**
     * Required
     *
     * @var string[]
     *
     */
    public $permissionIdList;

    /**
     * Required
     *
     * @var string
     *
     */
    public $roleId;
}

class AddRoleToRbacGroupInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $roleId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $groupId;
}

class AddRoleToRbacGroupBatchInput
{
    /**
     * Required
     *
     * @var string[]
     *
     */
    public $roleIdList;

    /**
     * Required
     *
     * @var string
     *
     */
    public $groupId;
}

class RemoveRoleFromRbacGroupInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $roleId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $groupId;
}

class RemoveRoleFromRbacGroupBatchInput
{
    /**
     * Required
     *
     * @var string[]
     *
     */
    public $roleIdList;

    /**
     * Required
     *
     * @var string
     *
     */
    public $groupId;
}

class AddUserToRbacGroupInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $userId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $groupId;
}

class AddUserToRbacGroupBatchInput
{
    /**
     * Required
     *
     * @var string[]
     *
     */
    public $userIdList;

    /**
     * Required
     *
     * @var string
     *
     */
    public $groupId;
}

class RemoveUserFromRbacGroupInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $userId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $groupId;
}

class RemoveUserFromRbacGroupBatchInput
{
    /**
     * Required
     *
     * @var string[]
     *
     */
    public $userIdList;

    /**
     * Required
     *
     * @var string
     *
     */
    public $groupId;
}

class CreateOrgInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $rootGroupId;

    /**
     * Required
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
    public $logo;
}

class UpdateOrgInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $userPoolId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $orgId;

    /**
     * Optional
     *
     * @var string
     *
     */
    public $logo;
}

class AddOrgNodeInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $orgId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $groupId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $parentGroupId;
}

class RemoveOrgNodeInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $orgId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $groupId;
}

class CreateDingTalkCorpInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $userPoolId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $corpId;

    /**
     * Required
     *
     * @var bool
     *
     */
    public $twoWaySynchronizationOn;

    /**
     * Required
     *
     * @var string
     *
     */
    public $appkey;

    /**
     * Required
     *
     * @var string
     *
     */
    public $secret;
}

class CorpSyncResult
{
    /**
     * Required
     *
     * @var int
     *
     */
    public $code;

    /**
     * Required
     *
     * @var string
     *
     */
    public $message;

    /**
     * Required
     *
     * @var string
     *
     */
    public $orgId;
}

class CreateWechatWorkCorpInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $userPoolId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $corpId;

    /**
     * Required
     *
     * @var bool
     *
     */
    public $twoWaySynchronizationOn;

    /**
     * Required
     *
     * @var string
     *
     */
    public $addressBookSyncHelperSecret;

    /**
     * Required
     *
     * @var string
     *
     */
    public $addressBookSyncHelperToken;

    /**
     * Required
     *
     * @var string
     *
     */
    public $addressBookSyncHelperEncodingAESKey;
}

class CreateRuleInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $userPoolId;

    /**
     * Required
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
     * Required
     *
     * @var RuleTypes
     *
     */
    public $type;

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
     * @var bool
     *
     */
    public $async;
}

class UpdateRuleInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

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
     * @var RuleTypes
     *
     */
    public $type;

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
    public $code;

    /**
     * Optional
     *
     * @var bool
     *
     */
    public $async;
}

class SetRuleEnvInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $userPoolId;

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

class RemoveRuleEnvInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $userPoolId;

    /**
     * Required
     *
     * @var string
     *
     */
    public $key;
}

class UpdateRuleOrderInput
{
    /**
     * Required
     *
     * @var UpdateRuleOrderItem[]
     *
     */
    public $list;
}

class UpdateRuleOrderItem
{
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
     * @var int
     *
     */
    public $order;
}

class SetUserMetadataInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

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

class RemoveUserMetadataInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Required
     *
     * @var string
     *
     */
    public $key;
}

class AuthenticationContextInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $protocol;

    /**
     * Required
     *
     * @var string
     *
     */
    public $connection;

    /**
     * Optional
     *
     * @var LdapConfigurationInput
     *
     */
    public $ldapConfiguration;
}

class LdapConfigurationInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;

    /**
     * Required
     *
     * @var bool
     *
     */
    public $enabled;

    /**
     * Required
     *
     * @var bool
     *
     */
    public $isDeleted;

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
    public $ldapLink;

    /**
     * Required
     *
     * @var string
     *
     */
    public $baseDN;

    /**
     * Required
     *
     * @var string
     *
     */
    public $searchStandard;

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
    public $description;

    /**
     * Required
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
}

class DeleteOrgInput
{
    /**
     * Required
     *
     * @var string
     *
     */
    public $_id;
}

class DeleteRBACGroupBatchResult
{
    /**
     * Required
     *
     * @var bool
     *
     */
    public $success;

    /**
     * Required
     *
     * @var int
     *
     */
    public $requestCount;

    /**
     * Required
     *
     * @var int
     *
     */
    public $deletedCount;
}

class DeleteRBACRoleBatchResult
{
    /**
     * Required
     *
     * @var bool
     *
     */
    public $success;

    /**
     * Required
     *
     * @var int
     *
     */
    public $requestCount;

    /**
     * Required
     *
     * @var int
     *
     */
    public $deletedCount;
}

class DeleteRBACPermissionBatchResult
{
    /**
     * Required
     *
     * @var bool
     *
     */
    public $success;

    /**
     * Required
     *
     * @var int
     *
     */
    public $requestCount;

    /**
     * Required
     *
     * @var int
     *
     */
    public $deletedCount;
}


class AddEmailProviderResponse
{

    /**
     * @var EmailProviderList
     */
    public $AddEmailProvider;
}

class AddEmailProviderParam
{

    /**
     * Optional
     *
     * @var EmailProviderListInput
     */
    public $options;

    function createRequest()
    {
        return [
            "query" => self::AddEmailProviderDocument,
            "operationName" => "AddEmailProvider",
            "variables" => $this
        ];
    }

    const AddEmailProviderDocument = <<<EOF
mutation AddEmailProvider(\$options: EmailProviderListInput) {
  AddEmailProvider(options: \$options) {
    _id
    name
    image
    description
    fields {
      label
      type
      placeholder
      help
      value
      options
    }
    client
    user
    status
    provider {
      _id
      name
      image
      description
      client
      user
      status
    }
  }
}
EOF;
}


class AddLdapServerResponse
{

    /**
     * @var LDAPSingleServer
     */
    public $AddLDAPServer;
}

class AddLdapServerParam
{

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
    public $clientId;

    /**
     * Required
     *
     * @var string
     */
    public $userId;

    /**
     * Required
     *
     * @var string
     */
    public $ldapLink;

    /**
     * Required
     *
     * @var string
     */
    public $baseDN;

    /**
     * Required
     *
     * @var string
     */
    public $searchStandard;

    /**
     * Required
     *
     * @var string
     */
    public $username;

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
    public $emailPostfix;

    /**
     * Optional
     *
     * @var string
     */
    public $description;

    /**
     * Optional
     *
     * @var bool
     */
    public $enabled;

    function createRequest()
    {
        return [
            "query" => self::AddLdapServerDocument,
            "operationName" => "AddLDAPServer",
            "variables" => $this
        ];
    }

    const AddLdapServerDocument = <<<EOF
mutation AddLDAPServer(\$name: String!, \$clientId: String!, \$userId: String!, \$ldapLink: String!, \$baseDN: String!, \$searchStandard: String!, \$username: String!, \$password: String!, \$emailPostfix: String, \$description: String, \$enabled: Boolean) {
  AddLDAPServer(name: \$name, clientId: \$clientId, userId: \$userId, ldapLink: \$ldapLink, baseDN: \$baseDN, searchStandard: \$searchStandard, username: \$username, password: \$password, emailPostfix: \$emailPostfix, description: \$description, enabled: \$enabled) {
    _id
    name
    clientId
    userId
    ldapLink
    baseDN
    searchStandard
    emailPostfix
    username
    password
    description
    enabled
    isDeleted
    createdAt
    updatedAt
  }
}
EOF;
}


class AddOAuthListResponse
{

    /**
     * @var OAuthList
     */
    public $AddOAuthList;
}

class AddOAuthListParam
{

    /**
     * Optional
     *
     * @var OAuthListUpdateInput
     */
    public $options;

    /**
     * Optional
     *
     * @var OAuthListFieldsFormUpdateInput
     */
    public $fields;

    function createRequest()
    {
        return [
            "query" => self::AddOAuthListDocument,
            "operationName" => "AddOAuthList",
            "variables" => $this
        ];
    }

    const AddOAuthListDocument = <<<EOF
mutation AddOAuthList(\$options: OAuthListUpdateInput, \$fields: [OAuthListFieldsFormUpdateInput]) {
  AddOAuthList(options: \$options, fields: \$fields) {
    _id
    name
    alias
    image
    description
    enabled
    url
    client
    user
    oAuthUrl
    wxappLogo
    fields {
      label
      type
      placeholder
      value
      checked
    }
    oauth {
      _id
      name
      alias
      image
      description
      enabled
      url
      client
      user
      oAuthUrl
      wxappLogo
    }
  }
}
EOF;
}


class AddSystemPricingResponse
{

    /**
     * @var PricingList
     */
    public $AddSystemPricing;
}

class AddSystemPricingParam
{

    /**
     * Optional
     *
     * @var PricingFieldsInput
     */
    public $options;

    function createRequest()
    {
        return [
            "query" => self::AddSystemPricingDocument,
            "operationName" => "AddSystemPricing",
            "variables" => $this
        ];
    }

    const AddSystemPricingDocument = <<<EOF
mutation AddSystemPricing(\$options: PricingFieldsInput) {
  AddSystemPricing(options: \$options) {
    _id
    type
    startNumber
    freeNumber
    startPrice
    maxNumber
    d
    features
  }
}
EOF;
}


class ClearAvatarSrcResponse
{

    /**
     * @var OAuthList
     */
    public $ClearAvatarSrc;
}

class ClearAvatarSrcParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     */
    public $oauth;

    /**
     * Optional
     *
     * @var string
     */
    public $user;

    function createRequest()
    {
        return [
            "query" => self::ClearAvatarSrcDocument,
            "operationName" => "ClearAvatarSrc",
            "variables" => $this
        ];
    }

    const ClearAvatarSrcDocument = <<<EOF
mutation ClearAvatarSrc(\$client: String, \$oauth: String, \$user: String) {
  ClearAvatarSrc(client: \$client, oauth: \$oauth, user: \$user) {
    _id
    name
    alias
    image
    description
    enabled
    url
    client
    user
    oAuthUrl
    wxappLogo
    fields {
      label
      type
      placeholder
      value
      checked
    }
    oauth {
      _id
      name
      alias
      image
      description
      enabled
      url
      client
      user
      oAuthUrl
      wxappLogo
    }
  }
}
EOF;
}


class ContinuePayResponse
{

    /**
     * @var OrderSuccess
     */
    public $ContinuePay;
}

class ContinuePayParam
{

    /**
     * Required
     *
     * @var string
     */
    public $order;

    function createRequest()
    {
        return [
            "query" => self::ContinuePayDocument,
            "operationName" => "ContinuePay",
            "variables" => $this
        ];
    }

    const ContinuePayDocument = <<<EOF
mutation ContinuePay(\$order: String!) {
  ContinuePay(order: \$order) {
    code
    url
    charge
  }
}
EOF;
}


class CreateDefaultSamlIdentityProviderSettingsResponse
{

    /**
     * @var SAMLDefaultIdentityProviderSettings
     */
    public $CreateDefaultSAMLIdentityProviderSettings;
}

class CreateDefaultSamlIdentityProviderSettingsParam
{

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
    public $image;

    /**
     * Optional
     *
     * @var string
     */
    public $description;

    /**
     * Optional
     *
     * @var AssertionMapInputType
     */
    public $mappings;

    function createRequest()
    {
        return [
            "query" => self::CreateDefaultSamlIdentityProviderSettingsDocument,
            "operationName" => "CreateDefaultSAMLIdentityProviderSettings",
            "variables" => $this
        ];
    }

    const CreateDefaultSamlIdentityProviderSettingsDocument = <<<EOF
mutation CreateDefaultSAMLIdentityProviderSettings(\$name: String!, \$image: String, \$description: String, \$mappings: AssertionMapInputType) {
  CreateDefaultSAMLIdentityProviderSettings(name: \$name, image: \$image, description: \$description, mappings: \$mappings) {
    _id
    name
    image
    description
    mappings {
      username
      nickname
      photo
      company
      providerName
      email
    }
    isDeleted
  }
}
EOF;
}


class CreateOAuthProviderResponse
{

    /**
     * @var OAuthProviderClient
     */
    public $CreateOAuthProvider;
}

class CreateOAuthProviderParam
{

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
     * Required
     *
     * @var string
     */
    public $redirectUris;

    /**
     * Required
     *
     * @var string
     */
    public $grants;

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

    /**
     * Optional
     *
     * @var string
     */
    public $image;

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
    public $homepageURL;

    /**
     * Optional
     *
     * @var int
     */
    public $casExpire;

    function createRequest()
    {
        return [
            "query" => self::CreateOAuthProviderDocument,
            "operationName" => "CreateOAuthProvider",
            "variables" => $this
        ];
    }

    const CreateOAuthProviderDocument = <<<EOF
mutation CreateOAuthProvider(\$name: String!, \$domain: String!, \$redirectUris: [String]!, \$grants: [String!]!, \$clientId: String, \$image: String, \$description: String, \$homepageURL: String, \$casExpire: Int) {
  CreateOAuthProvider(name: \$name, domain: \$domain, redirectUris: \$redirectUris, grants: \$grants, clientId: \$clientId, image: \$image, description: \$description, homepageURL: \$homepageURL, casExpire: \$casExpire) {
    _id
    name
    domain
    image
    redirectUris
    appSecret
    client_id
    clientId
    grants
    description
    homepageURL
    isDeleted
    when
    css
    loginUrl
    casExpire
  }
}
EOF;
}


class CreateOidcAppResponse
{

    /**
     * @var OIDCProviderClient
     */
    public $CreateOIDCApp;
}

class CreateOidcAppParam
{

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
     * Required
     *
     * @var string
     */
    public $redirect_uris;

    /**
     * Required
     *
     * @var string
     */
    public $grant_types;

    /**
     * Required
     *
     * @var string
     */
    public $response_types;

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

    /**
     * Optional
     *
     * @var string
     */
    public $client_id;

    /**
     * Optional
     *
     * @var string
     */
    public $token_endpoint_auth_method;

    /**
     * Optional
     *
     * @var string
     */
    public $image;

    /**
     * Optional
     *
     * @var bool
     */
    public $isDefault;

    /**
     * Optional
     *
     * @var string
     */
    public $id_token_signed_response_alg;

    /**
     * Optional
     *
     * @var string
     */
    public $id_token_encrypted_response_alg;

    /**
     * Optional
     *
     * @var string
     */
    public $id_token_encrypted_response_enc;

    /**
     * Optional
     *
     * @var string
     */
    public $userinfo_signed_response_alg;

    /**
     * Optional
     *
     * @var string
     */
    public $userinfo_encrypted_response_alg;

    /**
     * Optional
     *
     * @var string
     */
    public $userinfo_encrypted_response_enc;

    /**
     * Optional
     *
     * @var string
     */
    public $request_object_signing_alg;

    /**
     * Optional
     *
     * @var string
     */
    public $request_object_encryption_alg;

    /**
     * Optional
     *
     * @var string
     */
    public $request_object_encryption_enc;

    /**
     * Optional
     *
     * @var string
     */
    public $jwks_uri;

    /**
     * Optional
     *
     * @var string
     */
    public $_jwks_uri;

    /**
     * Optional
     *
     * @var string
     */
    public $jwks;

    /**
     * Optional
     *
     * @var string
     */
    public $_jwks;

    /**
     * Optional
     *
     * @var string
     */
    public $custom_jwks;

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
    public $homepageURL;

    /**
     * Optional
     *
     * @var string
     */
    public $authorization_code_expire;

    /**
     * Optional
     *
     * @var string
     */
    public $id_token_expire;

    /**
     * Optional
     *
     * @var string
     */
    public $access_token_expire;

    /**
     * Optional
     *
     * @var string
     */
    public $cas_expire;

    /**
     * Optional
     *
     * @var OidcProviderCustomStylesInput
     */
    public $customStyles;

    function createRequest()
    {
        return [
            "query" => self::CreateOidcAppDocument,
            "operationName" => "CreateOIDCApp",
            "variables" => $this
        ];
    }

    const CreateOidcAppDocument = <<<EOF
mutation CreateOIDCApp(\$name: String!, \$domain: String!, \$redirect_uris: [String]!, \$grant_types: [String!]!, \$response_types: [String!]!, \$clientId: String, \$client_id: String, \$token_endpoint_auth_method: String, \$image: String, \$isDefault: Boolean, \$id_token_signed_response_alg: String, \$id_token_encrypted_response_alg: String, \$id_token_encrypted_response_enc: String, \$userinfo_signed_response_alg: String, \$userinfo_encrypted_response_alg: String, \$userinfo_encrypted_response_enc: String, \$request_object_signing_alg: String, \$request_object_encryption_alg: String, \$request_object_encryption_enc: String, \$jwks_uri: String, \$_jwks_uri: String, \$jwks: String, \$_jwks: String, \$custom_jwks: String, \$description: String, \$homepageURL: String, \$authorization_code_expire: String, \$id_token_expire: String, \$access_token_expire: String, \$cas_expire: String, \$customStyles: OIDCProviderCustomStylesInput) {
  CreateOIDCApp(name: \$name, domain: \$domain, redirect_uris: \$redirect_uris, grant_types: \$grant_types, response_types: \$response_types, clientId: \$clientId, client_id: \$client_id, token_endpoint_auth_method: \$token_endpoint_auth_method, image: \$image, isDefault: \$isDefault, id_token_signed_response_alg: \$id_token_signed_response_alg, id_token_encrypted_response_alg: \$id_token_encrypted_response_alg, id_token_encrypted_response_enc: \$id_token_encrypted_response_enc, userinfo_signed_response_alg: \$userinfo_signed_response_alg, userinfo_encrypted_response_alg: \$userinfo_encrypted_response_alg, userinfo_encrypted_response_enc: \$userinfo_encrypted_response_enc, request_object_signing_alg: \$request_object_signing_alg, request_object_encryption_alg: \$request_object_encryption_alg, request_object_encryption_enc: \$request_object_encryption_enc, jwks_uri: \$jwks_uri, _jwks_uri: \$_jwks_uri, jwks: \$jwks, _jwks: \$_jwks, custom_jwks: \$custom_jwks, description: \$description, homepageURL: \$homepageURL, authorization_code_expire: \$authorization_code_expire, id_token_expire: \$id_token_expire, access_token_expire: \$access_token_expire, cas_expire: \$cas_expire, customStyles: \$customStyles) {
    _id
    name
    domain
    image
    redirect_uris
    client_id
    client_secret
    token_endpoint_auth_method
    id_token_signed_response_alg
    id_token_encrypted_response_alg
    id_token_encrypted_response_enc
    userinfo_signed_response_alg
    userinfo_encrypted_response_alg
    userinfo_encrypted_response_enc
    request_object_signing_alg
    request_object_encryption_alg
    request_object_encryption_enc
    jwks_uri
    _jwks_uri
    custom_jwks
    jwks
    _jwks
    clientId
    grant_types
    response_types
    description
    homepageURL
    isDeleted
    isDefault
    when
    css
    authorization_code_expire
    id_token_expire
    access_token_expire
    cas_expire
    loginUrl
    customStyles {
      forceLogin
      hideQRCode
      hideUP
      hideUsername
      hideRegister
      hidePhone
      hideSocial
      hideClose
      hidePhonePassword
      defaultLoginMethod
    }
  }
}
EOF;
}


class CreateSamlIdentityProviderResponse
{

    /**
     * @var SAMLIdentityProviderClient
     */
    public $CreateSAMLIdentityProvider;
}

class CreateSamlIdentityProviderParam
{

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
     * Required
     *
     * @var string
     */
    public $clientId;

    /**
     * Optional
     *
     * @var string
     */
    public $image;

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
    public $SPMetadata;

    /**
     * Optional
     *
     * @var string
     */
    public $IdPMetadata;

    function createRequest()
    {
        return [
            "query" => self::CreateSamlIdentityProviderDocument,
            "operationName" => "CreateSAMLIdentityProvider",
            "variables" => $this
        ];
    }

    const CreateSamlIdentityProviderDocument = <<<EOF
mutation CreateSAMLIdentityProvider(\$name: String!, \$domain: String!, \$clientId: String!, \$image: String, \$description: String, \$SPMetadata: String, \$IdPMetadata: String) {
  CreateSAMLIdentityProvider(name: \$name, domain: \$domain, clientId: \$clientId, image: \$image, description: \$description, SPMetadata: \$SPMetadata, IdPMetadata: \$IdPMetadata) {
    _id
    name
    domain
    image
    appSecret
    appId
    clientId
    description
    isDeleted
    enabled
    when
    SPMetadata
    attributeNameFormat
    customAttributes
    emailDomainTransformation
    authnContextClassRef
    IdPMetadata
    assertionConsumerUrl
    bindings
    nameIds
    attributes
    enableSignRes
    resSignAlgorithm
    resAbstractAlgorithm
    resSignPublicKey
    resSignPrivateKey
    resSignPrivateKeyPass
    enableSignReq
    reqSignPublicKey
    enableEncryptRes
    resEncryptPublicKey
    css
  }
}
EOF;
}


class CreateSamlServiceProviderResponse
{

    /**
     * @var SAMLServiceProviderClient
     */
    public $CreateSAMLServiceProvider;
}

class CreateSamlServiceProviderParam
{

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
     * Required
     *
     * @var string
     */
    public $clientId;

    /**
     * Required
     *
     * @var string
     */
    public $redirectUrl;

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
    public $SPMetadata;

    /**
     * Optional
     *
     * @var string
     */
    public $IdPMetadata;

    /**
     * Optional
     *
     * @var string
     */
    public $image;

    /**
     * Optional
     *
     * @var AssertionMapInputType
     */
    public $mappings;

    /**
     * Optional
     *
     * @var string
     */
    public $defaultIdPMapId;

    function createRequest()
    {
        return [
            "query" => self::CreateSamlServiceProviderDocument,
            "operationName" => "CreateSAMLServiceProvider",
            "variables" => $this
        ];
    }

    const CreateSamlServiceProviderDocument = <<<EOF
mutation CreateSAMLServiceProvider(\$name: String!, \$domain: String!, \$clientId: String!, \$redirectUrl: String!, \$description: String, \$SPMetadata: String, \$IdPMetadata: String, \$image: String, \$mappings: AssertionMapInputType, \$defaultIdPMapId: String) {
  CreateSAMLServiceProvider(name: \$name, domain: \$domain, clientId: \$clientId, redirectUrl: \$redirectUrl, description: \$description, SPMetadata: \$SPMetadata, IdPMetadata: \$IdPMetadata, image: \$image, mappings: \$mappings, defaultIdPMapId: \$defaultIdPMapId) {
    _id
    name
    domain
    image
    appSecret
    defaultIdPMap {
      _id
      name
      image
      description
      isDeleted
    }
    defaultIdPMapId
    appId
    clientId
    description
    isDeleted
    enabled
    when
    SPMetadata
    IdPMetadata
    IdPEntityID
    assertionConsumeService {
      binding
      url
      isDefault
    }
    mappings {
      username
      nickname
      photo
      company
      providerName
      email
    }
    redirectUrl
    loginUrl
    logoutUrl
    nameId
    enableSignRes
    resSignPublicKey
    hasResEncrypted
    resEncryptAlgorithm
    resAbstractAlgorithm
    resDecryptPrivateKey
    resDecryptPrivateKeyPass
    resEncryptPublicKey
    enableSignReq
    reqSignAlgorithm
    reqAbstractAlgorithm
    reqSignPrivateKey
    reqSignPrivateKeyPass
    reqSignPublicKey
    SPUrl
  }
}
EOF;
}


class EnableSamlIdentityProviderResponse
{

    /**
     * @var SAMLIdentityProviderClient
     */
    public $EnableSAMLIdentityProvider;
}

class EnableSamlIdentityProviderParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

    /**
     * Optional
     *
     * @var bool
     */
    public $enabled;

    function createRequest()
    {
        return [
            "query" => self::EnableSamlIdentityProviderDocument,
            "operationName" => "EnableSAMLIdentityProvider",
            "variables" => $this
        ];
    }

    const EnableSamlIdentityProviderDocument = <<<EOF
mutation EnableSAMLIdentityProvider(\$appId: String!, \$clientId: String!, \$enabled: Boolean) {
  EnableSAMLIdentityProvider(appId: \$appId, clientId: \$clientId, enabled: \$enabled) {
    _id
    name
    domain
    image
    appSecret
    appId
    clientId
    description
    isDeleted
    enabled
    when
    SPMetadata
    attributeNameFormat
    customAttributes
    emailDomainTransformation
    authnContextClassRef
    IdPMetadata
    assertionConsumerUrl
    bindings
    nameIds
    attributes
    enableSignRes
    resSignAlgorithm
    resAbstractAlgorithm
    resSignPublicKey
    resSignPrivateKey
    resSignPrivateKeyPass
    enableSignReq
    reqSignPublicKey
    enableEncryptRes
    resEncryptPublicKey
    css
  }
}
EOF;
}


class EnableSamlServiceProviderResponse
{

    /**
     * @var SAMLServiceProviderClient
     */
    public $EnableSAMLServiceProvider;
}

class EnableSamlServiceProviderParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

    /**
     * Optional
     *
     * @var bool
     */
    public $enabled;

    function createRequest()
    {
        return [
            "query" => self::EnableSamlServiceProviderDocument,
            "operationName" => "EnableSAMLServiceProvider",
            "variables" => $this
        ];
    }

    const EnableSamlServiceProviderDocument = <<<EOF
mutation EnableSAMLServiceProvider(\$appId: String!, \$clientId: String!, \$enabled: Boolean) {
  EnableSAMLServiceProvider(appId: \$appId, clientId: \$clientId, enabled: \$enabled) {
    _id
    name
    domain
    image
    appSecret
    defaultIdPMap {
      _id
      name
      image
      description
      isDeleted
    }
    defaultIdPMapId
    appId
    clientId
    description
    isDeleted
    enabled
    when
    SPMetadata
    IdPMetadata
    IdPEntityID
    assertionConsumeService {
      binding
      url
      isDefault
    }
    mappings {
      username
      nickname
      photo
      company
      providerName
      email
    }
    redirectUrl
    loginUrl
    logoutUrl
    nameId
    enableSignRes
    resSignPublicKey
    hasResEncrypted
    resEncryptAlgorithm
    resAbstractAlgorithm
    resDecryptPrivateKey
    resDecryptPrivateKeyPass
    resEncryptPublicKey
    enableSignReq
    reqSignAlgorithm
    reqAbstractAlgorithm
    reqSignPrivateKey
    reqSignPrivateKeyPass
    reqSignPublicKey
    SPUrl
  }
}
EOF;
}


class IncClientFlowNumberResponse
{

    /**
     * @var OrderSuccess
     */
    public $IncClientFlowNumber;
}

class IncClientFlowNumberParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     */
    public $userInvitied;

    /**
     * Optional
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var int
     */
    public $number;

    function createRequest()
    {
        return [
            "query" => self::IncClientFlowNumberDocument,
            "operationName" => "IncClientFlowNumber",
            "variables" => $this
        ];
    }

    const IncClientFlowNumberDocument = <<<EOF
mutation IncClientFlowNumber(\$user: String, \$userInvitied: String, \$client: String, \$number: Int) {
  IncClientFlowNumber(user: \$user, userInvitied: \$userInvitied, client: \$client, number: \$number) {
    code
    url
    charge
  }
}
EOF;
}


class LoginByLdapResponse
{

    /**
     * @var User
     */
    public $LoginByLDAP;
}

class LoginByLdapParam
{

    /**
     * Required
     *
     * @var string
     */
    public $username;

    /**
     * Required
     *
     * @var string
     */
    public $password;

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

    /**
     * Optional
     *
     * @var string
     */
    public $browser;

    function createRequest()
    {
        return [
            "query" => self::LoginByLdapDocument,
            "operationName" => "LoginByLDAP",
            "variables" => $this
        ];
    }

    const LoginByLdapDocument = <<<EOF
mutation LoginByLDAP(\$username: String!, \$password: String!, \$clientId: String!, \$browser: String) {
  LoginByLDAP(username: \$username, password: \$password, clientId: \$clientId, browser: \$browser) {
    _id
    username
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    nickname
    company
    photo
    browser
    password
    registerInClient
    registerMethod
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
    country
    updatedAt
    thirdPartyIdentity {
      provider
      refreshToken
      accessToken
      expiresIn
      updatedAt
    }
    oldPassword
    metadata
  }
}
EOF;
}


class RemoveEmailProviderResponse
{

    /**
     * @var EmailProviderList[]
     */
    public $RemoveEmailProvider;
}

class RemoveEmailProviderParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_ids;

    function createRequest()
    {
        return [
            "query" => self::RemoveEmailProviderDocument,
            "operationName" => "RemoveEmailProvider",
            "variables" => $this
        ];
    }

    const RemoveEmailProviderDocument = <<<EOF
mutation RemoveEmailProvider(\$_ids: [String]!) {
  RemoveEmailProvider(_ids: \$_ids) {
    _id
    name
    image
    description
    fields {
      label
      type
      placeholder
      help
      value
      options
    }
    client
    user
    status
    provider {
      _id
      name
      image
      description
      client
      user
      status
    }
  }
}
EOF;
}


class RemoveLdapServerResponse
{

    /**
     * @var LDAPSingleServer
     */
    public $RemoveLDAPServer;
}

class RemoveLdapServerParam
{

    /**
     * Required
     *
     * @var string
     */
    public $ldapId;

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

    function createRequest()
    {
        return [
            "query" => self::RemoveLdapServerDocument,
            "operationName" => "RemoveLDAPServer",
            "variables" => $this
        ];
    }

    const RemoveLdapServerDocument = <<<EOF
mutation RemoveLDAPServer(\$ldapId: String!, \$clientId: String!) {
  RemoveLDAPServer(ldapId: \$ldapId, clientId: \$clientId) {
    _id
    name
    clientId
    userId
    ldapLink
    baseDN
    searchStandard
    emailPostfix
    username
    password
    description
    enabled
    isDeleted
    createdAt
    updatedAt
  }
}
EOF;
}


class RemoveOAuthListResponse
{

    /**
     * @var string[]
     */
    public $RemoveOAuthList;
}

class RemoveOAuthListParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $ids;

    function createRequest()
    {
        return [
            "query" => self::RemoveOAuthListDocument,
            "operationName" => "RemoveOAuthList",
            "variables" => $this
        ];
    }

    const RemoveOAuthListDocument = <<<EOF
mutation RemoveOAuthList(\$ids: [String]) {
  RemoveOAuthList(ids: \$ids)
}
EOF;
}


class RemoveOAuthProviderResponse
{

    /**
     * @var OAuthProviderClient
     */
    public $RemoveOAuthProvider;
}

class RemoveOAuthProviderParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

    function createRequest()
    {
        return [
            "query" => self::RemoveOAuthProviderDocument,
            "operationName" => "RemoveOAuthProvider",
            "variables" => $this
        ];
    }

    const RemoveOAuthProviderDocument = <<<EOF
mutation RemoveOAuthProvider(\$appId: String!, \$clientId: String!) {
  RemoveOAuthProvider(appId: \$appId, clientId: \$clientId) {
    _id
    name
    domain
    image
    redirectUris
    appSecret
    client_id
    clientId
    grants
    description
    homepageURL
    isDeleted
    when
    css
    loginUrl
    casExpire
  }
}
EOF;
}


class RemoveOidcAppResponse
{

    /**
     * @var OIDCProviderClient
     */
    public $RemoveOIDCApp;
}

class RemoveOidcAppParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

    function createRequest()
    {
        return [
            "query" => self::RemoveOidcAppDocument,
            "operationName" => "RemoveOIDCApp",
            "variables" => $this
        ];
    }

    const RemoveOidcAppDocument = <<<EOF
mutation RemoveOIDCApp(\$appId: String!, \$clientId: String!) {
  RemoveOIDCApp(appId: \$appId, clientId: \$clientId) {
    _id
    name
    domain
    image
    redirect_uris
    client_id
    client_secret
    token_endpoint_auth_method
    id_token_signed_response_alg
    id_token_encrypted_response_alg
    id_token_encrypted_response_enc
    userinfo_signed_response_alg
    userinfo_encrypted_response_alg
    userinfo_encrypted_response_enc
    request_object_signing_alg
    request_object_encryption_alg
    request_object_encryption_enc
    jwks_uri
    _jwks_uri
    custom_jwks
    jwks
    _jwks
    clientId
    grant_types
    response_types
    description
    homepageURL
    isDeleted
    isDefault
    when
    css
    authorization_code_expire
    id_token_expire
    access_token_expire
    cas_expire
    loginUrl
    customStyles {
      forceLogin
      hideQRCode
      hideUP
      hideUsername
      hideRegister
      hidePhone
      hideSocial
      hideClose
      hidePhonePassword
      defaultLoginMethod
    }
  }
}
EOF;
}


class RemoveSamlIdentityProviderResponse
{

    /**
     * @var SAMLIdentityProviderClient
     */
    public $RemoveSAMLIdentityProvider;
}

class RemoveSamlIdentityProviderParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

    function createRequest()
    {
        return [
            "query" => self::RemoveSamlIdentityProviderDocument,
            "operationName" => "RemoveSAMLIdentityProvider",
            "variables" => $this
        ];
    }

    const RemoveSamlIdentityProviderDocument = <<<EOF
mutation RemoveSAMLIdentityProvider(\$appId: String!, \$clientId: String!) {
  RemoveSAMLIdentityProvider(appId: \$appId, clientId: \$clientId) {
    _id
    name
    domain
    image
    appSecret
    appId
    clientId
    description
    isDeleted
    enabled
    when
    SPMetadata
    attributeNameFormat
    customAttributes
    emailDomainTransformation
    authnContextClassRef
    IdPMetadata
    assertionConsumerUrl
    bindings
    nameIds
    attributes
    enableSignRes
    resSignAlgorithm
    resAbstractAlgorithm
    resSignPublicKey
    resSignPrivateKey
    resSignPrivateKeyPass
    enableSignReq
    reqSignPublicKey
    enableEncryptRes
    resEncryptPublicKey
    css
  }
}
EOF;
}


class RemoveSamlServiceProviderResponse
{

    /**
     * @var SAMLServiceProviderClient
     */
    public $RemoveSAMLServiceProvider;
}

class RemoveSamlServiceProviderParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

    function createRequest()
    {
        return [
            "query" => self::RemoveSamlServiceProviderDocument,
            "operationName" => "RemoveSAMLServiceProvider",
            "variables" => $this
        ];
    }

    const RemoveSamlServiceProviderDocument = <<<EOF
mutation RemoveSAMLServiceProvider(\$appId: String!, \$clientId: String!) {
  RemoveSAMLServiceProvider(appId: \$appId, clientId: \$clientId) {
    _id
    name
    domain
    image
    appSecret
    defaultIdPMap {
      _id
      name
      image
      description
      isDeleted
    }
    defaultIdPMapId
    appId
    clientId
    description
    isDeleted
    enabled
    when
    SPMetadata
    IdPMetadata
    IdPEntityID
    assertionConsumeService {
      binding
      url
      isDefault
    }
    mappings {
      username
      nickname
      photo
      company
      providerName
      email
    }
    redirectUrl
    loginUrl
    logoutUrl
    nameId
    enableSignRes
    resSignPublicKey
    hasResEncrypted
    resEncryptAlgorithm
    resAbstractAlgorithm
    resDecryptPrivateKey
    resDecryptPrivateKeyPass
    resEncryptPublicKey
    enableSignReq
    reqSignAlgorithm
    reqAbstractAlgorithm
    reqSignPrivateKey
    reqSignPrivateKeyPass
    reqSignPublicKey
    SPUrl
  }
}
EOF;
}


class RevokeUserAuthorizedAppResponse
{

    /**
     * @var UserAuthorizedApp
     */
    public $RevokeUserAuthorizedApp;
}

class RevokeUserAuthorizedAppParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $appId;

    /**
     * Optional
     *
     * @var string
     */
    public $userPoolId;

    /**
     * Optional
     *
     * @var string
     */
    public $userId;

    function createRequest()
    {
        return [
            "query" => self::RevokeUserAuthorizedAppDocument,
            "operationName" => "RevokeUserAuthorizedApp",
            "variables" => $this
        ];
    }

    const RevokeUserAuthorizedAppDocument = <<<EOF
mutation RevokeUserAuthorizedApp(\$appId: String, \$userPoolId: String, \$userId: String) {
  RevokeUserAuthorizedApp(appId: \$appId, userPoolId: \$userPoolId, userId: \$userId) {
    _id
    appId
    userId
    scope
    type
    isRevoked
    when
  }
}
EOF;
}


class SaveEmailProviderWithClientResponse
{

    /**
     * @var EmailProviderWithClientList
     */
    public $SaveEmailProviderWithClient;
}

class SaveEmailProviderWithClientParam
{

    /**
     * Optional
     *
     * @var EmailProviderWithClientAddInput
     */
    public $options;

    function createRequest()
    {
        return [
            "query" => self::SaveEmailProviderWithClientDocument,
            "operationName" => "SaveEmailProviderWithClient",
            "variables" => $this
        ];
    }

    const SaveEmailProviderWithClientDocument = <<<EOF
mutation SaveEmailProviderWithClient(\$options: EmailProviderWithClientAddInput) {
  SaveEmailProviderWithClient(options: \$options) {
    _id
    user
    client
    status
    fields {
      label
      type
      placeholder
      help
      value
      options
    }
    provider {
      _id
      name
      image
      description
    }
  }
}
EOF;
}


class SendEmailResponse
{

    /**
     * @var EmailSentList
     */
    public $SendEmail;
}

class SendEmailParam
{

    /**
     * Required
     *
     * @var string
     */
    public $receivers;

    /**
     * Required
     *
     * @var string
     */
    public $subject;

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     */
    public $user;

    /**
     * Optional
     *
     * @var bool
     */
    public $testAvailable;

    /**
     * Optional
     *
     * @var string
     */
    public $providerName;

    /**
     * Optional
     *
     * @var string
     */
    public $content;

    /**
     * Optional
     *
     * @var string
     */
    public $sender;

    /**
     * Optional
     *
     * @var string
     */
    public $meta_data;

    /**
     * Optional
     *
     * @var string
     */
    public $secret;

    function createRequest()
    {
        return [
            "query" => self::SendEmailDocument,
            "operationName" => "SendEmail",
            "variables" => $this
        ];
    }

    const SendEmailDocument = <<<EOF
mutation SendEmail(\$receivers: [String]!, \$subject: String!, \$client: String!, \$user: String, \$testAvailable: Boolean, \$providerName: String, \$content: String, \$sender: String, \$meta_data: String, \$secret: String) {
  SendEmail(receivers: \$receivers, subject: \$subject, client: \$client, user: \$user, testAvailable: \$testAvailable, providerName: \$providerName, content: \$content, sender: \$sender, meta_data: \$meta_data, secret: \$secret) {
    _id
    user
    subject
    content
    sender
    receivers
    post
    createdAt
    rejected
    isDeleted
    client
  }
}
EOF;
}


class SendEmailByTypeResponse
{

    /**
     * @var EmailSentList
     */
    public $SendEmailByType;
}

class SendEmailByTypeParam
{

    /**
     * Required
     *
     * @var string
     */
    public $user;

    /**
     * Required
     *
     * @var string
     */
    public $type;

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Required
     *
     * @var string
     */
    public $receivers;

    /**
     * Optional
     *
     * @var string
     */
    public $meta_data;

    function createRequest()
    {
        return [
            "query" => self::SendEmailByTypeDocument,
            "operationName" => "SendEmailByType",
            "variables" => $this
        ];
    }

    const SendEmailByTypeDocument = <<<EOF
mutation SendEmailByType(\$user: String!, \$type: String!, \$client: String!, \$receivers: [String]!, \$meta_data: String) {
  SendEmailByType(user: \$user, type: \$type, client: \$client, receivers: \$receivers, meta_data: \$meta_data) {
    _id
    user
    subject
    content
    sender
    receivers
    post
    createdAt
    rejected
    isDeleted
    client
  }
}
EOF;
}


class SendWebhookTestResponse
{

    /**
     * @var bool
     */
    public $SendWebhookTest;
}

class SendWebhookTestParam
{

    /**
     * Required
     *
     * @var string
     */
    public $id;

    function createRequest()
    {
        return [
            "query" => self::SendWebhookTestDocument,
            "operationName" => "SendWebhookTest",
            "variables" => $this
        ];
    }

    const SendWebhookTestDocument = <<<EOF
mutation SendWebhookTest(\$id: String!) {
  SendWebhookTest(id: \$id)
}
EOF;
}


class SetApplicationOAuthEnableOrDisableResponse
{

    /**
     * @var OAuthList
     */
    public $SetApplicationOAuthEnableOrDisable;
}

class SetApplicationOAuthEnableOrDisableParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     */
    public $oauth;

    /**
     * Optional
     *
     * @var string
     */
    public $user;

    /**
     * Optional
     *
     * @var bool
     */
    public $enabled;

    function createRequest()
    {
        return [
            "query" => self::SetApplicationOAuthEnableOrDisableDocument,
            "operationName" => "SetApplicationOAuthEnableOrDisable",
            "variables" => $this
        ];
    }

    const SetApplicationOAuthEnableOrDisableDocument = <<<EOF
mutation SetApplicationOAuthEnableOrDisable(\$client: String, \$oauth: String, \$user: String, \$enabled: Boolean) {
  SetApplicationOAuthEnableOrDisable(client: \$client, oauth: \$oauth, user: \$user, enabled: \$enabled) {
    _id
    name
    alias
    image
    description
    enabled
    url
    client
    user
    oAuthUrl
    wxappLogo
    fields {
      label
      type
      placeholder
      value
      checked
    }
    oauth {
      _id
      name
      alias
      image
      description
      enabled
      url
      client
      user
      oAuthUrl
      wxappLogo
    }
  }
}
EOF;
}


class UpdateApplicationOAuthResponse
{

    /**
     * @var OAuthList
     */
    public $UpdateApplicationOAuth;
}

class UpdateApplicationOAuthParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     */
    public $oauth;

    /**
     * Optional
     *
     * @var string
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     */
    public $alias;

    /**
     * Optional
     *
     * @var OAuthListFieldsFormUpdateInput
     */
    public $fields;

    function createRequest()
    {
        return [
            "query" => self::UpdateApplicationOAuthDocument,
            "operationName" => "UpdateApplicationOAuth",
            "variables" => $this
        ];
    }

    const UpdateApplicationOAuthDocument = <<<EOF
mutation UpdateApplicationOAuth(\$client: String, \$oauth: String, \$user: String, \$alias: String, \$fields: [OAuthListFieldsFormUpdateInput]) {
  UpdateApplicationOAuth(client: \$client, oauth: \$oauth, user: \$user, alias: \$alias, fields: \$fields) {
    _id
    name
    alias
    image
    description
    enabled
    url
    client
    user
    oAuthUrl
    wxappLogo
    fields {
      label
      type
      placeholder
      value
      checked
    }
    oauth {
      _id
      name
      alias
      image
      description
      enabled
      url
      client
      user
      oAuthUrl
      wxappLogo
    }
  }
}
EOF;
}


class UpdateEmailProviderResponse
{

    /**
     * @var EmailProviderList
     */
    public $UpdateEmailProvider;
}

class UpdateEmailProviderParam
{

    /**
     * Optional
     *
     * @var EmailProviderListInput
     */
    public $options;

    function createRequest()
    {
        return [
            "query" => self::UpdateEmailProviderDocument,
            "operationName" => "UpdateEmailProvider",
            "variables" => $this
        ];
    }

    const UpdateEmailProviderDocument = <<<EOF
mutation UpdateEmailProvider(\$options: EmailProviderListInput) {
  UpdateEmailProvider(options: \$options) {
    _id
    name
    image
    description
    fields {
      label
      type
      placeholder
      help
      value
      options
    }
    client
    user
    status
    provider {
      _id
      name
      image
      description
      client
      user
      status
    }
  }
}
EOF;
}


class UpdateEmailTemplateResponse
{

    /**
     * @var EmailTemplate
     */
    public $UpdateEmailTemplate;
}

class UpdateEmailTemplateParam
{

    /**
     * Required
     *
     * @var EmailTemplateInput
     */
    public $options;

    function createRequest()
    {
        return [
            "query" => self::UpdateEmailTemplateDocument,
            "operationName" => "UpdateEmailTemplate",
            "variables" => $this
        ];
    }

    const UpdateEmailTemplateDocument = <<<EOF
mutation UpdateEmailTemplate(\$options: EmailTemplateInput!) {
  UpdateEmailTemplate(options: \$options) {
    _id
    type
    sender
    object
    hasURL
    URLExpireTime
    status
    redirectTo
    content
  }
}
EOF;
}


class UpdateEmailTemplateWithClientResponse
{

    /**
     * @var EmailProviderWithClientList
     */
    public $UpdateEmailTemplateWithClient;
}

class UpdateEmailTemplateWithClientParam
{

    /**
     * Required
     *
     * @var EmailTemplateWithClientInput
     */
    public $options;

    function createRequest()
    {
        return [
            "query" => self::UpdateEmailTemplateWithClientDocument,
            "operationName" => "UpdateEmailTemplateWithClient",
            "variables" => $this
        ];
    }

    const UpdateEmailTemplateWithClientDocument = <<<EOF
mutation UpdateEmailTemplateWithClient(\$options: EmailTemplateWithClientInput!) {
  UpdateEmailTemplateWithClient(options: \$options) {
    _id
    user
    client
    status
    fields {
      label
      type
      placeholder
      help
      value
      options
    }
    provider {
      _id
      name
      image
      description
    }
  }
}
EOF;
}


class UpdateLdapServerResponse
{

    /**
     * @var LDAPSingleServer
     */
    public $UpdateLDAPServer;
}

class UpdateLdapServerParam
{

    /**
     * Required
     *
     * @var string
     */
    public $ldapId;

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
    public $clientId;

    /**
     * Required
     *
     * @var string
     */
    public $userId;

    /**
     * Required
     *
     * @var string
     */
    public $ldapLink;

    /**
     * Required
     *
     * @var string
     */
    public $baseDN;

    /**
     * Required
     *
     * @var string
     */
    public $username;

    /**
     * Required
     *
     * @var string
     */
    public $searchStandard;

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
    public $emailPostfix;

    /**
     * Optional
     *
     * @var string
     */
    public $description;

    /**
     * Optional
     *
     * @var bool
     */
    public $enabled;

    function createRequest()
    {
        return [
            "query" => self::UpdateLdapServerDocument,
            "operationName" => "UpdateLDAPServer",
            "variables" => $this
        ];
    }

    const UpdateLdapServerDocument = <<<EOF
mutation UpdateLDAPServer(\$ldapId: String!, \$name: String!, \$clientId: String!, \$userId: String!, \$ldapLink: String!, \$baseDN: String!, \$username: String!, \$searchStandard: String!, \$password: String!, \$emailPostfix: String, \$description: String, \$enabled: Boolean) {
  UpdateLDAPServer(ldapId: \$ldapId, name: \$name, clientId: \$clientId, userId: \$userId, ldapLink: \$ldapLink, baseDN: \$baseDN, username: \$username, searchStandard: \$searchStandard, password: \$password, emailPostfix: \$emailPostfix, description: \$description, enabled: \$enabled) {
    _id
    name
    clientId
    userId
    ldapLink
    baseDN
    searchStandard
    emailPostfix
    username
    password
    description
    enabled
    isDeleted
    createdAt
    updatedAt
  }
}
EOF;
}


class UpdateOAuthListResponse
{

    /**
     * @var OAuthList
     */
    public $UpdateOAuthList;
}

class UpdateOAuthListParam
{

    /**
     * Optional
     *
     * @var OAuthListUpdateInput
     */
    public $options;

    /**
     * Optional
     *
     * @var OAuthListFieldsFormUpdateInput
     */
    public $fields;

    function createRequest()
    {
        return [
            "query" => self::UpdateOAuthListDocument,
            "operationName" => "UpdateOAuthList",
            "variables" => $this
        ];
    }

    const UpdateOAuthListDocument = <<<EOF
mutation UpdateOAuthList(\$options: OAuthListUpdateInput, \$fields: [OAuthListFieldsFormUpdateInput]) {
  UpdateOAuthList(options: \$options, fields: \$fields) {
    _id
    name
    alias
    image
    description
    enabled
    url
    client
    user
    oAuthUrl
    wxappLogo
    fields {
      label
      type
      placeholder
      value
      checked
    }
    oauth {
      _id
      name
      alias
      image
      description
      enabled
      url
      client
      user
      oAuthUrl
      wxappLogo
    }
  }
}
EOF;
}


class UpdateOAuthProviderResponse
{

    /**
     * @var OAuthProviderClient
     */
    public $UpdateOAuthProvider;
}

class UpdateOAuthProviderParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    /**
     * Optional
     *
     * @var string
     */
    public $domain;

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
    public $image;

    /**
     * Optional
     *
     * @var string
     */
    public $redirectUris;

    /**
     * Optional
     *
     * @var string
     */
    public $grants;

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
    public $homepageURL;

    /**
     * Optional
     *
     * @var string
     */
    public $css;

    /**
     * Optional
     *
     * @var int
     */
    public $casExpire;

    function createRequest()
    {
        return [
            "query" => self::UpdateOAuthProviderDocument,
            "operationName" => "UpdateOAuthProvider",
            "variables" => $this
        ];
    }

    const UpdateOAuthProviderDocument = <<<EOF
mutation UpdateOAuthProvider(\$appId: String!, \$domain: String, \$name: String, \$image: String, \$redirectUris: [String], \$grants: [String], \$description: String, \$homepageURL: String, \$css: String, \$casExpire: Int) {
  UpdateOAuthProvider(appId: \$appId, domain: \$domain, name: \$name, image: \$image, redirectUris: \$redirectUris, grants: \$grants, description: \$description, homepageURL: \$homepageURL, css: \$css, casExpire: \$casExpire) {
    _id
    name
    domain
    image
    redirectUris
    appSecret
    client_id
    clientId
    grants
    description
    homepageURL
    isDeleted
    when
    css
    loginUrl
    casExpire
  }
}
EOF;
}


class UpdateOidcAppResponse
{

    /**
     * @var OIDCProviderClient
     */
    public $UpdateOIDCApp;
}

class UpdateOidcAppParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    /**
     * Optional
     *
     * @var string
     */
    public $domain;

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
    public $image;

    /**
     * Optional
     *
     * @var string
     */
    public $redirect_uris;

    /**
     * Optional
     *
     * @var string
     */
    public $token_endpoint_auth_method;

    /**
     * Optional
     *
     * @var string
     */
    public $grant_types;

    /**
     * Optional
     *
     * @var string
     */
    public $response_types;

    /**
     * Optional
     *
     * @var string
     */
    public $id_token_signed_response_alg;

    /**
     * Optional
     *
     * @var string
     */
    public $id_token_encrypted_response_alg;

    /**
     * Optional
     *
     * @var string
     */
    public $id_token_encrypted_response_enc;

    /**
     * Optional
     *
     * @var string
     */
    public $userinfo_signed_response_alg;

    /**
     * Optional
     *
     * @var string
     */
    public $userinfo_encrypted_response_alg;

    /**
     * Optional
     *
     * @var string
     */
    public $userinfo_encrypted_response_enc;

    /**
     * Optional
     *
     * @var string
     */
    public $request_object_signing_alg;

    /**
     * Optional
     *
     * @var string
     */
    public $request_object_encryption_alg;

    /**
     * Optional
     *
     * @var string
     */
    public $request_object_encryption_enc;

    /**
     * Optional
     *
     * @var string
     */
    public $jwks_uri;

    /**
     * Optional
     *
     * @var string
     */
    public $_jwks_uri;

    /**
     * Optional
     *
     * @var string
     */
    public $custom_jwks;

    /**
     * Optional
     *
     * @var string
     */
    public $jwks;

    /**
     * Optional
     *
     * @var string
     */
    public $_jwks;

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
    public $homepageURL;

    /**
     * Optional
     *
     * @var string
     */
    public $css;

    /**
     * Optional
     *
     * @var string
     */
    public $authorization_code_expire;

    /**
     * Optional
     *
     * @var string
     */
    public $id_token_expire;

    /**
     * Optional
     *
     * @var string
     */
    public $access_token_expire;

    /**
     * Optional
     *
     * @var string
     */
    public $cas_expire;

    /**
     * Optional
     *
     * @var OidcProviderCustomStylesInput
     */
    public $customStyles;

    function createRequest()
    {
        return [
            "query" => self::UpdateOidcAppDocument,
            "operationName" => "UpdateOIDCApp",
            "variables" => $this
        ];
    }

    const UpdateOidcAppDocument = <<<EOF
mutation UpdateOIDCApp(\$appId: String!, \$domain: String, \$name: String, \$image: String, \$redirect_uris: [String], \$token_endpoint_auth_method: String, \$grant_types: [String], \$response_types: [String], \$id_token_signed_response_alg: String, \$id_token_encrypted_response_alg: String, \$id_token_encrypted_response_enc: String, \$userinfo_signed_response_alg: String, \$userinfo_encrypted_response_alg: String, \$userinfo_encrypted_response_enc: String, \$request_object_signing_alg: String, \$request_object_encryption_alg: String, \$request_object_encryption_enc: String, \$jwks_uri: String, \$_jwks_uri: String, \$custom_jwks: String, \$jwks: String, \$_jwks: String, \$description: String, \$homepageURL: String, \$css: String, \$authorization_code_expire: String, \$id_token_expire: String, \$access_token_expire: String, \$cas_expire: String, \$customStyles: OIDCProviderCustomStylesInput) {
  UpdateOIDCApp(appId: \$appId, domain: \$domain, name: \$name, image: \$image, redirect_uris: \$redirect_uris, token_endpoint_auth_method: \$token_endpoint_auth_method, grant_types: \$grant_types, response_types: \$response_types, id_token_signed_response_alg: \$id_token_signed_response_alg, id_token_encrypted_response_alg: \$id_token_encrypted_response_alg, id_token_encrypted_response_enc: \$id_token_encrypted_response_enc, userinfo_signed_response_alg: \$userinfo_signed_response_alg, userinfo_encrypted_response_alg: \$userinfo_encrypted_response_alg, userinfo_encrypted_response_enc: \$userinfo_encrypted_response_enc, request_object_signing_alg: \$request_object_signing_alg, request_object_encryption_alg: \$request_object_encryption_alg, request_object_encryption_enc: \$request_object_encryption_enc, jwks_uri: \$jwks_uri, _jwks_uri: \$_jwks_uri, custom_jwks: \$custom_jwks, jwks: \$jwks, _jwks: \$_jwks, description: \$description, homepageURL: \$homepageURL, css: \$css, authorization_code_expire: \$authorization_code_expire, id_token_expire: \$id_token_expire, access_token_expire: \$access_token_expire, cas_expire: \$cas_expire, customStyles: \$customStyles) {
    _id
    name
    domain
    image
    redirect_uris
    client_id
    client_secret
    token_endpoint_auth_method
    id_token_signed_response_alg
    id_token_encrypted_response_alg
    id_token_encrypted_response_enc
    userinfo_signed_response_alg
    userinfo_encrypted_response_alg
    userinfo_encrypted_response_enc
    request_object_signing_alg
    request_object_encryption_alg
    request_object_encryption_enc
    jwks_uri
    _jwks_uri
    custom_jwks
    jwks
    _jwks
    clientId
    grant_types
    response_types
    description
    homepageURL
    isDeleted
    isDefault
    when
    css
    authorization_code_expire
    id_token_expire
    access_token_expire
    cas_expire
    loginUrl
    customStyles {
      forceLogin
      hideQRCode
      hideUP
      hideUsername
      hideRegister
      hidePhone
      hideSocial
      hideClose
      hidePhonePassword
      defaultLoginMethod
    }
  }
}
EOF;
}


class UpdateSamlIdentityProviderResponse
{

    /**
     * @var SAMLIdentityProviderClient
     */
    public $UpdateSAMLIdentityProvider;
}

class UpdateSamlIdentityProviderParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

    /**
     * Optional
     *
     * @var string
     */
    public $domain;

    /**
     * Optional
     *
     * @var string
     */
    public $image;

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
    public $SPMetadata;

    /**
     * Optional
     *
     * @var string
     */
    public $attributeNameFormat;

    /**
     * Optional
     *
     * @var string
     */
    public $customAttributes;

    /**
     * Optional
     *
     * @var string
     */
    public $emailDomainTransformation;

    /**
     * Optional
     *
     * @var string
     */
    public $authnContextClassRef;

    /**
     * Optional
     *
     * @var string
     */
    public $IdPMetadata;

    /**
     * Optional
     *
     * @var string
     */
    public $assertionConsumerUrl;

    /**
     * Optional
     *
     * @var string
     */
    public $bindings;

    /**
     * Optional
     *
     * @var string
     */
    public $nameIds;

    /**
     * Optional
     *
     * @var string
     */
    public $attributes;

    /**
     * Optional
     *
     * @var bool
     */
    public $enableSignRes;

    /**
     * Optional
     *
     * @var string
     */
    public $resSignAlgorithm;

    /**
     * Optional
     *
     * @var string
     */
    public $resAbstractAlgorithm;

    /**
     * Optional
     *
     * @var string
     */
    public $resSignPublicKey;

    /**
     * Optional
     *
     * @var string
     */
    public $resSignPrivateKey;

    /**
     * Optional
     *
     * @var string
     */
    public $resSignPrivateKeyPass;

    /**
     * Optional
     *
     * @var bool
     */
    public $enableSignReq;

    /**
     * Optional
     *
     * @var string
     */
    public $reqSignPublicKey;

    /**
     * Optional
     *
     * @var bool
     */
    public $enableEncryptRes;

    /**
     * Optional
     *
     * @var string
     */
    public $resEncryptPublicKey;

    /**
     * Optional
     *
     * @var string
     */
    public $css;

    function createRequest()
    {
        return [
            "query" => self::UpdateSamlIdentityProviderDocument,
            "operationName" => "UpdateSAMLIdentityProvider",
            "variables" => $this
        ];
    }

    const UpdateSamlIdentityProviderDocument = <<<EOF
mutation UpdateSAMLIdentityProvider(\$appId: String!, \$clientId: String!, \$domain: String, \$image: String, \$name: String, \$description: String, \$SPMetadata: String, \$attributeNameFormat: String, \$customAttributes: String, \$emailDomainTransformation: String, \$authnContextClassRef: String, \$IdPMetadata: String, \$assertionConsumerUrl: String, \$bindings: [String], \$nameIds: [String], \$attributes: [String], \$enableSignRes: Boolean, \$resSignAlgorithm: String, \$resAbstractAlgorithm: String, \$resSignPublicKey: String, \$resSignPrivateKey: String, \$resSignPrivateKeyPass: String, \$enableSignReq: Boolean, \$reqSignPublicKey: String, \$enableEncryptRes: Boolean, \$resEncryptPublicKey: String, \$css: String) {
  UpdateSAMLIdentityProvider(appId: \$appId, clientId: \$clientId, domain: \$domain, image: \$image, name: \$name, description: \$description, SPMetadata: \$SPMetadata, attributeNameFormat: \$attributeNameFormat, customAttributes: \$customAttributes, emailDomainTransformation: \$emailDomainTransformation, authnContextClassRef: \$authnContextClassRef, IdPMetadata: \$IdPMetadata, assertionConsumerUrl: \$assertionConsumerUrl, bindings: \$bindings, nameIds: \$nameIds, attributes: \$attributes, enableSignRes: \$enableSignRes, resSignAlgorithm: \$resSignAlgorithm, resAbstractAlgorithm: \$resAbstractAlgorithm, resSignPublicKey: \$resSignPublicKey, resSignPrivateKey: \$resSignPrivateKey, resSignPrivateKeyPass: \$resSignPrivateKeyPass, enableSignReq: \$enableSignReq, reqSignPublicKey: \$reqSignPublicKey, enableEncryptRes: \$enableEncryptRes, resEncryptPublicKey: \$resEncryptPublicKey, css: \$css) {
    _id
    name
    domain
    image
    appSecret
    appId
    clientId
    description
    isDeleted
    enabled
    when
    SPMetadata
    attributeNameFormat
    customAttributes
    emailDomainTransformation
    authnContextClassRef
    IdPMetadata
    assertionConsumerUrl
    bindings
    nameIds
    attributes
    enableSignRes
    resSignAlgorithm
    resAbstractAlgorithm
    resSignPublicKey
    resSignPrivateKey
    resSignPrivateKeyPass
    enableSignReq
    reqSignPublicKey
    enableEncryptRes
    resEncryptPublicKey
    css
  }
}
EOF;
}


class UpdateSamlServiceProviderResponse
{

    /**
     * @var SAMLServiceProviderClient
     */
    public $UpdateSAMLServiceProvider;
}

class UpdateSamlServiceProviderParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

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
     * Required
     *
     * @var string
     */
    public $clientId;

    /**
     * Required
     *
     * @var string
     */
    public $redirectUrl;

    /**
     * Required
     *
     * @var string
     */
    public $loginUrl;

    /**
     * Required
     *
     * @var string
     */
    public $logoutUrl;

    /**
     * Required
     *
     * @var string
     */
    public $nameId;

    /**
     * Optional
     *
     * @var string
     */
    public $IdPEntityID;

    /**
     * Optional
     *
     * @var AssertionConsumeServiceInputType
     */
    public $assertionConsumeService;

    /**
     * Optional
     *
     * @var string
     */
    public $image;

    /**
     * Optional
     *
     * @var AssertionMapInputType
     */
    public $mappings;

    /**
     * Optional
     *
     * @var string
     */
    public $defaultIdPMapId;

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
    public $SPMetadata;

    /**
     * Optional
     *
     * @var string
     */
    public $IdPMetadata;

    /**
     * Optional
     *
     * @var bool
     */
    public $enableSignRes;

    /**
     * Optional
     *
     * @var string
     */
    public $resSignPublicKey;

    /**
     * Optional
     *
     * @var bool
     */
    public $hasResEncrypted;

    /**
     * Optional
     *
     * @var string
     */
    public $resEncryptAlgorithm;

    /**
     * Optional
     *
     * @var string
     */
    public $resAbstractAlgorithm;

    /**
     * Optional
     *
     * @var string
     */
    public $resDecryptPrivateKey;

    /**
     * Optional
     *
     * @var string
     */
    public $resDecryptPrivateKeyPass;

    /**
     * Optional
     *
     * @var string
     */
    public $resEncryptPublicKey;

    /**
     * Optional
     *
     * @var bool
     */
    public $enableSignReq;

    /**
     * Optional
     *
     * @var string
     */
    public $reqSignAlgorithm;

    /**
     * Optional
     *
     * @var string
     */
    public $reqAbstractAlgorithm;

    /**
     * Optional
     *
     * @var string
     */
    public $reqSignPrivateKey;

    /**
     * Optional
     *
     * @var string
     */
    public $reqSignPrivateKeyPass;

    /**
     * Optional
     *
     * @var string
     */
    public $reqSignPublicKey;

    function createRequest()
    {
        return [
            "query" => self::UpdateSamlServiceProviderDocument,
            "operationName" => "UpdateSAMLServiceProvider",
            "variables" => $this
        ];
    }

    const UpdateSamlServiceProviderDocument = <<<EOF
mutation UpdateSAMLServiceProvider(\$appId: String!, \$name: String!, \$domain: String!, \$clientId: String!, \$redirectUrl: String!, \$loginUrl: String!, \$logoutUrl: String!, \$nameId: String!, \$IdPEntityID: String, \$assertionConsumeService: [AssertionConsumeServiceInputType], \$image: String, \$mappings: AssertionMapInputType, \$defaultIdPMapId: String, \$description: String, \$SPMetadata: String, \$IdPMetadata: String, \$enableSignRes: Boolean, \$resSignPublicKey: String, \$hasResEncrypted: Boolean, \$resEncryptAlgorithm: String, \$resAbstractAlgorithm: String, \$resDecryptPrivateKey: String, \$resDecryptPrivateKeyPass: String, \$resEncryptPublicKey: String, \$enableSignReq: Boolean, \$reqSignAlgorithm: String, \$reqAbstractAlgorithm: String, \$reqSignPrivateKey: String, \$reqSignPrivateKeyPass: String, \$reqSignPublicKey: String) {
  UpdateSAMLServiceProvider(appId: \$appId, name: \$name, domain: \$domain, clientId: \$clientId, redirectUrl: \$redirectUrl, loginUrl: \$loginUrl, logoutUrl: \$logoutUrl, nameId: \$nameId, IdPEntityID: \$IdPEntityID, assertionConsumeService: \$assertionConsumeService, image: \$image, mappings: \$mappings, defaultIdPMapId: \$defaultIdPMapId, description: \$description, SPMetadata: \$SPMetadata, IdPMetadata: \$IdPMetadata, enableSignRes: \$enableSignRes, resSignPublicKey: \$resSignPublicKey, hasResEncrypted: \$hasResEncrypted, resEncryptAlgorithm: \$resEncryptAlgorithm, resAbstractAlgorithm: \$resAbstractAlgorithm, resDecryptPrivateKey: \$resDecryptPrivateKey, resDecryptPrivateKeyPass: \$resDecryptPrivateKeyPass, resEncryptPublicKey: \$resEncryptPublicKey, enableSignReq: \$enableSignReq, reqSignAlgorithm: \$reqSignAlgorithm, reqAbstractAlgorithm: \$reqAbstractAlgorithm, reqSignPrivateKey: \$reqSignPrivateKey, reqSignPrivateKeyPass: \$reqSignPrivateKeyPass, reqSignPublicKey: \$reqSignPublicKey) {
    _id
    name
    domain
    image
    appSecret
    defaultIdPMap {
      _id
      name
      image
      description
      isDeleted
    }
    defaultIdPMapId
    appId
    clientId
    description
    isDeleted
    enabled
    when
    SPMetadata
    IdPMetadata
    IdPEntityID
    assertionConsumeService {
      binding
      url
      isDefault
    }
    mappings {
      username
      nickname
      photo
      company
      providerName
      email
    }
    redirectUrl
    loginUrl
    logoutUrl
    nameId
    enableSignRes
    resSignPublicKey
    hasResEncrypted
    resEncryptAlgorithm
    resAbstractAlgorithm
    resDecryptPrivateKey
    resDecryptPrivateKeyPass
    resEncryptPublicKey
    enableSignReq
    reqSignAlgorithm
    reqAbstractAlgorithm
    reqSignPrivateKey
    reqSignPrivateKeyPass
    reqSignPublicKey
    SPUrl
  }
}
EOF;
}


class UpdateSystemPricingResponse
{

    /**
     * @var PricingList
     */
    public $UpdateSystemPricing;
}

class UpdateSystemPricingParam
{

    /**
     * Optional
     *
     * @var PricingFieldsInput
     */
    public $options;

    function createRequest()
    {
        return [
            "query" => self::UpdateSystemPricingDocument,
            "operationName" => "UpdateSystemPricing",
            "variables" => $this
        ];
    }

    const UpdateSystemPricingDocument = <<<EOF
mutation UpdateSystemPricing(\$options: PricingFieldsInput) {
  UpdateSystemPricing(options: \$options) {
    _id
    type
    startNumber
    freeNumber
    startPrice
    maxNumber
    d
    features
  }
}
EOF;
}


class UseDefaultEmailProviderResponse
{

    /**
     * @var bool
     */
    public $UseDefaultEmailProvider;
}

class UseDefaultEmailProviderParam
{

    /**
     * Required
     *
     * @var string
     */
    public $user;

    /**
     * Required
     *
     * @var string
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::UseDefaultEmailProviderDocument,
            "operationName" => "UseDefaultEmailProvider",
            "variables" => $this
        ];
    }

    const UseDefaultEmailProviderDocument = <<<EOF
mutation UseDefaultEmailProvider(\$user: String!, \$client: String!) {
  UseDefaultEmailProvider(user: \$user, client: \$client)
}
EOF;
}


class AddClientWebhookResponse
{

    /**
     * @var ClientWebhook
     */
    public $addClientWebhook;
}

class AddClientWebhookParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Required
     *
     * @var string
     */
    public $events;

    /**
     * Required
     *
     * @var string
     */
    public $url;

    /**
     * Required
     *
     * @var string
     */
    public $contentType;

    /**
     * Required
     *
     * @var bool
     */
    public $enable;

    /**
     * Optional
     *
     * @var string
     */
    public $secret;

    /**
     * Optional
     *
     * @var bool
     */
    public $isLastTimeSuccess;

    function createRequest()
    {
        return [
            "query" => self::AddClientWebhookDocument,
            "operationName" => "addClientWebhook",
            "variables" => $this
        ];
    }

    const AddClientWebhookDocument = <<<EOF
mutation addClientWebhook(\$client: String!, \$events: [String!]!, \$url: String!, \$contentType: String!, \$enable: Boolean!, \$secret: String, \$isLastTimeSuccess: Boolean) {
  addClientWebhook(client: \$client, events: \$events, url: \$url, contentType: \$contentType, enable: \$enable, secret: \$secret, isLastTimeSuccess: \$isLastTimeSuccess) {
    _id
    client
    events {
      name
      label
      description
    }
    url
    isLastTimeSuccess
    contentType
    secret
    enable
  }
}
EOF;
}


class AddCollaboratorResponse
{

    /**
     * @var Collaboration
     */
    public $addCollaborator;
}

class AddCollaboratorParam
{

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
    public $collaboratorUserId;

    /**
     * Required
     *
     * @var PermissionDescriptorsInputType
     */
    public $permissionDescriptors;

    function createRequest()
    {
        return [
            "query" => self::AddCollaboratorDocument,
            "operationName" => "addCollaborator",
            "variables" => $this
        ];
    }

    const AddCollaboratorDocument = <<<EOF
mutation addCollaborator(\$userPoolId: String!, \$collaboratorUserId: String!, \$permissionDescriptors: [PermissionDescriptorsInputType]!) {
  addCollaborator(userPoolId: \$userPoolId, collaboratorUserId: \$collaboratorUserId, permissionDescriptors: \$permissionDescriptors) {
    _id
  }
}
EOF;
}


class AddGroupMetadataResponse
{

    /**
     * @var GroupMetadata[]
     */
    public $addGroupMetadata;
}

class AddGroupMetadataParam
{

    /**
     * Required
     *
     * @var string
     */
    public $groupId;

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

    function createRequest()
    {
        return [
            "query" => self::AddGroupMetadataDocument,
            "operationName" => "addGroupMetadata",
            "variables" => $this
        ];
    }

    const AddGroupMetadataDocument = <<<EOF
mutation addGroupMetadata(\$groupId: String!, \$key: String!, \$value: String!) {
  addGroupMetadata(groupId: \$groupId, key: \$key, value: \$value) {
    key
    value
  }
}
EOF;
}


class AddOrgNodeResponse
{

    /**
     * @var Org
     */
    public $addOrgNode;
}

class AddOrgNodeParam
{

    /**
     * Required
     *
     * @var AddOrgNodeInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::AddOrgNodeDocument,
            "operationName" => "addOrgNode",
            "variables" => $this
        ];
    }

    const AddOrgNodeDocument = <<<EOF
mutation addOrgNode(\$input: AddOrgNodeInput!) {
  addOrgNode(input: \$input) {
    _id
    nodes {
      _id
      name
      description
      createdAt
      updatedAt
      children
      root
    }
  }
}
EOF;
}


class AddPermissionResponse
{

    /**
     * @var Permission
     */
    public $addPermission;
}

class AddPermissionParam
{

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

    function createRequest()
    {
        return [
            "query" => self::AddPermissionDocument,
            "operationName" => "addPermission",
            "variables" => $this
        ];
    }

    const AddPermissionDocument = <<<EOF
mutation addPermission(\$name: String!, \$description: String) {
  addPermission(name: \$name, description: \$description) {
    _id
    name
    affect
    description
  }
}
EOF;
}


class AddPermissionToRbacRoleResponse
{

    /**
     * @var RBACRole
     */
    public $addPermissionToRBACRole;
}

class AddPermissionToRbacRoleParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var AddPermissionToRbacRoleInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::AddPermissionToRbacRoleDocument,
            "operationName" => "addPermissionToRBACRole",
            "variables" => $this
        ];
    }

    const AddPermissionToRbacRoleDocument = <<<EOF
mutation addPermissionToRBACRole(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: AddPermissionToRBACRoleInput!) {
  addPermissionToRBACRole(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class AddPermissionToRbacRoleBatchResponse
{

    /**
     * @var RBACRole
     */
    public $addPermissionToRBACRoleBatch;
}

class AddPermissionToRbacRoleBatchParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Optional
     *
     * @var AddPermissionToRbacRoleBatchInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::AddPermissionToRbacRoleBatchDocument,
            "operationName" => "addPermissionToRBACRoleBatch",
            "variables" => $this
        ];
    }

    const AddPermissionToRbacRoleBatchDocument = <<<EOF
mutation addPermissionToRBACRoleBatch(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: AddPermissionToRBACRoleBatchInput) {
  addPermissionToRBACRoleBatch(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class AddRoleToRbacGroupResponse
{

    /**
     * @var RBACGroup
     */
    public $addRoleToRBACGroup;
}

class AddRoleToRbacGroupParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var AddRoleToRbacGroupInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::AddRoleToRbacGroupDocument,
            "operationName" => "addRoleToRBACGroup",
            "variables" => $this
        ];
    }

    const AddRoleToRbacGroupDocument = <<<EOF
mutation addRoleToRBACGroup(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: AddRoleToRBACGroupInput!) {
  addRoleToRBACGroup(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    roles {
      totalCount
    }
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class AddRoleToRbacGroupBatchResponse
{

    /**
     * @var RBACGroup
     */
    public $addRoleToRBACGroupBatch;
}

class AddRoleToRbacGroupBatchParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var AddRoleToRbacGroupBatchInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::AddRoleToRbacGroupBatchDocument,
            "operationName" => "addRoleToRBACGroupBatch",
            "variables" => $this
        ];
    }

    const AddRoleToRbacGroupBatchDocument = <<<EOF
mutation addRoleToRBACGroupBatch(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: AddRoleToRBACGroupBatchInput!) {
  addRoleToRBACGroupBatch(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    roles {
      totalCount
    }
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class AddSuperAdminUserResponse
{

    /**
     * @var UsersInGroupListItem
     */
    public $addSuperAdminUser;
}

class AddSuperAdminUserParam
{

    /**
     * Required
     *
     * @var SuperAdminUpdateInput
     */
    public $options;

    function createRequest()
    {
        return [
            "query" => self::AddSuperAdminUserDocument,
            "operationName" => "addSuperAdminUser",
            "variables" => $this
        ];
    }

    const AddSuperAdminUserDocument = <<<EOF
mutation addSuperAdminUser(\$options: SuperAdminUpdateInput!) {
  addSuperAdminUser(options: \$options) {
    email
    username
    _id
    upgrade
  }
}
EOF;
}


class AddToInvitationResponse
{

    /**
     * @var Invitation
     */
    public $addToInvitation;
}

class AddToInvitationParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     */
    public $phone;

    function createRequest()
    {
        return [
            "query" => self::AddToInvitationDocument,
            "operationName" => "addToInvitation",
            "variables" => $this
        ];
    }

    const AddToInvitationDocument = <<<EOF
mutation addToInvitation(\$client: String!, \$phone: String) {
  addToInvitation(client: \$client, phone: \$phone) {
    client
    phone
    isDeleted
    createdAt
    updatedAt
  }
}
EOF;
}


class AddUserToRbacGroupResponse
{

    /**
     * @var RBACGroup
     */
    public $addUserToRBACGroup;
}

class AddUserToRbacGroupParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var AddUserToRbacGroupInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::AddUserToRbacGroupDocument,
            "operationName" => "addUserToRBACGroup",
            "variables" => $this
        ];
    }

    const AddUserToRbacGroupDocument = <<<EOF
mutation addUserToRBACGroup(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: AddUserToRBACGroupInput!) {
  addUserToRBACGroup(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    roles {
      totalCount
    }
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class AddUserToRbacGroupBatchResponse
{

    /**
     * @var RBACGroup
     */
    public $addUserToRBACGroupBatch;
}

class AddUserToRbacGroupBatchParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var AddUserToRbacGroupBatchInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::AddUserToRbacGroupBatchDocument,
            "operationName" => "addUserToRBACGroupBatch",
            "variables" => $this
        ];
    }

    const AddUserToRbacGroupBatchDocument = <<<EOF
mutation addUserToRBACGroupBatch(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: AddUserToRBACGroupBatchInput!) {
  addUserToRBACGroupBatch(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    roles {
      totalCount
    }
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class AssignRbacRoleToUserResponse
{

    /**
     * @var RBACRole
     */
    public $assignRBACRoleToUser;
}

class AssignRbacRoleToUserParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var AssignUserToRbacRoleInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::AssignRbacRoleToUserDocument,
            "operationName" => "assignRBACRoleToUser",
            "variables" => $this
        ];
    }

    const AssignRbacRoleToUserDocument = <<<EOF
mutation assignRBACRoleToUser(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: AssignUserToRBACRoleInput!) {
  assignRBACRoleToUser(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class AssignRbacRoleToUserBatchResponse
{

    /**
     * @var RBACRole
     */
    public $assignRBACRoleToUserBatch;
}

class AssignRbacRoleToUserBatchParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var AssignUserToRbacRoleBatchInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::AssignRbacRoleToUserBatchDocument,
            "operationName" => "assignRBACRoleToUserBatch",
            "variables" => $this
        ];
    }

    const AssignRbacRoleToUserBatchDocument = <<<EOF
mutation assignRBACRoleToUserBatch(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: AssignUserToRBACRoleBatchInput!) {
  assignRBACRoleToUserBatch(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class AssignUserToRoleResponse
{

    /**
     * @var PagedUserGroup
     */
    public $assignUserToRole;
}

class AssignUserToRoleParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Required
     *
     * @var string
     */
    public $user;

    /**
     * Required
     *
     * @var string
     */
    public $group;

    function createRequest()
    {
        return [
            "query" => self::AssignUserToRoleDocument,
            "operationName" => "assignUserToRole",
            "variables" => $this
        ];
    }

    const AssignUserToRoleDocument = <<<EOF
mutation assignUserToRole(\$client: String!, \$user: String!, \$group: String!) {
  assignUserToRole(client: \$client, user: \$user, group: \$group) {
    list {
      _id
      createdAt
    }
    totalCount
  }
}
EOF;
}


class BindOtherOAuthResponse
{

    /**
     * @var UserOAuthBind
     */
    public $bindOtherOAuth;
}

class BindOtherOAuthParam
{

    /**
     * Required
     *
     * @var string
     */
    public $type;

    /**
     * Required
     *
     * @var string
     */
    public $unionid;

    /**
     * Required
     *
     * @var string
     */
    public $userInfo;

    /**
     * Optional
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     */
    public $user;

    function createRequest()
    {
        return [
            "query" => self::BindOtherOAuthDocument,
            "operationName" => "bindOtherOAuth",
            "variables" => $this
        ];
    }

    const BindOtherOAuthDocument = <<<EOF
mutation bindOtherOAuth(\$type: String!, \$unionid: String!, \$userInfo: String!, \$client: String, \$user: String) {
  bindOtherOAuth(type: \$type, unionid: \$unionid, userInfo: \$userInfo, client: \$client, user: \$user) {
    _id
    user
    client
    type
    unionid
    userInfo
    createdAt
  }
}
EOF;
}


class ChangeMfaResponse
{

    /**
     * @var MFA
     */
    public $changeMFA;
}

class ChangeMfaParam
{

    /**
     * Required
     *
     * @var bool
     */
    public $enable;

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
     * @var string
     */
    public $_id;

    /**
     * Optional
     *
     * @var bool
     */
    public $refreshKey;

    function createRequest()
    {
        return [
            "query" => self::ChangeMfaDocument,
            "operationName" => "changeMFA",
            "variables" => $this
        ];
    }

    const ChangeMfaDocument = <<<EOF
mutation changeMFA(\$enable: Boolean!, \$userId: String, \$userPoolId: String, \$_id: String, \$refreshKey: Boolean) {
  changeMFA(enable: \$enable, userId: \$userId, userPoolId: \$userPoolId, _id: \$_id, refreshKey: \$refreshKey) {
    _id
    userId
    userPoolId
    enable
    shareKey
  }
}
EOF;
}


class ChangePasswordResponse
{

    /**
     * @var ExtendUser
     */
    public $changePassword;
}

class ChangePasswordParam
{

    /**
     * Required
     *
     * @var string
     */
    public $password;

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
    public $client;

    /**
     * Required
     *
     * @var string
     */
    public $verifyCode;

    function createRequest()
    {
        return [
            "query" => self::ChangePasswordDocument,
            "operationName" => "changePassword",
            "variables" => $this
        ];
    }

    const ChangePasswordDocument = <<<EOF
mutation changePassword(\$password: String!, \$email: String!, \$client: String!, \$verifyCode: String!) {
  changePassword(password: \$password, email: \$email, client: \$client, verifyCode: \$verifyCode) {
    _id
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    username
    nickname
    company
    photo
    browser
    device
    password
    registerInClient
    registerMethod
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
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
    country
    updatedAt
    group {
      _id
      name
      descriptions
      client
      permissions
      createdAt
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userLocation {
      _id
      when
      where
    }
    userLoginHistory {
      totalCount
    }
    systemApplicationType {
      _id
      name
      descriptions
      price
    }
    thirdPartyIdentity {
      provider
      refreshToken
      accessToken
      expiresIn
      updatedAt
    }
    customData
    metadata
  }
}
EOF;
}


class CreateAdConnectorResponse
{

    /**
     * @var ADConnector
     */
    public $createAdConnector;
}

class CreateAdConnectorParam
{

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
    public $logo;

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    function createRequest()
    {
        return [
            "query" => self::CreateAdConnectorDocument,
            "operationName" => "createAdConnector",
            "variables" => $this
        ];
    }

    const CreateAdConnectorDocument = <<<EOF
mutation createAdConnector(\$name: String!, \$logo: String, \$userPoolId: String!) {
  createAdConnector(name: \$name, logo: \$logo, userPoolId: \$userPoolId) {
    _id
    name
    secret
    salt
    logo
    enabled
    userPoolId
    status
    createdAt
  }
}
EOF;
}


class CreateCustomMfaResponse
{

    /**
     * @var CustomMFA
     */
    public $createCustomMFA;
}

class CreateCustomMfaParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userIdInMiniLogin;

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
    public $name;

    /**
     * Required
     *
     * @var string
     */
    public $secret;

    /**
     * Optional
     *
     * @var string
     */
    public $remark;

    function createRequest()
    {
        return [
            "query" => self::CreateCustomMfaDocument,
            "operationName" => "createCustomMFA",
            "variables" => $this
        ];
    }

    const CreateCustomMfaDocument = <<<EOF
mutation createCustomMFA(\$userIdInMiniLogin: String!, \$userPoolId: String!, \$name: String!, \$secret: String!, \$remark: String) {
  createCustomMFA(userIdInMiniLogin: \$userIdInMiniLogin, userPoolId: \$userPoolId, name: \$name, secret: \$secret, remark: \$remark) {
    _id
    userIdInMiniLogin
    userPoolId {
      _id
      usersCount
      logo
      emailVerifiedDefault
      sendWelcomeEmail
      registerDisabled
      showWXMPQRCode
      useMiniLogin
      useSelfWxapp
      allowedOrigins
      name
      secret
      token
      descriptions
      jwtExpired
      createdAt
      isDeleted
      enableEmail
    }
    remark
    name
    secret
  }
}
EOF;
}


class CreateInterConnectionResponse
{

    /**
     * @var CommonMessage
     */
    public $createInterConnection;
}

class CreateInterConnectionParam
{

    /**
     * Required
     *
     * @var string
     */
    public $sourceUserPoolId;

    /**
     * Required
     *
     * @var string
     */
    public $sourceUserId;

    /**
     * Required
     *
     * @var string
     */
    public $targetUserPoolId;

    /**
     * Required
     *
     * @var string
     */
    public $targetUserId;

    /**
     * Required
     *
     * @var int
     */
    public $maxAge;

    function createRequest()
    {
        return [
            "query" => self::CreateInterConnectionDocument,
            "operationName" => "createInterConnection",
            "variables" => $this
        ];
    }

    const CreateInterConnectionDocument = <<<EOF
mutation createInterConnection(\$sourceUserPoolId: String!, \$sourceUserId: String!, \$targetUserPoolId: String!, \$targetUserId: String!, \$maxAge: Int!) {
  createInterConnection(sourceUserPoolId: \$sourceUserPoolId, sourceUserId: \$sourceUserId, targetUserId: \$targetUserId, targetUserPoolId: \$targetUserPoolId, maxAge: \$maxAge) {
    message
    code
    status
  }
}
EOF;
}


class CreateOrgResponse
{

    /**
     * @var Org
     */
    public $createOrg;
}

class CreateOrgParam
{

    /**
     * Required
     *
     * @var CreateOrgInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::CreateOrgDocument,
            "operationName" => "createOrg",
            "variables" => $this
        ];
    }

    const CreateOrgDocument = <<<EOF
mutation createOrg(\$input: CreateOrgInput!) {
  createOrg(input: \$input) {
    _id
    nodes {
      _id
      name
      description
      createdAt
      updatedAt
      children
      root
    }
  }
}
EOF;
}


class CreateRbacGroupResponse
{

    /**
     * @var RBACGroup
     */
    public $createRBACGroup;
}

class CreateRbacGroupParam
{

    /**
     * Required
     *
     * @var CreateRbacGroupInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::CreateRbacGroupDocument,
            "operationName" => "createRBACGroup",
            "variables" => $this
        ];
    }

    const CreateRbacGroupDocument = <<<EOF
mutation createRBACGroup(\$input: CreateRBACGroupInput!) {
  createRBACGroup(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
  }
}
EOF;
}


class CreateRbacPermissionResponse
{

    /**
     * @var RBACPermission
     */
    public $createRBACPermission;
}

class CreateRbacPermissionParam
{

    /**
     * Required
     *
     * @var CreateRbacPermissionInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::CreateRbacPermissionDocument,
            "operationName" => "createRBACPermission",
            "variables" => $this
        ];
    }

    const CreateRbacPermissionDocument = <<<EOF
mutation createRBACPermission(\$input: CreateRBACPermissionInput!) {
  createRBACPermission(input: \$input) {
    _id
    name
    userPoolId
    createdAt
    updatedAt
    description
  }
}
EOF;
}


class CreateRbacRoleResponse
{

    /**
     * @var RBACRole
     */
    public $createRBACRole;
}

class CreateRbacRoleParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var CreateRbacRoleInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::CreateRbacRoleDocument,
            "operationName" => "createRBACRole",
            "variables" => $this
        ];
    }

    const CreateRbacRoleDocument = <<<EOF
mutation createRBACRole(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: CreateRBACRoleInput!) {
  createRBACRole(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class CreateRoleResponse
{

    /**
     * @var Group
     */
    public $createRole;
}

class CreateRoleParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

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
    public $descriptions;

    function createRequest()
    {
        return [
            "query" => self::CreateRoleDocument,
            "operationName" => "createRole",
            "variables" => $this
        ];
    }

    const CreateRoleDocument = <<<EOF
mutation createRole(\$client: String!, \$name: String!, \$descriptions: String) {
  createRole(client: \$client, name: \$name, descriptions: \$descriptions) {
    _id
    name
    descriptions
    client
    permissions
    createdAt
  }
}
EOF;
}


class CreateRuleResponse
{

    /**
     * @var Rule
     */
    public $createRule;
}

class CreateRuleParam
{

    /**
     * Required
     *
     * @var CreateRuleInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::CreateRuleDocument,
            "operationName" => "createRule",
            "variables" => $this
        ];
    }

    const CreateRuleDocument = <<<EOF
mutation createRule(\$input: CreateRuleInput!) {
  createRule(input: \$input) {
    _id
    userPoolId
    name
    description
    type
    enabled
    faasUrl
    code
    order
    async
    createdAt
    updatedAt
  }
}
EOF;
}


class CreateUserResponse
{

    /**
     * @var ExtendUser
     */
    public $createUser;
}

class CreateUserParam
{

    /**
     * Required
     *
     * @var UserRegisterInput
     */
    public $userInfo;

    /**
     * Optional
     *
     * @var string
     */
    public $invitationCode;

    /**
     * Optional
     *
     * @var bool
     */
    public $keepPassword;

    function createRequest()
    {
        return [
            "query" => self::CreateUserDocument,
            "operationName" => "createUser",
            "variables" => $this
        ];
    }

    const CreateUserDocument = <<<EOF
mutation createUser(\$userInfo: UserRegisterInput!, \$invitationCode: String, \$keepPassword: Boolean) {
  createUser(userInfo: \$userInfo, invitationCode: \$invitationCode, keepPassword: \$keepPassword) {
    _id
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    username
    nickname
    company
    photo
    browser
    device
    password
    registerInClient
    registerMethod
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
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
    country
    updatedAt
    group {
      _id
      name
      descriptions
      client
      permissions
      createdAt
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userLocation {
      _id
      when
      where
    }
    userLoginHistory {
      totalCount
    }
    systemApplicationType {
      _id
      name
      descriptions
      price
    }
    thirdPartyIdentity {
      provider
      refreshToken
      accessToken
      expiresIn
      updatedAt
    }
    customData
    metadata
  }
}
EOF;
}


class CreateUserWithoutAuthenticationResponse
{

    /**
     * @var User
     */
    public $createUserWithoutAuthentication;
}

class CreateUserWithoutAuthenticationParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    /**
     * Required
     *
     * @var UserRegisterInput
     */
    public $userInfo;

    /**
     * Optional
     *
     * @var bool
     */
    public $forceLogin;

    function createRequest()
    {
        return [
            "query" => self::CreateUserWithoutAuthenticationDocument,
            "operationName" => "createUserWithoutAuthentication",
            "variables" => $this
        ];
    }

    const CreateUserWithoutAuthenticationDocument = <<<EOF
mutation createUserWithoutAuthentication(\$userPoolId: String!, \$userInfo: UserRegisterInput!, \$forceLogin: Boolean) {
  createUserWithoutAuthentication(userPoolId: \$userPoolId, userInfo: \$userInfo, forceLogin: \$forceLogin) {
    _id
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    username
    nickname
    company
    photo
    browser
    device
    password
    registerInClient
    registerMethod
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
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
    country
    updatedAt
    metadata
  }
}
EOF;
}


class DeleteClientWebhookResponse
{

    /**
     * @var ClientWebhook
     */
    public $deleteClientWebhook;
}

class DeleteClientWebhookParam
{

    /**
     * Required
     *
     * @var string
     */
    public $id;

    function createRequest()
    {
        return [
            "query" => self::DeleteClientWebhookDocument,
            "operationName" => "deleteClientWebhook",
            "variables" => $this
        ];
    }

    const DeleteClientWebhookDocument = <<<EOF
mutation deleteClientWebhook(\$id: String!) {
  deleteClientWebhook(id: \$id) {
    _id
    client
    events {
      name
      label
      description
    }
    url
    isLastTimeSuccess
    contentType
    secret
    enable
  }
}
EOF;
}


class DeleteOrgResponse
{

    /**
     * @var CommonMessage
     */
    public $deleteOrg;
}

class DeleteOrgParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::DeleteOrgDocument,
            "operationName" => "deleteOrg",
            "variables" => $this
        ];
    }

    const DeleteOrgDocument = <<<EOF
mutation deleteOrg(\$_id: String!) {
  deleteOrg(_id: \$_id) {
    message
    code
    status
  }
}
EOF;
}


class DeleteRbacGroupResponse
{

    /**
     * @var CommonMessage
     */
    public $deleteRBACGroup;
}

class DeleteRbacGroupParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::DeleteRbacGroupDocument,
            "operationName" => "deleteRBACGroup",
            "variables" => $this
        ];
    }

    const DeleteRbacGroupDocument = <<<EOF
mutation deleteRBACGroup(\$_id: String!) {
  deleteRBACGroup(_id: \$_id) {
    message
    code
    status
  }
}
EOF;
}


class DeleteRbacGroupBatchResponse
{

    /**
     * @var CommonMessage
     */
    public $deleteRBACGroupBatch;
}

class DeleteRbacGroupBatchParam
{

    /**
     * Required
     *
     * @var string
     */
    public $idList;

    function createRequest()
    {
        return [
            "query" => self::DeleteRbacGroupBatchDocument,
            "operationName" => "deleteRBACGroupBatch",
            "variables" => $this
        ];
    }

    const DeleteRbacGroupBatchDocument = <<<EOF
mutation deleteRBACGroupBatch(\$idList: [String!]!) {
  deleteRBACGroupBatch(idList: \$idList) {
    message
    code
    status
  }
}
EOF;
}


class DeleteRbacPermissionResponse
{

    /**
     * @var CommonMessage
     */
    public $deleteRBACPermission;
}

class DeleteRbacPermissionParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::DeleteRbacPermissionDocument,
            "operationName" => "deleteRBACPermission",
            "variables" => $this
        ];
    }

    const DeleteRbacPermissionDocument = <<<EOF
mutation deleteRBACPermission(\$_id: String!) {
  deleteRBACPermission(_id: \$_id) {
    message
    code
    status
  }
}
EOF;
}


class DeleteRbacPermissionBatchResponse
{

    /**
     * @var CommonMessage
     */
    public $deleteRBACPermissionBatch;
}

class DeleteRbacPermissionBatchParam
{

    /**
     * Required
     *
     * @var string
     */
    public $idList;

    function createRequest()
    {
        return [
            "query" => self::DeleteRbacPermissionBatchDocument,
            "operationName" => "deleteRBACPermissionBatch",
            "variables" => $this
        ];
    }

    const DeleteRbacPermissionBatchDocument = <<<EOF
mutation deleteRBACPermissionBatch(\$idList: [String!]!) {
  deleteRBACPermissionBatch(idList: \$idList) {
    message
    code
    status
  }
}
EOF;
}


class DeleteRbacRoleResponse
{

    /**
     * @var CommonMessage
     */
    public $deleteRBACRole;
}

class DeleteRbacRoleParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::DeleteRbacRoleDocument,
            "operationName" => "deleteRBACRole",
            "variables" => $this
        ];
    }

    const DeleteRbacRoleDocument = <<<EOF
mutation deleteRBACRole(\$_id: String!) {
  deleteRBACRole(_id: \$_id) {
    message
    code
    status
  }
}
EOF;
}


class DeleteRbacRoleBatchResponse
{

    /**
     * @var CommonMessage
     */
    public $deleteRBACRoleBatch;
}

class DeleteRbacRoleBatchParam
{

    /**
     * Required
     *
     * @var string
     */
    public $idList;

    function createRequest()
    {
        return [
            "query" => self::DeleteRbacRoleBatchDocument,
            "operationName" => "deleteRBACRoleBatch",
            "variables" => $this
        ];
    }

    const DeleteRbacRoleBatchDocument = <<<EOF
mutation deleteRBACRoleBatch(\$idList: [String!]!) {
  deleteRBACRoleBatch(idList: \$idList) {
    message
    code
    status
  }
}
EOF;
}


class DeleteRuleResponse
{

    /**
     * @var CommonMessage
     */
    public $deleteRule;
}

class DeleteRuleParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::DeleteRuleDocument,
            "operationName" => "deleteRule",
            "variables" => $this
        ];
    }

    const DeleteRuleDocument = <<<EOF
mutation deleteRule(\$_id: String!) {
  deleteRule(_id: \$_id) {
    message
    code
    status
  }
}
EOF;
}


class DisableAdConnectorResponse
{

    /**
     * @var bool
     */
    public $disableAdConnector;
}

class DisableAdConnectorParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::DisableAdConnectorDocument,
            "operationName" => "disableAdConnector",
            "variables" => $this
        ];
    }

    const DisableAdConnectorDocument = <<<EOF
mutation disableAdConnector(\$_id: String!) {
  disableAdConnector(_id: \$_id)
}
EOF;
}


class DisableAdConnectorForProviderResponse
{

    /**
     * @var bool
     */
    public $disableAdConnectorForProvider;
}

class DisableAdConnectorForProviderParam
{

    /**
     * Required
     *
     * @var string
     */
    public $providerId;

    /**
     * Required
     *
     * @var string
     */
    public $adConnectorId;

    function createRequest()
    {
        return [
            "query" => self::DisableAdConnectorForProviderDocument,
            "operationName" => "disableAdConnectorForProvider",
            "variables" => $this
        ];
    }

    const DisableAdConnectorForProviderDocument = <<<EOF
mutation disableAdConnectorForProvider(\$providerId: String!, \$adConnectorId: String!) {
  disableAdConnectorForProvider(providerId: \$providerId, adConnectorId: \$adConnectorId)
}
EOF;
}


class EnableAdConnectorResponse
{

    /**
     * @var bool
     */
    public $enableAdConnector;
}

class EnableAdConnectorParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::EnableAdConnectorDocument,
            "operationName" => "enableAdConnector",
            "variables" => $this
        ];
    }

    const EnableAdConnectorDocument = <<<EOF
mutation enableAdConnector(\$_id: String!) {
  enableAdConnector(_id: \$_id)
}
EOF;
}


class EnableAdConnectorForProviderResponse
{

    /**
     * @var bool
     */
    public $enableAdConnectorForProvider;
}

class EnableAdConnectorForProviderParam
{

    /**
     * Required
     *
     * @var ProviderType
     */
    public $providerType;

    /**
     * Required
     *
     * @var string
     */
    public $providerId;

    /**
     * Required
     *
     * @var string
     */
    public $adConnectorId;

    function createRequest()
    {
        return [
            "query" => self::EnableAdConnectorForProviderDocument,
            "operationName" => "enableAdConnectorForProvider",
            "variables" => $this
        ];
    }

    const EnableAdConnectorForProviderDocument = <<<EOF
mutation enableAdConnectorForProvider(\$providerType: providerType!, \$providerId: String!, \$adConnectorId: String!) {
  enableAdConnectorForProvider(providerType: \$providerType, providerId: \$providerId, adConnectorId: \$adConnectorId)
}
EOF;
}


class EnablePasswordFaasResponse
{

    /**
     * @var PaaswordFaas
     */
    public $enablePasswordFaas;
}

class EnablePasswordFaasParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Required
     *
     * @var bool
     */
    public $enable;

    function createRequest()
    {
        return [
            "query" => self::EnablePasswordFaasDocument,
            "operationName" => "enablePasswordFaas",
            "variables" => $this
        ];
    }

    const EnablePasswordFaasDocument = <<<EOF
mutation enablePasswordFaas(\$client: String!, \$enable: Boolean!) {
  enablePasswordFaas(client: \$client, enable: \$enable) {
    encryptUrl
    decryptUrl
    user
    client
    logs
    enable
    createdAt
    updatedAt
  }
}
EOF;
}


class EncryptPasswordResponse
{

    /**
     * @var EncryptPassword
     */
    public $encryptPassword;
}

class EncryptPasswordParam
{

    /**
     * Required
     *
     * @var string
     */
    public $password;

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var bool
     */
    public $isTest;

    function createRequest()
    {
        return [
            "query" => self::EncryptPasswordDocument,
            "operationName" => "encryptPassword",
            "variables" => $this
        ];
    }

    const EncryptPasswordDocument = <<<EOF
mutation encryptPassword(\$password: String!, \$client: String!, \$isTest: Boolean) {
  encryptPassword(password: \$password, client: \$client, isTest: \$isTest) {
    _id
    encryptUrl
    decryptUrl
    client
    user
    logs
    enable
    createdAt
    updatedAt
    password
  }
}
EOF;
}


class GenerateInvitationCodeResponse
{

    /**
     * @var InvitationCode
     */
    public $generateInvitationCode;
}

class GenerateInvitationCodeParam
{

    /**
     * Required
     *
     * @var string
     */
    public $user;

    /**
     * Required
     *
     * @var string
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::GenerateInvitationCodeDocument,
            "operationName" => "generateInvitationCode",
            "variables" => $this
        ];
    }

    const GenerateInvitationCodeDocument = <<<EOF
mutation generateInvitationCode(\$user: String!, \$client: String!) {
  generateInvitationCode(user: \$user, client: \$client) {
    _id
    user
    client
    code
    createdAt
  }
}
EOF;
}


class LoginResponse
{

    /**
     * @var ExtendUser
     */
    public $login;
}

class LoginParam
{

    /**
     * Required
     *
     * @var string
     */
    public $registerInClient;

    /**
     * Optional
     *
     * @var string
     */
    public $phone;

    /**
     * Optional
     *
     * @var int
     */
    public $phoneCode;

    /**
     * Optional
     *
     * @var string
     */
    public $unionid;

    /**
     * Optional
     *
     * @var string
     */
    public $openid;

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
    public $email;

    /**
     * Optional
     *
     * @var string
     */
    public $password;

    /**
     * Optional
     *
     * @var string
     */
    public $lastIP;

    /**
     * Optional
     *
     * @var string
     */
    public $verifyCode;

    /**
     * Optional
     *
     * @var string
     */
    public $MFACode;

    /**
     * Optional
     *
     * @var bool
     */
    public $fromRegister;

    /**
     * Optional
     *
     * @var string
     */
    public $device;

    /**
     * Optional
     *
     * @var string
     */
    public $browser;

    function createRequest()
    {
        return [
            "query" => self::LoginDocument,
            "operationName" => "login",
            "variables" => $this
        ];
    }

    const LoginDocument = <<<EOF
mutation login(\$registerInClient: String!, \$phone: String, \$phoneCode: Int, \$unionid: String, \$openid: String, \$username: String, \$email: String, \$password: String, \$lastIP: String, \$verifyCode: String, \$MFACode: String, \$fromRegister: Boolean, \$device: String, \$browser: String) {
  login(registerInClient: \$registerInClient, phone: \$phone, phoneCode: \$phoneCode, unionid: \$unionid, openid: \$openid, username: \$username, email: \$email, password: \$password, lastIP: \$lastIP, verifyCode: \$verifyCode, MFACode: \$MFACode, fromRegister: \$fromRegister, device: \$device, browser: \$browser) {
    _id
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    username
    nickname
    company
    photo
    browser
    device
    password
    registerInClient
    registerMethod
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
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
    country
    updatedAt
    group {
      _id
      name
      descriptions
      client
      permissions
      createdAt
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userLocation {
      _id
      when
      where
    }
    userLoginHistory {
      totalCount
    }
    systemApplicationType {
      _id
      name
      descriptions
      price
    }
    thirdPartyIdentity {
      provider
      refreshToken
      accessToken
      expiresIn
      updatedAt
    }
    customData
    metadata
  }
}
EOF;
}


class LoginByAdResponse
{

    /**
     * @var User
     */
    public $loginByAd;
}

class LoginByAdParam
{

    /**
     * Required
     *
     * @var string
     */
    public $adConnectorId;

    /**
     * Required
     *
     * @var string
     */
    public $username;

    /**
     * Required
     *
     * @var string
     */
    public $password;

    function createRequest()
    {
        return [
            "query" => self::LoginByAdDocument,
            "operationName" => "loginByAd",
            "variables" => $this
        ];
    }

    const LoginByAdDocument = <<<EOF
mutation loginByAd(\$adConnectorId: String!, \$username: String!, \$password: String!) {
  loginByAd(adConnectorId: \$adConnectorId, username: \$username, password: \$password) {
    _id
    username
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    nickname
    company
    photo
    browser
    password
    registerInClient
    registerMethod
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
    country
    updatedAt
    thirdPartyIdentity {
      provider
      refreshToken
      accessToken
      expiresIn
      updatedAt
    }
    oldPassword
    metadata
  }
}
EOF;
}


class LoginByEmailResponse
{

    /**
     * @var ExtendUser
     */
    public $loginByEmail;
}

class LoginByEmailParam
{

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

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
    public $password;

    function createRequest()
    {
        return [
            "query" => self::LoginByEmailDocument,
            "operationName" => "loginByEmail",
            "variables" => $this
        ];
    }

    const LoginByEmailDocument = <<<EOF
mutation loginByEmail(\$clientId: String!, \$email: String, \$password: String) {
  login(registerInClient: \$clientId, email: \$email, password: \$password) {
    _id
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    username
    nickname
    company
    photo
    browser
    device
    password
    registerInClient
    registerMethod
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
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
    country
    updatedAt
    group {
      _id
      name
      descriptions
      client
      permissions
      createdAt
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userLocation {
      _id
      when
      where
    }
    userLoginHistory {
      totalCount
    }
    systemApplicationType {
      _id
      name
      descriptions
      price
    }
    thirdPartyIdentity {
      provider
      refreshToken
      accessToken
      expiresIn
      updatedAt
    }
    customData
    metadata
  }
}
EOF;
}


class LoginByPhoneCodeResponse
{

    /**
     * @var ExtendUser
     */
    public $loginByPhoneCode;
}

class LoginByPhoneCodeParam
{

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

    /**
     * Optional
     *
     * @var string
     */
    public $phone;

    /**
     * Optional
     *
     * @var int
     */
    public $phoneCode;

    function createRequest()
    {
        return [
            "query" => self::LoginByPhoneCodeDocument,
            "operationName" => "loginByPhoneCode",
            "variables" => $this
        ];
    }

    const LoginByPhoneCodeDocument = <<<EOF
mutation loginByPhoneCode(\$clientId: String!, \$phone: String, \$phoneCode: Int) {
  login(registerInClient: \$clientId, phone: \$phone, phoneCode: \$phoneCode) {
    _id
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    username
    nickname
    company
    photo
    browser
    device
    password
    registerInClient
    registerMethod
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
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
    country
    updatedAt
    group {
      _id
      name
      descriptions
      client
      permissions
      createdAt
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userLocation {
      _id
      when
      where
    }
    userLoginHistory {
      totalCount
    }
    systemApplicationType {
      _id
      name
      descriptions
      price
    }
    thirdPartyIdentity {
      provider
      refreshToken
      accessToken
      expiresIn
      updatedAt
    }
    customData
    metadata
  }
}
EOF;
}


class LoginByPhonePasswordResponse
{

    /**
     * @var ExtendUser
     */
    public $loginByPhonePassword;
}

class LoginByPhonePasswordParam
{

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

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
    public $password;

    function createRequest()
    {
        return [
            "query" => self::LoginByPhonePasswordDocument,
            "operationName" => "loginByPhonePassword",
            "variables" => $this
        ];
    }

    const LoginByPhonePasswordDocument = <<<EOF
mutation loginByPhonePassword(\$clientId: String!, \$phone: String, \$password: String) {
  login(registerInClient: \$clientId, phone: \$phone, password: \$password) {
    _id
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    username
    nickname
    company
    photo
    browser
    device
    password
    registerInClient
    registerMethod
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
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
    country
    updatedAt
    group {
      _id
      name
      descriptions
      client
      permissions
      createdAt
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userLocation {
      _id
      when
      where
    }
    userLoginHistory {
      totalCount
    }
    systemApplicationType {
      _id
      name
      descriptions
      price
    }
    thirdPartyIdentity {
      provider
      refreshToken
      accessToken
      expiresIn
      updatedAt
    }
    customData
    metadata
  }
}
EOF;
}


class LoginByUsernameResponse
{

    /**
     * @var ExtendUser
     */
    public $loginByUsername;
}

class LoginByUsernameParam
{

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

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
    public $password;

    function createRequest()
    {
        return [
            "query" => self::LoginByUsernameDocument,
            "operationName" => "loginByUsername",
            "variables" => $this
        ];
    }

    const LoginByUsernameDocument = <<<EOF
mutation loginByUsername(\$clientId: String!, \$username: String, \$password: String) {
  login(registerInClient: \$clientId, username: \$username, password: \$password) {
    _id
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    username
    nickname
    company
    photo
    browser
    device
    password
    registerInClient
    registerMethod
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
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
    country
    updatedAt
    group {
      _id
      name
      descriptions
      client
      permissions
      createdAt
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userLocation {
      _id
      when
      where
    }
    userLoginHistory {
      totalCount
    }
    systemApplicationType {
      _id
      name
      descriptions
      price
    }
    thirdPartyIdentity {
      provider
      refreshToken
      accessToken
      expiresIn
      updatedAt
    }
    customData
    metadata
  }
}
EOF;
}


class NewClientResponse
{

    /**
     * @var UserClient
     */
    public $newClient;
}

class NewClientParam
{

    /**
     * Required
     *
     * @var NewUserClientInput
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::NewClientDocument,
            "operationName" => "newClient",
            "variables" => $this
        ];
    }

    const NewClientDocument = <<<EOF
mutation newClient(\$client: NewUserClientInput!) {
  newClient(client: \$client) {
    _id
    user {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userPoolTypes {
      _id
      name
      description
      image
      example
    }
    usersCount
    logo
    emailVerifiedDefault
    sendWelcomeEmail
    registerDisabled
    showWXMPQRCode
    useMiniLogin
    useSelfWxapp
    allowedOrigins
    name
    secret
    token
    descriptions
    jwtExpired
    createdAt
    isDeleted
    frequentRegisterCheck {
      timeInterval
      limit
      enable
    }
    loginFailCheck {
      timeInterval
      limit
      enable
    }
    enableEmail
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
  }
}
EOF;
}


class OauthPasswordLoginResponse
{

    /**
     * @var ExtendUser
     */
    public $oauthPasswordLogin;
}

class OauthPasswordLoginParam
{

    /**
     * Required
     *
     * @var string
     */
    public $registerInClient;

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
    public $unionid;

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
    public $password;

    /**
     * Optional
     *
     * @var string
     */
    public $lastIP;

    /**
     * Optional
     *
     * @var string
     */
    public $verifyCode;

    function createRequest()
    {
        return [
            "query" => self::OauthPasswordLoginDocument,
            "operationName" => "oauthPasswordLogin",
            "variables" => $this
        ];
    }

    const OauthPasswordLoginDocument = <<<EOF
mutation oauthPasswordLogin(\$registerInClient: String!, \$phone: String, \$unionid: String, \$email: String, \$password: String, \$lastIP: String, \$verifyCode: String) {
  oauthPasswordLogin(registerInClient: \$registerInClient, phone: \$phone, unionid: \$unionid, email: \$email, password: \$password, lastIP: \$lastIP, verifyCode: \$verifyCode) {
    _id
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    username
    nickname
    company
    photo
    browser
    device
    password
    registerInClient
    registerMethod
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
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
    country
    updatedAt
    group {
      _id
      name
      descriptions
      client
      permissions
      createdAt
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userLocation {
      _id
      when
      where
    }
    userLoginHistory {
      totalCount
    }
    systemApplicationType {
      _id
      name
      descriptions
      price
    }
    thirdPartyIdentity {
      provider
      refreshToken
      accessToken
      expiresIn
      updatedAt
    }
    customData
    metadata
  }
}
EOF;
}


class OrderResponse
{

    /**
     * @var OrderSuccess
     */
    public $order;
}

class OrderParam
{

    /**
     * Required
     *
     * @var OrderAddInput
     */
    public $options;

    function createRequest()
    {
        return [
            "query" => self::OrderDocument,
            "operationName" => "order",
            "variables" => $this
        ];
    }

    const OrderDocument = <<<EOF
mutation order(\$options: OrderAddInput!) {
  order(options: \$options) {
    code
    url
    charge
  }
}
EOF;
}


class PasswordLessForceLoginResponse
{

    /**
     * @var User
     */
    public $passwordLessForceLogin;
}

class PasswordLessForceLoginParam
{

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
    public $userId;

    function createRequest()
    {
        return [
            "query" => self::PasswordLessForceLoginDocument,
            "operationName" => "passwordLessForceLogin",
            "variables" => $this
        ];
    }

    const PasswordLessForceLoginDocument = <<<EOF
mutation passwordLessForceLogin(\$userPoolId: String!, \$userId: String!) {
  passwordLessForceLogin(userPoolId: \$userPoolId, userId: \$userId) {
    _id
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    username
    nickname
    company
    photo
    browser
    device
    password
    registerInClient
    registerMethod
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
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
    country
    updatedAt
    metadata
  }
}
EOF;
}


class RecordAuthAuditResponse
{

    /**
     * @var CommonMessage
     */
    public $recordAuthAudit;
}

class RecordAuthAuditParam
{

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
    public $appType;

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    /**
     * Required
     *
     * @var string
     */
    public $userId;

    /**
     * Required
     *
     * @var string
     */
    public $event;

    /**
     * Optional
     *
     * @var string
     */
    public $message;

    function createRequest()
    {
        return [
            "query" => self::RecordAuthAuditDocument,
            "operationName" => "recordAuthAudit",
            "variables" => $this
        ];
    }

    const RecordAuthAuditDocument = <<<EOF
mutation recordAuthAudit(\$userPoolId: String!, \$appType: String!, \$appId: String!, \$userId: String!, \$event: String!, \$message: String) {
  recordAuthAudit(userPoolId: \$userPoolId, appType: \$appType, appId: \$appId, userId: \$userId, event: \$event, message: \$message) {
    message
    code
    status
  }
}
EOF;
}


class RecordRequestResponse
{

    /**
     * @var CommonMessage
     */
    public $recordRequest;
}

class RecordRequestParam
{

    /**
     * Required
     *
     * @var string
     */
    public $when;

    /**
     * Required
     *
     * @var string
     */
    public $ip;

    /**
     * Required
     *
     * @var int
     */
    public $responseTime;

    /**
     * Required
     *
     * @var int
     */
    public $size;

    /**
     * Optional
     *
     * @var string
     */
    public $from;

    function createRequest()
    {
        return [
            "query" => self::RecordRequestDocument,
            "operationName" => "recordRequest",
            "variables" => $this
        ];
    }

    const RecordRequestDocument = <<<EOF
mutation recordRequest(\$when: String!, \$ip: String!, \$responseTime: Int!, \$size: Int!, \$from: String) {
  recordRequest(when: \$when, ip: \$ip, responseTime: \$responseTime, size: \$size, from: \$from) {
    message
    code
    status
  }
}
EOF;
}


class RefreshAdConnectorSecretResponse
{

    /**
     * @var ADConnector
     */
    public $refreshAdConnectorSecret;
}

class RefreshAdConnectorSecretParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::RefreshAdConnectorSecretDocument,
            "operationName" => "refreshAdConnectorSecret",
            "variables" => $this
        ];
    }

    const RefreshAdConnectorSecretDocument = <<<EOF
mutation refreshAdConnectorSecret(\$_id: String) {
  refreshAdConnectorSecret(_id: \$_id) {
    _id
    name
    secret
    salt
    logo
    enabled
    userPoolId
    status
    createdAt
  }
}
EOF;
}


class RefreshAppSecretResponse
{

    /**
     * @var UserClient
     */
    public $refreshAppSecret;
}

class RefreshAppSecretParam
{

    /**
     * Required
     *
     * @var UpdateUserClientInput
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::RefreshAppSecretDocument,
            "operationName" => "refreshAppSecret",
            "variables" => $this
        ];
    }

    const RefreshAppSecretDocument = <<<EOF
mutation refreshAppSecret(\$client: UpdateUserClientInput!) {
  refreshAppSecret(client: \$client) {
    _id
    user {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userPoolTypes {
      _id
      name
      description
      image
      example
    }
    usersCount
    logo
    emailVerifiedDefault
    sendWelcomeEmail
    registerDisabled
    showWXMPQRCode
    useMiniLogin
    useSelfWxapp
    allowedOrigins
    name
    secret
    token
    descriptions
    jwtExpired
    createdAt
    isDeleted
    frequentRegisterCheck {
      timeInterval
      limit
      enable
    }
    loginFailCheck {
      timeInterval
      limit
      enable
    }
    enableEmail
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
  }
}
EOF;
}


class RefreshSignInTokenResponse
{

    /**
     * @var RefreshedSignInToken
     */
    public $refreshSignInToken;
}

class RefreshSignInTokenParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $oidcAppId;

    /**
     * Optional
     *
     * @var string
     */
    public $userPoolId;

    /**
     * Required
     *
     * @var string
     */
    public $refreshToken;

    function createRequest()
    {
        return [
            "query" => self::RefreshSignInTokenDocument,
            "operationName" => "refreshSignInToken",
            "variables" => $this
        ];
    }

    const RefreshSignInTokenDocument = <<<EOF
mutation refreshSignInToken(\$oidcAppId: String, \$userPoolId: String, \$refreshToken: String!) {
  refreshSignInToken(oidcAppId: \$oidcAppId, userPoolId: \$userPoolId, refreshToken: \$refreshToken) {
    access_token
    id_token
    refresh_token
    scope
    expires_in
  }
}
EOF;
}


class RefreshThirdPartyTokenResponse
{

    /**
     * @var RefreshThirdPartyIdentityResult
     */
    public $refreshThirdPartyToken;
}

class RefreshThirdPartyTokenParam
{

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
    public $userId;

    function createRequest()
    {
        return [
            "query" => self::RefreshThirdPartyTokenDocument,
            "operationName" => "refreshThirdPartyToken",
            "variables" => $this
        ];
    }

    const RefreshThirdPartyTokenDocument = <<<EOF
mutation refreshThirdPartyToken(\$userPoolId: String!, \$userId: String!) {
  refreshThirdPartyToken(userPoolId: \$userPoolId, userId: \$userId) {
    refreshSuccess
    message
    provider
    refreshToken
    accessToken
    updatedAt
  }
}
EOF;
}


class RefreshTokenResponse
{

    /**
     * @var RefreshToken
     */
    public $refreshToken;
}

class RefreshTokenParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Required
     *
     * @var string
     */
    public $user;

    function createRequest()
    {
        return [
            "query" => self::RefreshTokenDocument,
            "operationName" => "refreshToken",
            "variables" => $this
        ];
    }

    const RefreshTokenDocument = <<<EOF
mutation refreshToken(\$client: String!, \$user: String!) {
  refreshToken(client: \$client, user: \$user) {
    token
    iat
    exp
  }
}
EOF;
}


class RegisterResponse
{

    /**
     * @var ExtendUser
     */
    public $register;
}

class RegisterParam
{

    /**
     * Required
     *
     * @var UserRegisterInput
     */
    public $userInfo;

    /**
     * Optional
     *
     * @var string
     */
    public $invitationCode;

    /**
     * Optional
     *
     * @var bool
     */
    public $keepPassword;

    function createRequest()
    {
        return [
            "query" => self::RegisterDocument,
            "operationName" => "register",
            "variables" => $this
        ];
    }

    const RegisterDocument = <<<EOF
mutation register(\$userInfo: UserRegisterInput!, \$invitationCode: String, \$keepPassword: Boolean) {
  register(userInfo: \$userInfo, invitationCode: \$invitationCode, keepPassword: \$keepPassword) {
    _id
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    username
    nickname
    company
    photo
    browser
    device
    password
    registerInClient
    registerMethod
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
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
    country
    updatedAt
    metadata
  }
}
EOF;
}


class RemoveAdConnectorResponse
{

    /**
     * @var bool
     */
    public $removeAdConnector;
}

class RemoveAdConnectorParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::RemoveAdConnectorDocument,
            "operationName" => "removeAdConnector",
            "variables" => $this
        ];
    }

    const RemoveAdConnectorDocument = <<<EOF
mutation removeAdConnector(\$_id: String!) {
  removeAdConnector(_id: \$_id)
}
EOF;
}


class RemoveCollaboratorResponse
{

    /**
     * @var Collaboration
     */
    public $removeCollaborator;
}

class RemoveCollaboratorParam
{

    /**
     * Required
     *
     * @var string
     */
    public $collaborationId;

    function createRequest()
    {
        return [
            "query" => self::RemoveCollaboratorDocument,
            "operationName" => "removeCollaborator",
            "variables" => $this
        ];
    }

    const RemoveCollaboratorDocument = <<<EOF
mutation removeCollaborator(\$collaborationId: String!) {
  removeCollaborator(collaborationId: \$collaborationId) {
    _id
    createdAt
    owner {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    collaborator {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    userPool {
      _id
      usersCount
      logo
      emailVerifiedDefault
      sendWelcomeEmail
      registerDisabled
      showWXMPQRCode
      useMiniLogin
      useSelfWxapp
      allowedOrigins
      name
      secret
      token
      descriptions
      jwtExpired
      createdAt
      isDeleted
      enableEmail
    }
    permissionDescriptors {
      permissionId
      name
      operationAllow
    }
  }
}
EOF;
}


class RemoveCustomMfaResponse
{

    /**
     * @var CustomMFA
     */
    public $removeCustomMFA;
}

class RemoveCustomMfaParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::RemoveCustomMfaDocument,
            "operationName" => "removeCustomMFA",
            "variables" => $this
        ];
    }

    const RemoveCustomMfaDocument = <<<EOF
mutation removeCustomMFA(\$_id: String!) {
  removeCustomMFA(_id: \$_id) {
    _id
    userIdInMiniLogin
    userPoolId {
      _id
      usersCount
      logo
      emailVerifiedDefault
      sendWelcomeEmail
      registerDisabled
      showWXMPQRCode
      useMiniLogin
      useSelfWxapp
      allowedOrigins
      name
      secret
      token
      descriptions
      jwtExpired
      createdAt
      isDeleted
      enableEmail
    }
    remark
    name
    secret
  }
}
EOF;
}


class RemoveFromInvitationResponse
{

    /**
     * @var Invitation
     */
    public $removeFromInvitation;
}

class RemoveFromInvitationParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     */
    public $phone;

    function createRequest()
    {
        return [
            "query" => self::RemoveFromInvitationDocument,
            "operationName" => "removeFromInvitation",
            "variables" => $this
        ];
    }

    const RemoveFromInvitationDocument = <<<EOF
mutation removeFromInvitation(\$client: String!, \$phone: String) {
  removeFromInvitation(client: \$client, phone: \$phone) {
    client
    phone
    isDeleted
    createdAt
    updatedAt
  }
}
EOF;
}


class RemoveOrgNodeResponse
{

    /**
     * @var Org
     */
    public $removeOrgNode;
}

class RemoveOrgNodeParam
{

    /**
     * Required
     *
     * @var RemoveOrgNodeInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::RemoveOrgNodeDocument,
            "operationName" => "removeOrgNode",
            "variables" => $this
        ];
    }

    const RemoveOrgNodeDocument = <<<EOF
mutation removeOrgNode(\$input: RemoveOrgNodeInput!) {
  removeOrgNode(input: \$input) {
    _id
    nodes {
      _id
      name
      description
      createdAt
      updatedAt
      children
      root
    }
  }
}
EOF;
}


class RemovePermissionFromRbacRoleResponse
{

    /**
     * @var RBACRole
     */
    public $removePermissionFromRBACRole;
}

class RemovePermissionFromRbacRoleParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var RemovePermissionFromRbacRoleInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::RemovePermissionFromRbacRoleDocument,
            "operationName" => "removePermissionFromRBACRole",
            "variables" => $this
        ];
    }

    const RemovePermissionFromRbacRoleDocument = <<<EOF
mutation removePermissionFromRBACRole(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: RemovePermissionFromRBACRoleInput!) {
  removePermissionFromRBACRole(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class RemovePermissionFromRbacRoleBatchResponse
{

    /**
     * @var RBACRole
     */
    public $removePermissionFromRBACRoleBatch;
}

class RemovePermissionFromRbacRoleBatchParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var RemovePermissionFromRbacRoleBatchInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::RemovePermissionFromRbacRoleBatchDocument,
            "operationName" => "removePermissionFromRBACRoleBatch",
            "variables" => $this
        ];
    }

    const RemovePermissionFromRbacRoleBatchDocument = <<<EOF
mutation removePermissionFromRBACRoleBatch(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: RemovePermissionFromRBACRoleBatchInput!) {
  removePermissionFromRBACRoleBatch(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class RemoveRoleFromRbacGroupResponse
{

    /**
     * @var RBACGroup
     */
    public $removeRoleFromRBACGroup;
}

class RemoveRoleFromRbacGroupParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var RemoveRoleFromRbacGroupInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::RemoveRoleFromRbacGroupDocument,
            "operationName" => "removeRoleFromRBACGroup",
            "variables" => $this
        ];
    }

    const RemoveRoleFromRbacGroupDocument = <<<EOF
mutation removeRoleFromRBACGroup(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: RemoveRoleFromRBACGroupInput!) {
  removeRoleFromRBACGroup(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    roles {
      totalCount
    }
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class RemoveRoleFromRbacGroupBatchResponse
{

    /**
     * @var RBACGroup
     */
    public $removeRoleFromRBACGroupBatch;
}

class RemoveRoleFromRbacGroupBatchParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var RemoveRoleFromRbacGroupBatchInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::RemoveRoleFromRbacGroupBatchDocument,
            "operationName" => "removeRoleFromRBACGroupBatch",
            "variables" => $this
        ];
    }

    const RemoveRoleFromRbacGroupBatchDocument = <<<EOF
mutation removeRoleFromRBACGroupBatch(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: RemoveRoleFromRBACGroupBatchInput!) {
  removeRoleFromRBACGroupBatch(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    roles {
      totalCount
    }
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class RemoveRuleEnvResponse
{

    /**
     * @var PagedRuleEnvVariable
     */
    public $removeRuleEnv;
}

class RemoveRuleEnvParam
{

    /**
     * Required
     *
     * @var RemoveRuleEnvInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::RemoveRuleEnvDocument,
            "operationName" => "removeRuleEnv",
            "variables" => $this
        ];
    }

    const RemoveRuleEnvDocument = <<<EOF
mutation removeRuleEnv(\$input: RemoveRuleEnvInput!) {
  removeRuleEnv(input: \$input) {
    totalCount
    list {
      key
      value
    }
  }
}
EOF;
}


class RemoveSuperAdminUserResponse
{

    /**
     * @var UsersInGroupListItem
     */
    public $removeSuperAdminUser;
}

class RemoveSuperAdminUserParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    /**
     * Required
     *
     * @var string
     */
    public $username;

    function createRequest()
    {
        return [
            "query" => self::RemoveSuperAdminUserDocument,
            "operationName" => "removeSuperAdminUser",
            "variables" => $this
        ];
    }

    const RemoveSuperAdminUserDocument = <<<EOF
mutation removeSuperAdminUser(\$_id: String!, \$username: String!) {
  removeSuperAdminUser(_id: \$_id, username: \$username) {
    email
    username
    _id
    upgrade
  }
}
EOF;
}


class RemoveUserClientsResponse
{

    /**
     * @var UserClient[]
     */
    public $removeUserClients;
}

class RemoveUserClientsParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $ids;

    function createRequest()
    {
        return [
            "query" => self::RemoveUserClientsDocument,
            "operationName" => "removeUserClients",
            "variables" => $this
        ];
    }

    const RemoveUserClientsDocument = <<<EOF
mutation removeUserClients(\$ids: [String]) {
  removeUserClients(ids: \$ids) {
    _id
    user {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userPoolTypes {
      _id
      name
      description
      image
      example
    }
    usersCount
    logo
    emailVerifiedDefault
    sendWelcomeEmail
    registerDisabled
    showWXMPQRCode
    useMiniLogin
    useSelfWxapp
    allowedOrigins
    name
    secret
    token
    descriptions
    jwtExpired
    createdAt
    isDeleted
    frequentRegisterCheck {
      timeInterval
      limit
      enable
    }
    loginFailCheck {
      timeInterval
      limit
      enable
    }
    enableEmail
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
  }
}
EOF;
}


class RemoveUserFromGroupResponse
{

    /**
     * @var UserGroup
     */
    public $removeUserFromGroup;
}

class RemoveUserFromGroupParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Required
     *
     * @var string
     */
    public $user;

    /**
     * Required
     *
     * @var string
     */
    public $group;

    function createRequest()
    {
        return [
            "query" => self::RemoveUserFromGroupDocument,
            "operationName" => "removeUserFromGroup",
            "variables" => $this
        ];
    }

    const RemoveUserFromGroupDocument = <<<EOF
mutation removeUserFromGroup(\$client: String!, \$user: String!, \$group: String!) {
  removeUserFromGroup(client: \$client, user: \$user, group: \$group) {
    _id
    user {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    client {
      _id
      usersCount
      logo
      emailVerifiedDefault
      sendWelcomeEmail
      registerDisabled
      showWXMPQRCode
      useMiniLogin
      useSelfWxapp
      allowedOrigins
      name
      secret
      token
      descriptions
      jwtExpired
      createdAt
      isDeleted
      enableEmail
    }
    group {
      _id
      name
      descriptions
      client
      permissions
      createdAt
    }
    createdAt
  }
}
EOF;
}


class RemoveUserFromRbacGroupResponse
{

    /**
     * @var RBACGroup
     */
    public $removeUserFromRBACGroup;
}

class RemoveUserFromRbacGroupParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var RemoveUserFromRbacGroupInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::RemoveUserFromRbacGroupDocument,
            "operationName" => "removeUserFromRBACGroup",
            "variables" => $this
        ];
    }

    const RemoveUserFromRbacGroupDocument = <<<EOF
mutation removeUserFromRBACGroup(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: RemoveUserFromRBACGroupInput!) {
  removeUserFromRBACGroup(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    roles {
      totalCount
    }
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class RemoveUserFromRbacGroupBatchResponse
{

    /**
     * @var RBACGroup
     */
    public $removeUserFromRBACGroupBatch;
}

class RemoveUserFromRbacGroupBatchParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var RemoveUserFromRbacGroupBatchInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::RemoveUserFromRbacGroupBatchDocument,
            "operationName" => "removeUserFromRBACGroupBatch",
            "variables" => $this
        ];
    }

    const RemoveUserFromRbacGroupBatchDocument = <<<EOF
mutation removeUserFromRBACGroupBatch(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: RemoveUserFromRBACGroupBatchInput!) {
  removeUserFromRBACGroupBatch(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    roles {
      totalCount
    }
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class RemoveUserMetadataResponse
{

    /**
     * @var UserMetaDataList
     */
    public $removeUserMetadata;
}

class RemoveUserMetadataParam
{

    /**
     * Required
     *
     * @var RemoveUserMetadataInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::RemoveUserMetadataDocument,
            "operationName" => "removeUserMetadata",
            "variables" => $this
        ];
    }

    const RemoveUserMetadataDocument = <<<EOF
mutation removeUserMetadata(\$input: RemoveUserMetadataInput!) {
  removeUserMetadata(input: \$input) {
    totalCount
    list {
      key
      value
    }
  }
}
EOF;
}


class RemoveUsersResponse
{

    /**
     * @var User[]
     */
    public $removeUsers;
}

class RemoveUsersParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $ids;

    /**
     * Optional
     *
     * @var string
     */
    public $registerInClient;

    /**
     * Optional
     *
     * @var string
     */
    public $operator;

    function createRequest()
    {
        return [
            "query" => self::RemoveUsersDocument,
            "operationName" => "removeUsers",
            "variables" => $this
        ];
    }

    const RemoveUsersDocument = <<<EOF
mutation removeUsers(\$ids: [String], \$registerInClient: String, \$operator: String) {
  removeUsers(ids: \$ids, registerInClient: \$registerInClient, operator: \$operator) {
    _id
  }
}
EOF;
}


class ResetPasswordResponse
{

    /**
     * @var ExtendUser
     */
    public $resetPassword;
}

class ResetPasswordParam
{

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
    public $clientId;

    /**
     * Required
     *
     * @var string
     */
    public $password;

    /**
     * Required
     *
     * @var string
     */
    public $verifyCode;

    function createRequest()
    {
        return [
            "query" => self::ResetPasswordDocument,
            "operationName" => "resetPassword",
            "variables" => $this
        ];
    }

    const ResetPasswordDocument = <<<EOF
mutation resetPassword(\$email: String!, \$clientId: String!, \$password: String!, \$verifyCode: String!) {
  changePassword(email: \$email, client: \$clientId, password: \$password, verifyCode: \$verifyCode) {
    _id
    email
    emailVerified
    username
    nickname
    company
    photo
    browser
    registerInClient
    registerMethod
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
  }
}
EOF;
}


class ResetUserPoolFromWechatResponse
{

    /**
     * @var PagedUsers
     */
    public $resetUserPoolFromWechat;
}

class ResetUserPoolFromWechatParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Required
     *
     * @var string
     */
    public $registerMethod;

    /**
     * Required
     *
     * @var int
     */
    public $limit;

    function createRequest()
    {
        return [
            "query" => self::ResetUserPoolFromWechatDocument,
            "operationName" => "resetUserPoolFromWechat",
            "variables" => $this
        ];
    }

    const ResetUserPoolFromWechatDocument = <<<EOF
mutation resetUserPoolFromWechat(\$client: String!, \$registerMethod: String!, \$limit: Int!) {
  resetUserPoolFromWechat(client: \$client, registerMethod: \$registerMethod, limit: \$limit) {
    list {
      _id
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      username
      nickname
      company
      photo
      browser
      device
      password
      registerInClient
      registerMethod
      oauth
      token
      tokenExpiredAt
      loginsCount
      lastLogin
      lastIP
      signedUp
      blocked
      isDeleted
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
      country
      updatedAt
      customData
      metadata
    }
    totalCount
  }
}
EOF;
}


class RevokeRbacRoleFromUserResponse
{

    /**
     * @var RBACRole
     */
    public $revokeRBACRoleFromUser;
}

class RevokeRbacRoleFromUserParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var RevokeRbacRoleFromUserInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::RevokeRbacRoleFromUserDocument,
            "operationName" => "revokeRBACRoleFromUser",
            "variables" => $this
        ];
    }

    const RevokeRbacRoleFromUserDocument = <<<EOF
mutation revokeRBACRoleFromUser(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: RevokeRBACRoleFromUserInput!) {
  revokeRBACRoleFromUser(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class RevokeRbacRoleFromUserBatchResponse
{

    /**
     * @var RBACRole
     */
    public $revokeRBACRoleFromUserBatch;
}

class RevokeRbacRoleFromUserBatchParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var RevokeRbacRoleFromUserBatchInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::RevokeRbacRoleFromUserBatchDocument,
            "operationName" => "revokeRBACRoleFromUserBatch",
            "variables" => $this
        ];
    }

    const RevokeRbacRoleFromUserBatchDocument = <<<EOF
mutation revokeRBACRoleFromUserBatch(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: RevokeRBACRoleFromUserBatchInput!) {
  revokeRBACRoleFromUserBatch(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class SendChangeEmailVerifyCodeResponse
{

    /**
     * @var CommonMessage
     */
    public $sendChangeEmailVerifyCode;
}

class SendChangeEmailVerifyCodeParam
{

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
    public $email;

    function createRequest()
    {
        return [
            "query" => self::SendChangeEmailVerifyCodeDocument,
            "operationName" => "sendChangeEmailVerifyCode",
            "variables" => $this
        ];
    }

    const SendChangeEmailVerifyCodeDocument = <<<EOF
mutation sendChangeEmailVerifyCode(\$userPoolId: String!, \$email: String!) {
  sendChangeEmailVerifyCode(userPoolId: \$userPoolId, email: \$email) {
    message
    code
    status
  }
}
EOF;
}


class SendResetPasswordEmailResponse
{

    /**
     * @var CommonMessage
     */
    public $sendResetPasswordEmail;
}

class SendResetPasswordEmailParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Required
     *
     * @var string
     */
    public $email;

    function createRequest()
    {
        return [
            "query" => self::SendResetPasswordEmailDocument,
            "operationName" => "sendResetPasswordEmail",
            "variables" => $this
        ];
    }

    const SendResetPasswordEmailDocument = <<<EOF
mutation sendResetPasswordEmail(\$client: String!, \$email: String!) {
  sendResetPasswordEmail(client: \$client, email: \$email) {
    message
    code
    status
  }
}
EOF;
}


class SendVerifyEmailResponse
{

    /**
     * @var CommonMessage
     */
    public $sendVerifyEmail;
}

class SendVerifyEmailParam
{

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
    public $client;

    /**
     * Optional
     *
     * @var string
     */
    public $token;

    function createRequest()
    {
        return [
            "query" => self::SendVerifyEmailDocument,
            "operationName" => "sendVerifyEmail",
            "variables" => $this
        ];
    }

    const SendVerifyEmailDocument = <<<EOF
mutation sendVerifyEmail(\$email: String!, \$client: String!, \$token: String) {
  sendVerifyEmail(email: \$email, client: \$client, token: \$token) {
    message
    code
    status
  }
}
EOF;
}


class SetInvitationStateResponse
{

    /**
     * @var InvitationState
     */
    public $setInvitationState;
}

class SetInvitationStateParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var bool
     */
    public $enablePhone;

    function createRequest()
    {
        return [
            "query" => self::SetInvitationStateDocument,
            "operationName" => "setInvitationState",
            "variables" => $this
        ];
    }

    const SetInvitationStateDocument = <<<EOF
mutation setInvitationState(\$client: String!, \$enablePhone: Boolean) {
  setInvitationState(client: \$client, enablePhone: \$enablePhone) {
    client
    enablePhone
    createdAt
    updatedAt
  }
}
EOF;
}


class SetRuleEnvResponse
{

    /**
     * @var PagedRuleEnvVariable
     */
    public $setRuleEnv;
}

class SetRuleEnvParam
{

    /**
     * Required
     *
     * @var SetRuleEnvInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::SetRuleEnvDocument,
            "operationName" => "setRuleEnv",
            "variables" => $this
        ];
    }

    const SetRuleEnvDocument = <<<EOF
mutation setRuleEnv(\$input: SetRuleEnvInput!) {
  setRuleEnv(input: \$input) {
    totalCount
    list {
      key
      value
    }
  }
}
EOF;
}


class SetUserMetadataResponse
{

    /**
     * @var UserMetaDataList
     */
    public $setUserMetadata;
}

class SetUserMetadataParam
{

    /**
     * Required
     *
     * @var SetUserMetadataInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::SetUserMetadataDocument,
            "operationName" => "setUserMetadata",
            "variables" => $this
        ];
    }

    const SetUserMetadataDocument = <<<EOF
mutation setUserMetadata(\$input: SetUserMetadataInput!) {
  setUserMetadata(input: \$input) {
    totalCount
    list {
      key
      value
    }
  }
}
EOF;
}


class SignInResponse
{

    /**
     * @var OidcPasswordModeUserInfo
     */
    public $signIn;
}

class SignInParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $oidcAppId;

    /**
     * Optional
     *
     * @var string
     */
    public $userPoolId;

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
    public $password;

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
    public $unionid;

    /**
     * Optional
     *
     * @var string
     */
    public $username;

    function createRequest()
    {
        return [
            "query" => self::SignInDocument,
            "operationName" => "signIn",
            "variables" => $this
        ];
    }

    const SignInDocument = <<<EOF
mutation signIn(\$oidcAppId: String, \$userPoolId: String, \$email: String, \$password: String, \$phone: String, \$unionid: String, \$username: String) {
  signIn(oidcAppId: \$oidcAppId, userPoolId: \$userPoolId, email: \$email, password: \$password, phone: \$phone, unionid: \$unionid, username: \$username) {
    sub
    birthdate
    family_name
    gender
    given_name
    locale
    middle_name
    name
    nickname
    picture
    preferred_username
    profile
    updated_at
    website
    zoneinfo
    username
    _id
    company
    browser
    device
    logins_count
    register_method
    blocked
    last_ip
    register_in_userpool
    last_login
    signed_up
    email
    email_verified
    phone_number
    phone_number_verified
    token
    access_token
    id_token
    refresh_token
    expires_in
    token_type
    scope
  }
}
EOF;
}


class UnbindEmailResponse
{

    /**
     * @var User
     */
    public $unbindEmail;
}

class UnbindEmailParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $user;

    /**
     * Optional
     *
     * @var string
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::UnbindEmailDocument,
            "operationName" => "unbindEmail",
            "variables" => $this
        ];
    }

    const UnbindEmailDocument = <<<EOF
mutation unbindEmail(\$user: String, \$client: String) {
  unbindEmail(user: \$user, client: \$client) {
    _id
    username
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    nickname
    company
    photo
    browser
    password
    registerInClient
    registerMethod
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
    country
    updatedAt
    thirdPartyIdentity {
      provider
      refreshToken
      accessToken
      expiresIn
      updatedAt
    }
    oldPassword
    metadata
  }
}
EOF;
}


class UnbindOtherOAuthResponse
{

    /**
     * @var UserOAuthBind
     */
    public $unbindOtherOAuth;
}

class UnbindOtherOAuthParam
{

    /**
     * Required
     *
     * @var string
     */
    public $type;

    /**
     * Optional
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     */
    public $user;

    function createRequest()
    {
        return [
            "query" => self::UnbindOtherOAuthDocument,
            "operationName" => "unbindOtherOAuth",
            "variables" => $this
        ];
    }

    const UnbindOtherOAuthDocument = <<<EOF
mutation unbindOtherOAuth(\$type: String!, \$client: String, \$user: String) {
  unbindOtherOAuth(type: \$type, client: \$client, user: \$user) {
    _id
    user
    client
    type
    unionid
    userInfo
    createdAt
  }
}
EOF;
}


class UpdateAdConnectorResponse
{

    /**
     * @var ADConnector
     */
    public $updateAdConnector;
}

class UpdateAdConnectorParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

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
    public $logo;

    function createRequest()
    {
        return [
            "query" => self::UpdateAdConnectorDocument,
            "operationName" => "updateAdConnector",
            "variables" => $this
        ];
    }

    const UpdateAdConnectorDocument = <<<EOF
mutation updateAdConnector(\$_id: String!, \$name: String, \$logo: String) {
  updateAdConnector(_id: \$_id, name: \$name, logo: \$logo) {
    _id
    name
    secret
    salt
    logo
    enabled
    userPoolId
    status
    createdAt
  }
}
EOF;
}


class UpdateClientWebhookResponse
{

    /**
     * @var ClientWebhook
     */
    public $updateClientWebhook;
}

class UpdateClientWebhookParam
{

    /**
     * Required
     *
     * @var string
     */
    public $id;

    /**
     * Required
     *
     * @var string
     */
    public $events;

    /**
     * Required
     *
     * @var string
     */
    public $url;

    /**
     * Required
     *
     * @var string
     */
    public $contentType;

    /**
     * Required
     *
     * @var bool
     */
    public $enable;

    /**
     * Optional
     *
     * @var string
     */
    public $secret;

    /**
     * Optional
     *
     * @var bool
     */
    public $isLastTimeSuccess;

    function createRequest()
    {
        return [
            "query" => self::UpdateClientWebhookDocument,
            "operationName" => "updateClientWebhook",
            "variables" => $this
        ];
    }

    const UpdateClientWebhookDocument = <<<EOF
mutation updateClientWebhook(\$id: String!, \$events: [String!]!, \$url: String!, \$contentType: String!, \$enable: Boolean!, \$secret: String, \$isLastTimeSuccess: Boolean) {
  updateClientWebhook(id: \$id, events: \$events, url: \$url, contentType: \$contentType, enable: \$enable, secret: \$secret, isLastTimeSuccess: \$isLastTimeSuccess) {
    _id
    client
    events {
      name
      label
      description
    }
    url
    isLastTimeSuccess
    contentType
    secret
    enable
  }
}
EOF;
}


class UpdateCollaboratorResponse
{

    /**
     * @var Collaboration
     */
    public $updateCollaborator;
}

class UpdateCollaboratorParam
{

    /**
     * Required
     *
     * @var string
     */
    public $collaborationId;

    /**
     * Required
     *
     * @var PermissionDescriptorsInputType
     */
    public $permissionDescriptors;

    function createRequest()
    {
        return [
            "query" => self::UpdateCollaboratorDocument,
            "operationName" => "updateCollaborator",
            "variables" => $this
        ];
    }

    const UpdateCollaboratorDocument = <<<EOF
mutation updateCollaborator(\$collaborationId: String!, \$permissionDescriptors: [PermissionDescriptorsInputType]!) {
  updateCollaborator(collaborationId: \$collaborationId, permissionDescriptors: \$permissionDescriptors) {
    _id
    createdAt
    owner {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    collaborator {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    userPool {
      _id
      usersCount
      logo
      emailVerifiedDefault
      sendWelcomeEmail
      registerDisabled
      showWXMPQRCode
      useMiniLogin
      useSelfWxapp
      allowedOrigins
      name
      secret
      token
      descriptions
      jwtExpired
      createdAt
      isDeleted
      enableEmail
    }
    permissionDescriptors {
      permissionId
      name
      operationAllow
    }
  }
}
EOF;
}


class UpdateEmailResponse
{

    /**
     * @var User
     */
    public $updateEmail;
}

class UpdateEmailParam
{

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

    function createRequest()
    {
        return [
            "query" => self::UpdateEmailDocument,
            "operationName" => "updateEmail",
            "variables" => $this
        ];
    }

    const UpdateEmailDocument = <<<EOF
mutation updateEmail(\$userPoolId: String!, \$email: String!, \$emailCode: String!, \$oldEmail: String, \$oldEmailCode: String) {
  updateEmail(userPoolId: \$userPoolId, email: \$email, emailCode: \$emailCode, oldEmail: \$oldEmail, oldEmailCode: \$oldEmailCode) {
    _id
    username
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    nickname
    company
    photo
    browser
    password
    registerInClient
    registerMethod
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
    country
    updatedAt
    thirdPartyIdentity {
      provider
      refreshToken
      accessToken
      expiresIn
      updatedAt
    }
    oldPassword
    metadata
  }
}
EOF;
}


class UpdatePasswordStrengthSettingsByUserPoolIdResponse
{

    /**
     * @var PasswordStrengthSettings
     */
    public $updatePasswordStrengthSettingsByUserPoolId;
}

class UpdatePasswordStrengthSettingsByUserPoolIdParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    /**
     * Optional
     *
     * @var int
     */
    public $pwdStrength;

    function createRequest()
    {
        return [
            "query" => self::UpdatePasswordStrengthSettingsByUserPoolIdDocument,
            "operationName" => "updatePasswordStrengthSettingsByUserPoolId",
            "variables" => $this
        ];
    }

    const UpdatePasswordStrengthSettingsByUserPoolIdDocument = <<<EOF
mutation updatePasswordStrengthSettingsByUserPoolId(\$userPoolId: String!, \$pwdStrength: Int) {
  updatePasswordStrengthSettingsByUserPoolId(userPoolId: \$userPoolId, pwdStrength: \$pwdStrength) {
    userPoolId
    pwdStrength
  }
}
EOF;
}


class UpdatePermissionsResponse
{

    /**
     * @var Group
     */
    public $updatePermissions;
}

class UpdatePermissionsParam
{

    /**
     * Required
     *
     * @var string
     */
    public $role;

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     */
    public $permissions;

    function createRequest()
    {
        return [
            "query" => self::UpdatePermissionsDocument,
            "operationName" => "updatePermissions",
            "variables" => $this
        ];
    }

    const UpdatePermissionsDocument = <<<EOF
mutation updatePermissions(\$role: String!, \$client: String!, \$permissions: String) {
  updatePermissions(role: \$role, client: \$client, permissions: \$permissions) {
    _id
    name
    descriptions
    client
    permissions
    createdAt
  }
}
EOF;
}


class UpdatePhoneResponse
{

    /**
     * @var User
     */
    public $updatePhone;
}

class UpdatePhoneParam
{

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

    function createRequest()
    {
        return [
            "query" => self::UpdatePhoneDocument,
            "operationName" => "updatePhone",
            "variables" => $this
        ];
    }

    const UpdatePhoneDocument = <<<EOF
mutation updatePhone(\$userPoolId: String!, \$phone: String!, \$phoneCode: String!, \$oldPhone: String, \$oldPhoneCode: String) {
  updatePhone(userPoolId: \$userPoolId, phone: \$phone, phoneCode: \$phoneCode, oldPhone: \$oldPhone, oldPhoneCode: \$oldPhoneCode) {
    _id
    username
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    nickname
    company
    photo
    browser
    password
    registerInClient
    registerMethod
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
    country
    updatedAt
    thirdPartyIdentity {
      provider
      refreshToken
      accessToken
      expiresIn
      updatedAt
    }
    oldPassword
    metadata
  }
}
EOF;
}


class UpdateRbacGroupResponse
{

    /**
     * @var RBACGroup
     */
    public $updateRBACGroup;
}

class UpdateRbacGroupParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var UpdateRbacGroupInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::UpdateRbacGroupDocument,
            "operationName" => "updateRBACGroup",
            "variables" => $this
        ];
    }

    const UpdateRbacGroupDocument = <<<EOF
mutation updateRBACGroup(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: UpdateRBACGroupInput!) {
  updateRBACGroup(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    roles {
      totalCount
    }
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class UpdateRbacPermissionResponse
{

    /**
     * @var RBACPermission
     */
    public $updateRBACPermission;
}

class UpdateRbacPermissionParam
{

    /**
     * Required
     *
     * @var UpdateRbacPermissionInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::UpdateRbacPermissionDocument,
            "operationName" => "updateRBACPermission",
            "variables" => $this
        ];
    }

    const UpdateRbacPermissionDocument = <<<EOF
mutation updateRBACPermission(\$input: UpdateRBACPermissionInput!) {
  updateRBACPermission(input: \$input) {
    _id
    name
    userPoolId
    createdAt
    updatedAt
    description
  }
}
EOF;
}


class UpdateRbacRoleResponse
{

    /**
     * @var RBACRole
     */
    public $updateRBACRole;
}

class UpdateRbacRoleParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var UpdateRbacRoleInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::UpdateRbacRoleDocument,
            "operationName" => "updateRBACRole",
            "variables" => $this
        ];
    }

    const UpdateRbacRoleDocument = <<<EOF
mutation updateRBACRole(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$input: UpdateRBACRoleInput!) {
  updateRBACRole(input: \$input) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class UpdateRoleResponse
{

    /**
     * @var Group
     */
    public $updateRole;
}

class UpdateRoleParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    /**
     * Required
     *
     * @var string
     */
    public $client;

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
    public $descriptions;

    /**
     * Optional
     *
     * @var string
     */
    public $permissions;

    function createRequest()
    {
        return [
            "query" => self::UpdateRoleDocument,
            "operationName" => "updateRole",
            "variables" => $this
        ];
    }

    const UpdateRoleDocument = <<<EOF
mutation updateRole(\$_id: String!, \$client: String!, \$name: String!, \$descriptions: String, \$permissions: String) {
  updateRole(_id: \$_id, client: \$client, name: \$name, descriptions: \$descriptions, permissions: \$permissions) {
    _id
    name
    descriptions
    client
    permissions
    createdAt
  }
}
EOF;
}


class UpdateRuleResponse
{

    /**
     * @var Rule
     */
    public $updateRule;
}

class UpdateRuleParam
{

    /**
     * Required
     *
     * @var UpdateRuleInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::UpdateRuleDocument,
            "operationName" => "updateRule",
            "variables" => $this
        ];
    }

    const UpdateRuleDocument = <<<EOF
mutation updateRule(\$input: UpdateRuleInput!) {
  updateRule(input: \$input) {
    _id
    userPoolId
    name
    description
    type
    enabled
    faasUrl
    code
    order
    async
    createdAt
    updatedAt
  }
}
EOF;
}


class UpdateRuleOrderResponse
{

    /**
     * @var CommonMessage
     */
    public $updateRuleOrder;
}

class UpdateRuleOrderParam
{

    /**
     * Required
     *
     * @var UpdateRuleOrderInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::UpdateRuleOrderDocument,
            "operationName" => "updateRuleOrder",
            "variables" => $this
        ];
    }

    const UpdateRuleOrderDocument = <<<EOF
mutation updateRuleOrder(\$input: UpdateRuleOrderInput!) {
  updateRuleOrder(input: \$input) {
    message
    code
    status
  }
}
EOF;
}


class UpdateSuperAdminUserResponse
{

    /**
     * @var UsersInGroupListItem
     */
    public $updateSuperAdminUser;
}

class UpdateSuperAdminUserParam
{

    /**
     * Required
     *
     * @var SuperAdminUpdateInput
     */
    public $options;

    function createRequest()
    {
        return [
            "query" => self::UpdateSuperAdminUserDocument,
            "operationName" => "updateSuperAdminUser",
            "variables" => $this
        ];
    }

    const UpdateSuperAdminUserDocument = <<<EOF
mutation updateSuperAdminUser(\$options: SuperAdminUpdateInput!) {
  updateSuperAdminUser(options: \$options) {
    email
    username
    _id
    upgrade
  }
}
EOF;
}


class UpdateUserResponse
{

    /**
     * @var User
     */
    public $updateUser;
}

class UpdateUserParam
{

    /**
     * Required
     *
     * @var UserUpdateInput
     */
    public $options;

    function createRequest()
    {
        return [
            "query" => self::UpdateUserDocument,
            "operationName" => "updateUser",
            "variables" => $this
        ];
    }

    const UpdateUserDocument = <<<EOF
mutation updateUser(\$options: UserUpdateInput!) {
  updateUser(options: \$options) {
    _id
    username
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    nickname
    company
    photo
    browser
    password
    registerInClient
    registerMethod
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
    country
    updatedAt
    thirdPartyIdentity {
      provider
      refreshToken
      accessToken
      expiresIn
      updatedAt
    }
    oldPassword
    metadata
  }
}
EOF;
}


class UpdateUserClientResponse
{

    /**
     * @var UserClient
     */
    public $updateUserClient;
}

class UpdateUserClientParam
{

    /**
     * Required
     *
     * @var UpdateUserClientInput
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::UpdateUserClientDocument,
            "operationName" => "updateUserClient",
            "variables" => $this
        ];
    }

    const UpdateUserClientDocument = <<<EOF
mutation updateUserClient(\$client: UpdateUserClientInput!) {
  updateUserClient(client: \$client) {
    _id
    user {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userPoolTypes {
      _id
      name
      description
      image
      example
    }
    usersCount
    logo
    emailVerifiedDefault
    sendWelcomeEmail
    registerDisabled
    showWXMPQRCode
    useMiniLogin
    useSelfWxapp
    allowedOrigins
    name
    secret
    token
    descriptions
    jwtExpired
    createdAt
    isDeleted
    frequentRegisterCheck {
      timeInterval
      limit
      enable
    }
    loginFailCheck {
      timeInterval
      limit
      enable
    }
    enableEmail
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
  }
}
EOF;
}


class VerifyResetPasswordVerifyCodeResponse
{

    /**
     * @var CommonMessage
     */
    public $verifyResetPasswordVerifyCode;
}

class VerifyResetPasswordVerifyCodeParam
{

    /**
     * Required
     *
     * @var string
     */
    public $verifyCode;

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
    public $client;

    function createRequest()
    {
        return [
            "query" => self::VerifyResetPasswordVerifyCodeDocument,
            "operationName" => "verifyResetPasswordVerifyCode",
            "variables" => $this
        ];
    }

    const VerifyResetPasswordVerifyCodeDocument = <<<EOF
mutation verifyResetPasswordVerifyCode(\$verifyCode: String!, \$email: String!, \$client: String!) {
  verifyResetPasswordVerifyCode(verifyCode: \$verifyCode, email: \$email, client: \$client) {
    message
    code
    status
  }
}
EOF;
}


class GetOidcAppInfoResponse
{

    /**
     * @var OIDCProviderClient
     */
    public $GetOIDCAppInfo;
}

class GetOidcAppInfoParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    function createRequest()
    {
        return [
            "query" => self::GetOidcAppInfoDocument,
            "operationName" => "GetOIDCAppInfo",
            "variables" => $this
        ];
    }

    const GetOidcAppInfoDocument = <<<EOF
query GetOIDCAppInfo(\$appId: String!) {
  GetOIDCAppInfo(appId: \$appId) {
    _id
    name
    domain
    image
    redirect_uris
    client_id
    client_secret
    token_endpoint_auth_method
    id_token_signed_response_alg
    id_token_encrypted_response_alg
    id_token_encrypted_response_enc
    userinfo_signed_response_alg
    userinfo_encrypted_response_alg
    userinfo_encrypted_response_enc
    request_object_signing_alg
    request_object_encryption_alg
    request_object_encryption_enc
    jwks_uri
    _jwks_uri
    custom_jwks
    jwks
    _jwks
    clientId
    grant_types
    response_types
    description
    homepageURL
    isDeleted
    isDefault
    when
    css
    authorization_code_expire
    id_token_expire
    access_token_expire
    cas_expire
    loginUrl
    customStyles {
      forceLogin
      hideQRCode
      hideUP
      hideUsername
      hideRegister
      hidePhone
      hideSocial
      hideClose
      hidePhonePassword
      defaultLoginMethod
    }
  }
}
EOF;
}


class GetOidcAppListResponse
{

    /**
     * @var OIDCAppPagedList
     */
    public $GetOIDCAppList;
}

class GetOidcAppListParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::GetOidcAppListDocument,
            "operationName" => "GetOIDCAppList",
            "variables" => $this
        ];
    }

    const GetOidcAppListDocument = <<<EOF
query GetOIDCAppList(\$clientId: String, \$page: Int, \$count: Int) {
  GetOIDCAppList(clientId: \$clientId, page: \$page, count: \$count) {
    totalCount
    list {
      _id
      name
      domain
      image
      redirect_uris
      client_id
      client_secret
      token_endpoint_auth_method
      id_token_signed_response_alg
      id_token_encrypted_response_alg
      id_token_encrypted_response_enc
      userinfo_signed_response_alg
      userinfo_encrypted_response_alg
      userinfo_encrypted_response_enc
      request_object_signing_alg
      request_object_encryption_alg
      request_object_encryption_enc
      jwks_uri
      _jwks_uri
      custom_jwks
      jwks
      _jwks
      clientId
      grant_types
      response_types
      description
      homepageURL
      isDeleted
      isDefault
      when
      css
      authorization_code_expire
      id_token_expire
      access_token_expire
      cas_expire
      loginUrl
    }
  }
}
EOF;
}


class GetSamlIdentityProviderInfoResponse
{

    /**
     * @var SAMLIdentityProviderClient
     */
    public $GetSAMLIdentityProviderInfo;
}

class GetSamlIdentityProviderInfoParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    function createRequest()
    {
        return [
            "query" => self::GetSamlIdentityProviderInfoDocument,
            "operationName" => "GetSAMLIdentityProviderInfo",
            "variables" => $this
        ];
    }

    const GetSamlIdentityProviderInfoDocument = <<<EOF
query GetSAMLIdentityProviderInfo(\$appId: String!) {
  GetSAMLIdentityProviderInfo(appId: \$appId) {
    _id
    name
    domain
    image
    appSecret
    appId
    clientId
    description
    isDeleted
    enabled
    when
    SPMetadata
    attributeNameFormat
    customAttributes
    emailDomainTransformation
    authnContextClassRef
    IdPMetadata
    assertionConsumerUrl
    bindings
    nameIds
    attributes
    enableSignRes
    resSignAlgorithm
    resAbstractAlgorithm
    resSignPublicKey
    resSignPrivateKey
    resSignPrivateKeyPass
    enableSignReq
    reqSignPublicKey
    enableEncryptRes
    resEncryptPublicKey
    css
  }
}
EOF;
}


class GetSamlIdentityProviderListResponse
{

    /**
     * @var SAMLIdentityProviderAppPagedList
     */
    public $GetSAMLIdentityProviderList;
}

class GetSamlIdentityProviderListParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::GetSamlIdentityProviderListDocument,
            "operationName" => "GetSAMLIdentityProviderList",
            "variables" => $this
        ];
    }

    const GetSamlIdentityProviderListDocument = <<<EOF
query GetSAMLIdentityProviderList(\$clientId: String, \$page: Int, \$count: Int) {
  GetSAMLIdentityProviderList(clientId: \$clientId, page: \$page, count: \$count) {
    totalCount
    list {
      _id
      name
      domain
      image
      appSecret
      appId
      clientId
      description
      isDeleted
      enabled
      when
      SPMetadata
      attributeNameFormat
      customAttributes
      emailDomainTransformation
      authnContextClassRef
      IdPMetadata
      assertionConsumerUrl
      bindings
      nameIds
      attributes
      enableSignRes
      resSignAlgorithm
      resAbstractAlgorithm
      resSignPublicKey
      resSignPrivateKey
      resSignPrivateKeyPass
      enableSignReq
      reqSignPublicKey
      enableEncryptRes
      resEncryptPublicKey
      css
    }
  }
}
EOF;
}


class GetSamlServiceProviderInfoResponse
{

    /**
     * @var SAMLServiceProviderClient
     */
    public $GetSAMLServiceProviderInfo;
}

class GetSamlServiceProviderInfoParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    function createRequest()
    {
        return [
            "query" => self::GetSamlServiceProviderInfoDocument,
            "operationName" => "GetSAMLServiceProviderInfo",
            "variables" => $this
        ];
    }

    const GetSamlServiceProviderInfoDocument = <<<EOF
query GetSAMLServiceProviderInfo(\$appId: String!) {
  GetSAMLServiceProviderInfo(appId: \$appId) {
    _id
    name
    domain
    image
    appSecret
    defaultIdPMap {
      _id
      name
      image
      description
      isDeleted
    }
    defaultIdPMapId
    appId
    clientId
    description
    isDeleted
    enabled
    when
    SPMetadata
    IdPMetadata
    IdPEntityID
    assertionConsumeService {
      binding
      url
      isDefault
    }
    mappings {
      username
      nickname
      photo
      company
      providerName
      email
    }
    redirectUrl
    loginUrl
    logoutUrl
    nameId
    enableSignRes
    resSignPublicKey
    hasResEncrypted
    resEncryptAlgorithm
    resAbstractAlgorithm
    resDecryptPrivateKey
    resDecryptPrivateKeyPass
    resEncryptPublicKey
    enableSignReq
    reqSignAlgorithm
    reqAbstractAlgorithm
    reqSignPrivateKey
    reqSignPrivateKeyPass
    reqSignPublicKey
    SPUrl
  }
}
EOF;
}


class GetSamlServiceProviderListResponse
{

    /**
     * @var SAMLServiceProviderAppPagedList
     */
    public $GetSAMLServiceProviderList;
}

class GetSamlServiceProviderListParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::GetSamlServiceProviderListDocument,
            "operationName" => "GetSAMLServiceProviderList",
            "variables" => $this
        ];
    }

    const GetSamlServiceProviderListDocument = <<<EOF
query GetSAMLServiceProviderList(\$clientId: String, \$page: Int, \$count: Int) {
  GetSAMLServiceProviderList(clientId: \$clientId, page: \$page, count: \$count) {
    totalCount
    list {
      _id
      name
      domain
      image
      appSecret
      defaultIdPMapId
      appId
      clientId
      description
      isDeleted
      enabled
      when
      SPMetadata
      IdPMetadata
      IdPEntityID
      redirectUrl
      loginUrl
      logoutUrl
      nameId
      enableSignRes
      resSignPublicKey
      hasResEncrypted
      resEncryptAlgorithm
      resAbstractAlgorithm
      resDecryptPrivateKey
      resDecryptPrivateKeyPass
      resEncryptPublicKey
      enableSignReq
      reqSignAlgorithm
      reqAbstractAlgorithm
      reqSignPrivateKey
      reqSignPrivateKeyPass
      reqSignPublicKey
      SPUrl
    }
  }
}
EOF;
}


class GetUserAuthorizedAppsResponse
{

    /**
     * @var UserAuthorizedAppPagedList
     */
    public $GetUserAuthorizedApps;
}

class GetUserAuthorizedAppsParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::GetUserAuthorizedAppsDocument,
            "operationName" => "GetUserAuthorizedApps",
            "variables" => $this
        ];
    }

    const GetUserAuthorizedAppsDocument = <<<EOF
query GetUserAuthorizedApps(\$clientId: String, \$userId: String, \$page: Int, \$count: Int) {
  GetUserAuthorizedApps(clientId: \$clientId, userId: \$userId, page: \$page, count: \$count) {
    totalCount
    OAuthApps {
      _id
      name
      domain
      image
      redirectUris
      appSecret
      client_id
      clientId
      grants
      description
      homepageURL
      isDeleted
      when
      css
      loginUrl
      casExpire
    }
    OIDCApps {
      _id
      name
      domain
      image
      redirect_uris
      client_id
      client_secret
      token_endpoint_auth_method
      id_token_signed_response_alg
      id_token_encrypted_response_alg
      id_token_encrypted_response_enc
      userinfo_signed_response_alg
      userinfo_encrypted_response_alg
      userinfo_encrypted_response_enc
      request_object_signing_alg
      request_object_encryption_alg
      request_object_encryption_enc
      jwks_uri
      _jwks_uri
      custom_jwks
      jwks
      _jwks
      clientId
      grant_types
      response_types
      description
      homepageURL
      isDeleted
      isDefault
      when
      css
      authorization_code_expire
      id_token_expire
      access_token_expire
      cas_expire
      loginUrl
    }
  }
}
EOF;
}


class PreviewEmailByTypeResponse
{

    /**
     * @var string
     */
    public $PreviewEmailByType;
}

class PreviewEmailByTypeParam
{

    /**
     * Required
     *
     * @var string
     */
    public $type;

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     */
    public $meta_data;

    function createRequest()
    {
        return [
            "query" => self::PreviewEmailByTypeDocument,
            "operationName" => "PreviewEmailByType",
            "variables" => $this
        ];
    }

    const PreviewEmailByTypeDocument = <<<EOF
query PreviewEmailByType(\$type: String!, \$client: String!, \$meta_data: String) {
  PreviewEmailByType(type: \$type, client: \$client, meta_data: \$meta_data)
}
EOF;
}


class QueryAppInfoByAppIdResponse
{

    /**
     * @var OAuthProviderClient
     */
    public $QueryAppInfoByAppID;
}

class QueryAppInfoByAppIdParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $appId;

    /**
     * Optional
     *
     * @var string
     */
    public $responseType;

    /**
     * Optional
     *
     * @var string
     */
    public $redirectUrl;

    function createRequest()
    {
        return [
            "query" => self::QueryAppInfoByAppIdDocument,
            "operationName" => "QueryAppInfoByAppID",
            "variables" => $this
        ];
    }

    const QueryAppInfoByAppIdDocument = <<<EOF
query QueryAppInfoByAppID(\$appId: String, \$responseType: String, \$redirectUrl: String) {
  QueryAppInfoByAppID(appId: \$appId, responseType: \$responseType, redirectUrl: \$redirectUrl) {
    _id
    name
    domain
    image
    redirectUris
    appSecret
    client_id
    clientId
    grants
    description
    homepageURL
    isDeleted
    when
    css
    loginUrl
    casExpire
  }
}
EOF;
}


class QueryAppInfoByDomainResponse
{

    /**
     * @var OAuthProviderClient
     */
    public $QueryAppInfoByDomain;
}

class QueryAppInfoByDomainParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $domain;

    function createRequest()
    {
        return [
            "query" => self::QueryAppInfoByDomainDocument,
            "operationName" => "QueryAppInfoByDomain",
            "variables" => $this
        ];
    }

    const QueryAppInfoByDomainDocument = <<<EOF
query QueryAppInfoByDomain(\$domain: String) {
  QueryAppInfoByDomain(domain: \$domain) {
    _id
    name
    domain
    image
    redirectUris
    appSecret
    client_id
    clientId
    grants
    description
    homepageURL
    isDeleted
    when
    css
    loginUrl
    casExpire
  }
}
EOF;
}


class QueryClientHasLdapConfigsResponse
{

    /**
     * @var ClientHasLDAPConfigs
     */
    public $QueryClientHasLDAPConfigs;
}

class QueryClientHasLdapConfigsParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

    function createRequest()
    {
        return [
            "query" => self::QueryClientHasLdapConfigsDocument,
            "operationName" => "QueryClientHasLDAPConfigs",
            "variables" => $this
        ];
    }

    const QueryClientHasLdapConfigsDocument = <<<EOF
query QueryClientHasLDAPConfigs(\$clientId: String) {
  QueryClientHasLDAPConfigs(clientId: \$clientId) {
    result
  }
}
EOF;
}


class QueryClientIdByAppIdResponse
{

    /**
     * @var OAuthProviderClient
     */
    public $QueryClientIdByAppId;
}

class QueryClientIdByAppIdParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $appId;

    function createRequest()
    {
        return [
            "query" => self::QueryClientIdByAppIdDocument,
            "operationName" => "QueryClientIdByAppId",
            "variables" => $this
        ];
    }

    const QueryClientIdByAppIdDocument = <<<EOF
query QueryClientIdByAppId(\$appId: String) {
  QueryClientIdByAppId(appId: \$appId) {
    _id
    name
    domain
    image
    redirectUris
    appSecret
    client_id
    clientId
    grants
    description
    homepageURL
    isDeleted
    when
    css
    loginUrl
    casExpire
  }
}
EOF;
}


class QueryDefaultSamlIdentityProviderSettingsListResponse
{

    /**
     * @var SAMLDefaultIdentityProviderSettingsList
     */
    public $QueryDefaultSAMLIdentityProviderSettingsList;
}

class QueryDefaultSamlIdentityProviderSettingsListParam
{

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::QueryDefaultSamlIdentityProviderSettingsListDocument,
            "operationName" => "QueryDefaultSAMLIdentityProviderSettingsList",
            "variables" => $this
        ];
    }

    const QueryDefaultSamlIdentityProviderSettingsListDocument = <<<EOF
query QueryDefaultSAMLIdentityProviderSettingsList(\$page: Int, \$count: Int) {
  QueryDefaultSAMLIdentityProviderSettingsList(page: \$page, count: \$count) {
    list {
      _id
      name
      image
      description
      isDeleted
    }
    totalCount
  }
}
EOF;
}


class QueryLdapServerListResponse
{

    /**
     * @var LDAPServerList
     */
    public $QueryLDAPServerList;
}

class QueryLdapServerListParam
{

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::QueryLdapServerListDocument,
            "operationName" => "QueryLDAPServerList",
            "variables" => $this
        ];
    }

    const QueryLdapServerListDocument = <<<EOF
query QueryLDAPServerList(\$clientId: String!, \$page: Int, \$count: Int) {
  QueryLDAPServerList(clientId: \$clientId, page: \$page, count: \$count) {
    list {
      _id
      name
      clientId
      userId
      ldapLink
      baseDN
      searchStandard
      emailPostfix
      username
      password
      description
      enabled
      isDeleted
      createdAt
      updatedAt
    }
    totalCount
  }
}
EOF;
}


class QueryOidcAppInfoByAppIdResponse
{

    /**
     * @var OIDCProviderClient
     */
    public $QueryOIDCAppInfoByAppID;
}

class QueryOidcAppInfoByAppIdParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $appId;

    /**
     * Optional
     *
     * @var string
     */
    public $responseType;

    /**
     * Optional
     *
     * @var string
     */
    public $redirectUrl;

    function createRequest()
    {
        return [
            "query" => self::QueryOidcAppInfoByAppIdDocument,
            "operationName" => "QueryOIDCAppInfoByAppID",
            "variables" => $this
        ];
    }

    const QueryOidcAppInfoByAppIdDocument = <<<EOF
query QueryOIDCAppInfoByAppID(\$appId: String, \$responseType: String, \$redirectUrl: String) {
  QueryOIDCAppInfoByAppID(appId: \$appId, responseType: \$responseType, redirectUrl: \$redirectUrl) {
    _id
    name
    domain
    image
    redirect_uris
    client_id
    client_secret
    token_endpoint_auth_method
    id_token_signed_response_alg
    id_token_encrypted_response_alg
    id_token_encrypted_response_enc
    userinfo_signed_response_alg
    userinfo_encrypted_response_alg
    userinfo_encrypted_response_enc
    request_object_signing_alg
    request_object_encryption_alg
    request_object_encryption_enc
    jwks_uri
    _jwks_uri
    custom_jwks
    jwks
    _jwks
    clientId
    grant_types
    response_types
    description
    homepageURL
    isDeleted
    isDefault
    when
    css
    authorization_code_expire
    id_token_expire
    access_token_expire
    cas_expire
    loginUrl
    customStyles {
      forceLogin
      hideQRCode
      hideUP
      hideUsername
      hideRegister
      hidePhone
      hideSocial
      hideClose
      hidePhonePassword
      defaultLoginMethod
    }
  }
}
EOF;
}


class QueryOidcAppInfoByDomainResponse
{

    /**
     * @var OIDCProviderClient
     */
    public $QueryOIDCAppInfoByDomain;
}

class QueryOidcAppInfoByDomainParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $domain;

    function createRequest()
    {
        return [
            "query" => self::QueryOidcAppInfoByDomainDocument,
            "operationName" => "QueryOIDCAppInfoByDomain",
            "variables" => $this
        ];
    }

    const QueryOidcAppInfoByDomainDocument = <<<EOF
query QueryOIDCAppInfoByDomain(\$domain: String) {
  QueryOIDCAppInfoByDomain(domain: \$domain) {
    _id
    name
    domain
    image
    redirect_uris
    client_id
    client_secret
    token_endpoint_auth_method
    id_token_signed_response_alg
    id_token_encrypted_response_alg
    id_token_encrypted_response_enc
    userinfo_signed_response_alg
    userinfo_encrypted_response_alg
    userinfo_encrypted_response_enc
    request_object_signing_alg
    request_object_encryption_alg
    request_object_encryption_enc
    jwks_uri
    _jwks_uri
    custom_jwks
    jwks
    _jwks
    clientId
    grant_types
    response_types
    description
    homepageURL
    isDeleted
    isDefault
    when
    css
    authorization_code_expire
    id_token_expire
    access_token_expire
    cas_expire
    loginUrl
    customStyles {
      forceLogin
      hideQRCode
      hideUP
      hideUsername
      hideRegister
      hidePhone
      hideSocial
      hideClose
      hidePhonePassword
      defaultLoginMethod
    }
  }
}
EOF;
}


class QuerySamlIdentityProviderInfoByAppIdResponse
{

    /**
     * @var SAMLIdentityProviderClient
     */
    public $QuerySAMLIdentityProviderInfoByAppID;
}

class QuerySamlIdentityProviderInfoByAppIdParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $appId;

    function createRequest()
    {
        return [
            "query" => self::QuerySamlIdentityProviderInfoByAppIdDocument,
            "operationName" => "QuerySAMLIdentityProviderInfoByAppID",
            "variables" => $this
        ];
    }

    const QuerySamlIdentityProviderInfoByAppIdDocument = <<<EOF
query QuerySAMLIdentityProviderInfoByAppID(\$appId: String) {
  QuerySAMLIdentityProviderInfoByAppID(appId: \$appId) {
    _id
    name
    domain
    image
    appSecret
    appId
    clientId
    description
    isDeleted
    enabled
    when
    SPMetadata
    attributeNameFormat
    customAttributes
    emailDomainTransformation
    authnContextClassRef
    IdPMetadata
    assertionConsumerUrl
    bindings
    nameIds
    attributes
    enableSignRes
    resSignAlgorithm
    resAbstractAlgorithm
    resSignPublicKey
    resSignPrivateKey
    resSignPrivateKeyPass
    enableSignReq
    reqSignPublicKey
    enableEncryptRes
    resEncryptPublicKey
    css
  }
}
EOF;
}


class QuerySamlIdentityProviderInfoByDomainResponse
{

    /**
     * @var SAMLIdentityProviderClient
     */
    public $QuerySAMLIdentityProviderInfoByDomain;
}

class QuerySamlIdentityProviderInfoByDomainParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $domain;

    function createRequest()
    {
        return [
            "query" => self::QuerySamlIdentityProviderInfoByDomainDocument,
            "operationName" => "QuerySAMLIdentityProviderInfoByDomain",
            "variables" => $this
        ];
    }

    const QuerySamlIdentityProviderInfoByDomainDocument = <<<EOF
query QuerySAMLIdentityProviderInfoByDomain(\$domain: String) {
  QuerySAMLIdentityProviderInfoByDomain(domain: \$domain) {
    _id
    name
    domain
    image
    appSecret
    appId
    clientId
    description
    isDeleted
    enabled
    when
    SPMetadata
    attributeNameFormat
    customAttributes
    emailDomainTransformation
    authnContextClassRef
    IdPMetadata
    assertionConsumerUrl
    bindings
    nameIds
    attributes
    enableSignRes
    resSignAlgorithm
    resAbstractAlgorithm
    resSignPublicKey
    resSignPrivateKey
    resSignPrivateKeyPass
    enableSignReq
    reqSignPublicKey
    enableEncryptRes
    resEncryptPublicKey
    css
  }
}
EOF;
}


class QuerySamlServiceProviderInfoByAppIdResponse
{

    /**
     * @var SAMLServiceProviderClient
     */
    public $QuerySAMLServiceProviderInfoByAppID;
}

class QuerySamlServiceProviderInfoByAppIdParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    function createRequest()
    {
        return [
            "query" => self::QuerySamlServiceProviderInfoByAppIdDocument,
            "operationName" => "QuerySAMLServiceProviderInfoByAppID",
            "variables" => $this
        ];
    }

    const QuerySamlServiceProviderInfoByAppIdDocument = <<<EOF
query QuerySAMLServiceProviderInfoByAppID(\$appId: String!) {
  QuerySAMLServiceProviderInfoByAppID(appId: \$appId) {
    _id
    name
    domain
    image
    appSecret
    defaultIdPMap {
      _id
      name
      image
      description
      isDeleted
    }
    defaultIdPMapId
    appId
    clientId
    description
    isDeleted
    enabled
    when
    SPMetadata
    IdPMetadata
    IdPEntityID
    assertionConsumeService {
      binding
      url
      isDefault
    }
    mappings {
      username
      nickname
      photo
      company
      providerName
      email
    }
    redirectUrl
    loginUrl
    logoutUrl
    nameId
    enableSignRes
    resSignPublicKey
    hasResEncrypted
    resEncryptAlgorithm
    resAbstractAlgorithm
    resDecryptPrivateKey
    resDecryptPrivateKeyPass
    resEncryptPublicKey
    enableSignReq
    reqSignAlgorithm
    reqAbstractAlgorithm
    reqSignPrivateKey
    reqSignPrivateKeyPass
    reqSignPublicKey
    SPUrl
  }
}
EOF;
}


class QuerySamlServiceProviderInfoByDomainResponse
{

    /**
     * @var SAMLServiceProviderClient
     */
    public $QuerySAMLServiceProviderInfoByDomain;
}

class QuerySamlServiceProviderInfoByDomainParam
{

    /**
     * Required
     *
     * @var string
     */
    public $domain;

    function createRequest()
    {
        return [
            "query" => self::QuerySamlServiceProviderInfoByDomainDocument,
            "operationName" => "QuerySAMLServiceProviderInfoByDomain",
            "variables" => $this
        ];
    }

    const QuerySamlServiceProviderInfoByDomainDocument = <<<EOF
query QuerySAMLServiceProviderInfoByDomain(\$domain: String!) {
  QuerySAMLServiceProviderInfoByDomain(domain: \$domain) {
    _id
    name
    domain
    image
    appSecret
    defaultIdPMap {
      _id
      name
      image
      description
      isDeleted
    }
    defaultIdPMapId
    appId
    clientId
    description
    isDeleted
    enabled
    when
    SPMetadata
    IdPMetadata
    IdPEntityID
    assertionConsumeService {
      binding
      url
      isDefault
    }
    mappings {
      username
      nickname
      photo
      company
      providerName
      email
    }
    redirectUrl
    loginUrl
    logoutUrl
    nameId
    enableSignRes
    resSignPublicKey
    hasResEncrypted
    resEncryptAlgorithm
    resAbstractAlgorithm
    resDecryptPrivateKey
    resDecryptPrivateKeyPass
    resEncryptPublicKey
    enableSignReq
    reqSignAlgorithm
    reqAbstractAlgorithm
    reqSignPrivateKey
    reqSignPrivateKeyPass
    reqSignPublicKey
    SPUrl
  }
}
EOF;
}


class ReadEmailProviderResponse
{

    /**
     * @var EmailProviderList[]
     */
    public $ReadEmailProvider;
}

class ReadEmailProviderParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

    function createRequest()
    {
        return [
            "query" => self::ReadEmailProviderDocument,
            "operationName" => "ReadEmailProvider",
            "variables" => $this
        ];
    }

    const ReadEmailProviderDocument = <<<EOF
query ReadEmailProvider(\$clientId: String) {
  ReadEmailProvider(clientId: \$clientId) {
    _id
    name
    image
    description
    fields {
      label
      type
      placeholder
      help
      value
      options
    }
    client
    user
    status
    provider {
      _id
      name
      image
      description
      client
      user
      status
    }
  }
}
EOF;
}


class ReadEmailProviderByClientAndNameResponse
{

    /**
     * @var EmailProviderWithClientList[]
     */
    public $ReadEmailProviderByClientAndName;
}

class ReadEmailProviderByClientAndNameParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

    function createRequest()
    {
        return [
            "query" => self::ReadEmailProviderByClientAndNameDocument,
            "operationName" => "ReadEmailProviderByClientAndName",
            "variables" => $this
        ];
    }

    const ReadEmailProviderByClientAndNameDocument = <<<EOF
query ReadEmailProviderByClientAndName(\$clientId: String) {
  ReadEmailProviderByClientAndName(clientId: \$clientId) {
    _id
    user
    client
    status
    fields {
      label
      type
      placeholder
      help
      value
      options
    }
    provider {
      _id
      name
      image
      description
    }
  }
}
EOF;
}


class ReadEmailProviderWithClientResponse
{

    /**
     * @var EmailProviderWithClientList[]
     */
    public $ReadEmailProviderWithClient;
}

class ReadEmailProviderWithClientParam
{


    function createRequest()
    {
        return [
            "query" => self::ReadEmailProviderWithClientDocument,
            "operationName" => "ReadEmailProviderWithClient",
            "variables" => $this
        ];
    }

    const ReadEmailProviderWithClientDocument = <<<EOF
query ReadEmailProviderWithClient {
  ReadEmailProviderWithClient {
    _id
    user
    client
    status
    fields {
      label
      type
      placeholder
      help
      value
      options
    }
    provider {
      _id
      name
      image
      description
    }
  }
}
EOF;
}


class ReadEmailSentListResponse
{

    /**
     * @var Email
     */
    public $ReadEmailSentList;
}

class ReadEmailSentListParam
{

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
    public $count;

    /**
     * Optional
     *
     * @var string
     */
    public $sortBy;

    function createRequest()
    {
        return [
            "query" => self::ReadEmailSentListDocument,
            "operationName" => "ReadEmailSentList",
            "variables" => $this
        ];
    }

    const ReadEmailSentListDocument = <<<EOF
query ReadEmailSentList(\$page: Int, \$count: Int, \$sortBy: String) {
  ReadEmailSentList(page: \$page, count: \$count, sortBy: \$sortBy) {
    list {
      _id
      subject
      content
      sender
      receivers
      createdAt
    }
    totalCount
  }
}
EOF;
}


class ReadEmailSentListByClientResponse
{

    /**
     * @var EmailListPaged
     */
    public $ReadEmailSentListByClient;
}

class ReadEmailSentListByClientParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::ReadEmailSentListByClientDocument,
            "operationName" => "ReadEmailSentListByClient",
            "variables" => $this
        ];
    }

    const ReadEmailSentListByClientDocument = <<<EOF
query ReadEmailSentListByClient(\$client: String!, \$page: Int, \$count: Int) {
  ReadEmailSentListByClient(client: \$client, page: \$page, count: \$count) {
    totalCount
    list {
      _id
      user
      subject
      content
      sender
      receivers
      post
      createdAt
      rejected
      isDeleted
      client
    }
  }
}
EOF;
}


class ReadEmailTemplateByClientAndTypeResponse
{

    /**
     * @var EmailTemplate
     */
    public $ReadEmailTemplateByClientAndType;
}

class ReadEmailTemplateByClientAndTypeParam
{

    /**
     * Required
     *
     * @var string
     */
    public $type;

    /**
     * Required
     *
     * @var string
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::ReadEmailTemplateByClientAndTypeDocument,
            "operationName" => "ReadEmailTemplateByClientAndType",
            "variables" => $this
        ];
    }

    const ReadEmailTemplateByClientAndTypeDocument = <<<EOF
query ReadEmailTemplateByClientAndType(\$type: String!, \$client: String!) {
  ReadEmailTemplateByClientAndType(type: \$type, client: \$client) {
    _id
    type
    sender
    object
    hasURL
    URLExpireTime
    status
    redirectTo
    content
  }
}
EOF;
}


class ReadEmailTemplatesByClientResponse
{

    /**
     * @var EmailTemplateWithClient[]
     */
    public $ReadEmailTemplatesByClient;
}

class ReadEmailTemplatesByClientParam
{

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

    function createRequest()
    {
        return [
            "query" => self::ReadEmailTemplatesByClientDocument,
            "operationName" => "ReadEmailTemplatesByClient",
            "variables" => $this
        ];
    }

    const ReadEmailTemplatesByClientDocument = <<<EOF
query ReadEmailTemplatesByClient(\$clientId: String!) {
  ReadEmailTemplatesByClient(clientId: \$clientId) {
    _id
    user
    client
    template {
      _id
      type
      sender
      object
      hasURL
      URLExpireTime
      status
      redirectTo
      content
    }
    type
    sender
    object
    hasURL
    URLExpireTime
    redirectTo
    status
    content
  }
}
EOF;
}


class ReadEmailTemplatesBySystemResponse
{

    /**
     * @var EmailTemplateWithClient[]
     */
    public $ReadEmailTemplatesBySystem;
}

class ReadEmailTemplatesBySystemParam
{


    function createRequest()
    {
        return [
            "query" => self::ReadEmailTemplatesBySystemDocument,
            "operationName" => "ReadEmailTemplatesBySystem",
            "variables" => $this
        ];
    }

    const ReadEmailTemplatesBySystemDocument = <<<EOF
query ReadEmailTemplatesBySystem {
  ReadEmailTemplatesBySystem {
    _id
    user
    client
    template {
      _id
      type
      sender
      object
      hasURL
      URLExpireTime
      status
      redirectTo
      content
    }
    type
    sender
    object
    hasURL
    URLExpireTime
    redirectTo
    status
    content
  }
}
EOF;
}


class ReadOauthListResponse
{

    /**
     * @var OAuthList[]
     */
    public $ReadOauthList;
}

class ReadOauthListParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

    /**
     * Optional
     *
     * @var bool
     */
    public $dontGetURL;

    /**
     * Optional
     *
     * @var bool
     */
    public $useGuard;

    function createRequest()
    {
        return [
            "query" => self::ReadOauthListDocument,
            "operationName" => "ReadOauthList",
            "variables" => $this
        ];
    }

    const ReadOauthListDocument = <<<EOF
query ReadOauthList(\$clientId: String, \$dontGetURL: Boolean, \$useGuard: Boolean) {
  ReadOauthList(clientId: \$clientId, dontGetURL: \$dontGetURL, useGuard: \$useGuard) {
    _id
    name
    alias
    image
    description
    enabled
    url
    client
    user
    oAuthUrl
    wxappLogo
    fields {
      label
      type
      placeholder
      value
      checked
    }
    oauth {
      _id
      name
      alias
      image
      description
      enabled
      url
      client
      user
      oAuthUrl
      wxappLogo
    }
  }
}
EOF;
}


class ReadOrdersResponse
{

    /**
     * @var PagedOrders
     */
    public $ReadOrders;
}

class ReadOrdersParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $user;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::ReadOrdersDocument,
            "operationName" => "ReadOrders",
            "variables" => $this
        ];
    }

    const ReadOrdersDocument = <<<EOF
query ReadOrders(\$user: String, \$page: Int, \$count: Int) {
  ReadOrders(user: \$user, page: \$page, count: \$count) {
    list {
      _id
      client
      user
      timeOfPurchase
      flowNumber
      price
      createdAt
      completed
      payMethod
      endAt
    }
    totalCount
  }
}
EOF;
}


class ReadSamlspListResponse
{

    /**
     * @var SAMLSPListItem[]
     */
    public $ReadSAMLSPList;
}

class ReadSamlspListParam
{

    /**
     * Required
     *
     * @var string
     */
    public $clientId;

    function createRequest()
    {
        return [
            "query" => self::ReadSamlspListDocument,
            "operationName" => "ReadSAMLSPList",
            "variables" => $this
        ];
    }

    const ReadSamlspListDocument = <<<EOF
query ReadSAMLSPList(\$clientId: String!) {
  ReadSAMLSPList(clientId: \$clientId) {
    providerName
    url
    logo
  }
}
EOF;
}


class ReadSystemPricingResponse
{

    /**
     * @var PricingList[]
     */
    public $ReadSystemPricing;
}

class ReadSystemPricingParam
{


    function createRequest()
    {
        return [
            "query" => self::ReadSystemPricingDocument,
            "operationName" => "ReadSystemPricing",
            "variables" => $this
        ];
    }

    const ReadSystemPricingDocument = <<<EOF
query ReadSystemPricing {
  ReadSystemPricing {
    _id
    type
    startNumber
    freeNumber
    startPrice
    maxNumber
    d
    features
  }
}
EOF;
}


class ReadUserPricingResponse
{

    /**
     * @var UserPricingType
     */
    public $ReadUserPricing;
}

class ReadUserPricingParam
{

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
    public $clientId;

    function createRequest()
    {
        return [
            "query" => self::ReadUserPricingDocument,
            "operationName" => "ReadUserPricing",
            "variables" => $this
        ];
    }

    const ReadUserPricingDocument = <<<EOF
query ReadUserPricing(\$userId: String, \$clientId: String) {
  ReadUserPricing(userId: \$userId, clientId: \$clientId) {
    user
    client
    isFree
    pricing {
      number
    }
    freeNumber
  }
}
EOF;
}


class TestLdapServerResponse
{

    /**
     * @var LDAPServerTesterType
     */
    public $TestLDAPServer;
}

class TestLdapServerParam
{

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
    public $clientId;

    /**
     * Required
     *
     * @var string
     */
    public $userId;

    /**
     * Required
     *
     * @var string
     */
    public $ldapLink;

    /**
     * Required
     *
     * @var string
     */
    public $baseDN;

    /**
     * Required
     *
     * @var string
     */
    public $searchStandard;

    /**
     * Required
     *
     * @var string
     */
    public $username;

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
    public $emailPostfix;

    /**
     * Optional
     *
     * @var string
     */
    public $description;

    /**
     * Optional
     *
     * @var bool
     */
    public $enabled;

    function createRequest()
    {
        return [
            "query" => self::TestLdapServerDocument,
            "operationName" => "TestLDAPServer",
            "variables" => $this
        ];
    }

    const TestLdapServerDocument = <<<EOF
query TestLDAPServer(\$name: String!, \$clientId: String!, \$userId: String!, \$ldapLink: String!, \$baseDN: String!, \$searchStandard: String!, \$username: String!, \$password: String!, \$emailPostfix: String, \$description: String, \$enabled: Boolean) {
  TestLDAPServer(name: \$name, clientId: \$clientId, userId: \$userId, ldapLink: \$ldapLink, baseDN: \$baseDN, searchStandard: \$searchStandard, username: \$username, password: \$password, emailPostfix: \$emailPostfix, description: \$description, enabled: \$enabled) {
    result
  }
}
EOF;
}


class TestLdapUserResponse
{

    /**
     * @var LDAPUserTesterType
     */
    public $TestLDAPUser;
}

class TestLdapUserParam
{

    /**
     * Required
     *
     * @var string
     */
    public $testUsername;

    /**
     * Required
     *
     * @var string
     */
    public $testPassword;

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
    public $clientId;

    /**
     * Required
     *
     * @var string
     */
    public $userId;

    /**
     * Required
     *
     * @var string
     */
    public $ldapLink;

    /**
     * Required
     *
     * @var string
     */
    public $baseDN;

    /**
     * Required
     *
     * @var string
     */
    public $searchStandard;

    /**
     * Required
     *
     * @var string
     */
    public $username;

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
    public $emailPostfix;

    /**
     * Optional
     *
     * @var string
     */
    public $description;

    /**
     * Optional
     *
     * @var bool
     */
    public $enabled;

    function createRequest()
    {
        return [
            "query" => self::TestLdapUserDocument,
            "operationName" => "TestLDAPUser",
            "variables" => $this
        ];
    }

    const TestLdapUserDocument = <<<EOF
query TestLDAPUser(\$testUsername: String!, \$testPassword: String!, \$name: String!, \$clientId: String!, \$userId: String!, \$ldapLink: String!, \$baseDN: String!, \$searchStandard: String!, \$username: String!, \$password: String!, \$emailPostfix: String, \$description: String, \$enabled: Boolean) {
  TestLDAPUser(testUsername: \$testUsername, testPassword: \$testPassword, name: \$name, clientId: \$clientId, userId: \$userId, ldapLink: \$ldapLink, baseDN: \$baseDN, searchStandard: \$searchStandard, username: \$username, password: \$password, emailPostfix: \$emailPostfix, description: \$description, enabled: \$enabled) {
    result
  }
}
EOF;
}


class AdConnectorByProviderResponse
{

    /**
     * @var ADConnctorCommonInfo
     */
    public $adConnectorByProvider;
}

class AdConnectorByProviderParam
{

    /**
     * Required
     *
     * @var string
     */
    public $providerId;

    /**
     * Required
     *
     * @var ProviderType
     */
    public $providerType;

    function createRequest()
    {
        return [
            "query" => self::AdConnectorByProviderDocument,
            "operationName" => "adConnectorByProvider",
            "variables" => $this
        ];
    }

    const AdConnectorByProviderDocument = <<<EOF
query adConnectorByProvider(\$providerId: String!, \$providerType: providerType!) {
  adConnectorByProvider(providerId: \$providerId, providerType: \$providerType) {
    _id
    name
    logo
    status
  }
}
EOF;
}


class AdConnectorListResponse
{

    /**
     * @var ADConnector[]
     */
    public $adConnectorList;
}

class AdConnectorListParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    /**
     * Optional
     *
     * @var ProviderType
     */
    public $providerType;

    function createRequest()
    {
        return [
            "query" => self::AdConnectorListDocument,
            "operationName" => "adConnectorList",
            "variables" => $this
        ];
    }

    const AdConnectorListDocument = <<<EOF
query adConnectorList(\$userPoolId: String!, \$providerType: providerType) {
  adConnectorList(userPoolId: \$userPoolId, providerType: \$providerType) {
    _id
    name
    secret
    salt
    logo
    enabled
    userPoolId
    status
    createdAt
  }
}
EOF;
}


class BindedOAuthListResponse
{

    /**
     * @var UserOAuthBind[]
     */
    public $bindedOAuthList;
}

class BindedOAuthListParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     */
    public $user;

    function createRequest()
    {
        return [
            "query" => self::BindedOAuthListDocument,
            "operationName" => "bindedOAuthList",
            "variables" => $this
        ];
    }

    const BindedOAuthListDocument = <<<EOF
query bindedOAuthList(\$client: String!, \$user: String) {
  bindedOAuthList(client: \$client, user: \$user) {
    _id
    user
    client
    type
    unionid
    userInfo
    createdAt
  }
}
EOF;
}


class CheckAdConnectorStatusResponse
{

    /**
     * @var bool
     */
    public $checkAdConnectorStatus;
}

class CheckAdConnectorStatusParam
{

    /**
     * Required
     *
     * @var string
     */
    public $adConnectorId;

    function createRequest()
    {
        return [
            "query" => self::CheckAdConnectorStatusDocument,
            "operationName" => "checkAdConnectorStatus",
            "variables" => $this
        ];
    }

    const CheckAdConnectorStatusDocument = <<<EOF
query checkAdConnectorStatus(\$adConnectorId: String!) {
  checkAdConnectorStatus(adConnectorId: \$adConnectorId)
}
EOF;
}


class CheckIsReservedDomainResponse
{

    /**
     * @var IsReservedDomain
     */
    public $checkIsReservedDomain;
}

class CheckIsReservedDomainParam
{

    /**
     * Required
     *
     * @var string
     */
    public $domainValue;

    function createRequest()
    {
        return [
            "query" => self::CheckIsReservedDomainDocument,
            "operationName" => "checkIsReservedDomain",
            "variables" => $this
        ];
    }

    const CheckIsReservedDomainDocument = <<<EOF
query checkIsReservedDomain(\$domainValue: String!) {
  checkIsReservedDomain(domainValue: \$domainValue) {
    domainValue
    isReserved
  }
}
EOF;
}


class CheckLoginStatusResponse
{

    /**
     * @var JWTDecodedDataCheckLogin
     */
    public $checkLoginStatus;
}

class CheckLoginStatusParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $token;

    function createRequest()
    {
        return [
            "query" => self::CheckLoginStatusDocument,
            "operationName" => "checkLoginStatus",
            "variables" => $this
        ];
    }

    const CheckLoginStatusDocument = <<<EOF
query checkLoginStatus(\$token: String) {
  checkLoginStatus(token: \$token) {
    message
    code
    status
    token {
      iat
      exp
    }
  }
}
EOF;
}


class CheckPhoneCodeResponse
{

    /**
     * @var CommonMessage
     */
    public $checkPhoneCode;
}

class CheckPhoneCodeParam
{

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
    public $phone;

    /**
     * Required
     *
     * @var string
     */
    public $phoneCode;

    function createRequest()
    {
        return [
            "query" => self::CheckPhoneCodeDocument,
            "operationName" => "checkPhoneCode",
            "variables" => $this
        ];
    }

    const CheckPhoneCodeDocument = <<<EOF
query checkPhoneCode(\$userPoolId: String!, \$phone: String!, \$phoneCode: String!) {
  checkPhoneCode(userPoolId: \$userPoolId, phone: \$phone, phoneCode: \$phoneCode) {
    message
    code
    status
  }
}
EOF;
}


class ClientResponse
{

    /**
     * @var UserClient
     */
    public $client;
}

class ClientParam
{

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
    public $userId;

    /**
     * Optional
     *
     * @var bool
     */
    public $fromAdmin;

    function createRequest()
    {
        return [
            "query" => self::ClientDocument,
            "operationName" => "client",
            "variables" => $this
        ];
    }

    const ClientDocument = <<<EOF
query client(\$id: String!, \$userId: String, \$fromAdmin: Boolean) {
  client(id: \$id, userId: \$userId, fromAdmin: \$fromAdmin) {
    _id
    user {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userPoolTypes {
      _id
      name
      description
      image
      example
    }
    usersCount
    logo
    emailVerifiedDefault
    sendWelcomeEmail
    registerDisabled
    showWXMPQRCode
    useMiniLogin
    useSelfWxapp
    allowedOrigins
    name
    secret
    token
    descriptions
    jwtExpired
    createdAt
    isDeleted
    frequentRegisterCheck {
      timeInterval
      limit
      enable
    }
    loginFailCheck {
      timeInterval
      limit
      enable
    }
    enableEmail
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
  }
}
EOF;
}


class ClientRolesResponse
{

    /**
     * @var PagedRoles
     */
    public $clientRoles;
}

class ClientRolesParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::ClientRolesDocument,
            "operationName" => "clientRoles",
            "variables" => $this
        ];
    }

    const ClientRolesDocument = <<<EOF
query clientRoles(\$client: String!, \$page: Int, \$count: Int) {
  clientRoles(client: \$client, page: \$page, count: \$count) {
    list {
      _id
      name
      descriptions
      client
      permissions
      createdAt
    }
    totalCount
  }
}
EOF;
}


class DecodeJwtTokenResponse
{

    /**
     * @var JwtDecodedData
     */
    public $decodeJwtToken;
}

class DecodeJwtTokenParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $token;

    function createRequest()
    {
        return [
            "query" => self::DecodeJwtTokenDocument,
            "operationName" => "decodeJwtToken",
            "variables" => $this
        ];
    }

    const DecodeJwtTokenDocument = <<<EOF
query decodeJwtToken(\$token: String) {
  decodeJwtToken(token: \$token) {
    data {
      email
      id
      clientId
      unionid
    }
    status {
      message
      code
      status
    }
    iat
    exp
  }
}
EOF;
}


class EmailDomainTopNListResponse
{

    /**
     * @var LoginTopEmailList[]
     */
    public $emailDomainTopNList;
}

class EmailDomainTopNListParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    function createRequest()
    {
        return [
            "query" => self::EmailDomainTopNListDocument,
            "operationName" => "emailDomainTopNList",
            "variables" => $this
        ];
    }

    const EmailDomainTopNListDocument = <<<EOF
query emailDomainTopNList(\$userPoolId: String!) {
  emailDomainTopNList(userPoolId: \$userPoolId) {
    domain
    count
  }
}
EOF;
}


class FindClientsByIdArrayResponse
{

    /**
     * @var PagedUserClientList
     */
    public $findClientsByIdArray;
}

class FindClientsByIdArrayParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $clientsId;

    function createRequest()
    {
        return [
            "query" => self::FindClientsByIdArrayDocument,
            "operationName" => "findClientsByIdArray",
            "variables" => $this
        ];
    }

    const FindClientsByIdArrayDocument = <<<EOF
query findClientsByIdArray(\$clientsId: [String]) {
  findClientsByIdArray(clientsId: \$clientsId) {
    list {
      _id
      name
      createdAt
      usersCount
    }
    totalCount
  }
}
EOF;
}


class GetAccessTokenByAppSecretResponse
{

    /**
     * @var string
     */
    public $getAccessTokenByAppSecret;
}

class GetAccessTokenByAppSecretParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $secret;

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

    /**
     * Optional
     *
     * @var bool
     */
    public $retUserId;

    /**
     * Optional
     *
     * @var string
     */
    public $timestamp;

    /**
     * Optional
     *
     * @var string
     */
    public $signature;

    /**
     * Optional
     *
     * @var int
     */
    public $nonce;

    function createRequest()
    {
        return [
            "query" => self::GetAccessTokenByAppSecretDocument,
            "operationName" => "getAccessTokenByAppSecret",
            "variables" => $this
        ];
    }

    const GetAccessTokenByAppSecretDocument = <<<EOF
query getAccessTokenByAppSecret(\$secret: String, \$clientId: String, \$retUserId: Boolean, \$timestamp: String, \$signature: String, \$nonce: Int) {
  getAccessTokenByAppSecret(secret: \$secret, clientId: \$clientId, retUserId: \$retUserId, timestamp: \$timestamp, signature: \$signature, nonce: \$nonce)
}
EOF;
}


class GetAllWebhooksResponse
{

    /**
     * @var ClientWebhook[]
     */
    public $getAllWebhooks;
}

class GetAllWebhooksParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::GetAllWebhooksDocument,
            "operationName" => "getAllWebhooks",
            "variables" => $this
        ];
    }

    const GetAllWebhooksDocument = <<<EOF
query getAllWebhooks(\$client: String!) {
  getAllWebhooks(client: \$client) {
    _id
    client
    events {
      name
      label
      description
    }
    url
    isLastTimeSuccess
    contentType
    secret
    enable
  }
}
EOF;
}


class GetAppSecretByClientIdResponse
{

    /**
     * @var AppSecretByClientId
     */
    public $getAppSecretByClientId;
}

class GetAppSecretByClientIdParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $token;

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

    function createRequest()
    {
        return [
            "query" => self::GetAppSecretByClientIdDocument,
            "operationName" => "getAppSecretByClientId",
            "variables" => $this
        ];
    }

    const GetAppSecretByClientIdDocument = <<<EOF
query getAppSecretByClientId(\$token: String, \$clientId: String) {
  getAppSecretByClientId(token: \$token, clientId: \$clientId) {
    secret
    clientId
  }
}
EOF;
}


class GetClientWhenSdkInitResponse
{

    /**
     * @var ClientInfoAndAccessToken
     */
    public $getClientWhenSdkInit;
}

class GetClientWhenSdkInitParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $secret;

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

    /**
     * Optional
     *
     * @var bool
     */
    public $retUserId;

    /**
     * Optional
     *
     * @var string
     */
    public $timestamp;

    /**
     * Optional
     *
     * @var string
     */
    public $signature;

    /**
     * Optional
     *
     * @var int
     */
    public $nonce;

    function createRequest()
    {
        return [
            "query" => self::GetClientWhenSdkInitDocument,
            "operationName" => "getClientWhenSdkInit",
            "variables" => $this
        ];
    }

    const GetClientWhenSdkInitDocument = <<<EOF
query getClientWhenSdkInit(\$secret: String, \$clientId: String, \$retUserId: Boolean, \$timestamp: String, \$signature: String, \$nonce: Int) {
  getClientWhenSdkInit(secret: \$secret, clientId: \$clientId, retUserId: \$retUserId, timestamp: \$timestamp, signature: \$signature, nonce: \$nonce) {
    clientInfo {
      _id
      usersCount
      logo
      emailVerifiedDefault
      sendWelcomeEmail
      registerDisabled
      showWXMPQRCode
      useMiniLogin
      useSelfWxapp
      allowedOrigins
      name
      secret
      token
      descriptions
      jwtExpired
      createdAt
      isDeleted
      enableEmail
    }
    accessToken
  }
}
EOF;
}


class GetCustomMfaResponse
{

    /**
     * @var PagedCustomMFAList
     */
    public $getCustomMFA;
}

class GetCustomMfaParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userIdInMiniLogin;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::GetCustomMfaDocument,
            "operationName" => "getCustomMFA",
            "variables" => $this
        ];
    }

    const GetCustomMfaDocument = <<<EOF
query getCustomMFA(\$userIdInMiniLogin: String!, \$page: Int, \$count: Int) {
  getCustomMFA(userIdInMiniLogin: \$userIdInMiniLogin, page: \$page, count: \$count) {
    list {
      _id
      userIdInMiniLogin
      remark
      name
      secret
    }
    total
  }
}
EOF;
}


class GetOAuthedAppInfoResponse
{

    /**
     * @var OAuthProviderClient
     */
    public $getOAuthedAppInfo;
}

class GetOAuthedAppInfoParam
{

    /**
     * Required
     *
     * @var string
     */
    public $appId;

    function createRequest()
    {
        return [
            "query" => self::GetOAuthedAppInfoDocument,
            "operationName" => "getOAuthedAppInfo",
            "variables" => $this
        ];
    }

    const GetOAuthedAppInfoDocument = <<<EOF
query getOAuthedAppInfo(\$appId: String!) {
  getOAuthedAppInfo(appId: \$appId) {
    _id
    name
    domain
    image
    redirectUris
    appSecret
    client_id
    clientId
    grants
    description
    homepageURL
    isDeleted
    when
    css
    loginUrl
    casExpire
  }
}
EOF;
}


class GetOAuthedAppListResponse
{

    /**
     * @var OAuthAppPagedList
     */
    public $getOAuthedAppList;
}

class GetOAuthedAppListParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::GetOAuthedAppListDocument,
            "operationName" => "getOAuthedAppList",
            "variables" => $this
        ];
    }

    const GetOAuthedAppListDocument = <<<EOF
query getOAuthedAppList(\$clientId: String, \$page: Int, \$count: Int) {
  getOAuthedAppList(clientId: \$clientId, page: \$page, count: \$count) {
    totalCount
    list {
      _id
      name
      domain
      image
      redirectUris
      appSecret
      client_id
      clientId
      grants
      description
      homepageURL
      isDeleted
      when
      css
      loginUrl
      casExpire
    }
  }
}
EOF;
}


class GetUserLoginAreaStatisticOfClientResponse
{

    /**
     * @var string
     */
    public $getUserLoginAreaStatisticOfClient;
}

class GetUserLoginAreaStatisticOfClientParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPool;

    /**
     * Optional
     *
     * @var string
     */
    public $start;

    /**
     * Optional
     *
     * @var string
     */
    public $end;

    function createRequest()
    {
        return [
            "query" => self::GetUserLoginAreaStatisticOfClientDocument,
            "operationName" => "getUserLoginAreaStatisticOfClient",
            "variables" => $this
        ];
    }

    const GetUserLoginAreaStatisticOfClientDocument = <<<EOF
query getUserLoginAreaStatisticOfClient(\$userPool: String!, \$start: String, \$end: String) {
  getUserLoginAreaStatisticOfClient(userPool: \$userPool, start: \$start, end: \$end)
}
EOF;
}


class GetUserPoolSettingsResponse
{

    /**
     * @var UserClient
     */
    public $getUserPoolSettings;
}

class GetUserPoolSettingsParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    function createRequest()
    {
        return [
            "query" => self::GetUserPoolSettingsDocument,
            "operationName" => "getUserPoolSettings",
            "variables" => $this
        ];
    }

    const GetUserPoolSettingsDocument = <<<EOF
query getUserPoolSettings(\$userPoolId: String!) {
  getUserPoolSettings(userPoolId: \$userPoolId) {
    _id
    user {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userPoolTypes {
      _id
      name
      description
      image
      example
    }
    usersCount
    logo
    emailVerifiedDefault
    sendWelcomeEmail
    registerDisabled
    showWXMPQRCode
    useMiniLogin
    useSelfWxapp
    allowedOrigins
    name
    secret
    token
    descriptions
    jwtExpired
    createdAt
    isDeleted
    frequentRegisterCheck {
      timeInterval
      limit
      enable
    }
    loginFailCheck {
      timeInterval
      limit
      enable
    }
    enableEmail
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
  }
}
EOF;
}


class GetWebhookDetailResponse
{

    /**
     * @var ClientWebhook
     */
    public $getWebhookDetail;
}

class GetWebhookDetailParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::GetWebhookDetailDocument,
            "operationName" => "getWebhookDetail",
            "variables" => $this
        ];
    }

    const GetWebhookDetailDocument = <<<EOF
query getWebhookDetail(\$client: String!) {
  getWebhookDetail(client: \$client) {
    _id
    client
    events {
      name
      label
      description
    }
    url
    isLastTimeSuccess
    contentType
    secret
    enable
  }
}
EOF;
}


class GetWebhookLogDetailResponse
{

    /**
     * @var WebhookLog
     */
    public $getWebhookLogDetail;
}

class GetWebhookLogDetailParam
{

    /**
     * Required
     *
     * @var string
     */
    public $id;

    function createRequest()
    {
        return [
            "query" => self::GetWebhookLogDetailDocument,
            "operationName" => "getWebhookLogDetail",
            "variables" => $this
        ];
    }

    const GetWebhookLogDetailDocument = <<<EOF
query getWebhookLogDetail(\$id: String!) {
  getWebhookLogDetail(id: \$id) {
    _id
    webhook
    client
    event
    request {
      headers
      payload
    }
    response {
      headers
      body
      statusCode
    }
    errorMessage
    when
  }
}
EOF;
}


class GetWebhookLogsResponse
{

    /**
     * @var WebhookLog[]
     */
    public $getWebhookLogs;
}

class GetWebhookLogsParam
{

    /**
     * Required
     *
     * @var string
     */
    public $webhook;

    function createRequest()
    {
        return [
            "query" => self::GetWebhookLogsDocument,
            "operationName" => "getWebhookLogs",
            "variables" => $this
        ];
    }

    const GetWebhookLogsDocument = <<<EOF
query getWebhookLogs(\$webhook: String!) {
  getWebhookLogs(webhook: \$webhook) {
    _id
    webhook
    client
    event
    request {
      headers
      payload
    }
    response {
      headers
      body
      statusCode
    }
    errorMessage
    when
  }
}
EOF;
}


class GetWebhookSettingOptionsResponse
{

    /**
     * @var WebhookSettingOptions
     */
    public $getWebhookSettingOptions;
}

class GetWebhookSettingOptionsParam
{


    function createRequest()
    {
        return [
            "query" => self::GetWebhookSettingOptionsDocument,
            "operationName" => "getWebhookSettingOptions",
            "variables" => $this
        ];
    }

    const GetWebhookSettingOptionsDocument = <<<EOF
query getWebhookSettingOptions {
  getWebhookSettingOptions {
    webhookEvents {
      name
      label
      description
    }
    contentTypes {
      name
      label
    }
  }
}
EOF;
}


class InterConnectionsResponse
{

    /**
     * @var InterConnection[]
     */
    public $interConnections;
}

class InterConnectionsParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    function createRequest()
    {
        return [
            "query" => self::InterConnectionsDocument,
            "operationName" => "interConnections",
            "variables" => $this
        ];
    }

    const InterConnectionsDocument = <<<EOF
query interConnections(\$userPoolId: String!) {
  interConnections(userPoolId: \$userPoolId) {
    sourceUserId
    sourceUserPoolId
    targetUserId
    targetUserPoolId
    enabled
    expiresdAt
  }
}
EOF;
}


class IsAdConnectorAliveResponse
{

    /**
     * @var isAdConenctorAlive
     */
    public $isAdConnectorAlive;
}

class IsAdConnectorAliveParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $adConnectorId;

    function createRequest()
    {
        return [
            "query" => self::IsAdConnectorAliveDocument,
            "operationName" => "isAdConnectorAlive",
            "variables" => $this
        ];
    }

    const IsAdConnectorAliveDocument = <<<EOF
query isAdConnectorAlive(\$adConnectorId: String) {
  isAdConnectorAlive(adConnectorId: \$adConnectorId) {
    isAlive
  }
}
EOF;
}


class IsAppAuthorizedByUserResponse
{

    /**
     * @var IsAppAuthorizedByUser
     */
    public $isAppAuthorizedByUser;
}

class IsAppAuthorizedByUserParam
{

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
    public $appId;

    function createRequest()
    {
        return [
            "query" => self::IsAppAuthorizedByUserDocument,
            "operationName" => "isAppAuthorizedByUser",
            "variables" => $this
        ];
    }

    const IsAppAuthorizedByUserDocument = <<<EOF
query isAppAuthorizedByUser(\$userId: String, \$appId: String) {
  isAppAuthorizedByUser(userId: \$userId, appId: \$appId) {
    authorized
  }
}
EOF;
}


class IsClientBelongToUserResponse
{

    /**
     * @var bool
     */
    public $isClientBelongToUser;
}

class IsClientBelongToUserParam
{

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
    public $clientId;

    /**
     * Optional
     *
     * @var PermissionDescriptorsListInputType
     */
    public $permissionDescriptors;

    function createRequest()
    {
        return [
            "query" => self::IsClientBelongToUserDocument,
            "operationName" => "isClientBelongToUser",
            "variables" => $this
        ];
    }

    const IsClientBelongToUserDocument = <<<EOF
query isClientBelongToUser(\$userId: String, \$clientId: String, \$permissionDescriptors: [PermissionDescriptorsListInputType]) {
  isClientBelongToUser(userId: \$userId, clientId: \$clientId, permissionDescriptors: \$permissionDescriptors)
}
EOF;
}


class IsClientOfUserResponse
{

    /**
     * @var bool
     */
    public $isClientOfUser;
}

class IsClientOfUserParam
{

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
    public $password;

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

    function createRequest()
    {
        return [
            "query" => self::IsClientOfUserDocument,
            "operationName" => "isClientOfUser",
            "variables" => $this
        ];
    }

    const IsClientOfUserDocument = <<<EOF
query isClientOfUser(\$email: String, \$password: String, \$clientId: String) {
  isClientOfUser(email: \$email, password: \$password, clientId: \$clientId)
}
EOF;
}


class IsDomainAvaliableResponse
{

    /**
     * @var bool
     */
    public $isDomainAvaliable;
}

class IsDomainAvaliableParam
{

    /**
     * Required
     *
     * @var string
     */
    public $domain;

    function createRequest()
    {
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


class IsLoginExpiredResponse
{

    /**
     * @var bool
     */
    public $isLoginExpired;
}

class IsLoginExpiredParam
{

    /**
     * Required
     *
     * @var string
     */
    public $id;

    function createRequest()
    {
        return [
            "query" => self::IsLoginExpiredDocument,
            "operationName" => "isLoginExpired",
            "variables" => $this
        ];
    }

    const IsLoginExpiredDocument = <<<EOF
query isLoginExpired(\$id: String!) {
  isLoginExpired(id: \$id)
}
EOF;
}


class IsRootNodeOfOrgResponse
{

    /**
     * @var bool
     */
    public $isRootNodeOfOrg;
}

class IsRootNodeOfOrgParam
{

    /**
     * Required
     *
     * @var IsRootNodeOfOrgInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::IsRootNodeOfOrgDocument,
            "operationName" => "isRootNodeOfOrg",
            "variables" => $this
        ];
    }

    const IsRootNodeOfOrgDocument = <<<EOF
query isRootNodeOfOrg(\$input: IsRootNodeOfOrgInput!) {
  isRootNodeOfOrg(input: \$input)
}
EOF;
}


class IsUserInGroupResponse
{

    /**
     * @var bool
     */
    public $isUserInGroup;
}

class IsUserInGroupParam
{

    /**
     * Required
     *
     * @var string
     */
    public $groupId;

    /**
     * Required
     *
     * @var string
     */
    public $userId;

    function createRequest()
    {
        return [
            "query" => self::IsUserInGroupDocument,
            "operationName" => "isUserInGroup",
            "variables" => $this
        ];
    }

    const IsUserInGroupDocument = <<<EOF
query isUserInGroup(\$groupId: String!, \$userId: String!) {
  isUserInGroup(groupId: \$groupId, userId: \$userId)
}
EOF;
}


class LoginBySecretResponse
{

    /**
     * @var string
     */
    public $loginBySecret;
}

class LoginBySecretParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

    /**
     * Optional
     *
     * @var string
     */
    public $secret;

    function createRequest()
    {
        return [
            "query" => self::LoginBySecretDocument,
            "operationName" => "loginBySecret",
            "variables" => $this
        ];
    }

    const LoginBySecretDocument = <<<EOF
query loginBySecret(\$clientId: String, \$secret: String) {
  getAccessTokenByAppSecret(clientId: \$clientId, secret: \$secret)
}
EOF;
}


class LoginCountResponse
{

    /**
     * @var UserLoginCount
     */
    public $loginCount;
}

class LoginCountParam
{

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
    public $clientId;

    /**
     * Optional
     *
     * @var string
     */
    public $month;

    function createRequest()
    {
        return [
            "query" => self::LoginCountDocument,
            "operationName" => "loginCount",
            "variables" => $this
        ];
    }

    const LoginCountDocument = <<<EOF
query loginCount(\$userId: String, \$clientId: String, \$month: String) {
  loginCount(userId: \$userId, clientId: \$clientId, month: \$month) {
    _id
    client
    count
    month
    isError
    totalNumber
  }
}
EOF;
}


class LoginHotDotPicDataResponse
{

    /**
     * @var LoginHotDotPicData
     */
    public $loginHotDotPicData;
}

class LoginHotDotPicDataParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::LoginHotDotPicDataDocument,
            "operationName" => "loginHotDotPicData",
            "variables" => $this
        ];
    }

    const LoginHotDotPicDataDocument = <<<EOF
query loginHotDotPicData(\$client: String) {
  loginHotDotPicData(client: \$client) {
    list
  }
}
EOF;
}


class NotBindOAuthListResponse
{

    /**
     * @var NotBindOAuth[]
     */
    public $notBindOAuthList;
}

class NotBindOAuthListParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $client;

    /**
     * Optional
     *
     * @var string
     */
    public $user;

    function createRequest()
    {
        return [
            "query" => self::NotBindOAuthListDocument,
            "operationName" => "notBindOAuthList",
            "variables" => $this
        ];
    }

    const NotBindOAuthListDocument = <<<EOF
query notBindOAuthList(\$client: String, \$user: String) {
  notBindOAuthList(client: \$client, user: \$user) {
    type
    oAuthUrl
    image
    name
    binded
  }
}
EOF;
}


class OrgResponse
{

    /**
     * @var Org
     */
    public $org;
}

class OrgParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::OrgDocument,
            "operationName" => "org",
            "variables" => $this
        ];
    }

    const OrgDocument = <<<EOF
query org(\$_id: String!) {
  org(_id: \$_id) {
    _id
    nodes {
      _id
      name
      description
      createdAt
      updatedAt
      children
      root
    }
  }
}
EOF;
}


class OrgChildrenNodesResponse
{

    /**
     * @var OrgChildNode[]
     */
    public $orgChildrenNodes;
}

class OrgChildrenNodesParam
{

    /**
     * Required
     *
     * @var OrgChildrenNodesInput
     */
    public $input;

    function createRequest()
    {
        return [
            "query" => self::OrgChildrenNodesDocument,
            "operationName" => "orgChildrenNodes",
            "variables" => $this
        ];
    }

    const OrgChildrenNodesDocument = <<<EOF
query orgChildrenNodes(\$input: OrgChildrenNodesInput!) {
  orgChildrenNodes(input: \$input) {
    group {
      _id
      userPoolId
      name
      description
      createdAt
      updatedAt
    }
    depth
  }
}
EOF;
}


class OrgNodeUserListResponse
{

    /**
     * @var PagedUsers
     */
    public $orgNodeUserList;
}

class OrgNodeUserListParam
{

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
    public $count;

    /**
     * Optional
     *
     * @var bool
     */
    public $includeChildrenNodes;

    function createRequest()
    {
        return [
            "query" => self::OrgNodeUserListDocument,
            "operationName" => "orgNodeUserList",
            "variables" => $this
        ];
    }

    const OrgNodeUserListDocument = <<<EOF
query orgNodeUserList(\$orgId: String!, \$nodeId: String!, \$page: Int, \$count: Int, \$includeChildrenNodes: Boolean) {
  orgNodeUserList(orgId: \$orgId, nodeId: \$nodeId, page: \$page, count: \$count, includeChildrenNodes: \$includeChildrenNodes) {
    list {
      _id
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      username
      nickname
      company
      photo
      browser
      device
      password
      registerInClient
      registerMethod
      oauth
      token
      tokenExpiredAt
      loginsCount
      lastLogin
      lastIP
      signedUp
      blocked
      isDeleted
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
      country
      updatedAt
      customData
      metadata
    }
    totalCount
  }
}
EOF;
}


class OrgRootNodeResponse
{

    /**
     * @var RBACGroup
     */
    public $orgRootNode;
}

class OrgRootNodeParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::OrgRootNodeDocument,
            "operationName" => "orgRootNode",
            "variables" => $this
        ];
    }

    const OrgRootNodeDocument = <<<EOF
query orgRootNode(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$_id: String!) {
  orgRootNode(_id: \$_id) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    roles {
      totalCount
    }
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class OrgsResponse
{

    /**
     * @var PagedOrg
     */
    public $orgs;
}

class OrgsParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    function createRequest()
    {
        return [
            "query" => self::OrgsDocument,
            "operationName" => "orgs",
            "variables" => $this
        ];
    }

    const OrgsDocument = <<<EOF
query orgs(\$userPoolId: String!) {
  orgs(userPoolId: \$userPoolId) {
    totalCount
    list {
      _id
      logo
      nodes {
        _id
        name
        description
        createdAt
        updatedAt
        children
        root
      }
    }
  }
}
EOF;
}


class PlatformUserGrowthTrendResponse
{

    /**
     * @var DayUserGrowth[]
     */
    public $platformUserGrowthTrend;
}

class PlatformUserGrowthTrendParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $today;

    function createRequest()
    {
        return [
            "query" => self::PlatformUserGrowthTrendDocument,
            "operationName" => "platformUserGrowthTrend",
            "variables" => $this
        ];
    }

    const PlatformUserGrowthTrendDocument = <<<EOF
query platformUserGrowthTrend(\$today: String) {
  platformUserGrowthTrend(today: \$today) {
    day
    count
  }
}
EOF;
}


class PreviewEmailTemplateResponse
{

    /**
     * @var CommonMessage
     */
    public $previewEmailTemplate;
}

class PreviewEmailTemplateParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $type;

    /**
     * Optional
     *
     * @var string
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::PreviewEmailTemplateDocument,
            "operationName" => "previewEmailTemplate",
            "variables" => $this
        ];
    }

    const PreviewEmailTemplateDocument = <<<EOF
query previewEmailTemplate(\$type: String, \$client: String) {
  previewEmailTemplate(type: \$type, client: \$client) {
    message
    code
    status
  }
}
EOF;
}


class ProviderListByAdConnectorResponse
{

    /**
     * @var ADConnectorEnabledProvider[]
     */
    public $providerListByADConnector;
}

class ProviderListByAdConnectorParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::ProviderListByAdConnectorDocument,
            "operationName" => "providerListByADConnector",
            "variables" => $this
        ];
    }

    const ProviderListByAdConnectorDocument = <<<EOF
query providerListByADConnector(\$_id: String!) {
  providerListByADConnector(_id: \$_id) {
    providerType
    providerId
    userPoolId
    adConnectorId
  }
}
EOF;
}


class QiNiuUploadTokenResponse
{

    /**
     * @var string
     */
    public $qiNiuUploadToken;
}

class QiNiuUploadTokenParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $type;

    function createRequest()
    {
        return [
            "query" => self::QiNiuUploadTokenDocument,
            "operationName" => "qiNiuUploadToken",
            "variables" => $this
        ];
    }

    const QiNiuUploadTokenDocument = <<<EOF
query qiNiuUploadToken(\$type: String) {
  qiNiuUploadToken(type: \$type)
}
EOF;
}


class QpsByTimeResponse
{

    /**
     * @var QpsByTime[]
     */
    public $qpsByTime;
}

class QpsByTimeParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $startTime;

    /**
     * Optional
     *
     * @var string
     */
    public $endTime;

    /**
     * Optional
     *
     * @var string
     */
    public $currentTime;

    function createRequest()
    {
        return [
            "query" => self::QpsByTimeDocument,
            "operationName" => "qpsByTime",
            "variables" => $this
        ];
    }

    const QpsByTimeDocument = <<<EOF
query qpsByTime(\$startTime: String, \$endTime: String, \$currentTime: String) {
  qpsByTime(startTime: \$startTime, endTime: \$endTime, currentTime: \$currentTime) {
    qps
    time
  }
}
EOF;
}


class QueryAuthAuditRecordsResponse
{

    /**
     * @var AuthAuditRecordsList
     */
    public $queryAuthAuditRecords;
}

class QueryAuthAuditRecordsParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    /**
     * Optional
     *
     * @var string
     */
    public $sortBy;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::QueryAuthAuditRecordsDocument,
            "operationName" => "queryAuthAuditRecords",
            "variables" => $this
        ];
    }

    const QueryAuthAuditRecordsDocument = <<<EOF
query queryAuthAuditRecords(\$userPoolId: String!, \$sortBy: String, \$page: Int, \$count: Int) {
  queryAuthAuditRecords(userPoolId: \$userPoolId, sortBy: \$sortBy, page: \$page, count: \$count) {
    list {
      userPoolId
      appType
      appId
      event
      userId
      createdAt
    }
    totalCount
  }
}
EOF;
}


class QueryAuthorizedUserPoolResponse
{

    /**
     * @var PagedUserPoolWithMFA
     */
    public $queryAuthorizedUserPool;
}

class QueryAuthorizedUserPoolParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $unionid;

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
    public $openid;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::QueryAuthorizedUserPoolDocument,
            "operationName" => "queryAuthorizedUserPool",
            "variables" => $this
        ];
    }

    const QueryAuthorizedUserPoolDocument = <<<EOF
query queryAuthorizedUserPool(\$unionid: String, \$phone: String, \$openid: String, \$page: Int, \$count: Int) {
  queryAuthorizedUserPool(unionid: \$unionid, phone: \$phone, openid: \$openid, page: \$page, count: \$count) {
    list {
      userId
    }
    total
  }
}
EOF;
}


class QueryClientResponse
{

    /**
     * @var UserClient
     */
    public $queryClient;
}

class QueryClientParam
{

    /**
     * Required
     *
     * @var string
     */
    public $id;

    function createRequest()
    {
        return [
            "query" => self::QueryClientDocument,
            "operationName" => "queryClient",
            "variables" => $this
        ];
    }

    const QueryClientDocument = <<<EOF
query queryClient(\$id: String!) {
  queryClient(id: \$id) {
    _id
    user {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    clientType {
      _id
      name
      description
      image
      example
    }
    userPoolTypes {
      _id
      name
      description
      image
      example
    }
    usersCount
    logo
    emailVerifiedDefault
    sendWelcomeEmail
    registerDisabled
    showWXMPQRCode
    useMiniLogin
    useSelfWxapp
    allowedOrigins
    name
    secret
    token
    descriptions
    jwtExpired
    createdAt
    isDeleted
    frequentRegisterCheck {
      timeInterval
      limit
      enable
    }
    loginFailCheck {
      timeInterval
      limit
      enable
    }
    enableEmail
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
  }
}
EOF;
}


class QueryCollaborationByUserPoolIdAndUserIdResponse
{

    /**
     * @var Collaboration
     */
    public $queryCollaborationByUserPoolIdAndUserId;
}

class QueryCollaborationByUserPoolIdAndUserIdParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userId;

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    function createRequest()
    {
        return [
            "query" => self::QueryCollaborationByUserPoolIdAndUserIdDocument,
            "operationName" => "queryCollaborationByUserPoolIdAndUserId",
            "variables" => $this
        ];
    }

    const QueryCollaborationByUserPoolIdAndUserIdDocument = <<<EOF
query queryCollaborationByUserPoolIdAndUserId(\$userId: String!, \$userPoolId: String!) {
  queryCollaborationByUserPoolIdAndUserId(userId: \$userId, userPoolId: \$userPoolId) {
    _id
    createdAt
    owner {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    collaborator {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    userPool {
      _id
      usersCount
      logo
      emailVerifiedDefault
      sendWelcomeEmail
      registerDisabled
      showWXMPQRCode
      useMiniLogin
      useSelfWxapp
      allowedOrigins
      name
      secret
      token
      descriptions
      jwtExpired
      createdAt
      isDeleted
      enableEmail
    }
    permissionDescriptors {
      permissionId
      name
      operationAllow
    }
  }
}
EOF;
}


class QueryCollaborativeUserPoolByUserIdResponse
{

    /**
     * @var CollaborativeUserPoolList
     */
    public $queryCollaborativeUserPoolByUserId;
}

class QueryCollaborativeUserPoolByUserIdParam
{

    /**
     * Required
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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::QueryCollaborativeUserPoolByUserIdDocument,
            "operationName" => "queryCollaborativeUserPoolByUserId",
            "variables" => $this
        ];
    }

    const QueryCollaborativeUserPoolByUserIdDocument = <<<EOF
query queryCollaborativeUserPoolByUserId(\$userId: String!, \$page: Int, \$count: Int) {
  queryCollaborativeUserPoolByUserId(userId: \$userId, page: \$page, count: \$count) {
    list {
      _id
      createdAt
    }
    totalCount
  }
}
EOF;
}


class QueryCollaboratorPermissionsResponse
{

    /**
     * @var CollaboratorPermissions
     */
    public $queryCollaboratorPermissions;
}

class QueryCollaboratorPermissionsParam
{

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
    public $collaborationId;

    function createRequest()
    {
        return [
            "query" => self::QueryCollaboratorPermissionsDocument,
            "operationName" => "queryCollaboratorPermissions",
            "variables" => $this
        ];
    }

    const QueryCollaboratorPermissionsDocument = <<<EOF
query queryCollaboratorPermissions(\$userId: String, \$collaborationId: String) {
  queryCollaboratorPermissions(userId: \$userId, collaborationId: \$collaborationId) {
    collaborator {
      _id
      username
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      nickname
      company
      photo
      browser
      password
      registerInClient
      registerMethod
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
      country
      updatedAt
      oldPassword
      metadata
    }
    list {
      permissionId
      name
      operationAllow
    }
  }
}
EOF;
}


class QueryCollaboratorsByUserPoolIdResponse
{

    /**
     * @var Collaborators
     */
    public $queryCollaboratorsByUserPoolId;
}

class QueryCollaboratorsByUserPoolIdParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    /**
     * Optional
     *
     * @var int
     */
    public $count;

    /**
     * Optional
     *
     * @var int
     */
    public $page;

    function createRequest()
    {
        return [
            "query" => self::QueryCollaboratorsByUserPoolIdDocument,
            "operationName" => "queryCollaboratorsByUserPoolId",
            "variables" => $this
        ];
    }

    const QueryCollaboratorsByUserPoolIdDocument = <<<EOF
query queryCollaboratorsByUserPoolId(\$userPoolId: String!, \$count: Int, \$page: Int) {
  queryCollaboratorsByUserPoolId(userPoolId: \$userPoolId, count: \$count, page: \$page) {
    collaborationId
    list {
      _id
      createdAt
    }
  }
}
EOF;
}


class QueryInvitationResponse
{

    /**
     * @var Invitation[]
     */
    public $queryInvitation;
}

class QueryInvitationParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::QueryInvitationDocument,
            "operationName" => "queryInvitation",
            "variables" => $this
        ];
    }

    const QueryInvitationDocument = <<<EOF
query queryInvitation(\$client: String!) {
  queryInvitation(client: \$client) {
    client
    phone
    isDeleted
    createdAt
    updatedAt
  }
}
EOF;
}


class QueryInvitationStateResponse
{

    /**
     * @var InvitationState
     */
    public $queryInvitationState;
}

class QueryInvitationStateParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::QueryInvitationStateDocument,
            "operationName" => "queryInvitationState",
            "variables" => $this
        ];
    }

    const QueryInvitationStateDocument = <<<EOF
query queryInvitationState(\$client: String!) {
  queryInvitationState(client: \$client) {
    client
    enablePhone
    createdAt
    updatedAt
  }
}
EOF;
}


class QueryMfaResponse
{

    /**
     * @var MFA
     */
    public $queryMFA;
}

class QueryMfaParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $_id;

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

    function createRequest()
    {
        return [
            "query" => self::QueryMfaDocument,
            "operationName" => "queryMFA",
            "variables" => $this
        ];
    }

    const QueryMfaDocument = <<<EOF
query queryMFA(\$_id: String, \$userId: String, \$userPoolId: String) {
  queryMFA(_id: \$_id, userId: \$userId, userPoolId: \$userPoolId) {
    _id
    userId
    userPoolId
    enable
    shareKey
  }
}
EOF;
}


class QueryOperationLogsResponse
{

    /**
     * @var OperationLogsList
     */
    public $queryOperationLogs;
}

class QueryOperationLogsParam
{

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
    public $coll;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::QueryOperationLogsDocument,
            "operationName" => "queryOperationLogs",
            "variables" => $this
        ];
    }

    const QueryOperationLogsDocument = <<<EOF
query queryOperationLogs(\$userPoolId: String!, \$coll: String!, \$page: Int, \$count: Int) {
  queryOperationLogs(userPoolId: \$userPoolId, coll: \$coll, page: \$page, count: \$count) {
    totalCount
    list {
      operatorId
      operatorName
      operatorAvatar
      isAdmin
      isCollaborator
      isOwner
      operationType
      updatedFields
      removedFields
      operateAt
      fullDocument
      coll
    }
  }
}
EOF;
}


class QueryPasswordFaasEnabledResponse
{

    /**
     * @var PaaswordFaas
     */
    public $queryPasswordFaasEnabled;
}

class QueryPasswordFaasEnabledParam
{

    /**
     * Required
     *
     * @var string
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::QueryPasswordFaasEnabledDocument,
            "operationName" => "queryPasswordFaasEnabled",
            "variables" => $this
        ];
    }

    const QueryPasswordFaasEnabledDocument = <<<EOF
query queryPasswordFaasEnabled(\$client: String!) {
  queryPasswordFaasEnabled(client: \$client) {
    encryptUrl
    decryptUrl
    user
    client
    logs
    enable
    createdAt
    updatedAt
  }
}
EOF;
}


class QueryPasswordStrengthSettingsByUserPoolIdResponse
{

    /**
     * @var PasswordStrengthSettings
     */
    public $queryPasswordStrengthSettingsByUserPoolId;
}

class QueryPasswordStrengthSettingsByUserPoolIdParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    function createRequest()
    {
        return [
            "query" => self::QueryPasswordStrengthSettingsByUserPoolIdDocument,
            "operationName" => "queryPasswordStrengthSettingsByUserPoolId",
            "variables" => $this
        ];
    }

    const QueryPasswordStrengthSettingsByUserPoolIdDocument = <<<EOF
query queryPasswordStrengthSettingsByUserPoolId(\$userPoolId: String!) {
  queryPasswordStrengthSettingsByUserPoolId(userPoolId: \$userPoolId) {
    userPoolId
    pwdStrength
  }
}
EOF;
}


class QueryPermissionListResponse
{

    /**
     * @var PermissionList
     */
    public $queryPermissionList;
}

class QueryPermissionListParam
{


    function createRequest()
    {
        return [
            "query" => self::QueryPermissionListDocument,
            "operationName" => "queryPermissionList",
            "variables" => $this
        ];
    }

    const QueryPermissionListDocument = <<<EOF
query queryPermissionList {
  queryPermissionList {
    list {
      _id
      name
      affect
      description
    }
    totalCount
  }
}
EOF;
}


class QueryProviderInfoByAppIdResponse
{

    /**
     * @var ProviderGeneralInfo
     */
    public $queryProviderInfoByAppId;
}

class QueryProviderInfoByAppIdParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $appId;

    function createRequest()
    {
        return [
            "query" => self::QueryProviderInfoByAppIdDocument,
            "operationName" => "queryProviderInfoByAppId",
            "variables" => $this
        ];
    }

    const QueryProviderInfoByAppIdDocument = <<<EOF
query queryProviderInfoByAppId(\$appId: String) {
  queryProviderInfoByAppId(appId: \$appId) {
    _id
    type
    name
    image
    domain
    clientId
    client_id
    css
    redirect_uris
  }
}
EOF;
}


class QueryProviderInfoByDomainResponse
{

    /**
     * @var ProviderGeneralInfo
     */
    public $queryProviderInfoByDomain;
}

class QueryProviderInfoByDomainParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $domain;

    function createRequest()
    {
        return [
            "query" => self::QueryProviderInfoByDomainDocument,
            "operationName" => "queryProviderInfoByDomain",
            "variables" => $this
        ];
    }

    const QueryProviderInfoByDomainDocument = <<<EOF
query queryProviderInfoByDomain(\$domain: String) {
  queryProviderInfoByDomain(domain: \$domain) {
    _id
    type
    name
    image
    domain
    clientId
    client_id
    css
    redirect_uris
  }
}
EOF;
}


class QueryRbacGroupUserListResponse
{

    /**
     * @var RBACGroup
     */
    public $QueryRBACGroupUserList;
}

class QueryRbacGroupUserListParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::QueryRbacGroupUserListDocument,
            "operationName" => "QueryRBACGroupUserList",
            "variables" => $this
        ];
    }

    const QueryRbacGroupUserListDocument = <<<EOF
query QueryRBACGroupUserList(\$_id: String!, \$sortBy: SortByEnum = CREATEDAT_DESC, \$page: Int = 0, \$count: Int = 10) {
  rbacGroup(_id: \$_id) {
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
      list {
        _id
        unionid
        email
        emailVerified
        username
        nickname
        company
        photo
        phone
        browser
        registerInClient
        registerMethod
        oauth
        token
        tokenExpiredAt
        loginsCount
        lastLogin
        lastIP
        signedUp
        blocked
        isDeleted
        metadata
      }
    }
  }
}
EOF;
}


class QueryRoleByUserIdResponse
{

    /**
     * @var PagedUserGroup
     */
    public $queryRoleByUserId;
}

class QueryRoleByUserIdParam
{

    /**
     * Required
     *
     * @var string
     */
    public $user;

    /**
     * Required
     *
     * @var string
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::QueryRoleByUserIdDocument,
            "operationName" => "queryRoleByUserId",
            "variables" => $this
        ];
    }

    const QueryRoleByUserIdDocument = <<<EOF
query queryRoleByUserId(\$user: String!, \$client: String!) {
  queryRoleByUserId(user: \$user, client: \$client) {
    list {
      _id
      createdAt
    }
    totalCount
  }
}
EOF;
}


class QuerySmsSendCountResponse
{

    /**
     * @var SMSCountInfo
     */
    public $querySMSSendCount;
}

class QuerySmsSendCountParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    function createRequest()
    {
        return [
            "query" => self::QuerySmsSendCountDocument,
            "operationName" => "querySMSSendCount",
            "variables" => $this
        ];
    }

    const QuerySmsSendCountDocument = <<<EOF
query querySMSSendCount(\$userPoolId: String!) {
  querySMSSendCount(userPoolId: \$userPoolId) {
    count
    limitCount
  }
}
EOF;
}


class QuerySystemOAuthSettingResponse
{

    /**
     * @var OAuthList[]
     */
    public $querySystemOAuthSetting;
}

class QuerySystemOAuthSettingParam
{


    function createRequest()
    {
        return [
            "query" => self::QuerySystemOAuthSettingDocument,
            "operationName" => "querySystemOAuthSetting",
            "variables" => $this
        ];
    }

    const QuerySystemOAuthSettingDocument = <<<EOF
query querySystemOAuthSetting {
  querySystemOAuthSetting {
    _id
    name
    alias
    image
    description
    enabled
    url
    client
    user
    oAuthUrl
    wxappLogo
    fields {
      label
      type
      placeholder
      value
      checked
    }
    oauth {
      _id
      name
      alias
      image
      description
      enabled
      url
      client
      user
      oAuthUrl
      wxappLogo
    }
  }
}
EOF;
}


class QueryUserPoolCommonInfoResponse
{

    /**
     * @var UserPoolCommonInfo
     */
    public $queryUserPoolCommonInfo;
}

class QueryUserPoolCommonInfoParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    function createRequest()
    {
        return [
            "query" => self::QueryUserPoolCommonInfoDocument,
            "operationName" => "queryUserPoolCommonInfo",
            "variables" => $this
        ];
    }

    const QueryUserPoolCommonInfoDocument = <<<EOF
query queryUserPoolCommonInfo(\$userPoolId: String!) {
  queryUserPoolCommonInfo(userPoolId: \$userPoolId) {
    _id
    changePhoneStrategy {
      verifyOldPhone
    }
    changeEmailStrategy {
      verifyOldEmail
    }
  }
}
EOF;
}


class RbacGroupListResponse
{

    /**
     * @var PagedRBACGroup
     */
    public $rbacGroupList;
}

class RbacGroupListParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::RbacGroupListDocument,
            "operationName" => "rbacGroupList",
            "variables" => $this
        ];
    }

    const RbacGroupListDocument = <<<EOF
query rbacGroupList(\$userPoolId: String!, \$sortBy: SortByEnum, \$page: Int, \$count: Int) {
  rbacGroupList(userPoolId: \$userPoolId, sortBy: \$sortBy, page: \$page, count: \$count) {
    totalCount
    list {
      _id
      userPoolId
      name
      description
      createdAt
      updatedAt
    }
  }
}
EOF;
}


class RbacPermissionResponse
{

    /**
     * @var RBACPermission
     */
    public $rbacPermission;
}

class RbacPermissionParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::RbacPermissionDocument,
            "operationName" => "rbacPermission",
            "variables" => $this
        ];
    }

    const RbacPermissionDocument = <<<EOF
query rbacPermission(\$_id: String!) {
  rbacPermission(_id: \$_id) {
    _id
    name
    userPoolId
    createdAt
    updatedAt
    description
  }
}
EOF;
}


class RbacPermissionListResponse
{

    /**
     * @var PagedRBACPermission
     */
    public $rbacPermissionList;
}

class RbacPermissionListParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::RbacPermissionListDocument,
            "operationName" => "rbacPermissionList",
            "variables" => $this
        ];
    }

    const RbacPermissionListDocument = <<<EOF
query rbacPermissionList(\$userPoolId: String!, \$sortBy: SortByEnum, \$page: Int, \$count: Int) {
  rbacPermissionList(userPoolId: \$userPoolId, sortBy: \$sortBy, page: \$page, count: \$count) {
    totalCount
    list {
      _id
      name
      userPoolId
      createdAt
      updatedAt
      description
    }
  }
}
EOF;
}


class RbacRoleResponse
{

    /**
     * @var RBACRole
     */
    public $rbacRole;
}

class RbacRoleParam
{

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::RbacRoleDocument,
            "operationName" => "rbacRole",
            "variables" => $this
        ];
    }

    const RbacRoleDocument = <<<EOF
query rbacRole(\$sortBy: SortByEnum, \$page: Int, \$count: Int, \$_id: String!) {
  rbacRole(_id: \$_id) {
    _id
    userPoolId
    name
    description
    createdAt
    updatedAt
    permissions {
      totalCount
    }
    users(sortBy: \$sortBy, page: \$page, count: \$count) {
      totalCount
    }
  }
}
EOF;
}


class RbacRoleListResponse
{

    /**
     * @var PagedRBACRole
     */
    public $rbacRoleList;
}

class RbacRoleListParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    /**
     * Optional
     *
     * @var SortByEnum
     */
    public $sortBy;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::RbacRoleListDocument,
            "operationName" => "rbacRoleList",
            "variables" => $this
        ];
    }

    const RbacRoleListDocument = <<<EOF
query rbacRoleList(\$userPoolId: String!, \$sortBy: SortByEnum, \$page: Int, \$count: Int) {
  rbacRoleList(userPoolId: \$userPoolId, sortBy: \$sortBy, page: \$page, count: \$count) {
    totalCount
    list {
      _id
      userPoolId
      name
      description
      createdAt
      updatedAt
    }
  }
}
EOF;
}


class RecentServiceCallResponse
{

    /**
     * @var DayServiceCallListOfAllServices
     */
    public $recentServiceCall;
}

class RecentServiceCallParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $today;

    function createRequest()
    {
        return [
            "query" => self::RecentServiceCallDocument,
            "operationName" => "recentServiceCall",
            "variables" => $this
        ];
    }

    const RecentServiceCallDocument = <<<EOF
query recentServiceCall(\$today: String) {
  recentServiceCall(today: \$today) {
    userService {
      day
      count
    }
    emailService {
      day
      count
    }
    oAuthService {
      day
      count
    }
    payService {
      day
      count
    }
  }
}
EOF;
}


class RegisterEveryDayCountResponse
{

    /**
     * @var RegisterEveryDayCount
     */
    public $registerEveryDayCount;
}

class RegisterEveryDayCountParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $client;

    function createRequest()
    {
        return [
            "query" => self::RegisterEveryDayCountDocument,
            "operationName" => "registerEveryDayCount",
            "variables" => $this
        ];
    }

    const RegisterEveryDayCountDocument = <<<EOF
query registerEveryDayCount(\$client: String) {
  registerEveryDayCount(client: \$client) {
    list
  }
}
EOF;
}


class RegisterMethodTopListResponse
{

    /**
     * @var RegisterMethodList[]
     */
    public $registerMethodTopList;
}

class RegisterMethodTopListParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    function createRequest()
    {
        return [
            "query" => self::RegisterMethodTopListDocument,
            "operationName" => "registerMethodTopList",
            "variables" => $this
        ];
    }

    const RegisterMethodTopListDocument = <<<EOF
query registerMethodTopList(\$userPoolId: String!) {
  registerMethodTopList(userPoolId: \$userPoolId) {
    method
    count
  }
}
EOF;
}


class RequestListResponse
{

    /**
     * @var PagedRequestList
     */
    public $requestList;
}

class RequestListParam
{

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::RequestListDocument,
            "operationName" => "requestList",
            "variables" => $this
        ];
    }

    const RequestListDocument = <<<EOF
query requestList(\$page: Int, \$count: Int) {
  requestList(page: \$page, count: \$count) {
    totalCount
    list {
      _id
      when
      where
      ip
      size
      responseTime
      service
    }
  }
}
EOF;
}


class RuleByIdResponse
{

    /**
     * @var Rule
     */
    public $ruleById;
}

class RuleByIdParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::RuleByIdDocument,
            "operationName" => "ruleById",
            "variables" => $this
        ];
    }

    const RuleByIdDocument = <<<EOF
query ruleById(\$_id: String!) {
  ruleById(_id: \$_id) {
    _id
    userPoolId
    name
    description
    type
    enabled
    faasUrl
    code
    order
    async
    createdAt
    updatedAt
  }
}
EOF;
}


class RuleEnvResponse
{

    /**
     * @var PagedRuleEnvVariable
     */
    public $ruleEnv;
}

class RuleEnvParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    function createRequest()
    {
        return [
            "query" => self::RuleEnvDocument,
            "operationName" => "ruleEnv",
            "variables" => $this
        ];
    }

    const RuleEnvDocument = <<<EOF
query ruleEnv(\$userPoolId: String!) {
  ruleEnv(userPoolId: \$userPoolId) {
    totalCount
    list {
      key
      value
    }
  }
}
EOF;
}


class RulesResponse
{

    /**
     * @var PagedRules
     */
    public $rules;
}

class RulesParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

    function createRequest()
    {
        return [
            "query" => self::RulesDocument,
            "operationName" => "rules",
            "variables" => $this
        ];
    }

    const RulesDocument = <<<EOF
query rules(\$userPoolId: String!) {
  rules(userPoolId: \$userPoolId) {
    totalCount
    list {
      _id
      userPoolId
      name
      description
      type
      enabled
      faasUrl
      code
      order
      async
      createdAt
      updatedAt
    }
  }
}
EOF;
}


class SearchOrgNodesResponse
{

    /**
     * @var RBACGroup[]
     */
    public $searchOrgNodes;
}

class SearchOrgNodesParam
{

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
    public $name;

    /**
     * Optional
     *
     * @var KeyValuePair
     */
    public $metadata;

    function createRequest()
    {
        return [
            "query" => self::SearchOrgNodesDocument,
            "operationName" => "searchOrgNodes",
            "variables" => $this
        ];
    }

    const SearchOrgNodesDocument = <<<EOF
query searchOrgNodes(\$orgId: String!, \$name: String, \$metadata: [KeyValuePair!]) {
  searchOrgNodes(orgId: \$orgId, name: \$name, metadata: \$metadata) {
    _id
    name
    description
    createdAt
    updatedAt
  }
}
EOF;
}


class SearchUserResponse
{

    /**
     * @var PagedUsers
     */
    public $searchUser;
}

class SearchUserParam
{

    /**
     * Required
     *
     * @var string
     */
    public $type;

    /**
     * Required
     *
     * @var string
     */
    public $value;

    /**
     * Required
     *
     * @var string
     */
    public $registerInClient;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::SearchUserDocument,
            "operationName" => "searchUser",
            "variables" => $this
        ];
    }

    const SearchUserDocument = <<<EOF
query searchUser(\$type: String!, \$value: String!, \$registerInClient: String!, \$page: Int, \$count: Int) {
  searchUser(type: \$type, value: \$value, registerInClient: \$registerInClient, page: \$page, count: \$count) {
    list {
      _id
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      username
      nickname
      company
      photo
      browser
      device
      password
      registerInClient
      registerMethod
      oauth
      token
      tokenExpiredAt
      loginsCount
      lastLogin
      lastIP
      signedUp
      blocked
      isDeleted
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
      country
      updatedAt
      customData
      metadata
    }
    totalCount
  }
}
EOF;
}


class SearchUserBasicInfoByIdResponse
{

    /**
     * @var BasicUserInfo
     */
    public $searchUserBasicInfoById;
}

class SearchUserBasicInfoByIdParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $userId;

    function createRequest()
    {
        return [
            "query" => self::SearchUserBasicInfoByIdDocument,
            "operationName" => "searchUserBasicInfoById",
            "variables" => $this
        ];
    }

    const SearchUserBasicInfoByIdDocument = <<<EOF
query searchUserBasicInfoById(\$userId: String) {
  searchUserBasicInfoById(userId: \$userId) {
    _id
    username
    photo
    email
  }
}
EOF;
}


class StatisticResponse
{

    /**
     * @var Statistic
     */
    public $statistic;
}

class StatisticParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $sortBy;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::StatisticDocument,
            "operationName" => "statistic",
            "variables" => $this
        ];
    }

    const StatisticDocument = <<<EOF
query statistic(\$sortBy: String, \$page: Int, \$count: Int) {
  statistic(sortBy: \$sortBy, page: \$page, count: \$count) {
    list {
      _id
      username
      email
      loginsCount
      appsCount
      OAuthCount
    }
    totalCount
  }
}
EOF;
}


class TodayGeoDistributionResponse
{

    /**
     * @var GeographicalDistributionList[]
     */
    public $todayGeoDistribution;
}

class TodayGeoDistributionParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $today;

    function createRequest()
    {
        return [
            "query" => self::TodayGeoDistributionDocument,
            "operationName" => "todayGeoDistribution",
            "variables" => $this
        ];
    }

    const TodayGeoDistributionDocument = <<<EOF
query todayGeoDistribution(\$today: String) {
  todayGeoDistribution(today: \$today) {
    city
    size
    point
  }
}
EOF;
}


class UserResponse
{

    /**
     * @var ExtendUser
     */
    public $user;
}

class UserParam
{

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
    public $registerInClient;

    /**
     * Optional
     *
     * @var string
     */
    public $token;

    /**
     * Optional
     *
     * @var bool
     */
    public $auth;

    /**
     * Optional
     *
     * @var int
     */
    public $userLoginHistoryPage;

    /**
     * Optional
     *
     * @var int
     */
    public $userLoginHistoryCount;

    function createRequest()
    {
        return [
            "query" => self::UserDocument,
            "operationName" => "user",
            "variables" => $this
        ];
    }

    const UserDocument = <<<EOF
query user(\$id: String, \$registerInClient: String, \$token: String, \$auth: Boolean, \$userLoginHistoryPage: Int, \$userLoginHistoryCount: Int) {
  user(id: \$id, registerInClient: \$registerInClient, token: \$token, auth: \$auth, userLoginHistoryPage: \$userLoginHistoryPage, userLoginHistoryCount: \$userLoginHistoryCount) {
    _id
    email
    unionid
    openid
    emailVerified
    phone
    phoneVerified
    username
    nickname
    company
    photo
    browser
    device
    password
    registerInClient
    registerMethod
    oauth
    token
    tokenExpiredAt
    loginsCount
    lastLogin
    lastIP
    signedUp
    blocked
    isDeleted
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
    country
    updatedAt
    metadata
  }
}
EOF;
}


class UserAnalyticsResponse
{

    /**
     * @var UserAnalytics
     */
    public $userAnalytics;
}

class UserAnalyticsParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

    function createRequest()
    {
        return [
            "query" => self::UserAnalyticsDocument,
            "operationName" => "userAnalytics",
            "variables" => $this
        ];
    }

    const UserAnalyticsDocument = <<<EOF
query userAnalytics(\$clientId: String) {
  userAnalytics(clientId: \$clientId) {
    usersAddedToday {
      length
    }
    usersAddedLastWeek {
      length
    }
    usersLoginLastWeek {
      length
    }
    totalUsers {
      length
    }
    allUsers
    totalApps
  }
}
EOF;
}


class UserClientListResponse
{

    /**
     * @var PagedUserClientList
     */
    public $userClientList;
}

class UserClientListParam
{

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
    public $count;

    /**
     * Optional
     *
     * @var string
     */
    public $sortBy;

    function createRequest()
    {
        return [
            "query" => self::UserClientListDocument,
            "operationName" => "userClientList",
            "variables" => $this
        ];
    }

    const UserClientListDocument = <<<EOF
query userClientList(\$page: Int, \$count: Int, \$sortBy: String) {
  userClientList(page: \$page, count: \$count, sortBy: \$sortBy) {
    list {
      _id
      name
      createdAt
      usersCount
    }
    totalCount
  }
}
EOF;
}


class UserClientTypesResponse
{

    /**
     * @var UserClientType[]
     */
    public $userClientTypes;
}

class UserClientTypesParam
{


    function createRequest()
    {
        return [
            "query" => self::UserClientTypesDocument,
            "operationName" => "userClientTypes",
            "variables" => $this
        ];
    }

    const UserClientTypesDocument = <<<EOF
query userClientTypes {
  userClientTypes {
    _id
    name
    description
    image
    example
  }
}
EOF;
}


class UserClientsResponse
{

    /**
     * @var PagedUserClients
     */
    public $userClients;
}

class UserClientsParam
{

    /**
     * Required
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
    public $count;

    /**
     * Optional
     *
     * @var bool
     */
    public $computeUsersCount;

    function createRequest()
    {
        return [
            "query" => self::UserClientsDocument,
            "operationName" => "userClients",
            "variables" => $this
        ];
    }

    const UserClientsDocument = <<<EOF
query userClients(\$userId: String!, \$page: Int, \$count: Int, \$computeUsersCount: Boolean) {
  userClients(userId: \$userId, page: \$page, count: \$count, computeUsersCount: \$computeUsersCount) {
    list {
      _id
      usersCount
      logo
      emailVerifiedDefault
      sendWelcomeEmail
      registerDisabled
      showWXMPQRCode
      useMiniLogin
      useSelfWxapp
      allowedOrigins
      name
      secret
      token
      descriptions
      jwtExpired
      createdAt
      isDeleted
      enableEmail
    }
    totalCount
  }
}
EOF;
}


class UserExistResponse
{

    /**
     * @var bool
     */
    public $userExist;
}

class UserExistParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPoolId;

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

    function createRequest()
    {
        return [
            "query" => self::UserExistDocument,
            "operationName" => "userExist",
            "variables" => $this
        ];
    }

    const UserExistDocument = <<<EOF
query userExist(\$userPoolId: String!, \$email: String, \$phone: String, \$username: String) {
  userExist(userPoolId: \$userPoolId, email: \$email, phone: \$phone, username: \$username)
}
EOF;
}


class UserGroupResponse
{

    /**
     * @var PagedUserGroup
     */
    public $userGroup;
}

class UserGroupParam
{

    /**
     * Required
     *
     * @var string
     */
    public $group;

    /**
     * Required
     *
     * @var string
     */
    public $client;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::UserGroupDocument,
            "operationName" => "userGroup",
            "variables" => $this
        ];
    }

    const UserGroupDocument = <<<EOF
query userGroup(\$group: String!, \$client: String!, \$page: Int, \$count: Int) {
  userGroup(group: \$group, client: \$client, page: \$page, count: \$count) {
    list {
      _id
      createdAt
    }
    totalCount
  }
}
EOF;
}


class UserGroupListResponse
{

    /**
     * @var UserGroupList
     */
    public $userGroupList;
}

class UserGroupListParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::UserGroupListDocument,
            "operationName" => "userGroupList",
            "variables" => $this
        ];
    }

    const UserGroupListDocument = <<<EOF
query userGroupList(\$_id: String!) {
  userGroupList(_id: \$_id) {
    totalCount
    list {
      _id
      userPoolId
      name
      description
      createdAt
      updatedAt
    }
    rawList
  }
}
EOF;
}


class UserMetadataResponse
{

    /**
     * @var UserMetaDataList
     */
    public $userMetadata;
}

class UserMetadataParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::UserMetadataDocument,
            "operationName" => "userMetadata",
            "variables" => $this
        ];
    }

    const UserMetadataDocument = <<<EOF
query userMetadata(\$_id: String!) {
  userMetadata(_id: \$_id) {
    totalCount
    list {
      key
      value
    }
  }
}
EOF;
}


class UserOAuthCountResponse
{

    /**
     * @var int[]
     */
    public $userOAuthCount;
}

class UserOAuthCountParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $userIds;

    function createRequest()
    {
        return [
            "query" => self::UserOAuthCountDocument,
            "operationName" => "userOAuthCount",
            "variables" => $this
        ];
    }

    const UserOAuthCountDocument = <<<EOF
query userOAuthCount(\$userIds: [String]) {
  userOAuthCount(userIds: \$userIds)
}
EOF;
}


class UserPatchResponse
{

    /**
     * @var PatchExtendUser
     */
    public $userPatch;
}

class UserPatchParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $ids;

    function createRequest()
    {
        return [
            "query" => self::UserPatchDocument,
            "operationName" => "userPatch",
            "variables" => $this
        ];
    }

    const UserPatchDocument = <<<EOF
query userPatch(\$ids: String) {
  userPatch(ids: \$ids) {
    list {
      _id
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      username
      nickname
      company
      photo
      browser
      device
      password
      registerInClient
      registerMethod
      oauth
      token
      tokenExpiredAt
      loginsCount
      lastLogin
      lastIP
      signedUp
      blocked
      isDeleted
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
      country
      updatedAt
      customData
      metadata
    }
    totalCount
  }
}
EOF;
}


class UserPermissionListResponse
{

    /**
     * @var UserPermissionList
     */
    public $userPermissionList;
}

class UserPermissionListParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::UserPermissionListDocument,
            "operationName" => "userPermissionList",
            "variables" => $this
        ];
    }

    const UserPermissionListDocument = <<<EOF
query userPermissionList(\$_id: String!) {
  userPermissionList(_id: \$_id) {
    totalCount
    list {
      _id
      name
      userPoolId
      createdAt
      updatedAt
      description
    }
    rawList
  }
}
EOF;
}


class UserRoleListResponse
{

    /**
     * @var UserRoleList
     */
    public $userRoleList;
}

class UserRoleListParam
{

    /**
     * Required
     *
     * @var string
     */
    public $_id;

    function createRequest()
    {
        return [
            "query" => self::UserRoleListDocument,
            "operationName" => "userRoleList",
            "variables" => $this
        ];
    }

    const UserRoleListDocument = <<<EOF
query userRoleList(\$_id: String!) {
  userRoleList(_id: \$_id) {
    totalCount
    list {
      _id
      userPoolId
      name
      description
      createdAt
      updatedAt
    }
    rawList
  }
}
EOF;
}


class UsersResponse
{

    /**
     * @var PagedUsers
     */
    public $users;
}

class UsersParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $registerInClient;

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
    public $count;

    /**
     * Optional
     *
     * @var bool
     */
    public $populate;

    function createRequest()
    {
        return [
            "query" => self::UsersDocument,
            "operationName" => "users",
            "variables" => $this
        ];
    }

    const UsersDocument = <<<EOF
query users(\$registerInClient: String, \$page: Int, \$count: Int, \$populate: Boolean) {
  users(registerInClient: \$registerInClient, page: \$page, count: \$count, populate: \$populate) {
    list {
      _id
      email
      unionid
      openid
      emailVerified
      phone
      phoneVerified
      username
      nickname
      company
      photo
      browser
      device
      password
      registerInClient
      registerMethod
      oauth
      token
      tokenExpiredAt
      loginsCount
      lastLogin
      lastIP
      signedUp
      blocked
      isDeleted
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
      country
      updatedAt
      customData
      metadata
    }
    totalCount
  }
}
EOF;
}


class UsersByOidcAppResponse
{

    /**
     * @var UserIds
     */
    public $usersByOidcApp;
}

class UsersByOidcAppParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $userPoolId;

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
    public $count;

    /**
     * Optional
     *
     * @var string
     */
    public $appId;

    function createRequest()
    {
        return [
            "query" => self::UsersByOidcAppDocument,
            "operationName" => "usersByOidcApp",
            "variables" => $this
        ];
    }

    const UsersByOidcAppDocument = <<<EOF
query usersByOidcApp(\$userPoolId: String, \$page: Int, \$count: Int, \$appId: String) {
  usersByOidcApp(userPoolId: \$userPoolId, page: \$page, count: \$count, appId: \$appId) {
    list
    totalCount
  }
}
EOF;
}


class UsersInGroupResponse
{

    /**
     * @var UsersInGroup
     */
    public $usersInGroup;
}

class UsersInGroupParam
{

    /**
     * Optional
     *
     * @var string
     */
    public $group;

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
    public $count;

    function createRequest()
    {
        return [
            "query" => self::UsersInGroupDocument,
            "operationName" => "usersInGroup",
            "variables" => $this
        ];
    }

    const UsersInGroupDocument = <<<EOF
query usersInGroup(\$group: String, \$page: Int, \$count: Int) {
  usersInGroup(group: \$group, page: \$page, count: \$count) {
    list {
      email
      username
      _id
      upgrade
    }
    totalCount
  }
}
EOF;
}


class ValidatePasswordResponse
{

    /**
     * @var ValidateResult
     */
    public $validatePassword;
}

class ValidatePasswordParam
{

    /**
     * Required
     *
     * @var string
     */
    public $userPool;

    /**
     * Required
     *
     * @var string
     */
    public $password;

    /**
     * Required
     *
     * @var string
     */
    public $encryptedPassword;

    function createRequest()
    {
        return [
            "query" => self::ValidatePasswordDocument,
            "operationName" => "validatePassword",
            "variables" => $this
        ];
    }

    const ValidatePasswordDocument = <<<EOF
query validatePassword(\$userPool: String!, \$password: String!, \$encryptedPassword: String!) {
  validatePassword(userPool: \$userPool, password: \$password, encryptedPassword: \$encryptedPassword) {
    isValid
  }
}
EOF;
}


class WxQrCodeLogResponse
{

    /**
     * @var WxQRCodeLog
     */
    public $wxQRCodeLog;
}

class WxQrCodeLogParam
{

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
    public $count;

    /**
     * Optional
     *
     * @var string
     */
    public $clientId;

    /**
     * Optional
     *
     * @var string
     */
    public $sortBy;

    function createRequest()
    {
        return [
            "query" => self::WxQrCodeLogDocument,
            "operationName" => "wxQRCodeLog",
            "variables" => $this
        ];
    }

    const WxQrCodeLogDocument = <<<EOF
query wxQRCodeLog(\$page: Int, \$count: Int, \$clientId: String, \$sortBy: String) {
  wxQRCodeLog(page: \$page, count: \$count, clientId: \$clientId, sortBy: \$sortBy) {
    list {
      random
      expiredAt
      createdAt
      success
      qrcode
      used
      accessToken
      openid
      userInfo
      redirect
    }
    totalCount
  }
}
EOF;
}
