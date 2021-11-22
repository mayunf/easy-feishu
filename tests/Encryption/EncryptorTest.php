<?php

namespace EasyFeishu\Encryption;

use EasyFeishu\Core\Exceptions\EncryptionException;
use EasyFeishu\Tests\TestCase;

class EncryptorTest extends TestCase
{
    /**
     * Encrypt string.
     *
     * @throws EncryptionException
     *
     * @return string
     */
    public function testEncrypt()
    {
        $encryptor = new Encryptor('test key');
        $str = $encryptor->decrypt('P37w+VZImNgPEO1RBhJ6RtKl7n6zymIbEG1pReEzghk=');
        $this->assertEquals('hello world', $str);
    }
}
