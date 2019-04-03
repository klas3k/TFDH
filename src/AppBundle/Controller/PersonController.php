<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\PersonType;
use AppBundle\Entity\Person;

/**
 * @Route("/person")
 */
class PersonController extends Controller
{
    /**
     * @Route("/", name="person_index")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $people = $em->getRepository(Person::class)->findBy([], ["firstName" => "asc"]);

        return $this->render("default/person.html.twig", [
            "people" => $people,
        ]);
    }

    /**
     * @Route("/create", name="person_create")
     */
    public function createPersonAction(Request $request)
    {
        $form = $this->createForm(PersonType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $person = $form->getData();
            $em = $this->getDoctrine()->getManager();
            $em->persist($person);
            $em->flush();

            $this->addFlash("success", "Gebruiker aangemaakt!");

            return $this->redirectToRoute("homepage", $request->query->all());
        }

        return $this->render("default/form.html.twig", [
            "form"   => $form->createView(),
        ]);
    }

    /**
     * @Route("/update/{id}", name="person_update")
     */
    public function editPersonAction(Request $request, Person $person)
    {
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $person = $form->getData();
            $em->persist($person);
            $em->flush();

            $this->addFlash("success", "Gebruiker bewerkt!");

            return $this->redirectToRoute("person_index", $request->query->all());
        }

        return $this->render("default/form.html.twig", [
            "form"   => $form->createView(),
        ]);
    }

    /**
     * @Route("/delete/{id}", name="person_delete")
     */
    public function deletePersonAction(Request $request, Person $person)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($person);
        $em->flush();

        $this->addFlash("success", "Gebruiker verwijderd!");

        return $this->redirectToRoute("person_index", $request->query->all());
    }
}
