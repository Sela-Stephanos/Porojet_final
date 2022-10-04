<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;

class InfoController extends AbstractController
{
    /**
     * @throws TransportExceptionInterface
     */
    #[Route('/info', name: 'info')]
    public function index(Request $Re, ManagerRegistry $manager, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form =$this->createForm(ContactType::class, $contact);
        $form->handleRequest($Re);

        if($form->isSubmitted() && $form->isValid())
        {
            $data = $form->getData();
            $em = $manager->getManager();
            $contact->setCreatedAt( new \DateTimeImmutable());
            $em->persist($contact);

            $adresse = $data->getEmail();
            $sujet = $data->getobjet();

            $email = (new TemplatedEmail())
                ->from($adresse)
                ->to()
                ->subject($sujet)
                ->htmlTemplate('info/contact.twig')
                ->context([
                    'contact' => $contact
                ]);

            $mailer->send($email);
            $this->addFlash('send', 'Votre demande de contact a bien été envoyé !');

        }
        return $this->render('info/info.twig', [
            'form' => $form->createView(),
        ]);
    }
}
