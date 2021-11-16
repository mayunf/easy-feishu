<?php

namespace EasyFeishu\Tests;

use EasyFeishu\Foundation\Application;
use PHPUnit\Framework\TestCase as BaseTestCase;

class TestCase extends BaseTestCase
{
    private static $_instance;

    public function getInstance()
    {
        self::$_instance = new Application([
            'debug'       => false,
            'app_id'      => 'cli_a1fa7d0637f85013',
            'app_secret'  => 'Vt4pNC4zaQr0Ve4cljH3iyh7ZyHrufC7',
            'log'         => [
                'file'  => __DIR__.'/../logs/'.date('Y-m-d').'.log',
                'level' => 'debug',
            ],
        ]);

        return self::$_instance;
    }
}
