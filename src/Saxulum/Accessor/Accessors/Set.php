<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\CallbackBag;
use Saxulum\Accessor\Prop;

class Set extends AbstractWrite
{
    const PREFIX = 'set';

    /**
     * @var array
     */
    protected static $remoteToPrefixMapping = array(
        Prop::REMOTE_ONE => array(Set::PREFIX, Set::PREFIX),
        Prop::REMOTE_MANY => array(Remove::PREFIX, Add::PREFIX),
    );

    /**
     * @return string
     */
    public function getPrefix()
    {
        return self::PREFIX;
    }

    /**
     * @param CallbackBag $callbackBag
     */
    protected function propertyDefault(CallbackBag $callbackBag) {}

    /**
     * @param CallbackBag $callbackBag
     */
    protected function updateProperty(CallbackBag $callbackBag)
    {
        if (!$callbackBag->getProp()->hasMethod(Add::PREFIX) && !$callbackBag->getProp()->hasMethod(Remove::PREFIX)) {
            $this->updateSimpleProperty($callbackBag);
        } else {
            $this->updateCollectionProperty($callbackBag);
        }
    }

    /**
     * @param CallbackBag $callbackBag
     */
    protected function updateSimpleProperty(CallbackBag $callbackBag)
    {
        $prefixes = $this->getPrefixByProp($callbackBag->getProp());
        $removePrefix = $prefixes[0];
        $addPrefix = $prefixes[1];
        $value = $callbackBag->getArgument(0);

        if (null !== $prefixes && !$callbackBag->getArgument(1, false)) {
            $mappedBy = $callbackBag->getMappedBy();
            $removeMethod = $removePrefix. ucfirst($mappedBy);
            $addMethod = $addPrefix. ucfirst($mappedBy);
            if (!is_null($callbackBag->getProperty())) {
                $callbackBag->getProperty()->$removeMethod(Set::PREFIX !== $removePrefix ? $callbackBag->getObject() : null, true);
            }
            if (!is_null($value)) {
                $value->$addMethod($callbackBag->getObject(), true);
            }
        }

        $callbackBag->setProperty($value);
    }

    /**
     * @param CallbackBag $callbackBag
     */
    protected function updateCollectionProperty(CallbackBag $callbackBag)
    {
        $object = $callbackBag->getObject();
        $propertyName = $callbackBag->getName();
        $oldValues = $callbackBag->getProperty();
        $newValues = $callbackBag->getArgument(0);
        $addMethod = Add::PREFIX . ucfirst($propertyName);
        $removeMethod = Remove::PREFIX . ucfirst($propertyName);

        foreach ($oldValues as $oldValue) {
            $object->$removeMethod($oldValue);
        }

        foreach ($newValues as $newValue) {
            $object->$addMethod($newValue);
        }
    }

    /**
     * @param  Prop   $prop
     * @param  string $namespace
     * @return string
     */
    protected static function getPhpDocHint(Prop $prop, $namespace)
    {
        if ($prop->hasMethod(Add::PREFIX) || $prop->hasMethod(Remove::PREFIX)) {
            return 'array ';
        }

        $hint = $prop->getPhpDocHint($namespace);

        return '' === $hint ? $hint : $hint . ' ';
    }
}
