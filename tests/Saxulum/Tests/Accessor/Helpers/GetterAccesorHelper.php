<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\GetterAccessor;

/**
 * @method $this getName()
 * @method $this getValue()
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
        $this->addAccessor(new GetterAccessor());
    }

    /**
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this;
    }
}