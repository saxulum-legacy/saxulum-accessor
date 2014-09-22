<?php

namespace Saxulum\Accessor\Accessors;

use Doctrine\Common\Collections\Collection;
use Saxulum\Accessor\Prop;

class Remove extends AbstractCollection
{
    const PREFIX = 'remove';

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
    protected function removeArray($object, array &$property, Prop $prop, $value, $stopPropagation = false)
    {
        $key = array_search($value, $property, true);

        if (false !== $key) {
            unset($property[$key]);
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
    protected function removeArrayOne($object, array &$property, Prop $prop, $value, $stopPropagation = false)
    {
        $key = array_search($value, $property, true);

        if (false !== $key) {
            $this->removeOne($object, $prop, $value, $stopPropagation);
            unset($property[$key]);
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
    protected function removeArrayMany($object, array &$property, Prop $prop, $value, $stopPropagation = false)
    {
        $key = array_search($value, $property, true);

        if (false !== $key) {
            $this->removeMany($object, $prop, $value, $stopPropagation);
            unset($property[$key]);
        }
    }

    /**
     * @param object     $object
     * @param Collection $property
     * @param Prop       $prop
     * @param mixed      $value
     * @param bool       $stopPropagation
     */
    protected function removeCollection($object, Collection &$property, Prop $prop, $value, $stopPropagation = false)
    {
        if ($property->contains($value)) {
            $property->removeElement($value);
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
    protected function removeCollectionOne($object, Collection &$property, Prop $prop, $value, $stopPropagation = false)
    {
        if ($property->contains($value)) {
            $this->removeOne($object, $prop, $value, $stopPropagation);
            $property->removeElement($value);
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
    protected function removeCollectionMany($object, Collection &$property, Prop $prop, $value, $stopPropagation = false)
    {
        if ($property->contains($value)) {
            $this->removeMany($object, $prop, $value, $stopPropagation);
            $property->removeElement($value);
        }
    }

    /**
     * @param  mixed      $object
     * @param  Prop       $prop
     * @param  mixed      $value
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function removeOne($object, Prop $prop, $value, $stopPropagation = false)
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
    protected function removeMany($object, Prop $prop, $value, $stopPropagation = false)
    {
        if (null === $remoteName = $prop->getRemoteName()) {
            throw new \Exception("Remote name needs to be set on '{$prop->getName()}', if remote type is given!");
        }

        if (!$stopPropagation) {
            $removeMethod = Remove::PREFIX . ucfirst($remoteName);
            $value->$removeMethod($object, true);
        }
    }
}
