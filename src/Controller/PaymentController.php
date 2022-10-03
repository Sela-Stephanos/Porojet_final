<?php

namespace App\Controller;
use App\Repository\ProductRepository;
use http\Env;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'app_payment')]
    public function index(): Response
    {
        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
        ]);
    }


    /**
     * @throws ApiErrorException
     */
    #[Route('buy', name: 'buy')]
    public function checkout(ProductRepository $repo, SessionInterface $session): RedirectResponse
    {
        Stripe::setApiKey($this->getParameter("stripeSk"));
        // recup ton panier
        $panier = $session->get('panier', []);
        $articles = [];

        $session = Session::create([
            'line_items' => [
                [
                'price_data' => [
                    'currency' => 'eur',
                    'product_data' => [
                        'name' => 'T-shirt',
                    ],
                    'unit_amount' => 2000,
                ],
                'quantity' => 1,
            ],
                [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'T-shirt',
                        ],
                        'unit_amount' => 200,
                    ],
                    'quantity' =>2,
                ]
                ],
            'mode' => 'payment',
            'success_url' => 'https://example.com/success',
            'cancel_url' => 'https://example.com/cancel',
        ]);
        return $this->redirect($session->url, 303);
    }
}
