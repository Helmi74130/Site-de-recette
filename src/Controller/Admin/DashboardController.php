<?php

namespace App\Controller\Admin;

use App\Entity\Allergen;
use App\Entity\Contact;
use App\Entity\Ingredient;
use App\Entity\Meet;
use App\Entity\Recette;
use App\Entity\Regime;
use App\Entity\User;
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
            ->setTitle('Sandrine Coupart Administration')
            ->setTranslationDomain('admin');
    }


    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Accueil', 'fa fa-home')->setCssClass('fs-3');
        yield MenuItem::section('Recettes')->setCssClass('fs-5 font-weight-bold');
        yield MenuItem::subMenu('Administration', 'fa-regular fa-pen-to-square')->setSubItems([
            MenuItem::linkToCrud('Recettes', 'fa-solid fa-utensils', Recette::class),
            MenuItem::linkToCrud('Ingredients', 'fa-solid fa-bowl-rice', Ingredient::class),
            MenuItem::linkToCrud('Allèrgenes', 'fa-solid fa-circle-exclamation', Allergen::class),
            MenuItem::linkToCrud('Régime', 'fa-solid fa-pen', Regime::class)
        ])->setCssClass('fs-5');
        yield MenuItem::section('Utilisateurs')->setCssClass('fs-5 font-weight-bold');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa-solid fa-users', User::class);
        yield MenuItem::section('Contact')->setCssClass('fs-5 font-weight-bold');
        yield MenuItem::linkToCrud('Mes messages', 'fa-regular fa-message', Contact::class);
        yield MenuItem::section('Rendez-vous')->setCssClass('fs-5 font-weight-bold');
        yield MenuItem::linkToCrud('Mes rendez-vous', 'fa-regular fa-handshake', Meet::class);
        yield MenuItem::section('Site Web')->setCssClass('fs-5 font-weight-bold');
        yield MenuItem::subMenu('Pages', 'fa-solid fa-laptop')->setSubItems([
            MenuItem::linkToRoute('Accueil', 'fa-solid fa-house-laptop', 'app_home'),
            MenuItem::linkToRoute('Recettes', 'fa-solid fa-sitemap', 'app_recettes')
        ]);
        yield MenuItem::linkToLogout('Déconnexion', 'fa fa-exit')->setCssClass('fs-4 btn btn-warning mt-5');



    }
}
