<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Doctrine\ORM\Mapping as ORM;
use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Is;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\Hint;
use Saxulum\Accessor\Prop;

/**
 * @ORM\Entity
 * @method int getId()
 * @method string|null getName()
 * @method bool isName()
 * @method $this setName($name)
 * @method string|null getValue()
 * @method bool isValue()
 * @method $this setValue($value)
 */
class AccessorHelper
{
    use AccessorTrait;

    /**
     * @var int
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @var string
     * @ORM\Column(name="value", type="string")
     */
    protected $value;

    protected function initializeProperties()
    {
        $this->prop((new Prop('id'))->method(Get::PREFIX));
        $this->prop(
            (new Prop('name', Hint::HINT_STRING))
                ->method(Get::PREFIX)
                ->method(Is::PREFIX)
                ->method(Set::PREFIX)
        );
        $this->prop(
            (new Prop('value', Hint::HINT_STRING))
                ->method(Get::PREFIX)
                ->method(Is::PREFIX)
                ->method(Set::PREFIX)
        );    }
}
