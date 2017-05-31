<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ProjectRepository
 *
 * @author Tsurkanov Mihail <tsurkanovm@gmail.com>
 */
class ProjectRepository extends EntityRepository
{
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
}
