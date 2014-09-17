<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Tests\Accessor\Helpers\GetterAccesorHelper;
use Saxulum\Tests\Accessor\Helpers\GetterAccessorHelperWithTrait;
use Saxulum\Tests\Accessor\Helpers\GetterAccessorOverrideHelper;
use Saxulum\Tests\Accessor\Helpers\GetterSetterIsAccessorBlackListHelper;
use Saxulum\Tests\Accessor\Helpers\GetterSetterIsAccessorHelper;
use Saxulum\Tests\Accessor\Helpers\GetterSetterIsAccessorWhiteListHelper;
use Saxulum\Tests\Accessor\Helpers\IsAccesorHelper;
use Saxulum\Tests\Accessor\Helpers\OverridingGetterAccesorHelper;
use Saxulum\Tests\Accessor\Helpers\SetterAccessorExtendHelper;
use Saxulum\Tests\Accessor\Helpers\SetterAccessorExtendParentCallHelper;
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

    public function testGetterSetterIsAccessor()
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

    public function testGetterAccessorOverride()
    {
        $helper = new GetterAccessorOverrideHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->assertEquals('name_override', $helper->getName());
        $this->assertEquals('value', $helper->getValue());
    }

    public function testGetterAccessorHelperWithTrait()
    {
        $helper = new GetterAccessorHelperWithTrait();
        $helper
            ->setName('name')
        ;

        $this->assertEquals('name', $helper->getName());
    }

    public function testGetterSetterIsAccessorWhiteListHelper()
    {
        $helper = new GetterSetterIsAccessorWhiteListHelper();

        $helper->setName('name');

        $this->setExpectedException('Exception', 'Call to undefined method Saxulum\Tests\Accessor\Helpers\GetterSetterIsAccessorWhiteListHelper::setValue()');

        $helper->setValue('value');

        $this->assertEquals('name', $helper->getName());

        $this->setExpectedException('Exception', 'Call to undefined method Saxulum\Tests\Accessor\Helpers\GetterSetterIsAccessorWhiteListHelper::getValue()');

        $this->assertEquals('value', $helper->getValue());

        $this->assertTrue($helper->isName());

        $this->setExpectedException('Exception', 'Call to undefined method Saxulum\Tests\Accessor\Helpers\GetterSetterIsAccessorWhiteListHelper::isValue()');

        $this->assertTrue($helper->isValue());
    }

    public function testGetterSetterIsAccessorBlackListHelper()
    {
        $helper = new GetterSetterIsAccessorBlackListHelper();

        $helper->setName('name');

        $this->setExpectedException('Exception', 'Call to undefined method Saxulum\Tests\Accessor\Helpers\GetterSetterIsAccessorBlackListHelper::setValue()');

        $helper->setValue('value');

        $this->assertEquals('name', $helper->getName());

        $this->setExpectedException('Exception', 'Call to undefined method Saxulum\Tests\Accessor\Helpers\GetterSetterIsAccessorBlackListHelper::getValue()');

        $this->assertEquals('value', $helper->getValue());

        $this->assertTrue($helper->isName());

        $this->setExpectedException('Exception', 'Call to undefined method Saxulum\Tests\Accessor\Helpers\GetterSetterIsAccessorBlackListHelper::isValue()');

        $this->assertTrue($helper->isValue());
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

    public function testSetterAccessorExtend()
    {
        $helper = new SetterAccessorExtendHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->assertEquals('name_override', $helper->getName());
        $this->assertEquals('value', $helper->getValue());
    }

    public function testSetterAccessorExtendParentCall()
    {
        $helper = new SetterAccessorExtendParentCallHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->assertEquals('name_override', $helper->getName());
        $this->assertEquals('value', $helper->getValue());
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
        $helper = new GetterAccesorHelper();

        $this->setExpectedException('Exception', 'Call to undefined method Saxulum\Tests\Accessor\Helpers\GetterAccesorHelper::getNotExistingProperty()');

        $helper->getNotExistingProperty();
    }
}
