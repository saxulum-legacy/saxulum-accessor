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
     * @param array $property
     * @param mixed $value
     */
    protected function addArray(array &$property, $value)
    {
        if (!in_array($value, $property, true)) {
            $property[] = $value;
        }
    }

    /**
     * @param  array      $property
     * @param  object     $value
     * @param  object     $object
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function addArrayOne(array &$property, $value, $object, Prop $prop, $stopPropagation = false)
    {
        if (!in_array($value, $property, true)) {
            $this->addOne($value, $object, $prop, $stopPropagation);
            $property[] = $value;
        }
    }

    /**
     * @param  array      $property
     * @param  object     $value
     * @param  object     $object
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function addArrayMany(array &$property, $value, $object, Prop $prop, $stopPropagation = false)
    {
        if (!in_array($value, $property, true)) {
            $this->addMany($value, $object, $prop, $stopPropagation);
            $property[] = $value;
        }
    }

    /**
     * @param Collection $property
     * @param mixed      $value
     */
    protected function addCollection(Collection &$property, $value)
    {
        if (!$property->contains($value)) {
            $property->add($value);
        }
    }

    /**
     * @param  Collection $property
     * @param  object     $value
     * @param  object     $object
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function addCollectionOne(Collection &$property, $value, $object, Prop $prop, $stopPropagation = false)
    {
        if (!$property->contains($value)) {
            $this->addOne($value, $object, $prop, $stopPropagation);
            $property->add($value);
        }
    }

    /**
     * @param  Collection $property
     * @param  object     $value
     * @param  object     $object
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function addCollectionMany(Collection &$property, $value, $object, Prop $prop, $stopPropagation = false)
    {
        if (!$property->contains($value)) {
            $this->addMany($value, $object, $prop, $stopPropagation);
            $property->add($value);
        }
    }

    /**
     * @param  object     $value
     * @param  object     $object
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function addOne($value, $object, Prop $prop, $stopPropagation = false)
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
     * @param  object     $value
     * @param  object     $object
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function addMany($value, $object, Prop $prop, $stopPropagation = false)
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
