<?php


namespace EasyFeishu\Tests\Application;

use EasyFeishu\Tests\TestCase;
use Mayunfeng\Supports\Collection;
class Order extends TestCase
{
    public function testCheckUser(){
        $result = $this->getInstance()->order->checkUser(['open_id'=>'ou_37a83aaf1fae3af69be3b89b15231782']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testOrderList(){
        $result = $this->getInstance()->order->orderList(['page_size'=>10]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetOrder(){
        $result = $this->getInstance()->order->getOrder(['order_id'=>'6717597079260102659']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetAppOverview(){
        $result = $this->getInstance()->order->getAppOverview('cli_a1fa7d0637f85013',['ability'=>'app','cycle_type'=>1,'date'=>'2021-11-18']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testTenant(){
        $result = $this->getInstance()->tenant->getTenant();
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }


}