<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Accessor\Accessors\Add;
use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Is;
use Saxulum\Accessor\Accessors\Remove;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Accessor\Prop;
use Saxulum\Tests\Accessor\Fixtures\AccessorHelper;

class PhpDocTest extends \PHPUnit_Framework_TestCase
{
    public function testProp()
    {
        $prop = (new Prop('manies', 'Many2One[]', true, 'one', Prop::REMOTE_ONE))
            ->method(Add::PREFIX)
            ->method(Get::PREFIX)
            ->method(Is::PREFIX)
            ->method(Remove::PREFIX)
            ->method(Set::PREFIX)
        ;

        $this->assertEquals('@method $this addManies(Many2One $manies)
@method Many2One[] getManies()
@method bool isManies()
@method $this removeManies(Many2One $manies)
@method $this setManies(Many2One[] $manies)
', $prop->generatePhpDoc());
    }

    public function testObject()
    {
        $object = new AccessorHelper();

        $this->assertEquals('@method int getId()
@method string getName()
@method bool isName()
@method $this setName(string $name)
@method $this addValue(string $value)
@method string getValue()
@method bool isValue()
@method $this removeValue(string $value)
', $object->_generatePhpDoc());
    }
}
