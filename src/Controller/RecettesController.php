<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Repository\IngredientRepository;
use App\Repository\RecetteRepository;
use Doctrine\Persistence\ManagerRegistry;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecettesController extends AbstractController
{
    #[Route('/recettes', name: 'app_recettes', methods: ['GET'])]
    public function index(RecetteRepository $recetteRepository, Request $request, PaginatorInterface $paginator): Response
    {
        /**
         * This controller display all recettes
         * @param RecetteRepository $hallRepository
         * @param PaginatorInterface $paginator
         * @param Request $request
         * @return Response
         */

        $recettes = $paginator->paginate(
            $recetteRepository->findAll(),
            $request->query->getInt('page', 1),
            6
        );

        return $this->render('recettes/recettes.html.twig', [
            'recettes' => $recettes,
        ]);
    }

    #[Route('/recettes/{title}', name: 'app_recette', methods: ['GET'])]
    public function displayRecipe(Recette $recette): Response
    {
        /**
         * This controller display one recette
         * @param Recette $recette
         * @return Response
         */

        return $this->render('recette/recette.html.twig', [
            'recette'=> $recette
        ]);
    }
}
