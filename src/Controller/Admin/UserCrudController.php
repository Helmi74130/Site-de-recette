<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Utilisateurs')
            ->setEntityLabelInSingular('Utilisateur');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setDisabled(),
            TextField::new('email'),
            FormField::addPanel('Profile utilisateurs'),
            TextField::new('name')->setLabel('Nom'),
            TextField::new('firstname')->setLabel('Prénom'),
            TextField::new('city')->setLabel('Ville'),
            TextField::new('allergens')->setLabel('Allergènes'),
            FormField::addPanel('Droits d\'utilisateurs'),
            ArrayField::new('roles')->setLabel('Roles'),
            BooleanField::new('isverified')->setLabel('Courriel vérifié'),
            TextField::new('password')

        ];
    }

}
