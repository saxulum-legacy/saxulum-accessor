<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\AccessorInterface;
use Saxulum\Accessor\Hint;

class Set implements AccessorInterface
{
    const PREFIX = 'set';

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
        if (!array_key_exists(0, $arguments) || count($arguments) !== 1) {
            throw new \InvalidArgumentException("Set Accessor allows only one argument!");
        }

        Hint::validateOrException($name, $property, $hint, $nullable);

        $property = $arguments[0];

        return $object;
    }
}
