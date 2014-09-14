<?php

namespace Saxulum\Accessor;

trait AccessorTrait
{
    /**
     * @var AccessorInterface[]
     */
    private $accessors = array();

    final public function __call($name, array $arguments = array())
    {
        foreach ($this->accessors as $accessor) {
            if (strpos($name, $accessor->getPrefix()) === 0) {
                $property = lcfirst(substr($name, strlen($accessor->getPrefix())));

                return $accessor->callback($this, $this->$property, $arguments);
            }
        }

        throw new \Exception('Call to undefined method ' . __CLASS__ . '::' . $name . '()');
    }

    /**
     * @param  AccessorInterface $accessor
     * @return self
     * @throws \Exception
     */
    final public function addAccessor(AccessorInterface $accessor)
    {
        $prefix = $accessor->getPrefix();

        if (isset($this->accessors[$prefix])) {
            throw new \Exception("Override Accessor is not allowed, to enhance stability!");
        }

        $this->accessors[$prefix] = $accessor;

        return $this;
    }
}
