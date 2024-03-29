<?php

namespace EasyFeishu\Foundation;

use EasyFeishu\Core\Http;
use Mayunfeng\Supports\Config;
use Mayunfeng\Supports\Log;
use Monolog\Handler\HandlerInterface;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Pimple\Container;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class Application.
 *
 * @property \EasyFeishu\Contact\Contact         $contact
 * @property \EasyFeishu\AccessToken\AccessToken $access_token
 * @property \EasyFeishu\Im\Im                   $im
 * @property \EasyFeishu\calendar\calendar       $calendar
 * @property \EasyFeishu\calendar\schedule       $schedule
 * @property \EasyFeishu\Meeting\MeetingRoom     $meetingRoom
 * @property \EasyFeishu\Application\Order       $order
 * @property \EasyFeishu\Application\Admin       $admin
 * @property \EasyFeishu\Application\Tenant      $tenant
 * @property \EasyFeishu\Ai\Employees            $employees
 * @property \EasyFeishu\Contact\ContactUsers    $contactUsers
 * @property \EasyFeishu\Server\Guard            $server
 * @property \EasyFeishu\Mina\Mina               $mina
 * @property \EasyFeishu\Authen\Authen           $authen
 * @property \EasyFeishu\User\User               $user
 * @property Config                              $config
 * @property \EasyFeishu\Im\Group                $group
 * @property \EasyFeishu\Meeting\Meetings        $meetings
 * @property \EasyFeishu\Drive\Drive             $drive
 */
class Application extends Container
{
    protected $providers = [
        ServiceProviders\AccessTokenServiceProvider::class,
        ServiceProviders\ContactServiceProvider::class,
        ServiceProviders\ImServiceProvider::class,
        ServiceProviders\CalendarServiceProvider::class,
        ServiceProviders\ScheduleServiceProvider::class,
        ServiceProviders\MeetingRoomServiceProvider::class,
        ServiceProviders\AdminServiceProvider::class,
        ServiceProviders\OrderServiceProvider::class,
        ServiceProviders\TenantServiceProvider::class,
        ServiceProviders\EmployeesServiceProvider::class,
        ServiceProviders\ContactUsersServiceProvider::class,
        ServiceProviders\ServerServiceProvider::class,
        ServiceProviders\MinaServiceProvider::class,
        ServiceProviders\AuthenServiceProvider::class,
        ServiceProviders\UserServiceProvider::class,
        ServiceProviders\GroupServiceProvider::class,
        ServiceProviders\MeetingServiceProvider::class,
        ServiceProviders\DriveServiceProvider::class,
    ];

    public function __construct($config)
    {
        parent::__construct();

        $this['config'] = function () use ($config) {
            return new Config($config);
        };

        if ($this['config']['debug'] == true) {
            error_reporting(E_ALL);
        }
        $this->registerProviders();
        $this->registerBase();
        $this->initializeLogger();
        Http::setDefaultOptions($this['config']->get('guzzle', ['timeout' => 5.0]));
    }

    // 初始化token信息
    private function registerBase()
    {
        $this['request'] = function () {
            return Request::createFromGlobals();
        };
    }

    // 注册服务
    private function registerProviders()
    {
        foreach ($this->providers as $provider) {
            $this->register(new $provider());
        }
    }

    private function initializeLogger()
    {
        if (Log::hasLogger()) {
            return;
        }

        $logger = new Logger('EasyFeishu');

        if (!$this['config']['debug'] || defined('PHPUNIT_RUNNING')) {
            $logFile = $this['config']['log.file'];
            $logger->pushHandler(
                new StreamHandler(
                    $logFile,
                    $this['config']->get('log.level', Logger::WARNING),
                    true,
                    $this['config']->get('log.permission', null)
                )
            );
        } elseif ($this['config']['log.handler'] instanceof HandlerInterface) {
            $logger->pushHandler($this['config']['log.handler']);
        } elseif ($logFile = $this['config']['log.file']) {
            $logger->pushHandler(
                new StreamHandler(
                    $logFile,
                    $this['config']->get('log.level', Logger::WARNING),
                    true,
                    $this['config']->get('log.permission', null)
                )
            );
        }
        Log::setLogger($logger);
    }

    /**
     * Add a provider.
     *
     * @param string $provider
     *
     * @return Application
     */
    public function addProvider($provider): Application
    {
        array_push($this->providers, $provider);

        return $this;
    }

    /**
     * Set providers.
     *
     * @param array $providers
     */
    public function setProviders(array $providers)
    {
        $this->providers = [];
        foreach ($providers as $provider) {
            $this->addProvider($provider);
        }
    }

    /**
     * Return all providers.
     *
     * @return array
     */
    public function getProviders(): array
    {
        return $this->providers;
    }

    /**
     * Magic get access.
     *
     * @param string $id
     *
     * @return mixed
     */
    public function __get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * Magic set access.
     *
     * @param string $id
     * @param mixed  $value
     */
    public function __set($id, $value)
    {
        $this->offsetSet($id, $value);
    }
}
