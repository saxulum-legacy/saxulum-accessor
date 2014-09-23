<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Tests\Accessor\Helpers\Many2Many;
use Saxulum\Tests\Accessor\Helpers\Many2One;
use Saxulum\Tests\Accessor\Helpers\One2Many;
use Saxulum\Tests\Accessor\Helpers\One2One;

class RemoteAccessorTest extends \PHPUnit_Framework_TestCase
{
    public function testOne2One()
    {
        $one1 = new One2One();
        $one2 = new One2One();

        $one1->setOne($one2);

        $this->assertInstanceOf('Saxulum\Tests\Accessor\Helpers\One2One', $one1->getOne());
        $this->assertInstanceOf('Saxulum\Tests\Accessor\Helpers\One2One', $one2->getOne());

        $one2->setOne(null);

        $this->assertEquals(null, $one1->getOne());
        $this->assertEquals(null, $one2->getOne());
    }

    public function testOne2ManyMany2One()
    {
        $one = new One2Many();
        $many = new Many2One();

        $one->addManies($many);

        $this->assertInstanceOf('Saxulum\Tests\Accessor\Helpers\Many2One', $one->getManies()[0]);
        $this->assertInstanceOf('Saxulum\Tests\Accessor\Helpers\One2Many', $many->getOne());

        $many->setOne(null);

        $this->assertCount(0, $one->getManies());
        $this->assertEquals(null, $many->getOne());
    }

    public function testMany2OneOne2Many()
    {
        $one = new One2Many();
        $many = new Many2One();

        $many->setOne($one);

        $this->assertInstanceOf('Saxulum\Tests\Accessor\Helpers\Many2One', $one->getManies()[0]);
        $this->assertInstanceOf('Saxulum\Tests\Accessor\Helpers\One2Many', $many->getOne());

        $one->removeManies($many);

        $this->assertCount(0, $one->getManies());
        $this->assertEquals(null, $many->getOne());
    }

    public function testMany2Many()
    {
        $many1 = new Many2Many();
        $many2 = new Many2Many();

        $many1->addManies($many2);

        $this->assertInstanceOf('Saxulum\Tests\Accessor\Helpers\Many2Many', $many1->getManies()[0]);
        $this->assertInstanceOf('Saxulum\Tests\Accessor\Helpers\Many2Many', $many2->getManies()[0]);

        $many2->removeManies($many1);

        $this->assertCount(0, $many1->getManies());
        $this->assertCount(0, $many2->getManies());
    }
}
