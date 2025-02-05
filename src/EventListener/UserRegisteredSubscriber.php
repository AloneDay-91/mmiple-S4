<?php

namespace App\EventListener;

use App\Event\UserRegisteredEvent;
use App\Service\MailerService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class UserRegisteredSubscriber implements EventSubscriberInterface
{

    public function __construct(protected MailerService $mailerService)
    {

    }
    public static function getSubscribedEvents()
    {
        return [
            UserRegisteredEvent::REGISTERED => 'onUserRegistered',
        ];
    }

    public function onUserRegistered(UserRegisteredEvent $event)
    {
        $user = $event->getUser();

        $this->mailerService->sendEmail(
            $user->getEmail(),
            'Bienvenue sur notre site',
            'Bonjour, votre inscription a bien été prise en compte.'
        );
    }
}
