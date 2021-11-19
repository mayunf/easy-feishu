<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\Calendar\Calendar;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class CalendarServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['calendar'] = function ($pimple) {
            return new calendar($pimple['access_token']);
        };
    }
}
