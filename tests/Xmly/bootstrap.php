<?php
// @codingStandardsIgnoreFile
require_once __DIR__ . '/../../autoload.php';

use Xmly\Auth;
use Xmly\Util;

$appKey = getenv('XMLY_APP_KEY');
$appSecret = getenv('XMLY_APP_SECRET');
$deviceID = getenv('XMLY_DEVICE_ID');
$serverAuthStaticKey = 'XEbin4wC';

$testAuth = new Auth($appKey, $appSecret, $deviceID);

$dummyappKey = '1234567890';
$dummyappSecret = '1234567890';
$dummydeviceID = '1234567890';
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