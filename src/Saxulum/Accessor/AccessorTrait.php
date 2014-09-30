<?php

namespace Saxulum\Accessor;

use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Set;

trait AccessorTrait
{
    /**
     * @var bool
     */
    private $__initProps = false;

    /**
     * @var Prop[]
     */
    private $__props = array();

    /**
     * can't be final, cause doctrine proxy
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
     * needed by symfony/property-access
     * can't be final, cause doctrine proxy
     *
     * @param  string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->__handleGet($name);
    }

    /**
     * needed by symfony/property-access
     * can't be final, cause doctrine proxy
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
     * @param  string     $name
     * @param  array      $arguments
     * @return mixed
     * @throws \Exception
     */
    private function __handleCall($name, array $arguments)
    {
        if (false === $this->__initProps) {
            $this->__initProps = true;
            $this->_initProps();
        }

        // needed by twig, cause it tries to call a method with the property name
        if (property_exists($this, $name)) {
            $method = Get::PREFIX . ucfirst($name);

            return $this->$method();
        }

        foreach (AccessorRegistry::getAccessors() as $prefix => $accessor) {
            if (strpos($name, $prefix) === 0) {
                $property = lcfirst(substr($name, strlen($prefix)));
                if (isset($this->__props[$property])) {
                    $prop = $this->__props[$property];
                    if ($prop->hasMethod($prefix)) {
                        return $accessor->callback(
                            new CallbackBag($prop, $this, $this->$property, $arguments)
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
    private function __handleGet($name)
    {
        $method = Get::PREFIX . ucfirst($name);

        return $this->$method();
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
    final public function _prop(Prop $property)
    {
        $name = $property->getName();

        if (!property_exists($this, $name)) {
            throw new \InvalidArgumentException("Property does not exists");
        }

        if (isset($this->__props[$name])) {
            throw new \Exception("Override Property is not allowed, to enhance stability!");
        }

        $this->__props[$name] = $property;

        return $this;
    }

    abstract protected function _initProps();
}
