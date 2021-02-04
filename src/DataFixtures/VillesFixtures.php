<?php

namespace App\DataFixtures;

use App\Entity\Villes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class VillesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $ville = new Villes();
        $ville->setNomVille('Haute-Goulaine');
        $ville->setCodePostal('44115');
        $manager->persist($ville);
        $manager->flush();

        $ville = new Villes();
        $ville->setNomVille('Saint-Herblain');
        $ville->setCodePostal('44800');
        $manager->persist($ville);
        $manager->flush();

        $ville = new Villes();
        $ville->setNomVille('Saint-Joseph de Porterie');
        $ville->setCodePostal('44300');
        $manager->persist($ville);
        $manager->flush();

        $ville = new Villes();
        $ville->setNomVille('La Bellangerais');
        $ville->setCodePostal('35700');
        $manager->persist($ville);
        $manager->flush();

        $ville = new Villes();
        $ville->setNomVille('Bourg L\'Evêque');
        $ville->setCodePostal('35000');
        $manager->persist($ville);
        $manager->flush();

        $ville = new Villes();
        $ville->setNomVille('Chantepie');
        $ville->setCodePostal('35135');
        $manager->persist($ville);
        $manager->flush();

        $ville = new Villes();
        $ville->setNomVille('Aiffres');
        $ville->setCodePostal('79230');
        $manager->persist($ville);
        $manager->flush();

        $ville = new Villes();
        $ville->setNomVille('Coulon');
        $ville->setCodePostal('79510');
        $manager->persist($ville);
        $manager->flush();

        $ville = new Villes();
        $ville->setNomVille('Saint-Gelais');
        $ville->setCodePostal('79410');
        $manager->persist($ville);
        $manager->flush();
    }
}
