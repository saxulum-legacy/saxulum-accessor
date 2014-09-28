<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Accessor\AccessorRegistry;
use Saxulum\Accessor\Accessors\Add;
use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Is;
use Saxulum\Accessor\Accessors\Remove;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Tests\Accessor\Helpers\AccessorHelper;
use Saxulum\Tests\Accessor\Helpers\OverrideAccessorHelper;

class AccessorTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testRegistry()
    {
        $accessors = AccessorRegistry::getAccessors();

        $this->assertEquals(array(Add::PREFIX, Get::PREFIX, Is::PREFIX, Remove::PREFIX, Set::PREFIX), array_keys($accessors));
    }

    public function testRegistryOverride()
    {
        $this->setExpectedException('Exception', 'Override Accessor is not allowed, to enhance stability!');

        AccessorRegistry::registerAccessor(new Get());
    }

    public function testCall()
    {
        $object = new AccessorHelper();
        $object->setName('test');
        $object->addValue('test');

        $this->assertEquals('test', $object->getName());
        $this->assertTrue($object->isName());

        $this->assertEquals('test', $object->getValue()[0]);
        $this->assertTrue($object->isValue());

        $object->removeValue('test');

        $this->assertCount(0, $object->getValue());
        $this->assertFalse($object->isValue());
    }

    public function testCallOverride()
    {
        $object = new OverrideAccessorHelper();
        $object->setName('test');
        $object->addValue('test');

        $this->assertEquals('test_override', $object->getName());
        $this->assertEquals('test', $object->getValue()[0]);
        $this->assertEquals('override', $object->getValue()[1]);

        $object->removeValue('test');

        $this->assertCount(1, $object->getValue());
    }
}
