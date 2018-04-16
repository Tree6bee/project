<?php

namespace App\Helpers;

use Tree6bee\Cf\Logging\Logger;

class Log extends Logger
{
    protected function getLogPath($dir)
    {
        return $dir . '/'. date('Ym') . '/';
    }

    protected function getStoragePath()
    {
        return dirname(dirname(__DIR__)) . '/storage';
    }
}
