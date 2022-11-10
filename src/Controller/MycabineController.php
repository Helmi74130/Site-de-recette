<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MycabineController extends AbstractController
{
    #[Route('/mon-cabinnet', name: 'app_mycabine')]
    public function index(): Response
    {

        return $this->render('mycabine/index.html.twig', [
        ]);
    }
}
