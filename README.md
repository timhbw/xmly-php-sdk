### PHP SDK for XMLY Services（喜马拉雅服务端 PHP-SDK）
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg)](LICENSE)
[![Build Status](https://travis-ci.org/timhbw/xmly-php-sdk.svg)](https://travis-ci.org/timhbw/xmly-php-sdk)
[![GitHub release](https://img.shields.io/github/v/tag/timhbw/xmly-php-sdk.svg?label=release)](https://github.com/timhbw/xmly-php-sdk/releases)
[![Latest Stable Version](https://img.shields.io/packagist/v/timhbw/xmly-php-sdk.svg)](https://packagist.org/packages/timhbw/xmly-php-sdk)
[![Total Downloads](https://img.shields.io/packagist/dt/timhbw/xmly-php-sdk.svg)](https://packagist.org/packages/timhbw/xmly-php-sdk)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/timhbw/xmly-php-sdk/badges/quality-score.png?b=main)](https://scrutinizer-ci.com/g/timhbw/xmly-php-sdk/?branch=main)
[![codecov](https://codecov.io/gh/timhbw/xmly-php-sdk/branch/main/graph/badge.svg?token=Zvredk5XBB)](https://codecov.io/gh/timhbw/xmly-php-sdk)
![Packagist PHP Version Support](https://img.shields.io/packagist/php-v/timhbw/xmly-php-sdk)

This is an unofficial PHP SDK for XMLY services.

### 安装
#### 1、Composer 方式（推荐使用该方法安装，成为优雅的 PHPer 🔥）
Composer 是 PHP 的依赖管理工具，支持您项目所需的依赖项，并将其安装到项目中。关于 Composer 安装详细可参考 [Composer 官网文档](https://pkg.phpcomposer.com/#how-to-install-composer) 
- 下载 Composer：安装前请务必确保已经正确安装了 PHP
  ```
  php -r "copy('https://install.phpcomposer.com/installer', 'composer-setup.php');"
  php composer-setup.php
  php -r "unlink('composer-setup.php');"
  ```
- 安装 Composer： Mac 或 Linux 系统环境在命令行中执行以下命令安装：
  ```
  sudo mv composer.phar /usr/local/bin/composer
  ```

- 执行命令添加依赖，可以在你的项目根目录运行：
  ```
  composer require timhbw/xmly-php-sdk
  ```

#### 2、Phar 方式
#### 3、源码方式
  - 如果不适应 `composer` 管理，可以直接下载压缩包(注意需要下载 xmly-php-sdk-版本号.zip 格式的 zip 压缩包，不是 Source code 源码压缩包)，解压后，项目中添加如下代码：
    ```
    require_once '/path/to/xmly-php-sdk/vendor/autoload.php';
    ```

## 运行环境
- PHP 5.3+.
- cURL extension.

## 使用方法
- SDK 内已封装的接口：直接调用，比如获取专辑列表：
  ```php
  <?php
  require_once __DIR__ . '/../../autoload.php';
  
  use Xmly\Auth;
  use Xmly\Config;
  use Xmly\API\AodManager;
  
  $appKey = 'xxxx';
  $appSecret = 'xxxx';
  $deviceID = 'xxxx';
  $serverAuthStaticKey = 'xxxx';
  
  $auth = new Auth($appKey, $appSecret, $deviceID);
  
  $config = new Config();
  $config->useHTTPS = true; // 接口是否使用 HTTPS 协议
  $config->enableLogs = true; // 是否记录日志到本地
  
  $aodManager = new AodManager($auth, $config);
  
  $body['category_id'] = 30; // 分类ID，为0时表示热门分类。分类数据可以通过 /categories/list获取
  $body['calc_dimension'] = 1; // 返回结果排序维度：1-最火，2-最新，3-最多播放
  $body = $auth->commonParams($body);
  
  list($ret, $err) = $aodManager->getAlbumsList($body, $serverAuthStaticKey);
  if ($err !== null) {
      var_dump($err);
  } else {
      var_dump($ret);
  }
  ```

- SDK 内未封装的接口：使用封装好的`signatureURL`方法签算请求 URL 并发起 GET 请求
  ```php
  <?php
  require_once __DIR__ . '/../autoload.php';
  
  use Xmly\Auth;
  use Xmly\Http\Client;
  
  $appKey = 'xxxx';
  $appSecret = 'xxxx';
  $deviceID = 'xxxx';
  $serverAuthStaticKey = 'xxxx';
  
  $auth = new Auth($appKey, $appSecret, $deviceID);
  
  $url = "https://api.ximalaya.com/marketing/query_activities";
  
  $body['app_key'] = '99b37417e1185eda1378600593b45c40';
  $body['activity_type'] = '1';
  $body = $auth->commonParams($body);
  
  $sigURl = $url . '?' . $auth->signatureURL($body, $serverAuthStaticKey);
  
  $headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
  $response = Client::get($sigURl, $headers);
  
  if ($response->ok()) {
      $r = $response->json();
      var_dump($r);
  } else {
      var_dump($response);
  }
  ```

- SDK 内未封装的接口：使用封装好的`signatureURL`方法签算请求 URL 并发起 POST 请求

- SDK 内未封装的接口：自行签算请求 URL 并发起 GET 请求
  ```php
  <?php
  require_once __DIR__ . '/../autoload.php';
  
  use Xmly\Http\Client;
  
  $url = "https://xxxx.xxxx.com/token/getUpToken";
  $contentType = "application/json";
  
  $headers['Content-Type'] = $contentType;
  $response = Client::get($url, $headers);
  
  if ($response->ok()) {
      $r = $response->json();
      var_dump($r);
  } else {
      var_dump($response);
  }
  ```

- SDK 内未封装的接口：自行签算请求 URL 并发起 POST 请求
  ```php
  <?php
  require_once __DIR__ . '/../autoload.php';
  
  use Xmly\Http\Client;
  
  $url = "https://api.ximalaya.com/oauth2/revoke_refresh_token";
  
  $req['client_id'] = 'xxxx';
  $req['client_secret'] = 'xxxx';
  $req['device_id'] = 'xxxx';
  $req['redirect_uri'] = 'https://xx.xxxx.com/oauth2/get_access_token';
  $req['refresh_token'] = 'xxxxxx';
  $body = http_build_query($req);
  
  $headers['Content-Type'] = 'application/x-www-form-urlencoded; charset=UTF-8';
  $response = Client::post($url, $body, $headers);
  
  if ($response->ok()) {
      $r = $response->json();
      var_dump($r);
  } else {
      var_dump($response);
  }
  ```

- 普通 GET 请求
  ```php
  <?php
  require_once __DIR__ . '/../autoload.php';
  
  use Xmly\Http\Client;
  
  $url = "https://xxxx.xxxx.com/token/getUpToken";
  $contentType = "application/json";
  
  $headers['Content-Type'] = $contentType;
  $response = Client::get($url, $headers);
  
  if ($response->ok()) {
  $r = $response->json();
  var_dump($r);
  } else {
  var_dump($response);
  }
  ```

- 普通 POST 请求
  ```php
  <?php
  require_once __DIR__ . '/../autoload.php';
  
  use Xmly\Http\Client;
  
  $url = 'https://qiniu.timhbw.com/notify/callback';
  
  $req['name'] = 'app';
  $req['color'] = 'red';
  $body = json_encode($req);
  
  $contentType = "application/json";
  
  $headers['Content-Type'] = $contentType;
  $response = Client::post($url, $body, $headers);
  
  if ($response->ok()) {
      $r = $response->json();
      var_dump($r);
  } else {
      var_dump($response);
  }
  ```

## 快速入门
参照 Demo 程序，详见  [examples](https://github.com/timhbw/xmly-php-sdk/tree/main/examples) 目录下的文件
