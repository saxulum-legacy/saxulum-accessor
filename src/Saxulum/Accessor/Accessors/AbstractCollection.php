<?php

namespace Saxulum\Accessor\Accessors;

use Doctrine\Common\Collections\Collection;
use Saxulum\Accessor\CallbackBag;
use Saxulum\Accessor\Collection\ArrayCollection;
use Saxulum\Accessor\Collection\CollectionInterface;
use Saxulum\Accessor\Collection\DoctrineArrayCollection;
use Saxulum\Accessor\Prop;

abstract class AbstractCollection extends AbstractWrite
{
    /**
     * @param CallbackBag $callbackBag
     */
    protected function propertyDefault(CallbackBag $callbackBag)
    {
        if (null === $callbackBag->getProperty()) {
            $callbackBag->setProperty(array());
        }
    }

    /**
     * @param  CallbackBag         $callbackBag
     * @return CollectionInterface
     */
    protected function getCollection(CallbackBag $callbackBag)
    {
        if (is_array($callbackBag->getProperty())) {
            return new ArrayCollection($callbackBag->getProperty());
        }

        if (interface_exists('Doctrine\Common\Collections\Collection') && $callbackBag->getProperty() instanceof Collection) {
            return new DoctrineArrayCollection($callbackBag->getProperty());
        }

        throw new \InvalidArgumentException("Property must be an array or a collection!");
    }

    /**
     * @param  CallbackBag $callbackBag
     * @param  bool        $nullValue
     * @throws \Exception
     */
    protected function handleMappedBy(CallbackBag $callbackBag, $nullValue = false)
    {
        if (null === $mappedBy = $callbackBag->getMappedBy()) {
            throw new \Exception("Remote name needs to be set on '{$callbackBag->getName()}', if remote type is given!");
        }

        $value = false === $nullValue ? $callbackBag->getObject() : null;

        if (false === $callbackBag->getArgument(1, false)) {
            $method = $this->getPrefixByProp($callbackBag->getProp()) . ucfirst($mappedBy);
            $callbackBag->getArgument(0)->$method($value, true);
        }
    }

    /**
     * @param  Prop   $prop
     * @return string
     */
    protected static function getPhpDocHint(Prop $prop)
    {
        if (null === $prop->getHint()) {
            return '';
        }

        $hint = $prop->getHint();

        if (substr($hint, -2) === '[]') {
            return substr($hint, 0, -2) . ' ';
        }

        return $hint . ' ';
    }
}
