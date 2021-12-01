<?php

namespace EasyFeishu\Tests\User\Calendar;

use EasyFeishu\Tests\User\UserTest;
use Mayunfeng\Supports\Collection;

class Schedule extends UserTest
{
    public function testCreateEvents()
    {
        $result = $this->getUser()->schedule->createEvents(
            'feishu.cn_Gcnr4tNnz57dgY94D8r1vc@group.calendar.feishu.cn',
            [
                'summary'   => '测试用户接口日程123',
                'start_time'=> ['date'=>'2022-11-19'],
                'end_time'  => ['date'=>'2022-11-19'],
            ]
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetEvent()
    {
        $result = $this->getUser()->schedule->getEvent(
            'feishu.cn_Gcnr4tNnz57dgY94D8r1vc@group.calendar.feishu.cn',
            'eda3a1aa-d47e-487c-b9ee-333cbe534953_0'
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetEvents()
    {
        $result = $this->getUser()->schedule->getEvents(
            'feishu.cn_L4RCs7X8FbPBJ2SUAfpKxe@group.calendar.feishu.cn'
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testPatchEvents()
    {
        $result = $this->getUser()->schedule->patchEvents(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            'b1480700-b8d4-4a71-bff4-b75f8d81319e_0',
            ['summary'=> '测试修改日程12']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testSearchEvents()
    {
        $result = $this->getUser()->schedule->searchEvents(
            'feishu.cn_L4RCs7X8FbPBJ2SUAfpKxe@group.calendar.feishu.cn',
            ['query'=> '主'],
            []
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testEventsSubscription(){
        $result = $this->getUser()->schedule->EventsSubscription('feishu.cn_L4RCs7X8FbPBJ2SUAfpKxe@group.calendar.feishu.cn');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testEventsAttendees()
    {
        $result = $this->getUser()->schedule->eventsAttendees(
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
        $result = $this->getUser()->schedule->getAttendees(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            'b1480700-b8d4-4a71-bff4-b75f8d81319e_0',
            ['user_id_type'=> 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testAttendees()
    {
        $result = $this->getUser()->schedule->getAttendees(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            'edcae707-a0a4-4a3c-a333-2d7b14fcff5d_0',
            ['attendees'=> [['type'=>'user', 'user_id'=>'ou_37a83aaf1fae3af69be3b89b15231782']]]
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testDelEvent()
    {
        $result = $this->getUser()->schedule->delEvent(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            'b1480700-b8d4-4a71-bff4-b75f8d81319e_0',
            ['need_notification'=> true]
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testDelAttendees()
    {
        $result = $this->getUser()->schedule->delAttendees(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            'b1480700-b8d4-4a71-bff4-b75f8d81319e_0',
            ['attendee_ids'=> ['user_7021323678776410116'], 'need_notification'=>true]
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testEventMembers()
    { //-bug
        $result = $this->getUser()->schedule->eventMembers(
            'feishu.cn_eVyEq7HTDYeiCXVzvd0oSd@group.calendar.feishu.cn',
            'edcae707-a0a4-4a3c-a333-2d7b14fcff5d_0',
            'user_7021323678776410116',
            ['page_size'=> 10]
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testPostCalDav(){
        $result = $this->getUser()->schedule->postCalDav(['device_name'=>'test']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testPostExchange(){
        $result = $this->getUser()->schedule->postExchange([
            'admin_account'=>'test',
            'exchange_account'=>'test',
            'user_id'=>'ou_37a83aaf1fae3af69be3b89b15231782'
        ],['user_id_type'=>'open_id']);
        dump($result->toArray());exit;
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetExchange(){
        $result = $this->getUser()->schedule->getExchange('test');
        dump($result->toArray());exit;
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testDelExchange(){
        $result = $this->getUser()->schedule->delExchange('test');
        dump($result->toArray());exit;
        $this->assertInstanceOf(Collection::class, $result);
    }

}
