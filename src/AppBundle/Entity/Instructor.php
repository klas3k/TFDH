<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Instructor extends User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $hiringData;

    /**
     * @ORM\Column(type="integer")
     */
    private $salary;

    /**
     * @ORM\OneToMany(targetEntity="Lesson", mappedBy="instuctor", cascade={"persist", "remove"})
     */
    private $lesson;

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
    public function getHiringData()
    {
        return $this->hiringData;
    }

    /**
     * @param mixed $hiringData
     */
    public function setHiringData($hiringData)
    {
        $this->hiringData = $hiringData;
    }

    /**
     * @return mixed
     */
    public function getSalary()
    {
        return $this->salary;
    }

    /**
     * @param mixed $salary
     */
    public function setSalary($salary)
    {
        $this->salary = $salary;
    }

    /**
     * @return mixed
     */
    public function getLesson()
    {
        return $this->lesson;
    }

    /**
     * @param mixed $lesson
     */
    public function setLesson($lesson)
    {
        $this->lesson = $lesson;
    }

    public function __toString()
    {
        return $this->getPrefix().' '.$this->getLastname();
    }
}