<?php

namespace EasyFeishu\Tests\Calendar;

use EasyFeishu\Tests\TestCase;
use Mayunfeng\Supports\Collection;

class Schedule extends TestCase
{
    public function testCreateEvents()
    {
        $result = $this->getInstance()->schedule->createEvents(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            [
                'summary'   => '测试接口日程',
                'start_time'=> ['date'=>'2022-11-19'],
                'end_time'  => ['date'=>'2022-11-19'],
            ]
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetEvent()
    {
        $result = $this->getInstance()->schedule->getEvent(
            'feishu.cn_L4RCs7X8FbPBJ2SUAfpKxe@group.calendar.feishu.cn',
            '89503948-d446-46c3-9f94-b6ff67674e3d_0'
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetEvents()
    {
        $result = $this->getInstance()->schedule->getEvents(
            'feishu.cn_L4RCs7X8FbPBJ2SUAfpKxe@group.calendar.feishu.cn'
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testPatchEvents()
    {
        $result = $this->getInstance()->schedule->patchEvents(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            'b1480700-b8d4-4a71-bff4-b75f8d81319e_0',
            ['summary'=> '测试修改日程12']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testSearchEvents()
    {
        $result = $this->getInstance()->schedule->searchEvents(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            ['query'=> '测试'],
            []
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testEventsAttendees()
    {
        $result = $this->getInstance()->schedule->eventsAttendees(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            'edcae707-a0a4-4a3c-a333-2d7b14fcff5d_0',
            ['attendees'   => [['type'=>'user', 'user_id'=>'ou_37a83aaf1fae3af69be3b89b15231782']]],
            ['user_id_type'=> 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetAttendees()
    {
        $result = $this->getInstance()->schedule->getAttendees(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            'b1480700-b8d4-4a71-bff4-b75f8d81319e_0',
            ['user_id_type'=> 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testAttendees()
    {
        $result = $this->getInstance()->schedule->getAttendees(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            'edcae707-a0a4-4a3c-a333-2d7b14fcff5d_0',
            ['attendees'=> [['type'=>'user', 'user_id'=>'ou_37a83aaf1fae3af69be3b89b15231782']]]
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testDelEvent()
    {
        $result = $this->getInstance()->schedule->delEvent(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            'b1480700-b8d4-4a71-bff4-b75f8d81319e_0',
            ['need_notification'=> true]
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testDelAttendees()
    {
        $result = $this->getInstance()->schedule->delAttendees(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            'b1480700-b8d4-4a71-bff4-b75f8d81319e_0',
            ['attendee_ids'=> ['user_7021323678776410116'], 'need_notification'=>true]
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testEventMembers()
    { //-bug
        $result = $this->getInstance()->schedule->eventMembers(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            'edcae707-a0a4-4a3c-a333-2d7b14fcff5d_0',
            'user_7021323678776410116',
            ['page_size'=> 10]
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testListFreebusy()
    {
        $result = $this->getInstance()->schedule->listFreebusy(
            ['time_min'=>'2021-11-17T12:00:00+08:00', 'time_max'=>'2021-12-28T12:00:00+08:00', 'user_id'=>'ou_37a83aaf1fae3af69be3b89b15231782'],
            ['user_id_type'=> 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testTimeOffEvents()
    {
        $result = $this->getInstance()->schedule->timeOffEvents(
            ['user_id'      => 'ou_37a83aaf1fae3af69be3b89b15231782', 'timezone'=>'Asia/Shanghai',
                'start_time'=> '2021-11-24', 'end_time'=>'2021-11-24', 'title'=>'测试请假12', ],
            ['user_id_type'=> 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testDelTimeOffEvents()
    {
        $result = $this->getInstance()->schedule->delTimeOffEvents('timeoff:24f52e9c-f94f-fe0b-e86b-fa6801e355b2-1637144456');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
}
