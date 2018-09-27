<?php

namespace App\Commands\Home;

use App\Commands\Controller;

class Index extends Controller
{
    /**
     * 路由中间件
     */
    protected static $middleware = array(
        'index' => array(
//            '\Tree6bee\Framework\Foundation\Http\Middleware\VerifyCsrfToken',
        ),
    );

    public function index()
    {
        return 'hello tf.';
    }
}
