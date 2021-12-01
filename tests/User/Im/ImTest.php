<?php

namespace EasyFeishu\Tests\User\Im;

use Mayunfeng\Supports\Collection;
use EasyFeishu\Tests\User\UserTest;

class ImTest extends UserTest
{
    //用户撤回消息
    public function testDelMessage()
    {
        $result = $this->getUser()->im->delMessage('om_23bfbbc53036b7b3cf74a180ffc482e4');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

}
