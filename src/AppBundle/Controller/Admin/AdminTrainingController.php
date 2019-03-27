<?php

namespace AppBundle\Controller\Admin;


use AppBundle\Entity\Training;
use AppBundle\Form\Processor\TrainingProcessor;
use AppBundle\Form\Type\TrainingType;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminTrainingController extends Controller
{
    private $trainingProcessor;
    private $em;

    public function __construct(TrainingProcessor $trainingProcessor, EntityManagerInterface $em)
    {
        $this->trainingProcessor = $trainingProcessor;
        $this->em = $em;
    }

    /**
     * @Route("/admin/training/list", name="training-list")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function listTrainingsAction(Request $request)
    {
        return $this->render('admin/training/trainingList.html.twig', [
            'user' => $this->getUser(),
            'trainings' => $this->em->getRepository(Training::class)->findAll(),
        ]);
    }

    /**
     * @Route("/admin/training/create", name="training-create")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function createTrainingAction(Request $request)
    {
        $form = $this->createForm(TrainingType::class);

        $this->trainingProcessor->processForm($form);

        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('training-list');
        }

        return $this->render('admin/training/trainingCRUD.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/training/{id}/edit", name="training-edit")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editTrainingAction($id, Request $request)
    {
        $form = $this->createForm(TrainingType::class, $this->em->getRepository(Training::class)->find($id));

        $this->trainingProcessor->processForm($form);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->redirectToRoute('training-list');
        }

        return $this->render('admin/training/trainingCRUD.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/training/{id}/view", name="training-view")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function viewTrainingAction($id, Request $request)
    {
        $form = $this->createForm(TrainingType::class, $this->em->getRepository(Training::class)->find($id), ['readOnly' => true]);

        return $this->render('admin/training/trainingCRUD.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/training/{id}/remove", name="training-remove")
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function removeTrainingAction($id, Request $request)
    {
        $this->em->remove($this->em->getRepository(Training::class)->find($id));
        $this->em->flush();

        return $this->redirectToRoute('training-list');
    }
}