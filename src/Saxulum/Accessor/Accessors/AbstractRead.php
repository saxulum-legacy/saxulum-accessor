<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\CallbackBag;
use Saxulum\Accessor\Prop;

abstract class AbstractRead extends AbstractAccessor
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
     * @param  string $namespace
     * @return string
     */
    public static function generatePhpDoc(Prop $prop, $namespace)
    {
        $name = $prop->getName();

        return '* @method ' . static::getPhpDocHint($prop, $namespace) . static::PREFIX . ucfirst($name) . '()';
    }

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
