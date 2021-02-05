<?php

namespace App\DataFixtures;

use App\Entity\Sorties;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class SortiesFixture extends Fixture implements DependentFixtureInterface
{
    public const SORTIE_2 = 'sortie-2';
    public const SORTIE_4 = 'sortie-4';

    public function load(ObjectManager $manager)
    {
        $sortie1 = new Sorties();
        $sortie1->setOrganisateur($this->getReference(ParticipantsFixtures::USER_2));
        $sortie1->setCampus($this->getReference(CampusFixtures::CAMPUS2));
        $sortie1->setEtat($this->getReference(EtatsFixtures::ETAT_1));
        $sortie1->setLieu($this->getReference(LieuxFixtures::LIEU_2));
        $sortie1->setNom('Sortie 1');
        $sortie1->setDateDebut(\DateTime::createFromFormat('d-m-Y H:i','03-02-2021 18:00'));
        $sortie1->setDateCloture(\DateTime::createFromFormat('d-m-Y H:i','04-02-2021 15:00'));
        $sortie1->setNbInscriptionsMax(50);
        $manager->persist($sortie1);
        $manager->flush();

        $sortie2 = new Sorties();
        $sortie2->setOrganisateur($this->getReference(ParticipantsFixtures::USER_2));
        $sortie2->setCampus($this->getReference(CampusFixtures::CAMPUS2));
        $sortie2->setEtat($this->getReference(EtatsFixtures::ETAT_2));
        $sortie2->setLieu($this->getReference(LieuxFixtures::LIEU_1));
        $sortie2->setNom('Sortie 2');
        $sortie2->setDateDebut(\DateTime::createFromFormat('d-m-Y H:i','03-02-2021 18:00'));
        $sortie2->setDateCloture(\DateTime::createFromFormat('d-m-Y H:i','06-02-2021 18:00'));
        $sortie2->setNbInscriptionsMax(20);
        $manager->persist($sortie2);
        $manager->flush();
        $this->addReference(self::SORTIE_2, $sortie2 );

        $sortie3 = new Sorties();
        $sortie3->setOrganisateur($this->getReference(ParticipantsFixtures::USER_3));
        $sortie3->setCampus($this->getReference(CampusFixtures::CAMPUS3));
        $sortie3->setEtat($this->getReference(EtatsFixtures::ETAT_6));
        $sortie3->setLieu($this->getReference(LieuxFixtures::LIEU_2));
        $sortie3->setNom('Sortie 3');
        $sortie3->setDateDebut(\DateTime::createFromFormat('d-m-Y H:i','01-02-2021 18:00'));
        $sortie3->setDateCloture(\DateTime::createFromFormat('d-m-Y H:i','02-02-2021 08:00'));
        $sortie3->setNbInscriptionsMax(10);
        $manager->persist($sortie3);
        $manager->flush();

        $sortie4 = new Sorties();
        $sortie4->setOrganisateur($this->getReference(ParticipantsFixtures::USER_3));
        $sortie4->setCampus($this->getReference(CampusFixtures::CAMPUS3));
        $sortie4->setEtat($this->getReference(EtatsFixtures::ETAT_5));
        $sortie4->setLieu($this->getReference(LieuxFixtures::LIEU_3));
        $sortie4->setNom('Sortie 4');
        $sortie4->setDateDebut(\DateTime::createFromFormat('d-m-Y H:i','01-02-2021 18:00'));
        $sortie4->setDateCloture(\DateTime::createFromFormat('d-m-Y H:i','03-02-2021 08:00'));
        $sortie4->setNbInscriptionsMax(10);
        $manager->persist($sortie4);
        $manager->flush();
        $this->addReference(self::SORTIE_4, $sortie4 );

        $sortie5 = new Sorties();
        $sortie5->setOrganisateur($this->getReference(ParticipantsFixtures::USER_4));
        $sortie5->setCampus($this->getReference(CampusFixtures::CAMPUS1));
        $sortie5->setEtat($this->getReference(EtatsFixtures::ETAT_7));
        $sortie5->setLieu($this->getReference(LieuxFixtures::LIEU_1));
        $sortie5->setNom('Sortie 5');
        $sortie5->setDateDebut(\DateTime::createFromFormat('d-m-Y H:i','20-12-2020 18:00'));
        $sortie5->setDateCloture(\DateTime::createFromFormat('d-m-Y H:i','21-12-2020 08:00'));
        $sortie5->setNbInscriptionsMax(5);
        $manager->persist($sortie5);
        $manager->flush();
    }


    public function getDependencies()
    {
        return array(
            ParticipantsFixtures::class,
            CampusFixtures::class,
            EtatsFixtures::class,
            LieuxFixtures::class,
            );

    }
}