<?php

namespace App\DataFixtures;

use App\Entity\Campus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CampusFixtures extends Fixture
{
    public const CAMPUS1 = 'St-Herblain';
    public const CAMPUS2 = 'Chartres-bratagne';
    public const CAMPUS3 = 'Roche-sur-Yon';
    public function load(ObjectManager $manager)
    {

        $campus1 = new Campus();
        $campus1->setNomCampus('SAINT HERBLAIN');
        $manager->persist($campus1);
        $manager->flush();
        $this->addReference(self::CAMPUS1, $campus1);


        $campus2 = new Campus();
        $campus2->setNomCampus('CHARTRES DE BRETAGNE');
        $manager->persist($campus2);
        $manager->flush();
        $this->addReference(self::CAMPUS2, $campus2);

        $campus3 = new Campus();
        $campus3->setNomCampus('LA ROCHE SUR YON');
        $manager->persist($campus3);
        $manager->flush();
        $this->addReference(self::CAMPUS3, $campus3);
    }


}