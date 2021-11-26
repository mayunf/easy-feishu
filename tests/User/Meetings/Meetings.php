<?php


namespace EasyFeishu\Tests\User\Meetings;

use Mayunfeng\Supports\Collection;
use EasyFeishu\Tests\User\UserTest;
class Meetings extends UserTest
{
    //会议详情
    public function testGetMeetings(){
        $result = $this->getUser()->meetings->getMeetings('7034795901177495556');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //关联的会议列表
    public function testGetMeetingsListBy(){
        $result = $this->getUser()->meetings->getMeetingsListBy([
            'meeting_no'=>'627989441',
            'start_time'=>1635242400,
            'end_time'=>1640512800
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //邀请参会人
    public function testPatchInvite(){
        $result = $this->getUser()->meetings->patchInvite('7034810981109989380',[
            'invitees'=>[
               [
                   'id' => 'ou_81e9204daf2562dd7b8924f0fd24748e',
                   'user_type' => 1
               ]
            ]
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testMeetingSetHost(){
        $result = $this->getUser()->meetings->meetingSetHost('7034810981109989380',[
            'host_user'=>[
                'id' => 'ou_81e9204daf2562dd7b8924f0fd24748e',
                'user_type' => 1
            ]
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testMeetingsEnd(){
        $result = $this->getUser()->meetings->meetingsEnd('7034810981109989380');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
}