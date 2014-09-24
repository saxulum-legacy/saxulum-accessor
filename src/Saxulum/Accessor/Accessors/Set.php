<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\Prop;

class Set extends AbstractWrite
{
    const PREFIX = 'set';

    /**
     * @var array
     */
    protected static $remoteToPrefixMapping = array(
        Prop::REMOTE_ONE => array(Set::PREFIX, Set::PREFIX),
        Prop::REMOTE_MANY => array(Remove::PREFIX, Add::PREFIX),
    );

    /**
     * @return string
     */
    public function getPrefix()
    {
        return self::PREFIX;
    }

    /**
     * @param  mixed  $property
     * @return string
     * @throw \Exception
     */
    protected function getSubType(&$property)
    {
        return '';
    }

    /**
     * @param mixed $property
     */
    protected function propertyDefault(&$property) {}

    /**
     * @param mixed $property
     * @param mixed $value
     * @param Prop  $prop
     * @param bool  $stopPropagation
     * @param null  $object
     */
    protected function set(&$property, $value, Prop $prop, $stopPropagation = false, $object = null)
    {
        $prefixes = self::getPrefixByProp($prop);
        if (null !== $prefixes && !$stopPropagation) {
            $remoteName = $prop->getRemoteName();
            $removePrefix = $prefixes[0];
            $removeMethod = $removePrefix. ucfirst($remoteName);
            $addPrefix = $prefixes[1];
            $addMethod = $addPrefix. ucfirst($remoteName);
            if (!is_null($property)) {
                $property->$removeMethod(Set::PREFIX !== $removePrefix ? $object : null, true);
            }
            if (!is_null($value)) {
                $value->$addMethod($object, true);
            }
        }
        $property = $value;
    }
}
