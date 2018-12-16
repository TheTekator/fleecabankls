<?php

namespace App\DataFixtures;

use App\Entity\Epargne;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EpargneFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $epargne1 = new Epargne();
        $epargne1->setMontant(200000);
        $epargne1->setDateSouscription(new \DateTime('11/22/2016'));
        $epargne1->setInterets(5);
        $epargne1->setClient($this->getReference('client1'));

        $epargne2 = new Epargne();
        $epargne2->setMontant(100000);
        $epargne2->setDateSouscription(new \DateTime('12/06/2016'));
        $epargne2->setInterets(4);
        $epargne2->setClient($this->getReference('client4'));

        $epargne3 = new Epargne();
        $epargne3->setMontant(10000);
        $epargne3->setDateSouscription(new \DateTime('12/01/2016'));
        $epargne3->setInterets(2);
        $epargne3->setClient($this->getReference('client4'));

        $manager->persist($epargne1);
        $manager->persist($epargne2);
        $manager->persist($epargne3);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 6;
    }
}
