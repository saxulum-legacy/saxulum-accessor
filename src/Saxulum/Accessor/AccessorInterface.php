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
     * @return string
     */
    public static function generatePhpDoc(Prop $prop);
}
