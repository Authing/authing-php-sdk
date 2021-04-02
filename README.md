# Authing - PHP

Authing PHP SDK 由两部分组成：`ManagementClient` 和 `AuthenticationClient`。`ManagementClient` 中进行的所有操作均以管理员的身份进行，包含管理用户、管理角色、管理权限策略、管理用户池配置等模块。`AuthenticationClient` 中的所有操作以当前终端用户的身份进行，包含登录、注册、修改用户资料、退出登录等方法。

你应该将初始化过后的 `ManagementClient` 实例设置为一个全局变量（只初始化一次），而 `AuthenticationClient` 应该每次请求初始化一个。

## 安装

我们推荐使用 `composer` 进行安装， 它可以与一些模块打包工具很好地配合使用。

```shell
# latest stable
$ composer require authing-sdk/php
```

## 使用管理模块

初始化 `ManagementClient` 需要 `userPoolId`（用户池 ID） 和 `secret`（用户池密钥）:

> 你可以在此[了解如何获取 UserPoolId 和 Secret](https://docs.authing.cn/v2/guides/faqs/get-userpool-id-and-secret.html) .

```php
use Authing\Mgmt\ManagementClient;

$management = new ManagementClient("AUTHING_USERPOOL_ID", "AUTHING_USERPOOL_SECRET");
// 获取管理员权限
$management->requestToken();
```

现在 `managementClient` 实例就可以使用了。例如可以获取用户池中的用户列表：

```php
use Authing\Mgmt\ManagementClient;

$management = new ManagementClient("AUTHING_USERPOOL_ID", "AUTHING_USERPOOL_SECRET");
// 获取管理员权限
$management->requestToken();
$users = $management->users()->paginate();
```

## 使用认证模块

初始化 `AuthenticationClient` 需要 `appId`（应用 ID）：

> 你可以在此[了解如何获取 AppId](/guides/faqs/get-app-id-and-secret.md) .

```php
use Authing\Auth\AuthenticationClient;

$authentication = new AuthenticationClient(function ($ops) {
    $ops->appId = "---";
});
```

接下来可以进行注册登录等操作：

```php
use Authing\Auth\AuthenticationClient;
use Authing\Types\LoginByEmailInput;

$authentication = new AuthenticationClient(function ($ops) {
    $ops->appId = "---";
});
$user = $authentication->loginByEmail(new LoginByEmailInput("test@example.com", "123456"));
```

完成登录之后，`update_profile` 等要求用户登录的方法就可用了：

```php
use Authing\Auth\AuthenticationClient;
use Authing\Types\LoginByEmailInput;
use Authing\Types\UpdateUserInput;

$authentication = new AuthenticationClient(function ($ops) {
    $ops->appId = "---";
});
$authentication->loginByEmail(new LoginByEmailInput("test@example.com", "123456"));

$user = $authentication->updateProfile((new UpdateUserInput())->withNickname("nickname"));
```

你也可以在初始化后设置 `AccessToken` 参数, 不需要每次都调用 `LoginByXXX` 方法:

```php
use Authing\Auth\AuthenticationClient;

$authentication = new AuthenticationClient(function ($ops) {
    $ops->appId = "---";
});
$authentication->setAccessToken("ACCESS_TOKEN");
```

再次执行 `UpdateProfile` 方法，发现也成功了:

```php
use Authing\Auth\AuthenticationClient;
use Authing\Types\UpdateUserInput;

$authentication = new AuthenticationClient(function ($ops) {
    $ops->appId = "---";
});
$authentication->setAccessToken("ACCESS_TOKEN");

$user = $authentication->updateProfile((new UpdateUserInput())->withNickname("nickname"));
```

## 错误处理

统一使用 try catch 处理：

```php
use Authing\Auth\AuthenticationClient;
use Authing\Types\UpdateUserInput;

$authentication = new AuthenticationClient("AUTHING_USERPOOL_ID");
$authentication->setAccessToken("ACCESS_TOKEN");

try {
    $user = $authentication->updateProfile((new UpdateUserInput())->withNickname("nickname"));
} catch (Exception $e) {
    print_r($e);
}
```

## 私有化部署

**私有化部署**场景需要指定你私有化的 Authing 服务的 GraphQL 端点（**不带协议头和 Path**），如果你不清楚可以联系 Authing IDaaS 服务管理员。

## 接口索引

可用的 Authentication 方法

- 获取当前用户的用户资料: `getCurrentUser`
- 使用邮箱注册: `registerByEmail`
- 使用用户名注册: `registerByUsername`
- 使用手机号验证码注册: `registerByPhoneCode`
- 使用邮箱登录: `loginByEmail`
- 使用用户名登录: `loginByUsername`
- 使用手机号验证码登录 `loginByPhoneCode`
- 使用手机号密码登录: `loginByPhonePassword`
- 发送邮件: `sendEmail`
- 发送短信验证码: `sendSmsCode`
- 检查 token 的有效状态: `checkLoginStatus`
- 使用手机号验证码重置密码: `resetPasswordByPhoneCode`
- 使用邮件验证码重置密码: `resetPasswordByEmailCode`
- 更新用户资料: `updateProfile`
- 更新密码: `updatePassword`
- 更新手机号: `updatePhone`
- 更新邮箱: `updateEmail`
- 刷新 token: `refreshToken`
- 绑定手机号: `bindPhone`
- 解绑手机号: `unbindPhone`

详情请见：
[用户认证模块](https://docs.authing.cn/v2/reference/sdk-for-php/authentication/)

管理模块包含以下子模块：
[管理用户](https://docs.authing.cn/v2/reference/sdk-for-php/management/UsersManagementClient.html)

[管理角色](https://docs.authing.cn/v2/reference/sdk-for-php/management/RolesManagementClient.html)

[管理策略](https://docs.authing.cn/v2/reference/sdk-for-php/management/PoliciesManagementClient.html)

[管理权限、访问控制](https://docs.authing.cn/v2/reference/sdk-for-php/management/AclManagementClient.html)

[管理用户自定义字段](https://docs.authing.cn/v2/reference/sdk-for-php/management/UdfManagementClient.html)

## 获取帮助

Join us on Gitter: [#authing-chat](https://gitter.im/authing-chat/community)

```json
{
  "code": 200,
  "message": "\u83b7\u53d6\u5e94\u7528\u914d\u7f6e\u6210\u529f",
  "data": {
    "qrcodeScanning": { "redirect": false, "interval": 1500 },
    "id": "5f97fb40d352ecf69ffe6d98",
    "createdAt": "2020-10-27T10:49:36.817Z",
    "updatedAt": "2021-03-17T10:39:53.650Z",
    "userPoolId": "5f88506c81cd279930195660",
    "protocol": "oidc",
    "isOfficial": false,
    "isDeleted": false,
    "isDefault": false,
    "name": "oo",
    "description": null,
    "secret": "19938f6ef3c84360a9c0ab73c2cc88d7",
    "identifier": "okokiohutuyfrtd",
    "jwks": {
      "keys": {
        "0": {
          "e": "AQAB",
          "n": "vA48Z86xgBOdui9HV27LaXE4IuvyedXCcQBxo5SYUHYp2w43QmRVMPLYSHkMCBpHiKiB1ptyvJDL86am23hAc2MlsUcVC3QcOrSjsecWX14YkXShuHPW6A6d8zMCE2PjXD1eHBgxhiIxd5X-a5q849hlGUz2gLwB17GIrrJrGLmvJwZ1BJNvmeJ5S631L_2Qpmkj7fPDYUdwZfDgfF0HLKXOLyUFcpJyoMQWLONLH31iLJV6eahktoxfOJJ_lUHaHgcdyOqOZ1LNCaDg33xUFtNhJG3mU1LkX9Kv6gCKJKk5t0ynv6xhbEw3iFpft1S-a_qmu9qyh52P5aEB-vw_8w",
          "d": "iF-ygn0rz3tqOGiszcT1EiQe14RPtPbFKPlvb3cE9eSa-dZXUHg-J18UZYoSpZWZJos8jQrxq7k9jhXeju2nn4XZAbRQmJu9FP2GcC7q1IICQwlXddHbmTFwbbsh2Dnp2SxPoQQSdfk58kT92b6_GGQG_NAJOtYcZ_TA8B9G9wgAiqv97RnEBHn0a6ypeYh6_z7YMPCM3H9Bj5ZHLhn2gimsdz82Nlmp5nKUEOU1i645PibCESG-DLb5yRz7T1XDgEBhHbgpXs7quwe3LhwcFivY4lZlaZ2WFSBq2EyEBQ7ycshvwPGwMNBpb9EnTee4-J2d3B2fCAlvimQPVV0o8Q",
          "p": "9pq5Zb0pIxtCjNyl6LyzRr848wHe6h_uQk-OMJsD08KeLPHj1X8HeBHyPrzfQGgDNCtn_lBSBJ6QeIPXqZeCZwB9osuEAR8MZ7MoRgQ89ijwdbNLysO4mGG4jIwtzZ55Q1nOJLnbGlafo9h4TSsjGFIjlVnpwvuB8aaYAys9hF8",
          "q": "wzhzlLVFCiGfAMZ1rgYE9hRWxb4FzL37LJBb3RI4OKNwO5cwlsWNq7AS0mNJM9Uog9edgIOuZUXnaz8P-9tVO9E16tMIuThqXprbJRYdhFVqcGFgSoKE0-mOIbmicyw6KAUIKr2sYneQyrbs7Pcs8nKeHnZm570Z6FKZ5PWTzO0",
          "dp": "eP9Z0E2MDammca8hyJwt6pyQuMtGMOIR6X9XaQnmStTG_46AF5UIeSV1EsthTxy51bMmh2WpmJKkmD04aAHq_dcDzgjFcDdnwsnpDNGvh6h2s4mRup9lx37LKkrtfmIvZZh-yQ5YLwgptB7WiCaORbSnuPQw-nalP4haNdPVj0k",
          "dq": "JLm0_K_RSiOjDvlG4DMfsc-Ht3GVE7xVyT9rGL65tuYAUiWSLXsCuN7J26xz8_1QvuTMK4YaQ9EPxRw6_I15jmRAOWn0BSw4zo1hVqu_Z8rN2FBpVfsR0-_nHi8XAYW7dxXjQG8oQ-nsYkZhcf7aBM5NMrvhhg0MF6maa_lLEc0",
          "qi": "U2WV73rClKbKPuYwFYtnQ7M4ZnfoDqfxSLUPmkqMsnFOVJ-X0KsvMsxuKRJFz3aqVphWtSQhkIMgsmr7aLoOAh3IjMlKZtWGVDjfmlTHyh5_6TroTds4IkKgG90VVjswJsKF0tkODTZo5eK9imz7BzK9zTxTCciE_m0-VZIYTTE",
          "kty": "RSA",
          "kid": "eJMPflO934tiEnsNFexQt3S5lLfZGINylTf1bqEBviE",
          "alg": "RS256",
          "use": "sig"
        }
      }
    },
    "ssoPageCustomizationSettings": null,
    "logo": "https://files.authing.co/authing-console/default-app-logo.png",
    "redirectUris": { "0": "http://localhost:8000/auth/callback" },
    "logoutRedirectUris": {},
    "oidcProviderEnabled": true,
    "oauthProviderEnabled": false,
    "samlProviderEnabled": false,
    "casProviderEnabled": false,
    "registerDisabled": false,
    "loginTabs": { "0": "phone-code", "1": "password" },
    "defaultLoginTab": "password",
    "registerTabs": { "0": "email", "1": "phone" },
    "defaultRegisterTab": "email",
    "ldapConnections": null,
    "adConnections": { "0": "[]" },
    "disabledSocialConnections": null,
    "disabledOidcConnections": { "0": "[]" },
    "disabledSamlConnections": { "0": "[]" },
    "disabledOauth2Connections": { "0": "[]" },
    "disabledCasConnections": { "0": "[]" },
    "disabledAzureAdConnections": { "0": "[]" },
    "extendsFieldsEnabled": false,
    "extendsFields": {},
    "ext": null,
    "css": "/* \n  \u5728\u6b64\u7f16\u8f91\u8ba4\u8bc1\u9875\u9762\u7684 css \u4ee3\u7801\n  \u5982\uff1a\n  body {\n    background: #6699 !important;\n  } \n  \u7528\u4e8e\u4fee\u6539\u80cc\u666f\u8272\n*/",
    "oidcConfig": {
      "grant_types": {
        "0": "authorization_code",
        "1": "password",
        "2": "refresh_token",
        "3": "client_credentials"
      },
      "response_types": { "0": "code" },
      "id_token_signed_response_alg": "HS256",
      "token_endpoint_auth_method": "client_secret_post",
      "authorization_code_expire": 600,
      "id_token_expire": 3600,
      "access_token_expire": 3600,
      "refresh_token_expire": 3600,
      "cas_expire": 3600,
      "skip_consent": true,
      "redirect_uris": { "0": "http://localhost:8000/auth/callback" },
      "post_logout_redirect_uris": {},
      "client_id": "5f97fb40d352ecf69ffe6d98",
      "client_secret": "19938f6ef3c84360a9c0ab73c2cc88d7"
    },
    "samlConfig": null,
    "oauthConfig": {
      "id": "5f97fb40d352ecf69ffe6d98",
      "client_secret": "19938f6ef3c84360a9c0ab73c2cc88d7",
      "redirect_uris": { "0": "http://localhost:8000/auth/callback" },
      "grants": { "0": "authorization_code" },
      "access_token_lifetime": 3600,
      "refresh_token_lifetime": 7600,
      "introspection_endpoint_auth_method": "client_secret_post",
      "revocation_endpoint_auth_method": "client_secret_post"
    },
    "casConfig": null,
    "showAuthorizationPage": false,
    "enableSubAccount": false,
    "loginRequireEmailVerified": false,
    "agreementEnabled": false,
    "skipMfa": false,
    "permissionStrategy": {
      "enabled": false,
      "defaultStrategy": "ALLOW_ALL",
      "allowPolicyId": null,
      "denyPolicyId": null
    }
  }
}
```
