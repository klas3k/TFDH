<?php

namespace AppBundle\Controller\Admin;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
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
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showMembersAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/admin/member/create", name="member-create")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function createMemberAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }
}