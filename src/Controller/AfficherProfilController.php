<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AfficherProfilController extends AbstractController
{
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
}
