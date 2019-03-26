<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin-dashboard")
     */
    public function adminDashboardAction(Request $request)
    {
        return $this->render('admin/adminBase.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/admin/login", name="admin-dashboard")
     */
    public function showLessonsAction(Request $request)
    {
        return $this->render('admin/adminBase.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}