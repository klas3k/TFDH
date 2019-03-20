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

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create();
        // Instructors
        $instructors = [];
        for($i = 0; $i < 5; $i++) {
            $instructor = new Instructor();
            // Person values
            $instructor->setPerson([
                "username"    => $faker->userName,
                "password"    => $faker->password,
                "firstName"   => $faker->firstName,
                "prefix"      => $faker->randomElement([null, "van", "van der", "de", "van den"]),
                "lastName"    => $faker->lastName,
                "dateOfBirth" => $faker->dateTime("now"),
                "gender"      => $faker->randomElement(["male", "female"]),
                "email"       => $faker->email,
            ]);
            // Instructor values
            $instructor->setHiringDate($faker->dateTime("now"));
            $instructor->setSalary($faker->numberBetween(1000, 3000));
            $manager->persist($instructor);
            array_push($instructors, $instructor);
        }

        // Members
        $members = [];
        for($i = 0; $i < 20; $i++) {
            $member = new Member();
            // Person values
            $member->setPerson([
                "username"    => $faker->userName,
                "password"    => $faker->password,
                "firstName"   => $faker->firstName,
                "prefix"      => $faker->randomElement([null, "van", "van der", "de", "van den"]),
                "lastName"    => $faker->lastName,
                "dateOfBirth" => $faker->dateTime("now"),
                "gender"      => $faker->randomElement(["male", "female"]),
                "email"       => $faker->email,
            ]);
            // Member values
            $member->setStreet($faker->streetName);
            $member->setPostalCode($faker->postcode);
            $member->setCity($faker->city);
            $manager->persist($member);
            array_push($members, $member);
        }

        // Trainings
        $trainings = [];
        $training = new Training();
        $training->setDescription("MMA");
        $training->setDuration(new DateTime(date('H:i:s', rand(1,5000))));
        $training->setCosts($faker->numberBetween(10, 25));
        $manager->persist($training);
        array_push($trainings, $training);

        $training = new Training();
        $training->setDescription("Kickboksen");
        $training->setDuration(new DateTime(date('H:i:s', rand(1,5000))));
        $training->setCosts($faker->numberBetween(10, 25));$manager->persist($training);
        array_push($trainings, $training);

        $training = new Training();
        $training->setDescription("Stootzak training");
        $training->setDuration(new DateTime(date('H:i:s', rand(1,5000))));
        $training->setCosts($faker->numberBetween(10, 25));$manager->persist($training);
        array_push($trainings, $training);

        // Lessons
        $lessons = [];
        for($i = 0; $i < 20; $i++) {
            $lesson = new Lesson();
            $lesson->setTime($faker->dateTime("now"));
            $lesson->setLocation($faker->city);
            $lesson->setMaxPeople($faker->numberBetween(5, 20));
            $lesson->setTraining($faker->randomElement($trainings));
            $lesson->setInstructor($faker->randomElement($instructors));
            $manager->persist($lesson);
            array_push($lessons, $lesson);
        }

        // Registrations
        for($i = 0; $i < 50; $i++) {
            $registration = new Registration();
            $registration->setPayment($faker->numberBetween(10, 25));
            $registration->setLesson($faker->randomElement($lessons));
            $registration->setMember($faker->randomElement($members));
            $manager->persist($registration);
        }

        $manager->flush();
    }
}
