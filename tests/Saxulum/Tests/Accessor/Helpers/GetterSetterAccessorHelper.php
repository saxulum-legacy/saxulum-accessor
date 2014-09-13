<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\GetterAccessor;
use Saxulum\Accessor\SetterAccessor;

/**
 * @method $this setName(string $name)
 * @method $this getName()
 * @method $this setValue(string $value)
 * @method $this getValue()
 */
class GetterSetterAccessorHelper
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
        $this->addAccessor(new GetterAccessor());
        $this->addAccessor(new SetterAccessor());
    }
}