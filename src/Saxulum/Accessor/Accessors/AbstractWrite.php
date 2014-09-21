<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\AccessorInterface;
use Saxulum\Accessor\Hint;

abstract class AbstractWrite implements AccessorInterface
{
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
            throw new \InvalidArgumentException($this->getPrefix() . ' accessor allows only one argument!');
        }

        Hint::validateOrException($name, $property, $hint, $nullable);

        $this->propertyDefault($property);
        $this->updateProperty($property, $name, $arguments[0]);

        return $object;
    }

    /**
     * @param mixed $property
     */
    abstract protected function propertyDefault(&$property);

    /**
     * @param  mixed  $property
     * @return string
     * @throw \Exception
     */
    abstract protected function getSubType(&$property);

    /**
     * @param  mixed      $property
     * @param  string     $name
     * @param  mixed      $value
     * @throws \Exception
     */
    protected function updateProperty(&$property, $name, $value)
    {
        $type = $this->getSubType($property);
        $method = $this->getPrefix() . ucfirst($type);

        if (!is_callable(array($this, $method))) {
            throw new \Exception("Unsupported type '{$type}' for property '{$name}' by accessor!");
        }

        $this->$method($property, $value);
    }
}
