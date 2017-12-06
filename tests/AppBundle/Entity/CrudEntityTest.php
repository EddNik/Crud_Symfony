<?php
namespace tests\AppBundle\Entity;

use AppBundle\Entity\Crud;
use DateTime;
use PHPUnit\Framework\TestCase;

class CrudEntityTest extends TestCase
{
     public function testEmpty_Id()
    {
        $crud = new Crud();
        $this->assertNull($crud->getId());
    }
    public function testFirstName()
    {
         $crud = new Crud();
         $crud->setFirstName('Tomas');
         $this->assertEquals('Tomas', $crud->getFirstName());
    }
    public function testLastName()
    {
        $crud = new Crud();
        $crud->setLastName('Hardy');
        $this->assertEquals('Hardy', $crud->getLastName());
    }
    public function testAge()
    {
        $crud = new Crud();
        $crud->setAge(35);
        $this->assertEquals(35, $crud->getAge());
    }
    public function testHireDate()
    {
        $crud = new Crud();
        $time = new DateTime();
        $crud->setHireDate($time);
        $this->assertEquals($time, $crud->getHireDate());
    }
}