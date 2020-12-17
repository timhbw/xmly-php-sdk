<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Auth;
use Xmly\Http\Client;

$appKey = 'xxxx';
$appSecret = 'xxxx';
$auth = new Auth($appKey, $appSecret);

$name = 'app';
$color = 'red';

$url = 'https://qiniu.timhbw.com/notify/callback';

$req = array();
$req['name'] = $name;
$req['color'] = $color;
$body = json_encode($req);

$contentType = "application/json";

$headers = $auth->getAccessToken();

$headers['Content-Type'] = $contentType;
$response = Client::post($url, $body, $headers);

if ($response->ok()) {
    $r = $response->json();
    var_dump($r);
} else {
    var_dump($response);
}
