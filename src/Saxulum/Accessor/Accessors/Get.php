<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\AbstractAccessor;

class Get extends AbstractAccessor
{
    const PREFIX = 'get';

    /**
     * @return string
     */
    public function getPrefix()
    {
        return self::PREFIX;
    }

    /**
     * @param  object      $object
     * @param  mixed       $property
     * @param  array       $arguments
     * @param  string      $name
     * @param  string|null $hint
     * @return mixed
     */
    public function callback($object, &$property, array $arguments, $name, $hint)
    {
        if (count($arguments) !== 0) {
            throw new \InvalidArgumentException("Get Accessor allows no argument!");
        }

        return $property;
    }
}
