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
        $file = __DIR__.'/stubs/video.mp4';
        $result = $this->getUser()->drive->uploadPrepare($file, [
            'file_name' => 'video.mp4',
            'parent_type' => 'explorer',
            'parent_node' => 'fldcnPbKnQ3iCdcprYMdAXPUDQc',
            'size' => 21559024,
        ]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
}
