<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Auth;
use Xmly\Http\Client;

$appKey = 'xxxxxx';
$appSecret = 'xxxxxx';
$deviceID = '32cc6f279c7a11e9a26e0235d2b38928';
$serverAuthStaticKey = 'xxxxxx';

$auth = new Auth($appKey, $appSecret, $deviceID);

$url = "https://api.ximalaya.com/marketing/query_activities";

$body['app_key'] = '99b37417e1185eda1378600593b45c40';
$body['activity_type'] = '1';
$body = $auth->commonParams($body);

$sigURl = $url . '?' . $auth->signatureURL($body, $serverAuthStaticKey);

$headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
$response = Client::get($sigURl, $headers);

if ($response->ok()) {
    $r = $response->json();
    var_dump($r);
} else {
    var_dump($response);
}
