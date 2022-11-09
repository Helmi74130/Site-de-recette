<?php

namespace App\Controller\Admin;

use App\Entity\Recette;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            ->setEntityLabelInSingular('Recette')
            ->setPageTitle('index', 'Listes des %entity_label_plural%')
            ->setPageTitle('new', 'Ajouter une %entity_label_singular%')
            ->setPageTitle('edit', 'Modifier une %entity_label_singular%');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addPanel('Recettes'),
            TextField::new('title')->setLabel('Nom'),
            AssociationField::new('regimes')->hideOnIndex(),
            AssociationField::new('ingredients')->hideOnIndex(),
            AssociationField::new('allergens')->hideOnIndex(),
            FormField::addPanel('Recettes Details'),
            IntegerField::new('note'),
            IntegerField::new('preparationTime')->hideOnIndex(),
            IntegerField::new('cuissonTime')->hideOnIndex(),
            IntegerField::new('reposTime')->hideOnIndex(),
            TextareaField::new('etapes'),
            TextareaField::new('description'),
            TextField::new('photo')->hideOnIndex(),
            TextField::new('imageFile')->setFormType(VichImageType::class)->hideOnIndex(),
            ImageField::new('imageName')->setBasePath('/images/recette/')->onlyOnIndex()->setLabel('Image'),




        ];
    }

}
