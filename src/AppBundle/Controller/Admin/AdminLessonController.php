<?php

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Lesson;
use AppBundle\Form\Processor\LessonProcessor;
use AppBundle\Form\Type\LessonType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminLessonController extends Controller
{
    private $lessonProcessor;
    private $em;

    public function __construct(LessonProcessor $lessonProcessor, EntityManagerInterface $em)
    {
        $this->lessonProcessor = $lessonProcessor;
        $this->em = $em;
    }

    /**
     * @Route("/admin/lesson/list", name="lesson-list")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function showLessonsAction(Request $request)
    {
        return $this->render('admin/lesson/lessonList.html.twig', [
            'user' => $this->getUser(),
            'lessons' => $this->em->getRepository(Lesson::class)->findAll(),
        ]);
    }

    /**
     * @Route("/admin/lesson/create", name="lesson-create")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function createLessonAction(Request $request)
    {
        $form = $this->createForm(LessonType::class);

        $this->lessonProcessor->processForm($form);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('lesson-list');
        }

        return $this->render('admin/lesson/lessonCRUD.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/lesson/{id}/edit", name="lesson-edit")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editLessonAction($id, Request $request)
    {
        $form = $this->createForm(LessonType::class, $this->em->getRepository(Lesson::class)->find($id));

        $this->lessonProcessor->processForm($form);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('lesson-list');
        }

        return $this->render('admin/lesson/lessonCRUD.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/lesson/{id}/view", name="lesson-view")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function viewLessonAction($id, Request $request)
    {
        $form = $this->createForm(LessonType::class, $this->em->getRepository(Lesson::class)->find($id), ['readOnly' => true]);

        return $this->render('admin/lesson/lessonCRUD.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/lesson/{id}/remove", name="lesson-remove")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function removeLessonAction($id, Request $request)
    {
        $this->em->remove($this->em->getRepository(Lesson::class)->find($id));
        $this->em->flush();

        return $this->redirectToRoute('lesson-list');
    }
}