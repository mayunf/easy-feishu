<?php


namespace EasyFeishu\Tests\Meeting;

use EasyFeishu\Tests\TestCase;
use Mayunfeng\Supports\Collection;
class Meetings extends TestCase
{
    //会议详情
    public function testGetMeetings(){
        $result = $this->getInstance()->meetings->getMeetings('7035820069000314883');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //关联的会议列表
    public function testGetMeetingsListBy(){
        $result = $this->getInstance()->meetings->getMeetingsListBy([
            'meeting_no'=>'627989441',
            'start_time'=>1635242400,
            'end_time'=>1640512800
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //设置主持人
    public function testMeetingSetHost(){
        $result = $this->getInstance()->meetings->meetingSetHost('7035823573810102275',[
            'host_user'=>[
                'id' => 'ou_81e9204daf2562dd7b8924f0fd24748e',
                'user_type' => 1
            ]
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //移除参会人
    public function testMeetingsKickout(){
        $result = $this->getInstance()->meetings->meetingsKickout('7035823573810102275',[
            'kickout_users'=>[['id'=>'ou_81e9204daf2562dd7b8924f0fd24748e','user_type'=>1]]
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //获取会议报告
    public function testGetReportsDaily(){
        $result = $this->getInstance()->meetings->getReportsDaily([
            'start_time'=>'1638069076','end_time'=>'1638155476'
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //获取top用户列表
    public function testGetReportsTopUser(){
        $result = $this->getInstance()->meetings->getReportsTopUser([
            'start_time'=>'1638069076','end_time'=>'1638155476',
            'limit'=>10,'order_by'=>1
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //查询会议室配置
    public function testGetRoomConfig(){
        $result = $this->getInstance()->meetings->getRoomConfig(['scope'=>2,'country_id'=>'086']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //设置会议室配置
    public function testSetRoomConfig(){
        $result = $this->getInstance()->meetings->setRoomConfig([
            'scope'=>2,'country_id'=>'086','room_config'=>['display_background'=>'12']
            ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
}