<?php

namespace App\Controller;

use App\Entity\Etat;
use App\Entity\Inscription;
use App\Entity\Participant;
use App\Entity\Sortie;
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
        $organisateur = $this->getDoctrine()->getRepository(Participant::class)
            ->findOneByPseudoOrEmail($username);

        $sortie = new Sortie();
        $sortie->setOrganisateur($organisateur);
        $inscription = new Inscription();
        $inscription->setDateInscription(new \DateTime());
        $inscription->setSortie($sortie);
        $inscription->setParticipant($organisateur);
        $etat = $this->getDoctrine()->getRepository(Etat::class)->findOneBy(['libelle'=>'Créée']);
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
        $sortie = $this->getDoctrine()->getRepository(Sortie::class)->find($id);
        if(empty($sortie)){
            throw $this->createNotFoundException('Cette sortie n\'existe pas');
        }

        $annulationForm = $this->createForm(AnnulationSortieType::class, $sortie);
        $annulationForm->handleRequest($request);
        /*$dateNow = new \DateTime();
        if($sortie->getDateCloture() > $dateNow){*/
            if($annulationForm->isSubmitted() && $annulationForm->isValid()){
                $etat = $this->getDoctrine()->getRepository(Etat::class)
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

        $sortie = $this->getDoctrine()->getRepository(Sortie::class)->find($id);
        if(empty($sortie)){
            throw $this->createNotFoundException('Cette sortie n\'existe pas');
        }
        $modifForm = $this->createForm(ModifSortieType::class, $sortie);
        $modifForm->handleRequest($request);
        if($modifForm->isSubmitted() && $modifForm->isValid()){
            $etat = $this->getDoctrine()->getRepository(Etat::class)->findOneBy(['libelle'=>'Créée']);
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
        $sortie=$this->getDoctrine()->getRepository(Sortie::class)->find($id);
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

    /**
     * @Route("publierSortie/{id}", name="sortie_publier")
     */
    public function publierSortie(EntityManagerInterface $em, $id): Response
    {
        $sortie=$this->getDoctrine()->getRepository(Sortie::class)->find($id);
        if(empty($sortie)){
            throw$this->createNotFoundException('Cette sortie n\'existe pas');
        }

        $etat = $this->getDoctrine()->getRepository(Etat::class)->findOneBy(['libelle'=>'Ouverte']);
        $sortie->setEtat($etat);
        $em->persist($sortie);
        $em->flush();

        $this->addFlash('success','La sortie a bien été publiée');
        return $this->redirectToRoute('home');
    }


}
