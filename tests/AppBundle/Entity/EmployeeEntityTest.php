<?php
namespace tests\AppBundle\Entity;

use AppBundle\Entity\Employee;
use DateTime;
use PHPUnit\Framework\TestCase;

class EmployeeEntityTest extends TestCase
{
     public function testEmpty_Id()
    {
        $employee = new Employee();
        $this->assertNull($employee->getId());
    }
    public function testFirstName()
    {
         $employee = new Employee();
         $employee->setFirstName('Tomas');
         $this->assertEquals('Tomas', $employee->getFirstName());
    }
    public function testLastName()
    {
        $employee = new Employee();
        $employee->setLastName('Hardy');
        $this->assertEquals('Hardy', $employee->getLastName());
    }
    public function testAge()
    {
        $employee = new Employee();
        $employee->setAge(35);
        $this->assertEquals(35, $employee->getAge());
    }
    public function testHireDate()
    {
        $employee = new Employee();
        $time = new DateTime();
        $employee->setHireDate($time);
        $this->assertEquals($time, $employee->getHireDate());
    }
}