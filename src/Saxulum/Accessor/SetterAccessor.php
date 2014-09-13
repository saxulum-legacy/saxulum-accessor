<?php

namespace Saxulum\Accessor;

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
     * @return callable($object, &$property, $arguments)
     */
    public function callback()
    {
        return function($object, &$property, $arguments) {
            if(!isset($arguments[0]) || count($arguments) !== 1) {
                throw new \InvalidArgumentException("Setter Accessor allows only one argument!");
            }

            $property = $arguments[0];

            return $object;
        };
    }
}