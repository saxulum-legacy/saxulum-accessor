<?php

namespace Saxulum\Tests\Accessor\Fixtures\Mapping;

use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\Prop;

/**
 * @method One2One getOne()
 * @method $this setOne(One2One $one)
 */
class One2One
{
    use AccessorTrait;

    /**
     * @var One2One
     */
    protected $one;

    protected function _initProps()
    {
        $this->_prop(
            (new Prop('one', 'Saxulum\Tests\Accessor\Fixtures\Mapping\One2One', true, 'one', Prop::REMOTE_ONE))
                ->method(Get::PREFIX)
                ->method(Set::PREFIX)
        );
    }
}
