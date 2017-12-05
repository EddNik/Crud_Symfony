<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\Crud;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class DefaultArticleData extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $crud = new Crud();
        $crud->setFirstName('Tomas');
        $crud->setLastName('Hardy');
        $crud->setHireDate(new \DateTime());
        $crud->setAge(35);
        $manager->persist($crud);
        $manager->flush();
    }
}