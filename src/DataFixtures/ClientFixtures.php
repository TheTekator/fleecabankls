<?php

namespace App\DataFixtures;

use App\Entity\Client;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class ClientFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $client1 = new Client();
        $client1->setName('Client 1');
        $client1->setPhone('555-123451');
        $client1->setDernierEmploi('Emploi de merde');
        $client1->setLienDernierEmploi('http://www.google.fr');

        $client2 = new Client();
        $client2->setName('Client 3');
        $client2->setPhone('555-123453');

        $client3 = new Client();
        $client3->setName('Client 2');
        $client3->setPhone('555-123452');

        $client4 = new Client();
        $client4->setName('Client 4');
        $client4->setPhone('555-123454');

        $manager->persist($client1);
        $manager->persist($client2);
        $manager->persist($client3);
        $manager->persist($client4);

        $manager->flush();

        $this->addReference('client1', $client1);
        $this->addReference('client2', $client3);
        $this->addReference('client3', $client2);
        $this->addReference('client4', $client4);
    }

    public function getOrder()
    {
        return 3;
    }
}
