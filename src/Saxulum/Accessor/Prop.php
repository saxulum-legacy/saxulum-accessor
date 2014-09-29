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
     * @var bool|null
     */
    protected $nullable;

    /**
     * @var null|string
     */
    protected $mappedBy;

    /**
     * @var null|string
     */
    protected $mappedType;

    const REMOTE_ONE = 'one';
    const REMOTE_MANY = 'many';

    /**
     * @var string[]
     */
    protected $accessorPrefixes = array();

    /**
     * @param $name
     * @param string|null $hint
     * @param bool|null   $nullable
     * @param string|null $mappedBy
     * @param string|null $mappedType
     */
    public function __construct($name, $hint = null, $nullable = null, $mappedBy = null, $mappedType = null)
    {
        $this->name = $name;
        $this->hint = $hint;
        $this->nullable = $nullable;
        $this->mappedBy = $mappedBy;
        $this->mappedType = $mappedType;
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
     * @return null|string
     */
    public function getMappedBy()
    {
        return $this->mappedBy;
    }

    /**
     * @return null|string
     */
    public function getMappedType()
    {
        return $this->mappedType;
    }

    /**
     * @param  string $accessorPrefix
     * @return self
     */
    public function method($accessorPrefix)
    {
        if (!in_array($accessorPrefix, $this->accessorPrefixes, true)) {
            $this->accessorPrefixes[] = $accessorPrefix;
        }

        return $this;
    }

    /**
     * @param  string $accessorPrefix
     * @return bool
     */
    public function hasMethod($accessorPrefix)
    {
        return in_array($accessorPrefix, $this->accessorPrefixes, true);
    }

    /**
     * @return string
     */
    public function generatePhpDoc()
    {
        $phpdoc = '';
        foreach ($this->accessorPrefixes as $accessorPrefix) {
            $accessor = AccessorRegistry::getAccessor($accessorPrefix);
            $phpdoc .= $accessor->generatePhpDoc($this). "\n";
        }

        return $phpdoc;
    }
}
