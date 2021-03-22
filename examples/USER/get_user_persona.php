<?php
require_once __DIR__ . '/../../autoload.php';

use Xmly\Http\Client;

// 用户数据-用户基本信息-获取用户画像数据：https://open.ximalaya.com/doc/detailApi?categoryId=13&articleId=29#%E8%8E%B7%E5%8F%96%E7%94%A8%E6%88%B7%E7%94%BB%E5%83%8F%E6%95%B0%E6%8D%AE

$api = 'https://api.ximalaya.com/profile/persona';

//1、拿到除了sig以外的所有请求参数的原始值
$params = array();
$params['app_key'] = 'xxxxxx';
$params['client_os_type'] = 3;
$params['access_token'] = 'xxxxxx';
$params['device_id'] = '2dfde78d016947e2982c734930951d55';

$data = http_build_query($params);

//2、将参数进行【排序】并生成 URL-encode 之后的请求字符串
ksort($params, SORT_STRING);
$sortURL = urldecode(http_build_query($params));

//3、步骤2得到的字符串进行Base64编码
$base64EncodedStr = base64_encode($sortURL);

//4、准备下一步需要的HMAC-SHA1哈希key
$hashKey = 'xxxxxx';

//5、使用sha1Key对base64EncodedStr进行HMAC-SHA1哈希得到字节数组
$sigStr = md5(hash_hmac('sha1', $base64EncodedStr, $hashKey, true));

//6、拼接完整请求 URL
$requestUrl = $api . '?' . $data . '&sig=' . $sigStr;

//7、发起 Get 请求
$headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
$response = Client::get($requestUrl, $headers);

var_dump($response);
