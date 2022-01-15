<?php

namespace EasyFeishu\Tests\User\Im;

use EasyFeishu\Tests\User\UserTest;
use GuzzleHttp\Client;
use Mayunfeng\Supports\Collection;

class DriveTest extends UserTest
{
    // 上传文件
    public function testUploadAll()
    {
        $file = __DIR__.'/stubs/test.txt';
        $result = $this->getUser()->drive->uploadAll($file, [
            'file_name' => 'test.txt',
            'parent_type' => 'explorer',
            'parent_node' => 'fldcnPbKnQ3iCdcprYMdAXPUDQc',
            'size' => 20,
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    // 分片上传文件（预上传）
    public function testUploadPrepare()
    {
        $result = $this->getUser()->drive->uploadPrepare([
            'file_name' => 'video.mp4',
            'parent_type' => 'explorer',
            'parent_node' => 'fldcnPbKnQ3iCdcprYMdAXPUDQc',
            'size' => 21559024,
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    // 分片上传文件（上传分片）
    public function testUploadPart()
    {
        $file = __DIR__.'/stubs/1642071576.3708优矩互动公司介绍PPT 2019.12.23.pptx';
        $block_size = 4194304;
        $block_info = array();
        $size = filesize($file);
        $i = 0;
        while ($size > 0) {
            $block_info[] = array(
                'size' => ($size >= $block_size ? $block_size : $size),
                'file' => str_replace('.txt', '', $file).'_'.($i++),
            );
            $size -= $block_size;
        }
//        dump($block_info);
        $fp = fopen($file, "rb");
        foreach ($block_info as $key => $bi) {
            $handle = fopen($bi['file'], "wb");
            fwrite($handle, fread($fp, $bi['size']));

            $multipart[] = [
                'name'     => 'file',
                'contents' => fopen($bi['file'], 'r'),
            ];

            foreach (['size' => $bi['size'], 'upload_id' => '1', 'seq' => $key,] as $name => $contents) {
                $multipart[] = compact('name', 'contents');
            }

            $result =(new Client())->request('post','http://180.169.228.166:9090/api/v1/file/upload_part',[
                'multipart' => $multipart,
                'headers' => ['authorization' => 'Bearer u-pfgXZOWFcTouVK9vn6FOGa']
            ]);
            dump($result);

//            $result = $this->getUser()->drive->uploadPart($bi['file'], [
//                'size' => $bi['size'],
//                'upload_id' => '7052306916155883523',
//                'seq' => $key,
//            ]);
//            dump($result->toArray());
            fclose($handle);
            unset($handle);
//            unlink($bi['file']);
        }
        fclose($fp);
        unset($fp);
//        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testUploadFinish()
    {
        $result = $this->getUser()->drive->uploadFinish([
            'upload_id' => '7052306916155883523',
            'block_num' => 6,
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }


    function file_split($file, $block_size = 10485760 / 5)
    {
        $block_info = array();
        $size = filesize($file);
        $i = 0;
        while ($size > 0) {
            $block_info[] = array(
                'size' => ($size >= $block_size ? $block_size : $size),
                'file' => str_replace('.txt', '', $file).'.'.($i++).'.txt',
            );
            $size -= $block_size;
        }
        $fp = fopen($file, "rb");
        foreach ($block_info as $bi) {
            $handle = fopen($bi['file'], "wb");
            fwrite($handle, fread($fp, $bi['size']));
            fclose($handle);
            unset($handle);
        }
        fclose($fp);
        unset($fp);
    }


    public function testFolderCreate()
    {
        $result = $this->getUser()->drive->folderCreate('fldcnPbKnQ3iCdcprYMdAXPUDQc', 'test');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testRootFolderMeta()
    {
        $result = $this->getUser()->drive->rootFolderMeta();
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testFolderMeta()
    {
        $result = $this->getUser()->drive->folderMeta('nodcn5JY6Bol14CKbjRDyAlnnpc');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testFolderChildren()
    {
        $result = $this->getUser()->drive->folderChildren('nodcn5JY6Bol14CKbjRDyAlnnpc');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

}
