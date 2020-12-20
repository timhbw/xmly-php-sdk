<?php

namespace Xmly\API;

use Xmly\Auth;
use Xmly\Config;
use Xmly\Http\Client;
use Xmly\Http\Error;
use Xmly\Util;

final class AodManager
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
     * 点播-免费内容-获取分类列表
     *
     * @param array $body
     * @param null $serverAuthStaticKey
     * @return array
     *
     * @link https://open.ximalaya.com/doc/detailApi?categoryId=10&articleId=6#%E5%88%86%E7%B1%BB%E5%88%97%E8%A1%A8
     */
    public function getCategoriesList($body, $serverAuthStaticKey = null)
    {
        $scheme = "http://";
        if ($this->config->useHTTPS === true) {
            $scheme = "https://";
        }
        $sigURL = $this->auth->signatureURL($body, $serverAuthStaticKey);
        $url = $scheme . Config::API_HOST . '/categories/list?' . $sigURL;
        return $this->get($url);
    }

    /**
     * 点播-主播-获取主播分类列表
     *
     * @param array $body
     * @param null $serverAuthStaticKey
     * @return array
     *
     * @link https://open.ximalaya.com/doc/detailApi?categoryId=10&articleId=61#%E8%8E%B7%E5%8F%96%E4%B8%BB%E6%92%AD%E5%88%86%E7%B1%BB%E5%88%97%E8%A1%A8
     */
    public function getAnnouncersCategories($body, $serverAuthStaticKey = null)
    {
        $scheme = "http://";
        if ($this->config->useHTTPS === true) {
            $scheme = "https://";
        }

        $sigURL = $this->auth->signatureURL($body, $serverAuthStaticKey);
        $url = $scheme . Config::API_HOST . '/announcers/categories?' . $sigURL;
        return $this->get($url);
    }

    private function get($url)
    {
        $headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
        $ret = Client::get($url, $headers);
        if (!$ret->ok()) {
            Util::writeErrLog($url, $ret->body, $ret->statusCode, $ret->duration, $ret->error);
            return array(null, new Error($url, $ret));
        }
        if ($this->config->enableLogs === true) {
            Util::writeInfoLog($url, $ret->body, $ret->statusCode, $ret->duration);
        }
        return array($ret->json(), null);
    }

}