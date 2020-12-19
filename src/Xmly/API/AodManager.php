<?php

namespace Xmly\API;

use Xmly\Auth;
use Xmly\Config;
use Xmly\Http\Client;
use Xmly\Http\Error;

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

    public function getCategoriesList($body, $serverAuthStaticKey = null)
    {
        $scheme = "http://";
        if ($this->config->useHTTPS === true) {
            $scheme = "https://";
        }

        $data = http_build_query($body);
        $sigURL = $this->auth->signatureURL($data, $serverAuthStaticKey);
        $url = $scheme . Config::API_HOST . '/categories/list?' . $sigURL;
        return $this->get($url);
    }

    private function get($url)
    {
        $headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
        $ret = Client::get($url, $headers);
        if (!$ret->ok()) {
            return array(null, new Error($url, $ret));
        }
        return array($ret->json(), null);
    }

}