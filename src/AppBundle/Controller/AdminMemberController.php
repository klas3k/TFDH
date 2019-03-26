<?php

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminMemberController extends Controller
{
    public function __construct()
    {
    }

    /**
     * @Route("/admin/member/list", name="member-list")
     */
    public function showMembersAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/admin/member/create", name="member-create")
     */
    public function createMemberAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}