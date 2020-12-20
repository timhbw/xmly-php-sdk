<?php

namespace Xmly;

final class Config
{
    const SDK_VER = '1.0.0';
    const API_HOST = 'api.ximalaya.com';
    const API_BACKUP_HOST = 'apihera.ximalaya.com';
    const LOG_PATH = '../../.xmly_sdk/logs/';

    //BOOL 是否使用https域名
    public $useHTTPS;

    //BOOL 是否记录日志到本地
    public $enableLogs;
}
