<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Repository\RecetteRepository;
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
    public function displayRecipe(Recette $recette, RecetteRepository $recetteRepository): Response
    {
        /**
         * This controller display one recette
         * @param Recette $recette
         * @param RecetteRepository $recetteRepository
         * @return Response
         */


        /**
         * This loop return 4 random recipes
         * @return Response
         */
        $recettes= $recetteRepository->findAll();
        $randomRecettes=[];


        for ($i=0;$i<4;$i++) {
            $randomRecettes[] = $recettes[(rand(0, count($recettes) - 1))];
        }

        $randomRecettes = array_unique($randomRecettes, SORT_REGULAR);

        return $this->render('recette/recette.html.twig', [
            'recette'=> $recette,
            'randomRecettes'=>$randomRecettes
        ]);
    }
}
