<?php

namespace EasyFeishu\Encryption;

use EasyFeishu\Core\Exception as BaseException;
use EasyFeishu\Core\Exceptions\EncryptionException;
use EasyFeishu\Core\Exceptions\InvalidConfigException;

class Encryptor
{
    /**
     * AES key.
     *
     * @var string
     */
    protected $encryptKey;

    /**
     * Constructor.
     *
     * @param string $encryptKey
     */
    public function __construct(string $encryptKey)
    {
        $this->encryptKey = $encryptKey;
    }

    /**
     * Return AESKey.
     *
     * @throws InvalidConfigException
     *
     * @return string
     */
    protected function getEncryptKey(): string
    {
        if (empty($this->encryptKey)) {
            throw new InvalidConfigException("Configuration mission, 'encrypt_key' is required.");
        }

        return hash('sha256', $this->encryptKey, true);
    }

    /**
     * Decrypt message.
     *
     * @param string $encrypted
     *
     * @throws EncryptionException
     *
     * @return string
     */
    public function decrypt(string $encrypted): string
    {
        try {
            $key = $this->getEncryptKey();
            $ciphertext = base64_decode($encrypted, true);
            $iv = substr($key, 0, 16);
            $decrypted = openssl_decrypt($ciphertext, 'aes-256-cbc', $key, OPENSSL_RAW_DATA, $iv);

            return substr($decrypted, 16);
        } catch (BaseException $e) {
            throw new EncryptionException($e->getMessage(), EncryptionException::ERROR_DECRYPT_AES);
        }
    }

    /**
     * @param array $content
     *
     * @return mixed
     */
    public function decryptMsg(array $content)
    {
        $json = $this->decrypt($content['encrypt']);

        return json_decode($json, true);
    }
}
