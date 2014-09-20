<?php

namespace Saxulum\Accessor;

use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Set;

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

    /**
     * @param  string     $name
     * @param  array      $arguments
     * @return mixed
     * @throws \Exception
     */
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

        throw new \Exception('Call to undefined method ' . __CLASS__ . '::' . $name . '()');
    }

    /**
     * @param  string $name
     * @return mixed
     */
    final public function __get($name)
    {
        $method = Get::PREFIX . ucfirst($name);

        return $this->$method();
    }

    /**
     * @param  string $name
     * @param  mixed  $value
     * @return mixed
     */
    final public function __set($name, $value)
    {
        $method = Set::PREFIX . ucfirst($name);

        return $this->$method($value);
    }

    /**
     * @param  Prop       $property
     * @return static
     * @throws \Exception
     */
    final public function prop(Prop $property)
    {
        $name = $property->getName();

        if (!property_exists($this, $name)) {
            throw new \InvalidArgumentException("Property does not exists");
        }

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

    abstract protected function initializeProperties();
}
