<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\GetterAccessor;
use Saxulum\Accessor\Property;

/**
 * @method string getName()
 */
class GetterAccessorHelperWithTrait
{
    use GetterAccessorTrait;

    public function __construct()
    {
        $getterAccessor = new GetterAccessor();
        $this->addAccessor($getterAccessor);
        $this->addProperty((new Property('name'))->add($getterAccessor->getPrefix()));
    }
}
