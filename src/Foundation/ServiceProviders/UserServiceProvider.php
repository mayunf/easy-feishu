<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\User\AccessToken;
use EasyFeishu\User\Authen\Authen;
use EasyFeishu\User\Calendars\Calendars;
use EasyFeishu\User\Calendars\Schedule;
use EasyFeishu\User\Im\Group;
use EasyFeishu\User\Im\Im;
use EasyFeishu\User\Meetings\Meetings;
use EasyFeishu\User\Meetings\Reserves;
use EasyFeishu\User\User;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class UserServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['user.access_token'] = function ($pimple) {
            return new AccessToken($pimple['config']['user_access_token']);
        };

        $pimple['user.authen'] = function ($pimple) {
            return new Authen($pimple['user.access_token']);
        };

        $pimple['user.calendars'] = function ($pimple) {
            return new Calendars($pimple['user.access_token']);
        };
        $pimple['user.schedule'] = function ($pimple) {
            return new Schedule($pimple['user.access_token']);
        };
        $pimple['user.group'] = function ($pimple) {
            return new Group($pimple['user.access_token']);
        };
        $pimple['user.im'] = function ($pimple) {
            return new Im($pimple['user.access_token']);
        };
        $pimple['user.reserves'] = function ($pimple) {
            return new Reserves($pimple['user.access_token']);
        };
        $pimple['user.meetings'] = function ($pimple) {
            return new Meetings($pimple['user.access_token']);
        };

        $pimple['user'] = function ($pimple) {
            return new User($pimple);
        };
    }
}
