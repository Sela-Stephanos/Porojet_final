<?php

namespace App\Controller\Admin;

use App\Entity\Accessoires;
use App\Entity\Casques;
use App\Entity\Crampons;
use App\Entity\Epauliere;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {

    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(ArticlesCrudController::class)
            ->generateUrl();

         return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('MÉTÉOR');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Casques');
        yield MenuItem::subMenu('Gérer-Casques', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Casques::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir', 'fas fa-eye', Casques::class)
        ]);

        yield MenuItem::section('Accesoires');
        yield MenuItem::subMenu('Gérer-accessoires', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Accessoires::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir', 'fas fa-eye', Accessoires::class)
        ]);

        yield MenuItem::section('Epaulières');
        yield MenuItem::subMenu('Gérer-épaulières', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Epauliere::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir', 'fas fa-eye', Epauliere::class)
        ]);

        yield MenuItem::section('Crampons');
        yield MenuItem::subMenu('Gérer-Crampons', 'fas fa-bars')->setSubItems([
            MenuItem::linkToCrud('Ajouter', 'fas fa-plus', Crampons::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir', 'fas fa-eye', Crampons::class)
        ]);



    }
}
