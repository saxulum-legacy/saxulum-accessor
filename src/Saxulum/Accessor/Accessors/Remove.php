<?php

namespace Saxulum\Accessor\Accessors;

use Saxulum\Accessor\CallbackBag;
use Saxulum\Accessor\Prop;

class Remove extends AbstractCollection
{
    const PREFIX = 'remove';

    /**
     * @var array
     */
    protected static $mappedTypePrefixes = array(
        Prop::REMOTE_ONE => Set::PREFIX,
        Prop::REMOTE_MANY => Remove::PREFIX,
    );

    /**
     * @return string
     */
    public function getPrefix()
    {
        return self::PREFIX;
    }

    protected function updateProperty(CallbackBag $callbackBag)
    {
        $collection = $this->getCollection($callbackBag);
        if ($collection->contains($callbackBag->getArgument(0))) {
            if (null !== $callbackBag->getMappedType()) {
                $this->handleMappedBy(
                    $callbackBag,
                    Set::PREFIX === $this->getPrefixByProp($callbackBag->getProp())
                );
            }
            $collection->remove($callbackBag->getArgument(0));
        }
    }
}
