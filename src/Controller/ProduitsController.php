<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{
    #[Route('/produits', name: 'casque')]
    public function index(): Response
    {
        return $this->render('produits/casque.twig', [
            'controller_name' => 'ProduitsController',
        ]);
    }
}
