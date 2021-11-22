<?php

namespace EasyFeishu\Tests\Mina;

use EasyFeishu\Tests\TestCase;
use Mayunfeng\Supports\Collection;

class Mina extends TestCase
{
    public function testCode2Session()
    {
        $result = $this->getInstance()->mina->code2session('5fc9886bb681a683');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

}
