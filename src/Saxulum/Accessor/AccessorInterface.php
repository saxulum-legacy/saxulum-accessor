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

    /**
     * @param  Prop   $prop
     * @param  string $namespace
     * @return string
     */
    public static function generatePhpDoc(Prop $prop, $namespace);
}
