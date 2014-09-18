<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\GetterAccessor;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\Property;

/**
 * @method string getValue()
 */
class GetterAccessorOverrideHelper
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
        $this->addAccessor($getterAccessor);
        $this
            ->addProperty((new Property('name'))->add($getterAccessor->getPrefix()))
            ->addProperty((new Property('value'))->add($getterAccessor->getPrefix()))
        ;
    }

    /**
     * @param  string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param  string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name . '_override';
    }
}
