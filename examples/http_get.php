<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Auth;
use Xmly\Http\Client;

$appKey = '99b37417e1185eda1378600593b45c40';
$appSecret = 'dd7a46b12fe8a304ef17892c89ede22a';
$deviceID = '32cc6f279c7a11e9a26e0235d2b38928';

$auth = new Auth($appKey, $appSecret, $deviceID);

$url = "https://api-qiniu.timhbw.com/token/getUpToken";
$contentType = "application/json";

$headers['Content-Type'] = $contentType;
$response = Client::get($url, $headers);

if ($response->ok()) {
    $r = $response->json();
    var_dump($r);
} else {
    var_dump($response);
}
