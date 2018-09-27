<?php

namespace Ctx\Basic;

use PHPCtx\Ctx\Basic\Ctx as BasicCtx;

/**
 * Ctx基类
 */
abstract class Ctx extends BasicCtx
{
    /**
     * @var \Ctx\Ctx $ctx
     */
    public $ctx;

    private static $ctxChildren = [];

    /**
     * @return mixed
     *
     * 根据类的不同构造函数的参数 获取对象的单例
     */
    final protected function loadSC()
    {
        $args = func_get_args();
        $class = array_shift($args);
        $argsKey = serialize($args);

        //这里不能用 Arr 辅助类，因为参数可能含有 '.' 导致一些意外
        if (empty(self::$ctxChildren[$this->getModName()]) ||
            empty(self::$ctxChildren[$this->getModName()][$class]) ||
            empty(self::$ctxChildren[$this->getModName()][$class][$argsKey])
        ) {
            self::$ctxChildren[$this->getModName()][$class][$argsKey] = $this->loadChild($class, $args);
        }

        return self::$ctxChildren[$this->getModName()][$class][$argsKey];
    }

    /*--- part.2 非框架核心 ---*/

    /**
     * 获取配置文件
     *
     * @example $this->getItem('avatar.url')
     */
    protected function getItem($item = '', $default = null, $file = 'main')
    {
        $path = '@' . $this->getModName() . '/' . $file;
        return $this->ctx->Ctx->getConf($item . $path, $default);
    }

    /**
     * 设置配置
     *
     * @example $this->setItem('port', '8080')
     */
    protected function setItem($item = '', $config = null, $file = 'main')
    {
        $path = '@' . $this->getModName() . '/' . $file;
        $this->ctx->Ctx->setConf($item . $path, $config);
    }

    /**
     * 获取公共配置文件
     *
     * @example $this->getCItem('upload.host')
     */
    protected function getCItem($item = '', $default = null, $file = 'main')
    {
        $path = '@common/' . $file;
        return $this->ctx->Ctx->getConf($item . $path, $default);
    }
}
