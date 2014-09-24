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
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @param  object     $object
     * @throws \Exception
     */
    protected function addArrayOne(array &$property, $value, Prop $prop, $stopPropagation = false, $object = null)
    {
        if (!in_array($value, $property, true)) {
            $this->handleRemote($value, $object, $prop, Set::PREFIX, $stopPropagation);
            $property[] = $value;
        }
    }

    /**
     * @param  array      $property
     * @param  object     $value
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @param  object     $object
     * @throws \Exception
     */
    protected function addArrayMany(array &$property, $value, Prop $prop, $stopPropagation = false, $object = null)
    {
        if (!in_array($value, $property, true)) {
            $this->handleRemote($value, $object, $prop, Add::PREFIX, $stopPropagation);
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
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @param  object     $object
     * @throws \Exception
     */
    protected function addCollectionOne(Collection &$property, $value, Prop $prop, $stopPropagation = false, $object = null)
    {
        if (!$property->contains($value)) {
            $this->handleRemote($value, $object, $prop, Set::PREFIX, $stopPropagation);
            $property->add($value);
        }
    }

    /**
     * @param  Collection $property
     * @param  object     $value
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @param  object     $object
     * @throws \Exception
     */
    protected function addCollectionMany(Collection &$property, $value, Prop $prop, $stopPropagation = false, $object = null)
    {
        if (!$property->contains($value)) {
            $this->handleRemote($value, $object, $prop, Add::PREFIX, $stopPropagation);
            $property->add($value);
        }
    }
}
