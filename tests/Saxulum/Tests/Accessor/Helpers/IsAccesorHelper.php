<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\IsAccessor;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\PropertyConfiguration;

/**
 * @method bool isName()
 * @method bool isValue()
 */
class IsAccesorHelper
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
        $isAccessor = new IsAccessor();
        $this->addAccessor($isAccessor);
        $this
            ->addPropertyConfiguration((new PropertyConfiguration('name'))->addAccessorPrefix($isAccessor->getPrefix()))
            ->addPropertyConfiguration((new PropertyConfiguration('value'))->addAccessorPrefix($isAccessor->getPrefix()))
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
