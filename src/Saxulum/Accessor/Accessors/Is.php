<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\CallbackBag;

class Is extends AbstractRead
{
    const PREFIX = 'is';

    /**
     * @return string
     */
    public function getPrefix()
    {
        return self::PREFIX;
    }

    /**
     * @param  CallbackBag $callbackBag
     * @return bool
     */
    public function callback(CallbackBag $callbackBag)
    {
        return (bool) parent::callback($callbackBag);
    }
}
