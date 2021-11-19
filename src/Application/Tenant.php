<?php

//企业信息
namespace EasyFeishu\Application;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;
class Tenant extends  AbstractAPI
{
    const API_GET_TENANT = "https://open.feishu.cn/open-apis/tenant/v2/tenant/query";

    /**
     * 获取企业信息
     *
     * @return Collection
     */
    public function getTenant(){
        return $this->parseJSON('get', [
            self::API_GET_TENANT
        ]);
    }
}