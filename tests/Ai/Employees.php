<?php


namespace EasyFeishu\Tests\Ai;

use EasyFeishu\Tests\TestCase;
use Mayunfeng\Supports\Collection;
class Employees extends TestCase
{
    public function testGetEmployees(){
        $result = $this->getInstance()->employees->getEmployees(['user_id_type'=>'open_id']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetFile(){
        $result = $this->getInstance()->employees->getFile('test');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
}