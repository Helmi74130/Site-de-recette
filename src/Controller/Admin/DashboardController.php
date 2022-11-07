<?php

namespace App\Controller\Admin;

use App\Entity\Allergen;
use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\Regime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        return $this->render('admin/admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Sandrine Coupart Administration');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');
        yield MenuItem::linkToCrud('Recettes', 'fas fa-hat-chef', Recette::class);
        yield MenuItem::linkToCrud('Ingredients', 'fas fa-hat-chef', Ingredient::class);
        yield MenuItem::linkToCrud('Allèrgenes', 'fas fa-hat-chef', Allergen::class);
        yield MenuItem::linkToCrud('Régime', 'fas fa-hat-chef', Regime::class);
    }
}
