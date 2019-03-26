<?php

namespace AppBundle\Form\Processor;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;

class InstructorProcessor
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function processCreate(Form $form) {
        $instructor = $form->getData();

        # TODO SHIT CHECKEN EN PUSHEN
    }
}