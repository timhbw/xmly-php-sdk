<?php
require_once __DIR__ . '/../../autoload.php';

use Xmly\Auth;
use Xmly\Config;
use Xmly\API\AodManager;
use Xmly\Util;

$appKey = '99b37417e1185eda1378600593b45c40';
$appSecret = 'dd7a46b12fe8a304ef17892c89ede22a';
$serverAuthStaticKey = 'XEbin4wC';
$auth = new Auth($appKey, $appSecret);

$config = new Config();
$config->useHTTPS = true; // 接口是否使用 HTTPS 协议

$aodManager = new AodManager($auth, $config);

$body = array(
    'app_key' => $appKey,
    'client_os_type' => 4,
    'nonce' => Util::randomString(11),
    'timestamp' => Util::msecTime(),
    'device_id' => '2dfde78d016947e2982c734930951d55',
    'server_api_version' => '1.0.0'
);

// 点播-主播-获取主播分类列表：https://open.ximalaya.com/doc/detailApi?categoryId=10&articleId=61
list($ret, $err) = $aodManager->getAnnouncersCategories($body, $serverAuthStaticKey);
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}

