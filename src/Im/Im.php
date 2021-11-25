<?php

namespace EasyFeishu\Im;

use EasyFeishu\Core\AbstractAPI;
use EasyFeishu\Utils\File;
use Mayunfeng\Supports\Collection;

class Im extends AbstractAPI
{
    const API_POST_IM_MESSAGES = 'https://open.feishu.cn/open-apis/im/v1/messages';
    const API_POST_IM_MESSAGES_REPLY = 'https://open.feishu.cn/open-apis/im/v1/messages/';
    const API_DELETE_MESSAGES = 'https://open.feishu.cn/open-apis/im/v1/messages/';
    const API_GET_MESSAGES_READ_USERS = 'https://open.feishu.cn/open-apis/im/v1/messages/';
    const API_POST_IMAGES = 'https://open.feishu.cn/open-apis/im/v1/images';
    const API_GET_IMAGES_BY_KEY = 'https://open.feishu.cn/open-apis/im/v1/images/';
    const API_POST_FILES = 'https://open.feishu.cn/open-apis/im/v1/files';
    const API_GET_FILES_BY_KEY = 'https://open.feishu.cn/open-apis/im/v1/files/';

    const API_PATCH_MESSAGES = "https://open.feishu.cn/open-apis/im/v1/messages/";
    const API_POST_MESSAGES_UPDATE = "https://open.feishu.cn/open-apis/interactive/v1/card/update";
    const API_POST_EPHEMERAL_SEND = "https://open.feishu.cn/open-apis/ephemeral/v1/send";
    const API_POST_EPHEMERAL_DELETE = "https://open.feishu.cn/open-apis/ephemeral/v1/delete";

    /**
     * 发送消息.
     *
     * @param array $params 请求体
     * @param array $query  查询参数
     *
     * @return Collection
     */
    public function postMessages(array $params = [], array $query = ['receive_id_type' => 'open_id']): Collection
    {
        return $this->parseJSON('post', [
            self::API_POST_IM_MESSAGES.'?'.http_build_query($query),
            $params,
        ]);
    }

    /**
     * 发送消息.
     *
     * @param string $messageId 消息id
     * @param array  $params    请求体
     * @param array  $query     查询参数
     *
     * @return Collection
     */
    public function replyMessage(string $messageId, array $params, array $query = []): Collection
    {
        return $this->parseJSON('post', [
            self::API_POST_IM_MESSAGES_REPLY.$messageId.'/reply',
            $params,
        ]);
    }

    /**
     * 撤回消息.
     *
     * @param string $messageId 消息id
     *
     * @return Collection
     */
    public function delMessage($messageId): Collection
    {
        return $this->parseJSON('DELETE', [
            self::API_DELETE_MESSAGES.$messageId,
        ]);
    }

    /**
     * 查询已读信息.
     *
     * @param string $messageId 消息id
     * @param array  $params
     *
     * @return Collection
     */
    public function readUsers(string $messageId, array $params = []): Collection
    {
        return $this->parseJSON('get', [
            self::API_GET_MESSAGES_READ_USERS.$messageId.'/read_users?',
            $params,
        ]);
    }

    /**
     * 获取回话历史消息.
     *
     * @param array $query
     * @param array $params
     *
     * @return Collection
     */
    public function getMessages(array $params = [], array $query = []): Collection
    {
        return $this->parseJSON('get', [
            self::API_POST_IM_MESSAGES,
            $params,
        ]);
    }

    /**
     * 获取消息中的文件.
     *
     * @param string $messageId 消息id
     * @param string $fileKey   资源key
     * @param array  $params
     *
     * @return Collection
     */
    public function getResources(string $messageId, string $fileKey, array $params): Collection
    {
        return $this->parseJSON('get', [
            self::API_GET_MESSAGES_READ_USERS.$messageId.'/'.'resources/'.$fileKey,
            $params,
        ]);
    }

    /**
     * 获取指定消息内容.
     *
     * @param string $messageId 消息id
     *
     * @return Collection
     */
    public function getMessagesInfo($messageId): Collection
    {
        return $this->parseJSON('get', [
            self::API_GET_MESSAGES_READ_USERS.$messageId,
        ]);
    }

    /**
     * 发送应用内加急.
     *
     * @param string $messageId 消息id
     * @param array  $params    请求体
     * @param array  $query     查询参数
     *
     * @return Collection
     */
    public function urgentApp(string $messageId, array $params = [], array $query = []): Collection
    {
        return $this->parseJSON('patch', [
            self::API_GET_MESSAGES_READ_USERS.$messageId.'/urgent_app?'.http_build_query($query),
            $params,
        ]);
    }

