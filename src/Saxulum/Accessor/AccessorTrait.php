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
        try {
            $accessor = $this->findAccessor($name);
            $property = lcfirst(substr($name, strlen($accessor->getPrefix())));

            return $accessor->callback($this, $this->$property, $arguments);
        } catch (\Exception $e) {
            throw new \Exception('Call to undefined method ' . __CLASS__ . '::' . $name . '()');
        }
    }

    /**
     * @param  AccessorInterface $accessor
     * @return self
     * @throws \Exception
     */
    final public function addAccessor(AccessorInterface $accessor)
    {
        if ($this->hasAccessor($accessor->getPrefix())) {
            throw new \Exception("Override Accessor is not allowed, to enhance stability!");
        }

        $this->accessors[] = $accessor;

        return $this;
    }

    /**
     * @param string $prefix
     * @return bool
     */
    final public function hasAccessor($prefix)
    {
        try {
            $this->getAccessor($prefix);

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * @param string $name
     * @return AccessorInterface
     * @throws \Exception
     */
    final public function findAccessor($name)
    {
        foreach ($this->accessors as $accessor) {
            if (strpos($name, $accessor->getPrefix()) === 0) {
                return $accessor;
            }
        }

        throw new \Exception(sprintf("No Accessor for called method %s found.", $name));
    }

    /**
     * @param string $prefix
     * @return AccessorInterface
     * @throws \Exception
     */
    final public function getAccessor($prefix)
    {
        foreach ($this->accessors as $accessor) {
            if ($prefix === $accessor->getPrefix()) {
                return $accessor;
            }
        }

        throw new \Exception(sprintf("No Accessor for prefix %s found.", $prefix));
    }
}
