<?php

namespace EasyFeishu\Authen;

use EasyFeishu\Core\AbstractAPI;
use Mayunfeng\Supports\Collection;

class Authen extends AbstractAPI
{
    const API_POST_AUTHEN_ACCESS_TOKEN = 'https://open.feishu.cn/open-apis/authen/v1/access_token';
    const API_POST_AUTHEN_REFRESH_ACCESS_TOKEN = 'https://open.feishu.cn/open-apis/authen/v1/refresh_access_token';

    /**
     * 该接口仅适用于通过网页应用登录方式获取的预授权码
     *
     * @param  string  $code
     * @param  string  $grantType
     * @return Collection
     */
    public function accessToken(string $code, string $grantType = 'authorization_code'): Collection
    {
        return $this->parseJSON('post', [
            self::API_POST_AUTHEN_ACCESS_TOKEN,
            [
                'grant_type' => $grantType,
                'code' => $code
            ]
        ]);
    }
    /**
     * 刷新 access_token
     *
     * @param  string  $refreshToken
     * @param  string  $grantType
     * @return Collection
     */
    public function refreshAccessToken(string $refreshToken, string $grantType = 'refresh_token'): Collection
    {
        return $this->parseJSON('post', [
            self::API_POST_AUTHEN_REFRESH_ACCESS_TOKEN,
            [
                'grant_type' => $grantType,
                'refresh_token' => $refreshToken
            ]
        ]);
    }

}
