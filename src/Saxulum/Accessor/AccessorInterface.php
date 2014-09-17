<?php

namespace Saxulum\Accessor;

interface AccessorInterface
{
    /**
     * @return string
     */
    public function getPrefix();

    /**
     * @param  array|null $properties
     * @return static
     */
    public function setProperties(array $properties = null);

    /**
     * @return array|null
     */
    public function getProperties();

    /**
     * @param  object $object
     * @param  mixed  $property
     * @param  array  $arguments
     * @return mixed
     */
    public function callback($object, &$property, $arguments);
}
