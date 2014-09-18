<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\AbstractAccessor;

class Set extends AbstractAccessor
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
     * @param  array       $arguments
     * @param  string      $name
     * @param  string|null $hint
     * @return mixed
     */
    public function callback($object, &$property, array $arguments, $name, $hint)
    {
        if (!isset($arguments[0]) || count($arguments) !== 1) {
            throw new \InvalidArgumentException("Set Accessor allows only one argument!");
        }

        if (!$this->hint($arguments[0], $hint)) {
            $type = gettype($arguments[0]);
            throw new \InvalidArgumentException("Invalid type '{$type}' for hint '{$hint}' on property '{$name}'!");
        }

        $property = $arguments[0];

        return $object;
    }
}
