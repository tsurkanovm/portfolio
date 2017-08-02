<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * FileStorageRepository
 *
 * @author Tsurkanov Mihail <tsurkanovm@gmail.com>
 */
class FileStorageRepository extends EntityRepository
{
    use PaginatorRepositoryTrait;

    /**
     * @param int $currentPage
     * @param int $limit
     * @return Paginator
     */
    public function getAllFiles(int $currentPage = 1, int $limit): Paginator
    {
        $query = $this->createQueryBuilder('fl')
            ->orderBy('fl.name')
            ->getQuery();

        $paginator = $this->paginate($query, $currentPage, $limit);

        return $paginator;
    }
}
