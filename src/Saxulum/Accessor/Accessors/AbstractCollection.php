<?php

namespace Saxulum\Accessor\Accessors;

use Doctrine\Common\Collections\Collection;
use Saxulum\Accessor\AccessorInterface;

abstract class AbstractCollection implements AccessorInterface
{
    const TYPE_ARRAY = 'array';
    const TYPE_COLLECTION = 'collection';

    /**
     * @param  mixed  $property
     * @return string
     */
    protected function getPropertyType(&$property)
    {
        if (null === $property) {
            $property = array();
        }

        if (is_array($property)) {
            return self::TYPE_ARRAY;
        }

        if (interface_exists('Doctrine\Common\Collections\Collection') && $property instanceof Collection) {
            return self::TYPE_COLLECTION;
        }

        throw new \InvalidArgumentException("Property must be an array or a collection!");
    }

    /**
     * @param  mixed      $property
     * @param  string     $name
     * @param  mixed      $value
     * @param  string     $methodPrefix
     * @throws \Exception
     */
    protected function updateProperty(&$property, $name, $value, $methodPrefix)
    {
        $type = $this->getPropertyType($property);
        $method = $methodPrefix . ucfirst($type);

        if (!is_callable(array($this, $method))) {
            throw new \Exception("Unsupported type '{$type}' for property '{$name}' by accessor!");
        }

        $this->$method($property, $value);
    }
}
