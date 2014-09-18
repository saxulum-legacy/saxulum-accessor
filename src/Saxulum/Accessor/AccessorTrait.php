<?php

namespace Saxulum\Accessor;

trait AccessorTrait
{
    /**
     * @var AbstractAccessor[]
     */
    private static $accessors = array();

    /**
     * @var Property[]
     */
    private $propertyConfigurations = array();

    final public function __call($name, array $arguments = array())
    {
        foreach (self::$accessors as $accessor) {
            if (strpos($name, $accessor->getPrefix()) === 0) {
                $property = lcfirst(substr($name, strlen($accessor->getPrefix())));
                if (isset($this->propertyConfigurations[$property])) {
                    $propertyConfiguration = $this->propertyConfigurations[$property];
                    if (property_exists(__CLASS__, $property) && $propertyConfiguration->has($accessor->getPrefix())) {
                        return $accessor->callback($this, $this->$property, $arguments);
                    }
                }
            }
        }

        throw new \Exception('Call to undefined method ' . __CLASS__ . '::' . $name . '()');
    }

    /**
     * @param  Property $propertyConfiguration
     * @return static
     * @throws \Exception
     */
    final public function addProperty(Property $propertyConfiguration)
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
    final public static function addAccessor(AbstractAccessor $accessor)
    {
        $prefix = $accessor->getPrefix();

        if (isset(self::$accessors[$prefix])) {
            throw new \Exception("Override Accessor is not allowed, to enhance stability!");
        }

        self::$accessors[$prefix] = $accessor;
    }
}
