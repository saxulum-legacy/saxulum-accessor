<?php

namespace Saxulum\Accessor\Collection;

use Doctrine\Common\Collections\Collection;

class DoctrineArrayCollection implements CollectionInterface
{
    /**
     * @var array
     */
    protected $collection;

    /**
     * @param Collection $collection
     */
    public function __construct(Collection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * @param mixed $element
     */
    public function add($element)
    {
        $this->collection->add($element);
    }

    /**
     * @param mixed $element
     */
    public function remove($element)
    {
        $this->collection->removeElement($element);
    }

    /**
     * @param  mixed $element
     * @return bool
     */
    public function contains($element)
    {
        return $this->collection->contains($element);
    }
}
