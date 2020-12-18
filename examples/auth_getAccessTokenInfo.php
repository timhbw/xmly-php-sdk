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
$access_token = 'xxxx';


// 查询访问令牌：https://open.ximalaya.com/doc/detailApi?categoryId=9&articleId=5#%E6%9F%A5%E8%AF%A2%E8%AE%BF%E9%97%AE%E4%BB%A4%E7%89%8C

list($ret, $err) = $oauth2Manager->getAccessTokenInfo($device_id, $access_token);

if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}