<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\AccessToken\AccessToken;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class AccessTokenServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['access_token'] = function ($pimple) {
            return new AccessToken($pimple);
        };
    }
}
