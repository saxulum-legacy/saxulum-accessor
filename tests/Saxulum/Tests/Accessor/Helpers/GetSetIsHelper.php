<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Is;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\Hint;
use Saxulum\Accessor\Prop;

/**
 * @method $this setName(string $name)
 * @method string getName()
 * @method boolean isName()
 * @method $this setValue(string $value)
 * @method string getValue()
 * @method boolean isValue()
 */
class GetSetIsHelper
{
    use AccessorTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $value;

    protected function initializeProperties()
    {
        $this
            ->prop((new Prop('name', Hint::HINT_STR, true))->method(Get::PREFIX)->method(Set::PREFIX)->method(Is::PREFIX))
            ->prop((new Prop('value'))->method(Get::PREFIX)->method(Set::PREFIX)->method(Is::PREFIX))
        ;
    }
}
