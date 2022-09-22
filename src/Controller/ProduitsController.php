<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use Doctrine\DBAL\Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProduitsController extends AbstractController
{
    /**
     * @throws Exception
     */
    #[Route('/casques', name: 'casque')]
    public function casque(ProductRepository $repo): Response
    {

        $casque =$repo->type(1);

        return $this->render('produits/casque.twig', [
            'casques' => $casque
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/accessoires', name: 'acc')]
    public function accessoires(ProductRepository $repo): Response
    {
        $acc = $repo->type(2);
        return $this->render('produits/accessoires.twig',[
            'accessoires' =>$acc
        ]);
    }

    #[Route('/details', name: 'detail')]
    public function detail(): Response
    {
        //$details = $repo->find($id);

        return $this->render('produits/details.twig',[
           //'details' => $details
        ]);
    }
}
