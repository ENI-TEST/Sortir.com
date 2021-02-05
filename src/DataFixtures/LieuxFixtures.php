<?php

namespace App\DataFixtures;

use App\Entity\Lieux;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class LieuxFixtures extends Fixture implements DependentFixtureInterface
{
    public const LIEU_1 = 'lieu-1';
    public const LIEU_2 = 'lieu-2';
    public const LIEU_3 = 'lieu-3';
    public const LIEU_4 = 'lieu-4';
    public const LIEU_5 = 'lieu-5';

    public function load(ObjectManager $manager)
    {
        $lieu1 = new Lieux();
        $lieu1->setNomLieu('lieu 1');
        $lieu1->setVille($this->getReference(VillesFixtures::VILLE1));
        $manager->persist($lieu1);
        $manager->flush();
        $this->addReference(self::LIEU_1, $lieu1);

        $lieu2 = new Lieux();
        $lieu2->setNomLieu('lieu 2');
        $lieu2->setVille($this->getReference(VillesFixtures::VILLE2));
        $manager->persist($lieu2);
        $manager->flush();
        $this->addReference(self::LIEU_2, $lieu2);

        $lieu3 = new Lieux();
        $lieu3->setNomLieu('lieu 3');
        $lieu3->setVille($this->getReference(VillesFixtures::VILLE3));
        $manager->persist($lieu3);
        $manager->flush();
        $this->addReference(self::LIEU_3, $lieu3);

        $lieu4 = new Lieux();
        $lieu4->setNomLieu('lieu 4');
        $lieu4->setVille($this->getReference(VillesFixtures::VILLE4));
        $manager->persist($lieu4);
        $manager->flush();
        $this->addReference(self::LIEU_4, $lieu4);

        $lieu5 = new Lieux();
        $lieu5->setNomLieu('lieu 5');
        $lieu5->setVille($this->getReference(VillesFixtures::VILLE5));
        $manager->persist($lieu5);
        $manager->flush();
        $this->addReference(self::LIEU_5, $lieu5);
    }


    public function getDependencies()
    {
        return array(
          VillesFixtures::class,
        );
    }
}


