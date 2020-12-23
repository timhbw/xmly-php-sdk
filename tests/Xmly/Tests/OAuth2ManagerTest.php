<?php

namespace Xmly\Tests;

use Xmly\API\AodManager;
use Xmly\Config;
use Xmly\OAuth2\OAuth2Manager;
use PHPUnit\Framework\TestCase;

class OAuth2ManagerTest extends TestCase
{
    protected $oauth2Manager;
    protected $dummyOauth2Manager;

    protected function setUp(): void
    {
        global $testAuth;
        $config = new Config();
        $config->useHTTPS = true;
        $config->enableLogs = true;
        $this->oauth2Manager = new OAuth2Manager($testAuth,$config);

        global $dummyAuth;
        $this->dummyOauth2Manager = new OAuth2Manager($dummyAuth);
    }

    public function testGetAccessToken()
    {
        list($ret, $err) = $this->oauth2Manager->getAccessToken('123', 'test.com', 'test');
        $this->assertNull($ret);
        $this->assertNotNull($err);

        list($ret, $err) = $this->dummyOauth2Manager->getAccessToken('123', 'test.com', 'test');
        $this->assertNull($ret);
        $this->assertNotNull($err);
    }

    public function testGetAccessTokenInfo()
    {
        list($ret, $err) = $this->oauth2Manager->getAccessTokenInfo('token');
        $this->assertNull($ret);
        $this->assertNotNull($err);
    }

    public function testRefreshAccessToken()
    {
        list($ret, $err) = $this->oauth2Manager->refreshAccessToken('token', 'test.com');
        $this->assertNull($ret);
        $this->assertNotNull($err);
    }
}
