<?php

namespace Xmly\Tests;

use Xmly\Auth;
use PHPUnit\Framework\TestCase;

class AuthTest extends TestCase
{
    protected $appKey;
    protected $appSecret;
    protected $deviceID;

    protected function setUp(): void
    {
        global $appKey;
        $this->appKey = $appKey;

        global $appSecret;
        $this->appSecret = $appSecret;

        global $deviceID;
        $this->deviceID = $deviceID;
    }

    public function testGetAppKey()
    {
        $testAuth = new Auth($this->appKey, $this->appSecret, $this->deviceID);
        $appKey = $testAuth->getAppKey();
        $this->assertEquals('99b37417e1185eda1378600593b45c40', $appKey);
    }
}
