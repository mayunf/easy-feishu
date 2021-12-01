<?php

namespace EasyFeishu\Mina;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class Mina extends AbstractAPI
{
    const API_POST_TOKEN_LOGIN_VALIDATE = 'https://open.feishu.cn/open-apis/mina/v2/tokenLoginValidate';

    /**
     * 通过 login 接口获取到登录凭证后，开发者可以通过服务器发送请求的方式获取 session_key 和 openId.
     *
     * @param string $code
     *
     * @return Collection
     */
    public function code2session(string $code): Collection
    {
        return $this->parseJSON('post', [
            self::API_POST_TOKEN_LOGIN_VALIDATE,
            [
                'code' => $code,
            ],
        ]);
    }
}
