<?php

namespace App\DataFixtures;

use App\Entity\Etats;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class EtatsFixtures extends Fixture
{
    public const ETAT_1 = 'etat-1';
    public const ETAT_2 = 'etat-2';
    public const ETAT_3 = 'etat-3';
    public const ETAT_4 = 'etat-4';
    public const ETAT_5 = 'etat-5';
    public const ETAT_6 = 'etat-6';
    public const ETAT_7 = 'etat-7';

    public function load(ObjectManager $manager)
    {
        //$values = ['En création', 'Ouverte', 'Clôturée', 'Annulée', 'En cours', 'Terminée', 'Historisée'];
       /* $size = count($values);
        for ($i =0; $i < $size; $i++)
        {
            $etats = new Etats();
            $etats->setLibelle($values[$i]);
            $manager->persist($etats);
        }*/

        $etat1 =  new Etats();
        $etat1->setLibelle('En création');
        $manager->persist($etat1);
        $manager->flush();
        $this->addReference(self::ETAT_1, $etat1);

        $etat2 =  new Etats();
        $etat2->setLibelle('Ouverte');
        $manager->persist($etat2);
        $manager->flush();
        $this->addReference(self::ETAT_2, $etat2);

        $etat3 =  new Etats();
        $etat3->setLibelle('Clôturée');
        $manager->persist($etat3);
        $manager->flush();
        $this->addReference(self::ETAT_3, $etat3);

        $etat4 =  new Etats();
        $etat4->setLibelle('Annulée');
        $manager->persist($etat4);
        $manager->flush();
        $this->addReference(self::ETAT_4, $etat4);

        $etat5 =  new Etats();
        $etat5->setLibelle('En cours');
        $manager->persist($etat5);
        $manager->flush();
        $this->addReference(self::ETAT_5, $etat5);

        $etat6 =  new Etats();
        $etat6->setLibelle('Terminée');
        $manager->persist($etat6);
        $manager->flush();
        $this->addReference(self::ETAT_6, $etat6);

        $etat7 =  new Etats();
        $etat7->setLibelle('Historisée');
        $manager->persist($etat7);
        $manager->flush();
        $this->addReference(self::ETAT_7, $etat7);


    }
}