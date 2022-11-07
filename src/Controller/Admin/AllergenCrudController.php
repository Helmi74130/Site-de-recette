<?php

namespace App\Controller\Admin;

use App\Entity\Allergen;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AllergenCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Allergen::class;
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
