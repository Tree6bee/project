<?php

namespace Ctx\Service\Ctx\Child;

use Ctx\Basic\Ctx;
use Ctx\Basic\Exception;
use Predis\Client as Redis;
use Tree6bee\Support\Ctx\Db\MySqlConnection;
use Tree6bee\Support\Ctx\Db\PostgresConnection;

/**
 * 框架存储辅助类
 *
 */
class Storage extends Ctx
{
    /**
     * 构造函数
     */
    public function __construct()
    {
    }

    /**
     * db实例，所有子类都会共享该属性
     */
    private static $dbObj = array();

    /**
     * 加载数据库mysql获取数据库操作对象
     * $this->loadDB();
     * $this->loadDB('mission.slave');
     *
     * @param string $database
     * @return \Tree6bee\Support\Ctx\Db\Connection
     */
    public function db($database = 'default.master')
    {
        if (! isset(self::$dbObj[$database])) {
            $config = $this->getItem($database, null, 'db');

            if ($config['driver'] == 'mysql') {
                self::$dbObj[$database] = new MySqlConnection($config['dsn'], $config['user'], $config['psw']);
            } else {    //默认Pgsql
                self::$dbObj[$database] = new PostgresConnection($config['dsn'], $config['user'], $config['psw']);
            }
        }

        return self::$dbObj[$database];
    }

    /**
     * redis实例
     */
    private static $redisObj = array();

    /**
     * 加载Redis对象
     * $this->ctx->loadRedis();
     * $this->ctx->loadRedis('test');
     *
     * @param string $redis
     * @return Redis
     */
    public function redis($redis = 'default')
    {
        if (! isset(self::$redisObj[$redis])) {
            $config = $this->getItem($redis, null, 'redis');
            self::$redisObj[$redis] = new Redis([
                'scheme'    => 'tcp',
                'host'      => $config['host'],
                'port'      => $config['port'],
                'timeout'   => $config['timeout'],
            ]);
            // self::$redisObj[$redis] = new Redis($config['host'], $config['port'], $config['timeout']);
        }

        return self::$redisObj[$redis];
    }

    public function __destruct()
    {
        foreach (self::$redisObj as $redis) {
            /** @var $redis Redis */
            $redis->disconnect();
        }
    }
}
