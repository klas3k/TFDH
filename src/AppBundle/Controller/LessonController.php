<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Lesson;
use AppBundle\Entity\Registration;
use AppBundle\Entity\Training;
use AppBundle\Manager\LessonManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LessonController extends Controller
{
    private $em;
    private $lessonManager;

    public function __construct(EntityManagerInterface $em, LessonManager $lessonManager)
    {
        $this->em = $em;
        $this->lessonManager = $lessonManager;
    }

    /**
     * @Route("/training/{id}", name="trainingDetail")
     */
    public function trainingAction($id, Request $request)
    {
        $training = $this->em->getRepository(Training::class)->find($id);

        return $this->render('guest/training.html.twig', [
            'training' => $training,
            'lessons' => $this->lessonManager->findLessonByTraining($training),
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/lesson/{id}/book", name="lessonBook")
     */
    public function bookAction($id, Request $request)
    {
        $lesson = $this->em->getRepository(Lesson::class)->find($id);
        $member = $this->getUser();

        $booking = new Registration();
        $booking->setLesson($lesson);
        $booking->setMember($member);

        $this->em->persist($booking);
        $this->em->flush();

        return $this->redirectToRoute('trainingDetail', ['id'=>$id]);
    }

    /**
     * @Route("/lesson/{id}/booking/{bookingId}", name="bookingStatus")
     */
    public function bookingStatusAction($id, $bookingId, Request $request)
    {
        $booking = $this->em->getRepository(Registration::class)->find($bookingId);

        return $this->redirectToRoute('trainingDetail', ['id'=>$id]);
    }
}
