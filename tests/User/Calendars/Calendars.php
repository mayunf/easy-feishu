<?php

namespace EasyFeishu\Tests\User\Calendars;

use EasyFeishu\Tests\User\UserTest;
use Mayunfeng\Supports\Collection;

class Calendars extends UserTest
{
    public function testCreateCalendar()
    {
        $result = $this->getUser()->calendars->createCalendar([
            'summary'       => '测试接口创建日历222111',
            'description'   => '这是描述',
            'permissions'   => 'private',
            'summary_alias' => '备注',
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetCalendar()
    {
        $result = $this->getUser()->calendars->getCalendar('feishu.cn_Gcnr4tNnz57dgY94D8r1vc@group.calendar.feishu.cn');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetCalendars()
    {
        $result = $this->getUser()->calendars->getCalendars();
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testPatchCalendar()
    {
        $result = $this->getUser()->calendars->patchCalendars(
            'feishu.cn_LpypseQIxfLq6Pf0elJbZf@group.calendar.feishu.cn',
            [
                'summary'     => '修改群组同步11',
                'description' => '这是描述',
            ]
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testSearchCalendars()
    {
        $result = $this->getUser()->calendars->searchCalendars(
            ['query'=>'测试'],
            ['page_size'=> 10]
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testSubscribeCalendars()
    {
        $result = $this->getUser()->calendars->subscribeCalendars('feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testUnsubscribe()
    {
        $result = $this->getUser()->calendars->unsubscribe('feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testDelCalendars()
    {
        $result = $this->getUser()->calendars->delCalendars('feishu.cn_5iKyYYxoOBoyASKMT2EpBa@group.calendar.feishu.cn');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testPostSubscription()
    {
        $result = $this->getUser()->calendars->postSubscription();
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
}
