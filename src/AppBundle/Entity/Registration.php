<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Registration
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $paymentStatus = RegistrationStatus::PENDING;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="registration", cascade={"persist"})
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     *
     */
    private $member;

    /**
     *
     * @ORM\ManyToOne(targetEntity="Lesson", inversedBy="registration", cascade={"persist"})
     * @ORM\JoinColumn(name="lesson_id", referencedColumnName="id")
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
    public function getPaymentStatus()
    {
        return $this->paymentStatus;
    }

    /**
     * @param mixed $paymentStatus
     */
    public function setPaymentStatus($paymentStatus)
    {
        $this->paymentStatus = $paymentStatus;
    }

    public function setMember(Member $member = null)
    {
        $this->member = $member;
        return $this;
    }

    public function getMember()
    {
        return $this->member;
    }


    public function setLesson(Lesson $lesson = null)
    {
        $this->lesson = $lesson;
        return $this;
    }

    public function getMedia()
    {
        return $this->lesson;
    }


}