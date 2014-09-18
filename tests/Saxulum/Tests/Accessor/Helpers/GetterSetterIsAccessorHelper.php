<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\GetterAccessor;
use Saxulum\Accessor\Accessors\IsAccessor;
use Saxulum\Accessor\Accessors\SetterAccessor;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\Property;

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
        $this
            ->addProperty((new Property('name'))
                ->add(GetterAccessor::PREFIX)
                ->add(IsAccessor::PREFIX)
                ->add(SetterAccessor::PREFIX)
            )
            ->addProperty((new Property('value'))
                ->add(GetterAccessor::PREFIX)
                ->add(IsAccessor::PREFIX)
                ->add(SetterAccessor::PREFIX)
            )
        ;
    }
}
