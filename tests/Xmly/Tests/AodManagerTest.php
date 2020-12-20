<?php

namespace Xmly\Tests;

use PHPUnit\Framework\TestCase;
use Xmly\API\AodManager;
use Xmly\Config;

class AodManagerTest extends TestCase
{

    protected $aodManager;
    protected $CommonBody;
    protected $serverAuthStaticKey;

    protected function setUp(): void
    {
        global $CommonBody;
        $this->CommonBody = $CommonBody;

        global $serverAuthStaticKey;
        $this->serverAuthStaticKey = $serverAuthStaticKey;

        global $testAuth;
        $config = new Config();
        $this->aodManager = new AodManager($testAuth, $config);
    }

    public function testGetCategoriesList()
    {
        list($ret, $error) = $this->aodManager->getCategoriesList($this->CommonBody, $this->serverAuthStaticKey);
        $this->assertNotNull($ret);
        $this->assertNull($error);
    }
}
