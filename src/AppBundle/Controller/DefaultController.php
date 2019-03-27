<?php

namespace AppBundle\Controller;

use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\LessonType;
use AppBundle\Entity\Lesson;

use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/login", name="login")
     */
    public function loginAction(Request $request, AuthenticationUtils $authUtils)
    {
        $error = $authUtils->getLastAuthenticationError();
        $lastUsername = $authUtils->getLastUsername();

        return $this->render("default/login.html.twig", [
            "last_username" => $lastUsername,
            "error"         => $error,
        ]);
    }

    /**
     * @Route("/instructor", name="instructor")
     */
    public function instructorAction(Request $request)
    {
        return new Response("<html><body>instructor</body></html>");
    }

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render("default/home.html.twig");
    }

    /**
     * @Route("/create_lesson", name="lesson_create")
     */
    public function createLessonAction(Request $request)
    {
        $lesson = new Lesson();
        $lesson->setTime(new \DateTime);

        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lesson = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($lesson);
            $em->flush();

            $this->addFlash('success', 'Les aangemaakt!');

            return $this->redirectToRoute("homepage", $request->query->all());
        }

        return $this->render("default/form.html.twig", [
            "form"   => $form->createView(),
        ]);
    }
}
