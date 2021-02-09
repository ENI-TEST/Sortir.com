<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Participant;
use App\Entity\Sortie;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        $username = $this->getUser()->getUsername();
        $participant = $this->getDoctrine()->getRepository(Participant::class)
            ->findOneByPseudoOrEmail($username);
        $campus = $this->getDoctrine()->getRepository(Campus::class)
            ->findAll();
        $sorties = $this->getDoctrine()->getRepository(Sortie::class)
            ->findAll();

        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
            'participant' => $participant,
            'campus' => $campus,
            'sorties' => $sorties,
        ]);
    }
}
