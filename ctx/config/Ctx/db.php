<?php
return array(
    'default' => array(
        'master' => array(  //默认数据库
            'driver'    => 'mysql',
            'dsn'       => 'mysql:host=%s;port=3306;dbname=%s;charset={$charset}',
            'user'      => 'uuu',
            'psw'       => '000',
        ),
        'slave' => array(
            'driver'    => 'mysql',
            'dsn'       => 'mysql:host=%s;port=3306;dbname=%s;charset={$charset}',
            'user'      => 'uuu',
            'psw'       => '000',
        )
    ),
    // 'MDB_MISSION'
    'mission' => array(
        'master' => array(  //默认数据库
            'driver'    => 'pgsql',
            'dsn'       => 'pgsql:host=%s;port=5432;dbname=%s',
            'user'      => 'uuu',
            'psw'       => '000',
        ),
        'slave' => array(
            'driver'    => 'pgsql',
            'dsn'       => 'pgsql:host=%s;port=5432;dbname=%s',
            'user'      => 'uuu',
            'psw'       => '000',
        )
    ),
);
