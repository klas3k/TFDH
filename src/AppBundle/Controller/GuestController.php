<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Instructor;
use AppBundle\Entity\User;
use AppBundle\Form\Processor\MemberProcessor;
use AppBundle\Form\Type\MemberType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class GuestController extends Controller
{
    private $memberProcessor;
    private $em;

    public function __construct(MemberProcessor $memberProcessor, EntityManagerInterface $em)
    {
        $this->memberProcessor = $memberProcessor;
        $this->em = $em;
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage');
        }

        $form = $this->createForm(MemberType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->memberProcessor->processRegister($form);
            return $this->redirectToRoute('homepage');
        }

        return $this->render('guest/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('homepage');
        }

        return $this->render('guest/login.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error'         => $authenticationUtils->getLastAuthenticationError(),
        ]);
    }
}
