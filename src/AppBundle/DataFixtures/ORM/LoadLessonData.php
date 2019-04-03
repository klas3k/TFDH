<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Instructor;
use AppBundle\Entity\Lesson;
use AppBundle\Entity\Training;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadLessonData extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $judo = $manager->getRepository(Training::class)->findOneBy(['name'=>'Judo']);

        $instructor1 = $manager->getRepository(Instructor::class)->findOneBy(['username'=>'instructor']);

        $tomorrowdate = new \DateTime('+1 day');

        $training = new Lesson();
        $training->setInstuctor($instructor1);
        $training->setTrainings($judo);
        $training->setLocation('Geen Den Haag');
        $training->setMaxPersons(10);
        $training->setTime($tomorrowdate);
        $training->setDate($tomorrowdate);

        $manager->persist($training);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LoadInstructorData::class,
            LoadTrainingData::class,
        ];
    }
}