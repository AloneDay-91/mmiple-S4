<?php

namespace App\EventListener;

use App\Event\JeuEvent;
use App\Service\MailerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class JeuSubscriber implements EventSubscriberInterface
{

    public function __construct(protected MailerService $mailerService)
    {

    }
    public static function getSubscribedEvents()
    {
        return [
            JeuEvent::ADDED => 'onJeuAdded',
            JeuEvent::UPDATED => 'onJeuUpdated',
        ];
    }

    public function onJeuAdded(JeuEvent $event)
    {
        $jeu = $event->getJeu();

        $this->mailerService->sendTemplateEmail(
            'admin@mmiple.fr',
            'Un jeu a été ajouté',
            'jeu_added.html.twig',
            ['jeu' => $jeu]

        );
    }

    public function onJeuUpdated(JeuEvent $event)
    {
        $jeu = $event->getJeu();

        $this->mailerService->sendTemplateEmail(
            'admin@mmiple.fr',
            'Un jeu a été modifié',
            'jeu_updated.html.twig',
            ['jeu' => $jeu]

        );
    }
}
