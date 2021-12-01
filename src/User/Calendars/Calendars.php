<?php

namespace EasyFeishu\User\Calendars;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class Calendars extends AbstractAPI
{
    const API_POST_CALENDARS = 'https://open.feishu.cn/open-apis/calendar/v4/calendars';
    const API_GET_CALENDARS = 'https://open.feishu.cn/open-apis/calendar/v4/calendars/';
    const API_PATCH_CALENDARS = 'https://open.feishu.cn/open-apis/calendar/v4/calendars/';
    const API_POST_CALENDARS_SEARCH = 'https://open.feishu.cn/open-apis/calendar/v4/calendars/search';
    const API_POST_SUBSCRIBE_CALENDARS = 'https://open.feishu.cn/open-apis/calendar/v4/calendars/';
    const API_DELETE_CALENDARS = 'https://open.feishu.cn/open-apis/calendar/v4/calendars/';
    const API_POST_SUBSCRIPTION = 'https://open.feishu.cn/open-apis/calendar/v4/calendars/subscription';

    /**
     * 创建日历.
     *
     * @param array $params 请求体
     *
     * @return Collection
     */
    public function createCalendar(array $params)
    {
        return $this->parseJSON('post', [
            self::API_POST_CALENDARS,
            $params,
        ]);
    }

    /**
     * 获取单个日历信息.
     *
     * @param string $calendarId 日历id
     *
     * @return Collection
     */
    public function getCalendar(string $calendarId)
    {
        return $this->parseJSON('get', [
            self::API_GET_CALENDARS.$calendarId,
        ]);
    }

    /**
     * 获取日历列表.
     *
     * @param array $query 查询参数
     *
     * @return Collection
     */
    public function getCalendars(array $query = [])
    {
        return $this->parseJSON('get', [
            self::API_POST_CALENDARS,
            $query,
        ]);
    }

    /**
     * 更新日历信息.
     *
     * @param string $calendarId 日历id
     * @param array  $params     请求体
     *
     * @return Collection
     */
    public function patchCalendars(string $calendarId, array $params)
    {
        return $this->parseJSON('patch', [
            self::API_PATCH_CALENDARS.$calendarId,
            $params,
        ]);
    }

    /**
     * 搜索日历.
     *
     * @param array $query  查询参数
     * @param array $params 请求体
     *
     * @return Collection
     */
    public function searchCalendars(array $params, array $query = [])
    {
        return $this->parseJSON('post', [
            self::API_POST_CALENDARS_SEARCH.'?'.http_build_query($query),
            $params,
        ]);
    }

    /**
     * 订阅日历.
     *
     * @param string $calendarId 日历id
     *
     * @return Collection
     */
    public function subscribeCalendars(string $calendarId)
    {
        return $this->parseJSON('post', [
            self::API_POST_SUBSCRIBE_CALENDARS.$calendarId.'/subscribe',
        ]);
    }

    /**
     * 取消订阅日历.
     *
     * @param string $calendarId 日历id
     *
     * @return Collection
     */
    public function unsubscribe(string $calendarId)
    {
        return $this->parseJSON('post', [
            self::API_POST_SUBSCRIBE_CALENDARS.$calendarId.'/unsubscribe',
        ]);
    }

    /**
     * 删除日历.
     *
     * @param string $calendarId 日历id
     *
     * @return Collection
     */
    public function delCalendars(string $calendarId)
    {
        return $this->parseJSON('delete', [
            self::API_GET_CALENDARS.$calendarId,
        ]);
    }

    /**
     * 订阅日历变更事件.
     *
     *
     * @return Collection
     */
    public function postSubscription()
    {
        return $this->parseJSON('post', [
            self::API_POST_SUBSCRIPTION,
        ]);
    }
}
