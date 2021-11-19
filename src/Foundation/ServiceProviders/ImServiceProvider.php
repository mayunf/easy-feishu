<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\Im\Im;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ImServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['im'] = function ($pimple) {
            return new Im($pimple['access_token']);
        };
    }
}
