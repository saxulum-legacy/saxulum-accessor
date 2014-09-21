<?php

namespace Saxulum\Accessor\Accessors;

use Doctrine\Common\Collections\Collection;

class Remove extends AbstractCollection
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
     * @param array $property
     * @param mixed $value
     */
    protected function removeArray(array &$property, $value)
    {
        $key = array_search($value, $property, true);

        if (false !== $key) {
            unset($property[$key]);
        }
    }

    /**
     * @param Collection $property
     * @param mixed      $value
     */
    protected function removeCollection(Collection &$property, $value)
    {
        if ($property->contains($value)) {
            $property->removeElement($value);
        }
    }
}
