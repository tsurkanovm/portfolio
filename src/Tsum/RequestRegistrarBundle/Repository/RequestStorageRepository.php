<?php

namespace Tsum\RequestRegistrarBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RequestStorageRepository extends EntityRepository
{
    public function findRequestByOptions(array $options)
    {
        $queryBuilder = $this->createQueryBuilder('request');

        $queryBuilder->select('request')
        ->setMaxResults($options['limit']);

        if ($ip = $options['ip']) {
            $queryBuilder
                ->where($queryBuilder->expr()->eq('request.clientIp', ':ip'))
                ->setParameter('ip', $ip);
        }

        if ($method = $options['method']) {
            $queryBuilder
                ->andWhere($queryBuilder->expr()->eq('request.method', ':method'))
                ->setParameter('method', $method);
        }

        if ($route = $options['route']) {
            $queryBuilder
                ->andWhere($queryBuilder->expr()->eq('request.route', ':route'))
                ->setParameter('route', $route);
        }

        if ($search = $options['search']) {
            $queryBuilder
                ->andWhere($queryBuilder->expr()->orX($queryBuilder->expr()->like('request.headers', ':search'), $queryBuilder->expr()->like('request.body', ':search')))
                ->setParameter('search', $search);
        }

        return $queryBuilder->getQuery()->getResult();
    }
}
