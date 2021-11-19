<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\Contact\ContactUsers;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ContactUsersServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['contactUsers'] = function ($pimple) {
            return new ContactUsers($pimple['access_token']);
        };
    }
}
