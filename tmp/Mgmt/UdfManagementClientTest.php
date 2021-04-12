<?php
require_once __DIR__ . '../../../vendor/autoload.php';

use Authing\Mgmt\ManagementClient;
use Authing\Types\UDFTargetType;

$client = new ManagementClient('---', '---');
// $client = new ManagementClient('605ae5ebf3e8478bba488c38', 'aa30679b3e0bb3710bcd60af4e4b684d');


// $client->setHost('http://localhost:3000');
$client->requestToken();
$udfManageClient = $client->udf();

// 获取某一实体的自定义字段数据列表
// $res = $udfManageClient->listUdv(UDFTargetType::USER, '6073e46da6c86d84a9def94a');
$res = $udfManageClient->listUdv(UDFTargetType::USER, '--');
// [
//     {
//         "key": "好家伙",
//         "dataType": "STRING",
//         "value": "this is value",
//         "label": "这是一个扩展字段"
//     }
// ]


// 批量添加自定义数据
// $res = $udfManageClient->setUdvBatch(UDFTargetType::USER, '606fd22265371f55fdb1bfad', [
//     (object) [
//         'key' => '好家伙',
//         'value' => 'this is value',
//     ],
// ]);


$a = json_encode($res);
echo $a;
echo 'ok';
