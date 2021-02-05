<?php

namespace App\Controller;

use App\Entity\Sorties;
use App\Entity\SortieSearchFilter;
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
        $sortieSearchFilter = new SortieSearchFilter();
        $sortieSearchForm = $this->createForm(SortieFilterType::class, $sortieSearchFilter);
        $sortieSearchForm->handleRequest($request);
        $sortiesRepo = $this->getDoctrine()->getRepository(Sorties::class);
        $sorties= $sortiesRepo->findAll();
        return $this->render('main/home.html.twig', [
            'controller_name' => 'MainController',
            'sortieSearchForm' => $sortieSearchForm->createView()
        ]);
    }
}
