<?php

namespace Rahi\ApiBundle\EventListener;

use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use Rahi\ApiBundle\Entity\Account\User;
use Rahi\ApiBundle\Entity\Account\UserGroup;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Doctrine\ORM\EntityManager;


class RegistrationListener implements EventSubscriberInterface
{
    /** @var EntityManager  */
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    public static function getSubscribedEvents()
    {
        return [FOSUserEvents::REGISTRATION_SUCCESS => 'onRegistrationSuccess'];
    }

    public function onRegistrationSuccess(FormEvent $formEvent)
    {
        /** @var User $user */
        $user = $formEvent->getForm()->getData();
        if ($user->getId()) {
            return;
        }
        $user->setDefaultValues();

        $repository = $this->em->getRepository('Rahi\ApiBundle\Entity\Account\UserGroup');
        /** @var UserGroup $userGroup */
        $userGroup = $repository->findOneBy(['slug' => UserGroup::SLUG_STANDARD]);
        $user->setUserGroup($userGroup);
    }
}
