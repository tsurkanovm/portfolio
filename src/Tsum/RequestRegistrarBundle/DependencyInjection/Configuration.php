<?php

namespace Tsum\RequestRegistrarBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * {@inheritdoc}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('request_registrar');

        $rootNode
            ->children()
                ->scalarNode('requests_limit')
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
