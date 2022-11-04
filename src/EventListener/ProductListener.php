<?php

// src/EventListener/ExceptionListener.php
namespace App\EventListener;

use App\Entity\Product;
use App\Service\SendMail;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class ProductListener
{
    protected $needsFlush = false;
    protected $fields = false;

    public function postPersist($entity, LifecycleEventArgs $eventArgs)
    {
        if (!$this->isCorrectObject($entity)) {
            return null;
        }

        $mailService = new SendMail($entity);

        // $this->fields
        $mailService->sendMail($entity);

        return true;
    }

    public function postUpdate($entity, LifecycleEventArgs $eventArgs)
    {
        if (!$this->isCorrectObject($entity)) {
            return null;
        }

        $mailService = new SendMail($entity);

        // $this->fields
        $mailService->sendMail($entity);

        return true;
    }


    public function setFields($entity, LifecycleEventArgs $eventArgs)
    {
        $this->fields = array_diff_key(
            $eventArgs->getEntityChangeSet(),
            ['modified' => 0]
        );

        return true;
    }


    public function isCorrectObject($entity)
    {
        return $entity instanceof Product;
    }
}
