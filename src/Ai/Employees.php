<?php

namespace EasyFeishu\Ai;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class Employees extends AbstractAPI
{
    const API_GET_EHR_EMPLOYEES = 'https://open.feishu.cn/open-apis/ehr/v1/employees';
    const API_GET_EHR_ATTACHMENTS = 'https://open.feishu.cn/open-apis/ehr/v1/attachments/';

    /**
     * 批量获取员工花名册信息.
     *
     * @param array $params 请求体
     *
     * @return Collection
     */
    public function getEmployees(array $params)
    {
        return $this->parseJSON('get', [
            self::API_GET_EHR_EMPLOYEES,
            $params
        ]);
    }

    /**
     * 批量获取员工花名册信息.
     *
     * @param string $token 请求体
     *
     * @return Collection
     */
    public function getFile(string $token)
    {
        return $this->parseJSON('get', [
            self::API_GET_EHR_ATTACHMENTS.$token,
        ]);
    }
}
