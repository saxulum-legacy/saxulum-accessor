<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\GetterAccessor;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\PropertyConfiguration;

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
            ->addPropertyConfiguration((new PropertyConfiguration('name'))->addAccessorPrefix($getterAccessor->getPrefix()))
            ->addPropertyConfiguration((new PropertyConfiguration('value'))->addAccessorPrefix($getterAccessor->getPrefix()))
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
