<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Entity\Recette;
use App\Form\CommentType;
use App\Repository\AllergenRepository;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RecettesController extends AbstractController
{
    #[Route('/recettes', name: 'app_recettes', methods: ['GET'])]
    public function index(RecetteRepository $recetteRepository, Request $request, PaginatorInterface $paginator, AllergenRepository $allergenRepository): Response
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

        $user = $this->getUser();
        if (isset($user)){
            $currentUserAllergensString = str_replace(', ','.',$user->getAllergens());
            $currentUserAllergensArray = explode(".", $currentUserAllergensString);
        }else{
            $currentUserAllergensArray ='';
        }


        return $this->render('recettes/recettes.html.twig', [
            'recettes' => $recettes,
            'currentUserAllergensArray'=> $currentUserAllergensArray,
        ]);
    }

    #[Route('/recettes/{title}', name: 'app_recette', methods: ['GET', 'POST'])]
    public function displayRecipe(Recette $recette, RecetteRepository $recetteRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
        /**
         * This controller display one recette
         * @param Recette $recette
         * @param RecetteRepository $recetteRepository
         * @return Response
         */

        $user = $this->getUser();
        if (isset($user)){
            $currentUserAllergensString = str_replace(', ','.',$user->getAllergens());
            $currentUserAllergensArray = explode(".", $currentUserAllergensString);
        }else{
            $currentUserAllergensArray ='';
        }

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

        /**
         * Add new comment in database
         * @param Request $request
         * @param EntityManagerInterface $entityManager
         */

        $comment = new Comment();
        $form = $this->createForm(CommentType::class, $comment);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $comment->setRecette($recette);
            $entityManager->persist($comment);
            $entityManager->flush();

            $this->addFlash('success', 'Votre commentaire a été enregistré avec succès.');

            return $this->redirectToRoute('app_home');

        };



        return $this->render('recette/recette.html.twig', [
            'recette'=> $recette,
            'randomRecettes'=>$randomRecettes,
            'currentUserAllergensArray'=> $currentUserAllergensArray,
            'commentForm' => $form->createView(),
        ]);
    }
}
