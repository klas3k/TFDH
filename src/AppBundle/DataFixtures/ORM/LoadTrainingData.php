<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Training;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTrainingData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $training = new Training();
        $training->setName('Judo');
        $training->setDescription('Judo (Japans: 柔道, じゅうどう, jūdō    ) is een van oorsprong Japanse zelfverdedigingskunst, die rond 1882 werd ontworpen door Jigoro Kano. Het woord betekent \'zachte weg\', waarbij het woordje do verwant is aan tao en naast de betekenis \'manier\' ook de connotatie heeft van \'levenspad\'. Een beoefenaar van het judo heet een judoka. Judo is een sport die wereldwijd beoefend wordt en tevens een olympische sport is.');
        $training->setCosts(100);
        $training->setDuration(10);

        $manager->persist($training);
        $manager->flush();

        $training = new Training();
        $training->setName('MMA');
        $training->setDescription('Mixed martial arts (Engels voor: gemengde gevechtskunsten), meestal afgekort tot MMA, is een multidisciplinaire vechtsport die zich richt op het combineren van technieken uit verschillende vechtkunsten (en vechtsporten) zoals worstelen (grappling), judo, karate, kungfu, kickboksen, thaiboksen, boksen en jiujitsu.');
        $training->setCosts(100);
        $training->setDuration(10);

        $manager->persist($training);
        $manager->flush();

        $training = new Training();
        $training->setName('Kickboxen');
        $training->setDescription('Kickboksen is een vechtsport waarbij zowel de handen als de benen mogen worden gebruikt. De sport kent zijn oorsprong in Japan en de Verenigde Staten, waar het begin jaren zeventig populair werd. Het kickboksen in de VS is ontstaan als systeem om verschillende stijlen vechtsporters zich met elkaar te laten meten. Het kickboksen in Japan heeft zich van harde karatestijlen uit ontwikkeld met invloeden van het thaiboksen (muay thai). In Nederland is Thom Harinck een bekend persoon die kickboksen introduceerde.');
        $training->setCosts(100);
        $training->setDuration(10);

        $manager->persist($training);
        $manager->flush();

        $training = new Training();
        $training->setName('Karate');
        $training->setDescription('Karate is een vechtkunst die is ontstaan op de Ryukyu-eilanden, waaronder het eiland Okinawa, Japan. Het is ontstaan uit de samenvoeging van het Chinese Kempo (ook wel Kenpo) en de inheemse vechtkunsten van Okinawa, die te (手, letterlijk “hand”) werden genoemd.');
        $training->setCosts(100);
        $training->setDuration(10);

        $manager->persist($training);
        $manager->flush();
    }
}