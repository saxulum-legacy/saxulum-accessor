<?php

namespace Saxulum\Accessor;

abstract class AbstractAccessor
{
    /**
     * @var array|null
     */
    protected $properties;

    const MODE_BLACKLIST = 0;
    const MODE_WHITELIST = 1;

    /**
     * @var int
     */
    protected $mode = self::MODE_WHITELIST;

    /**
     * @param  string $property
     * @return $this
     */
    public function addProperty($property)
    {
        if (!is_string($property)) {
            throw new \InvalidArgumentException("Property must be a string!");
        }

        if (null === $this->properties) {
            $this->properties = array();
        }

        $this->properties[] = $property;

        return $this;
    }

    /**
     * @param  int    $mode
     * @return static
     */
    public function mode($mode)
    {
        $reflectionClass = new \ReflectionClass(__CLASS__);
        $modes = array();
        foreach ($reflectionClass->getConstants() as $name => $value) {
            if (strpos($name, 'MODE_') === 0) {
                $modes[$value] = $name;
            }
        }

        if (!isset($modes[$mode])) {
            throw new \InvalidArgumentException("Invalid mode!");
        }

        $this->mode = $mode;

        return $this;
    }

    /**
     * @param  string $property
     * @return bool
     */
    public function isAllowedProperty($property)
    {
        if (!is_string($property)) {
            throw new \InvalidArgumentException("Property must be a string!");
        }

        if (null === $this->properties) {
            return true;
        }

        if ($this->mode === self::MODE_BLACKLIST && !in_array($property, $this->properties)) {
            return true;
        }

        if ($this->mode === self::MODE_WHITELIST && in_array($property, $this->properties)) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    abstract public function getPrefix();

    /**
     * @param  object $object
     * @param  mixed  $property
     * @param  array  $arguments
     * @return mixed
     */
    abstract public function callback($object, &$property, $arguments);
}
