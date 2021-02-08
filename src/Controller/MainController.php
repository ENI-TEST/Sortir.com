<?php

namespace App\Controller;

use App\Entity\Sortie;
use App\Entity\SortieSearchData;
use App\Form\SortieFilterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(EntityManagerInterface $em, Request $request): Response
    {
        $participant = $this->getUser();
        $sortieDataSearch = new SortieSearchData();
        $sortieSearchForm = $this->createForm(SortieFilterType::class, $sortieDataSearch);
        $sortieSearchForm->handleRequest($request);
        $sortiesRepo = $this->getDoctrine()->getRepository(Sortie::class);

        $sorties= $sortiesRepo->findSorties($sortieDataSearch, $participant);
        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
            'participant' => $participant,
            'sorties' => $sorties,
            'sortieSearchForm' => $sortieSearchForm->createView()
        ]);
    }
}
