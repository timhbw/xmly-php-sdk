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

// 点播-免费内容-获取专辑下的声音列表：https://open.ximalaya.com/doc/detailApi?categoryId=10&articleId=6#%E8%8E%B7%E5%8F%96%E4%B8%93%E8%BE%91%E4%B8%8B%E7%9A%84%E5%A3%B0%E9%9F%B3%E5%88%97%E8%A1%A8

$body['album_id'] = 6922889; // 专辑ID
$body['sort'] = 'time_asc'; // 返回结果排序方式
$body = $auth->commonParams($body);

list($ret, $err) = $aodManager->getAlbumsBrowse($body, $serverAuthStaticKey);
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}
