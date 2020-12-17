<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Auth;
use Xmly\Http\Client;

$appKey = 'xxxx';
$appSecret = 'xxxx';
$auth = new Auth($appKey, $appSecret);

$url = "https://api-qiniu.timhbw.com/token/getUpToken";
$contentType = "application/json";

$headers = $auth->getAccessToken();

$headers['Content-Type'] = $contentType;
$response = Client::get($url, $headers);

if ($response->ok()) {
    $r = $response->json();
    var_dump($r);
} else {
    var_dump($response);
}
