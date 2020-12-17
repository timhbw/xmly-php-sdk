<?php

namespace Xmly;

//use Xmly\Config;
use Xmly\Http\Client;
use Xmly\Http\Error;

final class Auth
{
    private $appKey;
    private $appSecret;

//    private $config;

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

    public function getAccessToken($device_id, $code, $redirect_uri, $state, $grant_type = 'authorization_code')
    {
        $params = array('client_id' => $this->appKey, 'client_secret' => $this->appSecret, 'device_id' => $device_id, 'code' => $code, 'redirect_uri' => $redirect_uri, 'state' => $state, 'grant_type' => $grant_type);
        $data = http_build_query($params);

        $scheme = "http://";
//        if ($this->config->useHTTPS === true) {
//            $scheme = "https://";
//        }
        $url = $scheme . Config::API_HOST . '/oauth2/v2/access_token';

        $headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
        $response = Client::post($url, $data, $headers);

        if (!$response->ok()) {
            return array(null, new Error($url, $response));
        }
        return array($response->json(), null);
    }

    public function refreshAccessToken()
    {
    }

    public function getAccessTokenInfo()
    {
    }
}