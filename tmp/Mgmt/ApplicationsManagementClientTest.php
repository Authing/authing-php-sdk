<?php
require_once __DIR__ . '../../../vendor/autoload.php';

use Authing\Mgmt\ManagementClient;


$client = new ManagementClient('5f88506c81cd279930195660', 'f6bbab3309f021639c6b04d6e54133cd');

$client->requestToken();
$appManageClient = $client->applications();

// 创建应用
// $res = $appManageClient->create([
//     'name' => 'testname',
//     'identifier' =>  ' only one ',
//     'redirectUris' => 'http://authing.cn',
//     'logo' => 'https: //files.authing.co/authing-console/authing-logo-new.svg'
// ]);

// {
//     "code": 200,
//     "message": "\u521b\u5efa\u5e94\u7528\u6210\u529f\uff01",
//     "data": {
//         "qrcodeScanning": {
//             "redirect": false,
//             "interval": 1500
//         },
//         "id": "6073e90329bca4db6b9bfb44",
//         "userPoolId": "5f88506c81cd279930195660",
//         "protocol": "oidc",
//         "name": "testname",
//         "secret": "6768151669a410de1e16823f46d9039d",
//         "identifier": "only one ",
//         "jwks": {
//             // ----
//         }
//     }
// }

// 查看应用下已登录用户
// $res = $appManageClient->activeUsers('606dd67c164539e1c90f4d83');

// {
//     "code": 200,
//     "message": "获取应用登录态用户列表成功",
//     "data": {
//         "list": {},
//         "totalCount": 0
//     }
// }

// 刷新应用密钥
// 36235e0666684f9a7223a4b90c28cb4d
// $res = $appManageClient->refreshApplicationSecret('606dd67c164539e1c90f4d83');

// {
//     "code": 200,
//     "message": "刷新应用 secret 成功！",
//     "data": {
//         "qrcodeScanning": {
//             "redirect": false,
//             "interval": 1500
//         },
//         "id": "606dd67c164539e1c90f4d83",
//         "createdAt": "2021-04-07T15:57:49.287Z",
//         "updatedAt": "2021-04-12T06:52:06.615Z",
//         "userPoolId": "606dd6793b386173669c3ccd",
//         "protocol": "oidc",
//         "isOfficial": false,
//         "isDeleted": false,
//         "isDefault": false,
//         "name": "\u793a\u4f8b\u5e94\u7528",
//         "description": null,
//         "identifier": "cdalclpikofg-demo",
//         "jwks": {
//             "keys": {
//                 "0": {
//                     // -----
//                 }
//             }
//         },
//         "ssoPageCustomizationSettings": null,
//         "logo": "https:\/\/files.authing.co\/authing-console\/default-app-logo.png",
//         "redirectUris": {
//             "0": "https:\/\/console.authing.cn\/console\/get-started\/?app_id=606dd67c164539e1c90f4d83"
//         },
//         "logoutRedirectUris": {},
//         "oidcProviderEnabled": true,
//         "oauthProviderEnabled": false,
//         "samlProviderEnabled": false,
//         "casProviderEnabled": false,
//         "registerDisabled": false,
//         "loginTabs": {
//             "0": "phone-code",
//             "1": "password",
//             "2": "ad"
//         },
//         "defaultLoginTab": "password",
//         "registerTabs": {
//             "0": "email",
//             "1": "phone"
//         },
//         "defaultRegisterTab": "email",
//         "ldapConnections": null,
//         "adConnections": {
//             "0": "606dd691755cc6f6daf34982"
//         },
//         "disabledSocialConnections": null,
//         "disabledOidcConnections": {},
//         "disabledSamlConnections": {},
//         "disabledOauth2Connections": {},
//         "disabledCasConnections": {},
//         "disabledAzureAdConnections": {},
//         "extendsFieldsEnabled": false,
//         "extendsFields": {},
//         "ext": null,
//         "css": null,
//         "oidcConfig": {
//             // ----
//         },
//         "samlConfig": null,
//         "oauthConfig": {
//             // ---
//         },
//         "casConfig": null,
//         "showAuthorizationPage": false,
//         "enableSubAccount": false,
//         "loginRequireEmailVerified": false,
//         "agreementEnabled": false,
//         "skipMfa": false,
//         "permissionStrategy": {
//             "enabled": false,
//             "defaultStrategy": "ALLOW_ALL",
//             "allowPolicyId": null,
//             "denyPolicyId": null
//         }
//     }
// }

// 删除应用
// $res = $appManageClient->delete('606dd67c164539e1c90f4d83');
// true

$resJson = json_encode($res);

echo $resJson;
echo 'ok';