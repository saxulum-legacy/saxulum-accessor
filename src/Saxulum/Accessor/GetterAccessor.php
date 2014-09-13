<?php

namespace Saxulum\Accessor;

class GetterAccessor implements AccessorInterface
{
    /**
     * @return string
     */
    public function getPrefix()
    {
        return 'get';
    }

    /**
     * @return callable($object, &$property, $arguments)
     */
    public function callback()
    {
        return function($object, &$property, $arguments) {
            if(count($arguments) !== 0) {
                throw new \InvalidArgumentException("Getter Accessor allows no argument!");
            }

            return $property;
        };
    }
}