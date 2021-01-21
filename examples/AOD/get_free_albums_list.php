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

// 点播-免费内容-获取专辑列表：https://open.ximalaya.com/doc/detailApi?categoryId=10&articleId=6#%E4%B8%93%E8%BE%91%E5%88%97%E8%A1%A8

$body['category_id'] = 30; // 分类ID，为0时表示热门分类。分类数据可以通过 /categories/list获取
$body['calc_dimension'] = 1; // 返回结果排序维度：1-最火，2-最新，3-最多播放
$body = $auth->commonParams($body);

list($ret, $err) = $aodManager->getAlbumsList($body, $serverAuthStaticKey);
if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}
