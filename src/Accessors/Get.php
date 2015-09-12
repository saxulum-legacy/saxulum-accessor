<?php

namespace Saxulum\Accessor\Accessors;

class Get extends AbstractRead
{
    const PREFIX = 'get';

    /**
     * @return string
     */
    public function getPrefix()
    {
        return self::PREFIX;
    }
}
