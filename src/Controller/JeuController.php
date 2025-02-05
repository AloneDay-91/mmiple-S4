<?php

namespace App\Controller;

use App\Entity\Jeu;
use App\Event\JeuEvent;
use App\Form\JeuType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\UploadPhotoService;

class JeuController extends AbstractController
{

    /**
     * @throws \Exception
     */
    #[Route('/jeu/new', name: 'app_jeu_new')]
    public function new(Request $request, EntityManagerInterface $entityManager, UploadPhotoService $uploadPhotoService, EventDispatcherInterface $eventDispatcher): Response
    {
        // Créer une nouvelle instance de Jeu
        $jeu = new Jeu();

        // Créer le formulaire
        $form = $this->createForm(JeuType::class, $jeu);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $uploadPhotoService->setRepertoireDestination($this->getParameter('kernel.project_dir') . '/public/images/jeux');

            $photo1 = $form->get('photo1')->getData();
            $photo2 = $form->get('photo2')->getData();
            $photo3 = $form->get('photo3')->getData();

            if ($photo1 instanceof UploadedFile) {
                $nomPhoto1 = $uploadPhotoService->upload($photo1);
                $jeu->setPhoto1($nomPhoto1);
            }

            if ($photo2 instanceof UploadedFile) {
                $nomPhoto2 = $uploadPhotoService->upload($photo2);
                $jeu->setPhoto2($nomPhoto2);
            }

            if ($photo3 instanceof UploadedFile) {
                $nomPhoto3 = $uploadPhotoService->upload($photo3);
                $jeu->setPhoto3($nomPhoto3);
            }

            // Persister et enregistrer le jeu dans la base de données
            $entityManager->persist($jeu);
            $entityManager->flush();

            $event = new JeuEvent($jeu);
            $eventDispatcher->dispatch($event, JeuEvent::ADDED);

            // Rediriger vers une autre page (par exemple, la liste des jeux)
            return $this->redirectToRoute('app_jeux');
        }

        // Afficher le formulaire
        return $this->render('jeu/index.html.twig', [
            'form_jeu' => $form->createView(),
            'jeu' => $jeu,
        ]);
    }

    #[Route('/jeu/{id}/modif', name: 'app_jeu_modif', requirements: ['id' => '\d+'])]
    public function modif(int $id, Request $request, EntityManagerInterface $entityManager, UploadPhotoService $uploadPhotoService, EventDispatcherInterface $eventDispatcher): Response
    {
        $jeu = $entityManager->getRepository(Jeu::class)->find($id);
        if (!$jeu) {
            throw $this->createNotFoundException('Jeu Inexistant');
        }
        $form = $this->createForm(JeuType::class, $jeu);

        // Traiter la requête
        $form->handleRequest($request);

        // Vérifier si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {

            $uploadPhotoService->setRepertoireDestination($this->getParameter('kernel.project_dir') . '/public/images/jeux');

            $photo1 = $form->get('photo1')->getData();
            $photo2 = $form->get('photo2')->getData();
            $photo3 = $form->get('photo3')->getData();

            if ($photo1 instanceof UploadedFile) {
                $nomPhoto1 = $uploadPhotoService->upload($photo1);
                $jeu->setPhoto1($nomPhoto1);
            }

            if ($photo2 instanceof UploadedFile) {
                $nomPhoto2 = $uploadPhotoService->upload($photo2);
                $jeu->setPhoto2($nomPhoto2);
            }

            if ($photo3 instanceof UploadedFile) {
                $nomPhoto3 = $uploadPhotoService->upload($photo3);
                $jeu->setPhoto3($nomPhoto3);
            }

            // Persister et enregistrer les modifications dans la base de données
            $entityManager->persist($jeu);
            $entityManager->flush();

            $event = new JeuEvent($jeu);
            $eventDispatcher->dispatch($event, JeuEvent::UPDATED);

            // Rediriger vers la fiche du Jeu
            return $this->redirectToRoute('app_fiche', ['code' => $jeu->getId()]);
        }

        return $this->render('jeu/edit.html.twig', [
            'form_jeu' => $form->createView(),
            'jeu' => $jeu,
            'id' => $id,
        ]);
    }

    #[Route('/jeu/{id}/supprime', name: 'app_jeu_supprime', requirements: ['id' => '\d+'], methods: ['POST'])]
    public function supprime(int $id, EntityManagerInterface $entityManager): Response
    {
        // Récupérer l'entité Jeu existante
        $jeu = $entityManager->getRepository(Jeu::class)->find($id);

        // Vérifier si le jeu existe
        if (!$jeu) {
            throw $this->createNotFoundException('Jeu Inexistant');
        }

        // Supprimer le jeu de la base de données
        $entityManager->remove($jeu);
        $entityManager->flush();

        // Rediriger vers la liste des jeux après la suppression
        return $this->redirectToRoute('app_jeux');
    }
}