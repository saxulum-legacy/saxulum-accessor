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
     * @param $object
     * @param $property
     * @param  array $arguments
     * @param $name
     * @param  null  $hint
     * @param  bool  $nullable
     * @return mixed
     */
    public function callback($object, &$property, array $arguments, $name, $hint = null, $nullable = false)
    {
        if (count($arguments) !== 0) {
            throw new \InvalidArgumentException("Get Accessor allows no argument!");
        }

        return $property;
    }
}
