<?php

namespace EasyFeishu\Meeting;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class MeetingRoom extends AbstractAPI
{
    const API_POST_MEETING_ROOM_SUMMARY = 'https://open.feishu.cn/open-apis/meeting_room/summary/batch_get';
    const API_GET_MEETING_ROOM_BUILDING = 'https://open.feishu.cn/open-apis/meeting_room/building/list';
    const API_GET_MEETING_ROOM_BUILDING_GET = 'https://open.feishu.cn/open-apis/meeting_room/building/batch_get';
    const API_GET_MEETING_ROOM_LIST = 'https://open.feishu.cn/open-apis/meeting_room/room/list';
    const API_GET_MEETING_ROOM_ROOM = 'https://open.feishu.cn/open-apis/meeting_room/room/batch_get';
    const API_GET_MEETING_FREEBUSY = 'https://open.feishu.cn/open-apis/meeting_room/freebusy/batch_get';

    /**
     * 获取会议室主题.
     *
     * @param array $params 请求体
     *
     * @return Collection
     */
    public function meetingSummary($params)
    {
        return $this->parseJSON('post', [
            self::API_POST_MEETING_ROOM_SUMMARY,
            $params,
        ]);
    }

    /**
     * 获取建筑物列表.
     *
     * @param array $query 请求体
     *
     * @return Collection
     */
    public function buildingList(array $query)
    {
        return $this->parseJSON('get', [
            self::API_GET_MEETING_ROOM_BUILDING,
            $query,
        ]);
    }

    /**
     * 获取建筑物详情.
     *
     * @param array $query 请求体
     *
     * @return Collection
     */
    public function buildingBatch(array $query)
    {
        return $this->parseJSON('get', [
            self::API_GET_MEETING_ROOM_BUILDING_GET,
            $query,
        ]);
    }

    /**
     * 获取会议室列表.
     *
     * @param array $query 请求体
     *
     * @return Collection
     */
    public function roomList(array $query)
    {
        return $this->parseJSON('get', [
            self::API_GET_MEETING_ROOM_LIST,
            $query,
        ]);
    }

    /**
     * 获取会议室列详情.
     *
     * @param array $query 请求体
     *
     * @return Collection
     */
    public function roomLists(array $query)
    {
        return $this->parseJSON('get', [
            self::API_GET_MEETING_ROOM_ROOM,
            $query,
        ]);
    }

    /**
     * 会议室忙闲查询.
     *
     * @param array $query 请求体
     *
     * @return Collection
     */
    public function roomFreebusy(array $query)
    {
        return $this->parseJSON('get', [
            self::API_GET_MEETING_FREEBUSY,
            $query,
        ]);
    }
}
