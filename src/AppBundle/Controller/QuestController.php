<?php

namespace AppBundle\Controller;

use AppBundle\Form\Processor\MemberProcessor;
use AppBundle\Form\Type\LogInType;
use AppBundle\Form\Type\MemberType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class QuestController extends Controller
{
    private $memberProcessor;

    public function __construct(MemberProcessor $memberProcessor)
    {
        $this->memberProcessor = $memberProcessor;
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
    public function loginAction(Request $request)
    {
        $form = $this->createForm(LogInType::class);

        return $this->render('guest/login.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
