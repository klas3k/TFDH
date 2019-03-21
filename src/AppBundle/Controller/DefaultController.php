<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\LessonType;
use AppBundle\Entity\Lesson;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        return $this->render("default/home.html.twig", [
            "name" => "John Doe",
        ]);
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
            "name" => "John Doe",
            "form"   => $form->createView(),
        ]);
    }
}
