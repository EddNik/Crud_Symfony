<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Crud
 *
 * @ORM\Table(name="crud")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CrudRepository")
 */
class Crud
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=100)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=100)
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hireDate", type="datetime")
     */
    private $hireDate;

    /**
     * @var int
     * @ORM\Column(name="age", type="integer")
     */
     private $age;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set firstName
     *
     * @param string $firstName
     *
     * @return Crud
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName
     *
     * @return string
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     *
     * @return Crud
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName
     *
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set hireDate
     *
     * @param \DateTime $hireDate
     *
     * @return Crud
     */
    public function setHireDate($hireDate)
    {
        $this->hireDate = $hireDate;

        return $this;
    }

    /**
     * Get hireDate
     *
     * @return \DateTime
     */
    public function getHireDate()
    {
        return $this->hireDate;
    }
    /**
     * Get age
     *
     * @return int
     */
    public function getAge()
    {
        return $this->age;
    }
    /**
     * Set age
     *
     * @param int $age
     *
     * @return Crud
     */
    public function setAge($age)
    {
        $this->age = $age;
        return $this;
    }

}

