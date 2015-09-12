<?php

namespace Saxulum\Tests\Accessor\Fixtures;

use Doctrine\ORM\Mapping as ORM;
use Saxulum\Accessor\Accessors\Add;
use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Is;
use Saxulum\Accessor\Accessors\Remove;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Hint\Hint;
use Saxulum\Accessor\Prop;

/**
 * @ORM\Entity
 * @method int getId()
 * @method string getName()
 * @method bool isName()
 * @method $this setName(string $name)
 * @method $this addValue(string $value)
 * @method string getValue()
 * @method bool isValue()
 * @method $this removeValue(string $value)
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
     * @var array
     * @ORM\Column(name="value", type="json_array")
     */
    protected $value;

    protected function _initProps()
    {
        $this->_prop((new Prop('id', Hint::INT))->method(Get::PREFIX));
        $this->_prop(
            (new Prop('name', Hint::STRING))
                ->method(Get::PREFIX)
                ->method(Is::PREFIX)
                ->method(Set::PREFIX)
        );
        $this->_prop(
            (new Prop('value', Hint::STRING))
                ->method(Add::PREFIX)
                ->method(Get::PREFIX)
                ->method(Is::PREFIX)
                ->method(Remove::PREFIX)
        );
    }
}
