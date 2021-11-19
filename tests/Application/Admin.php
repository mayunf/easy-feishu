<?php


namespace EasyFeishu\Tests\Application;

use EasyFeishu\Tests\TestCase;
use Mayunfeng\Supports\Collection;
class Admin extends TestCase
{
    public function testIsAdmin(){
        $result = $this->getInstance()->admin->isAdmin(['open_id'=>'ou_37a83aaf1fae3af69be3b89b15231782']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testIsAdminScope(){
        $result = $this->getInstance()->admin->isAdminScope(['open_id'=>'ou_37a83aaf1fae3af69be3b89b15231782']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testAppVisibility(){
        $result = $this->getInstance()->admin->appVisibility(['app_id'=>'cli_a1fa7d0637f85013']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testVisibleApps(){
        $result = $this->getInstance()->admin->visibleApps(['open_id'=>'ou_37a83aaf1fae3af69be3b89b15231782']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testAppList(){
        $result = $this->getInstance()->admin->appList(['page_size'=>10]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testAppUpdate(){
        $result = $this->getInstance()->admin->appUpdate(['app_id'=>'cli_a1fa7d0637f85013']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testAppAdminList(){
        $result = $this->getInstance()->admin->appAdminList();
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }


}