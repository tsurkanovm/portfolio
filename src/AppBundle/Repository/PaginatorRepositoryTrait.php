<?php

namespace AppBundle\Repository;

use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

trait PaginatorRepositoryTrait
{
    /**
     * @param Query $dql
     * @param int $page
     * @param int $limit
     * @return Paginator
     */
    public function paginate(Query $dql, $page = 1, int $limit): Paginator
    {
        $paginator = new Paginator($dql);

        $paginator->getQuery()
            ->setFirstResult($limit * ($page - 1))// Offset
            ->setMaxResults($limit); // Limit

        return $paginator;
    }
}
