<?php

namespace Xmly\Tests;

use PHPUnit\Framework\TestCase;
use Xmly\API\AodManager;
use Xmly\Config;
use Xmly\Util;

class AodManagerTest extends TestCase
{

    protected $aodManager;
    protected $serverAuthStaticKey;

    protected function setUp(): void
    {
        global $serverAuthStaticKey;
        $this->serverAuthStaticKey = $serverAuthStaticKey;

        global $testAuth;
        $this->aodManager = new AodManager($testAuth);

        global $dummyAuth;
        $config = new Config();
        $config->useHTTPS = true;
        $config->enableLogs = true;
        $this->dummyaodManager = new AodManager($dummyAuth, $config);
    }

    public function testGetCategoriesList()
    {
        list($ret, $error) = $this->aodManager->getCategoriesList(testCommonParams(), $this->serverAuthStaticKey);
        $this->assertNotNull($ret);
        $this->assertNull($error);

        list($ret, $error) = $this->dummyaodManager->getCategoriesList(testCommonParams(), $this->serverAuthStaticKey);
        $this->assertNull($ret);
        $this->assertNotNull($error);
    }

    public function testGetAnnouncersCategories()
    {
        list($ret, $error) = $this->aodManager->getAnnouncersCategories(testCommonParams(), $this->serverAuthStaticKey);
        $this->assertNotNull($ret);
        $this->assertNull($error);
    }

    public function testGetTagsList()
    {
        $param['category_id'] = 30;
        $param['type'] = 0;
        $body = testCommonParams($param);
        list($ret, $error) = $this->aodManager->getTagsList($body, $this->serverAuthStaticKey);
        $this->assertNotNull($ret);
        $this->assertNull($error);
    }

    public function testGetAlbumsList()
    {
        $param['category_id'] = 30;
        $param['calc_dimension'] = 1;
        $body = testCommonParams($param);
        list($ret, $error) = $this->aodManager->getAlbumsList($body, $this->serverAuthStaticKey);
        $this->assertNotNull($ret);
        $this->assertNull($error);
    }
}
