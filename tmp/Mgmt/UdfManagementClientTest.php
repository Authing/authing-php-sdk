<?php
require_once __DIR__ . '../../../vendor/autoload.php';

use Authing\Mgmt\ManagementClient;
use Authing\Types\UDFTargetType;

$client = new ManagementClient('5f88506c81cd279930195660', 'f6bbab3309f021639c6b04d6e54133cd');

// $client->setHost('http://localhost:3000');
$client->requestToken();
$udfManageClient = $client->udf();

// 获取某一实体的自定义字段数据列表
// $res = $udfManageClient->listUdv(UDFTargetType::USER, '6073e46da6c86d84a9def94a');

// 批量添加自定义数据
$res = $udfManageClient->setUdvBatch(UDFTargetType::USER, '6073e46da6c86d84a9def94a', [
    (object) [
        'key' => 'this is key',
        'value' => 'this is value',
    ],
]);

$a = json_encode($res);
echo $a;
echo 'ok';
