<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\AbstractAccessor;

class IsAccessor extends AbstractAccessor
{
    /**
     * @return string
     */
    public function getPrefix()
    {
        return 'is';
    }

    /**
     * @param  object $object
     * @param  mixed  $property
     * @param  array  $arguments
     * @return mixed
     */
    public function callback($object, &$property, $arguments)
    {
        if (count($arguments) !== 0) {
            throw new \InvalidArgumentException("Getter Accessor allows no argument!");
        }

        return (bool) $property;
    }
}
