<?php

namespace Tsum\RequestRegistrarBundle\Manager;

use Doctrine\ORM\EntityManager;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RequestApiManager
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var int
     */
    protected $limit;

    /**
     * RequestListener constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager, $limit)
    {
        $this->entityManager = $entityManager;
        $this->limit = $limit;
    }

    /**
     * @param array $options
     * @return array
     */
    public function getRequests(array $options)
    {
        $resolver = new OptionsResolver();
        $this->configureOptions($resolver);

        $options = $resolver->resolve($options);

        return $this->entityManager
            ->getRepository('RequestRegistrarBundle:RequestStorage')
            ->findRequestByOptions($options);
    }

    /**
     * @param OptionsResolver $resolver
     */
    protected function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'search' => null,
            'ip'     => null,
            'method' => null,
            'route'  => null,
            'limit'  => $this->limit,
        ));
    }
}
