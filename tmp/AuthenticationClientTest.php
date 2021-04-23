<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Authing\Mgmt\ManagementClient;
use Authing\Types\LoginByEmailInput;
use Authing\Auth\AuthenticationClient;
use Authing\Types\UpdateUserInput;
use Authing\Types\LoginByUsernameInput;
use Authing\Mgmt\ApplicationsManagementClient;

$authentication = new AuthenticationClient(function ($opts) {
    $opts->appId = '5f81a04818860aca72aac021';
    // $opts->appHost = "YOUR_APPHOST";
});

// $authentication->loginByUsername('shubuzuo', '123456');
// $authentication->loginByPhonePassword('17630802710', 'password');
// $authentication->registerByEmail // 使用邮箱注册
// $authentication->loginByEmail // 使用邮箱登录
// 使用邮箱注册
// AuthenticationClient->registerByEmail($input)
// $authentication->registerByEmail('shubuzuo@qq.com', '123456');


// 使用用户名注册
// AuthenticationClient->registerByUsername($input)
// $authentication->registerByUsername('shubuzuo-test', '123456');

// 发送短信验证码
// AuthenticationClient->sendSmsCode($phone)
// $code = $authentication->sendSmsCode('17630802710');


// 使用手机号注册
// AuthenticationClient->registerByPhoneCode($input)
// $authentication->registerByPhoneCode('17630802710', '1065');



// $authentication->loginByUsername('shubuzuo', '123456');
// $user = $authentication->getCurrentUser();

// $authentication->loginByLdap('admin', 'admin');

// updateProfile
// $input = (new UpdateUserInput())->withAddress('aa')->withCity('bb');
// $authentication->updateProfile($input);
// setUdv
// $authentication->setUdv('test', 'test-value');
// $authentication->setUdv('key', 'test-value');
// removeUdv
// $authentication->removeUdv('key');
// loginByLdap
// loginByAd
// getUdfValue
// $res = $authentication->getUdfValue();
// computedPasswordSecurityLevel
// removeUdfValue
// $res = $authentication->removeUdfValue('test');
// listUdv
// $res = $authentication->listUdv();
// setUdfValue
// $res = $authentication->setUdfValue([
//         'key' => 'new key',
//         'test' => 'new test',
// ]);
// $res = $authentication->listUdv();
// hasRole
// $res = $authentication->hasRole('test_role_code');
// echo 'ok';

// getaccess

// use Authing\Auth\AuthenticationClient;

$authenticationClient = new AuthenticationClient(function ($options) {
    $options->appId = '5f81a04818860aca72aac021';
    $options->secret = '8c84892814f62bfe4c313a6ba9282d9c';
    $options->appHost = 'https://shubuzuo-oidc.authing.cn';
    $options->redirectUri = 'http://localhost:3000';
    $options->tokenEndPointAuthMethod = 'none';
    $options->protocol = 'oauth';
});
$res = $authenticationClient->getAccessTokenByCode('8399e2543bcb90a3f286718c78b57064127b7c50');

echo 'ok';