<?php

namespace Saxulum\Accessor\Accessors;

use Doctrine\Common\Collections\Collection;
use Saxulum\Accessor\AccessorInterface;
use Saxulum\Accessor\Hint;

class Remove implements AccessorInterface
{
    const PREFIX = 'remove';

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
            throw new \InvalidArgumentException("Remove Accessor allows only one argument!");
        }

        Hint::validateOrException($name, $property, $hint, $nullable);

        if (null === $property) {
            $property = array();
        }

        $this->removeValue($property, $arguments[0]);

        return $object;
    }

    /**
     * @param Collection|array|null $property
     * @param mixed                 $value
     */
    protected function removeValue(&$property, $value)
    {
        if (is_array($property)) {
            $this->removeFromArray($property, $value);

            return;
        }

        if (interface_exists('Doctrine\Common\Collections\Collection') && $property instanceof Collection) {
            $this->removeFromCollection($property, $value);

            return;
        }

        throw new \InvalidArgumentException("Property must be an array or a collection!");
    }

    /**
     * @param array $property
     * @param $value
     */
    protected function removeFromArray(array &$property, $value)
    {
        $key = array_search($value, $property, true);

        if (false !== $key) {
            unset($property[$key]);
        }
    }

    /**
     * @param Collection $property
     * @param $value
     */
    protected function removeFromCollection(Collection &$property, $value)
    {
        if ($property->contains($value)) {
            $property->removeElement($value);
        }
    }
}
