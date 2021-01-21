<?php
require_once __DIR__ . '/../../autoload.php';

use Xmly\Auth;
use Xmly\Config;
use Xmly\API\AodManager;

$appKey = 'xxxxxx';
$appSecret = 'xxxxxx';
$deviceID = '32cc6f279c7a11e9a26e0235d2b38928';
$serverAuthStaticKey = 'xxxxxx';

$auth = new Auth($appKey, $appSecret, $deviceID);

$config = new Config();
$config->useHTTPS = true; // 接口是否使用 HTTPS 协议
$config->enableLogs = true; // 是否记录日志到本地

$aodManager = new AodManager($auth, $config);

// 点播-主播-获取主播分类列表：https://open.ximalaya.com/doc/detailApi?categoryId=10&articleId=61
//$body['xxxx'] = 'xxxx';
//$body = $auth->commonParams($body);
$body = $auth->commonParams();

list($ret, $err) = $aodManager->getAnnouncersCategories($body, $serverAuthStaticKey);
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}
