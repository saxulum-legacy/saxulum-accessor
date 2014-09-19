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
     * @param $object
     * @param $property
     * @param  array $arguments
     * @param $name
     * @param  null  $hint
     * @param  bool  $nullable
     * @return mixed
     */
    abstract public function callback($object, &$property, array $arguments, $name, $hint = null, $nullable = false);
}
