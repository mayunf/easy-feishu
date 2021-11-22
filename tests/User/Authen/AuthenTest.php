<?php

namespace EasyFeishu\Tests\User;

use Mayunfeng\Supports\Collection;

class AuthenTest extends UserTest
{
    public function testUserInfo()
    {
        $info = $this->getUser()->authen->userInfo(); // 调用user相关接口
        dump($info->toArray());
        $this->assertInstanceOf(Collection::class, $info);
    }
}
