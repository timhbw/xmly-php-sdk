<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Auth;
use Xmly\Http\Client;

$appKey = '99b37417e1185eda1378600593b45c40';
$appSecret = 'dd7a46b12fe8a304ef17892c89ede22a';
$deviceID = '32cc6f279c7a11e9a26e0235d2b38928';

$auth = new Auth($appKey, $appSecret, $deviceID);

$url = 'https://api.ximalaya.com/oauth2/v2/access_token';

//$req = array(
//    'client_id' => $appKey,
//    'client_secret' => $appSecret,
//    'device_id' => 'xxxx',
//    'code' => 'xxxx',
//    'device_id' => '2dfde78d016947e2982c734930951d55',
//    'grant_type' => 'authorization_code',
//    'redirect_uri' => 'https://xxxx.xxxx.com/oauth2/get_access_token',
//    'state' => 'xxxx',
//);

$req['client_id'] = $appKey;
$req['client_secret'] = $appSecret;
$req['device_id'] = $deviceID;
$req['code'] = 'xxx';
$req['grant_type'] = 'authorization_code';
$req['redirect_uri'] = 'https://xxxx.xxxx.com/oauth2/get_access_token';
$req['state'] = 'xxxx';
$body = http_build_query($req);

$headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
$response = Client::post($url, $body, $headers);
var_dump($body);
if ($response->ok()) {
    $r = $response->json();
    var_dump($r);
} else {
    var_dump($response);
}