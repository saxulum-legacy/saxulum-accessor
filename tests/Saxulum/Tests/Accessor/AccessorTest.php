<?php

namespace Saxulum\Tests\Accessor;

use Doctrine\Common\Collections\ArrayCollection;
use Saxulum\Accessor\Accessors\Add;
use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Is;
use Saxulum\Accessor\Accessors\Remove;
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

    public function testAdd()
    {
        $add = new Add();

        $this->assertEquals(Add::PREFIX, $add->getPrefix());

        $object = new \stdClass();
        $object->array = null;
        $object->collection = new ArrayCollection();

        $valueObject = new \stdClass();

        $this->assertEquals($object, $add->callback($object, $object->array, 'array', array(null)));
        $this->assertEquals($object, $add->callback($object, $object->array, 'array', array(true)));
        $this->assertEquals($object, $add->callback($object, $object->array, 'array', array(1)));
        $this->assertEquals($object, $add->callback($object, $object->array, 'array', array(1.1)));
        $this->assertEquals($object, $add->callback($object, $object->array, 'array', array('test')));
        $this->assertEquals($object, $add->callback($object, $object->array, 'array', array(array('test'))));
        $this->assertEquals($object, $add->callback($object, $object->array, 'array', array($valueObject)));

        $this->assertEquals($object, $add->callback($object, $object->collection, 'collection', array(null)));
        $this->assertEquals($object, $add->callback($object, $object->collection, 'collection', array(true)));
        $this->assertEquals($object, $add->callback($object, $object->collection, 'collection', array(1)));
        $this->assertEquals($object, $add->callback($object, $object->collection, 'collection', array(1.1)));
        $this->assertEquals($object, $add->callback($object, $object->collection, 'collection', array('test')));
        $this->assertEquals($object, $add->callback($object, $object->collection, 'collection', array(array('test'))));
        $this->assertEquals($object, $add->callback($object, $object->collection, 'collection', array($valueObject)));

        $this->assertEquals(null, array_shift($object->array));
        $this->assertEquals(true, array_shift($object->array));
        $this->assertEquals(1, array_shift($object->array));
        $this->assertEquals(1.1, array_shift($object->array));
        $this->assertEquals('test', array_shift($object->array));
        $this->assertEquals(array('test'), array_shift($object->array));
        $this->assertEquals($valueObject, array_shift($object->array));

        $this->assertEquals(null, $object->collection->first());
        $this->assertEquals(true, $object->collection->next());
        $this->assertEquals(1, $object->collection->next());
        $this->assertEquals(1.1, $object->collection->next());
        $this->assertEquals('test', $object->collection->next());
        $this->assertEquals(array('test'), $object->collection->next());
        $this->assertEquals($valueObject, $object->collection->next());
    }

    public function testRemove()
    {
        $remove = new Remove();

        $this->assertEquals(Remove::PREFIX, $remove->getPrefix());

        $valueObject = new \stdClass();

        $elements = array(
            null,
            true,
            1,
            1.1,
            'test',
            array('test'),
            $valueObject
        );

        $count = count($elements);

        $object = new \stdClass();
        $object->array = $elements;
        $object->collection = new ArrayCollection($elements);

        foreach ($elements as $element) {
            $this->assertEquals($object, $remove->callback($object, $object->array, 'array', array($element)));
            $this->assertEquals($object, $remove->callback($object, $object->collection, 'collection', array($element)));

            $count--;

            $this->assertCount($count, $object->array);
            $this->assertCount($count, $object->collection);
        }
    }
}
