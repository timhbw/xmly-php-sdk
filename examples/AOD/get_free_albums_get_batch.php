<?php
require_once __DIR__ . '/../../autoload.php';

use Xmly\Auth;
use Xmly\Config;
use Xmly\API\AodManager;

$appKey = '99b37417e1185eda1378600593b45c40';
$appSecret = 'dd7a46b12fe8a304ef17892c89ede22a';
$deviceID = '32cc6f279c7a11e9a26e0235d2b38928';
$serverAuthStaticKey = 'XEbin4wC';

$auth = new Auth($appKey, $appSecret, $deviceID);

$config = new Config();
$config->useHTTPS = true; // 接口是否使用 HTTPS 协议
$config->enableLogs = true; // 是否记录日志到本地

$aodManager = new AodManager($auth, $config);

// 点播-免费内容-批量获取专辑信息：https://open.ximalaya.com/doc/detailApi?categoryId=10&articleId=6#%E6%89%B9%E9%87%8F%E8%8E%B7%E5%8F%96%E4%B8%93%E8%BE%91%E4%BF%A1%E6%81%AF

$body['ids'] = '6922889,8139811,6255099'; // 以英文逗号分隔的专辑ID
$body['with_metadata'] = false; // 是否返回metadata
$body = $auth->commonParams($body);

list($ret, $err) = $aodManager->getAlbumsGetBatch($body, $serverAuthStaticKey);
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}
