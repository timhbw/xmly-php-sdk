<?php

namespace Xmly\Tests;

use PHPUnit\Framework\TestCase;
use Xmly\API\AodManager;
use Xmly\Config;

class AodManagerTest extends TestCase
{

    protected $aodManager;
    protected $dummyAodManager;
    protected $serverAuthStaticKey;

    protected function setUp(): void
    {
        global $serverAuthStaticKey;
        $this->serverAuthStaticKey = $serverAuthStaticKey;

        global $testAuth;
        $config = new Config();
        $config->useHTTPS = true;
        $config->enableLogs = true;
        $this->aodManager = new AodManager($testAuth, $config);

        global $dummyAuth;
        $this->dummyAodManager = new AodManager($dummyAuth);
    }

    public function testGetCategoriesList()
    {
        list($ret, $error) = $this->aodManager->getCategoriesList(testCommonParams(), $this->serverAuthStaticKey);
        $this->assertNotNull($ret);
        $this->assertNull($error);

        list($ret, $error2) = $this->dummyAodManager->getCategoriesList(testCommonParams(), $this->serverAuthStaticKey);
        $this->assertNull($ret);
        $this->assertNotNull($error2);
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
