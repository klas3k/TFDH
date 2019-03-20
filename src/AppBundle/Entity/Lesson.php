<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Lesson
 *
 * @ORM\Table(name="lesson")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LessonRepository")
 */
class Lesson
{
    /**
     * @ORM\ManyToOne(targetEntity="Training", inversedBy="lessons")
     * @ORM\JoinColumn(name="training_id", referencedColumnName="id")
     */
    private $training;

    /**
     * @ORM\ManyToOne(targetEntity="Instructor", inversedBy="lessons")
     * @ORM\JoinColumn(name="instructor_id", referencedColumnName="id")
     */
    private $instructor;

    /**
     * @ORM\OneToMany(targetEntity="Registration", mappedBy="lesson")
     */
    private $registrations;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="time", type="datetime")
     */
    private $time;

    /**
     * @var string
     *
     * @ORM\Column(name="location", type="string", length=255)
     */
    private $location;

    /**
     * @var int
     *
     * @ORM\Column(name="max_people", type="integer")
     */
    private $maxPeople;

    public function __construct() {
        $this->registrations = new ArrayCollection();
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
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Lesson
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Lesson
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set maxPeople
     *
     * @param integer $maxPeople
     *
     * @return Lesson
     */
    public function setMaxPeople($maxPeople)
    {
        $this->maxPeople = $maxPeople;

        return $this;
    }

    /**
     * Get maxPeople
     *
     * @return int
     */
    public function getMaxPeople()
    {
        return $this->maxPeople;
    }

    /**
     * Get the value of training
     * 
     * @return int
     */ 
    public function getTraining()
    {
        return $this->training;
    }

    /**
     * Set the value of training
     * 
     * @param integer $training
     *
     * @return Lesson
     */ 
    public function setTraining($training)
    {
        $this->training = $training;

        return $this;
    }

    /**
     * Get the value of instructor
     * 
     * @return int
     */ 
    public function getInstructor()
    {
        return $this->instructor;
    }

    /**
     * Set the value of instructor
     *
     * @param integer $instructor
     * 
     * @return Lesson
     */ 
    public function setInstructor($instructor)
    {
        $this->instructor = $instructor;

        return $this;
    }

    /**
     * Get the value of registrations
     * 
     * @return int
     */ 
    public function getRegistrations()
    {
        return $this->registrations;
    }
}

