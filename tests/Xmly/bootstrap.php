<?php
// @codingStandardsIgnoreFile
require_once __DIR__ . '/../../autoload.php';

use Xmly\Auth;

$appKey = getenv('XMLY_APP_KEY');
$appSecret = getenv('XMLY_APP_SECRET');
$deviceID = getenv('XMLY_DEVICE_ID');

$testAuth = new Auth($appKey, $appSecret, $deviceID);

$dummyappKey = '1234567890';
$dummyappSecret = '1234567890';
$dummydeviceID = '1234567890';
$dummyAuth = new Auth($dummyappKey, $dummyappSecret, $dummydeviceID);

$serverAuthStaticKey = 'XEbin4wC';
$CommonBody = $testAuth->commonParams();