<?php

namespace App\Controller;

use App\Entity\Etats;
use App\Entity\Inscriptions;
use App\Entity\Participants;
use App\Entity\Sorties;
use App\Form\AnnulationSortieType;
use App\Form\CreationSortieType;
use App\Form\ModifSortieType;
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

        $sortie = new Sorties();
        $sortie->setOrganisateur($organisateur);
        $inscription = new Inscriptions();
        $inscription->setDateInscription(new \DateTime());
        $inscription->setSortie($sortie);
        $inscription->setParticipant($organisateur);
        $etat = $this->getDoctrine()->getRepository(Etats::class)->findOneBy(['libelle'=>'Créée']);
        $sortie->setEtat($etat);
        $sortieForm = $this->createForm(CreationSortieType::class, $sortie);
        $sortieForm->handleRequest($request);
        if($sortieForm->isSubmitted() && $sortieForm->isValid()){

            $em->persist($sortie);
            $em->persist($inscription);
            $em->flush();

            $this->addFlash('success', 'La sortie a bien été créée');
            return $this->redirectToRoute('home');
        }


        return $this->render('sortie/creation_sortie.html.twig', [
            'controller_name' => 'SortieController',
            'sortieForm' => $sortieForm->createView(),
        ]);
    }

    /**
     * @Route("annulationSortie/{id}", name="sortie_annulation")
     */
    public function annulationSortie(EntityManagerInterface $em, Request $request, $id): Response
    {
        $sortie = $this->getDoctrine()->getRepository(Sorties::class)->find($id);
        if(empty($sortie)){
            throw $this->createNotFoundException('Cette sortie n\'existe pas');
        }

        $annulationForm = $this->createForm(AnnulationSortieType::class, $sortie);
        $annulationForm->handleRequest($request);
        /*$dateNow = new \DateTime();
        if($sortie->getDateCloture() > $dateNow){*/
            if($annulationForm->isSubmitted() && $annulationForm->isValid()){
                $etat = $this->getDoctrine()->getRepository(Etats::class)
                    ->findOneBy(['libelle'=>'Annulée']);
                $sortie->setEtat($etat);
                $em->persist($sortie);
                $em->flush();

                $this->addFlash('success', 'La sortie a bien été annulée');
                return $this->redirectToRoute('home');
            }
        /*} else {
            $this->createNotFoundException('Il est trop tard pour annuler cette sortie..!');
        }*/
        return $this->render('sortie/annulation_sortie.html.twig', [
            'controller_name' => 'SortieController',
            'sortie' => $sortie,
            'annulationForm' => $annulationForm->createView(),
            ]);
    }

    /**
     * @Route("modifSortie/{id}", name="sortie_modif")
     */
    public function modifSortie(EntityManagerInterface $em, Request $request, $id): Response
    {

        $sortie = $this->getDoctrine()->getRepository(Sorties::class)->find($id);
        if(empty($sortie)){
            throw $this->createNotFoundException('Cette sortie n\'existe pas');
        }
        $modifForm = $this->createForm(ModifSortieType::class, $sortie);
        $modifForm->handleRequest($request);
        if($modifForm->isSubmitted() && $modifForm->isValid()){
            $etat = $this->getDoctrine()->getRepository(Etats::class)->findOneBy(['libelle'=>'Créée']);
            $sortie->setEtat($etat);
            $em->persist($sortie);
            $em->flush();

            $this->addFlash('success', 'La sortie a bien été modifiée');
            return $this->redirectToRoute('home');
        }
        return $this->render('sortie/modif_sortie.html.twig', [
            'controller_name' => 'SortieController',
            'sortie' => $sortie,
            'modifForm' => $modifForm->createView(),
        ]);
    }

    /**
     *@Route("suppressionSortie/{id}",name="sortie_suppression", methods={"DELETE"})
     */
    public function suppressionSortie(EntityManagerInterface$em, Request $request, $id):Response
    {
        $sortie=$this->getDoctrine()->getRepository(Sorties::class)->find($id);
        if(empty($sortie)){
            throw$this->createNotFoundException('Cette sortie n\'existe pas');
        }
       if($this->isCsrfTokenValid('delete'.$sortie->getId(), $request->request->get('_token'))){
           $em->remove($sortie);
           $em->flush();
       }

        $this->addFlash('success','La sortie a bien été supprimée');
        return $this->redirectToRoute('home');
    }



}
