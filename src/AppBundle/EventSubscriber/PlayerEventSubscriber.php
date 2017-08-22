<?php

namespace AppBundle\EventSubscriber;

use ApiPlatform\Core\EventListener\EventPriorities;
use AppBundle\Entity\Player;
use AppBundle\Handler\UserHandler;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForControllerResultEvent;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Class PlayerEventSubscriber
 *
 * @package AppBundle\EventSubscriber
 */
class PlayerEventSubscriber implements EventSubscriberInterface
{
    /**
     * @var UserHandler
     */
    private $userHandler;

    /**
     * PlayerEventSubscriber constructor.
     *
     * @param UserHandler $userHandler
     */
    public function __construct(UserHandler $userHandler)
    {
        $this->userHandler = $userHandler;
    }

    /**
     * @inheritdoc
     *
     * @return array The event names to listen to
     */
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [
                'postPlayerPreWrite', EventPriorities::PRE_WRITE,
                'postPlayerPostWrite', EventPriorities::POST_WRITE
            ],
        ];
    }

    /**
     * @param GetResponseForControllerResultEvent $event
     */
    public function postPlayerPreWrite(GetResponseForControllerResultEvent $event)
    {
        $player = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if(!$player instanceof Player || $method != 'POST') {
            return;
        }

        $this->userHandler->generatePasswordAndActivateUser($player);
    }

    /**
     * @param GetResponseForControllerResultEvent $event
     */
    public function postPlayerPostWrite(GetResponseForControllerResultEvent $event)
    {
        $player = $event->getControllerResult();
        $method = $event->getRequest()->getMethod();

        if(!$player instanceof Player || $method != 'POST') {
            return;
        }

        $this->userHandler->sendRegistrationConfirmationMail($player);
    }
}
