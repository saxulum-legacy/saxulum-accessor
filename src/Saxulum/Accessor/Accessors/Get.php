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
     * @param  string      $name
     * @param  array       $arguments
     * @param  string|null $hint
     * @param  bool        $nullable
     * @return mixed
     */
    public function callback($object, &$property, $name, array $arguments = array(), $hint = null, $nullable = false)
    {
        if (count($arguments) !== 0) {
            throw new \InvalidArgumentException("Get Accessor allows no argument!");
        }

        return $property;
    }
}
