<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Auth;
use Xmly\Http\Client;

$appKey = 'xxxx';
$appSecret = 'xxxx';
$auth = new Auth($appKey, $appSecret);

$url = 'https://api.ximalaya.com/oauth2/v2/access_token';

$req = array();
$req['client_id'] = $appKey;
$req['client_secret'] = $appSecret;
$req['device_id'] = 'xxxx';
$req['code'] = 'xxx';
$req['grant_type'] = 'authorization_code';
$req['redirect_uri'] = 'https://xxxx.xxxx.com/oauth2/get_access_token';
$req['state'] = 'xxxx';
$body = http_build_query($req);

$contentType = "application/x-www-form-urlencoded; charset=UTF-8";

//$headers = $auth->getAccessToken();

$headers['Content-Type'] = $contentType;
$response = Client::post($url, $body, $headers);
var_dump($body);
if ($response->ok()) {
    $r = $response->json();
    var_dump($r);
} else {
    var_dump($response);
}