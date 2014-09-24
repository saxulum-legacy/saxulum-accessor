<?php

namespace Saxulum\Accessor\Accessors;

use Doctrine\Common\Collections\Collection;
use Saxulum\Accessor\Prop;

class Remove extends AbstractCollection
{
    const PREFIX = 'remove';

    /**
     * @var array
     */
    protected static $remoteToPrefixMapping = array(
        Prop::REMOTE_ONE => Set::PREFIX,
        Prop::REMOTE_MANY => Remove::PREFIX,
    );

    /**
     * @return string
     */
    public function getPrefix()
    {
        return self::PREFIX;
    }

    /**
     * @param  array       $property
     * @param  mixed       $value
     * @param  Prop        $prop
     * @param  bool        $stopPropagation
     * @param  object|null $object
     * @throws \Exception
     */
    protected function removeArray(array &$property, $value, Prop $prop, $stopPropagation = false, $object = null)
    {
        $key = array_search($value, $property, true);

        if (false !== $key) {
            if (null !== $prop->getRemoteType()) {
                $this->handleRemote($value, $prop, $stopPropagation, Set::PREFIX !== self::getPrefixByProp($prop) ? $object : null);
            }
            unset($property[$key]);
        }
    }

    /**
     * @param  Collection  $property
     * @param  mixed       $value
     * @param  Prop        $prop
     * @param  bool        $stopPropagation
     * @param  object|null $object
     * @throws \Exception
     */
    protected function removeCollection(Collection &$property, $value, Prop $prop, $stopPropagation = false, $object = null)
    {
        if ($property->contains($value)) {
            if (null !== $prop->getRemoteType()) {
                $this->handleRemote($value, $prop, $stopPropagation, Set::PREFIX !== self::getPrefixByProp($prop) ? $object : null);
            }
            $property->removeElement($value);
        }
    }
}
