<?php
//to listen to events is via an event subscriber, which is a class that defines one or more 
//methods that listen to one or various events
namespace App\EventSubscriber;

use App\Model\TimestampedInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class AdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setEntityCreatedAt'],
            BeforeEntityUpdatedEvent::class => ['setEntityUpdatedAt'],
        ];
    }

    public function setEntityCreatedAt(BeforeEntityPersistedEvent $event)
    {
       $entity = $event->getEntityInstance();

       if (!$entity instanceof TimestampedInterface) {
           return;
       }

       $entity->setCreatedAt(new \DateTime());
    }

    public function setEntityUpdatedAt(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!$entity instanceof TimestampedInterface) {
            return;
        }

        $entity->setUpdatedAt(new \DateTime());
    }
}

