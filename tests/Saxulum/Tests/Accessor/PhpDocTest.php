<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Tests\Accessor\Fixtures\AccessorHelper;
use Saxulum\Tests\Accessor\Fixtures\Mapping\One2Many;

class PhpDocTest extends \PHPUnit_Framework_TestCase
{
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
* @method $this setManies(Many2One[] $manies)
', $object->_generatePhpDoc());
    }
}
