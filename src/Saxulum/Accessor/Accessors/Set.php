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
        $prefixes = $this->getPrefixByProp($callbackBag->getProp());
        if (null !== $prefixes && !$callbackBag->getArgument(1, false)) {
            $mappedBy = $callbackBag->getMappedBy();
            $removeMethod = $prefixes[0]. ucfirst($mappedBy);
            $addMethod = $prefixes[1]. ucfirst($mappedBy);
            if (!is_null($callbackBag->getProperty())) {
                $callbackBag->getProperty()->$removeMethod(Set::PREFIX !== $prefixes[0] ? $callbackBag->getObject() : null, true);
            }
            if (!is_null($callbackBag->getArgument(0))) {
                $callbackBag->getArgument(0)->$addMethod($callbackBag->getObject(), true);
            }
        }
        $callbackBag->setProperty($callbackBag->getArgument(0));
    }
}
