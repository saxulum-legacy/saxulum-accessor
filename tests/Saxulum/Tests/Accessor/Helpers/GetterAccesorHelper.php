<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\GetterAccessor;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\Property;

/**
 * @method string getName()
 * @method string getValue()
 */
class GetterAccesorHelper
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
            ->addProperty((new Property('name'))->add(GetterAccessor::PREFIX))
            ->addProperty((new Property('value'))->add(GetterAccessor::PREFIX))
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
}
