<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Is;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Accessor\Hint;
use Saxulum\Accessor\Prop;

class PropTest extends \PHPUnit_Framework_TestCase
{
    public function testSimple()
    {
        $prop = new Prop('test');

        $this->assertEquals('test', $prop->getName());
        $this->assertEquals(null, $prop->getHint());
        $this->assertEquals(null, $prop->getNullable());
    }

    public function testWithHint()
    {
        $prop = new Prop('test', Hint::HINT_STRING);

        $this->assertEquals('test', $prop->getName());
        $this->assertEquals(Hint::HINT_STRING, $prop->getHint());
        $this->assertEquals(null, $prop->getNullable());
    }

    public function testWithHintAndNullableFalse()
    {
        $prop = new Prop('test', Hint::HINT_STRING, false);

        $this->assertEquals('test', $prop->getName());
        $this->assertEquals(Hint::HINT_STRING, $prop->getHint());
        $this->assertFalse($prop->getNullable());
    }

    public function testRegisterMethods()
    {
        $prop = new Prop('test');
        $prop->method(Get::PREFIX);
        $prop->method(Is::PREFIX);
        $prop->method(Set::PREFIX);

        $this->assertTrue($prop->hasMethod(Get::PREFIX));
        $this->assertTrue($prop->hasMethod(Is::PREFIX));
        $this->assertTrue($prop->hasMethod(Set::PREFIX));
    }
}
