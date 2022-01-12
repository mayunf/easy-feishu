<?php


namespace EasyFeishu\User\Drive;


use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class Drive extends AbstractAPI
{
    const API_POST_FILES_UPLOAD_ALL = 'https://open.feishu.cn/open-apis/drive/v1/files/upload_all';
    const API_POST_FILES_UPLOAD_PREPARE = 'https://open.feishu.cn/open-apis/drive/v1/files/upload_prepare';
    const API_POST_FILES_UPLOAD_PART = 'https://open.feishu.cn/open-apis/drive/v1/files/upload_part';
    const API_POST_FILES_UPLOAD_FINISH = 'https://open.feishu.cn/open-apis/drive/v1/files/upload_finish';

    /**
     * 上传文件.
     *
     * @param string   $path     文件路径
     * @param  array  $from     额外参数
     *
     * @return Collection
     */
    public function uploadAll(string $path, array $from): Collection
    {
        return $this->parseJSON('upload', [
            self::API_POST_FILES_UPLOAD_ALL,
            ['file' => $path],
            $from,
        ]);
    }

    /**
     * 分片上传文件（预上传）
     * @param string   $path     文件路径
     * @param  array  $from     额外参数
     * @return Collection
     */
    public function uploadPrepare(string $path, array $from): Collection
    {
        return $this->parseJSON('upload', [
            self::API_POST_FILES_UPLOAD_PREPARE,
            ['file' => $path],
            $from,
        ]);
    }

}