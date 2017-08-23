<?php

namespace Tsum\RequestRegistrarBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Tsum\RequestRegistrarBundle\Manager\RequestStorageManagerInterface;

class RequestListener
{
    /**
     * @var RequestStorageManagerInterface
     */
    protected $storageManager;

    /**
     * @param RequestStorageManagerInterface $storageManager
     */
    public function __construct(RequestStorageManagerInterface $storageManager)
    {
        $this->storageManager = $storageManager;
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $this->storageManager->registerRequest($event->getRequest());
    }
}
