<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\AccessorInterface;
use Saxulum\Accessor\CallbackBag;
use Saxulum\Hint\Hint;
use Saxulum\Accessor\Prop;

abstract class AbstractWrite implements AccessorInterface
{
    /**
     * @var array
     */
    protected static $remoteToPrefixMapping = array();

    /**
     * @param  CallbackBag $callbackBag
     * @return mixed
     * @throws \Exception
     */
    public function callback(CallbackBag $callbackBag)
    {
        if (!$callbackBag->argumentExists(0)) {
            throw new \InvalidArgumentException($this->getPrefix() . ' accessor needs at least a value!');
        }

        Hint::validateOrException(
            $callbackBag->getName(),
            $callbackBag->getArgument(0),
            $callbackBag->getHint(),
            $callbackBag->getNullable()
        );

        $this->propertyDefault($callbackBag);
        $this->updateProperty($callbackBag);

        return $callbackBag->getObject();
    }

    /**
     * @param  CallbackBag $callbackBag
     * @return void
     */
    abstract protected function propertyDefault(CallbackBag $callbackBag);

    /**
     * @param  CallbackBag $callbackBag
     * @return void
     */
    abstract protected function updateProperty(CallbackBag $callbackBag);

    /**
     * @param  Prop        $prop
     * @return string|null
     */
    protected function getPrefixByProp(Prop $prop)
    {
        if (null !== $mappedType = $prop->getMappedType()) {
            if (isset(static::$remoteToPrefixMapping[$prop->getMappedType()])) {
                return static::$remoteToPrefixMapping[$prop->getMappedType()];
            }
        }

        return null;
    }

    /**
     * @param  Prop   $prop
     * @return string
     */
    public static function generatePhpDoc(Prop $prop)
    {
        $name = $prop->getName();

        return '* @method $this ' . static::PREFIX . ucfirst($name) . '(' .  static::getPhpDocHint($prop) . '$' . $name . ')';
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
