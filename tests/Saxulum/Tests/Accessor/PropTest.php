<?php

namespace Saxulum\Tests\Accessor;

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

    public function testWithHintAndNullable()
    {
        $prop = new Prop('test', Hint::HINT_STRING, false);

        $this->assertEquals('test', $prop->getName());
        $this->assertEquals(Hint::HINT_STRING, $prop->getHint());
        $this->assertFalse($prop->getNullable());
    }
}
