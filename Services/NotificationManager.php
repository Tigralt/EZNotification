<?php

namespace Tigralt\EZNotificationBundle\Services;

use Tigralt\EZNotificationBundle\Entity\Notification;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Doctrine\ORM\EntityManager;

class NotificationManager
{
    protected $em;
    protected $ts;

    public function __construct(EntityManager $entityManager, TokenStorage $tokenStorage)
    {
        $this->em = $entityManager;
        $this->ts = $tokenStorage;
    }

    private function getUser()
    {
        return $this->ts->getToken()->getUser();
    }

    public function getNotSeen($user = null)
    {
        $user = is_null($user)? $this->getUser(): $user;

        $notifications = $this->em->getRepository("EZNotificationBundle:Notification")->findBy(array(
            "userId" => $user->getId(),
            "seen" => false
        ));

        return $notifications;
    }

    public function getNbNotSeen($user = null)
    {
        $user = is_null($user)? $this->getUser(): $user;

        return $this->em->getRepository("EZNotificationBundle:Notification")->getNbNotSeen($user->getId());
    }

    public function getAll($user = null)
    {
        $user = is_null($user)? $this->getUser(): $user;

        $notifications = $this->em->getRepository("EZNotificationBundle:Notification")->findBy(array(
            "userId" => $user->getId()
        ));

        return $notifications;
    }

    public function get()
    {
        return $this->em->getRepository("EZNotificationBundle:Notification")->findAll();
    }

    public function add($title, $message, $priority, $user = null)
    {
        $user = is_null($user)? $this->getUser(): $user;

        $notification = new Notification();
        $notification->setUserId($user->getId());
        $notification->setTitle($title);
        $notification->setMessage($message);
        $notification->setPriority($priority);

        $this->em->persist($notification);
        $this->em->flush();
    }
}
