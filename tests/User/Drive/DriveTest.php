<?php

namespace EasyFeishu\Tests\User\Im;

use EasyFeishu\Tests\User\UserTest;
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
        $file = __DIR__.'/stubs/video.mp4';
        $block_size = 4194304;
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
        dump($block_info);
        $fp = fopen($file, "rb");
        foreach ($block_info as $key => $bi) {
            $handle = fopen($bi['file'], "wb");
            fwrite($handle, fread($fp, $bi['size']));
            $result = $this->getUser()->drive->uploadPart($bi['file'], [
                'size' => $bi['size'],
                'upload_id' => '7052289685745483804',
                'seq' => $key,
            ]);
            dump($result->toArray());
            fclose($handle);
            unset($handle);
        }
        fclose($fp);
        unset($fp);
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testUploadFinish()
    {
        $result = $this->getUser()->drive->uploadFinish([
            'upload_id' => '7052289685745483804',
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
}
