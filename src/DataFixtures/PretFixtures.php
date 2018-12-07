<?php

namespace App\DataFixtures;

use App\Entity\Pret;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PretFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $pret1 = new Pret();
        $pret1->setClient($this->getReference('client1'));
        $pret1->setDateOuverture(new \DateTime('11/18/2016'));
        $pret1->setDuree(3);
        $pret1->setInteret(4);
        $pret1->setMontant(60000);
        $pret1->setRaison('Achat logement privé');
        $pret1->setTermine(true);
        $pret1->addVirement($this->getReference('virement1'));
        $pret1->addVirement($this->getReference('virement2'));
        $pret1->addVirement($this->getReference('virement3'));

        $pret2 = new Pret();
        $pret2->setClient($this->getReference('client1'));
        $pret2->setDateOuverture(new \DateTime('11/21/2016'));
        $pret2->setDuree(4);
        $pret2->setInteret(12);
        $pret2->setMontant(120000);
        $pret2->setRaison('Achat véhicule perso');
        $pret2->setTermine(false);
        $pret2->addVirement($this->getReference('virement4'));
        $pret2->addVirement($this->getReference('virement5'));
        $pret2->addVirement($this->getReference('virement6'));
        $pret2->addVirement($this->getReference('virement7'));

        $pret3 = new Pret();
        $pret3->setClient($this->getReference('client2'));
        $pret3->setDateOuverture(new \DateTime('11/22/2016'));
        $pret3->setDuree(4);
        $pret3->setInteret(8);
        $pret3->setMontant(80000);
        $pret3->setRaison('Achat véhicule perso');
        $pret3->setTermine(false);

        $pret4 = new Pret();
        $pret4->setClient($this->getReference('client3'));
        $pret4->setDateOuverture(new \DateTime('11/20/2016'));
        $pret4->setDuree(4);
        $pret4->setInteret(18);
        $pret4->setMontant(150000);
        $pret4->setRaison('Achat véhicule perso');
        $pret4->setTermine(false);

        $manager->persist($pret1);
        $manager->persist($pret2);
        $manager->persist($pret3);
        $manager->persist($pret4);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 5;
    }
}
