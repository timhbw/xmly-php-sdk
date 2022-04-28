<?php
require_once __DIR__ . '/../../autoload.php';

use Xmly\Http\Client;
use Xmly\Util;

// 内容-免费点播内容-小雅语义理解文本搜索：https://open.ximalaya.com/doc/detailApi?categoryId=10&articleId=6#%E5%96%9C%E9%A9%AC%E6%8B%89%E9%9B%85%E8%AF%AD%E4%B9%89%E7%90%86%E8%A7%A3%E8%83%BD%E5%8A%9BAPI

$api = 'https://mpay.ximalaya.com/xy_skill/text_search';

//1、拿到除了sig以外的所有请求参数的原始值
$params = array();
$params['app_key'] = 'xxxxxx';
$params['client_os_type'] = 2;
$params['nonce'] = Util::randomString();
$params['timestamp'] = Util::msecTime();
$params['server_api_version'] = '1.0.0';
$params['device_id'] = '2dfde78d016947e2982c734930951d55';

$params['text'] = "xmly"; // 搜索文本
$params['c_id'] = "xxx"; // 合作方产品渠道号标记，需要向喜马拉雅技术支持申请
$params['limit'] = 5; // 单次请求数据量，范围为(0, 10]，默认为5
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
