<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Tests\Accessor\Helpers\GetterAccesorHelper;
use Saxulum\Tests\Accessor\Helpers\GetterSetterIsAccessorHelper;
use Saxulum\Tests\Accessor\Helpers\IsAccesorHelper;
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
}
