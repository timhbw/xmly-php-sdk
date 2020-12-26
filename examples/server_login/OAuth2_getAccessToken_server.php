<?php
require_once __DIR__ . '/../../autoload.php';

use Xmly\Http\Client;

$url = 'https://api.ximalaya.com/oauth2/v2/access_token';

$code = $_GET["code"];

$params = array(
    'client_id'     => '5d96523d111d6729658fe2587efd4e6f',
    'client_secret' => '40d396d4f50da3c46133fa43e8889643',
    'device_id'     => '32cc6f279c7a11e9a26e0235d2b38928',
    'code'          => $code,
    'redirect_uri'  => 'https://xxx.xxx.com/OAuth2_getAccessToken_server.php',
    'state'         => 'state',
    'grant_type'    => 'authorization_code'
);

// 获取访问令牌：https://open.ximalaya.com/doc/detailApi?categoryId=7&articleId=75#%E8%8E%B7%E5%8F%96%E8%AE%BF%E9%97%AE%E4%BB%A4%E7%89%8C
// https://open.ximalaya.com/doc/detailApi?categoryId=9&articleId=5#%E8%8E%B7%E5%8F%96%E8%AE%BF%E9%97%AE%E4%BB%A4%E7%89%8C

$headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';

$body = http_build_query($params);

$response = Client::post($url, $body, $headers);

header('Content-Type:application/json; charset=UTF-8');
exit($response->body);
