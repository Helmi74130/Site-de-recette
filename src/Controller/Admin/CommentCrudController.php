<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Commentaires')
            ->setEntityLabelInSingular('Commentaire')
            ->setPageTitle('index', 'Listes des %entity_label_plural%')
            ->setPageTitle('new', 'Ajouter une %entity_label_singular%')
            ->setPageTitle('edit', 'Modifier une %entity_label_singular%')
            ->setPageTitle('detail', 'Voir un %entity_label_singular%');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->setDisabled('form'),
            TextField::new('user')->setLabel('Nom d\'utilisateur'),
            TextareaField::new('message')->setLabel('Commentaire'),
            DateTimeField::new('createdAt')->setLabel('Ajouter le')->setDisabled('form'),
        ];
    }

}
