<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Doctrine\DBAL\Exception;
use Doctrine\Persistence\ManagerRegistry;
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
    #[Route('/epauliere', name: 'epauliere')]
    public function epaulier(ProductRepository $repo): Response
    {

        $ep =$repo->type(3);

        return $this->render('produits/epauliere.twig', [
            'ep' => $ep
        ]);
    }

    /**
     * @throws Exception
     */
    #[Route('/crampons', name: 'crampons')]
    public function crampon(ProductRepository $repo): Response
    {

        $cr =$repo->type(4);

        return $this->render('produits/crampons.twig', [
            'cr' => $cr
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
            'accessoires' => $acc
        ]);
    }

    #[Route('/details/{id}', name: 'detail')]
    public function detail(ManagerRegistry $manager, $id): Response
    {
        $details = $manager->getRepository(Product::class)->find($id);

        return $this->render('produits/details.twig',[
           'details' => $details
        ]);
    }
}
