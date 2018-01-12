<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUsersData extends Fixture
{
    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $userFirst = new User();
        $userSecond = new User();
        $userFirst->setUsername('cat');
        $userFirst->setPassword(password_hash('edd', PASSWORD_BCRYPT));
        $userFirst->setEmail('cat@gmail.com');
        $userSecond->setUsername('admin');
        $userSecond->setPassword(password_hash('admin', PASSWORD_BCRYPT));
        $userSecond->setEmail('admin@gmail.com');
        $manager->persist($userFirst);
        $manager->persist($userSecond);
        $manager->flush();
    }
}
