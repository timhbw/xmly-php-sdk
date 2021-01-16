<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Http\Client;

$url = "https://xxxx.xxxx.com/token/getUpToken";
$contentType = "application/json";

$headers['Content-Type'] = $contentType;
$response = Client::get($url, $headers);

if ($response->ok()) {
    $r = $response->json();
    var_dump($r);
} else {
    var_dump($response);
}
