<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\SetterAccessor;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\Property;

/**
 * @method $this setName(string $name)
 * @method $this setValue(string $value)
 */
class SetterAccessorHelper
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
        $setterAccessor = new SetterAccessor();
        $this->addAccessor($setterAccessor);
        $this
            ->addProperty((new Property('name'))->add($setterAccessor->getPrefix()))
            ->addProperty((new Property('value'))->add($setterAccessor->getPrefix()))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}
