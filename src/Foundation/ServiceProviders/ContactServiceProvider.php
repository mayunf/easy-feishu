<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\Contact\Contact;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ContactServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['contact'] = function ($pimple) {
            return new Contact($pimple['access_token']);
        };
    }
}
