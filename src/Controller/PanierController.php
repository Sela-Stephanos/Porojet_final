<?php

namespace App\Controller;

use App\Entity\Product;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PanierController extends AbstractController
{
    #[Route('/panier', name: 'panier')]
    public function index( SessionInterface $session, ManagerRegistry $manager): Response
    {
        $panier = $session->get('panier', []);

        $total = 0;

        if(!empty($panier))
        {
            foreach ($panier as  $value) {
                $total += $value['produit']->getPrix() * $value['qte'];
            }
        }
        $session->set('total', [$total]);

        return $this->render('panier/panier.twig', [
            'controller_name' => 'PanierController',
        ]);
    }

    #[Route('/panier/add/{id}/{origin}', name: 'panier_add')]
    public function add(SessionInterface $session, Product $product, $origin)
    {
        $panier = $session->get('panier', []);

        if(!empty($panier[$product->getId()]))
        {
            $panier[$product->getId()] = [
                'product' => $product ,
                'qte' => 1
            ];
        }
        else
        {
            $panier[$product->getId()] = [
                'product' => $product,
                'qte' => ++$panier[$product->getId()]['qte']
            ];
        }

        $session->set('panier', $panier);

        if ($origin == "detail")
        {
            return $this->redirectToRoute($origin,['id' => $product->getId()]);
        }
        else
        {
            return $this->redirectToRoute($origin);
        }
    }
    #[Route('/panier/delete/{id}/{origin}', name: 'panier_delete')]
    public function delete()
    {

    }
}
