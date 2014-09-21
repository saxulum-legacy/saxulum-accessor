<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\AccessorInterface;
use Saxulum\Accessor\Hint;

class Add implements AccessorInterface
{
    const PREFIX = 'add';

    /**
     * @return string
     */
    public function getPrefix()
    {
        return self::PREFIX;
    }

    /**
     * @param  object      $object
     * @param  mixed       $property
     * @param  string      $name
     * @param  array       $arguments
     * @param  string|null $hint
     * @param  bool        $nullable
     * @return mixed
     */
    public function callback($object, &$property, $name, array $arguments = array(), $hint = null, $nullable = false)
    {
        if (!array_key_exists(0, $arguments) || count($arguments) !== 1) {
            throw new \InvalidArgumentException("Set Accessor allows only one argument!");
        }

        $this->checkPropertyType($property);

        if (!Hint::validate($property, $hint, $nullable)) {
            $type = gettype($arguments[0]);
            throw new \InvalidArgumentException("Invalid type '{$type}' for hint '{$hint}' on property '{$name}'!");
        }

        $property[] = $arguments[0];

        return $object;
    }

    /**
     * @param $property
     * @throws \Exception
     */
    protected function checkPropertyType(&$property)
    {
        if (is_array($property)) {
            return;
        }

        if (null === $property) {
            $property = array();

            return;
        }

        throw new \Exception("Property must be an array or null to work for add!");
    }
}
