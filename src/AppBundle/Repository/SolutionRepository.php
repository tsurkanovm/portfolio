<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * SolutionRepository
 *
 * @author Tsurkanov Mihail <tsurkanovm@gmail.com>
 */
class SolutionRepository extends EntityRepository
{
    use PaginatorRepositoryTrait;

    /**
     * @param int $currentPage
     * @param int $limit
     * @return Paginator
     */
    public function getAllSolutions(int $currentPage = 1, int $limit): Paginator
    {
        $query = $this->createQueryBuilder('s')
            ->orderBy('s.name')
            ->getQuery();

        $paginator = $this->paginate($query, $currentPage, $limit);

        return $paginator;
    }
}
