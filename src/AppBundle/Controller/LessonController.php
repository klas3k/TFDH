<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\LessonType;
use AppBundle\Entity\Lesson;

/**
 * @Route("/lesson")
 */
class LessonController extends Controller
{
    /**
     * @Route("/", name="lesson_index")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $lessons = $em->getRepository(Lesson::class)->findBy([], ["training" => "asc", "time" => "asc"]);

        return $this->render("default/lesson.html.twig", [
            "lessons" => $lessons,
        ]);
    }

    /**
     * @Route("/create", name="lesson_create")
     */
    public function createLessonAction(Request $request)
    {
        $this->denyAccessUnlessGranted('ROLE_INSTRUCTOR');
        $form = $this->createForm(LessonType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $lesson = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($lesson);
            $em->flush();

            $this->addFlash("success", "Les aangemaakt!");

            return $this->redirectToRoute("homepage", $request->query->all());
        }

        return $this->render("default/form.html.twig", [
            "form"   => $form->createView(),
        ]);
    }

    /**
     * @Route("/update/{id}", name="lesson_update")
     */
    public function editLessonAction(Request $request, Lesson $lesson)
    {
        $this->denyAccessUnlessGranted('ROLE_INSTRUCTOR');
        $form = $this->createForm(LessonType::class, $lesson);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $lesson = $form->getData();
            $em->persist($lesson);
            $em->flush();

            $this->addFlash("success", "Les bewerkt!");

            return $this->redirectToRoute("lesson_index", $request->query->all());
        }

        return $this->render("default/form.html.twig", [
            "form"   => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="lesson_delete")
     */
    public function deleteLessonAction(Request $request, Lesson $lesson)
    {
        $this->denyAccessUnlessGranted('ROLE_INSTRUCTOR');
        $em = $this->getDoctrine()->getManager();
        $em->remove($lesson);
        $em->flush();

        $this->addFlash("success", "Les verwijderd!");

        return $this->redirectToRoute("lesson_index", $request->query->all());
    }
}
