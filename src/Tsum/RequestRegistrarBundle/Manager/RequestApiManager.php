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
     * RequestListener constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
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
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'search'   => null,
            'ip'    => null,
            'method'=> null,
            'route' => null,
            'limit' => 100,
        ));
    }
}
