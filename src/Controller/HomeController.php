<?php

namespace App\Controller;

use App\Repository\PaiementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(PaiementRepository $paiementRepository): Response
    {
        $data_campagnes =  $paiementRepository->getTrio();
       
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
            'data_campagnes'=>$data_campagnes
        ]);
    }
}
