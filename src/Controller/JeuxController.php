<?php

namespace App\Controller;

//use App\Entity\Jeu;
//use App\Event\JeuEvent;
//use App\Form\JeuType;
use App\Repository\JeuRepository;
//use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
//use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class JeuxController extends AbstractController
{
    #[Route('/{_locale}/jeux', name: 'app_jeux', requirements: ['_locale' => 'en|fr|de'], locale: 'fr')]
    public function index(
        JeuRepository $jeuRepository
    ): response
    {
        $jeux = $jeuRepository->findAll();

        return $this->render('jeux/index.html.twig', [
            'jeux' => $jeux,
        ]);
    }

    #[Route('/{_locale}/jeux/req1', name: 'app_jeux_req1', requirements: ['_locale' => 'en|fr|de'], locale: 'fr')]
    public function req1(
        JeuRepository $jeuRepository
    ): response
    {
        $jeuxPrix = $jeuRepository->findByJeux(1 , 'c', 33000);

        return $this->render('jeux/index.html.twig', [
            'jeux' => $jeuxPrix,
        ]);
    }

    #[Route('/{_locale}/jeux/search', name: 'app_jeux_search', requirements: ['_locale' => 'en|fr|de'], locale: 'fr')]
    public function search(
        JeuRepository $jeuRepository,
        Request $request
    ): response
    {
        $nom = $request->query->get('nom');
        $prix = $request->query->get('prix');
        $cp = $request->query->get('cp');

        $jeux = $jeuRepository->findByJeux($prix, $nom, $cp);

        return $this->render('jeux/index.html.twig', [
            'jeux' => $jeux,
        ]);
    }

    #[Route('/fiche/{code}', name: 'app_fiche')]
    public function fiche(int $code, JeuRepository $jeuRepository): Response
    {
        $jeu = $jeuRepository->find($code);

        return $this->render('jeux/fiche.html.twig', [
            'jeu' => $jeu,
        ]);
    }

    /*#[Route('/new', name: 'app_jeux_newjeu')]
    public function newJeu(Request $request, EntityManagerInterface $entityManager)
    {

        $jeu = new Jeu();

        $form = $this->createForm(JeuType::class, $jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($jeu);
            $entityManager->flush();

            return $this->redirectToRoute('app_jeux', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('jeux/new.html.twig', [
            'form_jeu' => $form->createView(),
            'jeu' => $jeu,
        ]);
    }*/
}