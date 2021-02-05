<?php

namespace App\DataFixtures;

use App\Entity\Villes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VillesFixtures extends Fixture
{
    public const VILLE1 = 'ville-1';
    public const VILLE2 = 'ville-2';
    public const VILLE3 = 'ville-3';
    public const VILLE4 = 'ville-4';
    public const VILLE5 = 'ville-5';

    public function load(ObjectManager $manager)
    {

        $villes1 = new Villes();
        $villes1->setNomVille('Nantes');
        $villes1->setCodePostal('44000');
        $manager->persist($villes1);
        $manager->flush();
        $this->addReference(self::VILLE1, $villes1);

        $villes2 = new Villes();
        $villes2->setNomVille('Clisson');
        $villes2->setCodePostal('44190');
        $manager->persist($villes2);
        $manager->flush();
        $this->addReference(self::VILLE2, $villes2);

        $villes3 = new Villes();
        $villes3->setNomVille('Rennes');
        $villes3->setCodePostal('35000');
        $manager->persist($villes3);
        $manager->flush();
        $this->addReference(self::VILLE3, $villes3);

        $villes4 = new Villes();
        $villes4->setNomVille('Challans');
        $villes4->setCodePostal('85300');
        $manager->persist($villes4);
        $manager->flush();
        $this->addReference(self::VILLE4, $villes4);

        $villes5 = new Villes();
        $villes5->setNomVille('Saint-Hilaire-de-Riez');
        $villes5->setCodePostal('85270');
        $manager->persist($villes5);
        $manager->flush();
        $this->addReference(self::VILLE5, $villes5);


    }
}


