<?php /** @noinspection PhpParamsInspection */

/** @noinspection PhpUnhandledExceptionInspection */

namespace App\DataFixtures;

use App\Entity\Compte;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CompteFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $compte1 = new Compte();
        $compte1->setDateOuverture(new \DateTime('11/22/2016'));
        $compte1->setNumber('001-364733-01');
        $compte1->setOpen(true);
        $compte1->setFraisOuverture(1000);
        $compte1->setFraisTenue(500);
        $compte1->setClient($this->getReference('client1'));
        $compte1->setGenreCompte($this->getReference('genreParticulier'));

        $compte2 = new Compte();
        $compte2->setDateOuverture(new \DateTime('11/22/2016'));
        $compte2->setNumber('001-364733-02');
        $compte2->setOpen(false);
        $compte2->setFraisOuverture(0);
        $compte2->setFraisTenue(500);
        $compte2->setClient($this->getReference('client1'));
        $compte2->setGenreCompte($this->getReference('genreParticulier'));

        $compte3 = new Compte();
        $compte3->setDateOuverture(new \DateTime('11/21/2016'));
        $compte3->setNumber('001-364734-01');
        $compte3->setOpen(true);
        $compte3->setFraisOuverture(100000);
        $compte3->setFraisTenue(5000);
        $compte3->setClient($this->getReference('client2'));
        $compte3->setGenreCompte($this->getReference('genreGouvernement'));

        $compte4 = new Compte();
        $compte4->setDateOuverture(new \DateTime('11/20/2016'));
        $compte4->setNumber('001-364703-01');
        $compte4->setOpen(true);
        $compte4->setFraisOuverture(0);
        $compte4->setFraisTenue(50);
        $compte4->setClient($this->getReference('client4'));
        $compte4->setGenreCompte($this->getReference('genreAssociatif'));

        $compte5 = new Compte();
        $compte5->setDateOuverture(new \DateTime('10/22/2016'));
        $compte5->setNumber('001-365733-01');
        $compte5->setOpen(true);
        $compte5->setFraisOuverture(25000);
        $compte5->setFraisTenue(2000);
        $compte5->setClient($this->getReference('client3'));
        $compte5->setGenreCompte($this->getReference('genreService'));

        $manager->persist($compte1);
        $manager->persist($compte2);
        $manager->persist($compte3);
        $manager->persist($compte4);
        $manager->persist($compte5);

        $manager->flush();
    }

    public function getOrder()
    {
        return 4;
    }
}
