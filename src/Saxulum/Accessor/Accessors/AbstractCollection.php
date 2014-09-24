<?php

namespace Saxulum\Accessor\Accessors;

use Doctrine\Common\Collections\Collection;
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
     * @param  mixed  $property
     * @return string
     * @throw \Exception
     */
    protected function getSubType(&$property)
    {
        if (is_array($property)) {
            return 'array';
        }

        if (interface_exists('Doctrine\Common\Collections\Collection') && $property instanceof Collection) {
            return 'collection';
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
    protected function handleRemote($value, Prop $prop, $stopPropagation, $object)
    {
        if (null === $remoteName = $prop->getRemoteName()) {
            throw new \Exception("Remote name needs to be set on '{$prop->getName()}', if remote type is given!");
        }

        if (!$stopPropagation) {
            $method = self::getPrefixByProp($prop) . ucfirst($remoteName);
            $value->$method($object, true);
        }
    }
}
