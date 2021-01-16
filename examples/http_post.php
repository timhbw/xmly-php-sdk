<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Http\Client;

$url = 'https://qiniu.timhbw.com/notify/callback';

$req['name'] = 'app';
$req['color'] = 'red';
$body = json_encode($req);

$contentType = "application/json";

$headers['Content-Type'] = $contentType;
$response = Client::post($url, $body, $headers);

if ($response->ok()) {
    $r = $response->json();
    var_dump($r);
} else {
    var_dump($response);
}
