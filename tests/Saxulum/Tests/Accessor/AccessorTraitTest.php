<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Is;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Tests\Accessor\Helpers\AccessorHelper;
use Saxulum\Tests\Accessor\Helpers\OverrideAccessorHelper;

class AccessorTraitTest extends \PHPUnit_Framework_TestCase
{
    const ACCESSOR_HELPER_NAMESPACE = 'Saxulum\Tests\Accessor\Helpers\AccessorHelper';

    protected function tearDown()
    {
        $accessorsProperty = new \ReflectionProperty(self::ACCESSOR_HELPER_NAMESPACE, '__accessors');
        $accessorsProperty->setAccessible(true);
        $accessorsProperty->setValue(array());
    }

    public function testRegistry()
    {
        AccessorHelper::registerAccessor(new Get());
        AccessorHelper::registerAccessor(new Is());
        AccessorHelper::registerAccessor(new Set());

        $accessors = \PHPUnit_Framework_Assert::readAttribute(self::ACCESSOR_HELPER_NAMESPACE, '__accessors');

        $this->assertEquals(array(Get::PREFIX, Is::PREFIX, Set::PREFIX), array_keys($accessors));
    }

    public function testRegistryOverride()
    {
        AccessorHelper::registerAccessor(new Get());

        $this->setExpectedException('Exception', 'Override Accessor is not allowed, to enhance stability!');

        AccessorHelper::registerAccessor(new Get());
    }

    public function testCallWithoutAccessor()
    {
        $object = new AccessorHelper();

        $this->setExpectedException('Exception', self::ACCESSOR_HELPER_NAMESPACE . '::setName()');

        $object->setName('test');
    }

    public function testCall()
    {
        AccessorHelper::registerAccessor(new Get());
        AccessorHelper::registerAccessor(new Set());

        $object = new AccessorHelper();
        $object->setName('test');

        $this->assertEquals('test', $object->getName());
    }

    public function testCallOverride()
    {
        AccessorHelper::registerAccessor(new Get());
        AccessorHelper::registerAccessor(new Set());

        $object = new OverrideAccessorHelper();
        $object->setName('test');

        $this->assertEquals('test_override', $object->getName());
    }

    public function testTwig()
    {
        AccessorHelper::registerAccessor(new Get());
        AccessorHelper::registerAccessor(new Set());

        $object = new AccessorHelper();
        $object->setName('test');

        $loader = new \Twig_Loader_Filesystem(__DIR__ . '/Resources/views');
        $twig = new \Twig_Environment($loader);

        $rendered = $twig->loadTemplate('test.html.twig')->render(array(
            'object' => $object,
        ));

        $this->assertEquals('test', trim($rendered));
    }
}
