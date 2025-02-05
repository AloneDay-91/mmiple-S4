<?php

namespace App\Controller;

use App\Repository\JeuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class JeuxController extends AbstractController
{
    #[Route('/jeux', name: 'app_jeux')]
    public function index(
        JeuRepository $jeuRepository
    ) : response
    {
        $jeux = $jeuRepository->findAll();

        return $this->render('jeux/index.html.twig', [
            'jeux' => $jeux,
        ]);
    }

    #[Route('/fiche/{code}', name: 'app_fiche')]
    public function fiche(int $code, JeuRepository $jeuRepository ): Response
    {
        $jeu = $jeuRepository->find($code);

        return $this->render('jeux/fiche.html.twig', [
            'jeu' => $jeu,
        ]);
    }
}
