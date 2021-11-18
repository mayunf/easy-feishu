<?php


namespace EasyFeishu\Application;
use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class Admin extends AbstractAPI
{
    const API_GET_USER_ADMIN = "https://open.feishu.cn/open-apis/application/v3/is_user_admin";
    const API_GET_USER_SCOPE = "https://open.feishu.cn/open-apis/contact/v1/user/admin_scope/get";
    const API_GET_APP_VISIBILITY = "https://open.feishu.cn/open-apis/application/v2/app/visibility";
    const API_GET_USER_APPS = "https://open.feishu.cn/open-apis/application/v1/user/visible_apps";
    const API_GET_APP_LIST = "https://open.feishu.cn/open-apis/application/v3/app/list";
    const API_POST_APP_UPDATE = "https://open.feishu.cn/open-apis/application/v3/app/update_visibility";
    const API_GET_APP_ADMIN_LIST = "https://open.feishu.cn/open-apis/user/v4/app_admin_user/list";

    /**
     * 校验管理员
     *
     * @param array $params 请求体
     * @return Collection
     */
    public function isAdmin(array $params){
        return $this->parseJSON('get', [
            self::API_GET_USER_ADMIN,
            $params,
        ]);
    }

    /**
     * 校验管理员
     *
     * @param array $params 请求体
     * @return Collection
     */
    public function isAdminScope(array $params){
        return $this->parseJSON('get', [
            self::API_GET_USER_SCOPE,
            $params,
        ]);
    }

    /**
     * 获取应用在企业内的可用范围
     *
     * @param array $params 请求体
     * @return Collection
     */
    public function appVisibility(array $params){
        return $this->parseJSON('get', [
            self::API_GET_APP_VISIBILITY,
            $params,
        ]);
    }

    /**
     * 获取用户可用的应用
     *
     * @param array $params 请求体
     * @return Collection
     */
    public function visibleApps(array $params){
        return $this->parseJSON('get', [
            self::API_GET_USER_APPS,
            $params,
        ]);
    }

    /**
     * 获取企业按照的应用
     *
     * @param array $params 请求体
     * @return Collection
     */
    public function appList(array $params){
        return $this->parseJSON('get', [
            self::API_GET_APP_LIST,
            $params,
        ]);
    }

    /**
     * 更新可用范围
     *
     * @param array $params 请求体
     * @return Collection
     */
    public function appUpdate(array $params){
        return $this->parseJSON('post', [
            self::API_POST_APP_UPDATE,
            $params,
        ]);
    }

    /**
     * 更新可用范围
     *
     * @param array $params 请求体
     * @return Collection
     */
    public function appAdminList(array $params = []){
        return $this->parseJSON('get', [
            self::API_GET_APP_ADMIN_LIST,
            $params,
        ]);
    }

}