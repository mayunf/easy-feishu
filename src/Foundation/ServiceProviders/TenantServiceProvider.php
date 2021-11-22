<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\Application\Tenant;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class TenantServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['tenant'] = function ($pimple) {
            return new Tenant($pimple['access_token']);
        };
    }
}
