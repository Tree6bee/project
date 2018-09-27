<?php

namespace App\Exceptions;

use Tree6bee\Framework\Exceptions\HttpException;
use Tree6bee\Support\Helpers\Exceptions\Handler as ExceptionsHandler;
use App\Helpers\Log;

class Handler extends ExceptionsHandler
{
    /**
     * 是否是调试模式
     *
     * @var boolean
     */
    protected $debug;

    public function __construct($debug = false, $collapseDir = '', $tfVersion = 'TFramework/1.0')
    {
        $this->debug = $debug;

        parent::__construct($collapseDir, $tfVersion);
    }

    /**
     * 错误日志记录
     */
    protected function report($e)
    {
        //继承该方法
        $content = $this->getLogOfException($e);
        //记录日志
        Log::error($content);
    }

    /**
     * 渲染错误页面
     *
     * @param $e
     */
    protected function renderHttpException($e)
    {
        if ($this->debug) {
            parent::renderHttpException($e);
        } else {
            $this->renderError($e);
        }
    }

    /**
     * 渲染错误页面
     *
     * @param $e
     */
    protected function renderError($e)
    {
        $statusCode = 500;
        if ($e instanceof HttpException) {
            $statusCode = $e->getStatusCode();
        }

        if (! headers_sent()) {
            // header("HTTP/1.0 {$data['code']} " . get_class($exception));
            header("HTTP/1.0 {$statusCode} " . 'Internal Server Error');
        }

        echo <<<EOF
<style type="text/css">
*{ padding: 0; margin: 0; }
body{padding: 24px 48px; background: #fff; font-family: "微软雅黑"; color: #333;}
h1{ font-size: 90px; font-weight: normal;}
p{ line-height: 1.8em; font-size: 24px }
</style>
<h1>:(</h1>
<p>哦豁，服务器异常.</p>
EOF;
    }
}
