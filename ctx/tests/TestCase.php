<?php

namespace Tests\Ctx;

use Ctx\Ctx;

class TestCase extends \PHPUnit_Framework_TestCase
{
    /**
     * @var Ctx
     */
    protected $ctx;

    /**
     * ctx测试目录
     *
     * @var string
     */
    protected $ctxTestsDir;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        //初始化用于测试的ctx单例对象
        $this->ctx = Ctx::getInstance();

        $this->ctxTestsDir = dirname(__DIR__) . '/tests';
    }
}
