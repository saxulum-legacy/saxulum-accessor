<?php

namespace Saxulum\Tests\Accessor\Fixtures\Mapping;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Saxulum\Accessor\Accessors\Add;
use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Remove;
use Saxulum\Accessor\Accessors\Set;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\Prop;

/**
 * @method $this addManies(Many2One $manies)
 * @method Many2One[] getManies()
 * @method $this removeManies(Many2One $manies)
 * @method $this setManies(array $manies)
 */
class One2Many
{
    use AccessorTrait;

    /**
     * @var Collection|Many2One[]
     */
    protected $manies;

    public function __construct()
    {
        $this->manies = new ArrayCollection();
    }

    protected function _initProps()
    {
        $this->_prop(
            (new Prop('manies', 'Saxulum\Tests\Accessor\Fixtures\Mapping\Many2One[]', true, 'one', Prop::REMOTE_ONE))
                ->method(Add::PREFIX)
                ->method(Get::PREFIX)
                ->method(Remove::PREFIX)
                ->method(Set::PREFIX)
        );
    }
}
