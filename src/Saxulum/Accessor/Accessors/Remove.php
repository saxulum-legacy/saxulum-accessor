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
            $this->removeRemote($value, null, $prop, Set::PREFIX, $stopPropagation);
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
            $this->removeRemote($value, $object, $prop, Remove::PREFIX, $stopPropagation);
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
            $this->removeRemote($value, null, $prop, Set::PREFIX, $stopPropagation);
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
            $this->removeRemote($value, $object, $prop, Remove::PREFIX, $stopPropagation);
            $property->removeElement($value);
        }
    }

    /**
     * @param  object      $value
     * @param  object|null $object
     * @param  Prop        $prop
     * @param  string      $prefix
     * @param  bool        $stopPropagation
     * @throws \Exception
     */
    protected function removeRemote($value, $object, Prop $prop, $prefix, $stopPropagation = false)
    {
        if (null === $remoteName = $prop->getRemoteName()) {
            throw new \Exception("Remote name needs to be set on '{$prop->getName()}', if remote type is given!");
        }

        if (!$stopPropagation) {
            $method = $prefix . ucfirst($remoteName);
            $value->$method($object, true);
        }
    }
}
