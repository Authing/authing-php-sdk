<?php
require_once __DIR__ . '../../vendor/autoload.php';

use Authing\Mgmt\ManagementClient;
use Authing\Types\LoginByEmailInput;
use Authing\Auth\AuthenticationClient;
use Authing\Types\LoginByUsernameInput;
use Authing\Mgmt\ApplicationsManagementClient;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;



$settings = Yaml::parseFile('../tests/config/test.yaml');
// $settings->load('../tests/config.yaml');

var_dump($settings);

$client = new AuthenticationClient(function($options) {
    $options->appId = '5f97fb40d352ecf69ffe6d98';
    $options->secret = '19938f6ef3c84360a9c0ab73c2cc88d7';
    $options->redirectUri = 'http://localhost:3000';
    $options->appHost = 'https://localhost';
    $options->protocol = 'oidc';
});
// $client = new ManagementClient('5f88506c81cd279930195660', 'f6bbab3309f021639c6b04d6e54133cd');
// $client = new ManagementClient('606c5372d9f5a2b3d7620076', '4711e540c2f96fcd39fe45bb0ddabee9');

// $client->requestToken();
// $userManageClient = $client->users();
// $client->loginByUsername(new LoginByUsernameInput('shubuzuo', '123456'));
// $data = $client->listApplications();

$url = $client->buildAuthorizeUrl([
    "scope" => 'openid profile offline_access'
]);

echo $url;
// 通过手机号、用户池、邮箱、ExternalId 批量查找用户 PHP SDK
// $users = $userManageClient->batch([
//     '84277dc3-42d1-4e74-8017-472c798c3860',
// ], [
//     // 'queryField' => 'id',
//     // 'queryField' => 'username',
//     // 'queryField' => 'email',
//     // 'queryField' => 'phone',
//     'queryField' => 'externalId',
// ]);

// 通过 ExternalID 查用户信息 PHP
// $user = $userManageClient->find([
//     // 'username' => 'shubuzuo',
//     // 'email' => '1409458062@qq.com',
//     // 'phone' => '17630802710',
//     'externalId' => '84277dc3-42d1-4e74-8017-472c798c38601',
// ]);

// 本地验证 id_token 合法性 SDK（PHP）


// OIDC 拼装链接 PHP SDK


// var_dump(json_encode($user));

// $_client = new ManagementClient('5f88506c81cd279930195660', 'f6bbab3309f021639c6b04d6e54133cd');
// $_client->requestToken();
// $applications = $_client->applications();
// $list = $applications->list(['page' => 2, 'limit' => 10]);
// var_dump(json_encode($list));

// $app = $applications->findById('5f97fb40d352ecf69ffe6d98');

// var_dump(json_encode($app));