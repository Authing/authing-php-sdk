<?php
/**
 * Created by PhpStorm.
 * User: haoweilai
 * Date: 2018/4/30
 * Time: 下午11:12
 */

// require __DIR__.'/../vendor/autoload.php';
require_once __DIR__ . '/../src/AuthingApiClient.php';

use Authing\AuthingApiClient;

$data = [
    'clientId' => 'your id',
    'secret' => 'your secret',
];
$client = new AuthingApiClient($data);

$username = "username";
$email = 'email';
$password = '12345678';

/**
 * 注册用户 支持多个参数
 */
$param = new Authing\RegisterParam();
$param->userInfo = new Authing\UserRegisterInput();
$param->userInfo->username = $username;
$param->userInfo->email = $email;
$param->userInfo->password = $password;
$client->register($param);
/**
 * 邮箱登录接口
 */
$param = new Authing\LoginParam();
$param->email = $email;
$param->password = $password;
$res = $client->loginByEmail($param);
$token = $res->login->token;
$id = $res->login->_id;
/**
 * 用户名登录接口
 */
$param = new Authing\LoginParam();
$param->username = $username;
$param->password = $password;
$res = $client->loginByUsername($param);
$token = $res->login->token;
$id = $res->login->_id;
/**
 * oauth 列表
 */
$param = new Authing\ReadOauthListParam();
$client->readOAuthList($param);
/**
 * 查看指定用户
 */
$param = new Authing\UserParam();
$param->id = $id;
$client->user($param);
/**
 * 批量查询用户池中的用户
 */
$param = new Authing\UsersParam();
$param->count = 10;
$param->page = 1;
$client->users($param);
/**
 * 查看用户是否已经登录
 */
$param = new Authing\CheckLoginStatusParam();
$param->token = $token;
$client->checkLoginStatus($param);
/**
 * 发送确认邮箱邮件
 */
$param = new Authing\SendVerifyEmailParam();
$param->email = $email;
$param->token = $token;
$client->sendVerifyEmail($param);
/**
 * 解析 jwt token
 */
$param = new Authing\DecodeJwtTokenParam();
$param->token = $token;
$client->decodeJwtToken($param);
/**
 * 检查用户是否存在
 */
$param = new Authing\UserExistParam();
$param->email = $email;
$client->userExist($param);
/**
 * 刷新 token
 */
$param = new Authing\RefreshTokenParam();
$param->user = $id;
$client->refreshToken($param);
/**
 * 根据 id 列表批量查询用户
 */
$param = new Authing\UserPatchParam();
$param->ids = $id;
$client->userPatch($param);
/**
 * 发送修改密码邮件
 */
$param = new Authing\SendResetPasswordEmailParam();
$param->email = $email;
$client->sendResetPasswordEmail($param);
/**
 * 确认验证码是否正确
 */
//    $param = new Authing\VerifyResetPasswordVerifyCodeParam();
//    $param->email = $email;
//    $param->verifyCode = "";
//    $client->verifyResetPasswordVerifyCode($param);
/**
 * 修改密码
 */
//    $param = new Authing\ChangePasswordParam();
//    $param->email = $email;
//    $param->verifyCode = "";
//    $param->password = "123456";
//    $client->changePassword($param);
/**
 * 修改用户信息
 */
$param = new Authing\UpdateUserParam();
$param->options = new Authing\UserUpdateInput();
$param->options->_id = $id;
$param->options->nickname = "hello world";
$client->updateUser($param);
/**
 * 删除用户
 */
$param = new Authing\RemoveUsersParam();
$param->ids = $id;
$client->removeUsers($param);
