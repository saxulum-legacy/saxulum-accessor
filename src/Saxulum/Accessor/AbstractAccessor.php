<?php

namespace Saxulum\Accessor;

abstract class AbstractAccessor implements AccessorInterface
{
    /**
     * @var array|null
     */
    protected $properties;

    /**
     * @param  array|null $properties
     * @return static
     */
    public function setProperties(array $properties = null)
    {
        $this->properties = $properties;

        return $this;
    }

    /**
     * @return array
     */
    public function getProperties()
    {
        return $this->properties;
    }
}
