<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\User\AccessToken;
use EasyFeishu\User\Authen\Authen;
use EasyFeishu\User\User;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class UserServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['user.access_token'] = function ($pimple) {
            return new AccessToken($pimple['config']['user_access_token']);
        };

        $pimple['user.authen'] = function ($pimple) {
            return new Authen($pimple['user.access_token']);
        };

        $pimple['user'] = function ($pimple) {
            return new User($pimple);
        };
    }
}
