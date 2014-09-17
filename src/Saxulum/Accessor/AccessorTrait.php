<?php

namespace Saxulum\Accessor;

trait AccessorTrait
{
    /**
     * @var AbstractAccessor[]
     */
    private $accessors = array();

    final public function __call($name, array $arguments = array())
    {
        foreach ($this->accessors as $accessor) {
            if (strpos($name, $accessor->getPrefix()) === 0) {
                $property = lcfirst(substr($name, strlen($accessor->getPrefix())));
                if (property_exists(__CLASS__, $property) && $accessor->isAllowedProperty($property)) {
                    return $accessor->callback($this, $this->$property, $arguments);
                }
            }
        }

        throw new \Exception('Call to undefined method ' . __CLASS__ . '::' . $name . '()');
    }

    /**
     * @param  AbstractAccessor $accessor
     * @return static
     * @throws \Exception
     */
    final public function addAccessor(AbstractAccessor $accessor)
    {
        $prefix = $accessor->getPrefix();

        if (isset($this->accessors[$prefix])) {
            throw new \Exception("Override Accessor is not allowed, to enhance stability!");
        }

        $this->accessors[$prefix] = $accessor;

        return $this;
    }
}
