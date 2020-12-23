<?php

namespace Xmly\Tests;

use Xmly\Http\Client;
use PHPUnit\Framework\TestCase;

class ClientTest extends TestCase
{

    public function testGet()
    {
        $response = Client::get('https://www.ximalaya.com');
        $this->assertEquals($response->statusCode, 200);
        $this->assertNotNull($response->body);
        $this->assertNull($response->error);

        $errResponse = Client::get('http://httpbin.org/status/500');
        if ($errResponse->needRetry()) {
            $response =  Client::get('https://www.ximalaya.com');
            $response->needRetry();
        }
        $this->assertNotNull($errResponse->error);
    }

    public function testPost()
    {
        $headers['Content-Type'] = 'application/json';
        $response = Client::post('https://qiniu.timhbw.com/notify/callback', '{"name":xmlyCI}', $headers);
        if ($response->ok()) {
            $r = $response->json();
        }
        $this->assertEquals($response->statusCode, 200);
        $this->assertNotNull($r);
        $this->assertNull($response->error);

        $errResponse = Client::post('https://api.ximalaya.com/oauth2/refresh_token', null);
        $this->assertEquals($errResponse->statusCode, 400);
        $this->assertNotNull($errResponse->error);
    }
}
