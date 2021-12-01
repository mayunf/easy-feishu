<?php

namespace EasyFeishu\User\Meetings;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class Reserves extends AbstractAPI
{
    const API_POST_RESERVES_APPLY = 'https://open.feishu.cn/open-apis/vc/v1/reserves/apply';
    const API_GET_RESERVES = 'https://open.feishu.cn/open-apis/vc/v1/reserves/';
    const API_PUT_RESERVES = 'https://open.feishu.cn/open-apis/vc/v1/reserves/';
    const API_GET_RESERVES_ACTIVE = 'https://open.feishu.cn/open-apis/vc/v1/reserves/';

    /**
     * 预约会议.
     *
     * @param array $params 请求体
     * @param array $query  查询参数
     *
     * @return Collection
     */
    public function reservesApply(array $params, array $query = ['user_id_type'=>'open_id'])
    {
        return $this->parseJSON('post', [
            self::API_POST_RESERVES_APPLY.'?'.http_build_query($query),
            $params,
        ]);
    }

    /**
     * 获取预约.
     *
     * @param string $reserveId 预约id
     * @param array  $query     查询参数
     *
     * @return Collection
     */
    public function getReservesApply(string $reserveId, array $query = ['user_id_type'=>'open_id'])
    {
        return $this->parseJSON('get', [
            self::API_GET_RESERVES.$reserveId,
            $query,
        ]);
    }

    /**
     * 更新预约.
     *
     * @param string $reservesId 预约id
     * @param array  $params     请求体
     * @param array  $query      查询参数
     *
     * @return Collection
     */
    public function putReservesApply(string $reservesId, array $params, array $query = ['user_id_type'=>'open_id'])
    {
        return $this->parseJSON('put', [
            self::API_PUT_RESERVES.$reservesId.'?'.http_build_query($query),
            $params,
        ]);
    }

    /**
     * 获取活跃会议.
     *
     * @param string $reserveId 预约id
     * @param array  $query     查询参数
     *
     * @return Collection
     */
    public function getReservesActive(string $reserveId, array $query = ['user_id_type'=>'open_id'])
    {
        return $this->parseJSON('get', [
            self::API_GET_RESERVES_ACTIVE.$reserveId.'/get_active_meeting?'.http_build_query($query),
            $query,
        ]);
    }
}
