<?php

namespace EasyFeishu\User;

use EasyFeishu\Utils\Traits\PrefixedContainer;

/**
 * @property \EasyFeishu\User\Authen\Authen       $authen
 * @property \EasyFeishu\User\Calendars\Calendars $calendars
 * @property \EasyFeishu\User\Calendars\Schedule  $schedule
 * @property \EasyFeishu\User\Im\Im               $im
 * @property \EasyFeishu\User\Im\Group            $group
 * @property \EasyFeishu\User\Meetings\Reserves   $reserves
 * @property \EasyFeishu\User\Meetings\Meetings   $meetings
 * @property \EasyFeishu\User\Drive\Drive         $drive
 */
class User
{
    use PrefixedContainer;
}
