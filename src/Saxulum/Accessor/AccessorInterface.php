<?php

namespace Saxulum\Accessor;

interface AccessorInterface
{
    /**
     * @return string
     */
    public function getPrefix();

    /**
     * @param  CallbackBag $callbackBag
     * @return mixed
     */
    public function callback(CallbackBag $callbackBag);
}
