<?php

namespace Tsum\RequestRegistrarBundle\Repository;

use Doctrine\ORM\EntityRepository;

class RequestStorageRepository extends EntityRepository
{
    public function findRequestByOptions(array $options)
    {
        $queryBuilder = $this->createQueryBuilder('request');


        return $queryBuilder->getQuery()->getResult();
    }
}
