<?php

namespace App\Controllers\Home;

use App\Controllers\Controller;

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
        $name = 'tf';

        return $this->render(
            '/Home/index.html',
            compact('name')
        );
    }
}
