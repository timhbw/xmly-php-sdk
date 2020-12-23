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
    protected $testBody;

    protected function setUp(): void
    {
        global $testBody;
        $this->testBody = $testBody;

        global $serverAuthStaticKey;
        $this->serverAuthStaticKey = $serverAuthStaticKey;

        global $testAuth;
        $config = new Config();
        $config->useHTTPS = true;
        $config->enableLogs = true;
        $this->aodManager = new AodManager($testAuth, $config);
        $this->testBody = $testAuth->commonParams();

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

        list($ret, $error) = $this->aodManager->getAnnouncersCategories($this->testBody, $this->serverAuthStaticKey);
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

    public function testGetAlbumsBrowse()
    {
        $param['album_id'] = 6922889;
        $param['sort'] = 'time_asc';
        $body = testCommonParams($param);
        list($ret, $error) = $this->aodManager->getAlbumsBrowse($body, $this->serverAuthStaticKey);
        $this->assertNotNull($ret);
        $this->assertNull($error);
    }

    public function testGetAlbumsGetBatch()
    {
        $param['ids'] = '6922889,8139811,6255099';
        $param['with_metadata'] = false;
        $body = testCommonParams($param);
        list($ret, $error) = $this->aodManager->getAlbumsGetBatch($body, $this->serverAuthStaticKey);
        $this->assertNotNull($ret);
        $this->assertNull($error);
    }
}
