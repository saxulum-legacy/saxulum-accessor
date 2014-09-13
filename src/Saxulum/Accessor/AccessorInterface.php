<?php

namespace Saxulum\Accessor;

interface AccessorInterface
{
    /**
     * @return string
     */
    public function getPrefix();

    /**
     * @param  object $object
     * @param  mixed  $property
     * @param  array  $arguments
     * @return mixed
     */
    public function callback($object, &$property, $arguments);
}
