<?php

namespace App\DataFixtures;

use App\Entity\Etats;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EtatsFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $etat = new Etats();
        $etat->setLibelle('Créée');
        $manager->persist($etat);
        $manager->flush();

        $etat = new Etats();
        $etat->setLibelle('Ouverte');
        $manager->persist($etat);
        $manager->flush();

        $etat = new Etats();
        $etat->setLibelle('Clôturée');
        $manager->persist($etat);
        $manager->flush();

        $etat = new Etats();
        $etat->setLibelle('Activité en cours');
        $manager->persist($etat);
        $manager->flush();

        $etat = new Etats();
        $etat->setLibelle('Activité passée');
        $manager->persist($etat);
        $manager->flush();

        $etat = new Etats();
        $etat->setLibelle('Annulée');
        $manager->persist($etat);
        $manager->flush();
    }
}
