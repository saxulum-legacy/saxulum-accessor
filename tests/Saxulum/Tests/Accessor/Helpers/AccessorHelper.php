<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\Prop;

class AccessorHelper
{
    use AccessorTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var mixed
     */
    protected $value;

    protected function initializeProperties()
    {
        $this->prop((new Prop('name'))->method(Get::PREFIX)->method(Set::PREFIX));
        $this->prop((new Prop('value'))->method(Get::PREFIX)->method(Set::PREFIX));
    }
}
