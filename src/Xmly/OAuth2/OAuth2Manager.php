<?php

namespace Xmly\OAuth2;

use Xmly\Auth;
use Xmly\Config;
use Xmly\Http\Client;
use Xmly\Http\Error;

final class OAuth2Manager
{
    private $auth;
    private $config;

    public function __construct(Auth $auth, Config $config = null)
    {
        $this->auth = $auth;
        if ($config == null) {
            $this->config = new Config();
        } else {
            $this->config = $config;
        }
    }

    /**
     * 获取访问令牌
     *
     * @param string $code
     * @param string $redirect_uri
     * @param string $state
     * @param string $grant_type
     * @return array
     *
     * @link https://open.ximalaya.com/doc/detailApi?categoryId=9&articleId=5#%E8%8E%B7%E5%8F%96%E8%AE%BF%E9%97%AE%E4%BB%A4%E7%89%8C
     */
    public function getAccessToken($code, $redirect_uri, $state, $grant_type = 'authorization_code')
    {
        $params = array(
            'client_id' => $this->auth->getAppKey(),
            'client_secret' => $this->auth->getAppSecret(),
            'device_id' => $this->auth->getdeviceID(),
            'code' => $code,
            'redirect_uri' => $redirect_uri,
            'state' => $state,
            'grant_type' => $grant_type
        );
        $data = http_build_query($params);

        $scheme = "http://";
        if ($this->config->useHTTPS === true) {
            $scheme = "https://";
        }
        $url = $scheme . Config::API_HOST . '/oauth2/v2/access_token';

        $headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
        $response = Client::post($url, $data, $headers);

        if (!$response->ok()) {
            return array(null, new Error($url, $response));
        }
        return array($response->json(), null);
    }

    /**
     * 刷新访问令牌
     *
     * @param string $refresh_token 刷新令牌参数，从 /oauth2/v2/access_token 返回
     * @param string $redirect_uri OAuth2回调地址，即创建应用时填写的回调地址。使用时请对它的值进行URL编码处理，并最好提供https地址
     * @param string $grant_type 授权模式，固定值"refresh_token"
     * @return array
     *
     * @link https://open.ximalaya.com/doc/detailApi?categoryId=9&articleId=5#%E5%88%B7%E6%96%B0%E8%AE%BF%E9%97%AE%E4%BB%A4%E7%89%8C
     */
    public function refreshAccessToken($refresh_token, $redirect_uri, $grant_type = 'refresh_token')
    {
        $params = array(
            'client_id' => $this->auth->getAppKey(),
            'client_secret' => $this->auth->getAppSecret(),
            'device_id' => $this->auth->getdeviceID(),
            'refresh_token' => $refresh_token,
            'redirect_uri' => $redirect_uri,
            'grant_type' => $grant_type
        );
        $data = http_build_query($params);

        $scheme = "http://";
        if ($this->config->useHTTPS === true) {
            $scheme = "https://";
        }
        $url = $scheme . Config::API_HOST . '/oauth2/refresh_token';

        $headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
        $response = Client::post($url, $data, $headers);

        if (!$response->ok()) {
            return array(null, new Error($url, $response));
        }
        return array($response->json(), null);
    }

    /**
     * 查询访问令牌
     *
     * @param string $access_token 访问令牌
     * @return array
     *
     * @link https://open.ximalaya.com/doc/detailApi?categoryId=9&articleId=5#%E6%9F%A5%E8%AF%A2%E8%AE%BF%E9%97%AE%E4%BB%A4%E7%89%8C
     */
    public function getAccessTokenInfo($access_token)
    {
        $params = array(
            'client_id' => $this->auth->getAppKey(),
            'client_secret' => $this->auth->getAppSecret(),
            'device_id' => $this->auth->getdeviceID(),
            'access_token' => $access_token
        );
        $data = http_build_query($params);

        $scheme = "http://";
        if ($this->config->useHTTPS === true) {
            $scheme = "https://";
        }
        $url = $scheme . Config::API_HOST . '/oauth2/get_token_info?' . $data;

        $headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
        $response = Client::get($url, $headers);

        if (!$response->ok()) {
            return array(null, new Error($url, $response));
        }
        return array($response->json(), null);
    }
}
