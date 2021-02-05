<?php

namespace App\DataFixtures;

use App\Entity\Inscriptions;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class InscriptionsFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $ins1 = new Inscriptions();
        $ins1->setDateInscription(\DateTime::createFromFormat('d-m-Y H:i','03-02-2021 18:00'));
        $ins1->setParticipant($this->getReference(ParticipantsFixtures::USER_2));
        $ins1->setSortie($this->getReference(SortiesFixture::SORTIE_2));
        $manager->persist($ins1);
        $manager->flush();

        $ins2 = new Inscriptions();
        $ins2->setDateInscription(\DateTime::createFromFormat('d-m-Y H:i','02-02-2021 10:00'));
        $ins2->setParticipant($this->getReference(ParticipantsFixtures::USER_2));
        $ins2->setSortie($this->getReference(SortiesFixture::SORTIE_4));
        $manager->persist($ins2);
        $manager->flush();
    }


    public function getDependencies()
    {
        return array(
            ParticipantsFixtures::class,
            SortiesFixture::class,
        );
    }
}