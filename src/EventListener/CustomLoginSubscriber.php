<?php

namespace App\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;
use Symfony\Component\Security\Http\SecurityEvents;

class CustomLoginSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [
            //SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLogin',
            //LoginSuccessEvent::class => 'onLoginSuccess'
            AuthenticationEvent::class => 'onLoginSuccess'
        ];
    }
    public function onLoginSuccess(AuthenticationEvent $event)
    {
        dd($event);
    }
}