<?php

namespace Saxulum\Tests\Accessor\Helpers;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Saxulum\Accessor\Accessors\Add;
use Saxulum\Accessor\Accessors\Get;
use Saxulum\Accessor\Accessors\Remove;
use Saxulum\Accessor\AccessorTrait;
use Saxulum\Accessor\Prop;

/**
 * @method Many2One[] getManies()
 * @method $this addManies(Many2One $many, $stopPropagation = false)
 * @method $this removeManies(Many2One $many, $stopPropagation = false)
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

    protected function initializeProperties()
    {
        $this->prop(
            (new Prop('manies', 'Saxulum\Tests\Accessor\Helpers\Many2One', true, 'one', Prop::REMOTE_ONE))
                ->method(Add::PREFIX)
                ->method(Get::PREFIX)
                ->method(Remove::PREFIX)
        );
    }
}
