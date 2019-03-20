<?php

namespace AppBundle\Form\Processor;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;

class MemberProcessor
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function processRegister(Form $form) {
        $member = $form->getData();

        # TODO SHIT CHECKEN EN PUSHEN
    }


}