<?php

namespace AppBundle\Controller\Admin\Controllers;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MemberController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @Route("/admin/training/list", name="training-list")
     */
    public function showTrainingsAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/admin/training/create", name="training-create")
     */
    public function createTrainingAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}