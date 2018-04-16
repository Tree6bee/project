<?php

//app 入口文件
/**
 * 正式的文件组织方式如下:
 * -- /application: [ web | api | m | admin | task ] 环境入口
 *      -- /public
 *          -- index.php
 *      -- /app
 *
 * -- /ctx_base
 *      -- /vendor
 *          -- /tree6bee
 *
 */
require __DIR__.'/../../vendor/autoload.php';

App\App::getInstance()->run();
