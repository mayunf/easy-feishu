<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\Meeting\MeetingRoom;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class MeetingRoomServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['meetingRoom'] = function ($pimple) {
            return new MeetingRoom($pimple['access_token']);
        };
    }
}
