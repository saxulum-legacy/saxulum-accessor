<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\SetterAccessor;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\PropertyConfiguration;

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
            ->addPropertyConfiguration((new PropertyConfiguration('name'))->addAccessorPrefix($setterAccessor->getPrefix()))
            ->addPropertyConfiguration((new PropertyConfiguration('value'))->addAccessorPrefix($setterAccessor->getPrefix()))
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
