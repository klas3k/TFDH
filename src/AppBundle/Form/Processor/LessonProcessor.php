<?php

namespace AppBundle\Form\Processor;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;

class LessonProcessor
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function processRegister(Form $form) {
        $lesson = $form->getData();

        # TODO SHIT CHECKEN EN PUSHEN
    }


}