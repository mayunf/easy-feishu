<?php

namespace EasyFeishu\Tests\Server;

use EasyFeishu\Tests\TestCase;
use Mayunfeng\Supports\Collection;
use Symfony\Component\HttpFoundation\Request;

class ServerGuardTest extends TestCase
{
    public function getRuest()
    {
        $post = [
            'encrypt' => 'DTOOgpSzzo2+ndUAYyBLA0w8CsXCniu7ViDktIxVWZDOyen8LfdKEjFgXq5mCshSlgxi+3BSx0w2pNO+uZDHgQMCqeW+WocGmXnfijUlzwCHq+zZq2WFGJ72bfe3/F9e+Z4CJhNC5gLOeA8YT4yhg3rwWR5ghPuh+wadxecD3y85/dcVsXRN7f8d1LSJnFxxqh9JlpKHIUsnQq5xBSXeJdHlrXvoB+M3ilQrVNSA1bqDEP2I2ASCBKe3UORY6VJqyq8ncr9SZAUbjKusoM1hoTe4V5iRwvP7qttn4Tw1Tx7FWbB9kpXd1xMOmeMWNhKIt9Y+VNvFDzmAf9NKJX4eP5tGlFwlQr4p5Y9kd2LI+OEQqgKI57zTe7kI91+lLN0WtEWiwCPveeRCHbcUIl/1Whycmo3Dd0/JN4fZ+M182CSmFPauvK7iVL40S2zVj0trh2tZAoRabjwrUP4VqVSMwAtzbsJ9Fzhfe4eCwLgXymxiG+m1uaHy8/iiPpsFciwaHivgkn+TsmUfuRA3vgQ5yUfmV7znW4Ohef+oVTKB1qPtZtM16HvThYxRz6F6scsabMRxanOEx87nZUsQ14Ik/ra0J17b3yD8bmyWEB+uytq638+uvx5UX7VVNY0vfhNMbt3wtpLkyhr3+g+DHjpXJ6PTXO+Hr9z6c0v5deq88CCo0aIcJWeUopM9YZ3HUL5hsuFNJInMm+VURIVSOmSe3qt/VDUVIhD9GhqcvqrpFjYjBQzZ/Q2FeHAlo3HcYYiX9q3eQtI7/NXIkS81wCv2JNHvFblRcfH5yCa5lAoKV1l57sh40ZIifAQ9T/rm7gR9z0Ew7kOaAn1uSzMR94gMaks+MrWZIIrolPB/I0R7BpPa5Q+0IrZfwWq5AmV5YrZibG1AaFTJUDZX1XrgM40KPTRTB+u0PMQG7Vb2IqNYQGAS3ZhuMyUbHOb5nDgWISWR',
        ];

        return new Request([], $post);
    }

    public function testGetMessage()
    {
        $server = $this->getInstance()->server;
        $server->setRequest($this->getRuest());
        $message = $server->getMessage();
        $this->assertArrayHasKey('header', $message);
    }

    /**
     * @throws \EasyFeishu\Core\Exceptions\InvalidArgumentException
     */
    public function testStringResponse()
    {
        $server = $this->getInstance()->server;
        $server->setRequest($this->getRuest());
        $server->setMessageHandler(function (Collection $message) {
            $this->assertIsArray($message->toArray());
        });
        $server->serve()->send();
    }
}
