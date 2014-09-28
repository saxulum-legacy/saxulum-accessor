<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Tests\Accessor\Helpers\AccessorHelper;
use Symfony\Component\PropertyAccess\PropertyAccess;

class SymfonyTest extends \PHPUnit_Framework_TestCase
{
    public function testSymfonyPropertyAccess()
    {
        $object = new AccessorHelper();

        $accessor = PropertyAccess::createPropertyAccessor();
        $accessor->setValue($object, 'name', 'test');

        $this->assertEquals('test', $accessor->getValue($object, 'name'));
    }
}
