<?php

namespace Tsum\RequestRegistrarBundle\Model;

use Symfony\Component\HttpFoundation\Request;

class BaseRequestStorage implements RequestStorageInterface
{
    /**
     * @var string
     */
    protected $headers;

    /**
     * @var string
     */
    protected $body;

    /**
     * @var string
     */
    protected $clientIp;

    /**
     * @var string
     */
    protected $method;

    /**
     * @var string
     */
    protected $route;

    /**
     * @var \DateTime
     */
    protected $registeredAt;

    /**
     * @return string
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param string $headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }

    /**
     * @return string
     */
    public function getClientIp()
    {
        return $this->clientIp;
    }

    /**
     * @param string $clientIp
     */
    public function setClientIp($clientIp)
    {
        $this->clientIp = $clientIp;
    }

    /**
     * @return string
     */
    public function getMethod()
    {
        return $this->method;
    }

    /**
     * @param string $method
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param string $route
     */
    public function setRoute($route)
    {
        $this->route = $route;
    }

    /**
     * @return \DateTime
     */
    public function getRegisteredAt()
    {
        return $this->registeredAt;
    }

    /**
     * @param \DateTime $registeredAt
     */
    public function setRegisteredAt($registeredAt)
    {
        $this->registeredAt = $registeredAt;
    }

    public function prePersist()
    {
        $this->registeredAt = new \DateTime();
    }

    /**
     * @param Request $request
     */
    public function saveRequest(Request $request)
    {
        $this->setBody($request->getContent());
        $this->setClientIp($request->getClientIp());
        $this->setMethod($request->getMethod());
        $this->setRoute($request->getRequestUri());
        $this->setHeaders(json_encode($request->headers->all()));
    }
}
