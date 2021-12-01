<?php

//日程相关

namespace EasyFeishu\User\Calendars;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class Schedule extends AbstractAPI
{
    const API_POST_EVENTS = 'https://open.feishu.cn/open-apis/calendar/v4/calendars/';
    const API_GET_EVENTS = 'https://open.feishu.cn/open-apis/calendar/v4/calendars/';
    const API_PATCH_EVENTS = 'https://open.feishu.cn/open-apis/calendar/v4/calendars/';
    const API_POST_EVENTS_SEARCH = 'https://open.feishu.cn/open-apis/calendar/v4/calendars/';
    const API_DELETE_EVENTS = 'https://open.feishu.cn/open-apis/calendar/v4/calendars/';

    const API_POST_EVENTS_ATTENDEES = 'https://open.feishu.cn/open-apis/calendar/v4/calendars/';
    const API_POST_EVENTS_ATTENDEES_DELETE = 'https://open.feishu.cn/open-apis/calendar/v4/calendars/';
    const API_GET_EVENTS_CHAT_MEMBERS = 'https://open.feishu.cn/open-apis/calendar/v4/calendars/';
    const API_POST_CALDAV_CONF = "https://open.feishu.cn/open-apis/calendar/v4/settings/generate_caldav_conf";
    const API_POST_EXCHANGE_BINDINGS = "https://open.feishu.cn/open-apis/calendar/v4/exchange_bindings";
    const API_GET_EXCHANGE_BINDINGS = "https://open.feishu.cn/open-apis/calendar/v4/exchange_bindings/";
    const API_DELETE_EXCHANGE_BINDINGS = "https://open.feishu.cn/open-apis/calendar/v4/exchange_bindings/";


    /**
     * 创建日程.
     *
     * @param array  $params     请求体
     * @param string $calendarId 日历id
     *
     * @return Collection
     */
    public function createEvents(string $calendarId, array $params)
    {
        return $this->parseJSON('post', [
            self::API_POST_EVENTS.$calendarId.'/events',
            $params,
        ]);
    }

    /**
     * 获取日程.
     *
     * @param string $eventId    日程id
     * @param string $calendarId 日历id
     *
     * @return Collection
     */
    public function getEvent(string $calendarId, string $eventId)
    {
        return $this->parseJSON('get', [
            self::API_GET_EVENTS.$calendarId.'/events/'.$eventId,
        ]);
    }

    /**
     * 获取日程列表.
     *
     * @param array  $query      查询参数
     * @param string $calendarId 日历id
     *
     * @return Collection
     */
    public function getEvents(string $calendarId, array $query = [])
    {
        return $this->parseJSON('get', [
            self::API_GET_EVENTS.$calendarId.'/events?'.http_build_query($query),
            $query,
        ]);
    }

    /**
     * 更新日程.
     *
     * @param string $eventId    日程id
     * @param string $calendarId 日历id
     * @param array  $param      请求头
     *
     * @return Collection
     */
    public function patchEvents(string $calendarId, string $eventId, array $param)
    {
        return $this->parseJSON('patch', [
            self::API_GET_EVENTS.$calendarId.'/events/'.$eventId,
            $param,
        ]);
    }

    /**
     * 搜索日程列表.
     *
     * @param array  $query      查询参数
     * @param array  $param      请求头
     * @param string $calendarId 日历id
     *
     * @return Collection
     */
    public function searchEvents(string $calendarId, array $param = [], array $query = [])
    {
        return $this->parseJSON('post', [
            self::API_POST_EVENTS_SEARCH.$calendarId.'/events/search?'.http_build_query($query),
            $param,
        ]);
    }

    /**
     * 订阅日程变更事件.
     *

     * @param string $calendarId 日历id
     *
     * @return Collection
     */
    public function eventsSubscription($calendarId){
        return $this->parseJSON('post',[
            self::API_POST_EVENTS.$calendarId.'/events/subscription'
        ]);
    }

