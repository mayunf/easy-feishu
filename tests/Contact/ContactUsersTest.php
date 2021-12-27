<?php

namespace EasyFeishu\Tests\Contact;

use EasyFeishu\Tests\TestCase;
use Mayunfeng\Supports\Collection;

class ContactUsersTest extends TestCase
{
    public function testPostUsers()
    {
        $result = $this->getInstance()->contactUsers->postUsers(
            [
                'name'=> '测试接口用户2', 'mobile'=>'18888888881', 'department_ids'=>['od-93357125327c4f399413c8819e002294'],
                'city'=> '郑州', 'employee_type'=>1, '',
            ],
            ['user_id_type'=> 'open_id'],
        );
        dump($result);
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetUser()
    {
        $result = $this->getInstance()->contactUsers->getUser('ou_9ba85d0daec7a8898b18c558ebc0841d', ['user_id_type'=>'open_id']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetUsers()
    {
        $result = $this->getInstance()->contactUsers->getUsers(['user_id_type'=>'open_id', 'department_id'=>'0']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetUsersChildren(){
        $result = $this->getInstance()->contactUsers->getUsersChildren(['user_id_type'=>'open_id', 'department_id'=>0]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testPatchUsers()
    {
        $result = $this->getInstance()->contactUsers->patchUsers(
            'ou_37a83aaf1fae3af69be3b89b15231782',
            ['name'        => '李大山', 'email'=>'evshan@163.com'],
            ['user_id_type'=> 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testPutUsers()
    {
        $result = $this->getInstance()->contactUsers->putUsers(
            'ou_37a83aaf1fae3af69be3b89b15231782',
            ['name'        => '李大山', 'email'=>'evshan@163.com'],
            ['user_id_type'=> 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetBatchId()
    {
        $result = $this->getInstance()->contactUsers->getBarchId(
            ['mobiles'=>['+8618888888881']],
            ['user_id_type'=> 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testDelUser()
    {
        $result = $this->getInstance()->contactUsers->delUser(
            'ou_9ba85d0daec7a8898b18c558ebc0841d',
            [],
            ['user_id_type'=> 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetCustomAttrs()
    {
        $result = $this->getInstance()->contactUsers->getCustomAttrs();
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
}
