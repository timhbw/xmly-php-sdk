<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Auth;
use Xmly\Http\Client;

$appKey = 'xxxx';
$appSecret = 'xxxx';
$auth = new Auth($appKey, $appSecret);
