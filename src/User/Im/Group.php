<?php


namespace EasyFeishu\User\Im;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;
class Group extends AbstractAPI
{
    const API_POST_IM_CHATS = "https://open.feishu.cn/open-apis/im/v1/chats";
    const API_GET_IM_CHATS = "https://open.feishu.cn/open-apis/im/v1/chats/";
    const API_PUT_IM_CHATS = "https://open.feishu.cn/open-apis/im/v1/chats/";
    const API_DELETE_IM_CHATS = "https://open.feishu.cn/open-apis/im/v1/chats/";

    const API_POST_IM_CHATS_MEMBERS = "https://open.feishu.cn/open-apis/im/v1/chats/";
    const API_DELETE_IM_CHATS_MEMBERS = "https://open.feishu.cn/open-apis/im/v1/chats/";
    const API_PATCH_IM_CHATS_JOIN = "https://open.feishu.cn/open-apis/im/v1/chats/";
    const API_GET_IM_CHATS_MEMBERS = "https://open.feishu.cn/open-apis/im/v1/chats/";
    const API_GET_IM_CHATS_SEARCH = "https://open.feishu.cn/open-apis/im/v1/chats/search";
    const API_GET_IM_CHATS_IS = "https://open.feishu.cn/open-apis/im/v1/chats/";
    const API_GET_CHATS_ANNOUNCEMENT = "https://open.feishu.cn/open-apis/im/v1/chats/";

    /**
     * 获取群信息
     *
     * @param string $chatsId 请求体
     *
     * @return Collection
     */
    public function getChats(string $chatsId){
        return $this->parseJSON('get', [
            self::API_GET_IM_CHATS.$chatsId,
        ]);
    }

    /**
     * 更新群信息
     * @param string $chatsId 群id
     * @param array $params 请求体
     * @param array $query  查询参数
     *
     * @return Collection
     */
    public function putChats(string $chatsId, array $params = [], array $query = ['user_id_type' => 'open_id']): Collection
    {
        return $this->parseJSON('put', [
            self::API_PUT_IM_CHATS.$chatsId.'?'.http_build_query($query),
            $params,
        ]);
    }

    /**
     * 解散群
     *
     * @param string $chatsId 请求体
     *
     * @return Collection
     */
    public function deleteChats(string $chatsId){
        return $this->parseJSON('delete', [
            self::API_DELETE_IM_CHATS.$chatsId,
        ]);
    }

    /**
     * 将用户或机器人拉入群聊
     * @param string $chatsId 群id
     * @param array $params 请求体
     * @param array $query  查询参数
     *
     * @return Collection
     */
    public function postChatsMembers(string $chatsId, array $params = [], array $query = ['member_id_type' => 'open_id']): Collection
    {
        return $this->parseJSON('post', [
            self::API_POST_IM_CHATS_MEMBERS.$chatsId.'/members?'.http_build_query($query),
            $params,
        ]);
    }

    /**
     * 将用户或机器人移出群聊
     * @param string $chatsId 群id
     * @param array $params 请求体
     * @param array $query  查询参数
     *
     * @return Collection
     */
    public function deleteChatsMembers(string $chatsId, array $params = [], array $query = ['member_id_type' => 'open_id']): Collection
    {
        return $this->parseJSON('DELETE', [
            self::API_DELETE_IM_CHATS_MEMBERS.$chatsId.'/members?'.http_build_query($query),
            $params,
        ]);
    }

    /**
     * 主动加入群聊
     * @param string $chatsId 群id
     *
     * @return Collection
     */
    public function patchChatsJoin(string $chatsId){
        return $this->parseJSON('patch', [
            self::API_PATCH_IM_CHATS_JOIN.$chatsId.'/members/me_join'
        ]);
    }

    /**
     * 获取群成员列表
     * @param string $chatsId 群id
     * @param array $query  查询参数
     * @return Collection
     */
    public function getChatsMembers(string $chatsId,array $query = ['member_id_type'=>'open_id']){
        return $this->parseJSON('get',[
            self::API_GET_IM_CHATS_MEMBERS.$chatsId.'/members'
        ]);
    }

    /**
     * 获取用户或者机器人所在的群列表
     * @param array $query  查询参数
     * @return Collection
     */
    public function botChats(array $query = ['user_id_type'=>'open_id']){
        return $this->parseJSON('get',[
            self::API_GET_IM_CHATS.'?'.http_build_query($query),
        ]);
    }

    /**
     * 搜索对用户或机器人可见的群列表
     * @param array $query  查询参数
     * @return Collection
     */
    public function searchChats(array $query = ['user_id_type'=>'open_id']){
        return $this->parseJSON('get',[
            self::API_GET_IM_CHATS_SEARCH,
            $query
        ]);
    }

    /**
     * 判断用户或机器人是否在群里
     * @param string $chatsId 群id
     * @return Collection
     */
    public function isChats(string $chatsId){
        return $this->parseJSON('get',[
            self::API_GET_IM_CHATS_IS.$chatsId.'/members/is_in_chat'
        ]);
    }

    /**
     * 获取群公告信息
     * @param string $chatsId 群id
     * @param array $query  查询参数
     * @return Collection
     */
    public function getAnnouncement(string $chatsId, array $query = ['user_id_type'=>'open_id']){
        return $this->parseJSON('get',[
            self::API_GET_CHATS_ANNOUNCEMENT.$chatsId.'/announcement',
            $query
        ]);
    }

    /**
     * 获取群成员列表
     * @param string $chatsId 群id
     * @param array $param  查询参数
     * @return Collection
     */
    public function patchAnnouncement(string $chatsId, array $param){
        return $this->parseJSON('patch',[
            self::API_GET_CHATS_ANNOUNCEMENT.$chatsId.'/announcement',
            $param
        ]);
    }
}