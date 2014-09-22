<?php

namespace Saxulum\Accessor\Accessors;

use Doctrine\Common\Collections\Collection;
use Saxulum\Accessor\Prop;

class Add extends AbstractCollection
{
    const PREFIX = 'add';

    /**
     * @return string
     */
    public function getPrefix()
    {
        return self::PREFIX;
    }

    /**
     * @param object $object
     * @param array  $property
     * @param Prop   $prop
     * @param mixed  $value
     * @param bool   $stopPropagation
     */
    protected function addArray($object, array &$property, Prop $prop, $value, $stopPropagation = false)
    {
        if (!in_array($value, $property, true)) {
            $property[] = $value;
        }
    }

    /**
     * @param  object     $object
     * @param  array      $property
     * @param  Prop       $prop
     * @param  mixed      $value
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function addArrayOne($object, array &$property, Prop $prop, $value, $stopPropagation = false)
    {
        if (!in_array($value, $property, true)) {
            $this->addOne($object, $prop, $value, $stopPropagation);
            $property[] = $value;
        }
    }

    /**
     * @param  object     $object
     * @param  array      $property
     * @param  Prop       $prop
     * @param  mixed      $value
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function addArrayMany($object, array &$property, Prop $prop, $value, $stopPropagation = false)
    {
        if (!in_array($value, $property, true)) {
            $this->addMany($object, $prop, $value, $stopPropagation);
            $property[] = $value;
        }
    }

    /**
     * @param object     $object
     * @param Collection $property
     * @param Prop       $prop
     * @param mixed      $value
     * @param bool       $stopPropagation
     */
    protected function addCollection($object, Collection &$property, Prop $prop, $value, $stopPropagation = false)
    {
        if (!$property->contains($value)) {
            $property->add($value);
        }
    }

    /**
     * @param  object     $object
     * @param  Collection $property
     * @param  Prop       $prop
     * @param  mixed      $value
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function addCollectionOne($object, Collection &$property, Prop $prop, $value, $stopPropagation = false)
    {
        if (!$property->contains($value)) {
            $this->addOne($object, $prop, $value, $stopPropagation);
            $property->add($value);
        }
    }

    /**
     * @param  object     $object
     * @param  Collection $property
     * @param  Prop       $prop
     * @param  mixed      $value
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function addCollectionMany($object, Collection &$property, Prop $prop, $value, $stopPropagation = false)
    {
        if (!$property->contains($value)) {
            $this->addMany($object, $prop, $value, $stopPropagation);
            $property->add($value);
        }
    }

    /**
     * @param  mixed      $object
     * @param  Prop       $prop
     * @param  mixed      $value
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function addOne($object, Prop $prop, $value, $stopPropagation = false)
    {
        if (null === $remoteName = $prop->getRemoteName()) {
            throw new \Exception("Remote name needs to be set on '{$prop->getName()}', if remote type is given!");
        }

        if (!$stopPropagation) {
            $setMethod = Set::PREFIX . ucfirst($remoteName);
            $value->$setMethod($object, true);
        }
    }

    /**
     * @param  mixed      $object
     * @param  Prop       $prop
     * @param  mixed      $value
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function addMany($object, Prop $prop, $value, $stopPropagation = false)
    {
        if (null === $remoteName = $prop->getRemoteName()) {
            throw new \Exception("Remote name needs to be set on '{$prop->getName()}', if remote type is given!");
        }

        if (!$stopPropagation) {
            $addMethod = Add::PREFIX . ucfirst($remoteName);
            $value->$addMethod($object, true);
        }
    }
}
