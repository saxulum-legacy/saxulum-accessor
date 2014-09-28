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
}
