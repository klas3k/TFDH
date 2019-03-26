<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminLessonController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @Route("/admin/lesson/list", name="lesson-list")
     */
    public function showLessonsAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/admin/lesson/create", name="lesson-create")
     */
    public function createLessonAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}