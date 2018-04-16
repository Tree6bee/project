<?php

namespace App;

use App\Exceptions\Handler;
use App\Routing\Router;
use Ctx\Ctx;
use Tree6bee\Cf\Foundation\Application;
use Tree6bee\Support\Helpers\Exceptions\Contracts\ExceptionsHandler;

/**
 * 应用程序入口
 *
 * Class App
 * @package App
 */
class App extends Application
{
    //--- 以下部分引入 ctx 方便 --
    /**
     * @var \Ctx\Ctx
     */
     private $ctx;

     protected function __construct()
     {
         parent::__construct();

         $this->ctx = Ctx::getInstance();

         $this->config = array_merge(
             $this->config,
             $this->ctx->Ctx->getConf('@common/web')
         );
     }

     public function getCtx()
     {
         return $this->ctx;
     }

    /**
     * 应用配置
     * -- environment (运行环境):
     *  - development(开发模式)
     *  - testing(单测模式暂时不考虑)
     *  - production(生产环境)
     *  - maintenance(维护模式)
     *
     * -- cfVersion (框架版本)
     * -- timezone (时区)
     *
     * - xhprof_dir util包路径
     *
     * @var array
     */
    protected $config = [
        //'environment'   => 'production', 暂时用不到
        'debug'         => false,
        'cfVersion'     => 'CtxFramework/1.0',
        'timezone'      => 'PRC',
        'xhprof_dir'    => __DIR__ . '/../public/xhprof',
        'view'          => [
            'cache'     => __DIR__ . '/../storage/views',
        ],
    ];

    /**
     * 构造异常接管对象
     * 初始化接管异常类为应用层接管类方便个性化处理
     *
     * @return ExceptionsHandler
     */
    protected function setExceptionsHandler()
    {
        return new Handler($this->config('debug'), '', $this->config('cfVersion'));
    }

    protected function initRouter()
    {
        $this->router = new Router(dirname(__DIR__) . '/storage/cache/route.cache');
    }

    /**
     * 全局中间件
     */
    protected $middleware = [
        // \Tree6bee\Cf\Foundation\Middleware\Xhprof::class,
    ];
}
