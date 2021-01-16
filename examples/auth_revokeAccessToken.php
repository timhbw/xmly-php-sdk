<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Auth;
use Xmly\Config;
use Xmly\OAuth2\OAuth2Manager;

$appKey = '7605b87e5d32547b3635831f49e6f6fd';
$appSecret = 'xxxxxx';
$deviceID = '32cc6f279c7a11e9a26e0235d2b38928';

$auth = new Auth($appKey, $appSecret, $deviceID);

$config = new Config();
$config->useHTTPS = true; // 接口是否使用 HTTPS 协议

$oauth2Manager = new OAuth2Manager($auth, $config);

$accessToken = 'be5575cd78e92d862182cbb8eae1ad9b';
$redirect_uri = 'https://xxxx.xxxx.com/oauth2/get_access_token';

// 回收访问令牌：https://open.ximalaya.com/doc/detailApi?categoryId=9&articleId=5#%E5%9B%9E%E6%94%B6%E8%AE%BF%E9%97%AE%E4%BB%A4%E7%89%8C

list($ret, $err) = $oauth2Manager->revokeAccessToken($redirect_uri, $accessToken);

if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}
