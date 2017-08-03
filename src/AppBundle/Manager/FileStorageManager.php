<?php
/**
 * Created by PhpStorm.
 * User: mihail
 * Date: 02.08.17
 * Time: 18:20
 */

namespace AppBundle\Manager;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class FileStorageManager
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @return array
     */
    public static function getAllowedContext(): array
    {
        return [
            '' => '',
            'Project' => 'project',
            'Solution' => 'solution'
        ];
    }

    public function getRepository(): EntityRepository
    {
        return $this->entityManager->getRepository('AppBundle:FileStorage');
    }

    /**
     * @param EntityManager $entityManager
     */
    public function setEntityManager(EntityManager $entityManager): void
    {
        $this->entityManager = $entityManager;
    }
}
