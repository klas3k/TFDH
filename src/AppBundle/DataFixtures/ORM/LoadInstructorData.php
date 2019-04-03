<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Instructor;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadInstructorData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $yesterdate = new \DateTime('-1 day');

        $member = new Instructor();
        $member->setUsername('instructor');
        $member->setPassword('instructor');
        $member->setEmail('instructor@email.com');
        $member->setFirstname('mid');
        $member->setLastname('end');
        $date = new \DateTime('-15 years');
        $member->setDateofbirth($date);
        $member->setGender('M');
        $member->setRoles(['ROLE_INSTRUCTOR']);

        $member->setHiringData($yesterdate);
        $member->setSalary(10);

        $manager->persist($member);
        $manager->flush();

        $member = new Instructor();
        $member->setUsername('tests');
        $member->setPassword('tests');
        $member->setEmail('instructor_2@email.com');
        $member->setFirstname('mided');
        $member->setLastname('ended');
        $date = new \DateTime('-11 years');
        $member->setDateofbirth($date);
        $member->setGender('V');
        $member->setRoles(['ROLE_INSTRUCTOR']);

        $member->setHiringData($yesterdate);
        $member->setSalary(1);

        $manager->persist($member);
        $manager->flush();
    }
}