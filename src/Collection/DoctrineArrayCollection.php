<?php

namespace Saxulum\Accessor\Collection;

use Doctrine\Common\Collections\Collection;

class DoctrineArrayCollection implements CollectionInterface
{
    /**
     * @var Collection
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
     * @param  mixed $element
     * @return void
     */
    public function add($element)
    {
        $this->collection->add($element);
    }

    /**
     * @param  mixed $element
     * @return void
     */
    public function remove($element)
    {
        $this->collection->removeElement($element);
    }
}
