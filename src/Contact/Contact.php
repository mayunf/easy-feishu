<?php


namespace EasyFeishu\Contact;


use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class Contact extends AbstractAPI
{
    const API_GET_DEPARTMENTS = 'https://open.feishu.cn/open-apis/contact/v3/departments';
    const API_GET_DEPARTMENTS_BY_ID = 'https://open.feishu.cn/open-apis/contact/v3/departments/';
    const API_POET_DEPARTMENTS = 'https://open.feishu.cn/open-apis/contact/v3/departments';
    const API_GET_DEPARTMENTS_PARENT = 'https://open.feishu.cn/open-apis/contact/v3/departments/parent';
    const API_PATCH_DEPARTMENTS = 'https://open.feishu.cn/open-apis/contact/v3/departments/';
    const API_PUT_DEPARTMENTS = 'https://open.feishu.cn/open-apis/contact/v3/departments/';
    const API_DELETE_DEPARTMENTS= 'https://open.feishu.cn/open-apis/contact/v3/departments/';

    const API_POST_CONTACT = 'https://open.feishu.cn/open-apis/contact/v3/users/';
    const API_GET_CONTACT_LIST = 'https://open.feishu.cn/open-apis/contact/v3/users';

    const API_GET_CONTACT_BY_ID = 'https://open.feishu.cn/open-apis/contact/v3/users/';

    const API_PATCH_CONTACT = 'https://open.feishu.cn/open-apis/contact/v3/users/';

    const API_PUT_CONTACT = 'https://open.feishu.cn/open-apis/contact/v3/users/';

    const API_DELETE_CONTACT_BY_ID = 'https://open.feishu.cn/open-apis/contact/v3/users/';

    const API_POST_CONTACT_BATCH_GET_ID = 'https://open.feishu.cn/open-apis/contact/v3/users/batch_get_id';


    /**
     * 创建部门
     * @param array $params 请求体
     * @param array $query 查询参数
     * @return Collection
     */
    public function postDepartments(array $params = [], array $query = []): Collection
    {
        return $this->parseJSON('post', [
            self::API_POET_DEPARTMENTS . '?' . http_build_query($query),
            $params
        ]);
    }

    /**
     * 获取单个部门信息
     * @param string $departmentId
     * @param array $params 请求体
     * @param array $query 查询参数
     * @return Collection
     */
    public function getDepartmentsById(string $departmentId, array $params = [], array $query = []): Collection
    {
        return $this->parseJSON('get', [
            self::API_GET_DEPARTMENTS_BY_ID . $departmentId . '?' . http_build_query($query),
            $params
        ]);
    }

    /**
     * 获取部门信息列表
     * @param array $params 请求体
     * @param array $query 查询参数
     * @return Collection
     */
    public function getDepartments(array $params = [], array $query = []): Collection
    {
        return $this->parseJSON('get', [
            self::API_GET_DEPARTMENTS . '?' . http_build_query($query),
            $params
        ]);
    }

    /**
     * 获取父部门信息
     * @param array $params 请求体
     * @param array $query 查询参数
     * @return Collection
     */
    public function getDepartmentsParent(array $params = [], array $query = []): Collection
    {
        return $this->parseJSON('get', [
            self::API_GET_DEPARTMENTS_PARENT . '?' . http_build_query($query),
            $params
        ]);
    }

    /**
     * 修改部分部门信息
     * @param string $departmentId 路径参数
     * @param array $params 请求体
     * @param array $query 查询参数
     * @return Collection
     */
    public function patchDepartments(string $departmentId, array $params = [], array $query = []): Collection
    {
        return $this->parseJSON('patch', [
            self::API_PATCH_DEPARTMENTS . $departmentId . '?' . http_build_query($query),
            $params
        ]);
    }

    /**
     * 更新部门所有信息
     * @param string $departmentId 路径参数
     * @param array $params 请求体
     * @param array $query 查询参数
     * @return Collection
     */
    public function putDepartments(string $departmentId, array $params = [], array $query = []): Collection
    {
        return $this->parseJSON('PUT', [
            self::API_PUT_DEPARTMENTS . $departmentId . '?' . http_build_query($query),
            $params
        ]);
    }
    /**
     * 更新部门所有信息
     * @param string $departmentId 路径参数
     * @param array $query 查询参数
     * @return Collection
     */
    public function deleteDepartments(string $departmentId, array $query = []): Collection
    {
        return $this->parseJSON('DELETE', [
            self::API_DELETE_DEPARTMENTS . $departmentId . '?' . http_build_query($query)
        ]);
    }


    /**
     * 获取用户列表
     * @param array $params 请求体
     * @param array $query 查询参数
     * @return Collection
     */
    public function users(array $params = [], array $query = []): Collection
    {
        return $this->parseJSON('get', [
            self::API_GET_CONTACT_LIST . '?' . http_build_query($query),
            $params
        ]);
    }
}