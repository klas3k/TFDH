<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Form\PersonType;
use AppBundle\Entity\Person;
use AppBundle\Entity\Member;
use AppBundle\Entity\Lesson;
use AppBundle\Entity\Registration;

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
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

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
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

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
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

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
        $this->denyAccessUnlessGranted('ROLE_ADMIN');

        $em = $this->getDoctrine()->getManager();
        $em->remove($person);
        $em->flush();

        $this->addFlash("success", "Gebruiker verwijderd!");

        return $this->redirectToRoute("person_index", $request->query->all());
    }

    /**
     * @Route("/lesson/{id}", name="person_lessonApply")
     */
    public function applyLessonAction(Request $request, UserInterface $user, Lesson $lesson)
    {
        $this->denyAccessUnlessGranted('ROLE_MEMBER');

        $em = $this->getDoctrine()->getManager();
        if(count($em->getRepository(Registration::class)->findBy(['member' => $user, 'lesson' => $lesson])) > 0) {
            $this->addFlash("danger", "Reeds ingeschreven voor deze les!");
            return $this->redirectToRoute("lesson_index", $request->query->all());
        }

        $registration = new Registration();
        $registration->setLesson($lesson);
        $registration->setMember($user);

        $em->persist($registration);
        $em->flush();

        $this->addFlash("success", "Ingeschreven voor les!");

        return $this->redirectToRoute("lesson_index", $request->query->all());
    }
}
