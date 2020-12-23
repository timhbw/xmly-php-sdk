<?php
require_once __DIR__ . '/../autoload.php';


//https://openact.ximalaya.com/web-jssdk/doc/#/content/prepare/not-login-auth/get-signature

//1、拿到除了喜马请求的 url
$xmlyURL = 'client_id=b617866c20482d133d5de66fceb37da3
&device_id=0a3751e0-903e-495d-8230-827e41ff7990
&nonce=sbby2hyM9M&timestamp=1566285175413&params=%7B%22
client_id%22%3A%22b617866c20482d133d5de66fceb37da3%22%2C%22
device_id%22%3A%220a3751e0-903e-495d-8230-827e41ff7990%22%2C%22
nonce%22%3A%22sbby2hyM9M%22%2C%22timestamp%22%3A1566285175413%2C%22grant_type%22%3A%22js_client_credentials%22%7D';

//2、解析出其中 params 参数的值
$params = '%7B%22client_id%22%3A%22b617866c20482d133d5de66fceb37da3%22%2C%22
device_id%22%3A%220a3751e0-903e-495d-8230-827e41ff7990%22%2C%22
nonce%22%3A%22sbby2hyM9M%22%2C%22timestamp%22%3A1566285175413%2C%22grant_type%22%3A%22js_client_credentials%22%7D';

//3、对 params 进行 urldecode 解析下
$urlParam = urldecode($params);

//4、将参数进行【排序】并生成 URL-encode 之后的请求字符串
$params_arr = json_decode($urlParam, true);

ksort($params_arr, SORT_STRING);
$sortURL = http_build_query($params_arr);

//5、步骤2得到的字符串进行Base64编码
$base64EncodedStr = base64_encode($sortURL);

//4、准备下一步需要的HMAC-SHA1哈希key
$hashKey = 'dd7a46b12fe8a304ef17892c89ede22a' . 'XEbin4wC';

//5、使用sha1Key对base64EncodedStr进行HMAC-SHA1哈希得到字节数组
$signature = md5(hash_hmac('sha1', $base64EncodedStr, $hashKey, true));

//6、返回 js sdk 要求的 json 格式
$response = array(
    'code' => 0,
    'message' => "success",
    'signature' => $signature
);

var_dump($response);
