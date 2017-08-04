<?php

namespace AppBundle\Twig;

use AppBundle\Entity\FrontendBlock;
use Doctrine\ORM\EntityManager;

class BlockExtension extends \Twig_Extension
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * BlockExtension constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new \Twig_SimpleFunction(
                'render_block',
                [$this, 'renderBlock'],
                ['is_safe' => ['html']]
            ),
        ];
    }

    /**
     * @param string $blockName
     * @return string
     */
    public function renderBlock(string $blockName): string
    {
        /* @var $block FrontendBlock */
        $block = $this->entityManager
            ->getRepository('AppBundle:FrontendBlock')
            ->findOneByName($blockName);

        return $block->getContent();
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return 'render_block_extension';
    }
}
