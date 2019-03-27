<?php

namespace AppBundle\Controller\Admin;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class AdminController extends Controller
{
    /**
     * @Route("/admin", name="admin-dashboard")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function adminDashboardAction(Request $request)
    {
        return $this->render('admin/adminBase.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/admin/login", name="admin-login")
     */
    public function adminLoginAction(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('admin/adminLogin.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }
}