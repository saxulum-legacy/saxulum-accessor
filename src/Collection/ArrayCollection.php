<?php

namespace Saxulum\Accessor\Collection;

class ArrayCollection implements CollectionInterface
{
    /**
     * @var array
     */
    protected $array;

    /**
     * @param array $array
     */
    public function __construct(array &$array)
    {
        $this->array = &$array;
    }

    /**
     * @param  mixed $element
     * @return void
     */
    public function add($element)
    {
        $this->array[] = $element;
    }

    /**
     * @param  mixed $element
     * @return void
     */
    public function remove($element)
    {
        if (false !== $index = array_search($element, $this->array, true)) {
            unset($this->array[$index]);
        }
    }
}
