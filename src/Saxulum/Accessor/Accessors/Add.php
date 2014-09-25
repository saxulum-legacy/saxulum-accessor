<?php

namespace Saxulum\Accessor\Accessors;

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
     * @param  mixed       $property
     * @param  mixed       $value
     * @param  Prop        $prop
     * @param  bool        $stopPropagation
     * @param  object|null $object
     * @throws \Exception
     */
    protected function add(&$property, $value, Prop $prop, $stopPropagation = false, $object = null)
    {
        $collection = static::getCollection($property);
        if (false === $collection->contains($value)) {
            if (null !== $prop->getMappedType()) {
                static::handleMappedBy($value, $prop, $stopPropagation, $object);
            }
            $collection->add($value);
        }
    }
}
