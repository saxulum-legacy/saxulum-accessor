<?php

namespace Saxulum\Tests\Accessor\Fixtures\Mapping;

use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\Prop;

/**
 * @method string getName()
 *
 * @method One2Many getOne()
 * @method $this setOne(One2Many $one2Many, bool $stopPropagation = false)
 */
class Many2One
{
    use AccessorTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var One2Many
     */
    protected $one;

    protected function _initProps()
    {
        $this->_prop((new Prop('name', 'string'))->method(Get::PREFIX)->method(Set::PREFIX));
        $this->_prop(
            (new Prop('one', 'Saxulum\Tests\Accessor\Fixtures\Mapping\One2Many', true, 'manies', Prop::REMOTE_MANY))
                ->method(Get::PREFIX)
                ->method(Set::PREFIX)
        );
    }
}
