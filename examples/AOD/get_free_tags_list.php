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

// 点播-免费内容-获取标签列表：https://open.ximalaya.com/doc/detailApi?categoryId=10&articleId=6#%E6%A0%87%E7%AD%BE%E5%88%97%E8%A1%A8

$body['category_id'] = 30; // 分类ID，为0时表示热门分类。分类数据可以通过 /categories/list获取
$body['type'] = 0; // 指定返回专辑标签还是声音标签：0-专辑标签，1-声音标签
$body = $auth->commonParams($body);


list($ret, $err) = $aodManager->getTagsList($body, $serverAuthStaticKey);
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}

