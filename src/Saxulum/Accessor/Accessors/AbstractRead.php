<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\AccessorInterface;
use Saxulum\Accessor\CallbackBag;

abstract class AbstractRead implements AccessorInterface
{
    /**
     * @param  CallbackBag $callbackBag
     * @return mixed
     */
    public function callback(CallbackBag $callbackBag)
    {
        if (count($callbackBag->getArguments()) !== 0) {
            throw new \InvalidArgumentException($this->getPrefix() . ' accessor allows no argument!');
        }

        return $callbackBag->getProperty();
    }
}
