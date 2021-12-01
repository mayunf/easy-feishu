<?php


namespace EasyFeishu\Tests\User\Im;

use Mayunfeng\Supports\Collection;
use EasyFeishu\Tests\User\UserTest;
class GroupTest extends UserTest
{
    //获取群信息
    public function testGetChats(){
        $result = $this->getUser()->group->getChats('oc_15295b6e8fdcb6ded2ebbaed500c7efe');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //更新群信息
    public function testPutChats(){
        $result = $this->getUser()->group->putChats('oc_15295b6e8fdcb6ded2ebbaed500c7efe',[
            'name'=>'修改群用户操作'
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //解散群
    public function testDeleteChats(){
        $result = $this->getUser()->group->deleteChats('oc_874990b2a2d0af673a1eac82cb86e858');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //拉人或者机器人入群
    public function testPostChatsMembers(){
        $result = $this->getUser()->group->postChatsMembers('oc_15295b6e8fdcb6ded2ebbaed500c7efe',[
            'id_list' => ['ou_81e9204daf2562dd7b8924f0fd24748e']
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //将人或者机器人移出群聊
    public function testDeleteChatsMembers(){
        $result = $this->getUser()->group->deleteChatsMembers('oc_15295b6e8fdcb6ded2ebbaed500c7efe',[
            'id_list' => ['ou_81e9204daf2562dd7b8924f0fd24748e']
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //主动加入群聊
    public function testPatchChatsJoin(){
        $result = $this->getUser()->group->patchChatsJoin('oc_15295b6e8fdcb6ded2ebbaed500c7efe');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //获取群成员列表
    public function testGetChatsMembers(){
        $result = $this->getUser()->group->getChatsMembers('oc_15295b6e8fdcb6ded2ebbaed500c7efe');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //获取用户或者机器人所在的群
    public function testBotChats(){
        $result = $this->getUser()->group->botChats();
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //搜索对用户或机器人可见的群列表
    public function testSearchChats(){
        $result = $this->getUser()->group->searchChats(['query'=>'A']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //判断当前用户是否在群里
    public function testIsChats(){
        $result = $this->getUser()->group->isChats('oc_15295b6e8fdcb6ded2ebbaed500c7efe');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //获取群公告信息
    public function testGetAnnouncement(){
        $result = $this->getUser()->group->getAnnouncement('oc_15295b6e8fdcb6ded2ebbaed500c7efe');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //更新群公告
    public function testPatchAnnouncement(){
        $result = $this->getUser()->group->patchAnnouncement('oc_15295b6e8fdcb6ded2ebbaed500c7efe',['revision'=>'1','requests'=>['title']]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }


}