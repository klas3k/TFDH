<?php

namespace AppBundle\Controller;


use AppBundle\Form\Processor\InstructorProcessor;
use AppBundle\Form\Type\InstructorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminInstructorController extends Controller
{
    private $instructorProcessor;

    public function __construct(InstructorProcessor $instructorProcessor)
    {
        $this->instructorProcessor = $instructorProcessor;
    }

    /**
     * @Route("/admin/instructor/list", name="training-list")
     */
    public function showInstructorsAction(Request $request)
    {
        return $this->render('default/index.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    /**
     * @Route("/admin/instructor/create", name="training-create")
     */
    public function createInstructorAction(Request $request)
    {
        $form = $this->createForm(InstructorType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->instructorProcessor->processCreate($form);
            return $this->redirectToRoute('homepage');
        }

        return $this->render('admin/instructor/instructorCRUD.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/instructor/edit/{id}", name="training-edit")
     */
    public function editInstructorAction($id, Request $request)
    {


        $form = $this->createForm(InstructorType::class);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->instructorProcessor->processEdit($form);
            return $this->redirectToRoute('homepage');
        }

        return $this->render('admin/instructor/instructorCRUD.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/instructor/view", name="training-view")
     */
    public function viewInstructorAction(Request $request)
    {
        $form = $this->createForm(InstructorType::class, ['readOnly' => true]);

        return $this->render('admin/instructor/instructorCRUD.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}