<?php
require_once __DIR__ . '../../../vendor/autoload.php';

use Authing\Auth\AuthenticationClient;
use Authing\Types\LoginByEmailInput;


$authenticationClient = new AuthenticationClient(function ($ops) {
    $ops->appId = "---";
});

$authenticationClient->loginByEmail(new LoginByEmailInput("--", "-"));

$res = $authenticationClient->getCurrentUser();


$authenticationClient->logout();

$res = $authenticationClient->getCurrentUser();

// ok