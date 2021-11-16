<?php

namespace EasyFeishu\Im;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class Im extends AbstractAPI
{
    const API_POST_IM_MESSAGES = 'https://open.feishu.cn/open-apis/im/v1/messages';
    const API_POST_IM_MESSAGES_REPLY = 'https://open.feishu.cn/open-apis/im/v1/messages/';
    const API_DELETE_MESSAGES = 'https://open.feishu.cn/open-apis/im/v1/messages/';
    const API_GET_MESSAGES_READ_USERS = 'https://open.feishu.cn/open-apis/im/v1/messages/';

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
    public function replyMessage(string $messageId, array $params, array $query = [])
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
    public function delMessage($messageId)
    {
        return $this->parseJSON('delete', [
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
    public function readUsers(string $messageId, array $params = [])
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
    public function getResources(string $messageId, string $fileKey, array $params)
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
    public function getMessagesInfo($messageId)
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
    public function urgentApp(string $messageId, array $params = [], array $query = [])
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
    public function urgentSms(string $messageId, array $params = [], array $query = [])
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
    public function urgentPhone(string $messageId, array $params = [], array $query = [])
    {
        return $this->parseJSON('patch', [
            self::API_GET_MESSAGES_READ_USERS.$messageId.'/urgent_phone?'.http_build_query($query),
            $params,
        ]);
    }
}
