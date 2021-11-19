<?php

namespace EasyFeishu\Tests\Im;

use EasyFeishu\Tests\TestCase;
use Mayunfeng\Supports\Collection;

class ImTest extends TestCase
{
    public function testPostMessages()
    {
        $result = $this->getInstance()->im->postMessages([
            'content'    => '{"text":"我是测试消息"}',
            'msg_type'   => 'text',
            'receive_id' => 'ou_37a83aaf1fae3af69be3b89b15231782',
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testReplyMessage()
    {
        $result = $this->getInstance()->im->replyMessage('om_04a8f4ff978844bba2b8a52c5046f1fc', [
            'content'  => '{"text":"我是回复消息"}',
            'msg_type' => 'text',
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testDelMessage()
    {
        $result = $this->getInstance()->im->delMessage('om_04a8f4ff978844bba2b8a52c5046f1fc');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testReadUsers()
    {//有bug
        $result = $this->getInstance()->im->readUsers('om_09e5f8f0c2a6b38ff824ddcd9607774d', ['user_id_type'=>'open_id']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetMessages()
    {
        $result = $this->getInstance()->im->getMessages(['container_id_type'=>'chat', 'container_id'=>'oc_200da98193e097fea932a4644d80c47c']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetResources()
    {
        $result = $this->getInstance()->im->getResources('om_04a8f4ff978844bba2b8a52c5046f1fc', 'file_456a92d6-c6ea-4de4-ac3f-7afcf44ac78g', ['type'=>'file']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetMessagesInfo()
    {
        $result = $this->getInstance()->im->getMessagesInfo('om_04a8f4ff978844bba2b8a52c5046f1fc');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testUrgentApp()
    {
        $result = $this->getInstance()->im->urgentApp(
            'om_4efbdbdff61de0fae2eac25f68df31d2',
            ['user_id_list'=> ['ou_37a83aaf1fae3af69be3b89b15231782']],
            ['user_id_type'=> 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testUrgentSms()
    {
        $result = $this->getInstance()->im->urgentSms(
            'om_4efbdbdff61de0fae2eac25f68df31d2',
            ['user_id_list'=> ['ou_37a83aaf1fae3af69be3b89b15231782']],
            ['user_id_type'=> 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testUrgentPhone()
    {
        $result = $this->getInstance()->im->urgentPhone(
            'om_4efbdbdff61de0fae2eac25f68df31d2',
            ['user_id_list'=> ['ou_37a83aaf1fae3af69be3b89b15231782']],
            ['user_id_type'=> 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
}
