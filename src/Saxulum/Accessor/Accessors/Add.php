<?php

namespace Saxulum\Accessor\Accessors;

use Doctrine\Common\Collections\Collection;
use Saxulum\Accessor\Prop;

class Add extends AbstractCollection
{
    const PREFIX = 'add';

    /**
     * @var array
     */
    protected static $remoteToPrefixMapping = array(
        Prop::REMOTE_ONE => Set::PREFIX,
        Prop::REMOTE_MANY => Add::PREFIX,
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
    protected function addArray(array &$property, $value, Prop $prop, $stopPropagation = false, $object = null)
    {
        if (!in_array($value, $property, true)) {
            if (null !== $prop->getRemoteType()) {
                $this->handleRemote($value, $prop, $stopPropagation, $object);
            }
            $property[] = $value;
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
    protected function addCollection(Collection &$property, $value, Prop $prop, $stopPropagation = false, $object = null)
    {
        if (!$property->contains($value)) {
            if (null !== $prop->getRemoteType()) {
                $this->handleRemote($value, $prop, $stopPropagation, $object);
            }
            $property->add($value);
        }
    }
}
