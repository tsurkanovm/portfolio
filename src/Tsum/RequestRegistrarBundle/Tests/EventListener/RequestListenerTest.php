<?php

namespace Tsum\RequestRegistrarBundle\Tests\EventListener;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Tsum\RequestRegistrarBundle\EventListener\RequestListener;

class RequestListenerTest extends TestCase
{
    public function testHandleSubRequest()
    {
        $request = new Request();
        $event = $this->getMockBuilder('Symfony\Component\HttpKernel\Event\GetResponseEvent')
            ->disableOriginalConstructor()
            ->getMock();

        $event->expects($this->once())
            ->method('getRequest')
            ->will($this->returnValue($request));

        $storageManager = $this->getMockBuilder('Tsum\RequestRegistrarBundle\Manager\RequestStorageManager')
            ->disableOriginalConstructor()
            ->getMock();
        $storageManager->expects($this->once())
            ->method('registerRequest');

        $listener = new RequestListener($storageManager);
        $listener->onKernelRequest($event);
    }
}
