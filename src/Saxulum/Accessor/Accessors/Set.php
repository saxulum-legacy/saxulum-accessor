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
    protected static $mappedTypePrefixes = array(
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
        $removePrefix = $this->getPrefixByProp($callbackBag->getProp(), 0);
        $addPrefix = $this->getPrefixByProp($callbackBag->getProp(), 1);
        $stopPropagation = $callbackBag->getArgument(1, false);

        if (null !== $removePrefix && null !== $addPrefix && !$stopPropagation) {
            $mappedBy = $callbackBag->getMappedBy();
            $removeMethod = $removePrefix. ucfirst($mappedBy);
            $addMethod = $addPrefix. ucfirst($mappedBy);
            if (!is_null($callbackBag->getProperty())) {
                $callbackBag->getProperty()->$removeMethod(Set::PREFIX !== $removePrefix ? $callbackBag->getObject() : null, true);
            }
            if (!is_null($callbackBag->getArgument(0))) {
                $callbackBag->getArgument(0)->$addMethod($callbackBag->getObject(), true);
            }
        }
        $callbackBag->setProperty($callbackBag->getArgument(0));
    }
}
