<?php

namespace EasyFeishu\Core;

use EasyFeishu\Core\Interfaces\AccessTokenInterface;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use GuzzleHttp\Middleware;
use Mayunfeng\Supports\Collection;
use Mayunfeng\Supports\Log;
use Psr\Http\Message\RequestInterface;

/**
 * BaseApi use before login
 * Class BaseApi.
 */
abstract class AbstractAPI
{
    public $accessToken;

    /** @var Http */
    protected $http;

    public function __construct(AccessTokenInterface $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Return the http instance.
     *
     * @return Http
     */
    public function getHttp(): Http
    {
        if (is_null($this->http)) {
            $this->http = new Http();
        }
        if (count($this->http->getMiddlewares()) === 0) {
            $this->registerHttpMiddlewares();
        }

        return $this->http;
    }

    /**
     * 注册中间件.
     */
    protected function registerHttpMiddlewares()
    {
        // access token
        $this->http->addMiddleware($this->accessTokenMiddleware());

        // log
        $this->http->addMiddleware($this->logMiddleware());
    }

    protected function accessTokenMiddleware()
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                $headers = $request->getHeaders();
                if (!isset($headers['Content-Type'])) {
                    $request = $request->withHeader('Content-Type', 'application/json; charset=utf-8');
                }
                if (!$this->accessToken) {
                    return $handler($request, $options);
                }
                $token = $this->accessToken->getToken();
                $request = $request->withHeader('Authorization', 'Bearer '.$token[$this->accessToken->getTokenKey()]);

                return $handler($request, $options);
            };
        };
    }

    /**
     * Log the request.
     *
     * @return \Closure
     */
    protected function logMiddleware(): \Closure
    {
        return Middleware::tap(function (RequestInterface $request, $options) {
            Log::debug("Request: {$request->getMethod()} {$request->getUri()} ".json_encode($options));
            Log::debug('Request headers:'.json_encode($request->getHeaders()));
        });
    }

    /**
     * Parse JSON from response and check error.
     *
     * @param string $method
     * @param array  $args
     *
     * @return Collection
     */
    public function parseJSON($method, array $args)
    {
        try {
            $http = $this->getHttp();
            $contents = $http->parseJSON(call_user_func_array([$http, $method], $args));
        } catch (ClientException|ServerException $clientException) {
            $content = $clientException->getResponse()->getBody()->getContents();
            $contents = json_decode($content, true);
            if (json_last_error() !== JSON_ERROR_NONE && !empty($content)) {
                $contents = ['code' => -1, 'msg' => $content];
            }
        }

        return new Collection($contents);
    }
}
