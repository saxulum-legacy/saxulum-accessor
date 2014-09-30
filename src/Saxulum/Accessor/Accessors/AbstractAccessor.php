<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\AccessorInterface;
use Saxulum\Accessor\Prop;

abstract class AbstractAccessor implements AccessorInterface
{
    /**
     * @param  Prop   $prop
     * @param  string $namespace
     * @return string
     */
    protected static function getPhpDocHint(Prop $prop, $namespace)
    {
        $hint = $prop->getPhpDocHint($namespace);

        return '' !== $hint ? $hint . ' ' : '';
    }
}
