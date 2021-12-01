<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\Meeting\Meetings;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class MeetingServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['meetings'] = function ($pimple) {
            return new Meetings($pimple['access_token']);
        };
    }
}
