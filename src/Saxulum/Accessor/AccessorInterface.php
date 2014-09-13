<?php

namespace Saxulum\Accessor;

interface AccessorInterface
{
    /**
     * @return string
     */
    public function getPrefix();

    /**
     * @return callable($object, &$property, $arguments)
     */
    public function callback();
}