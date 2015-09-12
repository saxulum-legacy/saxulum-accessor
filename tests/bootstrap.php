<?php

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->setPsr4('Saxulum\Tests\Accessor\\', __DIR__);

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

use Saxulum\Accessor\AccessorRegistry;
use Saxulum\Accessor\Accessors\Add;
use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Is;
use Saxulum\Accessor\Accessors\Remove;
use Saxulum\Accessor\Accessors\Set;

AccessorRegistry::registerAccessor(new Add());
AccessorRegistry::registerAccessor(new Get());
AccessorRegistry::registerAccessor(new Is());
AccessorRegistry::registerAccessor(new Remove());
AccessorRegistry::registerAccessor(new Set());
