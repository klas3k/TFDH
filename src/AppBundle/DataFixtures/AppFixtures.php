<?php

namespace AppBundle\DataFixtures;

use DateTime;
use AppBundle\Entity\Instructor;
use AppBundle\Entity\Member;
use AppBundle\Entity\Training;
use AppBundle\Entity\Lesson;
use AppBundle\Entity\Registration;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AppFixtures extends Fixture
{
    private $encoder;
    private $faker;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $this->faker = Factory::create();

        // Instructors
        $instructors = [];
        for($i = 0; $i < 5; $i++) {
            $instructor = new Instructor();
            // Person values
            $instructor->setPerson($this->getPersonValues($instructor));
            // Instructor values
            $instructor->setHiringDate($this->faker->dateTime("now"));
            $instructor->setSalary($this->faker->numberBetween(1000, 3000));
            $manager->persist($instructor);
            array_push($instructors, $instructor);
        }

        // Members
        $members = [];
        for($i = 0; $i < 20; $i++) {
            $member = new Member();
            // Person values
            $member->setPerson($this->getPersonValues($member));
            // Member values
            $member->setStreet($this->faker->streetName);
            $member->setPostalCode($this->faker->postcode);
            $member->setCity($this->faker->city);
            $manager->persist($member);
            array_push($members, $member);
        }

        // Trainings
        $trainings = [];
        $training = new Training();
        $training->setName("MMA");
        $training->setDescription("Mixed martial arts (Engels voor: gemengde gevechtskunsten), meestal afgekort tot MMA, is een multidisciplinaire vechtsport die zich richt op het combineren van technieken uit verschillende vechtkunsten (en vechtsporten) zoals worstelen (grappling), judo, karate, kungfu, kickboksen, thaiboksen, boksen en jiujitsu.");
        $training->setDuration(new DateTime(date('H:i:s', rand(1,5000))));
        $training->setExtraCosts($this->faker->numberBetween(10, 25));
        $manager->persist($training);
        array_push($trainings, $training);

        $training = new Training();
        $training->setName("Kickboksen");
        $training->setDescription("Kickboksen is een vechtsport waarbij zowel de handen als de benen mogen worden gebruikt. De sport kent zijn oorsprong in Japan en de Verenigde Staten, waar het begin jaren zeventig populair werd. Het kickboksen in de VS is ontstaan als systeem om verschillende stijlen vechtsporters zich met elkaar te laten meten. Het kickboksen in Japan heeft zich van harde karatestijlen uit ontwikkeld met invloeden van het thaiboksen (muay thai). In Nederland is Thom Harinck een bekend persoon die kickboksen introduceerde.");
        $training->setDuration(new DateTime(date('H:i:s', rand(1,5000))));
        $training->setExtraCosts($this->faker->numberBetween(10, 25));$manager->persist($training);
        array_push($trainings, $training);

        $training = new Training();
        $training->setName("Stootzak training");
        $training->setDescription("De stød, in het Nederlands ook wel 'stoot' genoemd, is een verschijnsel in de uitspraak van het Deens waarbij de stembanden plotseling (gedeeltelijk) worden dichtgeklapt. In lichtere vorm klinkt het meer als een kraak of onregelmatigheid in de stem.");
        $training->setDuration(new DateTime(date('H:i:s', rand(1,5000))));
        $training->setExtraCosts($this->faker->numberBetween(10, 25));$manager->persist($training);
        array_push($trainings, $training);

        // Lessons
        $lessons = [];
        for($i = 0; $i < 20; $i++) {
            $lesson = new Lesson();
            $lesson->setTime($this->faker->dateTime("now"));
            $lesson->setLocation($this->faker->city);
            $lesson->setMaxPeople($this->faker->numberBetween(5, 20));
            $lesson->setTraining($this->faker->randomElement($trainings));
            $lesson->setInstructor($this->faker->randomElement($instructors));
            $manager->persist($lesson);
            array_push($lessons, $lesson);
        }

        // Registrations
        for($i = 0; $i < 50; $i++) {
            $registration = new Registration();
            $registration->setPayment($this->faker->numberBetween(10, 25));
            $registration->setLesson($this->faker->randomElement($lessons));
            $registration->setMember($this->faker->randomElement($members));
            $manager->persist($registration);
        }

        $manager->flush();
    }

    /**
     * Returns randomized person values
     * 
     * @param Person $user
     * 
     * @return array
     */
    private function getPersonValues($user)
    {
        return [
            "username"    => $this->faker->userName,
            "password"    => $this->encoder->encodePassword($user, "secret"),
            "firstName"   => $this->faker->firstName,
            "prefix"      => $this->faker->randomElement([null, "van", "van der", "de", "van den"]),
            "lastName"    => $this->faker->lastName,
            "dateOfBirth" => $this->faker->dateTime("now"),
            "gender"      => $this->faker->randomElement(["male", "female"]),
            "email"       => $this->faker->email,
        ];
    }
}
