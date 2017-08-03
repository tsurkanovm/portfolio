<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * FrontendBlockRepository
 *
 * @author Tsurkanov Mihail <tsurkanovm@gmail.com>
 */
class FrontendBlockRepository extends EntityRepository
{
    use PaginatorRepositoryTrait;

    /**
     * @param int $currentPage
     * @param int $limit
     * @return Paginator
     */
    public function getAllBlocks(int $currentPage = 1, int $limit): Paginator
    {
        $query = $this->createQueryBuilder('fb')
            ->orderBy('fb.created')
            ->getQuery();

        $paginator = $this->paginate($query, $currentPage, $limit);

        return $paginator;
    }
}
