<?php

namespace Saxulum\Accessor;

use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Set;

trait AccessorTrait
{
    /**
     * @var AccessorInterface[]
     */
    private static $__accessors = array();

    /**
     * @var bool
     */
    private $__initializedProperties = false;

    /**
     * @var Prop[]
     */
    private $__properties = array();

    /**
     * __call can't be final, cause doctrine proxy
     *
     * @param  string     $name
     * @param  array      $arguments
     * @return mixed
     * @throws \Exception
     */
    public function __call($name, array $arguments = array())
    {
        return $this->__handleCall($name, $arguments);
    }

    /**
     * @param  string     $name
     * @param  array      $arguments
     * @return mixed
     * @throws \Exception
     */
    private function __handleCall($name, array $arguments)
    {
        if (false === $this->__initializedProperties) {
            $this->__initializedProperties = true;
            $this->initializeProperties();
        }

        // needed by the symfony/property-access
        if (property_exists($this, $name)) {
            $method = Get::PREFIX . ucfirst($name);

            return $this->$method();
        }

        foreach (self::$__accessors as $prefix => $accessor) {
            if (strpos($name, $prefix) === 0) {
                $property = lcfirst(substr($name, strlen($prefix)));
                if (isset($this->__properties[$property])) {
                    $config = $this->__properties[$property];
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
     * __get can't be final, cause doctrine proxy
     *
     * @param  string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->__handleGet($name);
    }

    /**
     * @param  string $name
     * @return mixed
     */
    private function __handleGet($name)
    {
        $method = Get::PREFIX . ucfirst($name);

        return $this->$method();
    }

    /**
     * __set can't be final, cause doctrine proxy
     *
     * @param  string $name
     * @param  mixed  $value
     * @return mixed
     */
    public function __set($name, $value)
    {
        return $this->__handleSet($name, $value);
    }

    /**
     * @param  string $name
     * @param  mixed  $value
     * @return mixed
     */
    private function __handleSet($name, $value)
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

        if (isset($this->__properties[$name])) {
            throw new \Exception("Override Property is not allowed, to enhance stability!");
        }

        $this->__properties[$name] = $property;

        return $this;
    }

    /**
     * @param  AccessorInterface $accessor
     * @throws \Exception
     */
    final public static function registerAccessor(AccessorInterface $accessor)
    {
        $prefix = $accessor->getPrefix();

        if (isset(self::$__accessors[$prefix])) {
            throw new \Exception("Override Accessor is not allowed, to enhance stability!");
        }

        self::$__accessors[$prefix] = $accessor;
    }

    abstract protected function initializeProperties();
}
