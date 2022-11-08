<?php

namespace App\Controller\Admin;

use App\Entity\Allergen;
use App\Entity\Ingredient;
use App\Entity\Recette;
use App\Entity\Regime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Field\LanguageField;
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
            ->setTitle('Sandrine Coupart Administration')
            ->setTranslationDomain('admin');
    }


    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home');
        yield MenuItem::section('Recettes');
        yield MenuItem::subMenu('Administration', 'fa-regular fa-pen-to-square')->setSubItems([
            MenuItem::linkToCrud('Recettes', 'fa-solid fa-utensils', Recette::class),
            MenuItem::linkToCrud('Ingredients', 'fa-solid fa-bowl-rice', Ingredient::class),
            MenuItem::linkToCrud('Allèrgenes', 'fa-solid fa-circle-exclamation', Allergen::class),
            MenuItem::linkToCrud('Régime', 'fa-solid fa-pen', Regime::class)
        ]);
        yield MenuItem::section('Site Web');
        yield MenuItem::subMenu('Pages', 'fa-solid fa-laptop')->setSubItems([
            MenuItem::linkToRoute('Accueil', 'fa-solid fa-house-laptop', 'app_home'),
            MenuItem::linkToRoute('Recettes', 'fa-solid fa-sitemap', 'app_recettes')
        ]);

        //yield MenuItem::linkToLogout('Logout', 'fa fa-exit');

    }
}
