<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Auth;

$appKey = 'xxxx';
$appSecret = 'xxxx';
$auth = new Auth($appKey, $appSecret);

$device_id = '2dfde78d-0169-47e2-982c-734930951d55';
$code = '48a5fb88b24f4852df74dd2a1a96e2fe';
$grant_type = 'authorization_code';
$redirect_uri = 'https://xxxx.xxxx.com/oauth2/get_access_token';
$state = 'abc';


list($ret, $err) = $auth->getAccessToken($device_id, $code, $grant_type, $redirect_uri, $state);

if ($err !== null) {
    var_dump($err);
} else {
    var_dump($ret);
}