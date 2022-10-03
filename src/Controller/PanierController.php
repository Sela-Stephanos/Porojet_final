<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index($id, SessionInterface $session, ManagerRegistry $manager): Response
    {
        $panier = $session->get('panier', []);

        if (!empty($panier[$id]))
        {
         $panier[$id]++;
        }
        else{$panier[$id] = 1;}

        $session->get('panier', $panier);

        return $this->render('panier/panier.twig', [
            'controller_name' => 'PanierController',
        ]);
    }
}
