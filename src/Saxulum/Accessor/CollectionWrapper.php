<?php

namespace Saxulum\Accessor;

use Doctrine\Common\Collections\Collection;

class CollectionWrapper
{
    /**
     * @var array|Collection
     */
    protected $data;

    /**
     * @var string
     */
    protected $mode;

    const MODE_ARRAY = 'array';
    const MODE_COLLECTION = 'collection';

    public function __construct($data)
    {
        if (is_array($data)) {
            $this->mode = self::MODE_ARRAY;
        }

        if (interface_exists('Doctrine\Common\Collections\Collection') && $data instanceof Collection) {
            $this->mode = self::MODE_COLLECTION;
        }

        if (null === $this->mode) {
            throw new \InvalidArgumentException("Invalid data type");
        }

        $this->data = $data;
    }

    public function add($element)
    {
        $method = 'add' . ucfirst($this->mode);
        $this->$method($element);
    }

    public function remove($element)
    {
        $method = 'remove' . ucfirst($this->mode);
        $this->$method($element);
    }

    public function contains($element)
    {
        $method = 'contains' . ucfirst($this->mode);
        $this->$method($element);
    }
}
