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
        $result = $this->getUser()->meetings->patchInvite('7035823573810102275',[
            'invitees'=>[['id'=>'ou_81e9204daf2562dd7b8924f0fd24748e','user_type'=>1]]
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    //设置主持人
    public function testMeetingSetHost(){
        $result = $this->getUser()->meetings->meetingSetHost('7035823573810102275',[
            'host_user'=>[
                'id' => 'ou_81e9204daf2562dd7b8924f0fd24748e',
                'user_type' => 1
            ]
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //结束会议
    public function testMeetingsEnd(){
        $result = $this->getUser()->meetings->meetingsEnd('7035820069000314883');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //开始录制
    public function testRecordingStart(){
        $result = $this->getUser()->meetings->recordingStart('7035799967840714755');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class,$result);
    }
    //结束录制
    public function testRecordingStop(){
        $result = $this->getUser()->meetings->recordingStop('7035799967840714755');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class,$result);
    }
    //获取录制文件
    public function testGetRecording(){
        $result = $this->getUser()->meetings->getRecording('7035799967840714755');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class,$result);
    }
    //授权录制文件
    public function testPermissionGetRecording(){
        $result = $this->getUser()->meetings->permissionRecording('7035799967840714755',[
            'permission_objects'=>[[
                'id'=>'ou_81e9204daf2562dd7b8924f0fd24748e','type'=>1,'permission'=>1
            ]]
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class,$result);
    }
}