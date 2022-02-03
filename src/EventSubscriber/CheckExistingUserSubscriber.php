<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;

class CheckExistingUserSubscriber implements EventSubscriberInterface
{

    /**
     * @throws Exception
     */
    public function onCheckPassport(CheckPassportEvent $event)
    {
        $passport = $event->getPassport();

        $user = $passport->getUser();
        if (!$user instanceof User) {
            throw new AuthenticationException();
        }

        if (empty($user->getRoles())) {
            throw new AuthenticationException();
        }

    }


    public static function getSubscribedEvents()
    {
        return [
            CheckPassportEvent::class => 'onCheckPassport',
        ];
    }
}