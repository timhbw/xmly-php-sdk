<?php

namespace Xmly;

use http\Message\Body;

final class Util
{
    public static function json_decode($json, $assoc = false, $depth = 512)
    {
        static $jsonErrors = array(
            JSON_ERROR_DEPTH => 'JSON_ERROR_DEPTH - Maximum stack depth exceeded',
            JSON_ERROR_STATE_MISMATCH => 'JSON_ERROR_STATE_MISMATCH - Underflow or the modes mismatch',
            JSON_ERROR_CTRL_CHAR => 'JSON_ERROR_CTRL_CHAR - Unexpected control character found',
            JSON_ERROR_SYNTAX => 'JSON_ERROR_SYNTAX - Syntax error, malformed JSON',
            JSON_ERROR_UTF8 => 'JSON_ERROR_UTF8 - Malformed UTF-8 characters, possibly incorrectly encoded'
        );

        if (empty($json)) {
            return null;
        }
        $data = \json_decode($json, $assoc, $depth);

        if (JSON_ERROR_NONE !== json_last_error()) {
            $last = json_last_error();
            throw new \InvalidArgumentException(
                'Unable to parse JSON data: '
                . (isset($jsonErrors[$last])
                    ? $jsonErrors[$last]
                    : 'Unknown error')
            );
        }

        return $data;
    }

    public static function randomString($length = 11)
    {
        $str = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890';
        $randStr = str_shuffle(str_repeat($str, $length));//打乱字符串
        return substr($randStr, 0, $length);
    }

    public static function msecTime()
    {
        return floor(microtime(true) * 1000);
    }

    public static function mkdir()
    {
        if (!is_dir(Config::LOG_PATH)) {
            mkdir(Config::LOG_PATH, 0777, true);
            var_dump(Config::LOG_PATH);
        }
    }

    public static function writeLog($LogLevel, $url, $body, $statusCode = null, $duration = null, $error = null)
    {
        self::mkdir();
        date_default_timezone_set("Asia/Shanghai");
        $log_file_name = Config::LOG_PATH . $LogLevel . "-" . date('Y-m-d-H') . '.log';
        if ($LogLevel === 'INFO') {
            $content = date('Y-m-d H:i:s') . ' [' . $LogLevel . '] ' . $statusCode . '  ' . $duration . '  ' . $url . '  ' . $body . "\n";
        } else {
            $content = date('Y-m-d H:i:s') . ' [' . $LogLevel . '] ' . $statusCode . '  ' . $duration . '  ' . $url . '  ' . $body . '  ' . $error . "\n";
        }

        file_put_contents($log_file_name, $content, FILE_APPEND);
    }

    public static function writeInfoLog($url, $body, $statusCode, $duration)
    {
        self::writeLog('INFO', $url, $body, $statusCode, $duration);
    }

    public static function writeErrLog($url, $body, $statusCode, $duration, $error)
    {
        self::writeLog('ERROR', $url, $body, $statusCode, $duration, $error);
    }
}