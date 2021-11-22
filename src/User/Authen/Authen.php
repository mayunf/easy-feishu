<?php

namespace EasyFeishu\User\Authen;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class Authen extends AbstractAPI
{
    const API_GET_AUTHEN_USER_INFO = 'https://open.feishu.cn/open-apis/authen/v1/user_info';

    /**
     * 该接口仅适用于通过网页应用登录方式获取的预授权码
     *
     * @return Collection
     */
    public function userInfo(): Collection
    {
        return $this->parseJSON('get', [
            self::API_GET_AUTHEN_USER_INFO,
        ]);
    }
}
