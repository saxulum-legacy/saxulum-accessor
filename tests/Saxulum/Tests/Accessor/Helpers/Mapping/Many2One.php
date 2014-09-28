<?php

namespace Saxulum\Tests\Accessor\Helpers\Mapping;

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

    protected function initializeProperties()
    {
        $this->prop((new Prop('name', 'string'))->method(Get::PREFIX)->method(Set::PREFIX));
        $this->prop(
            (new Prop('one', 'Saxulum\Tests\Accessor\Helpers\Mapping\One2Many', true, 'manies', Prop::REMOTE_MANY))
                ->method(Get::PREFIX)
                ->method(Set::PREFIX)
        );
    }
}
