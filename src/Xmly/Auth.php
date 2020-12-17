<?php

namespace Xmly;

final class Auth
{
    private $appKey;
    private $appSecret;

    public function __construct($appKey, $appSecret)
    {
        $this->appKey = $appKey;
        $this->appSecret = $appSecret;
    }

    public function getAppKey()
    {
        return $this->appKey;
    }

    private function createSig($data)
    {
        ksort($data);
        $parme = "";
        foreach ($data as $k => $v) {
            $parme .= "$k=$v&";
        }
        $parme = trim($parme, '&');
        $str = base64_encode($parme);
        $hashKey = $this->appKey;
        $sigStr = md5(hash_hmac('sha1', $str, $hashKey, true));
        return $sigStr;
    }

    public function getAccessToken()
    {
        return array('Authorization' => 'secret');
    }

    public function refreshAccessToken()
    {
    }

    public function getAccessTokenInfo()
    {
    }
}