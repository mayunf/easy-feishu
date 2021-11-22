<?php


namespace EasyFeishu\User\Core;


use EasyFeishu\Core\AbstractAPI;

class AbstractUser extends AbstractAPI
{

    /**
     * Mini program config.
     *
     * @var array
     */
    protected $config;

    /**
     * AbstractMiniProgram constructor.
     *
     * @param \EasyFeishu\User\AccessToken $accessToken
     * @param  array  $config
     */
    public function __construct($accessToken)
    {
        parent::__construct($accessToken);
    }

}