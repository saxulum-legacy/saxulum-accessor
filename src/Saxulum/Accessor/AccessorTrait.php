<?php

namespace Saxulum\Accessor;

use Saxulum\Accessor\Accessors\Get;

trait AccessorTrait
{
    /**
     * @var AccessorInterface[]
     */
    private static $accessors = array();

    /**
     * @var bool
     */
    private $initializedProperties = false;

    /**
     * @var Prop[]
     */
    private $properties = array();

    final public function __call($name, array $arguments = array())
    {
        if (false === $this->initializedProperties) {
            $this->initializedProperties = true;
            $this->initializeProperties();
        }

        if (property_exists($this, $name)) {
            $method = Get::PREFIX . ucfirst($name);

            return $this->$method();
        }

        foreach (self::$accessors as $prefix => $accessor) {
            if (strpos($name, $prefix) === 0) {
                $property = lcfirst(substr($name, strlen($prefix)));
                if (property_exists($this, $property)) {
                    if (isset($this->properties[$property])) {
                        $config = $this->properties[$property];
                        if ($config->hasMethod($prefix)) {
                            return $accessor->callback(
                                $this,
                                $this->$property,
                                $property,
                                $arguments,
                                $config->getHint(),
                                $config->getNullable()
                            );
                        }
                    }
                }
            }
        }

        throw new \Exception('Call to undefined method ' . __CLASS__ . '::' . $name . '()');
    }

    abstract protected function initializeProperties();

    /**
     * @param  Prop       $property
     * @return static
     * @throws \Exception
     */
    final public function prop(Prop $property)
    {
        $name = $property->getName();

        if (isset($this->properties[$name])) {
            throw new \Exception("Override Property is not allowed, to enhance stability!");
        }

        $this->properties[$name] = $property;

        return $this;
    }

    /**
     * @param  AccessorInterface $accessor
     * @throws \Exception
     */
    final public static function registerAccessor(AccessorInterface $accessor)
    {
        $prefix = $accessor->getPrefix();

        if (isset(self::$accessors[$prefix])) {
            throw new \Exception("Override Accessor is not allowed, to enhance stability!");
        }

        self::$accessors[$prefix] = $accessor;
    }
}
