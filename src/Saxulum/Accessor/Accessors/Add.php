<?php

namespace Saxulum\Accessor\Accessors;

use Doctrine\Common\Collections\Collection;
use Saxulum\Accessor\Hint;

class Add extends AbstractCollection
{
    const PREFIX = 'add';
    const METHOD_PREFIX = 'addTo';

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
            throw new \InvalidArgumentException("Add Accessor allows only one argument!");
        }

        Hint::validateOrException($name, $property, $hint, $nullable);

        $this->updateProperty($property, $name, $arguments[0], self::METHOD_PREFIX);

        return $object;
    }

    /**
     * @param array $property
     * @param $value
     */
    protected function addToArray(array &$property, $value)
    {
        if (!in_array($value, $property, true)) {
            $property[] = $value;
        }
    }

    /**
     * @param Collection $property
     * @param $value
     */
    protected function addToCollection(Collection &$property, $value)
    {
        if (!$property->contains($value)) {
            $property->add($value);
        }
    }
}
