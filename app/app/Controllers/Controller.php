<?php

namespace App\Controllers;

use App\App;
use Tree6bee\Framework\Routing\Controller as BasicController;

abstract class Controller extends BasicController
{
    /**
     * ctx 实例
     *
     * @var \Ctx\Ctx
     */
    protected $ctx;

    /**
     * Controller constructor.
     * @param App $app
     */
    public function __construct(App $app)
    {
        parent::__construct($app);

        // 引入 ctx
         $this->ctx = $app->getCtx();
    }

    protected function render($tpl, $data = [])
    {
        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/../views');
        $twig = new \Twig_Environment($loader, array(
            'cache'     => $this->app->config('view.cache'),
            'debug'     => $this->app->config('debug'),
            // 'charset'   => 'utf-8',
            // 'autoescape' 自动转义
        ));

        return $twig->load($tpl)->render($data);
    }
}
