<?php

namespace App\Controller;

use App\Form\MonProfilType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ParticipantController extends AbstractController
{

    /**
     * @Route("/afficherProfilParticipant", name="profilParticipant")
     */
    public function afficherProfilParticipant(): Response
    {


        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();



        return $this->render('participant/afficherProfilParticipant.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/afficherProfilUser", name="profilUser")
     */
    public function afficherProfilUser(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $em): Response
    {

        $participant = $this->getUser();
        $participantForm = $this->createForm(MonProfilType::class, $participant);

        $participantForm->handleRequest($request);

        if ($participantForm->isSubmitted() && $participantForm->isValid()){
            $hashed = $encoder->encodePassword($participant, $participant->getPassword());
            $participant->setPassword($hashed);

            $em->persist($participant);
            $em->flush();

            $this->addFlash('message', 'Votre profil a bien été génére');
            return $this->redirectToRoute('home');

        }


        return $this->render('participant/afficherProfilUser.html.twig', [
            'participantForm' => $participantForm->createView(),
        ]);

    }

}
