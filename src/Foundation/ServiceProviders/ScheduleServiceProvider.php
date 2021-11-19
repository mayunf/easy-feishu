<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\Calendar\Schedule;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ScheduleServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['schedule'] = function ($pimple) {
            return new schedule($pimple['access_token']);
        };
    }
}
