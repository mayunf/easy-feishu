<?php

namespace EasyFeishu\Core;

use EasyFeishu\AccessToken\AccessToken;
use GuzzleHttp\Exception\ClientException;
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
    const POST = 'post';

    const GET = 'get';


    public $accessToken;

    /** @var Http */
    protected $http;

    public function __construct(AccessToken $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    /**
     * Return the http instance.
     *
     * @return Http
     */
    public function getHttp()
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
     * Set the http instance.
     *
     * @param Http $http
     *
     * @return $this
     */
    public function setHttp(Http $http)
    {
        $this->http = $http;

        return $this;
    }

    /**
     * 注册中间件.
     */
    protected function registerHttpMiddlewares()
    {
        // access token
        $this->http->addMiddleware($this->accessTokenMiddleware());

        // log
//        $this->http->addMiddleware($this->logMiddleware());
    }

    protected function accessTokenMiddleware()
    {
        return function (callable $handler) {
            return function (RequestInterface $request, array $options) use ($handler) {
                $request = $request->withHeader('Content-Type', 'application/json; charset=utf-8');
                if (!$this->accessToken) {
                    return $handler($request, $options);
                }
                $token = $this->accessToken->getToken();
                $request = $request->withHeader('Authorization', 'Bearer '.$token[AccessToken::TOKEN_KEY]);

                return $handler($request, $options);
            };
        };
    }

    /**
     * Log the request.
     *
     * @return \Closure
     */
    protected function logMiddleware()
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
        } catch (ClientException $clientException) {
            $content = $clientException->getResponse()->getBody()->getContents();
            $contents = json_decode($content, true);
            if (json_last_error() !== JSON_ERROR_NONE && !empty($content)) {
                $contents = ['code' => -1, 'msg' => $content];
            }
        }

        return new Collection($contents);
    }
}
