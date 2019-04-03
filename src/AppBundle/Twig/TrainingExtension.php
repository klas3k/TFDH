<?php

namespace AppBundle\Twig;

use AppBundle\Entity\Lesson;
use AppBundle\Entity\Member;
use AppBundle\Entity\Registration;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class TrainingExtension extends AbstractExtension
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('getBooking', array($this, 'getBooking')),
            new TwigFunction('getBookingStatus', array($this, 'getBookingStatus')),
        );
    }

    public function getBooking(Lesson $lesson, $member)
    {
        $booking = $this->em->getRepository(Registration::class)->findOneBy(['lesson'=>$lesson, 'member'=>$member]);

        return $booking;
    }

    public function getBookingStatus($status) {

        switch ($status) {
            case -1:
                return 'Betaling gefaald';
            case 0:
                return 'Canceled';
            case 1:
                return 'Betaaling verwacht';
            case 3:
                return 'Betaald';
        }

        return 'GEEN STATUS';
    }
}