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

// 点播-免费内容-获取分类列表：https://open.ximalaya.com/doc/detailApi?categoryId=10&articleId=6#%E5%88%86%E7%B1%BB%E5%88%97%E8%A1%A8

//$body['xxxx'] = 'xxxx';
//$body = $auth->commonParams($body);
$body = $auth->commonParams();

list($ret, $err) = $aodManager->getCategoriesList($body, $serverAuthStaticKey);
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}

