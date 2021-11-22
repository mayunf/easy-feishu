<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\Authen\Authen;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class AuthenServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['authen'] = function ($pimple) {
            return new Authen($pimple['access_token']);
        };
    }
}
