<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\AccessorInterface;
use Saxulum\Accessor\Prop;

abstract class AbstractRead implements AccessorInterface
{
    /**
     * @param  object $object
     * @param  mixed  $property
     * @param  Prop   $prop
     * @param  array  $arguments
     * @return mixed
     */
    public function callback($object, &$property, Prop $prop, array $arguments = array())
    {
        if (count($arguments) !== 0) {
            throw new \InvalidArgumentException($this->getPrefix() . ' accessor allows no argumen!');
        }

        return $property;
    }
}
