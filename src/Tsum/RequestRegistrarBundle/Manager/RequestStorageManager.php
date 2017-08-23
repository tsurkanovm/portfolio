<?php

namespace Tsum\RequestRegistrarBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Tsum\RequestRegistrarBundle\Entity\RequestStorage;

class RequestStorageManager implements RequestStorageManagerInterface
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

    /**
     * {@inheritdoc}
     */
    public function registerRequest(Request $request)
    {
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
