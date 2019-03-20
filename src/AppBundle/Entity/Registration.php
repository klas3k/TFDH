<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Registration
 *
 * @ORM\Table(name="registration")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RegistrationRepository")
 */
class Registration
{
    /**
     * @ORM\ManyToOne(targetEntity="Lesson", inversedBy="registrations")
     * @ORM\JoinColumn(name="lesson_id", referencedColumnName="id")
     */
    private $lesson;

    /**
     * @ORM\ManyToOne(targetEntity="Member", inversedBy="registrations")
     * @ORM\JoinColumn(name="member_id", referencedColumnName="id")
     */
    private $member;

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
     * @ORM\Column(name="payment", type="string", length=255, nullable=true)
     */
    private $payment;


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
     * Set payment
     *
     * @param string $payment
     *
     * @return Registration
     */
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get payment
     *
     * @return string
     */
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Get the value of lesson
     * 
     * @return int
     */ 
    public function getLesson()
    {
        return $this->lesson;
    }

    /**
     * Set the value of lesson
     * 
     * @param integer $lesson
     *
     * @return Registration
     */ 
    public function setLesson($lesson)
    {
        $this->lesson = $lesson;

        return $this;
    }

    /**
     * Get the value of member
     * 
     * @return int
     */ 
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Set the value of member
     *
     * @param integer $member
     * 
     * @return Registration
     */ 
    public function setMember($member)
    {
        $this->member = $member;

        return $this;
    }
}

