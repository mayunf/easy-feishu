<?php

namespace EasyFeishu\Tests\Im;

use EasyFeishu\Im\Im;
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
        $result = $this->getInstance()->im->replyMessage('om_2bec91ba306b5635b8465b88dcc0500c', [
            'content'  => '{"text":"我是回复消息"}',
            'msg_type' => 'text',
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testDelMessage()
    {
        $result = $this->getInstance()->im->delMessage('om_7c16476b059d840fd72484cb43c38e83');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testReadUsers()
    {//有bug
        $result = $this->getInstance()->im->readUsers(
            'om_09e5f8f0c2a6b38ff824ddcd9607774d',
            ['user_id_type' => 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetMessages()
    {
        $result = $this->getInstance()->im->getMessages([
            'container_id_type' => 'chat', 'container_id' => 'oc_200da98193e097fea932a4644d80c47c',
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetResources()
    {
        $result = $this->getInstance()->im->getResources(
            'om_04a8f4ff978844bba2b8a52c5046f1fc',
            'file_456a92d6-c6ea-4de4-ac3f-7afcf44ac78g',
            ['type' => 'file']
        );
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
            ['user_id_list' => ['ou_37a83aaf1fae3af69be3b89b15231782']],
            ['user_id_type' => 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testUrgentSms()
    {
        $result = $this->getInstance()->im->urgentSms(
            'om_4efbdbdff61de0fae2eac25f68df31d2',
            ['user_id_list' => ['ou_37a83aaf1fae3af69be3b89b15231782']],
            ['user_id_type' => 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testUrgentPhone()
    {
        $result = $this->getInstance()->im->urgentPhone(
            'om_4efbdbdff61de0fae2eac25f68df31d2',
            ['user_id_list' => ['ou_37a83aaf1fae3af69be3b89b15231782']],
            ['user_id_type' => 'open_id']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    /**
     * 上传图片.
     */
    public function testUploadImages()
    {
        $file = __DIR__.'/stubs/test.jpg';
        $result = $this->getInstance()->im->uploadImage('message', $file);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    /**
     * 下载图片.
     */
    public function testDownloadImages()
    {
        $result = $this->getInstance()->im->downloadImage('img_v2_405583ac-eef0-4586-b7d5-df3dd51719cg');
        $this->assertIsString($result);
    }

    /**
     * 获取文件流
     */
    public function testGetStream()
    {
        $result = $this->getInstance()->im->getStream(Im::API_GET_IMAGES_BY_KEY.'img_v2_405583ac-eef0-4586-b7d5-df3dd51719cg');
        $this->assertIsString($result);
    }

    /**
     * 上传文件.
     */
    public function testUploadFiles()
    {
        $file = __DIR__.'/stubs/test.mp4';
        $result = $this->getInstance()->im->uploadFile('mp4', $file, 'test.mp4', 3000);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    /**
     * 下载文件.
     */
    public function testDownloadFiles()
    {
        $result = $this->getInstance()->im->downloadFile('file_v2_0ff8cdba-9bf9-41f7-914a-9c088ba72afg');
        $this->assertIsString($result);
    }

    /**
     * 保存文件到本地.
     */
    public function testDownload()
    {
        $result = $this->getInstance()->im->download(
            Im::API_GET_FILES_BY_KEY.'file_v2_0ff8cdba-9bf9-41f7-914a-9c088ba72afg',
            __DIR__,
            'test'
        );
        @unlink(__DIR__.DIRECTORY_SEPARATOR.$result);
        $this->assertIsString($result);
    }

    public function testPatchMessages()
    {
        $result = $this->getInstance()->im->patchMessages(
            'om_bc792dc03c70a470def0e089172b2549',
            ['content'=> '{"text":"我是测试消息1"}']
        );
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
}
