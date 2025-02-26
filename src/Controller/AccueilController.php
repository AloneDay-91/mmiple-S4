<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AccueilController extends AbstractController
{
    #[Route('/{_locale}', name: 'app_accueil', requirements: ['_locale' => 'en|fr|de'], locale: 'fr')]
    public function index(): Response
    {
        return $this->render('accueil/index.html.twig', [
            'dateObjet' => new \DateTime(),
        ]);
    }
}
