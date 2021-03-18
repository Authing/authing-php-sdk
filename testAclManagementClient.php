<?php
require_once __DIR__ . '/vendor/autoload.php';

use Authing\Mgmt\UsersManagementClient;
use Authing\Types\LoginByEmailInput;
use Authing\Mgmt\ManagementClient;
use Authing\Mgmt\AclManagementClient;
use Authing\Types\LoginByUsernameInput;
use Authing\Types\PolicyAssignmentTargetType;


$authentication = new ManagementClient('5f88506c81cd279930195660', 'f6bbab3309f021639c6b04d6e54133cd');

$authentication->requestToken();


$aclManagementClient = new AclManagementClient($authentication);

// 获取用户被授权的所有资源列表
// TODO: 缺失
// TODO: js 文档有错误
$data = $aclManagementClient->listAuthorizedResources(PolicyAssignmentTargetType::USER, '602e2ddf5fd407fe8a8e8f19', 'default');

var_dump($data);

echo 'aa';
