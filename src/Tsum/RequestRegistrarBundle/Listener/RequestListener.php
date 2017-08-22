<?php

namespace Tsum\RequestRegistrarBundle\Listener;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Tsum\RequestRegistrarBundle\Entity\RequestStorage;

class RequestListener
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * RequestListener constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $storage = new RequestStorage();
        $storage->setBody($request->getContent());
        $storage->setClientIp($request->getClientIp());
        $storage->setMethod($request->getMethod());
        $storage->setRoute($request->getRequestUri());
        $storage->setHeaders(json_encode($request->headers->all()));

        $this->entityManager->persist($storage);
        $this->entityManager->flush();
    }
}
