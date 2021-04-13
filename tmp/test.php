<?php
require_once __DIR__ . '../../vendor/autoload.php';

use Authing\Mgmt\ManagementClient;
use Authing\Types\LoginByEmailInput;
use Authing\Auth\AuthenticationClient;
use Authing\Types\LoginByUsernameInput;
use Authing\Mgmt\ApplicationsManagementClient;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Yaml\Exception\ParseException;
use Authing\Mgmt\Utils;
use Test\TestConfig;

TestConfig::getConfig();

// $client = new AuthenticationClient(function($options) {
//     $options->appId = '5f97fb40d352ecf69ffe6d98';
//     $options->secret = '19938f6ef3c84360a9c0ab73c2cc88d7';
//     $options->redirectUri = 'http://localhost:3000';
//     $options->appHost = 'https://localhost';
//     $options->protocol = 'oidc';
// });
$client = new ManagementClient('5f88506c81cd279930195660', 'f6bbab3309f021639c6b04d6e54133cd');
// $client = new ManagementClient('606c5372d9f5a2b3d7620076', '4711e540c2f96fcd39fe45bb0ddabee9');

$client->requestToken();
$aclManageClient = $client->acl();
// $client->loginByUsername(new LoginByUsernameInput('shubuzuo', '123456'));
// $data = $client->listApplications();

// $url = $client->buildAuthorizeUrl([
//     "scope" => 'openid profile offline_access'
// ]);

// echo $url;
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
// 创建资源
// $res = $aclManageClient->createResource([
//     'code' => 'code1',
//     'actions' => [
//         (object)[
//             'name' => 'name',
//             'description' => 'description'
//         ]
//     ],
//     'namespace' => '5f88506c705dc7fa80e5f39e'
// ]);
// 更新资源
// $res = $aclManageClient->updateResource('code', [
//     'description' => '新的描述',
//     'type' => 'DATA',
//     'actions'=> [
//         (object)[
//             'name' => 'write',
//             'description' => 'new description'
//         ],
//         (object)[
//             'name' => 'read',
//             'description' => 'new description1'
//         ],
//     ],
//     'namespace' => '5f88506c705dc7fa80e5f39e'
// ]);


// 获取资源
// $res = $aclManageClient->getResources([
//     'namespaceCode' => '5f88506c705dc7fa80e5f39e',
//     'type' => 'DATA',
// ]);
// var_dump($res);
// 删除资源
// $res = $aclManageClient->deleteResource('code1', '5f88506c705dc7fa80e5f39e');
// var_dump($res);

// 编程访问账号列表 programmaticAccessAccountList

// 添加编程访问账号 createProgrammaticAccessAccount

// 禁用编程访问账号 disableProgrammaticAccessAccount

// 删除编程访问账号 deleteProgrammaticAccessAccount

// 启用编程访问账号 enableProgrammaticAccessAccount

// 刷新编程访问账号密钥 refreshProgrammaticAccessAccountSecret

// 将一个（类）资源授权给用户、角色、分组、组织机构，且可以分别指定不同的操作权限。 authorizeResource

// 获取具备某个（类）资源操作权限的用户、分组、角色、组织机构。 listResourcePermissions

// 获取应用访问控制策略 getApplicationAccessPolicies

// 启用应用访问控制策略 enableApplicationAccessPolicy

// 停用应用访问控制策略 disableApplicationAccessPolicy

// 删除应用访问控制策略 deleteApplicationAccessPolicy

// 配置「允许主体（用户、角色、分组、组织机构节点）访问应用」的控制策略 allowAccessApplication

// 配置「拒绝主体（用户、角色、分组、组织机构节点）访问应用」的控制策略 denyAccessApplication

// 更改默认应用访问策略（默认拒绝所有用户访问应用、默认允许所有用户访问应用） updateDefaultApplicationAccessPolicy