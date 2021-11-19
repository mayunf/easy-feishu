<?php


namespace EasyFeishu\Server;


use EasyFeishu\Core\Exceptions\EncryptionException;
use EasyFeishu\Core\Exceptions\FaultException;
use EasyFeishu\Core\Exceptions\InvalidArgumentException;
use EasyFeishu\Core\Exceptions\RuntimeException;
use EasyFeishu\Encryption\EncryptorTest;
use Mayunfeng\Supports\Collection;
use Mayunfeng\Supports\Log;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class Guard
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * @var string
     */
    protected $token;

    /**
     * @var EncryptorTest
     */
    protected $encryptor;
    /**
     * @var bool
     */
    private $debug;

    /**
     * @var string|callable
     */
    protected $messageHandler;

    /**
     * @var int
     */
    protected $messageFilter;

    /**
     * Constructor.
     *
     * @param  string  $token
     * @param  Request|null  $request
     */
    public function __construct(string $token, Request $request = null)
    {
        $this->token = $token;
        $this->request = $request ?: Request::createFromGlobals();
    }
    /**
     * Enable/Disable debug mode.
     *
     * @param  bool  $debug
     *
     * @return $this
     */
    public function debug(bool $debug = true)
    {
        $this->debug = $debug;

        return $this;
    }
    /**
     * Handle and return response.
     *
     * @return Response
     *
     * @throws BadRequestException
     */
    public function serve()
    {
        Log::debug('Request received:', [
            'Method' => $this->request->getMethod(),
            'URI' => $this->request->getRequestUri(),
            'Query' => $this->request->getQueryString(),
            'Protocal' => $this->request->server->get('SERVER_PROTOCOL'),
            'Content' => $this->request->getContent(),
        ]);

        $this->validate($this->token);

        if ($str = $this->request->get('echostr')) {
            Log::debug("Output 'echostr' is '$str'.");

            return new Response($str);
        }

        $result = $this->handleRequest();

        $response = $this->buildResponse($result['to'], $result['from'], $result['response']);

        Log::debug('Server response created:', compact('response'));

        return new Response($response);
    }

    /**
     * Validation request params.
     *
     * @param string $token
     *
     * @throws FaultException
     */
    public function validate($token)
    {
        $params = [
            $token,
            $this->request->get('timestamp'),
            $this->request->get('nonce'),
        ];

        if (!$this->debug && $this->request->get('signature') !== $this->signature($params)) {
            throw new FaultException('Invalid request signature.', 400);
        }
    }


    /**
     * Add a event listener.
     *
     * @param callable $callback
     * @param int      $option
     *
     * @return Guard
     *
     * @throws InvalidArgumentException
     */
    public function setMessageHandler($callback = null, $option = self::ALL_MSG)
    {
        if (!is_callable($callback)) {
            throw new InvalidArgumentException('Argument #2 is not callable.');
        }

        $this->messageHandler = $callback;
        $this->messageFilter = $option;

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
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Request setter.
     *
     * @param Request $request
     *
     * @return $this
     */
    public function setRequest(Request $request)
    {
        $this->request = $request;

        return $this;
    }


    /**
     * Set Encryptor.
     *
     * @param EncryptorTest $encryptor
     *
     * @return Guard
     */
    public function setEncryptor(EncryptorTest $encryptor)
    {
        $this->encryptor = $encryptor;

        return $this;
    }

    /**
     * Return the encryptor instance.
     *
     * @return EncryptorTest
     */
    public function getEncryptor()
    {
        return $this->encryptor;
    }

    /**
     * Build response.
     *
     * @param $to
     * @param $from
     * @param mixed $message
     *
     * @return string
     *
     * @throws \EasyFeishu\Core\Exceptions\InvalidArgumentException
     */
    protected function buildResponse($to, $from, $message)
    {
        if (empty($message) || self::SUCCESS_EMPTY_RESPONSE === $message) {
            return self::SUCCESS_EMPTY_RESPONSE;
        }

        if ($message instanceof RawMessage) {
            return $message->get('content', self::SUCCESS_EMPTY_RESPONSE);
        }

        if (is_string($message) || is_numeric($message)) {
            $message = new Text(['content' => $message]);
        }

        if (!$this->isMessage($message)) {
            $messageType = gettype($message);

            throw new InvalidArgumentException("Invalid Message type .'{$messageType}'");
        }

        $response = $this->buildReply($to, $from, $message);

        if ($this->isSafeMode()) {
            Log::debug('Message safe mode is enable.');
            $response = $this->encryptor->encryptMsg(
                $response,
                $this->request->get('nonce'),
                $this->request->get('timestamp')
            );
        }

        return $response;
    }

    /**
     * Whether response is message.
     *
     * @param mixed $message
     *
     * @return bool
     */
    protected function isMessage($message)
    {
        if (is_array($message)) {
            foreach ($message as $element) {
                if (!is_subclass_of($element, AbstractMessage::class)) {
                    return false;
                }
            }

            return true;
        }

        return is_subclass_of($message, AbstractMessage::class);
    }

    /**
     * Get request message.
     *
     * @return array
     *
     * @throws BadRequestException
     */
    public function getMessage()
    {
        $message = $this->parseMessageFromRequest($this->request->getContent(false));

        if (!is_array($message) || empty($message)) {
            throw new BadRequestException('Invalid request.');
        }

        return $message;
    }
    /**
     * Handle request.
     *
     * @return array
     *
     * @throws RuntimeException
     * @throws \EasyFeishu\Core\Exceptions\BadRequestException
     */
    protected function handleRequest()
    {
        $message = $this->getMessage();
        $response = $this->handleMessage($message);

        $messageType = $message['msg_type'] ?? $message['MsgType'];

        if ('device_text' === $messageType) {
            $message['FromUserName'] = '';
            $message['ToUserName'] = '';
        }

        return [
            'to' => $message['FromUserName'],
            'from' => $message['ToUserName'],
            'response' => $response,
        ];
    }
    /**
     * Handle message.
     *
     * @param array $message
     *
     * @return mixed
     */
    protected function handleMessage(array $message)
    {
        $handler = $this->messageHandler;

        if (!is_callable($handler)) {
            Log::debug('No handler enabled.');

            return null;
        }

        Log::debug('Message detail:', $message);

        $message = new Collection($message);

        $messageType = $message->get('msg_type', $message->get('MsgType'));

        $type = $this->messageTypeMapping[$messageType];

        $response = null;

        if ($this->messageFilter & $type) {
            $response = call_user_func_array($handler, [$message]);
        }

        return $response;
    }

    /**
     * Build reply XML.
     *
     * @param string          $to
     * @param string          $from
     * @param AbstractMessage $message
     *
     * @return string
     */
    protected function buildReply($to, $from, $message)
    {
        $base = [
            'ToUserName' => $to,
            'FromUserName' => $from,
            'CreateTime' => time(),
            'MsgType' => is_array($message) ? current($message)->getType() : $message->getType(),
        ];

        $transformer = new Transformer();

        return XML::build(array_merge($base, $transformer->transform($message)));
    }

    /**
     * Get signature.
     *
     * @param array $request
     *
     * @return string
     */
    protected function signature($request)
    {
        sort($request, SORT_STRING);

        return sha1(implode($request));
    }

    /**
     * Parse message array from raw php input.
     *
     * @param string|resource $content
     *
     * @return array
     * @throws EncryptionException
     *
     * @throws RuntimeException
     */
    protected function parseMessageFromRequest($content)
    {
        $content = strval($content);

        $dataSet = json_decode($content, true);
        if ($dataSet && (JSON_ERROR_NONE === json_last_error())) {
            // For mini-program JSON formats.
            // Convert to XML if the given string can be decode into a data array.
            $content = XML::build($dataSet);
        }

        if ($this->isSafeMode()) {
            if (!$this->encryptor) {
                throw new RuntimeException('Safe mode Encryptor is necessary, please use Guard::setEncryptor(Encryptor $encryptor) set the encryptor instance.');
            }

            $message = $this->encryptor->decryptMsg(
                $this->request->get('msg_signature'),
                $this->request->get('nonce'),
                $this->request->get('timestamp'),
                $content
            );
        } else {
            $message = XML::parse($content);
        }

        return $message;
    }
    /**
     * Check the request message safe mode.
     *
     * @return bool
     */
    private function isSafeMode()
    {
        return $this->request->get('encrypt_type') && 'aes' === $this->request->get('encrypt_type');
    }
}