<?php

namespace App\DataFixtures;

use App\Entity\GenreCompte;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;

class GenreCompteFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $genre1 = new GenreCompte();
        $genre1->setName('Compte Particulier');

        $genre2 = new GenreCompte();
        $genre2->setName('Compte Entreprise de Service');

        $genre3 = new GenreCompte();
        $genre3->setName('Compte Entreprise Industrielle');

        $genre4 = new GenreCompte();
        $genre4->setName('Compte Gouvernemantal');

        $genre5 = new GenreCompte();
        $genre5->setName('Compte Associatif');

        $manager->persist($genre1);
        $manager->persist($genre2);
        $manager->persist($genre3);
        $manager->persist($genre4);
        $manager->persist($genre4);

        $manager->flush();

        $this->addReference('genreParticulier', $genre1);
        $this->addReference('genreService', $genre2);
        $this->addReference('genreIndustrie', $genre3);
        $this->addReference('genreGouvernement', $genre4);
        $this->addReference('genreAssociatif', $genre5);
    }

    public function getOrder()
    {
        return 1;
    }
}
