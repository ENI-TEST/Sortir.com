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
     * @Route("/participant", name="participant")
     */
    public function index(): Response
    {
        return $this->render('participant/index.html.twig', [
            'controller_name' => 'ParticipantController',
        ]);
    }

    /**
     * @Route("/afficher", name="afficher")
     */
    public function afficher(): Response
    {


        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();



        return $this->render('afficherProfil/afficher.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/profil", name="profil")
     */
    public function profil(Request $request, UserPasswordEncoderInterface $encoder, EntityManagerInterface $em): Response
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


        return $this->render('monProfil/profil.html.twig', [
            'participantForm' => $participantForm->createView(),
        ]);

    }

}
