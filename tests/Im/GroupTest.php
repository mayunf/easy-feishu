<?php


namespace EasyFeishu\Tests\Im;

use EasyFeishu\Tests\TestCase;
use Mayunfeng\Supports\Collection;
class GroupTest extends TestCase
{
    //创建群
    public function testCreateChats(){
        $result = $this->getInstance()->group->createChats(['name'=>'测试接口群1','description'=>'测试描述','chat_type'=>'public']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //获取群信息
    public function testGetChats(){
        $result = $this->getInstance()->group->getChats('oc_ba3e823373456576174b26378946f8e9');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //更新群信息
    public function testPutChats(){
        $result = $this->getInstance()->group->putChats('oc_ba3e823373456576174b26378946f8e9',[
            'name'=>'修改群3位公共','chat_type'=>'public'
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //解散群
    public function testDeleteChats(){
        $result = $this->getInstance()->group->deleteChats('oc_453ad8d4e04f3d1eacf8451f40aa71d8');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //拉人或者机器人入群
    public function testPostChatsMembers(){
        $result = $this->getInstance()->group->postChatsMembers('oc_15295b6e8fdcb6ded2ebbaed500c7efe',[
            'id_list' => ['ou_37a83aaf1fae3af69be3b89b15231782']
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //将人或者机器人移出群聊
    public function testDeleteChatsMembers(){
        $result = $this->getInstance()->group->deleteChatsMembers('oc_ba3e823373456576174b26378946f8e9',[
            'id_list' => ['ou_37a83aaf1fae3af69be3b89b15231782']
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //主动加入群聊
    public function testPatchChatsJoin(){
        $result = $this->getInstance()->group->patchChatsJoin('oc_15295b6e8fdcb6ded2ebbaed500c7efe');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //获取群成员列表
    public function testGetChatsMembers(){
        $result = $this->getInstance()->group->getChatsMembers('oc_15295b6e8fdcb6ded2ebbaed500c7efe');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //获取用户或者机器人所在的群
    public function testBotChats(){
        $result = $this->getInstance()->group->botChats();
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //搜索对用户或机器人可见的群列表
    public function testSearchChats(){
        $result = $this->getInstance()->group->searchChats(['query'=>'A']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //判断当前用户是否在群里
    public function testIsChats(){
        $result = $this->getInstance()->group->isChats('oc_15295b6e8fdcb6ded2ebbaed500c7efe');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //获取群公告信息
    public function testGetAnnouncement(){
        $result = $this->getInstance()->group->getAnnouncement('oc_15295b6e8fdcb6ded2ebbaed500c7efe');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
    //更新群公告
    public function testPatchAnnouncement(){
        $result = $this->getInstance()->group->patchAnnouncement('oc_ba3e823373456576174b26378946f8e9',['revision'=>'1','requests'=>['title']]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }


}