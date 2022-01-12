<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\Application\Admin;
use EasyFeishu\Drive\Drive;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class DriveServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['drive'] = function ($pimple) {
            return new Drive($pimple['access_token']);
        };
    }
}
