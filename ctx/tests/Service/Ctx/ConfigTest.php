<?php

namespace Tests\Ctx\Service\Ctx;

use Tests\Ctx\TestCase;

class ConfigTest extends TestCase
{
    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
    }

    public function testGetConfigWithCtx()
    {
        //配置测试
        $this->ctx->Ctx->setConf('security_path@Ctx/db', $this->ctxTestsDir . '/security');
        $this->assertEquals($this->ctxTestsDir . '/security', $this->ctx->Ctx->getConf('security_path@Ctx/db'));
    }

    public function testDb()
    {
//        $db = $this->ctx->Ctx->loadDB('mission.master');
//        $db->transaction(function () use ($db) {
//            $db->insert('users', [
//                'id'    => 1,
//                'name'  => 'lisa',
//                'data'  => json_encode([
//                    'a' => 'b',
//                ]),
//            ]);
//
//            $ret = $db->select('select * from users where id = :id', [
//                'id'    => 1,
//            ]);
//            var_dump($ret);
//
//            $ret = $db->update('users', [
//                'id'    => 1,
//            ], [
//                'id'    => 3,
//            ]);
//            var_dump($ret);

//            $ret = $db->delete('users', [
//                'id'    => 2,
//            ]);
//            var_dump($ret);

//            throw new \Exception('test');
//        });
    }

    public function testRedis()
    {
//        $redis = $this->ctx->Ctx->loadRedis();
//        $redis->set('key1', 'hello world.');
//        $ret = $redis->get('key1');
//        var_dump($ret);
    }
}
