<?php

namespace Tsum\RequestRegistrarBundle;

use Doctrine\Bundle\DoctrineBundle\DependencyInjection\Compiler\DoctrineOrmMappingsPass;
use Doctrine\Bundle\MongoDBBundle\DependencyInjection\Compiler\DoctrineMongoDBMappingsPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class RequestRegistrarBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        if (class_exists(DoctrineOrmMappingsPass::class)) {
            $container->addCompilerPass(
                DoctrineOrmMappingsPass::createXmlMappingDriver(
                    [
                        realpath(__DIR__.'/Resources/config/doctrine/orm') => 'Tsum\RequestRegistrarBundle\Model',
                    ]
                ));
        }

        if (class_exists(DoctrineMongoDBMappingsPass::class)) {
            $container->addCompilerPass(
                DoctrineMongoDBMappingsPass::createXmlMappingDriver(
                    [
                        realpath(__DIR__.'/Resources/config/doctrine-model') => 'Tsum\RequestRegistrarBundle\Model',
                    ]
                ));
        }
    }
}
