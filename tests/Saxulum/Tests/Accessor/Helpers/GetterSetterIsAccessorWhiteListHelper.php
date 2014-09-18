<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\GetterAccessor;
use Saxulum\Accessor\Accessors\IsAccessor;
use Saxulum\Accessor\Accessors\SetterAccessor;
use Saxulum\Accessor\AccessorTrait;

/**
 * @method $this setName(string $name)
 * @method string getName()
 * @method boolean isName()
 */
class GetterSetterIsAccessorWhiteListHelper
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

    public function __construct()
    {
        $this
            ->addAccessor((new GetterAccessor())->addProperty('name'))
            ->addAccessor((new IsAccessor())->addProperty('name'))
            ->addAccessor((new SetterAccessor())->addProperty('name'))
        ;
    }
}
