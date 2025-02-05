<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class AccessDeniedListener implements EventSubscriberInterface
{
    private $router;
    private $requestStack;

    public function __construct(RouterInterface $router, RequestStack $requestStack)
    {
        $this->router = $router;
        $this->requestStack = $requestStack;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            KernelEvents::EXCEPTION => ['onKernelException', 2],
        ];
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();

// Vérification de l'exception
        if (!$exception instanceof AccessDeniedException) {
            return;
        }

// Ajouter un message flash
        $request = $this->requestStack->getCurrentRequest();
        $request->getSession()->getFlashBag()->add('error', 'Accès refusé. Vous n\'avez pas le rôle nécessaire pour accéder à cette page.');

// Rediriger vers la page de login
        $response = new RedirectResponse($this->router->generate('app_login'));
        $event->setResponse($response);
    }
}
