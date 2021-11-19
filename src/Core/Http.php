<?php

namespace EasyFeishu\Core;

use EasyFeishu\Core\Exceptions\HttpException;
use GuzzleHttp\Client as HttpClient;
use GuzzleHttp\HandlerStack;
use Mayunfeng\Supports\Log;
use Psr\Http\Message\ResponseInterface;

class Http
{
    /**
     * Used to identify handler defined by client code
     * Maybe useful in the future.
     */
    const USER_DEFINED_HANDLER = 'userDefined';

    /**
     * Http client.
     *
     * @var HttpClient
     */
    protected $client;

    /**
     * The middlewares.
     *
     * @var array
     */
    protected $middlewares = [];

    /**
     * Guzzle client default settings.
     *
     * @var array
     */
    protected static $defaults = [
        'curl' => [
            CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4,
        ],
    ];

    /**
     * Set guzzle default settings.
     *
     * @param array $defaults
     */
    public static function setDefaultOptions($defaults = [])
    {
        self::$defaults = $defaults;
    }

    /**
     * Return current guzzle default settings.
     *
     * @return array
     */
    public static function getDefaultOptions()
    {
        return self::$defaults;
    }

    /**
     * GET request.
     *
     * @param string $url
     * @param array  $options
     *
     * @throws HttpException
     *
     * @return ResponseInterface
     */
    public function get($url, array $options = [])
    {
        return $this->request($url, 'GET', ['query' => $options]);
    }

    public function post($url, $options = [])
    {
        if (empty($options)) {
            return $this->request($url, 'POST');
        }
        return $this->request($url, 'POST', ['json' => $options]);
    }

    public function patch($url, $options = [])
    {

        return $this->request($url, 'PATCH', ['json' => $options]);
    }

    public function put($url, $options = [])
    {
        return $this->request($url, 'PUT', ['json' => $options]);
    }

    public function delete($url, $options = [])
    {
        return $this->request($url, 'DELETE');
    }

    /**方法
     * JSON request.
     *
     * @param string $url
     * @param string|array $options
     * @param array $queries
     * @param int $encodeOption
     *
     * @return ResponseInterface
     *
     * @throws HttpException
     */
    public function json($url, $options = [], $encodeOption = JSON_UNESCAPED_UNICODE, $queries = [])
    {
        is_array($options) && $options = json_encode($options, $encodeOption);

        return $this->request($url, 'POST', ['query' => $queries, 'body' => $options, 'headers' => ['content-type' => 'application/json']]);
    }

    /**
     * Upload file.
     *
     * @param string $url
     * @param array  $files
     * @param array  $form
     *
     * @return ResponseInterface
     *
     * @throws HttpException
     */
    public function upload($url, array $files = [], array $form = [], array $queries = [])
    {
        $multipart = [];

        foreach ($files as $name => $path) {
            $multipart[] = [
                'name' => $name,
                'contents' => fopen($path, 'r'),
            ];
        }

        foreach ($form as $name => $contents) {
            $multipart[] = compact('name', 'contents');
        }

        return $this->request($url, 'POST', ['query' => $queries, 'multipart' => $multipart]);
    }

    /**
     * Set GuzzleHttp\Client.
     *
     * @param \GuzzleHttp\Client $client
     *
     * @return Http
     */
    public function setClient(HttpClient $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Return GuzzleHttp\Client instance.
     *
     * @return \GuzzleHttp\Client
     */
    public function getClient()
    {
        if (!($this->client instanceof HttpClient)) {
            $this->client = new HttpClient();
        }

        return $this->client;
    }

    /**
     * Add a middleware.
     *
     * @param callable $middleware
     *
     * @return $this
     */
    public function addMiddleware(callable $middleware)
    {
        array_push($this->middlewares, $middleware);

        return $this;
    }

    /**
     * Return all middlewares.
     *
     * @return array
     */
    public function getMiddlewares()
    {
        return $this->middlewares;
    }

    /**
     * Make a request.
     *
     * @param string $url
     * @param string $method
     * @param array  $options
     *
     * @throws HttpException
     *
     * @return ResponseInterface
     */
    public function request($url, $method = 'GET', $options = [])
    {
        $method = strtoupper($method);
        $options = array_merge(self::$defaults, $options);
        Log::debug('Client 请求:', compact('url', 'options','method'));
        $options['handler'] = $this->getHandler();
        $response = $this->getClient()->request($method, $url, $options);
        Log::debug('API 响应:', [
            'Status'  => $response->getStatusCode(),
            'Reason'  => $response->getReasonPhrase(),
            'Headers' => $response->getHeaders(),
            'Body'    => strval($response->getBody()),
        ]);

        return $response;
    }

    /**
     * @param \Psr\Http\Message\ResponseInterface|string $body
     *
     * @throws HttpException
     *
     * @return mixed
     */
    public function parseJSON($body)
    {
        if ($body instanceof ResponseInterface) {
            $body = $body->getBody();
        }
        if (empty($body)) {
            return false;
        }
        $contents = json_decode($body, true);
        if (JSON_ERROR_NONE !== json_last_error()) {
            throw new HttpException('Failed to parse JSON: '.json_last_error_msg());
        }

        return $contents;
    }

    /**
     * Build a handler.
     *
     * @return HandlerStack
     */
    protected function getHandler()
    {
        $stack = HandlerStack::create();

        foreach ($this->middlewares as $middleware) {
            $stack->push($middleware);
        }

        if (isset(static::$defaults['handler']) && is_callable(static::$defaults['handler'])) {
            $stack->push(static::$defaults['handler'], self::USER_DEFINED_HANDLER);
        }

        return $stack;
    }
}
