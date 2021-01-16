<?php
// @codingStandardsIgnoreFile
require_once __DIR__ . '/../../autoload.php';

use Xmly\Auth;
use Xmly\Util;

$appKey = '99b37417e1185eda1378600593b45c40';
$appSecret = 'dd7a46b12fe8a304ef17892c89ede22a';
$deviceID = '32cc6f279c7a11e9a26e0235d2b38928';
$testAuth = new Auth($appKey, $appSecret, $deviceID);

$serverAuthStaticKey = 'XEbin4wC';

$dummyappKey = '7605b87e5d32547b3635831f49e6f6fd';
$dummyappSecret = 'ebb13babf5ca49fd4266bad491874338';
$dummydeviceID = '32cc6f279c7a11e9a26e0235d2b38928';
$dummyAuth = new Auth($dummyappKey, $dummyappSecret, $dummydeviceID);

function testCommonParams(array $body = array())
{
    $body['app_key'] = '99b37417e1185eda1378600593b45c40';
    $body['client_os_type'] = 4;
    $body['nonce'] = Util::randomString();
    $body['timestamp'] = Util::msecTime();
    $body['device_id'] = '99b37417e1185eda1378600593b45c40';
    $body['server_api_version'] = '1.0.0';
    return $body;
}