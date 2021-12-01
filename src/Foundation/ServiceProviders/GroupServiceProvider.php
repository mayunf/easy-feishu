<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\Im\Group;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class GroupServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['group'] = function ($pimple) {
            return new Group($pimple['access_token']);
        };
    }
}
