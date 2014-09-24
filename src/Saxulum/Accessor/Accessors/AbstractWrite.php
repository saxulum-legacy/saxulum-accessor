<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\AccessorInterface;
use Saxulum\Accessor\Hint;
use Saxulum\Accessor\Prop;

abstract class AbstractWrite implements AccessorInterface
{
    /**
     * @var array
     */
    protected static $remoteToPrefixMapping = array();

    /**
     * @param  object $object
     * @param  mixed  $property
     * @param  Prop   $prop
     * @param  array  $arguments
     * @return mixed
     */
    public function callback($object, &$property, Prop $prop, array $arguments = array())
    {
        if (!array_key_exists(0, $arguments)) {
            throw new \InvalidArgumentException($this->getPrefix() . ' accessor needs at least a value!');
        }

        $value = $arguments[0];
        $stopPropagation = isset($arguments[1]) ? $arguments[1] : false;

        Hint::validateOrException($prop->getName(), $value, $prop->getHint(), $prop->getNullable());

        $this->propertyDefault($property);
        $this->updateProperty($property, $value, $prop, $stopPropagation, $object);

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
     * @param  object     $object
     * @param  mixed      $property
     * @param  Prop       $prop
     * @param  mixed      $value
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function updateProperty(&$property, $value, Prop $prop, $stopPropagation, $object)
    {
        $type = $this->getSubType($property);
        $method = $this->getPrefix() . ucfirst($type);

        if (!is_callable(array($this, $method))) {
            throw new \Exception("Unsupported type '{$type}' for property '{$prop->getName()}' by accessor!");
        }

        $this->$method($property, $value, $prop, $stopPropagation, $object);
    }

    /**
     * @param  Prop        $prop
     * @return string|null
     */
    protected static function getPrefixByProp(Prop $prop)
    {
        if (null !== $remoteType = $prop->getRemoteType()) {
            if (isset(static::$remoteToPrefixMapping[$prop->getRemoteType()])) {
                return static::$remoteToPrefixMapping[$prop->getRemoteType()];
            }
        }

        return null;
    }
}
