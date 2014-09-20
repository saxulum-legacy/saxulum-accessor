<?php

namespace Saxulum\Accessor;

class Prop
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string|null
     */
    protected $hint;

    /**
     * @var bool
     */
    protected $nullable;

    /**
     * @var array|null
     */
    protected $accessorPrefixes;

    /**
     * @param $name
     * @param null      $hint
     * @param null|bool $nullable
     */
    public function __construct($name, $hint = null, $nullable = null)
    {
        $this->name = $name;
        $this->hint = $hint;
        $this->nullable = $nullable;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getHint()
    {
        return $this->hint;
    }

    /**
     * @return bool|null
     */
    public function getNullable()
    {
        return $this->nullable;
    }

    /**
     * @param  string $accessorPrefix
     * @return self
     */
    public function method($accessorPrefix)
    {
        if (null === $this->accessorPrefixes) {
            $this->accessorPrefixes = array();
        }

        $this->accessorPrefixes[] = $accessorPrefix;

        return $this;
    }

    /**
     * @param  string $accessorPrefix
     * @return bool
     */
    public function hasMethod($accessorPrefix)
    {
        if (null === $this->accessorPrefixes) {
            return false;
        }

        return in_array($accessorPrefix, $this->accessorPrefixes);
    }
}
