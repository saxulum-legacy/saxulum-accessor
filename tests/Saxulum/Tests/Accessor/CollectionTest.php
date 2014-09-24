<?php

namespace Saxulum\Tests\Accessor;

use Doctrine\Common\Collections\ArrayCollection as DoctrineOrigArrayColletion;
use Saxulum\Accessor\Collection\ArrayCollection;
use Saxulum\Accessor\Collection\DoctrineArrayCollection;

class CollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testArrayColletion()
    {
        $array = array();

        $collection = new ArrayCollection($array);
        $collection->add('value1');
        $collection->add('value2');

        $this->assertCount(2, $array);

        $collection->remove('value2');

        $this->assertCount(1, $array);

        $this->assertTrue($collection->contains('value1'));
        $this->assertFalse($collection->contains('value2'));
    }

    public function testDoctrineArrayColletion()
    {
        $doctrineArrayCollection = new DoctrineOrigArrayColletion();

        $collection = new DoctrineArrayCollection($doctrineArrayCollection);
        $collection->add('value1');
        $collection->add('value2');

        $this->assertCount(2, $doctrineArrayCollection);

        $collection->remove('value2');

        $this->assertCount(1, $doctrineArrayCollection);

        $this->assertTrue($collection->contains('value1'));
        $this->assertFalse($collection->contains('value2'));
    }
}
