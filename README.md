# authing-php-sdk

Authing SDK for PHP 支持 PHP 5.4+。

[官方文档请点击这里](https://docs.authing.cn)。

## 安装

#### composer

当构建大规模应用时，我们推荐使用 `composer` 进行安装， 它可以与一些模块打包工具很好地配合使用。

```shell
# latest stable
$ composer require authing-sdk/php
```

#### no-composer

如果不希望使用 `composer`，需要先克隆此项目并切换到 `no-composer` 分支：

```bash
$ git clone https://github.com/Authing/authing-php-sdk.git
$ git checkout no-composer
```

然后将 src 下的代码文件拷贝到项目目录中，
并在入口文件顶部使用 `require` 或 `require_once` 进行引入即可。

## 开始使用

```php
use Authing\AuthingApiClient;

try {
  $data = [
    'clientId' => 'your id',
    'secret'   => 'your secret',
  ];

  $client = new Client($data);

  $client->login([
    'email' => '376155014@qq.com',
    'password' => '654321',
  ]);
} catch (\Exception $e) {
  // 出错了
  print_r($e->getMessage());
}
```

更多示例请查看 [test/index.php](./test/index.php)

[怎样获取 Client ID ?](https://docs.authing.cn/#/quick_start/howto)。

获取 Client ID 和 Client Secret，请[点击这里](https://docs.authing.cn/#/quick_start/howto)。

## 错误处理

统一使用 try...catch 处理错误

了解更多报错的详情，请查看[错误代码列表](https://docs.authing.cn/#/quick_start/error_code)。

[接口相关文档请点击这里](https://docs.authing.cn/sdk/open-graphql.html)。

## 自定义接口请求

SDK 中提供了所有线上 Graphql 的 Param、Response 类型，但由于工作量较大，并未封装完成所有的接口，
如需调用还未封装的 Graphql 接口，可以继承 AuthingApiClient 类并实现对应的方法，例如：

```php
class AuthingApiClientExtends extends AuthingApiClient
{
    public function __construct($options)
    {
        parent::__construct($options);
    }

    public function signIn(SignInParam $param)
    {
        $this->checkParams($param, 'oidcAppId');

        $param->userPoolId = $this->options["clientId"];
        if ($param->password != null) {
            $param->password = self::passwordEncrypt($param->password);
        }

        return $this->request($param->createRequest());
    }
}
```
