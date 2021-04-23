<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Authing\Mgmt\ManagementClient;
use Authing\Types\CreateUserInput;
use Authing\Types\UpdateUserInput;


use Authing\Auth\AuthenticationClient;


$manage = new ManagementClient(function ($opts) {
    $opts->userPoolId = '5f819ffdaaf252c4df2c9266';
    $opts->secret = '06eca4ed85c807db9fc6a9d5483a4dc7';
});

$userManageClient = $manage->users();

// 创建用户
// UsersManagementClient->create(array $userInfo)
// $userInfo = (object)[
//     'username' => 'testusername',
//     'password' => 'password',
// ];
// $input = (new CreateUserInput())
//     ->withUsername($userInfo->username)
//     ->withPassword($userInfo->password);
// $res = $userManageClient->create($input);

// 修改用户资料
// UsersManagementClient->update(string $id, array $updates)
// $userInfo = (object)[
//     'username' => 'test1username',
//     'password' => 'password',
// ];
// $input = (new UpdateUserInput())
//     ->withUsername($userInfo->username);
// $userId = '60829164cc89d2c6353b0619';
// $res = $userManageClient->update($userId, $input);

// 获取用户详情
// UsersManagementClient->detail(string $userId)

// $userId = '60829164cc89d2c6353b0619';
// $res = $userManageClient->detail($userId);

// 获取自定义数据
// UsersManagementClient->listUdv(string $userId)

// $userId = '60829164cc89d2c6353b0619';
// $res = $userManageClient->listUdv($userId);

// 批量获取自定义数据
// UsersManagementClient->getUdfValueBatch(array $userIds)

// $userIds = ['60829164cc89d2c6353b0619', '608266fdce2e54ccb0a20be7'];
// $res = $userManageClient->getUdfValueBatch($userIds);

// 设置自定义数据
// UsersManagementClient->setUdfValue(string $userId, array $data)

$userId = '60829164cc89d2c6353b0619';
$res = $userManageClient->setUdfValue($userId, [
    'school' => '华中科技大学',
    'age' => '20',
]);

// 批量设置自定义数据
// UsersManagementClient->setUdfValueBatch(array $input)

// 删除自定义数据
// UsersManagementClient->removeUdfValue(string $userId, string $key)

// 删除用户
// UsersManagementClient->delete(string $userId)

// 批量删除用户
// UsersManagementClient->deleteMany(array $userIds)

// 批量获取用户
// UsersManagementClient->batch(array $identifiers, array $options)

// 获取用户列表
// UsersManagementClient->paginate(int $page = 1, int $limit = 10)

// 获取已归档用户列表
// UsersManagementClient->listArchivedUsers(int $page = 1, int $limit = 10)

echo 'ok';