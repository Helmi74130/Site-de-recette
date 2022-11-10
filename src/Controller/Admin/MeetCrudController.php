<?php

namespace App\Controller\Admin;

use App\Entity\Meet;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class MeetCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Meet::class;
    }


    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Rendez-vous')
            ->setEntityLabelInSingular('Rendez-vous')
            ->setPageTitle('index', 'Listes des %entity_label_plural%')
            ->setPageTitle('new', 'Ajouter une %entity_label_singular%')
            ->setPageTitle('edit', 'Modifier une %entity_label_singular%');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm()->hideWhenCreating(),
            TextField::new('name')->setLabel('Nom et prénom'),
            EmailField::new('email')->setLabel('E-mail'),
            TextField::new('subject')->setLabel('Sujet du rendez-vous'),
            DateField::new('date')->setLabel('Date'),
            TimeField::new('time')->setLabel('Heure')
        ];
    }

}
