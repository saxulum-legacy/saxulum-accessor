<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\AccessorInterface;
use Saxulum\Accessor\Hint;
use Saxulum\Accessor\Prop;

abstract class AbstractWrite implements AccessorInterface
{
    /**
     * @param  object $object
     * @param  mixed  $property
     * @param  Prop   $prop
     * @param  array  $arguments
     * @return mixed
     */
    public function callback($object, &$property, Prop $prop, array $arguments = array())
    {
        if (!array_key_exists(0, $arguments) || count($arguments) !== 1) {
            throw new \InvalidArgumentException($this->getPrefix() . ' accessor allows only one argument!');
        }

        Hint::validateOrException($prop->getName(), $arguments[0], $prop->getHint(), $prop->getNullable());

        $this->propertyDefault($property);
        $this->updateProperty($property, $prop, $arguments[0]);

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
     * @param  Prop       $prop
     * @param  mixed      $value
     * @throws \Exception
     */
    protected function updateProperty(&$property, Prop $prop, $value)
    {
        $type = $this->getSubType($property);
        $method = $this->getPrefix() . ucfirst($type);

        if (!is_callable(array($this, $method))) {
            throw new \Exception("Unsupported type '{$type}' for property '{$prop->getName()}' by accessor!");
        }

        $this->$method($property, $value);
    }
}
