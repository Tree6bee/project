<?php

namespace Ctx;

use Dotenv\Dotenv;
use PHPCtx\Ctx\Ctx as BasicCtx;

/**
 * Context 上下文
 *
 * @property \Ctx\Service\Ctx\Ctx $Ctx
 */
class Ctx extends BasicCtx
{
    protected static $ctxInstance;

    /**
     * ctx命名空间
     */
    protected $ctxNamespace = 'Ctx';

    protected function __construct()
    {
        parent::__construct();
        (new Dotenv(__DIR__, '.env'))->load(); //getenv($var)
    }
}
