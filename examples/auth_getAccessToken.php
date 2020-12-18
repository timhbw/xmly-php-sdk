<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Auth;
use Xmly\Config;
use Xmly\OAuth2\OAuth2Manager;

$appKey = 'xxxx';
$appSecret = 'xxxx';
$auth = new Auth($appKey, $appSecret);

$config = new Config();
$config->useHTTPS = true; // 接口是否使用 HTTPS 协议

$oauth2Manager = new OAuth2Manager($auth, $config);

$device_id = '2dfde78d-0169-47e2-982c-734930951d55';
$code = 'f6640ec68f7ca6a773d84682ef0b4733';
$redirect_uri = 'https://xxxx.xxxx.com/oauth2/get_access_token';
$state = 'abc';

// 获取访问令牌：https://open.ximalaya.com/doc/detailApi?categoryId=7&articleId=75#%E8%8E%B7%E5%8F%96%E8%AE%BF%E9%97%AE%E4%BB%A4%E7%89%8C
// https://open.ximalaya.com/doc/detailApi?categoryId=9&articleId=5#%E8%8E%B7%E5%8F%96%E8%AE%BF%E9%97%AE%E4%BB%A4%E7%89%8C
list($ret, $err) = $oauth2Manager->getAccessToken($device_id, $code, $redirect_uri, $state);

if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}