<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Tests\Accessor\Fixtures\AccessorHelper;
use Saxulum\Tests\Accessor\Fixtures\Entity\Entity;
use Saxulum\Tests\Accessor\Fixtures\Mapping\Many2Many;
use Saxulum\Tests\Accessor\Fixtures\Mapping\Many2One;
use Saxulum\Tests\Accessor\Fixtures\Mapping\One2Many;
use Saxulum\Tests\Accessor\Fixtures\Mapping\One2One;

class PhpDocTest extends \PHPUnit_Framework_TestCase
{
    public function testEntity()
    {
        $object = new Entity();

        $this->assertEquals('* @method int getId()
* @method string getName()
* @method bool isName()
* @method $this setName(string $name)
* @method $this addValue(string $value)
* @method string getValue()
* @method bool isValue()
* @method $this removeValue(string $value)
', $object->_generatePhpDoc());
    }

    public function testAccessorHelper()
    {
        $object = new AccessorHelper();

        $this->assertEquals('* @method int getId()
* @method string getName()
* @method bool isName()
* @method $this setName(string $name)
* @method $this addValue(string $value)
* @method string getValue()
* @method bool isValue()
* @method $this removeValue(string $value)
', $object->_generatePhpDoc());
    }

    public function testOne2Many()
    {
        $object = new One2Many();

        $this->assertEquals('* @method $this addManies(Many2One $manies)
* @method Many2One[] getManies()
* @method $this removeManies(Many2One $manies)
* @method $this setManies(array $manies)
', $object->_generatePhpDoc());
    }

    public function testMany2One()
    {
        $object = new Many2One();

        $this->assertEquals('* @method string getName()
* @method $this setName(string $name)
* @method One2Many getOne()
* @method $this setOne(One2Many $one)
', $object->_generatePhpDoc());
    }

    public function testOne2One()
    {
        $object = new One2One();

        $this->assertEquals('* @method One2One getOne()
* @method $this setOne(One2One $one)
', $object->_generatePhpDoc());
    }

    public function testMany2Many()
    {
        $object = new Many2Many();

        $this->assertEquals('* @method $this addManies(Many2Many $manies)
* @method Many2Many[] getManies()
* @method $this removeManies(Many2Many $manies)
* @method $this setManies(array $manies)
', $object->_generatePhpDoc());
    }
}
