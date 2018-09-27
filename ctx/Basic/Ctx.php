<?php

namespace Ctx\Basic;

use PHPCtx\Ctx\Basic\Ctx as BasicCtx;
use Tree6bee\Support\Ctx\Rpc\Client;

/**
 * Ctx基类
 */
abstract class Ctx extends BasicCtx
{
    /**
     * @var \Ctx\Ctx $ctx
     */
    public $ctx;

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

    protected function invokeRpc($method, $args)
    {
        $rpc = new Client($this->rpc['host']);
        return $rpc->exec($this->getModName(), $method, $args);
    }
}
