<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{
    #[Route('/casques', name: 'casque')]
    public function casque(): Response
    {

        return $this->render('produits/casque.twig', [
            'casques' => $casque
        ]);
    }
}
