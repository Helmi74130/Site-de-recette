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
        yield MenuItem::linkToCrud('Recettes', 'fa-solid fa-utensils', Recette::class);
        yield MenuItem::section('Liste');
        yield MenuItem::linkToCrud('Ingredients', 'fa-solid fa-bowl-rice', Ingredient::class);
        yield MenuItem::linkToCrud('Allèrgenes', 'fa-solid fa-circle-exclamation', Allergen::class);
        yield MenuItem::linkToCrud('Régime', 'fa-solid fa-pen', Regime::class);
    }
}
