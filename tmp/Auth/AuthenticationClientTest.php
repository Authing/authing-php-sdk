<?php
require_once __DIR__ . '../../../vendor/autoload.php';

use Authing\Auth\AuthenticationClient;
use Authing\Types\LoginByEmailInput;


$authenticationClient = new AuthenticationClient(function ($ops) {
    $ops->appId = "606dd67c164539e1c90f4d83";
});

$authenticationClient->loginByEmail(new LoginByEmailInput("1409458062@qq.com", "admin"));

$res = $authenticationClient->getCurrentUser();


$authenticationClient->logout();

$res = $authenticationClient->getCurrentUser();

// ok