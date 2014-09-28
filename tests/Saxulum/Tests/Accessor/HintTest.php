<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Accessor\Hint;

class HintTest extends \PHPUnit_Framework_TestCase
{
    public function testValidateBool()
    {
        $this->assertTrue(Hint::validateBool(false));
        $this->assertTrue(Hint::validateBool(null));
        $this->assertFalse(Hint::validateBool(1));
        $this->assertFalse(Hint::validateBool(null, false));
    }

    public function testValidateInt()
    {
        $this->assertTrue(Hint::validateInt(1));
        $this->assertTrue(Hint::validateInt(null));
        $this->assertFalse(Hint::validateInt(1.0));
        $this->assertFalse(Hint::validateInt(null, false));
    }

    public function testValidateFloat()
    {
        $this->assertTrue(Hint::validateFloat(1.0));
        $this->assertTrue(Hint::validateFloat(null));
        $this->assertFalse(Hint::validateFloat(1));
        $this->assertFalse(Hint::validateFloat(null, false));
    }

    public function testValidateString()
    {
        $this->assertTrue(Hint::validateString('test'));
        $this->assertTrue(Hint::validateString(null));
        $this->assertFalse(Hint::validateString(1));
        $this->assertFalse(Hint::validateString(null, false));
    }

    public function testValidateArray()
    {
        $this->assertTrue(Hint::validateArray(array()));
        $this->assertTrue(Hint::validateArray(null, true));
        $this->assertFalse(Hint::validateArray('test'));
        $this->assertFalse(Hint::validateArray(null));
    }

    public function testValidateObject()
    {
        $this->assertTrue(Hint::validateObject(new \stdClass(), '\stdClass'));
        $this->assertTrue(Hint::validateObject(null, '\stdClass', true));
        $this->assertFalse(Hint::validateObject('test', '\stdClass', true));
        $this->assertFalse(Hint::validateObject(null, '\stdClass'));
    }

    public function testValidate()
    {
        // bool
        $this->assertTrue(Hint::validate(false));
        $this->assertTrue(Hint::validate(false, Hint::HINT_BOOL));
        $this->assertTrue(Hint::validate(null, Hint::HINT_BOOL));
        $this->assertFalse(Hint::validate(1, Hint::HINT_BOOL));
        $this->assertFalse(Hint::validate(null, Hint::HINT_BOOL, false));

        // int
        $this->assertTrue(Hint::validate(1));
        $this->assertTrue(Hint::validate(1, Hint::HINT_INT));
        $this->assertTrue(Hint::validate(null, Hint::HINT_INT));
        $this->assertFalse(Hint::validate(1.0, Hint::HINT_INT));
        $this->assertFalse(Hint::validate(null, Hint::HINT_INT, false));

        // float
        $this->assertTrue(Hint::validate(1.0));
        $this->assertTrue(Hint::validate(1.0, Hint::HINT_FLOAT));
        $this->assertTrue(Hint::validate(null, Hint::HINT_FLOAT));
        $this->assertFalse(Hint::validate(1, Hint::HINT_FLOAT));
        $this->assertFalse(Hint::validate(null, Hint::HINT_FLOAT, false));

        // string
        $this->assertTrue(Hint::validate('test'));
        $this->assertTrue(Hint::validate('test', Hint::HINT_STRING));
        $this->assertTrue(Hint::validate(null, Hint::HINT_STRING));
        $this->assertFalse(Hint::validate(1, Hint::HINT_STRING));
        $this->assertFalse(Hint::validate(null, Hint::HINT_STRING, false));

        // array
        $this->assertTrue(Hint::validate(array()));
        $this->assertTrue(Hint::validate(array(), Hint::HINT_ARRAY));
        $this->assertTrue(Hint::validate(null, Hint::HINT_ARRAY, true));
        $this->assertFalse(Hint::validate('test', Hint::HINT_ARRAY));
        $this->assertFalse(Hint::validate(null, Hint::HINT_ARRAY));

        // object
        $this->assertTrue(Hint::validate(new \stdClass()));
        $this->assertTrue(Hint::validate(new \stdClass(), '\stdClass'));
        $this->assertTrue(Hint::validate(null, '\stdClass', true));
        $this->assertFalse(Hint::validate('test', '\stdClass'));
        $this->assertFalse(Hint::validate(null, '\stdClass'));

        // many objects
        $this->assertTrue(Hint::validate(array(new \stdClass()), '\stdClass[]'));
        $this->assertTrue(Hint::validate(array(new \stdClass(), new \stdClass()), '\stdClass[]'));
        $this->assertTrue(Hint::validate(array(new \stdClass(), null), '\stdClass[]', true));
        $this->assertFalse(Hint::validate(array(new \stdClass(), null, 'test'), '\stdClass[]', true));
    }
}
