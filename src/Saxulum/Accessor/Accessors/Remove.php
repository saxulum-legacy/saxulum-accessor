<?php

namespace Saxulum\Accessor\Accessors;

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
     * @param  mixed       $property
     * @param  mixed       $value
     * @param  Prop        $prop
     * @param  bool        $stopPropagation
     * @param  object|null $object
     * @throws \Exception
     */
    protected function remove(&$property, $value, Prop $prop, $stopPropagation = false, $object = null)
    {
        $collection = static::getCollection($property);
        if ($collection->contains($value)) {
            if (null !== $prop->getMappedType()) {
                static::handleMappedBy(
                    $value,
                    $prop,
                    $stopPropagation,
                    Set::PREFIX !== static::getPrefixByProp($prop) ? $object : null
                );
            }
            $collection->remove($value);
        }
    }
}
