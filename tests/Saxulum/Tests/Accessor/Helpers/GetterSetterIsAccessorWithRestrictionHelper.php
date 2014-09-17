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
class GetterSetterIsAccessorWithRestrictionHelper
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
            ->addAccessor((new GetterAccessor())->setProperties(array('name')))
            ->addAccessor((new IsAccessor())->setProperties(array('name')))
            ->addAccessor((new SetterAccessor())->setProperties(array('name')))
        ;
    }
}
