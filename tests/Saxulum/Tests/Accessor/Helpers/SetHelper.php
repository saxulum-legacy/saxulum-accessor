<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\Accessors\Set;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\Prop;

/**
 * @method $this setName(string $name)
 * @method $this setValue(string $value)
 */
class SetHelper
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

    protected function initializeProperties()
    {
        $this
            ->prop((new Prop('name'))->method(Set::PREFIX))
            ->prop((new Prop('value'))->method(Set::PREFIX))
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
