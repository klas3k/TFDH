<?php

namespace AppBundle\Manager;


use AppBundle\Entity\Lesson;
use AppBundle\Entity\Training;
use Doctrine\ORM\EntityManagerInterface;

class LessonManager
{
    private $em;
    private $lessonManager;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->lessonManager = $this->em->getRepository(Lesson::class);
    }

    public function findLessonByTraining(Training $training) {
        return $this->lessonManager->findBy(['trainings'=>$training]);
    }

}