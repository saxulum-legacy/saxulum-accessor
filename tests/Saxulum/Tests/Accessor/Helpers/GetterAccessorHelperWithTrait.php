<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\GetterAccessor;
use Saxulum\Accessor\PropertyConfiguration;

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
        $this->addPropertyConfiguration((new PropertyConfiguration('name'))->addAccessorPrefix($getterAccessor->getPrefix()));
    }
}
