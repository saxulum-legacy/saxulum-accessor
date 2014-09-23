<?php

$loader = require __DIR__.'/../vendor/autoload.php';
$loader->add('Saxulum\Tests', __DIR__);

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\Accessors\Add;
use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Is;
use Saxulum\Accessor\Accessors\Remove;
use Saxulum\Accessor\Accessors\Set;

AccessorTrait::registerAccessor(new Add());
AccessorTrait::registerAccessor(new Get());
AccessorTrait::registerAccessor(new Is());
AccessorTrait::registerAccessor(new Remove());
AccessorTrait::registerAccessor(new Set());
