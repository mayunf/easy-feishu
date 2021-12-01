<?php

namespace EasyFeishu\User\Meetings;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class Meetings extends AbstractAPI
{
    const API_GET_MEETINGS = 'https://open.feishu.cn/open-apis/vc/v1/meetings/';
    const API_GET_MEETINGS_LIST = 'https://open.feishu.cn/open-apis/vc/v1/meetings/list_by_no';
    const API_PATCH_MEETINGS_HOST = 'https://open.feishu.cn/open-apis/vc/v1/meetings/';
    const API_PATCH_MEETINGS_INVITE = 'https://open.feishu.cn/open-apis/vc/v1/meetings/';
    const API_PATCH_RECORDING_START = 'https://open.feishu.cn/open-apis/vc/v1/meetings/';

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
     * 邀请参会人.
     *
     * @param string $reservesId 会议室id
     * @param array  $params     请求体
     * @param array  $query      查询参数
     *
     * @return Collection
     */
    public function patchInvite(string $reservesId, array $params, array $query = ['user_id_type'=>'open_id'])
    {
        return $this->parseJSON('patch', [
            self::API_PATCH_MEETINGS_INVITE.$reservesId.'/invite?'.http_build_query($query),
            $params,
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
     * 结束会议.
     *
     * @param string $meetingId 会议室id
     *
     * @return Collection
     */
    public function meetingsEnd(string $meetingId)
    {
        return $this->parseJSON('PATCH', [
            self::API_PATCH_MEETINGS_HOST.$meetingId.'/end',
        ]);
    }

    /**
     * 开始录制.
     *
     * @param string $meetingId 会议室id
     *
     * @return Collection
     */
    public function recordingStart(string $meetingId)
    {
        return $this->parseJSON('patch', [
            self::API_PATCH_RECORDING_START.$meetingId.'/recording/start',
            ['timezone' => 8],
        ]);
    }

    /**
     * 结束录制.
     *
     * @param string $meetingId 会议室id
     *
     * @return Collection
     */
    public function recordingStop(string $meetingId)
    {
        return $this->parseJSON('patch', [
            self::API_PATCH_RECORDING_START.$meetingId.'/recording/stop',
        ]);
    }

    /**
     * 获取录制文件.
     *
     * @param string $meetingId 会议室id
     *
     * @return Collection
     */
    public function getRecording(string $meetingId)
    {
        return $this->parseJSON('get', [
            self::API_PATCH_RECORDING_START.$meetingId.'/recording',
        ]);
    }

    /**
     * 授权录制文件.
     *
     * @param string $meetingId 会议室id
     * @param array  $params    请求体
     * @param array  $query     查询参数
     *
     * @return Collection
     */
    public function permissionRecording(string $meetingId, array $params, array $query = ['user_id_type'=>'open_id'])
    {
        return $this->parseJSON('patch', [
            self::API_PATCH_RECORDING_START.$meetingId.'/recording/set_permission?'.http_build_query($query),
            $params,
        ]);
    }
}
