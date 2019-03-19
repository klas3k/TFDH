<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\Person;

/**
 * Instructor
 *
 * @ORM\Table(name="instructor")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\InstructorRepository")
 */
class Instructor extends Person
{
    /**
     * @ORM\OneToMany(targetEntity="Lesson", mappedBy="instructor")
     */
    private $lessons;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hiring_date", type="datetime")
     */
    private $hiringDate;

    /**
     * @var int
     *
     * @ORM\Column(name="salary", type="integer")
     */
    private $salary;

    public function __construct() {
        $this->lessons = new ArrayCollection();
    }

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
     * Set hiringDate
     *
     * @param \DateTime $hiringDate
     *
     * @return Instructor
     */
    public function setHiringDate($hiringDate)
    {
        $this->hiringDate = $hiringDate;

        return $this;
    }

    /**
     * Get hiringDate
     *
     * @return \DateTime
     */
    public function getHiringDate()
    {
        return $this->hiringDate;
    }

    /**
     * Set salary
     *
     * @param integer $salary
     *
     * @return Instructor
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;

        return $this;
    }

    /**
     * Get salary
     *
     * @return int
     */
    public function getSalary()
    {
        return $this->salary;
    }
}

