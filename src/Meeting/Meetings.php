<?php

namespace EasyFeishu\Meeting;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class Meetings extends AbstractAPI
{
    const API_GET_MEETINGS_LIST = 'https://open.feishu.cn/open-apis/vc/v1/meetings/list_by_no';
    const API_PATCH_MEETINGS_HOST = 'https://open.feishu.cn/open-apis/vc/v1/meetings/';
    const API_PATCH_MEETINGS_INVITE = 'https://open.feishu.cn/open-apis/vc/v1/meetings/';
    const API_GET_REPORTS = 'https://open.feishu.cn/open-apis/vc/v1/reports/get_daily';
    const API_GET_REPORTS_TOP_USER = 'https://open.feishu.cn/open-apis/vc/v1/reports/get_top_user';
    const API_GET_ROOM_CONFIG = 'https://open.feishu.cn/open-apis/vc/v1/room_configs/query';
    const API_POST_ROOM_CONFIG = 'https://open.feishu.cn/open-apis/vc/v1/room_configs/set';

    /**
     * 获取会议详情.
     *
     * @param string $meetingId 会议室id
     * @param array  $query     查询参数
     *
     * @return Collection
     */
    public function getMeetings(string $meetingId, array $query = [])
    {
        return $this->parseJSON('get', [
            self::API_PATCH_MEETINGS_INVITE.$meetingId,
            $query,
        ]);
    }

    /**
     * 获取与会议号相关联的会议列表.
     *
     * @param array $query 查询参数
     *
     * @return Collection
     */
    public function getMeetingsListBy(array $query)
    {
        return $this->parseJSON('get', [
            self::API_GET_MEETINGS_LIST,
            $query,
        ]);
    }

    /**
     * 设置主持人.
     *
     * @param string $reservesId 会议室id
     * @param array  $params     请求体
     * @param array  $query      查询参数
     *
     * @return Collection
     */
    public function meetingSetHost(string $reservesId, array $params, array $query = ['user_id_type'=>'open_id'])
    {
        return $this->parseJSON('PATCH', [
            self::API_PATCH_MEETINGS_HOST.$reservesId.'/set_host?'.http_build_query($query),
            $params,
        ]);
    }

    /**
     * 移除参会人.
     *
     * @param string $meetingId 会议id
     * @param array  $params    请求体
     * @param array  $query     查询参数
     *
     * @return Collection
     */
    public function meetingsKickout(string $meetingId, array $params, array $query = ['user_id_type'=>'open_id'])
    {
        return $this->parseJSON('post', [
            self::API_PATCH_MEETINGS_HOST.$meetingId.'/kickout?'.http_build_query($query),
            $params,
        ]);
    }

    /**
     * 获取会议报告.
     *
     * @param array $query 查询参数
     *
     * @return Collection
     */
    public function getReportsDaily(array $query)
    {
        return $this->parseJSON('get', [
            self::API_GET_REPORTS,
            $query,
        ]);
    }

    /**
     * 获取top用户列表.
     *
     * @param array $query 查询参数
     *
     * @return Collection
     */
    public function getReportsTopUser(array $query)
    {
        return $this->parseJSON('get', [
            self::API_GET_REPORTS_TOP_USER,
            $query,
        ]);
    }

    /**
     * 查询会议室配置.
     *
     * @param array $query 查询参数
     *
     * @return Collection
     */
    public function getRoomConfig(array $query)
    {
        return $this->parseJSON('get', [
            self::API_GET_ROOM_CONFIG,
            $query,
        ]);
    }

    /**
     * 设置会议室配置.
     *
     * @param array $params 请求头
     *
     * @return Collection
     */
    public function setRoomConfig(array $params)
    {
        return $this->parseJSON('post', [
            self::API_POST_ROOM_CONFIG,
            $params,
        ]);
    }
}
