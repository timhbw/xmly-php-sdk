<?php
require_once __DIR__ . '/../../autoload.php';

use Xmly\Http\Client;

$url = 'https://api.ximalaya.com/oauth2/v2/access_token';

$params = array(
    'client_id'     => '5d96523d111d6729658fe2587efd4e6f',
    'client_secret' => '40d396d4f50da3c46133fa43e8889643',
    'device_id'     => '32cc6f279c7a11e9a26e0235d2b38928',
    'code'          => '31a87e698d3009e85779bd590eee258b',
    'redirect_uri'  => 'https://timhbw.com/oauth2/get_access_token',
    'state'         => '1234',
    'grant_type'    => 'authorization_code'
);

// 获取访问令牌：https://open.ximalaya.com/doc/detailApi?categoryId=7&articleId=75#%E8%8E%B7%E5%8F%96%E8%AE%BF%E9%97%AE%E4%BB%A4%E7%89%8C
// https://open.ximalaya.com/doc/detailApi?categoryId=9&articleId=5#%E8%8E%B7%E5%8F%96%E8%AE%BF%E9%97%AE%E4%BB%A4%E7%89%8C

$headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';

$body = http_build_query($params);

$response = Client::post($url, $body, $headers);
var_dump($response);
//echo json_decode($response);
