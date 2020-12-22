<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Http\Client;
use Xmly\Util;

$api = "http://api.ximalaya.com/categories/list";

//1、拿到除了sig以外的所有请求参数的原始值
$urlParam['app_key'] = '99b37417e1185eda1378600593b45c40';
$urlParam['client_os_type'] = 4;
$urlParam['nonce'] = Util::randomString();
$urlParam['timestamp'] = Util::msecTime();
$urlParam['device_id'] = '2dfde78d016947e2982c734930951d55';
$urlParam['server_api_version'] = '1.0.0';

//2、将【排序后】的参数键值对用&拼接
ksort($urlParam, SORT_STRING);
$sortURL = http_build_query($urlParam);

//3、步骤2得到的字符串进行Base64编码
$base64EncodedStr = base64_encode($sortURL);

//4、准备下一步需要的HMAC-SHA1哈希key
$hashKey = 'dd7a46b12fe8a304ef17892c89ede22aXEbin4wC';

//5、使用sha1Key对base64EncodedStr进行HMAC-SHA1哈希得到字节数组
$sigStr = md5(hash_hmac('sha1', $base64EncodedStr, $hashKey, true));

//6、拼接完整请求 URL
$requestUrl = $api . '?' . $sortURL . '&sig=' . $sigStr;

//7、发起 Get 请求
$headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
$response = Client::get($requestUrl, $headers);

var_dump($response);
