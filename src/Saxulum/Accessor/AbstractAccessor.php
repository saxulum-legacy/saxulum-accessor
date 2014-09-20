<?php

namespace Saxulum\Accessor;

abstract class AbstractAccessor
{
    /**
     * @var array|null
     */
    protected $properties;

    /**
     * @param  string $property
     * @return $this
     */
    public function prop($property)
    {
        if (!is_string($property)) {
            throw new \InvalidArgumentException("Property must be a string!");
        }

        if (null === $this->properties) {
            $this->properties = array();
        }

        $this->properties[] = $property;

        return $this;
    }

    /**
     * @return string
     */
    abstract public function getPrefix();

    /**
     * @param  object      $object
     * @param  mixed       $property
     * @param  string      $name
     * @param  array       $arguments
     * @param  string|null $hint
     * @param  bool        $nullable
     * @return mixed
     */
    abstract public function callback($object, &$property, $name, array $arguments = array(), $hint = null, $nullable = false);
}
