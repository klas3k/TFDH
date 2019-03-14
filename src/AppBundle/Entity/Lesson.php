<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Lesson
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $time;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string")
     */
    private $location;

    /**
     * @ORM\Column(type="integer")
     */
    private $max_persons;

    /**
     * @ORM\OneToMany(targetEntity="Registration", mappedBy="lesson", cascade={"persist", "remove"})
     */
    private $registration;

    /**
     * @ORM\ManyToOne(targetEntity="Instructor", inversedBy="lesson", cascade={"persist"})
     */
    private $instuctor;

    /**
     * @ORM\ManyToOne(targetEntity="Training", inversedBy="lesson", cascade={"persist"})
     */
    private $trainings;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getMaxPersons()
    {
        return $this->max_persons;
    }

    /**
     * @param mixed $max_persons
     */
    public function setMaxPersons($max_persons)
    {
        $this->max_persons = $max_persons;
    }

    /**
     * @return mixed
     */
    public function getRegistration()
    {
        return $this->registration;
    }

    /**
     * @param mixed $registration
     */
    public function setRegistration($registration)
    {
        $this->registration = $registration;
    }

    /**
     * @return mixed
     */
    public function getInstuctor()
    {
        return $this->instuctor;
    }

    /**
     * @param mixed $instuctor
     */
    public function setInstuctor($instuctor)
    {
        $this->instuctor = $instuctor;
    }

    /**
     * @return mixed
     */
    public function getTrainings()
    {
        return $this->trainings;
    }

    /**
     * @param mixed $trainings
     */
    public function setTrainings($trainings)
    {
        $this->trainings = $trainings;
    }
}