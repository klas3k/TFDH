<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\TrainingType;
use AppBundle\Entity\Training;

/**
 * @Route("/training")
 */
class TrainingController extends Controller
{
    /**
     * @Route("/", name="training_index")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $trainings = $em->getRepository(Training::class)->findAll();

        return $this->render("training/index.html.twig", [
            "name" => "John Doe",
            "trainings" => $trainings,
        ]);
    }

    /**
     * @Route("/create", name="training_create")
     */
    public function createTrainingAction(Request $request)
    {
        $form = $this->createForm(TrainingType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $training = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($training);
            $em->flush();

            $this->addFlash("success", "Training aangemaakt!");

            return $this->redirectToRoute("homepage", $request->query->all());
        }

        return $this->render("default/form.html.twig", [
            "name"   => "John Doe",
            "form"   => $form->createView(),
        ]);
    }

    /**
     * @Route("/update/{name}", name="training_update")
     */
    public function editTrainingAction(Request $request, Training $training)
    {
        $form = $this->createForm(TrainingType::class, $training);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $training = $form->getData();
            $em->persist($training);
            $em->flush();

            $this->addFlash("success", "Training bewerkt!");

            return $this->redirectToRoute("training_index", $request->query->all());
        }

        return $this->render("default/form.html.twig", [
            "name"   => "John Doe",
            "form"   => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{name}", name="training_delete")
     */
    public function deleteTrainingAction(Request $request, Training $training)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($training);
        $em->flush();

        $this->addFlash("success", "Training verwijdert!");

        return $this->redirectToRoute("training_index", $request->query->all());
    }
}
