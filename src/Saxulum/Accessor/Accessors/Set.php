<?php

namespace Saxulum\Accessor\Accessors;

class Set extends AbstractWrite
{
    const PREFIX = 'set';

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
     */
    protected function set(&$property, $value)
    {
        $property = $value;
    }
}
