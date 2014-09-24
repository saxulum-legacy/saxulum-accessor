<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\Prop;

class Is extends AbstractRead
{
    const PREFIX = 'is';

    /**
     * @return string
     */
    public function getPrefix()
    {
        return self::PREFIX;
    }

    /**
     * @param  object $object
     * @param  mixed  $property
     * @param  Prop   $prop
     * @param  array  $arguments
     * @return bool
     */
    public function callback($object, &$property, Prop $prop, array $arguments = array())
    {
        return (bool) parent::callback($object, $property, $prop, $arguments);
    }
}