    /**
     * 获取日程参与人列表.
     *
     * @param array  $query      查询参数
     * @param array  $param      请求头
     * @param string $calendarId 日历id
     * @param string $eventId    日程id
     *
     * @return Collection
     */
    public function eventsAttendees(string $calendarId, string $eventId, array $param, array $query)
    {
        return $this->parseJSON('post', [
            self::API_POST_EVENTS_ATTENDEES.$calendarId.'/events/'.$eventId.'/attendees?'.http_build_query($query),
            $param,
        ]);
    }

    /**
     * 获取日程参与人.
     *
     * @param array  $query      查询参数
     * @param string $calendarId 日历id
     * @param string $eventId    日程id
     *
     * @return Collection
     */
    public function getAttendees(string $calendarId, string $eventId, array $query)
    {
        return $this->parseJSON('get', [
            self::API_POST_EVENTS_ATTENDEES.$calendarId.'/events/'.$eventId.'/attendees',
            $query,
        ]);
    }

    /**
     * 删除日程.
     *
     * @param string $eventId    日程id
     * @param string $calendarId 日历id
     * @param array  $query      查询参数
     *
     * @return Collection
     */
    public function delEvent(string $calendarId, string $eventId, array $query)
    {
        return $this->parseJSON('delete', [
            self::API_DELETE_EVENTS.$calendarId.'/events/'.$eventId,
            $query,
        ]);
    }

    /**
     * 删除日程参与人.
     *
     * @param string $eventId    日程id
     * @param string $calendarId 日历id
     * @param array  $param      请求体
     *
     * @return Collection
     */
    public function delAttendees(string $calendarId, string $eventId, array $param)
    {
        return $this->parseJSON('post', [
            self::API_POST_EVENTS_ATTENDEES_DELETE.$calendarId.'/events/'.$eventId.'/attendees/batch_delete',
            $param,
        ]);
    }

    /**
     * 获取日程参与群成员列表--bug.
     *
     * @param string $eventId    日程id
     * @param string $calendarId 日历id
     * @param string $attendeeId 参与人id
     * @param array  $param
     *
     * @return Collection
     */
    public function eventMembers(string $calendarId, string $eventId, string $attendeeId, array $param = [])
    {
        return $this->parseJSON('get', [
            self::API_GET_EVENTS_CHAT_MEMBERS.$calendarId.'/events/'.$eventId.'/attendees/'.$attendeeId.'/chat_members',
            $param,
        ]);
    }

    /**
     * 生成CalDAV配置
     *
     * @param array $param 请求体
     *
     * @return Collection
     */
    public function postCalDav(array $param){
        return $this->parseJSON('post',[
            self::API_POST_CALDAV_CONF,
            $param
        ]);
    }

    /**
     * 创建Exchange绑定关系
     *
     * @param array $query 查询参数
     * @param array $param 请求体
     *
     * @return Collection
     */
    public function postExchange(array $param = [], array $query = []){
        return $this->parseJSON('post',[
            self::API_POST_EXCHANGE_BINDINGS.'?'.http_build_query($query),
            $param
        ]);
    }

    /**
     * 查询Exchange绑定关系
     *
     * @param array $query 查询参数
     * @param string $exchangeId ExchangeId
     *
     * @return Collection
     */
    public function getExchange(string $exchangeId, array $query = []){
        return $this->parseJSON('get',[
            self::API_GET_EXCHANGE_BINDINGS.$exchangeId,
            $query
        ]);
    }


    /**
     * 删除Exchange绑定关系
     *
     * @param array $query 查询参数
     * @param string $exchangeId ExchangeId
     *
     * @return Collection
     */
    public function delExchange(string $exchangeId, array $query = []){
        return $this->parseJSON('delete',[
            self::API_DELETE_EXCHANGE_BINDINGS.$exchangeId,
            $query
        ]);
    }


}
