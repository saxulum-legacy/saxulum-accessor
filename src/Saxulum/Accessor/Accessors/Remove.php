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
     * @param array $property
     * @param mixed $value
     */
    protected function removeArray(array &$property, $value)
    {
        $key = array_search($value, $property, true);

        if (false !== $key) {
            unset($property[$key]);
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
    protected function removeArrayOne(array &$property, $value, $object, Prop $prop, $stopPropagation = false)
    {
        $key = array_search($value, $property, true);

        if (false !== $key) {
            $this->removeOne($value, $prop, $stopPropagation);
            unset($property[$key]);
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
    protected function removeArrayMany(array &$property, $value, $object, Prop $prop, $stopPropagation = false)
    {
        $key = array_search($value, $property, true);

        if (false !== $key) {
            $this->removeMany($value, $object, $prop, $stopPropagation);
            unset($property[$key]);
        }
    }

    /**
     * @param Collection $property
     * @param mixed      $value
     */
    protected function removeCollection(Collection &$property, $value)
    {
        if ($property->contains($value)) {
            $property->removeElement($value);
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
    protected function removeCollectionOne(Collection &$property, $value, $object, Prop $prop, $stopPropagation = false)
    {
        if ($property->contains($value)) {
            $this->removeOne($value, $prop, $stopPropagation);
            $property->removeElement($value);
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
    protected function removeCollectionMany(Collection &$property, $value, $object, Prop $prop, $stopPropagation = false)
    {
        if ($property->contains($value)) {
            $this->removeMany($value, $object, $prop, $stopPropagation);
            $property->removeElement($value);
        }
    }

    /**
     * @param  object     $value
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function removeOne($value, Prop $prop, $stopPropagation = false)
    {
        if (null === $remoteName = $prop->getRemoteName()) {
            throw new \Exception("Remote name needs to be set on '{$prop->getName()}', if remote type is given!");
        }

        if (!$stopPropagation) {
            $setMethod = Set::PREFIX . ucfirst($remoteName);
            $value->$setMethod(null, true);
        }
    }

    /**
     * @param  object     $value
     * @param  object     $object
     * @param  Prop       $prop
     * @param  bool       $stopPropagation
     * @throws \Exception
     */
    protected function removeMany($value, $object, Prop $prop, $stopPropagation = false)
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
