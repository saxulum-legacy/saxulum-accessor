<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Prop;

/**
 * @method string getName()
 */
class GetHelperWithTrait
{
    use GetTrait;

    public function __construct()
    {
        $this->prop((new Prop('name'))->method(Get::PREFIX));
    }
}
