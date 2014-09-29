<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\AccessorInterface;
use Saxulum\Accessor\CallbackBag;
use Saxulum\Accessor\Prop;

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

    /**
     * @param  Prop   $prop
     * @return string
     */
    public static function generatePhpDoc(Prop $prop)
    {
        $name = $prop->getName();

        return '@method ' . static::getPhpDocHint($prop) . static::PREFIX . ucfirst($name) . '()';
    }

    /**
     * @param  Prop   $prop
     * @return string
     */
    protected static function getPhpDocHint(Prop $prop)
    {
        return null !== $prop->getHint() ? $prop->getHint() . ' ' : '';
    }
}
