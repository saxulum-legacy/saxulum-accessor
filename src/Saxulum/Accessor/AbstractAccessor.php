<?php

namespace Saxulum\Accessor;

abstract class AbstractAccessor
{
    const HINT_STR = 'string';
    const HINT_INT = 'int';
    const HINT_FLOAT = 'float';
    const HINT_BOOL = 'bool';
    const HINT_ARRAY = 'array';

    /**
     * @var array|null
     */
    protected $properties;

    /**
     * @param  string $property
     * @return $this
     */
    public function prop($property)
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
     * @param  mixed       $property
     * @param  string|null $hint
     * @return bool
     */
    protected function hint($property, $hint = null)
    {
        switch ($hint) {
            case null:
                return true;
            case self::HINT_STR:
            case self::HINT_INT:
            case self::HINT_FLOAT:
            case self::HINT_BOOL:
            case self::HINT_ARRAY:
                $function = 'is_' . $hint;

                return $function($property);
            default:
                return is_object($property) && is_a($property, $hint);
        }
    }

    /**
     * @return string
     */
    abstract public function getPrefix();

    /**
     * @param  object      $object
     * @param  mixed       $property
     * @param  array       $arguments
     * @param  string      $name
     * @param  string|null $hint
     * @return mixed
     */
    abstract public function callback($object, &$property, array $arguments, $name, $hint);
}
