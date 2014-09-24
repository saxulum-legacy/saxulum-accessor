<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\Prop;

class Set extends AbstractWrite
{
    const PREFIX = 'set';

    /**
     * @return string
     */
    public function getPrefix()
    {
        return self::PREFIX;
    }

    /**
     * @param  mixed  $property
     * @return string
     * @throw \Exception
     */
    protected function getSubType(&$property)
    {
        return '';
    }

    /**
     * @param mixed $property
     */
    protected function propertyDefault(&$property) {}

    /**
     * @param mixed $property
     * @param mixed $value
     */
    protected function set(&$property, $value)
    {
        $property = $value;
    }

    /**
     * @param  mixed      $property
     * @param  object     $value
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @param  object     $object
     * @throws \Exception
     */
    protected function setOne(&$property, $value, Prop $prop, $stopPropagation = false, $object = null)
    {
        if (null === $remoteName = $prop->getRemoteName()) {
            throw new \Exception("Remote name needs to be set on '{$prop->getName()}', if remote type is given!");
        }

        $setMethod = Set::PREFIX . ucfirst($remoteName);

        if (!$stopPropagation) {
            if (!is_null($property)) {
                $property->$setMethod(null, true);
            }
            if (!is_null($value)) {
                $value->$setMethod($object, true);
            }
        }

        $property = $value;
    }

    /**
     * @param  mixed      $property
     * @param  object     $value
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @param  object     $object
     * @throws \Exception
     */
    protected function setMany(&$property, $value, Prop $prop, $stopPropagation = false, $object = null)
    {
        if (null === $remoteName = $prop->getRemoteName()) {
            throw new \Exception("Remote name needs to be set on '{$prop->getName()}', if remote type is given!");
        }

        if (!$stopPropagation) {
            if (!is_null($property)) {
                $removeMethod = Remove::PREFIX . ucfirst($remoteName);
                $property->$removeMethod($object, true);
            }
            if (!is_null($value)) {
                $addMethod = Add::PREFIX . ucfirst($remoteName);
                $value->$addMethod($object, true);
            }
        }

        $property = $value;
    }
}
