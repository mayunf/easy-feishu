<?php


namespace EasyFeishu\Application;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;
class Order extends AbstractAPI
{
    const API_GET_PAY_CHECK_USER = "https://open.feishu.cn/open-apis/pay/v1/paid_scope/check_user";
    const API_GET_ORDER_LIST = "https://open.feishu.cn/open-apis/pay/v1/order/list";
    const API_GET_ORDER = "https://open.feishu.cn/open-apis/pay/v1/order/get";
    const API_POST_APP_OVERVIVE = "https://open.feishu.cn/open-apis/application/v6/applications/";

    /**
     * 查询用户是否能使用付费功能
     *
     * @param array $params 请求体
     * @return Collection
     */
    public function checkUser(array $params){
        return $this->parseJSON('get', [
            self::API_GET_PAY_CHECK_USER,
            $params,
        ]);
    }

    /**
     * 查询应用租户下的付费订单
     *
     * @param array $params 请求体
     * @return Collection
     */
    public function orderList(array $params){
        return $this->parseJSON('get', [
            self::API_GET_ORDER_LIST,
            $params,
        ]);
    }

    /**
     * 查询订单信息 -- 无法测试
     *
     * @param array $params 请求体
     * @return Collection
     */
    public function getOrder(array $params){
        return $this->parseJSON('get', [
            self::API_GET_ORDER,
            $params,
        ]);
    }

    /**
     * 获取应用使用概览
     *
     * @param string $appId app_id
     * @param array $param 请求体
     * @return Collection
     */
    public function getAppOverview(string $appId, array $param){
        return $this->parseJSON('post', [
            self::API_POST_APP_OVERVIVE.$appId.'/app_usage/overview',
            $param
        ]);
    }

}