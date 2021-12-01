<?php

namespace EasyFeishu\Tests\User;

use EasyFeishu\Tests\TestCase;
use EasyFeishu\User\User;

class UserTest extends TestCase
{
    /**
     * @return User
     */
    protected function getUser(): User
    {
        $app = $this->getInstance(); // 获取app

        $app->config->set('user_access_token', 'u-O4fyDVAx1Gjx7HZzUUL5Pc'); // 设置user_access_token

        return $app->user;
    }
}
