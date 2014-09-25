<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\CallbackBag;
use Saxulum\Accessor\Prop;

class Add extends AbstractCollection
{
    const PREFIX = 'add';

    /**
     * @var array
     */
    protected static $mappedTypePrefixes = array(
        Prop::REMOTE_ONE => Set::PREFIX,
        Prop::REMOTE_MANY => Add::PREFIX,
    );

    /**
     * @return string
     */
    public function getPrefix()
    {
        return self::PREFIX;
    }

    /**
     * @param  CallbackBag $callbackBag
     * @throws \Exception
     */
    protected function updateProperty(CallbackBag $callbackBag)
    {
        $collection = $this->getCollection($callbackBag);
        $value = $callbackBag->getArgument(0);
        if (false === $collection->contains($value)) {
            if (null !== $callbackBag->getMappedType()) {
                $this->handleMappedBy($callbackBag);
            }

            $collection->add($value);
        }
    }
}
