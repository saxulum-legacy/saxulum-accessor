<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\AccessorTrait;

class OverridingGetHelper
{
    use AccessorTrait;

    public function __construct()
    {
        AccessorTrait::registerAccessor(new Get());
    }
}
