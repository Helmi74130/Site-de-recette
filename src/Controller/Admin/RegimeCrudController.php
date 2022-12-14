<?php

namespace App\Controller\Admin;

use App\Entity\Regime;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class RegimeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Regime::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Régimes')
            ->setEntityLabelInSingular('Régime');
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
