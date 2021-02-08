<?php

namespace App\Controller;

use App\Entity\Sortie;
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
        $sortie = new Sortie();
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
}
