<?php
require_once __DIR__ . '/../../autoload.php';

use Xmly\Http\Client;
use Xmly\Util;

// 支付-订单-分销：https://open.ximalaya.com/doc/detailApi?categoryId=15&articleId=31#%E5%88%86%E9%94%80%E6%8E%A5%E5%8F%A3

$url = 'https://mpay.ximalaya.com/omp-payment-open-api/distribute';

//1、拿到除了sig以外的所有请求参数的原始值
$params = array();
$params['app_key'] = 'xxxxxx';
$params['client_os_type'] = 1;
$params['nonce'] = Util::randomString();
$params['timestamp'] = Util::msecTime();
$params['server_api_version'] = '1.0.0';
$params['device_id'] = '2dfde78d016947e2982c734930951d55';

$params['distribute_item_type'] = 3;
$params['pay_content'] = 'xxxxxx';

// 接入账户类型:1.access_token接入，2.第三方账户接入，3.手机号接入，4.喜马uid接入

//4.喜马uid接入
$params['access_account_type'] = 4;
$params['uid'] = 111111111;

//3.手机号接入
//$params['access_account_type'] = 3;
//$params['mobile'] = xxxxxxxxxxx;

$params['pay_channel'] = 0;
$params['third_order_no'] = 'xxxxxxxxxx';
$params['device_ip'] = '192.168.1.1';
$params['device_user_agent'] = 'iOS';
$body = http_build_query($params);

//2、将参数进行【排序】并生成 URL-encode 之后的请求字符串
ksort($params, SORT_STRING);
$sortURL = urldecode(http_build_query($params));

//3、步骤2得到的字符串进行Base64编码
$base64EncodedStr = base64_encode($sortURL);

//4、准备下一步需要的HMAC-SHA1哈希key
$hashKey = 'xxxxxx' . 'xxxxxx';

//5、使用sha1Key对base64EncodedStr进行HMAC-SHA1哈希得到字节数组
$sigStr = md5(hash_hmac('sha1', $base64EncodedStr, $hashKey, true));

//6、拼接完整的请求 Body 内容
$sigBody = $body . '&sig=' . $sigStr;

//7、发起 Post 请求
$headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
$response = Client::post($url, $sigBody, $headers);

var_dump($response);
