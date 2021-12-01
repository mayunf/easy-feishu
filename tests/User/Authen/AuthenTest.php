<?php

namespace EasyFeishu\Tests\User;

use EasyFeishu\Mina\Mina;
use Mayunfeng\Supports\Collection;

class AuthenTest extends UserTest
{
    public function testGetToken()
    {
        $new = new Mina();
        $info = $new->code2session('238b17af44e08d39');
        dump($info);
        exit;
    }

    public function testUserInfo()
    {
        $info = $this->getUser()->authen->userInfo(); // 调用user相关接口
        dump($info->toArray());
        $this->assertInstanceOf(Collection::class, $info);
    }
}
