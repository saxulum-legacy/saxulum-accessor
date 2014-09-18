<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Saxulum\Accessor\AccessorTrait;

trait GetterAccessorTrait
{
    use AccessorTrait;

    /**
     * @var string
     */
    protected $name;

    /**
     * @param  string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }
}
