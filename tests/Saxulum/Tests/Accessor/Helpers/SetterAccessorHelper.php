<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\SetterAccessor;

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
        $this->addAccessor(new SetterAccessor());
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