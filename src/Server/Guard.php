<?php


namespace EasyFeishu\Server;


use EasyFeishu\Core\Exceptions\InvalidArgumentException;
use EasyFeishu\Core\Exceptions\RuntimeException;
use EasyFeishu\Encryption\Encryptor;
use Mayunfeng\Supports\Collection;
use Mayunfeng\Supports\Log;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Guard
{
    const SUCCESS_EMPTY_RESPONSE = 'success';

    /**
     * @var Request
     */
    protected $request;


    /**
     * @var Encryptor
     */
    protected $encryptor;
    /**
     * @var bool
     */
    public $debug;

    /**
     * @var string|callable
     */
    protected $messageHandler;


    /**
     * Event handlers.
     *
     * @var Collection
     */
    protected $handlers;


    /**
     * Constructor.
     *
     * @param  Request|null  $request
     */
    public function __construct(Request $request = null)
    {
        $this->request = $request ?: Request::createFromGlobals();
    }


    /**
     * Enable/Disable debug mode.
     *
     * @param  bool  $debug
     *
     * @return $this
     */
    public function debug(bool $debug = true): Guard
    {
        $this->debug = $debug;

        return $this;
    }

    /**
     * Handle and return response.
     *
     * @return Response
     *
     */
    public function serve(): Response
    {
        $message = $this->getMessage();

        Log::debug('Event received:', $message);

        $this->handleEventMessage($message);

        return new Response(self::SUCCESS_EMPTY_RESPONSE);

    }


    /**
     * Add a event listener.
     *
     * @param  callable|null  $callback
     * @return Guard
     *
     * @throws InvalidArgumentException
     */
    public function setMessageHandler(callable $callback = null): Guard
    {
        if (!is_callable($callback)) {
            throw new InvalidArgumentException('Argument #2 is not callable.');
        }

        $this->messageHandler = $callback;

        return $this;
    }

    /**
     * Return the message listener.
     *
     * @return string
     */
    public function getMessageHandler()
    {
        return $this->messageHandler;
    }

    /**
     * Request getter.
     *
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * Request setter.
     *
     * @param  Request  $request
     *
     * @return $this
     */
    public function setRequest(Request $request): Guard
    {
        $this->request = $request;

        return $this;
    }


    /**
     * Set Encryptor.
     *
     * @param  Encryptor  $encryptor
     *
     * @return Guard
     */
    public function setEncryptor(Encryptor $encryptor): Guard
    {
        $this->encryptor = $encryptor;

        return $this;
    }

    /**
     * Return the encryptor instance.
     *
     * @return Encryptor
     */
    public function getEncryptor(): Encryptor
    {
        return $this->encryptor;
    }

    /**
     * Get request message.
     *
     * @return array
     *
     */
    public function getMessage(): array
    {
        $message = $this->parseMessageFromRequest($this->request->request->all());

        if (!is_array($message) || empty($message)) {
            throw new BadRequestException('Invalid request.');
        }

        return $message;
    }

    /**
     * Parse message array from raw php input.
     *
     * @param  array  $content
     *
     * @return array
     * @throws RuntimeException
     */
    protected function parseMessageFromRequest(array $content): array
    {

        if ($this->isSafeMode()) {
            if (!$this->encryptor) {
                throw new RuntimeException('Safe mode Encryptor is necessary, please use Guard::setEncryptor(Encryptor $encryptor) set the encryptor instance.');
            }
            $content = $this->encryptor->decryptMsg($content);
        }

        return $content;
    }

    /**
     * Check the request message safe mode.
     *
     * @return bool
     */
    private function isSafeMode(): bool
    {
        return $this->request->request->has('encrypt');
    }

    protected function handleEventMessage(array $message)
    {
        Log::debug('OpenPlatform Event Message detail:', $message);

        $message = new Collection($message);

        // 仅处理事件
        if ($messageHandler = $this->getMessageHandler()) {
            call_user_func_array($messageHandler, [$message]);
        }
    }

}