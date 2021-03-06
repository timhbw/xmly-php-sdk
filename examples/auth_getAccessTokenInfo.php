<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Auth;
use Xmly\Config;
use Xmly\OAuth2\OAuth2Manager;

$appKey = 'xxxxxx';
$appSecret = 'xxxxxx';
$deviceID = '32cc6f279c7a11e9a26e0235d2b38928';

$auth = new Auth($appKey, $appSecret, $deviceID);

$config = new Config();
$config->useHTTPS = true; // 接口是否使用 HTTPS 协议

$oauth2Manager = new OAuth2Manager($auth, $config);

$accessToken = 'xxxx';


// 查询访问令牌：https://open.ximalaya.com/doc/detailApi?categoryId=9&articleId=5#%E6%9F%A5%E8%AF%A2%E8%AE%BF%E9%97%AE%E4%BB%A4%E7%89%8C

list($ret, $err) = $oauth2Manager->getAccessTokenInfo($accessToken);

if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}
