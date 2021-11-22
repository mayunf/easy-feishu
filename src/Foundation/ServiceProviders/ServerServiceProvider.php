<?php


namespace EasyFeishu\Foundation\ServiceProviders;


use EasyFeishu\Encryption\Encryptor;
use EasyFeishu\Server\Guard;
use Pimple\Container;
use Pimple\ServiceProviderInterface;

class ServerServiceProvider implements ServiceProviderInterface
{

    public function register(Container $pimple)
    {
        $pimple['encryptor'] = function ($pimple) {
            return new Encryptor($pimple['config']['encrypt_key']);
        };

        $pimple['server'] = function ($pimple) {
            $server = new Guard();
            $server->debug($pimple['config']['debug']);
            $server->setEncryptor($pimple['encryptor']);
            return $server;
        };
    }

}