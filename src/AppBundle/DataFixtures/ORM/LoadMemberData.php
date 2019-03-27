<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Member;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMemberData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $member = new Member();
        $member->setUsername('user');
        $member->setPassword('user');
        $member->setEmail('user@email.com');
        $member->setFirstname('front');
        $member->setLastname('end');
        $date = new \DateTime('-10 years');
        $member->setDateofbirth($date);
        $member->setGender('M');
        $member->setRoles(['ROLE_USER']);

        $member->setStreet('street 1');
        $member->setPostalCode('1111 AB');
        $member->setPlace('Dorp');

        $manager->persist($member);
        $manager->flush();

        $member = new Member();
        $member->setUsername('test');
        $member->setPassword('test');
        $member->setEmail('user_1@email.com');
        $member->setFirstname('fronted');
        $member->setLastname('ended');
        $date = new \DateTime('-100 years');
        $member->setDateofbirth($date);
        $member->setGender('V');
        $member->setRoles(['ROLE_USER']);

        $member->setStreet('street 2');
        $member->setPostalCode('1121 AB');
        $member->setPlace('Dorpe');

        $manager->persist($member);
        $manager->flush();
    }
}