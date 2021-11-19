<?php

namespace EasyFeishu\Foundation\ServiceProviders;

use EasyFeishu\Ai\Employees;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class EmployeesServiceProvider implements ServiceProviderInterface
{
    public function register(Container $pimple)
    {
        $pimple['employees'] = function ($pimple) {
            return new Employees($pimple['access_token']);
        };
    }
}
