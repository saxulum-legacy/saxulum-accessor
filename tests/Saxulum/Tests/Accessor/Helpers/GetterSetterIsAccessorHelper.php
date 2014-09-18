<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\GetterAccessor;
use Saxulum\Accessor\Accessors\IsAccessor;
use Saxulum\Accessor\Accessors\SetterAccessor;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\PropertyConfiguration;

/**
 * @method $this setName(string $name)
 * @method string getName()
 * @method boolean isName()
 * @method $this setValue(string $value)
 * @method string getValue()
 * @method boolean isValue()
 */
class GetterSetterIsAccessorHelper
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
        $getterAccessor = new GetterAccessor();
        $isAccessor = new IsAccessor();
        $setterAccessor = new SetterAccessor();

        $this
            ->addAccessor($getterAccessor)
            ->addAccessor($isAccessor)
            ->addAccessor($setterAccessor)
        ;

        $this
            ->addPropertyConfiguration((new PropertyConfiguration('name'))
                ->addAccessorPrefix($getterAccessor->getPrefix())
                ->addAccessorPrefix($isAccessor->getPrefix())
                ->addAccessorPrefix($setterAccessor->getPrefix())
            )
            ->addPropertyConfiguration((new PropertyConfiguration('value'))
                ->addAccessorPrefix($getterAccessor->getPrefix())
                ->addAccessorPrefix($isAccessor->getPrefix())
                ->addAccessorPrefix($setterAccessor->getPrefix())
            )
        ;
    }
}
