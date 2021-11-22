<?php

namespace EasyFeishu\AccessToken;

use EasyFeishu\Core\Exceptions\HttpException;
use EasyFeishu\Core\Interfaces\AccessTokenInterface;
use Mayunfeng\Supports\Traits\HasHttpRequest;
use Pimple\Container;
use Psr\SimpleCache\CacheInterface;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;

class AccessToken implements AccessTokenInterface
{
    use HasHttpRequest;

    /**
     * @var \Pimple\Container
     */
    protected $app;
    protected $endpointGetToken = 'https://open.feishu.cn/open-apis/auth/v3/tenant_access_token/internal';

    /** @var CacheInterface */
    protected $cache;
    //访问token
    protected $cachePrefix = 'EasyFeishu.access_token.';

    public function __construct(Container $app)
    {
        $this->app = $app;
        $this->cache = $this->app['config']['cache'];
    }

    public function getTokenKey()
    {
        return 'tenant_access_token';
    }

    protected function getCacheKey()
    {
        return $this->cachePrefix;
    }

    /**
     * 获取token.
     *
     * @throws HttpException
     *
     * @return array 返回数组
     */
    public function getToken(): array
    {
        $cacheKey = $this->getCacheKey();
        $cache = $this->getCache();
        if ($cache->has($cacheKey)) {
            return $cache->get($cacheKey);
        }
        $token = $this->requestToken([
            'app_id'     => $this->app['config']['app_id'],
            'app_secret' => $this->app['config']['app_secret'],
        ]);
        $this->setToken($token);

        return $token;
    }

    /**
     * Set token.
     *
     * @param $token
     *
     * @return $this
     */
    public function setToken($token)
    {
        $cacheKey = $this->cachePrefix.$this->app['config']['app_id'];
        $this->getCache()->set($cacheKey, $token[$this->getTokenKey()], $token['expire'] - 60);

        return $this;
    }

    public function removeToken()
    {
        $this->getCache()->delete($this->cachePrefix.$this->app['config']['app_id']);
    }

    public function requestToken(array $arguments): array
    {
        $response = $this->sendRequest($arguments);

        if (empty($response[$this->getTokenKey()])) {
            throw new HttpException('Request access_token fail:'.json_encode($response, JSON_UNESCAPED_UNICODE));
        }

        return $response;
    }

    protected function sendRequest($arguments)
    {
        return $this->post($this->endpointGetToken, $arguments);
    }

    /**
     * Get cache instance.
     *
     * @return CacheInterface
     */
    public function getCache(): CacheInterface
    {
        if ($this->cache) {
            return $this->cache;
        }

        if (property_exists($this, 'app') && $this->app instanceof Container
            && isset($this->app['cache']) && $this->app['cache'] instanceof CacheInterface) {
            return $this->cache = $this->app['cache'];
        }

        return $this->cache = $this->createDefaultCache();
    }

    /**
     * Set default cache.
     *
     * @return CacheInterface
     */
    private function createDefaultCache()
    {
        return new Psr16Cache(new FilesystemAdapter('EasyFeishu', 1500));
    }
}
