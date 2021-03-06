<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Http\Client;
use Xmly\Util;

// https://open.ximalaya.com/doc/detailApi?categoryId=6&articleId=69#%E9%80%9A%E7%94%A8%E7%AD%BE%E5%90%8D%E7%94%9F%E6%88%90%E7%AE%97%E6%B3%95

$api = 'http://api.ximalaya.com/categories/list';

//1、拿到除了sig以外的所有请求参数的原始值
$params = array();
$params['app_key'] = 'xxxxxx';
$params['client_os_type'] = 4;
$params['nonce'] = Util::randomString();
$params['timestamp'] = Util::msecTime();
$params['server_api_version'] = '1.0.0';
$params['device_id'] = '2dfde78d016947e2982c734930951d55';

$params['album_id'] = 6922889; // 专辑ID
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
