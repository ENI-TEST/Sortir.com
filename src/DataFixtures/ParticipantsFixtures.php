<?php


namespace App\DataFixtures;


use App\Entity\Participants;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ParticipantsFixtures extends Fixture implements DependentFixtureInterface
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public const USER_2 = 'user2';
    public const USER_3 = 'user3';
    public const USER_4 = 'user4';

    public function load(ObjectManager $manager)
    {
        $participant1 = new Participants();
        $participant1->setCampus($this->getReference(CampusFixtures::CAMPUS1));
        $participant1->setPseudo('admin');
        $participant1->setNom('admin');
        $participant1->setPrenom('admin');
        $participant1->setEmail('admin@gmel.com');
        $participant1->setPassword($this->encoder->encodePassword($participant1, 'admin'));
        $participant1->setAdministrateur(true);
        $participant1->setActif(true);
        $participant1->setRoles(["ROLE_USER", "ROLE_ADMIN"]);
        $manager->persist($participant1);
        $manager->flush();

        $participant2 = new Participants();
        $participant2->setCampus($this->getReference(CampusFixtures::CAMPUS2));
        $participant2->setPseudo('toto');
        $participant2->setNom('toto');
        $participant2->setPrenom('toto');
        $participant2->setEmail('toto@gmel.com');
        $participant2->setPassword($this->encoder->encodePassword($participant2, 'toto'));
        $participant2->setAdministrateur(false);
        $participant2->setActif(true);
        $participant2->setRoles(["ROLE_USER"]);
        $manager->persist($participant2);
        $manager->flush();
        $this->addReference(self::USER_2, $participant2);

        $participant3 = new Participants();
        $participant3->setCampus($this->getReference(CampusFixtures::CAMPUS3));
        $participant3->setPseudo('tata');
        $participant3->setNom('tata');
        $participant3->setPrenom('tata');
        $participant3->setEmail('tata@gmel.com');
        $participant3->setPassword($this->encoder->encodePassword($participant3, 'tata'));
        $participant3->setAdministrateur(false);
        $participant3->setActif(true);
        $participant3->setRoles(["ROLE_USER"]);
        $manager->persist($participant3);
        $manager->flush();
        $this->addReference(self::USER_3, $participant3);

        $participant4 = new Participants();
        $participant4->setCampus($this->getReference(CampusFixtures::CAMPUS1));
        $participant4->setPseudo('titi');
        $participant4->setNom('titi');
        $participant4->setPrenom('titi');
        $participant4->setEmail('titi@gmel.com');
        $participant4->setPassword($this->encoder->encodePassword($participant4, 'titi'));
        $participant4->setAdministrateur(false);
        $participant4->setActif(true);
        $participant4->setRoles(["ROLE_USER"]);
        $manager->persist($participant4);
        $manager->flush();
        $this->addReference(self::USER_4, $participant4);
    }


    public function getDependencies()
    {
        return array(
          CampusFixtures::class,
        );
    }
}