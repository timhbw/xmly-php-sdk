<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Http\Client;

$url = "https://api.ximalaya.com/oauth2/revoke_refresh_token";

$req['client_id'] = 'xxxx';
$req['client_secret'] = 'xxxx';
$req['device_id'] = 'xxxx';
$req['redirect_uri'] = 'https://xx.xxxx.com/oauth2/get_access_token';
$req['refresh_token'] = 'xxxxxx';
$body = http_build_query($req);

$headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
$response = Client::post($url, $body, $headers);

if ($response->ok()) {
    $r = $response->json();
    var_dump($r);
} else {
    var_dump($response);
}
