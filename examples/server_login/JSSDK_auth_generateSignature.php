<?php
require_once __DIR__ . '/../../autoload.php';


// https://openact.ximalaya.com/web-jssdk/doc/#/content/prepare/not-login-auth/get-signature

// 1、接收喜马拉雅 js sdk 发过来的请求，解析其中的请求的 params 参数的值
$params = $_POST["params"];
//{"client_id":"b617866c20482d133d5de66fceb37da3","device_id":"0a3751e0-903e-495d-8230-827e41ff7990","nonce":"sbby2hyM9M","timestamp":1566285175413,"grant_type":"js_client_credentials"}

// 2、对 params 进行 urldecode 解析下
$urlParam = urldecode($params);

// 3、将参数进行【排序】并生成 URL-encode 之后的请求字符串
$params_arr = json_decode($urlParam, true);

ksort($params_arr, SORT_STRING);
$sortURL = http_build_query($params_arr);

// 4、步骤2得到的字符串进行Base64编码
$base64EncodedStr = base64_encode($sortURL);

// 5、准备下一步需要的HMAC-SHA1哈希key，注意：不需要 serverAuthStaticKey
$hashKey = 'dd7a46b12fe8a304ef17892c89ede22a';

// 6、使用sha1Key对base64EncodedStr进行HMAC-SHA1哈希得到字节数组
$signature = md5(hash_hmac('sha1', $base64EncodedStr, $hashKey, true));

// 7、组合成符合 js sdk 要求的参数
$response = array(
    'code' => 0,
    'message' => "success",
    'signature' => $signature
);

// 8、返回 js sdk 要求的 json 格式
echo json_encode($response);
