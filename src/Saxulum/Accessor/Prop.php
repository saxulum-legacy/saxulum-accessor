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
     * @var array|null
     */
    protected $accessorPrefixes;

    /**
     * @var null|string
     */
    protected $remoteName;

    /**
     * @var null|string
     */
    protected $remoteType;

    const REMOTE_ONE = 'one';
    const REMOTE_MANY = 'many';

    /**
     * @param $name
     * @param string|null $hint
     * @param bool|null   $nullable
     * @param string|null $remoteName
     * @param string|null $remoteType
     */
    public function __construct($name, $hint = null, $nullable = null, $remoteName = null, $remoteType = null)
    {
        $this->name = $name;
        $this->hint = $hint;
        $this->nullable = $nullable;
        $this->remoteName = $remoteName;
        $this->remoteType = $remoteType;
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
    public function getRemoteName()
    {
        return $this->remoteName;
    }

    /**
     * @return null|string
     */
    public function getRemoteType()
    {
        return $this->remoteType;
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
        if (null === $this->accessorPrefixes) {
            return false;
        }

        return in_array($accessorPrefix, $this->accessorPrefixes, true);
    }
}
