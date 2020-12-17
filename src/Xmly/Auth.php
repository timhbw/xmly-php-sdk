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
}