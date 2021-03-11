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

初始化 `AuthenticationClient` 需要 `userPoolId`（用户池 ID）：

> 你可以在此[了解如何获取 UserPoolId](https://docs.authing.cn/v2/guides/faqs/get-userpool-id-and-secret.html) .

```php
use Authing\Auth\AuthenticationClient;

$authentication = new AuthenticationClient("AUTHING_USERPOOL_ID");
```

接下来可以进行注册登录等操作：

```php
use Authing\Auth\AuthenticationClient;
use Authing\Types\LoginByEmailInput;

$authentication = new AuthenticationClient("AUTHING_USERPOOL_ID");
$user = $authentication->loginByEmail(new LoginByEmailInput("test@example.com", "123456"));
```

完成登录之后，`update_profile` 等要求用户登录的方法就可用了：

```php
use Authing\Auth\AuthenticationClient;
use Authing\Types\LoginByEmailInput;
use Authing\Types\UpdateUserInput;

$authentication = new AuthenticationClient("AUTHING_USERPOOL_ID");
$authentication->loginByEmail(new LoginByEmailInput("test@example.com", "123456"));

$user = $authentication->updateProfile((new UpdateUserInput())->withNickname("nickname"));
```

你也可以在初始化后设置 `AccessToken` 参数, 不需要每次都调用 `LoginByXXX` 方法:

```php
use Authing\Auth\AuthenticationClient;

$authentication = new AuthenticationClient("AUTHING_USERPOOL_ID");
$authentication->setAccessToken("ACCESS_TOKEN");
```

再次执行 `UpdateProfile` 方法，发现也成功了:

```php
use Authing\Auth\AuthenticationClient;
use Authing\Types\UpdateUserInput;

$authentication = new AuthenticationClient("AUTHING_USERPOOL_ID");
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
