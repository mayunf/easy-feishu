<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\Mina\Mina;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class MinaServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['mina'] = function ($pimple) {
            return new Mina($pimple['access_token']);
        };
    }
}
