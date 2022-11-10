<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InformationController extends AbstractController
{
    #[Route('/information/{id}', name: 'app_information')]
    public function index(Request $Re, ManagerRegistry $manager, $id ): Response
    {
        $user = $manager->getRepository(User::class)->find($id);

        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($Re);

        if($form->isSubmitted() && $form->isValid()){

            $em = $manager->getManager();
            $em->flush();
            return $this->redirectToRoute('profil');
        }

        return $this->render('information/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
