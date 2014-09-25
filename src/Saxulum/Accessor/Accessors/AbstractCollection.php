<?php

namespace Saxulum\Accessor\Accessors;

use Doctrine\Common\Collections\Collection;
use Saxulum\Accessor\Collection\ArrayCollection;
use Saxulum\Accessor\Collection\CollectionInterface;
use Saxulum\Accessor\Collection\DoctrineArrayCollection;
use Saxulum\Accessor\Prop;

abstract class AbstractCollection extends AbstractWrite
{
    /**
     * @param $property
     */
    protected function propertyDefault(&$property)
    {
        if (null === $property) {
            $property = array();
        }
    }

    /**
     * @param  mixed               $property
     * @return CollectionInterface
     * @throw \Exception
     */
    protected static function getCollection(&$property)
    {
        if (is_array($property)) {
            return new ArrayCollection($property);
        }

        if (interface_exists('Doctrine\Common\Collections\Collection') && $property instanceof Collection) {
            return new DoctrineArrayCollection($property);
        }

        throw new \InvalidArgumentException("Property must be an array or a collection!");
    }

    /**
     * @param  object     $value
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @param  object     $object
     * @throws \Exception
     */
    protected static function handleMappedBy($value, Prop $prop, $stopPropagation, $object)
    {
        if (null === $mappedBy = $prop->getMappedBy()) {
            throw new \Exception("Remote name needs to be set on '{$prop->getName()}', if remote type is given!");
        }

        if (!$stopPropagation) {
            $method = static::getPrefixByProp($prop) . ucfirst($mappedBy);
            $value->$method($object, true);
        }
    }
}
