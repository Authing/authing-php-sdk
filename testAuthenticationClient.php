<?php
require_once __DIR__ . '/vendor/autoload.php';

use Authing\Auth\AuthenticationClient;
use Authing\Types\LoginByEmailInput;
use Authing\Types\LoginByUsernameInput;


// $authentication = new AuthenticationClient(function ($options) {
//     $options->appId = "-";
//     $options->secret = "-";
//     $options->host = "-";
//     $options->redirectUri = "-";
//     $options->protocol = "oidc";
//     $options->tokenEndPointAuthMethod = "none";
// });

$authentication = new AuthenticationClient(function($ops) {
    $ops->appId = '5f97fb40d352ecf69ffe6d98';
});
$user = $authentication->loginByUsername(new LoginByUsernameInput("shubuzuo", "123456"));


// $authentication->setAccessToken($user->token);

// //检查密码强度
// $strength = $authentication->checkPasswordStrength('asdasd');

// // 获取自定义数据
// $data = $authentication->listUdv();

// // 添加自定义字段


// // 设置自定义数据
// $data =
//     $authentication->setUdv('好家伙', "ok");

// $data = $authentication->listUdv();

// // 删除自定义数据
// $data = $authentication->removeUdv('好家伙');

// $data = $authentication->listUdv();

// $_ = new stdClass;
// $_->primaryUserToken = "";
// $_->secondaryUserToken = "";
// // 绑定社交账号
// $data = $authentication->linkAccount($_);

// // 获取用户所在组织机构
// $data = $authentication->listOrg();

// // 使用 LDAP 用户名登录
// // $data = $authentication->loginByLdap("test", "J@vascript1#!");

// // 使用 AD 用户名登录
// // $data = $authentication->loginByAd("test", "J@vascript1#!");

// // 计算密码安全等级
// // $data = $authentication->computedPasswordSecurityLevel('J@vascript1#!');

// // 获取用户账号安全等级
// $data = $authentication->getSecurityLevel();

// // 获取用户被授权的所有资源列表
// $data = $authentication->listAuthorizedResources('5f88506c705dc7fa80e5f39e');

// 通过 浏览器 URL 跳转取得
// $code = "7JCgb9MfBmplCjIydOFarP48zg5O215Vtq9jD_gYNdE";
// OIDC
// $accessToken = $authentication->_getAccessTokenByCodeWithClientSecretBasic($code);
// $accessToken = $authentication->getAccessTokenByCode($code);
// $accessToken = $authentication->_getAccessTokenByCodeWithNone($code);
// $accessToken = $authentication->getAccessTokenByClientCredentials($code);
// $accessToken = $authentication->getUserInfoByAccessToken($accessToken->access_token);

// $data = $authentication->listAuthorizedResources('default');

echo 'aa';
