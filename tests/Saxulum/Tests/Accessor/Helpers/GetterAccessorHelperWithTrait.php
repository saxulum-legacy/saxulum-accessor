<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\GetterAccessor;

class GetterAccessorHelperWithTrait
{
    use GetterAccessorTrait;

    public function __construct()
    {
        $this->addAccessor(new GetterAccessor());
    }
}
