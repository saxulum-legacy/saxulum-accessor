<?php

namespace Saxulum\Accessor\Accessors;

use Doctrine\Common\Collections\Collection;

abstract class AbstractCollection extends AbstractWrite
{
    /**
     * @param  mixed  $property
     * @return string
     * @throw \Exception
     */
    protected function getSubType(&$property)
    {
        if (null === $property) {
            $property = array();
        }

        if (is_array($property)) {
            return 'array';
        }

        if (interface_exists('Doctrine\Common\Collections\Collection') && $property instanceof Collection) {
            return 'collection';
        }

        throw new \InvalidArgumentException("Property must be an array or a collection!");
    }
}
