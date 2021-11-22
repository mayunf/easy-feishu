<?php

namespace EasyFeishu\Tests\Calendar;

use EasyFeishu\Tests\TestCase;
use Mayunfeng\Supports\Collection;

class Calendar extends TestCase
{
    public function testCreateCalendar()
    {
        $result = $this->getInstance()->calendar->createCalendar([
            'summary'       => '测试接口创建日历2',
            'description'   => '这是描述',
            'permissions'   => 'public',
            'summary_alias' => '备注',
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetCalendar()
    {
        $result = $this->getInstance()->calendar->getCalendar('feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetCalendars()
    {
        $result = $this->getInstance()->calendar->getCalendars();
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testPatchCalendar()
    {
        $result = $this->getInstance()->calendar->patchCalendars(
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
        $result = $this->getInstance()->calendar->searchCalendars(
            ['query'=>'测试'],
            ['page_size'=> 10]
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testSubscribeCalendars()
    {
        $result = $this->getInstance()->calendar->subscribeCalendars('feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testUnsubscribe()
    {
        $result = $this->getInstance()->calendar->unsubscribe('feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testDelCalendars()
    {
        $result = $this->getInstance()->calendar->delCalendars('feishu.cn_5iKyYYxoOBoyASKMT2EpBa@group.calendar.feishu.cn');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
}