    /**
     * 发送短信加急.
     *
     * @param string $messageId 消息id
     * @param array  $params    请求体
     * @param array  $query     查询参数
     *
     * @return Collection
     */
    public function urgentSms(string $messageId, array $params = [], array $query = []): Collection
    {
        return $this->parseJSON('patch', [
            self::API_GET_MESSAGES_READ_USERS.$messageId.'/urgent_sms?'.http_build_query($query),
            $params,
        ]);
    }

    /**
     * 发送电话加急.
     *
     * @param string $messageId 消息id
     * @param array  $params    请求体
     * @param array  $query     查询参数
     *
     * @return Collection
     */
    public function urgentPhone(string $messageId, array $params = [], array $query = []): Collection
    {
        return $this->parseJSON('patch', [
            self::API_GET_MESSAGES_READ_USERS.$messageId.'/urgent_phone?'.http_build_query($query),
            $params,
        ]);
    }

    /**
     * 上传图片.
     *
     * @param string $type 图片类型
     * @param string $path 图片路径
     *
     * @return Collection
     */
    public function uploadImage(string $type, string $path): Collection
    {
        return $this->parseJSON('upload', [
            self::API_POST_IMAGES,
            ['image'      => $path],
            ['image_type' => $type],
        ]);
    }

    /**
     * 下载图片.
     *
     * @param string $imageKey 图片key
     *
     * @return string 图片stream
     */
    public function downloadImage(string $imageKey): string
    {
        return $this->getStream(self::API_GET_IMAGES_BY_KEY.$imageKey);
    }

    /**
     * 上传文件.
     *
     * @param string   $FileType 文件类型
     * @param string   $path     文件路径
     * @param string   $fileName 文件名称
     * @param int|null $duration
     *
     * @return Collection
     */
    public function uploadFile(string $FileType, string $path, string $fileName, int $duration = null): Collection
    {
        $from = [
            'file_name' => $fileName,
            'file_type' => $FileType,
        ];
        if (!is_null($duration)) {
            $from['duration'] = $duration;
        }

        return $this->parseJSON('upload', [
            self::API_POST_FILES,
            ['file' => $path],
            $from,
        ]);
    }

    /**
     * 下载文件.
     *
     * @param string $fileKey 文件key
     *
     * @return string 文件stream
     */
    public function downloadFile(string $fileKey): string
    {
        return $this->getStream(self::API_GET_FILES_BY_KEY.$fileKey);
    }

    public function getStream(string $url): string
    {
        $response = $this->getHttp()->get($url);

        $response->getBody()->rewind();

        return $response->getBody()->getContents();
    }

    /**
     * 下载文件.
     *
     * @param string $url       下载地址
     * @param string $directory 要保存的路径
     * @param string $filename  保存的名字（不带后缀）
     *
     * @return string 文件名字
     */
    public function download(string $url, string $directory = '', string $filename = ''): string
    {
        $stream = $this->getStream($url);
        $filename .= File::getStreamExt($stream);
        file_put_contents($directory.DIRECTORY_SEPARATOR.$filename, $stream);

        return $filename;
    }

    /**
     * 更新应用发送的消息
     *
     * @param string $messageId 消息id
     * @param array  $params    请求体
     *
     * @return Collection
     */
    public function patchMessages(string $messageId,array $params){
        return $this->parseJSON('patch', [
            self::API_PATCH_MESSAGES.$messageId,
            $params,
        ]);
    }

    /**
     * 消息卡片延迟更新.
     *
     * @param array  $params    请求体
     *
     * @return Collection
     */
    public function cardUpdate(array $params){
        return $this->parseJSON('patch', [
            self::API_POST_MESSAGES_UPDATE,
            $params,
        ]);
    }

    /**
     * 发送「仅你可见」的临时消息
     *
     * @param array  $params    请求体
     *
     * @return Collection
     */
    public function sendEphemeral(array $params){
        return $this->parseJSON('post', [
            self::API_POST_EPHEMERAL_SEND,
            $params,
        ]);
    }

    /**
     * 删除「仅你可见」的临时消息
     *
     * @param array  $params    请求体
     *
     * @return Collection
     */
    public function deleteEphemeral(array $params){
        return $this->parseJSON('post', [
            self::API_POST_EPHEMERAL_DELETE,
            $params,
        ]);
    }


}
