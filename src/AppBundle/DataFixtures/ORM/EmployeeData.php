<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Employee;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EmployeeData extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $employee = new Employee();
        $employee->setFirstName('Tomas');
        $employee->setLastName('Hardy');
        $employee->setHireDate(new \DateTime());
        $employee->setAge(35);
        $manager->persist($employee);
        $manager->flush();
    }
}
