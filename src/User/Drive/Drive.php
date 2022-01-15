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

    const API_POST_FOLDER_CREATE = 'https://open.feishu.cn/open-apis/drive/explorer/v2/folder/';
    const API_GET_ROOT_FOLDER_META = 'https://open.feishu.cn/open-apis/drive/explorer/v2/root_folder/meta';
    const API_GET_FOLDER_META = 'https://open.feishu.cn/open-apis/drive/explorer/v2/folder/%s/meta';
    const API_GET_FOLDER_CHILDREN = 'https://open.feishu.cn/open-apis/drive/explorer/v2/folder/%s/children';


    /**
     * 上传文件.
     *
     * @param  string  $path  文件路径
     * @param  array  $from  额外参数
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
     * @param  array  $params  参数
     * @return Collection
     */
    public function uploadPrepare(array $params = []): Collection
    {
        return $this->parseJSON('post', [
            self::API_POST_FILES_UPLOAD_PREPARE,
            $params,
        ]);
    }

    /**
     * 分片上传文件（上传分片）
     * @param  string  $path
     * @param  array  $from
     * @return Collection
     */
    public function uploadPart(string $path, array $from): Collection
    {
        return $this->parseJSON('upload', [
            self::API_POST_FILES_UPLOAD_PART,
            ['file' => $path],
            $from,
        ]);
    }

    /**
     * 分片上传文件（完成上传）
     * @param  array  $params  参数
     * @return Collection
     */
    public function uploadFinish(array $params = []): Collection
    {
        return $this->parseJSON('post', [
            self::API_POST_FILES_UPLOAD_FINISH,
            $params,
        ]);
    }


    /**
     * 根据 folderToken 在该 folder 下创建文件夹
     * @param  string  $folder  token
     * @param  string  $title  title
     * @return Collection
     */
    public function folderCreate(string $folder, string $title): Collection
    {
        return $this->parseJSON('post', [
            self::API_POST_FOLDER_CREATE . $folder,
            compact('title')
        ]);
    }
    /**
     * 获取我的空间（root folder）元信息
     * @return Collection
     */
    public function rootFolderMeta(): Collection
    {
        return $this->parseJSON('get', [
            self::API_GET_ROOT_FOLDER_META
        ]);
    }
    /**
     * 获取文件夹元信息
     * @param  string  $folder  token
     * @return Collection
     */
    public function folderMeta(string $folder): Collection
    {
        return $this->parseJSON('get', [
            sprintf(self::API_GET_FOLDER_META,$folder)
        ]);
    }
    /**
     * 获取文件夹元信息
     * @param  string  $folder  token
     * @param  array  $types  types
     * @return Collection
     */
    public function folderChildren(string $folder, array $types = ['doc','sheet','file','bitable','folder']): Collection
    {

        return $this->parseJSON('get', [
            sprintf(self::API_GET_FOLDER_CHILDREN,$folder),
            compact('types')
        ]);
    }

}