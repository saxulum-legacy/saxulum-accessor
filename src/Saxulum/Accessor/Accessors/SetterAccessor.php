<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\AccessorInterface;

class SetterAccessor implements AccessorInterface
{
    /**
     * @return string
     */
    public function getPrefix()
    {
        return 'set';
    }

    /**
     * @param object $object
     * @param mixed $property
     * @param array $arguments
     * @return mixed
     */
    public function callback($object, &$property, $arguments)
    {
        if(!isset($arguments[0]) || count($arguments) !== 1) {
            throw new \InvalidArgumentException("Setter Accessor allows only one argument!");
        }

        $property = $arguments[0];

        return $object;
    }
}