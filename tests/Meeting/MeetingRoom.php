<?php


namespace EasyFeishu\Tests\Meeting;

use Mayunfeng\Supports\Collection;
use EasyFeishu\Tests\TestCase;
class MeetingRoom extends TestCase
{
    public function testMeetingSummary(){
        $result = $this->getInstance()->meetingRoom->meetingSummary([
            'EventUids'=>[
                ['uid'=>'86fe8279-93fa-4aab-86c3-2cb63c98bae5_0','original_time'=>0]
            ]
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testBuildingList(){
        $result = $this->getInstance()->meetingRoom->buildingList(['page_size'=>10]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testBuildingBatch(){
        $result = $this->getInstance()->meetingRoom->buildingBatch(['building_ids'=>'omb_6b80285824f8b0fcc972df0b1541be39']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testRoomList(){
        $result = $this->getInstance()->meetingRoom->roomList(['building_id'=>'omb_6b80285824f8b0fcc972df0b1541be39']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testRoomLists(){
        $result = $this->getInstance()->meetingRoom->roomLists(['room_ids'=>'omm_022bf523bc8d58c3328d93aaa7f92643']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testRoomFreebusy(){
        $result = $this->getInstance()->meetingRoom->roomFreebusy([
            'room_ids' => 'omm_022bf523bc8d58c3328d93aaa7f92643',
            'time_min' => '2021-10-10T00:00:00Z','time_max'=>'2022-10-10T00:00:00Z'
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }




}