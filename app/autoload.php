<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/** @var ClassLoader $loader */
$loader = require __DIR__.'/../vendor/autoload.php';
class_alias('Fidry\AliceDataFixtures\Bridge\Doctrine\Purger\Purger', 'Fidry\AliceDataFixtures\Bridge\Doctrine\Purger\OrmPurger');
AnnotationRegistry::registerLoader([$loader, 'loadClass']);

return $loader;
