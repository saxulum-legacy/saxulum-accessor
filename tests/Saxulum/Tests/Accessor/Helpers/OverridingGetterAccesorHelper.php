<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\GetterAccessor;
use Saxulum\Accessor\AccessorTrait;

class OverridingGetterAccesorHelper
{
    use AccessorTrait;

    public function __construct()
    {
        $this->addAccessor(new GetterAccessor());
        $this->addAccessor(new GetterAccessor());
    }
}
