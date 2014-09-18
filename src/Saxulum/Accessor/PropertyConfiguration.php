<?php

namespace Saxulum\Accessor;

class PropertyConfiguration
{
    /**
     * @var string
     */
    protected $property;

    /**
     * @var array|null
     */
    protected $accessorPrefixes;

    /**
     * @param string $property
     */
    public function __construct($property)
    {
        $this->property = $property;
    }

    /**
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param  string $accessorPrefix
     * @return self
     */
    public function addAccessorPrefix($accessorPrefix)
    {
        if (null === $this->accessorPrefixes) {
            $this->accessorPrefixes = array();
        }

        $this->accessorPrefixes[] = $accessorPrefix;

        return $this;
    }

    /**
     * @param  string $accessorPrefix
     * @return bool
     */
    public function hasAccessorPrefix($accessorPrefix)
    {
        if (null === $this->accessorPrefixes) {
            return false;
        }

        return in_array($accessorPrefix, $this->accessorPrefixes);
    }
}
