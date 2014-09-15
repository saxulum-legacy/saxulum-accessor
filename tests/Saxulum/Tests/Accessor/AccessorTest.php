<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Tests\Accessor\Helpers\GetterAccesorHelper;
use Saxulum\Tests\Accessor\Helpers\GetterSetterIsAccessorHelper;
use Saxulum\Tests\Accessor\Helpers\IsAccesorHelper;
use Saxulum\Tests\Accessor\Helpers\OverridingGetterAccesorHelper;
use Saxulum\Tests\Accessor\Helpers\SetterAccessorHelper;

class AccessorTest extends \PHPUnit_Framework_TestCase
{
    public function testGetterAccessor()
    {
        $helper = new GetterAccesorHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->assertEquals('name', $helper->getName());
        $this->assertEquals('value', $helper->getValue());
    }

    public function testIsAccessor()
    {
        $helper = new IsAccesorHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->assertTrue($helper->isName());
        $this->assertTrue($helper->isValue());
    }

    public function testSetterAccessor()
    {
        $helper = new SetterAccessorHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->assertEquals('name', $helper->getName());
        $this->assertEquals('value', $helper->getValue());
    }

    public function testGetterSetterAccessor()
    {
        $helper = new GetterSetterIsAccessorHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->assertEquals('name', $helper->getName());
        $this->assertEquals('value', $helper->getValue());
        $this->assertTrue($helper->isName());
        $this->assertTrue($helper->isValue());
    }

    public function testOverridingAccessor()
    {
        $this->setExpectedException('Exception', 'Override Accessor is not allowed, to enhance stability!');

        new OverridingGetterAccesorHelper();
    }

    public function testNoAccessorMethod()
    {
        $helper = new SetterAccessorHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->setExpectedException('Exception', 'Call to undefined method Saxulum\Tests\Accessor\Helpers\SetterAccessorHelper::isName()');

        $helper->isName();
    }

    public function testPropertyNotExisting()
    {
        $this->setExpectedException('Exception', 'Call to undefined method Saxulum\Tests\Accessor\Helpers\GetterAccesorHelper::getNotExistingProperty()');

        $helper = new GetterAccesorHelper();
        $helper->getNotExistingProperty();
    }
}
