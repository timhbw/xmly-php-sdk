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
        $this->oauth2Manager = new OAuth2Manager($testAuth, $config);

        global $dummyAuth;
        $this->dummyOauth2Manager = new OAuth2Manager($dummyAuth);
    }

    public function testGetAccessToken()
    {
        list($ret, $err) = $this->oauth2Manager->getAccessToken('123', 'test.com', 'test');
        $this->assertNull($ret);
        $this->assertNotNull($err);
        $this->assertNotNull($err->message());

        list($ret, $err) = $this->dummyOauth2Manager->getAccessToken('123', 'test.com', 'test');
        $this->assertNull($ret);
        $this->assertNotNull($err);
    }

    public function testGetAccessTokenInfo()
    {
        list($ret, $err) = $this->oauth2Manager->getAccessTokenInfo('token');
        $this->assertNull($ret);
        $this->assertNotNull($err);

//        list($ret01, $err01) = $this->oauth2Manager->getAccessTokenInfo('31547ae169e19c369a2a67419fbc977d');
//        $this->assertNotNull($ret01);
//        $this->assertNull($err01);
    }

    public function testRefreshAccessToken()
    {
        list($ret, $err) = $this->oauth2Manager->refreshAccessToken('token', 'test.com');
        $this->assertNull($ret);
        $this->assertNotNull($err);

        list($ret01, $err01) = $this->dummyOauth2Manager->refreshAccessToken(
            '1f88f43c80ca089b52f24327b15a1fe0',
            'https://xmly.timhbw.com/oauth2/get_access_token'
        );
        $this->assertNotNull($ret01);
        $this->assertNull($err01);
    }

    public function testRevokeAccessToken()
    {
        list($ret, $err) = $this->dummyOauth2Manager->revokeAccessToken(
            'https://xmly.timhbw.com/oauth2/get_access_token',
            'be5575cd78e92d862182cbb8eae1ad9b'
        );
        $this->assertNotNull($ret);
        $this->assertNull($err);
        var_dump($err);
    }

    public function testRevokeRefreshToken()
    {
        list($ret, $err) = $this->dummyOauth2Manager->revokeRefreshToken(
            'https://xmly.timhbw.com/oauth2/get_access_token',
            '9b180eb27aa7ba19d33a3a106fb0270d'
        );
        $this->assertNotNull($ret);
        $this->assertNull($err);
    }
}
