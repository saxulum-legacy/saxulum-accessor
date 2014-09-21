<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Is;
use Saxulum\Accessor\Accessors\Set;

class AccessorTest extends \PHPUnit_Framework_TestCase
{
    public function testGet()
    {
        $get = new Get();

        $this->assertEquals(Get::PREFIX, $get->getPrefix());

        $valueObject = new \stdClass();

        $object = new \stdClass();
        $object->null = null;
        $object->bool = true;
        $object->integer = 1;
        $object->float = 1.1;
        $object->string = 'test';
        $object->array = array('test');
        $object->object = $valueObject;

        $this->assertEquals(null, $get->callback($object, $object->null, 'null', array()));
        $this->assertEquals(true, $get->callback($object, $object->bool, 'bool', array()));
        $this->assertEquals(1, $get->callback($object, $object->integer, 'integer', array()));
        $this->assertEquals(1.1, $get->callback($object, $object->float, 'float', array()));
        $this->assertEquals('test', $get->callback($object, $object->string, 'string', array()));
        $this->assertEquals(array('test'), $get->callback($object, $object->array, 'array', array()));
        $this->assertEquals($valueObject, $get->callback($object, $object->object, 'object', array()));
    }

    public function testIs()
    {
        $is = new Is();

        $this->assertEquals(Is::PREFIX, $is->getPrefix());

        $object = new \stdClass();
        $object->null = null;
        $object->bool = true;
        $object->integer = 1;
        $object->float = 1.1;
        $object->string = 'test';
        $object->array = array('test');
        $object->object = new \stdClass();

        $this->assertFalse($is->callback($object, $object->null, 'null', array()));
        $this->assertTrue($is->callback($object, $object->bool, 'bool', array()));
        $this->assertTrue($is->callback($object, $object->integer, 'integer', array()));
        $this->assertTrue($is->callback($object, $object->float, 'float', array()));
        $this->assertTrue($is->callback($object, $object->string, 'string', array()));
        $this->assertTrue($is->callback($object, $object->array, 'array', array()));
        $this->assertTrue($is->callback($object, $object->object, 'object', array()));
    }

    public function testSet()
    {
        $set = new Set();

        $this->assertEquals(Set::PREFIX, $set->getPrefix());

        $object = new \stdClass();
        $object->null = null;
        $object->bool = null;
        $object->integer = null;
        $object->float = null;
        $object->string = null;
        $object->array = null;
        $object->object = null;

        $valueObject = new \stdClass();

        $this->assertEquals($object, $set->callback($object, $object->null, 'null', array(null)));
        $this->assertEquals($object, $set->callback($object, $object->bool, 'bool', array(true)));
        $this->assertEquals($object, $set->callback($object, $object->integer, 'integer', array(1)));
        $this->assertEquals($object, $set->callback($object, $object->float, 'float', array(1.1)));
        $this->assertEquals($object, $set->callback($object, $object->string, 'string', array('test')));
        $this->assertEquals($object, $set->callback($object, $object->array, 'array', array(array('test'))));
        $this->assertEquals($object, $set->callback($object, $object->object, 'object', array($valueObject)));

        $this->assertEquals(null, $object->null);
        $this->assertEquals(true, $object->bool);
        $this->assertEquals(1, $object->integer);
        $this->assertEquals(1.1, $object->float);
        $this->assertEquals('test', $object->string);
        $this->assertEquals(array('test'), $object->array);
        $this->assertEquals($valueObject, $object->object);
    }
}
