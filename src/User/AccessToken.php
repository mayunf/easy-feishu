<?php

namespace EasyFeishu\User;

use EasyFeishu\Core\Interfaces\AccessTokenInterface;

class AccessToken implements AccessTokenInterface
{
    protected $token;

    public function __construct($token)
    {
        $this->token = [
            $this->getTokenKey() => $token,
        ];
    }

    /**
     * @return mixed
     */
    public function getToken()
    {
        return $this->token;
    }

    public function getTokenKey()
    {
        return 'access_token';
    }
}
