<?php

namespace EasyFeishu\Tests\User\Meetings;

use EasyFeishu\Tests\User\UserTest;
use Mayunfeng\Supports\Collection;

class Reserves extends UserTest
{
    //预约会议
    public function testReservesApply()
    {
        $result = $this->getUser()->reserves->reservesApply(['end_time'=>1638175530]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    //获取预约
    public function testGetReservesApply()
    {
        $result = $this->getUser()->reserves->getReservesApply('7034788169648668700');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    //更新预约
    public function testPutReservesApply()
    {
        $result = $this->getUser()->reserves->putReservesApply('7034788169648668700', [
            'end_time'=> 1637920855,
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    //获取活跃预约
    public function testGetReservesActive()
    {
        $result = $this->getUser()->reserves->getReservesActive('7035802784814514180');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
}
