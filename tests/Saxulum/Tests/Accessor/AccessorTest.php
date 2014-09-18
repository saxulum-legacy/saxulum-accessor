<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Is;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Tests\Accessor\Helpers\GetHelper;
use Saxulum\Tests\Accessor\Helpers\GetHelperWithTrait;
use Saxulum\Tests\Accessor\Helpers\GetOverrideHelper;
use Saxulum\Tests\Accessor\Helpers\GetSetIsHelper;
use Saxulum\Tests\Accessor\Helpers\IsHelper;
use Saxulum\Tests\Accessor\Helpers\OverridingGetHelper;
use Saxulum\Tests\Accessor\Helpers\SetExtendHelper;
use Saxulum\Tests\Accessor\Helpers\SetExtendParentCallHelper;
use Saxulum\Tests\Accessor\Helpers\SetHelper;

class AccessorTest extends \PHPUnit_Framework_TestCase
{
    public static function setUpBeforeClass()
    {
        parent::setUpBeforeClass();

        AccessorTrait::registerAccessor(new Get());
        AccessorTrait::registerAccessor(new Is());
        AccessorTrait::registerAccessor(new Set());
    }

    public function testGet()
    {
        $helper = new GetHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->assertEquals('name', $helper->getName());
        $this->assertEquals('value', $helper->getValue());
    }

    public function testGetSetIs()
    {
        $helper = new GetSetIsHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->assertEquals('name', $helper->getName());
        $this->assertEquals('value', $helper->getValue());
        $this->assertTrue($helper->isName());
        $this->assertTrue($helper->isValue());
    }

    public function testGetOverride()
    {
        $helper = new GetOverrideHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->assertEquals('name_override', $helper->getName());
        $this->assertEquals('value', $helper->getValue());
    }

    public function testGetHelperWithTrait()
    {
        $helper = new GetHelperWithTrait();
        $helper
            ->setName('name')
        ;

        $this->assertEquals('name', $helper->getName());
    }

    public function testIs()
    {
        $helper = new IsHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->assertTrue($helper->isName());
        $this->assertTrue($helper->isValue());
    }

    public function testSet()
    {
        $helper = new SetHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->assertEquals('name', $helper->getName());
        $this->assertEquals('value', $helper->getValue());
    }

    public function testSetExtend()
    {
        $helper = new SetExtendHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->assertEquals('name_override', $helper->getName());
        $this->assertEquals('value', $helper->getValue());
    }

    public function testSetExtendParentCall()
    {
        $helper = new SetExtendParentCallHelper();
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

        new OverridingGetHelper();
    }

    public function testNoAccessorMethod()
    {
        $helper = new SetHelper();
        $helper
            ->setName('name')
            ->setValue('value')
        ;

        $this->setExpectedException('Exception', 'Call to undefined method Saxulum\Tests\Accessor\Helpers\SetHelper::isName()');

        $helper->isName();
    }

    public function testPropertyNotExisting()
    {
        $helper = new GetHelper();

        $this->setExpectedException('Exception', 'Call to undefined method Saxulum\Tests\Accessor\Helpers\GetHelper::getNotExistingProperty()');

        $helper->getNotExistingProperty();
    }
}
