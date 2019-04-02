<?php

namespace AppBundle\Form\Processor;


use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RequestStack;

class MemberProcessor
{
    private $em;
    private $requestStack;

    public function __construct(EntityManagerInterface $em, RequestStack $requestStack)
    {
        $this->em = $em;
        $this->requestStack = $requestStack;
    }

    public function processRegister(Form $form) {
        $request = $this->requestStack->getCurrentRequest();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $member = $form->getData();
            $member->setUsername($member->getEmail());
            $member->setRoles(['ROLE_USER']);

            $this->em->persist($member);
            $this->em->flush();
        }
    }


}