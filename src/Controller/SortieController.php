<?php

namespace App\Controller;

use App\Entity\Campus;
use App\Entity\Participants;
use App\Entity\Sorties;
use App\Form\CreationSortieType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SortieController extends AbstractController
{
    /**
     * @Route("/creationSortie", name="sortie_creation")
     */
    public function creationSortie(EntityManagerInterface $em, Request $request): Response
    {
        $username = $this->getUser()->getUsername();
        $organisateur = $this->getDoctrine()->getRepository(Participants::class)
            ->findOneByPseudoOrEmail($username);
        //$organisateurId = $organisateur->getId();

        $sortie = new Sorties();
        $sortie->setOrganisateur($organisateur);
        $sortieForm = $this->createForm(CreationSortieType::class, $sortie);
        $sortieForm->handleRequest($request);
        if($sortieForm->isSubmitted() && $sortieForm->isValid()){

            $em->persist($sortie);
            $em->flush();

            $this->addFlash('success', 'La sortie a bien été créée');
            return $this->redirectToRoute('home');
        }


        return $this->render('sortie/creation_sortie.html.twig', [
            'controller_name' => 'SortieController',
            'sortieForm' => $sortieForm->createView()
        ]);
    }


    /**
     * @Route("filtresSorties", name="sortie_filtres")
     */
    public function filtresSorties(EntityManagerInterface $em, Request $request): Response
    {
        $campus = $this->getDoctrine()->getRepository(Campus::class)
            ->findAll();
        $sorties = $this->getDoctrine()->getRepository(Sorties::class)
            ->findAll();


        return $this->render('sortie/filtres_sorties.html.twig', [
            'controller_name' => 'SortieController',
            'campus' => $campus,
            'sorties' => $sorties,
        ]);
    }
}
