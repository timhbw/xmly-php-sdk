<?php
require_once __DIR__ . '/../../autoload.php';

use Xmly\Http\Client;
use Xmly\Util;

// 支付-订单-获取所有订单记录：https://open.ximalaya.com/doc/detailApi?categoryId=15&articleId=31#%E8%8E%B7%E5%8F%96%E6%89%80%E6%9C%89%E8%AE%A2%E5%8D%95%E8%AE%B0%E5%BD%95

$api = 'https://mpay.ximalaya.com/open_pay/get_order_records';

//1、拿到除了sig以外的所有请求参数的原始值
$params = array();
$params['app_key'] = 'xxxxxx';
$params['client_os_type'] = 2;
$params['nonce'] = Util::randomString();
$params['timestamp'] = Util::msecTime();
$params['server_api_version'] = '1.0.0';
$params['device_id'] = '2dfde78d016947e2982c734930951d66';

$params['third_uid'] = 111111111; // 合作方第三方账号唯一标识
$data = http_build_query($params);

//2、将参数进行【排序】并生成 URL-encode 之后的请求字符串
ksort($params, SORT_STRING);
$sortURL = urldecode(http_build_query($params));

//3、步骤2得到的字符串进行Base64编码
$base64EncodedStr = base64_encode($sortURL);

//4、准备下一步需要的HMAC-SHA1哈希key
$hashKey = 'xxxxxx'.'xxxxxx';

//5、使用sha1Key对base64EncodedStr进行HMAC-SHA1哈希得到字节数组
$sigStr = md5(hash_hmac('sha1', $base64EncodedStr, $hashKey, true));

//6、拼接完整请求 URL
$requestUrl = $api . '?' . $data . '&sig=' . $sigStr;

//7、发起 Get 请求
$headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
$response = Client::get($requestUrl, $headers);

var_dump($response);
