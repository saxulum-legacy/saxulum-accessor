<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Accessor\Hint;

class HintTest extends \PHPUnit_Framework_TestCase
{
    public function testValidateBool()
    {
        $this->assertTrue(Hint::validateBool(false));
        $this->assertTrue(Hint::validateBool(null, true));
        $this->assertFalse(Hint::validateBool(1, true));
        $this->assertFalse(Hint::validateBool(null));
    }

    public function testValidateInt()
    {
        $this->assertTrue(Hint::validateInt(1));
        $this->assertTrue(Hint::validateInt(null, true));
        $this->assertFalse(Hint::validateInt(1.0, true));
        $this->assertFalse(Hint::validateInt(null));
    }

    public function testValidateFloat()
    {
        $this->assertTrue(Hint::validateFloat(1.0));
        $this->assertTrue(Hint::validateFloat(null, true));
        $this->assertFalse(Hint::validateFloat(1, true));
        $this->assertFalse(Hint::validateFloat(null));
    }

    public function testValidateString()
    {
        $this->assertTrue(Hint::validateString('test'));
        $this->assertTrue(Hint::validateString(null, true));
        $this->assertFalse(Hint::validateString(1, true));
        $this->assertFalse(Hint::validateString(null));
    }

    public function testValidateArray()
    {
        $this->assertTrue(Hint::validateArray(array()));
        $this->assertTrue(Hint::validateArray(null, true));
        $this->assertFalse(Hint::validateArray('test', true));
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
        $this->assertTrue(Hint::validate(null, Hint::HINT_BOOL, true));
        $this->assertFalse(Hint::validate(1, Hint::HINT_BOOL, true));
        $this->assertFalse(Hint::validate(null, Hint::HINT_BOOL));

        // int
        $this->assertTrue(Hint::validate(1));
        $this->assertTrue(Hint::validate(1, Hint::HINT_INT));
        $this->assertTrue(Hint::validate(null, Hint::HINT_INT, true));
        $this->assertFalse(Hint::validate(1.0, Hint::HINT_INT, true));
        $this->assertFalse(Hint::validate(null, Hint::HINT_INT));

        // float
        $this->assertTrue(Hint::validate(1.0));
        $this->assertTrue(Hint::validate(1.0, Hint::HINT_FLOAT));
        $this->assertTrue(Hint::validate(null, Hint::HINT_FLOAT, true));
        $this->assertFalse(Hint::validate(1, Hint::HINT_FLOAT, true));
        $this->assertFalse(Hint::validate(null, Hint::HINT_FLOAT));

        // string
        $this->assertTrue(Hint::validate('test'));
        $this->assertTrue(Hint::validate('test', Hint::HINT_STRING));
        $this->assertTrue(Hint::validate(null, Hint::HINT_STRING, true));
        $this->assertFalse(Hint::validate(1, Hint::HINT_STRING, true));
        $this->assertFalse(Hint::validate(null, Hint::HINT_STRING));

        // array
        $this->assertTrue(Hint::validate(array()));
        $this->assertTrue(Hint::validate(array(), Hint::HINT_ARRAY));
        $this->assertTrue(Hint::validate(null, Hint::HINT_ARRAY, true));
        $this->assertFalse(Hint::validate('test', Hint::HINT_ARRAY, true));
        $this->assertFalse(Hint::validate(null, Hint::HINT_ARRAY));

        // object
        $this->assertTrue(Hint::validate(new \stdClass()));
        $this->assertTrue(Hint::validate(new \stdClass(), '\stdClass'));
        $this->assertTrue(Hint::validate(null, '\stdClass', true));
        $this->assertFalse(Hint::validate('test', '\stdClass', true));
        $this->assertFalse(Hint::validate(null, '\stdClass'));
    }
}
