<?php
require_once __DIR__ . '../../../vendor/autoload.php';

use Authing\Mgmt\ManagementClient;
use Authing\Types\PolicyAssignmentTargetType;

// $client = new AuthenticationClient(function($options) {
//     $options->appId = '5f97fb40d352ecf69ffe6d98';
//     $options->secret = '19938f6ef3c84360a9c0ab73c2cc88d7';
//     $options->redirectUri = 'http://localhost:3000';
//     $options->appHost = 'https://localhost';
//     $options->protocol = 'oidc';
// });
$client = new ManagementClient('5f88506c81cd279930195660', 'f6bbab3309f021639c6b04d6e54133cd');
// $client = new ManagementClient('605ae5ebf3e8478bba488c38', 'aa30679b3e0bb3710bcd60af4e4b684d');

// $client->setHost('http://localhost:3000');
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
$res = $aclManageClient->programmaticAccessAccountList('5f97fb40d352ecf69ffe6d98');

// 添加编程访问账号 createProgrammaticAccessAccount
// $res = $aclManageClient->createProgrammaticAccessAccount('605ae5ec60d8d6c4945b2c6c');
// 禁用编程访问账号 disableProgrammaticAccessAccount
// $res = $aclManageClient->disableProgrammaticAccessAccount("6071565b67974118aa7f23fa");
// 删除编程访问账号 deleteProgrammaticAccessAccount
// $res = $aclManageClient->deleteProgrammaticAccessAccount("6071565b67974118aa7f23fa");

// 启用编程访问账号 enableProgrammaticAccessAccount
// $res = $aclManageClient->enableProgrammaticAccessAccount("6071565b67974118aa7f23fa");

// 刷新编程访问账号密钥 refreshProgrammaticAccessAccountSecret
// 60715954810047a584d5a612    5570623490fc9a23cdf47b4dffe2b752
// $res = $aclManageClient->refreshProgrammaticAccessAccountSecret("60715954810047a584d5a612");

// 将一个（类）资源授权给用户、角色、分组、组织机构，且可以分别指定不同的操作权限。 authorizeResource
// $res = $aclManageClient->authorizeResource([
//     'namespace' => '5f88506c705dc7fa80e5f39e',
//     'resource' => 'code',
//     'opts' => [
//         'targetType' => PolicyAssignmentTargetType::USER,
//         'targetIdentifier' => '606fd22265371f55fdb1bfad',
//         'actions' => ['code:a', 'code:b']
//     ],
// ]);

// 获取具备某个（类）资源操作权限的用户、分组、角色、组织机构。 listResourcePermissions
// $res = $aclManageClient->listResourcePermissions();

// 获取应用访问控制策略 getApplicationAccessPolicies
// $res = $aclManageClient->getApplicationAccessPolicies([
//     'appId' => '5f97fb40d352ecf69ffe6d98'
// ]);

// 启用应用访问控制策略 enableApplicationAccessPolicy
// $res = $aclManageClient->enableApplicationAccessPolicy([
//     'appId' => '5f97fb40d352ecf69ffe6d98',
//     'targetType' => PolicyAssignmentTargetType::USER,
//     // only role
//     // 'namespace'? => '',
//     'targetIdentifiers' => ['606fd22265371f55fdb1bfad'],
//     // 'inheritByChildren'? => '',
// ]);

// 停用应用访问控制策略 disableApplicationAccessPolicy
// $res = $aclManageClient->disableApplicationAccessPolicy([
//     'appId' => '5f97fb40d352ecf69ffe6d98',
//     'targetType' => PolicyAssignmentTargetType::USER,
//     // only role
//     // 'namespace'? => '',
//     'targetIdentifiers' => ['606fd22265371f55fdb1bfad'],
//     // 'inheritByChildren'? => '',
// ]);


// 删除应用访问控制策略 deleteApplicationAccessPolicy
// $res = $aclManageClient->deleteApplicationAccessPolicy([
//     'appId' => '5f97fb40d352ecf69ffe6d98',
//     'targetType' => PolicyAssignmentTargetType::USER,
//     'namespace' => '',
//     'targetIdentifiers' => '606fd22265371f55fdb1bfad',
//     'inheritByChildren' => '',
// ]);

// 配置「允许主体（用户、角色、分组、组织机构节点）访问应用」的控制策略 allowAccessApplication
// $res = $aclManageClient->allowAccessApplication([
//     'appId' => '5f97fb40d352ecf69ffe6d98',
//     'targetType' => PolicyAssignmentTargetType::USER,
//     // only role
//     // 'namespace'? => '',
//     'targetIdentifiers' => ['606fd22265371f55fdb1bfad'],
//     // 'inheritByChildren'? => '',
// ]);


// 配置「拒绝主体（用户、角色、分组、组织机构节点）访问应用」的控制策略 denyAccessApplication
// $res = $aclManageClient->denyAccessApplication([
//     'appId' => '5f97fb40d352ecf69ffe6d98',
//     'targetType' => PolicyAssignmentTargetType::USER,
//     // only role
//     // 'namespace'? => '',
//     'targetIdentifiers' => ['606fd22265371f55fdb1bfad'],
//     // 'inheritByChildren'? => '',
// ]);

// 更改默认应用访问策略（默认拒绝所有用户访问应用、默认允许所有用户访问应用） updateDefaultApplicationAccessPolicy
// $res = $aclManageClient->updateDefaultApplicationAccessPolicy([
//     'appId' => '5f97fb40d352ecf69ffe6d98',
//     'defaultStrategy' => 'DENY_ALL'
// ]);


var_dump(json_encode($res), JSON_UNESCAPED_UNICODE);
