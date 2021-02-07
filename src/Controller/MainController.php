<?php

namespace App\Controller;

use App\Entity\Sorties;
use App\Entity\SortieSearchData;
use App\Form\SortieFilterType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function home(EntityManagerInterface $em, Request $request): Response
    {
        $sortieDataSearch = new SortieSearchData();
        $sortieSearchForm = $this->createForm(SortieFilterType::class, $sortieDataSearch);
        $sortieSearchForm->handleRequest($request);
        $sortiesRepo = $this->getDoctrine()->getRepository(Sorties::class);
        //$sorties= $sortiesRepo->findSorties();
        //dd($sortieDataSearch);
        $sorties= $sortiesRepo->findSorties($sortieDataSearch);
        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
            'sorties' => $sorties,
            'sortieSearchForm' => $sortieSearchForm->createView()
        ]);
    }
}
