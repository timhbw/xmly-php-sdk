<?php
require_once __DIR__ . '/../autoload.php';

use Xmly\Auth;
use Xmly\Http\Client;
use Xmly\Util;

$api = "http://api.ximalaya.com/categories/list";
$timestamp = Util::msecTime();

//1、拿到除了sig以外的所有请求参数的原始值
//app_key client_os_type nonce timestamp
//device_id server_api_version
$urlParam = 'app_key=99b37417e1185eda1378600593b45c40&client_os_type=4&nonce=vptPDUOTs1s&timestamp=1608391178340&device_id=2dfde78d016947e2982c734930951d55&server_api_version=1.0.0';

//2、将排序后的参数键值对用&拼接
$sortURL = 'app_key=99b37417e1185eda1378600593b45c40&client_os_type=4&device_id=2dfde78d016947e2982c734930951d55&nonce=VtNJbmySs11&server_api_version=1.0.0&timestamp=' . $timestamp;
var_dump($sortURL);

//3、步骤2得到的字符串进行Base64编码
$base64EncodedStr = base64_encode($sortURL);

//4、准备下一步需要的HMAC-SHA1哈希key
$hashKey = '4d8e605fa7ed546c4bcb33dee1381179z0hh5l9A';

//5、使用sha1Key对base64EncodedStr进行HMAC-SHA1哈希得到字节数组
$sigStr = md5(hash_hmac('sha1', $base64EncodedStr, $hashKey, true));

//6、拼接完整请求 URL
$requestUrl = $api . '?' . $sortURL . '&sig=' . $sigStr;

//$params_arr = json_decode($urlParam, true);
////var_dump($params_arr);
//
//ksort($params_arr);
//$parme = "";
//foreach ($params_arr as $k => $v) {
//    $parme .= "$k=$v&";
//    echo "11111111";
//}
//
//$parme = trim($parme, '&');
//$str = base64_encode($parme);
//$hashKey = 'dd7a46b12fe8a304ef17892c89ede22a';
//$sigStr = md5(hash_hmac('sha1', $str, $hashKey, true));

//$requestUrl = $api . '?' . $urlParam . '&sig=' . $sigStr;
$headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
$response = Client::get($requestUrl, $headers);
var_dump($requestUrl);
var_dump($response);


//function generateSign($attributes, $key, $encrypMethod = 'md5')
//{
//    ksort($attributes, SORT_STRING);
//    $data = base64_encode(urldecode(http_build_query($attributes)));
//    $hash = hash_hmac("sha1", $data, $key, true);
//
//    return call_user_func_array($encrypMethod, [$hash]);
//}

//function CommonParams(array $param = array())
//{
//    // 公共参数
//    $param['app_key'] = 'b617866c20482d133d5de66fceb37da3';
//    $param['client_os_type'] = 4;
//    $param['nonce'] = Util::randomString();
//    $param['timestamp'] = Util::msecTime();
//    $param['device_id'] = '2dfde78d016947e2982c734930951d55';
//    $param['server_api_version'] = '1.0.0';
//    $param['sig'] = '222';
//
//    return http_build_query($param);
//}

