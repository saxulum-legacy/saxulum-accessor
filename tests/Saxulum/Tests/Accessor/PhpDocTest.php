<?php

namespace Saxulum\Tests\Accessor;

use Saxulum\Accessor\Accessors\Add;
use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Is;
use Saxulum\Accessor\Accessors\Remove;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Accessor\Prop;

class PhpDocTest extends \PHPUnit_Framework_TestCase
{
    public function testGeneration()
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
}
