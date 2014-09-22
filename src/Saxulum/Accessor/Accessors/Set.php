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
     * @param object $object
     * @param mixed  $property
     * @param Prop   $prop
     * @param mixed  $value
     * @param bool   $stopPropagation
     */
    protected function set($object, &$property, Prop $prop, $value, $stopPropagation = false)
    {
        $property = $value;
    }

    /**
     * @param  object     $object
     * @param  mixed      $property
     * @param  Prop       $prop
     * @param  mixed      $value
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function setOne($object, &$property, Prop $prop, $value, $stopPropagation = false)
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
     * @param  object     $object
     * @param  mixed      $property
     * @param  Prop       $prop
     * @param  mixed      $value
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function setMany($object, &$property, Prop $prop, $value, $stopPropagation = false)
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
