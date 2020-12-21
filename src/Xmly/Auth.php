<?php

namespace Xmly;

final class Auth
{
    private $appKey;
    private $appSecret;
    private $deviceID;

    public function __construct($appKey, $appSecret, $deviceID)
    {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
        $this->deviceID = $deviceID;
    }

    public function getAppKey()
    {
        return $this->appKey;
    }

    public function getAppSecret()
    {
        return $this->appSecret;
    }

    public function getdeviceID()
    {
        return $this->deviceID;
    }

    /**
     * 使用 hashKey 对 base64EncodedStr 进行HMAC-SHA1哈希得到字节数组
     * 并对上面得到的sha1ResultBytes进行MD5得到32位字符串，即为sig
     * @param string $data base64编码后的请求参数
     * @param string $hashKey HashKey
     * @return string
     */
    public function sign($data, $hashKey)
    {
        $hmac = hash_hmac('sha1', $data, $hashKey, true);
        return md5($hmac);
    }

    /**
     * 将除了sig以外的所有请求参数的原始值按照参数名的字典序排序，将排序后的参数键值对用&拼接
     * 并对得到的字符串进行Base64编码
     *
     * @param array $body 除sig以外的所有请求参数
     * @return string
     */
    public function signWithData($body)
    {
        $data = http_build_query($body);
        return base64_encode($data);
    }

    /**
     * 将除了sig以外的所有请求参数的原始值按照参数名的字典序排序，将排序后的参数键值对用&拼接
     * 并对得到的字符串进行Base64编码，如果传入
     *
     * @param array $body 除sig以外的所有请求参数
     * @param string $serverAuthenticateStaticKey 服务端密钥
     * @return string
     */
    public function signRequest($body, $serverAuthenticateStaticKey = null)
    {
        $base64EncodedStr = $this->signWithData($body);
        $hashKey = $this->getAppSecret() . $serverAuthenticateStaticKey;
        return $this->sign($base64EncodedStr, $hashKey);
    }

    /**
     * 通用签名生成
     *
     * @param array $body 除sig以外的所有请求参数
     * @param string $serverAuthenticateStaticKey 服务端密钥
     * @return string
     *
     * @link https://open.ximalaya.com/doc/detailApi?categoryId=6&articleId=69#%E9%80%9A%E7%94%A8%E7%AD%BE%E5%90%8D%E7%94%9F%E6%88%90%E7%AE%97%E6%B3%95
     */
    public function signature($body, $serverAuthenticateStaticKey = null)
    {
        return '&sig=' . $this->signRequest($body, $serverAuthenticateStaticKey);
    }

    /**
     * 拼接带 sig 参数完整的请求 URL
     *
     * @param array $body 除sig以外的所有请求参数
     * @param string $serverAuthenticateStaticKey 服务端密钥
     * @return string
     */
    public function signatureURL($body, $serverAuthenticateStaticKey = null)
    {
        ksort($body, SORT_STRING);
        $sig = $this->signature($body, $serverAuthenticateStaticKey);
        $requestURL = http_build_query($body);
        return $requestURL . $sig;
    }

    /**
     * 公共参数
     *
     * @param array $body 其他请求参数
     * @return array
     */
    public function commonParams(array $body = array())
    {
        $body['app_key'] = $this->getAppKey();
        $body['client_os_type'] = 4;
        $body['nonce'] = Util::randomString();
        $body['timestamp'] = Util::msecTime();
        $body['device_id'] = $this->getdeviceID();
        $body['server_api_version'] = '1.0.0';

        return $body;
    }
}
