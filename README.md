# Authing - PHP

<div align="center">
  <a href="https://authing.cn"><img width="300" src="https://files.authing.co/authing-console/authing-logo-new-20210924.svg?a=1" alt="Authing" /></a>
</div>
<br/>

[Authing](https://authing.cn/) 身份云 `PHP` 语言客户端，包含 [Authing Open API](https://core.authing.cn/openapi/) 所有 Management API 的请求方法。

此模块一般用于后端服务器环境，以管理员（Administrator）的身份进行请求，用于管理 Authing 用户、角色、分组、组织机构等资源；一般来说，你在 Authing 控制台中能做的所有操作，都能用此模块完成。

## 安装

我们推荐使用 `composer` 进行安装，它可以与一些模块打包工具很好地配合使用。

```bash
$ composer require authing-sdk/php
```

## 初始化

初始化 `ManagementClient` 需要使用 `accessKeyId` 和 `accessKeySecret` 参数:

```php
use Authing\ManagementClient;

$management = new ManagementClient("AUTHING_USERPOOL_ID", "AUTHING_USERPOOL_SECRET");
```

`ManagementClient` 会自动从 Authing 服务器获取  Management API Token，并通过返回的 Token 过期时间自动对 Token 进行缓存。

完整的参数和释义如下：

- `accessKeyId`: Authing 用户池 ID；
- `accessKeySecret`: Authing 用户池密钥；
- `host`: Authing 服务器地址，默认为 `https://api.authing.cn`。如果你使用的是 Authing 公有云版本，请忽略此参数。如果你使用的是私有化部署的版本，此参数必填，格式如下: https://authing-api.my-authing-service.com（最后不带斜杠 / ）。

## 快速开始

初始化完成 `ManagementClient`  之后，你可以获取 `ManagementClient` 的实例，然后调用此实例上的方法。例如：

- 获取用户列表

```php
$users = $management->listUsers();
```
- 获取用户

```php
$user = $management->getUser(array(
    "userId" => "62559df6b2xxxx259877b5f4"
));
```

完整的接口列表，你可以在 [Authing Open API](https://api.authing.cn/openapi/) 中获取。

## 错误处理

`ManagementClient` 中的每个方法，遵循统一的返回结构：

- `code`: 请求是否成功状态码，当 `code` 为 200 时，表示操作成功，非 200 全部为失败。
- `errorCode`: 细分错误码，当 `code` 非 200 时，可通过此错误码得到具体的错误类型。
- `message`: 具体的错误信息。
- `data`: 具体返回的接口数据。

一般情况下，如果你只需要判断操作是否成功，只需要对比一下 `code` 是否为 200。如果非 200，可以在代码中通抛出异常或者任何你项目中使用的异常处理方式。

```php
use Authing\ManagementClient;

$management = new ManagementClient("AUTHING_USERPOOL_ID", "AUTHING_USERPOOL_SECRET");

try {
    $user = $management->getUser(array(
        "userId" => "62559df6b2xxxx259877b5f4"
    ));
    if ($user["code"] != 200) {
        throw new Exception("Error"); // 抛出异常，由 全局异常捕捉 或 try catch 进行异常捕捉
    }
} catch (\Throwable $th) {
    print_r($e);
}
```

## 私有化部署
如果你使用的是私有化部署的 Authing IDaaS 服务，需要指定此 Authing 私有化实例的 host，如：

```php
use Authing\ManagementClient;

$management = new ManagementClient("AUTHING_USERPOOL_ID", "AUTHING_USERPOOL_SECRET", "https://authing-api.my-authing-service.com");
```

如果你不清楚如何获取，可以联系 Authing IDaaS 服务管理员。

## 获取帮助

有任何疑问，可以在 Authing 论坛提出: [#authing-chat](https://forum.authing.cn/)
