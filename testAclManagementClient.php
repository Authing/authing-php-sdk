<?php
require_once __DIR__ . '/vendor/autoload.php';

use Authing\Mgmt\UsersManagementClient;
use Authing\Types\LoginByEmailInput;
use Authing\Auth\AuthenticationClient;
use Authing\Mgmt\AclManagementClient;
use Authing\Types\LoginByUsernameInput;


$authentication = new AuthenticationClient(function ($options) {
    $options->appId = "-";
});

$aclManagementClient = new AclManagementClient($authentication);


// 获取用户被授权的所有资源列表
// TODO: 缺失
// TODO: js 文档有错误
// $data = $aclManagementClient->listAuthorizedResources();


echo 'aa';
