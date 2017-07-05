<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * ProjectRepository
 *
 * @author Tsurkanov Mihail <tsurkanovm@gmail.com>
 */
class ProjectRepository extends EntityRepository
{
    use PaginatorRepositoryTrait;

    /**
     * @return array
     */
    public function findMain()
    {
        return $this
            ->createQueryBuilder('project')
            ->where('project.displayOnHome = :status')
            ->andWhere('project.status = :status')
            ->setParameter('status' , true)
            ->addOrderBy('project.weight', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @param int $currentPage
     * @param int $limit
     * @return Paginator
     */
    public function getAllProjects(int $currentPage, int $limit): Paginator
    {
        $query = $this->createQueryBuilder('p')
            ->orderBy('p.created', 'DESC')
            ->getQuery();

        $paginator = $this->paginate($query, $currentPage, $limit);

        return $paginator;
    }
}
