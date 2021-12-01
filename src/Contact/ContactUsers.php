<?php

namespace EasyFeishu\Contact;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class ContactUsers extends AbstractAPI
{
    const API_POST_USERS = 'https://open.feishu.cn/open-apis/contact/v3/users';
    const API_GET_USERS = 'https://open.feishu.cn/open-apis/contact/v3/users/';
    const API_PATCH_USERS = 'https://open.feishu.cn/open-apis/contact/v3/users/';
    const API_POST_BATCH_GET_ID = 'https://open.feishu.cn/open-apis/contact/v3/users/batch_get_id';
    const API_GET_CUSTOM_attrs = 'https://open.feishu.cn/open-apis/contact/v3/custom_attrs'; //获取自定义字段

    /**
     * 创建用户.
     *
     * @param array $params 请求体
     * @param array $query  查询参数
     *
     * @return Collection
     */
    public function postUsers(array $params = [], array $query = []): Collection
    {
        return $this->parseJSON('post', [
            self::API_POST_USERS.'?'.http_build_query($query),
            $params,
        ]);
    }

    /**
     * 获取单个用户信息.
     *
     * @param string $userId 用户id
     * @param array  $query  查询参数
     *
     * @return Collection
     */
    public function getUser(string $userId, array $query = [])
    {
        return $this->parseJSON('get', [
            self::API_GET_USERS.$userId,
            $query,
        ]);
    }

    /**
     * 获取用户列表.
     *
     * @param array $query 查询参数
     *
     * @return Collection
     */
    public function getUsers(array $query = [])
    {
        return $this->parseJSON('get', [
            self::API_POST_USERS,
            $query,
        ]);
    }

    /**
     * 修改用户部分信息.
     *
     * @param string $userId 用户id
     * @param array  $query  查询参数
     * @param array  $param  请求体
     *
     * @return Collection
     */
    public function patchUsers(string $userId, array $param, array $query = [])
    {
        return $this->parseJSON('patch', [
            self::API_PATCH_USERS.$userId.'?'.http_build_query($query),
            $param,
        ]);
    }

    /**
     * 修改用户全部信息.
     *
     * @param string $userId 用户id
     * @param array  $query  查询参数
     * @param array  $param  请求体
     *
     * @return Collection
     */
    public function putUsers(string $userId, array $param, array $query = [])
    {
        return $this->parseJSON('put', [
            self::API_PATCH_USERS.$userId.'?'.http_build_query($query),
            $param,
        ]);
    }

    /**
     * 根据手机号和邮箱获取userId
     *
     * @param array $query 查询参数
     * @param array $param 请求体
     *
     * @return Collection
     */
    public function getBarchId(array $param, array $query = [])
    {
        return $this->parseJSON('post', [
            self::API_POST_BATCH_GET_ID.'?'.http_build_query($query),
            $param,
        ]);
    }

    /**
     * 删除用户.
     *
     * @param string $userId 用户id
     * @param array  $query  查询参数
     * @param array  $param  请求体
     *
     * @return Collection
     */
    public function delUser(string $userId, array $param = [], array $query = [])
    {
        return $this->parseJSON('delete', [
            self::API_GET_USERS.$userId.'?'.http_build_query($query),
            $query,
        ]);
    }

    /**
     * 获取自定义字段.
     *
     * @param array $query 查询参数
     *
     * @return Collection
     */
    public function getCustomAttrs(array $query = [])
    {
        return $this->parseJSON('get', [
            self::API_GET_CUSTOM_attrs,
            $query,
        ]);
    }
}
