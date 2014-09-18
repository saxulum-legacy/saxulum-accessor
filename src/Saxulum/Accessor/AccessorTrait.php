<?php

namespace Saxulum\Accessor;

trait AccessorTrait
{
    /**
     * @var AbstractAccessor[]
     */
    private $accessors = array();

    /**
     * @var PropertyConfiguration[]
     */
    private $propertyConfigurations = array();

    final public function __call($name, array $arguments = array())
    {
        foreach ($this->accessors as $accessor) {
            if (strpos($name, $accessor->getPrefix()) === 0) {
                $property = lcfirst(substr($name, strlen($accessor->getPrefix())));
                if (isset($this->propertyConfigurations[$property])) {
                    $propertyConfiguration = $this->propertyConfigurations[$property];
                    if (property_exists(__CLASS__, $property) && $propertyConfiguration->hasAccessorPrefix($accessor->getPrefix())) {
                        return $accessor->callback($this, $this->$property, $arguments);
                    }
                }
            }
        }

        throw new \Exception('Call to undefined method ' . __CLASS__ . '::' . $name . '()');
    }

    /**
     * @param  PropertyConfiguration $propertyConfiguration
     * @return static
     * @throws \Exception
     */
    final public function addPropertyConfiguration(PropertyConfiguration $propertyConfiguration)
    {
        $property = $propertyConfiguration->getProperty();

        if (isset($this->propertyConfigurations[$property])) {
            throw new \Exception("Override PropertyConfiuguration is not allowed, to enhance stability!");
        }

        $this->propertyConfigurations[$property] = $propertyConfiguration;

        return $this;
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
