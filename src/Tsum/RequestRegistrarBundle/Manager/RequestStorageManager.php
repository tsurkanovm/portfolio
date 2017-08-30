<?php

namespace Tsum\RequestRegistrarBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Tsum\RequestRegistrarBundle\Model\RequestStorageInterface;

class RequestStorageManager implements RequestStorageManagerInterface
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var RequestStorageInterface
     */
    protected $requestStorage;

    /**
     * RequestListener constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, RequestStorageInterface $requestStorage)
    {
        $this->entityManager  = $entityManager;
        $this->requestStorage = $requestStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function registerRequest(Request $request)
    {
        $this->requestStorage->saveRequest($request);

        $this->entityManager->persist($this->requestStorage);
        $this->entityManager->flush();
    }
}
