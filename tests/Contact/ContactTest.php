<?php

namespace EasyFeishu\Tests\Soft;

use EasyFeishu\Tests\TestCase;
use Mayunfeng\Supports\Collection;

class ContactTest extends TestCase
{
    public function testPostDepartments()
    {
        $result = $this->getInstance()->contact->postDepartments([
            'parent_department_id' => 0,
            'name' => 'test department13'
        ]);
        dump($result);
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testGetDepartments()
    {
        $result = $this->getInstance()->contact->getDepartments(['parent_department_id' => 0]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }


    public function testGetDepartmentsById()
    {
        $result = $this->getInstance()->contact->getDepartmentsById('od-dd4472cd9b9adfc90abd0dddc9911434');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }


    public function testGetDepartmentsParent()
    {
        $result = $this->getInstance()->contact->getDepartmentsParent(['department_id' => 'od-dd4472cd9b9adfc90abd0dddc9911434']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testPatchDepartments()
    {
        $result = $this->getInstance()->contact->patchDepartments('od-dd4472cd9b9adfc90abd0dddc9911434', ['name' => 'new name']);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }

    public function testPutDepartments()
    {
        $result = $this->getInstance()->contact->putDepartments('od-dd4472cd9b9adfc90abd0dddc9911434', ['name' => 'new name 222', 'parent_department_id' => 0]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }


    public function testDeleteDepartments()
    {
        $result = $this->getInstance()->contact->deleteDepartments('od-dd4472cd9b9adfc90abd0dddc9911434');
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }


    public function testUsers()
    {
        $result = $this->getInstance()->contact->users(['department_id' => 0]);
        dump($result->toArray());
        $this->assertInstanceOf(Collection::class, $result);
    }
}
