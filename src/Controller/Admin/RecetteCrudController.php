<?php

namespace App\Controller\Admin;

use App\Entity\Recette;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\JsonResponse;

class RecetteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Recette::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Recettes')
            ->setEntityLabelInSingular('Recette');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('title'),
            AssociationField::new('regimes'),
            AssociationField::new('ingredients'),
            AssociationField::new('allergens'),
            IntegerField::new('note'),
            IntegerField::new('preparationTime'),
            IntegerField::new('cuissonTime'),
            IntegerField::new('reposTime'),
            TextEditorField::new('etapes'),
            TextField::new('photo'),
            TextEditorField::new('description'),




        ];
    }

}
