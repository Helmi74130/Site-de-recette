<?php

namespace App\Controller;

use App\Entity\Meet;
use App\Form\MeetType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MycabineController extends AbstractController
{
    #[Route('/rendez-vous', name: 'app_mycabine')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $meet = new Meet();
        $form = $this->createForm(MeetType::class, $meet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $form->getData();
            $entityManager->persist($meet);
            $entityManager->flush();

            $this->addFlash('success', 'Votre rendez-vous a été enregistré avec succès.');

            return $this->redirectToRoute('app_mycabine');

        };

        return $this->render('mycabine/index.html.twig', [
            'meetForm' => $form->createView(),
        ]);
    }
}
