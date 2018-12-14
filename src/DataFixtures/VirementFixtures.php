<?php /** @noinspection PhpUnhandledExceptionInspection */

namespace App\DataFixtures;

use App\Entity\Virement;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class VirementFixtures extends Fixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $virement1 = new Virement();
        $virement1->setMontant(20800);
        $virement1->setDateVirement(new \DateTime('11/19/2016'));
        $virement1->setValide(true);

        $virement2 = new Virement();
        $virement2->setMontant(20800);
        $virement2->setDateVirement(new \DateTime('11/20/2016'));
        $virement2->setValide(true);

        $virement3 = new Virement();
        $virement3->setMontant(20800);
        $virement3->setDateVirement(new \DateTime('11/22/2016'));
        $virement3->setValide(true);

        $virement4 = new Virement();
        $virement4->setMontant(33600);
        $virement4->setDateVirement(new \DateTime('11/29/2016'));
        $virement4->setValide(true);

        $virement5 = new Virement();
        $virement5->setMontant(43600);
        $virement5->setDateVirement(new \DateTime('12/05/2016'));
        $virement5->setValide(false);

        $virement6 = new Virement();
        $virement6->setMontant(33600);
        $virement6->setDateVirement(new \DateTime('12/12/2016'));
        $virement6->setValide(false);

        $virement7 = new Virement();
        $virement7->setMontant(23600);
        $virement7->setDateVirement(new \DateTime('12/20/2016'));
        $virement7->setValide(false);

        $manager->persist($virement1);
        $manager->persist($virement2);
        $manager->persist($virement3);
        $manager->persist($virement4);
        $manager->persist($virement5);
        $manager->persist($virement6);
        $manager->persist($virement7);

        $this->addReference('virement1', $virement1);
        $this->addReference('virement2', $virement2);
        $this->addReference('virement3', $virement3);
        $this->addReference('virement4', $virement4);
        $this->addReference('virement5', $virement5);
        $this->addReference('virement6', $virement6);
        $this->addReference('virement7', $virement7);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 2;
    }
}
