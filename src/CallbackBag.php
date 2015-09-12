<?php

namespace Saxulum\Accessor;

class CallbackBag
{
    /**
     * @var Prop
     */
    protected $prop;

    /**
     * @var object
     */
    protected $object;

    /**
     * @var mixed
     */
    protected $property;

    /**
     * @var array
     */
    protected $arguments;

    /**
     * @param Prop  $prop
     * @param $object
     * @param $property
     * @param array $arguments
     */
    public function __construct(Prop $prop, &$object, &$property, array $arguments)
    {
        $this->prop = $prop;
        $this->object = &$object;
        $this->property = &$property;
        $this->arguments = $arguments;
    }

    /**
     * @return Prop
     */
    public function getProp()
    {
        return $this->prop;
    }

    /**
     * @return object
     */
    public function &getObject()
    {
        return $this->object;
    }

    /**
     * @param mixed $property
     */
    public function setProperty($property)
    {
        $this->property = $property;
    }

    /**
     * @return mixed
     */
    public function &getProperty()
    {
        return $this->property;
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param  int  $index
     * @return bool
     */
    public function argumentExists($index)
    {
        return array_key_exists($index, $this->arguments);
    }

    /**
     * @param  int   $index
     * @param  mixed $default
     * @return mixed
     */
    public function getArgument($index, $default = null)
    {
        return array_key_exists($index, $this->arguments) ? $this->arguments[$index] : $default;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->prop->getName();
    }

    /**
     * @return null|string
     */
    public function getHint()
    {
        return $this->prop->getHint();
    }

    /**
     * @return null|string
     */
    public function getMappedBy()
    {
        return $this->prop->getMappedBy();
    }

    /**
     * @return null|string
     */
    public function getMappedType()
    {
        return $this->prop->getMappedType();
    }

    /**
     * @return bool|null
     */
    public function getNullable()
    {
        return $this->prop->getNullable();
    }
}
