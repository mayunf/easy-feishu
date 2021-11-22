<?php

namespace EasyFeishu\Tests\Authen;

use EasyFeishu\Tests\TestCase;
use Mayunfeng\Supports\Collection;

class Authen extends TestCase
{
    public function testAccessToken()
    {
        $result = $this->getInstance()->authen->accessToken('thisisacode');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testRefreshAccessToken()
    {
        $result = $this->getInstance()->authen->refreshAccessToken('thisisaaccesstoken');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
}
