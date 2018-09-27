<?php

namespace App\Commands;

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
}
