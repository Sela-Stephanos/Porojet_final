<?php

namespace App\Controller;
use App\Entity\Order;
use App\Entity\User;
use App\Repository\ProductRepository;
use http\Env;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Stripe\Checkout\Session;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use Stripe\StripeClient;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
#[IsGranted('IS_AUTHENTICATED_FULLY')]
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
    public function checkout(SessionInterface $session): RedirectResponse
    {
        $cube = function ($paniers){
            $result = [];

            foreach ($paniers as $panier) {
                $result[] = [
                    'quantity' => $panier['qte'],
                    'price_data' => ['currency' => 'EUR',
                        'product_data' => ['name' => $panier['product']->getName(),],
                        'unit_amount' => $panier['product']->getPrice() . '00',]];
            }
            return $result;
        };
        $panier = $session->get('panier', []);
        $total = $session->get('total', []);


        Stripe::setApiKey($this->getParameter("stripeSk"));
        // recup ton panier

        $articles = [];

        $session = Session::create([
            'line_items' => [ $cube($panier)],
            'mode' => 'payment',
            'customer_email' => $this->getUser()->getEmail(),
            'success_url' => $this->generateUrl('success', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'cancel_url' =>  $this->generateUrl('cancel', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'billing_address_collection' => 'required',
            'shipping_address_collection' => [
                'allowed_countries' => ['FR']
            ]
        ]);

        return $this->redirect($session->url, 303);
    }

    /**
     * @throws ApiErrorException
     */
    #[Route('/buy/success', name: 'success')]
    public function success(SessionInterface $session, \Doctrine\Persistence\ManagerRegistry $doctrine): Response
    {
        $panier = $session->get('panier', []);
        $qte = 0;

        foreach ($panier as $key => $value) {
            $qte += $value['qte'];
        }
        $total = $session->get('total', []);

        $lastOrder = $session->get('lastorder', []);

            $client = new StripeClient($this->getParameter("stripeSk"));

            $result = $client->checkout->sessions->retrieve($lastOrder, []);

            $adressLivraison = $result->customer_details->address;
            $emailLivraison = $result->customer_details->email;
            $nameLivraison = $result->customer_details->name;
            $adressDetail = $result->shipping_details->address;
            $nameDetail = $result->shipping_details->name;

            $reference = chr(substr("000" . (rand(1, 9) + 65), -3)) . rand(1000, 9999);

            $order = new Order();
            $em = $doctrine->getManager();

            $order->setPanier($panier);
            $order->setReference($reference);
            $order->setTotal($total[0]);
            $order->setCreatedAt(new \DateTimeImmutable);
            $order->setUser($this->getUser());
            $order->setAadresseFacturation($adressLivraison);
            $order->setAadresseLivraison($adressDetail);
            $order->setNameFacturation($nameDetail);
            $order->setNameLivraison($nameLivraison);
            $order->setEmail($emailLivraison);
            $order->setState(false);
            $order->setStateSending('en cours');
            $order->setQuantity($qte);

            $em->persist($order);
            $em->flush();

        return $this->render('payment/success.twig', [
            'panier'=>$panier
        ]);
    }

    #[Route('/buy/cancel', name: 'cancel')]
    public function cancel(): Response
    {
        return $this->render('payment/cancel.twig');
    }

}

