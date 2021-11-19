<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\Application\Admin;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class AdminServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['admin'] = function ($pimple) {
            return new Admin($pimple['access_token']);
        };
    }
}
