<?php

namespace Saxulum\Accessor\Collection;

interface CollectionInterface
{
    /**
     * @param  mixed $element
     * @return void
     */
    public function add($element);

    /**
     * @param  mixed $element
     * @return void
     */
    public function remove($element);

    /**
     * @param  mixed $element
     * @return bool
     */
    public function contains($element);
}
