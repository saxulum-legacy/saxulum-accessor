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

        $index = array_search('value2', $array, true);
        unset($array[$index]);

        $this->assertCount(1, $array);

        $this->assertTrue(in_array('value1', $array, true));
        $this->assertFalse(in_array('value2', $array, true));
    }

    public function testDoctrineArrayColletion()
    {
        $doctrineArrayCollection = new DoctrineOrigArrayColletion();

        $collection = new DoctrineArrayCollection($doctrineArrayCollection);
        $collection->add('value1');
        $collection->add('value2');

        $this->assertCount(2, $doctrineArrayCollection);

        $doctrineArrayCollection->removeElement('value2');

        $this->assertCount(1, $doctrineArrayCollection);

        $this->assertTrue($doctrineArrayCollection->contains('value1'));
        $this->assertFalse($doctrineArrayCollection->contains('value2'));
    }
}
